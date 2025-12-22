<?php

namespace App\Models;

use App\Models\Concerns\LogsActivity;
use App\Support\UserUid;
use Filament\Panel;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasAvatar;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements FilamentUser, HasAvatar
{
    use LogsActivity;

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'uid',
        'google_id',
        'name',
        'avatar',
        'email',
        'subscription_plan',
        'subscription_ends_at',
        'last_login_at',
        'banned',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [];
    }

    protected static function booted()
    {
        static::creating(function ($user) {
            $user->uid ??= app(UserUid::class)->generateUnique();
        });
    }

    public function canAccessPanel(Panel $panel): bool
    {
        if ($panel->getId() === 'admin') {
            return $this->getRoleNames()->isNotEmpty();
        }

        if ($panel->getId() === 'account') {
            return true;
        }

        return false;
    }

    public function getFilamentAvatarUrl(): ?string
    {
        return $this->avatar;
    }

    public function couponUsages(): HasMany
    {
        return $this->hasMany(CouponUsage::class);
    }

    public function discounts(): HasMany
    {
        return $this->hasMany(UserDiscount::class);
    }

    /**
     * 常用：取得目前有效的折扣（終身折扣 expired_at = null 也算）
     */
    public function activeDiscounts(): HasMany
    {
        return $this->discounts()
            ->where('is_active', true)
            ->where(function ($q) {
                $q->whereNull('expired_at')
                    ->orWhere('expired_at', '>', now());
            });
    }

    public function exchangeAccounts(): HasMany
    {
        return $this->hasMany(ExchangeAccount::class);
    }

    public function bots(): HasMany
    {
        return $this->hasMany(Bot::class);
    }
}
