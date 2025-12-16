<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserDiscount extends Model
{
    protected $fillable = [
        'user_id',
        'source_coupon_id',
        'discount_type',
        'discount_value',
        'started_at',
        'expired_at',
        'is_active',
        'meta',
    ];

    protected $casts = [
        'discount_value' => 'decimal:2',
        'started_at' => 'datetime',
        'expired_at' => 'datetime',
        'is_active' => 'boolean',
        'meta' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function sourceCoupon(): BelongsTo
    {
        return $this->belongsTo(Coupon::class, 'source_coupon_id');
    }
}
