<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Content extends Model
{
    use HasTranslations;

    protected $fillable = ['key', 'type', 'group', 'value'];

    // 'value' is translatable ONLY for text rows.
    public $translatable = ['value'];

    public function isText(): bool
    {
        return $this->type === 'text';
    }

    public function isImage(): bool
    {
        return $this->type === 'image';
    }

    /**
     * For image rows, we store: ["path" => "home.hero.png"]
     */
    public function imagePath(): ?string
    {
        if (! $this->isImage()) return null;
        // Accessing $this->value directly is fine here because images are not translated.
        return is_array($this->value) ? ($this->value['path'] ?? null) : null;
    }
}
