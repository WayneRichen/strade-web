<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserTradeOrder extends Model
{
    protected $fillable = [
        'user_trade_id',
        'exchange_order_id',
        'type',
        'price',
        'requested_qty',
        'filled_qty',
        'fee',
        'status',
        'raw_response',
    ];

    public function userTrade()
    {
        return $this->belongsTo(UserTrade::class);
    }
}
