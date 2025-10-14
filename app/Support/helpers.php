<?php

use App\Models\Content;

if (! function_exists('content')) {
    function content(string $key, string $default = ''): string {
        $item = Content::where('key', $key)->first();
        if (! $item) return $default;
        return $item->getTranslation('value', app()->getLocale()) ?: $default;
    }
}
