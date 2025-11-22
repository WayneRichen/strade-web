<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExchangeAccount extends Model
{
    protected $fillable = [
        'user_id',
        'exchange_id',
        'name',
        'params',
        'last_connected_at',
        'last_status',
    ];

    protected $casts = [
        'params' => 'array',
    ];

    public function exchange()
    {
        return $this->belongsTo(Exchange::class);
    }
}
