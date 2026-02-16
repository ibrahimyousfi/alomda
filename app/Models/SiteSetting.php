<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SiteSetting extends Model
{
    protected $fillable = ['key', 'value'];

    public static function get(string $key, $default = null)
    {
        $settings = Cache::remember('site_settings', 3600, function () {
            return self::pluck('value', 'key')->toArray();
        });
        return $settings[$key] ?? $default;
    }

    public static function set(string $key, $value): void
    {
        self::updateOrCreate(['key' => $key], ['value' => $value]);
        Cache::forget('site_settings');
    }

    public static function forget(string $key): void
    {
        self::where('key', $key)->delete();
        Cache::forget('site_settings');
    }
}
