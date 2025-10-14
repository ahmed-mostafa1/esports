<?php

namespace App\Support;

use App\Models\Content;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;

class ContentRepository
{
    public static function text(string $key, ?string $default=null): string
    {
        $locale = App::getLocale() ?: 'en';
        $cacheKey = "cms:content:{$key}:{$locale}";

        return Cache::rememberForever($cacheKey, function () use ($key, $locale, $default) {
            $row = Content::where('key',$key)->where('type','text')->first();
            if (!$row) return $default ?? '';
            $val = $row->getTranslation('value', $locale) ?: $row->getTranslation('value','en');
            return $val ?? ($default ?? '');
        });
    }

    public static function image(string $key, ?string $default=null): string
    {
        $cacheKey = "cms:content-media:{$key}";

        return Cache::rememberForever($cacheKey, function () use ($key, $default) {
            // Use raw database query to avoid model complications
            $row = \DB::table('contents')
                     ->where('key', $key)
                     ->where('type', 'image')
                     ->first();
                     
            if (!$row) return $default ? asset($default) : '';
            
            // Parse the JSON value
            $value = json_decode($row->value, true);
            $filename = $value['path'] ?? null;
            
            if (!$filename) return $default ? asset($default) : '';
            return asset('content-images/'.$filename);
        });
    }

    public static function forgetText(string $key): void
    {
        Cache::forget("cms:content:{$key}:en");
        Cache::forget("cms:content:{$key}:ar");
    }

    public static function forgetImage(string $key): void
    {
        Cache::forget("cms:content-media:{$key}");
    }
}
