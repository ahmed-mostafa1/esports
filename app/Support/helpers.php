<?php

use App\Models\Content;
use Illuminate\Support\Str;

if (! function_exists('content')) {
    /**
     * Get translated TEXT for current locale.
     * Fallback order: current locale → en → $default
     */
    function content(string $key, string $default = ''): string
    {
        /** @var Content|null $row */
        $row = Content::query()->where('key', $key)->first();
        if (! $row || ! $row->isText()) {
            return $default;
        }

        $locale = app()->getLocale();
        $val = $row->getTranslation('value', $locale, false);
        if (is_string($val) && $val !== '') {
            return $val;
        }

        $en = $row->getTranslation('value', 'en', false);
        return (is_string($en) && $en !== '') ? $en : $default;
    }
}

if (! function_exists('content_media')) {
    function content_media(string $key, string $default = ''): string
    {
        /** @var Content|null $row */
        $row = Content::query()->where('key', $key)->first();

        // Stored filename (shared across locales), e.g. 'home.hero.png'
        $filename = ($row && $row->isImage()) ? ($row->imagePath() ?? '') : '';

        // If DB provided a filename, serve from /content-images/<filename>
        if ($filename) {
            return asset('content-images/' . ltrim($filename, '/'));
        }

        // No stored filename → use default verbatim (smartly)
        if ($default) {
            // Absolute URLs or data URIs: return as-is
            if (Str::startsWith($default, ['http://','https://','data:'])) {
                return $default;
            }
            // If default starts with '/', treat as absolute public path
            if (Str::startsWith($default, ['/'])) {
                return asset(ltrim($default, '/'));
            }
            // Otherwise treat default as a normal public path like 'img/hero.png'
            return asset(ltrim($default, '/'));
        }

        // Optional final fallback
        return asset('content-images/placeholder.png');
    }
}
