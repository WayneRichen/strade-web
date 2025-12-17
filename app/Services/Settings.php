<?php

namespace App\Services;

use App\Models\SystemSetting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;

class Settings
{
    public static function get(string $key, mixed $default = null): mixed
    {
        $row = Cache::remember("settings:$key", 60, fn() => SystemSetting::where('key', $key)->first());

        if (!$row || $row->value === null) {
            return $default;
        }

        $value = $row->is_secret ? Crypt::decryptString($row->value) : $row->value;

        return match ($row->type) {
            'int'  => (int) $value,
            'bool' => filter_var($value, FILTER_VALIDATE_BOOLEAN),
            'json' => json_decode($value, true) ?? $default,
            default => $value,
        };
    }

    public static function set(
        string $key,
        mixed $value,
        string $type = 'string',
        string $group = 'system',
        ?string $description = null,
        bool $isSecret = false
    ): void {
        $stored = $isSecret
            ? Crypt::encryptString((string) $value)
            : (is_array($value) ? json_encode($value, JSON_UNESCAPED_UNICODE) : (string) $value);

        SystemSetting::updateOrCreate(
            ['key' => $key],
            [
                'value' => $stored,
                'type' => $type,
                'group' => $group,
                'description' => $description,
                'is_secret' => $isSecret,
            ]
        );

        Cache::forget("settings:$key");
    }
}
