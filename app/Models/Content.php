<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Content extends Model
{
    use HasTranslations;

    protected $fillable = ['key', 'type', 'group', 'value'];

    // 'value' holds translated TEXT like {"en":"...","ar":"..."}.
    // For IMAGE rows, we'll store a non-translated structure like {"path":"home.hero.png"}.
    public $translatable = ['value'];

    protected $casts = [
        'value' => 'array', // always cast to array; for images it will be ["path" => "..."]
    ];

    /**
     * Helper: is this row a text field?
     */
    public function isText(): bool
    {
        return $this->type === 'text';
    }

    /**
     * Helper: is this row an image field?
     */
    public function isImage(): bool
    {
        return $this->type === 'image';
    }

    /**
     * For image rows, get the stored path (shared across locales).
     * Expected structure: ["path" => "home.hero.png"]
     */
    public function imagePath(): ?string
    {
        if (! $this->isImage()) return null;
        return $this->value['path'] ?? null;
    }
}
