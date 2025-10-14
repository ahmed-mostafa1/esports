<?php

use App\Models\Content;
use Illuminate\Support\Str;

if (! function_exists('content')) {
    /**
     * Get translated TEXT for current locale.
     * Fallback order: current locale → 'en' → $default
     */
    function content(string $key, string $default = ''): string
    {
        /** @var Content|null $row */
        $row = Content::query()->where('key', $key)->first();

        if (! $row || ! $row->isText()) {
            return $default;
        }

        $locale = app()->getLocale();

        // Use Spatie Translatable to retrieve the value safely
        $val = $row->getTranslation('value', $locale, false);

        if (is_string($val) && $val !== '') {
            return $val;
        }

        // Fallback to EN explicitly
        $en = $row->getTranslation('value', 'en', false);
        return (is_string($en) && $en !== '') ? $en : $default;
    }
}


if (! function_exists('content_media')) {
    /**
     * Get a resolvable URL for a SHARED IMAGE.
     * We store {"path":"home.hero.png"} and serve /content-images/home.hero.png via asset()
     * $default can be a filename in the same folder, or any absolute URL.
     */
    function content_media(string $key, string $default = ''): string
    {
        /** @var Content|null $row */
        $row = Content::query()->where('key', $key)->first();

        // Resolve stored filename (shared across locales)
        $filename = ($row && $row->isImage()) ? ($row->value['path'] ?? '') : '';

        // Absolute URL default? return as-is
        if (!$filename && $default && Str::startsWith($default, ['http://','https://','data:'])) {
            return $default;
        }

        // If we have a filename (e.g., 'home.hero.png'):
        if ($filename) {
            return asset('content-images/' . ltrim($filename, '/'));
        }

        // Otherwise, fallback filename in same folder (e.g., 'placeholder.png')
        if ($default) {
            // If it's a bare filename like 'placeholder.png' or 'home.hero.png'
            if (!Str::startsWith($default, ['http://','https://','/'])) {
                return asset('content-images/' . $default);
            }
            // If default starts with slash or is absolute, just return asset/default
            return Str::startsWith($default, ['/']) ? asset(ltrim($default, '/')) : $default;
        }

        // Final safety: generic placeholder (optional)
        return asset('content-images/placeholder.png');
    }
}
