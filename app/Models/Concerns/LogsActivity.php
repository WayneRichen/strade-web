<?php

namespace App\Models\Concerns;

use App\Models\ActivityLog;
use Illuminate\Support\Arr;

trait LogsActivity
{
    public static function bootLogsActivity(): void
    {
        static::created(function ($model) {
            $model->writeActivityLog('created');
        });

        static::updated(function ($model) {
            $model->writeActivityLog('updated');
        });

        static::deleted(function ($model) {
            $model->writeActivityLog('deleted');
        });
    }

    protected function writeActivityLog(string $action, ?string $description = null): void
    {
        // 目前登入使用者
        $user = auth()->user();

        // 變更內容
        $properties = [
            'attributes' => $this->getAttributes(),
        ];

        if ($action === 'updated') {
            $properties['old'] = $this->getOriginal();
            $properties['dirty'] = $this->getChanges();
        }

        // 一些不想記的欄位可以在這裡排除
        if (property_exists($this, 'logHidden') && is_array($this->logHidden)) {
            foreach (['attributes', 'old', 'dirty'] as $key) {
                if (isset($properties[$key])) {
                    $properties[$key] = Arr::except($properties[$key], $this->logHidden);
                }
            }
        }

        $request = request(); // 可能會是 null（例如 queue），所以要小心判斷

        ActivityLog::create([
            'user_id' => $user?->id,
            'loggable_type' => static::class,
            'loggable_id' => $this->getKey(),
            'action' => $action,
            'description' => $description,
            'properties' => $properties,
            'ip_address' => $request?->ip(),
            'user_agent' => $request?->userAgent(),
            'url' => $request?->fullUrl(),
        ]);
    }
}
