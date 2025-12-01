<?php

namespace App\Models;

use App\Models\Concerns\LogsActivity;
use Illuminate\Database\Eloquent\Model;

class UserTrade extends Model
{
    use LogsActivity;

    protected $fillable = [
        'user_id',
        'strategy_trade_id',
        'exchange_account_it',
        'bot_id',
        'exchange_symbol',
        'position_side',
        'quantity',
        'leverage',
        'entry_price',
        'exit_price',
        'opened_at',
        'closed_at',
        'status',
        'pnl',
        'pnl_pct',
        'error_message',
    ];

    public function bot()
    {
        return $this->belongsTo(Bot::class);
    }

    public function exchangeAccount()
    {
        return $this->belongsTo(ExchangeAccount::class);
    }

    public function strategyTrade()
    {
        return $this->belongsTo(StrategyTrade::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orders()
    {
        return $this->hasMany(UserTradeOrder::class);
    }
}
