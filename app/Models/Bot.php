<?php

namespace App\Models;

use App\Models\Concerns\LogsActivity;
use App\Support\NumberId;
use Illuminate\Database\Eloquent\Model;

class Bot extends Model
{
    use LogsActivity;

    protected $fillable = [
        'user_id',
        'public_id',
        'exchange_account_id',
        'strategy_id',
        'exchange_symbol',
        'name',
        'leverage',
        'base_order_usdt',
        'params',
        'status',
        'started_at',
        'stopped_at',
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

    public function exchangeAccount()
    {
        return $this->belongsTo(ExchangeAccount::class);
    }

    public function strategy()
    {
        return $this->belongsTo(Strategy::class);
    }
}
