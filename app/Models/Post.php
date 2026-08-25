<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Post extends Model implements HasMedia
{
    use HasTranslations, InteractsWithMedia;

    protected $fillable = ['type', 'title', 'slug', 'excerpt', 'content', 'is_active'];
    
    public $translatable = ['title', 'excerpt', 'content'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
