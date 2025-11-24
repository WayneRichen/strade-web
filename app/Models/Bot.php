<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bot extends Model
{
    protected $fillable = [
        'user_id',
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

    public function exchangeAccount()
    {
        return $this->belongsTo(ExchangeAccount::class);
    }

    public function strategy()
    {
        return $this->belongsTo(Strategy::class);
    }
}
