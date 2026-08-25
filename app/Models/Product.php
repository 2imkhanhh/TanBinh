<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia
{
    use HasTranslations, InteractsWithMedia;

    protected $fillable = ['category_id', 'name', 'slug', 'short_description', 'content', 'is_active', 'is_featured'];
    
    protected $casts = [
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
    ];

    public $translatable = ['name', 'short_description', 'content'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
