<?php
// app/Models/Setting.php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    protected $fillable = ['key', 'value'];

    /**
     * Get a setting value by key with optional default.
     * Always returns a string (safe for Blade {{ }}).
     */
    public static function get(string $key, mixed $default = null): string
    {
        $value = Cache::remember("setting_{$key}", 3600, function () use ($key, $default) {
            $setting = static::where('key', $key)->first();
            return $setting ? $setting->value : $default;
        });

        // Guard: if somehow an array/object ended up stored, convert safely
        if (is_array($value) || is_object($value)) {
            return (string) ($default ?? '');
        }

        return (string) ($value ?? '');
    }

    /**
     * Set (upsert) a setting value.
     */
    public static function set(string $key, mixed $value): void
    {
        static::updateOrCreate(['key' => $key], ['value' => $value]);
        Cache::forget("setting_{$key}");
    }
}