<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Coupon extends Model
{
    protected $fillable = [
        'code',
        'type',
        'discount_type',
        'discount_value',
        'cashback_type',
        'cashback_value',
        'cashback_user_id',
        'max_usage',
        'started_at',
        'expired_at',
        'is_active',
        'meta',
    ];

    protected $casts = [
        'discount_value' => 'decimal:2',
        'cashback_value' => 'decimal:2',
        'max_usage' => 'integer',
        'started_at' => 'datetime',
        'expired_at' => 'datetime',
        'is_active' => 'boolean',
        'meta' => 'array',
    ];

    public function usages(): HasMany
    {
        return $this->hasMany(CouponUsage::class);
    }

    public function userDiscounts(): HasMany
    {
        return $this->hasMany(UserDiscount::class, 'source_coupon_id');
    }

    public function cashbackUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'cashback_user_id');
    }
}
