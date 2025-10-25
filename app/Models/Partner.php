<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    protected $fillable = [
        'name',
        'media_type',
        'image_path',
        'video_url',
        'is_published',
        'sort_order',
    ];

    protected $casts = [
        'name' => 'array',
        'is_published' => 'boolean',
    ];

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order')->orderBy('id');
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true);
    }

    public function displayName(string $locale, ?string $fallback = 'en'): string
    {
        $names = $this->name ?? [];
        if (isset($names[$locale]) && $names[$locale]) {
            return $names[$locale];
        }

        if ($fallback && isset($names[$fallback]) && $names[$fallback]) {
            return $names[$fallback];
        }

        return '';
    }

    public function mediaTag(?string $locale = null): string
    {
        $locale ??= app()->getLocale();
        $alt = e($this->displayName($locale));

        if ($this->media_type === 'video' && $this->video_url) {
            $src = e($this->video_url);

            return <<<HTML
<div class="ratio-16x9"><iframe src="{$src}" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe></div>
HTML;
        }

        if ($this->media_type === 'image' && $this->image_path) {
            $src = e(asset($this->image_path));

            return <<<HTML
<img src="{$src}" alt="{$alt}" class="w-full h-full object-cover" />
HTML;
        }

        return '';
    }
}
