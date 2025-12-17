<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;

class SystemSetting extends Model
{
    protected $fillable = [
        'key',
        'value',
        'type',
        'description',
        'is_secret',
    ];

    protected static function booted(): void
    {
        static::saved(function (self $setting) {
            Cache::forget("settings:{$setting->key}");
        });

        static::deleted(function (self $setting) {
            Cache::forget("settings:{$setting->key}");
        });
    }

    // 讀取時：如果是 secret，就解密
    public function getValueAttribute($value)
    {
        if (!$this->is_secret || $value === null || $value === '') {
            return $value;
        }

        // 避免舊資料不是加密字串，decrypt 直接炸掉
        try {
            return Crypt::decryptString($value);
        } catch (\Throwable $e) {
            return $value;
        }
    }

    // 寫入時：如果是 secret，就加密
    public function setValueAttribute($value)
    {
        if (!$this->is_secret || $value === null || $value === '') {
            $this->attributes['value'] = $value;
            return;
        }

        // 避免「已經是加密字串」又被二次加密（例如：Edit 表單 hydrate 後又存回去）
        try {
            Crypt::decryptString((string) $value);
            $this->attributes['value'] = (string) $value; // 看起來已加密，直接存
        } catch (\Throwable $e) {
            $this->attributes['value'] = Crypt::encryptString((string) $value);
        }
    }
}
