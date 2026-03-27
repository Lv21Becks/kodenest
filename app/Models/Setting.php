<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    protected $fillable = ['key', 'value', 'type', 'group'];

    /**
     * Get a setting by key, with permanent caching.
     */
    public static function get($key, $default = null)
    {
        $settings = Cache::rememberForever('global_settings', function () {
            return self::pluck('value', 'key')->toArray();
        });

        $value = $settings[$key] ?? $default;

        if ($value === 'true' || $value === '1') return true;
        if ($value === 'false' || $value === '0') return false;

        return $value;
    }

    /**
     * Clear the cache memory when any setting is interacted with.
     */
    protected static function booted()
    {
        static::saved(function () {
            Cache::forget('global_settings');
        });

        static::deleted(function () {
            Cache::forget('global_settings');
        });
    }
}
