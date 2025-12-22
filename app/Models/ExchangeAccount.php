<?php

namespace App\Models;

use App\Models\Concerns\LogsActivity;
use App\Support\NumberId;
use Illuminate\Database\Eloquent\Model;

class ExchangeAccount extends Model
{
    use LogsActivity;

    protected $fillable = [
        'user_id',
        'public_id',
        'exchange_id',
        'name',
        'params',
        'exchange_uid',
        'last_connected_at',
        'last_status',
        'raw_response',
    ];

    protected $casts = [
        'params' => 'array',
    ];

    public function getRouteKeyName(): string
    {
        return 'public_id';
    }

    protected static function booted()
    {
        static::created(function (self $model) {
            if ($model->public_id) {
                return;
            }

            do {
                $model->public_id = NumberId::generateNumberId((string) $model->user_id);
            } while (
                self::query()->where('public_id', $model->public_id)->exists()
            );

            $model->saveQuietly();
        });
    }

    public function exchange()
    {
        return $this->belongsTo(Exchange::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
