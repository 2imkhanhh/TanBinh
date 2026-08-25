<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia
{
    use HasTranslations, InteractsWithMedia;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'is_active',
        'is_featured',
        'type', 'style', 'age', 'drink_style', 'processing_type',
        'packaging', 'specialty', 'grade', 'shelf_life', 'weight',
        'origin', 'brand_name', 'model_number', 'payment_terms',
        'advantage', 'leaf_origin', 'material',
    ];
    
    protected $casts = [
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
    ];

    public $translatable = [
        'name',
        'type', 'style', 'age', 'drink_style', 'processing_type',
        'packaging', 'specialty', 'grade', 'shelf_life', 'weight',
        'origin', 'brand_name', 'model_number', 'payment_terms',
        'advantage', 'leaf_origin', 'material',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
