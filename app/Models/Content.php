<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Content extends Model
{
    use HasTranslations;

    protected $fillable = ['key', 'value'];
    public $translatable = ['value']; // 'value' is a JSON column {en, ar}
}
