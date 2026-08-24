<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Setting extends Model implements HasMedia
{
    use HasTranslations, InteractsWithMedia;

    protected $fillable = ['key', 'value', 'type'];
    
    public $translatable = ['value'];
}
