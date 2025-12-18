<?php

namespace App\Models;

use App\Models\Concerns\LogsActivity;
use Illuminate\Database\Eloquent\Model;

class UserExchangeAccount extends Model
{
    use LogsActivity;

    protected $table = 'exchange_accounts';

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

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
