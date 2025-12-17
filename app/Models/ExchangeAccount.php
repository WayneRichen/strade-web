<?php

namespace App\Models;

use App\Models\Concerns\LogsActivity;
use Illuminate\Database\Eloquent\Model;

class ExchangeAccount extends Model
{
    use LogsActivity;

    protected $fillable = [
        'user_id',
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

    public function exchange()
    {
        return $this->belongsTo(Exchange::class);
    }
}
