<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->latest()->paginate(10);
        $products->getCollection()->transform(function($product) {
            $product->name_vi = $product->getTranslation('name', 'vi', false);
            $product->name_en = $product->getTranslation('name', 'en', false);
            $fields = ['type', 'style', 'age', 'drink_style', 'processing_type', 'packaging', 'specialty', 'grade', 'shelf_life', 'weight', 'origin', 'brand_name', 'model_number', 'payment_terms', 'advantage', 'leaf_origin', 'material'];
            foreach ($fields as $field) {
                $product->{$field . '_vi'} = $product->getTranslation($field, 'vi', false);
                $product->{$field . '_en'} = $product->getTranslation($field, 'en', false);
            }
            $product->is_featured = $product->is_featured;
            $product->category_name_vi = $product->category ? $product->category->getTranslation('name', 'vi', false) : '';
            $mediaItems = $product->getMedia('products')->sortBy('order_column')->values();
            $product->media_items = $mediaItems->map(function($media) {
                return [
                    'id' => $media->id,
                    'url' => $media->getUrl()
                ];
            });
            $imageUrl = count($mediaItems) > 0 ? $mediaItems[0]->getUrl() : '';
            if (empty($imageUrl)) {
                $img = 'product-tea-generic.png';
                if ($product->slug == 'vietnam-black-tea-pekoe') {
                    $img = 'product-black-tea-pekoe.png';
                }
                $imageUrl = asset('assets/images/products/' . $img);
            }
            $product->image_url = $imageUrl;
            return $product;
        });

        $categories = Category::where('type', 'product')->get()->map(function($category) {
            $category->name_vi = $category->getTranslation('name', 'vi', false);
            return $category;
        });

        return Inertia::render('Admin/Products/Index', [
            'products' => $products,
            'categories' => $categories
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_vi' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|max:2048'
        ]);

        $product = new Product();
        $product->setTranslations('name', [
            'vi' => $request->name_vi,
            'en' => $request->name_en ?? ''
        ]);
        $fields = ['type', 'style', 'age', 'drink_style', 'processing_type', 'packaging', 'specialty', 'grade', 'shelf_life', 'weight', 'origin', 'brand_name', 'model_number', 'payment_terms', 'advantage', 'leaf_origin', 'material'];
        foreach ($fields as $field) {
            $product->setTranslations($field, [
                'vi' => $request->{$field . '_vi'} ?? '',
                'en' => $request->{$field . '_en'} ?? ''
            ]);
        }
        
        $product->slug = $request->slug;
        $product->category_id = $request->category_id;
        $product->is_active = $request->boolean('is_active', true);
        $product->is_featured = $request->boolean('is_featured', false);
        $product->save();

        if ($request->hasFile('images')) {
            $allMediaIds = [];
            foreach ($request->file('images') as $index => $file) {
                $media = $product->addMedia($file)->toMediaCollection('products');
                $allMediaIds[] = ['val' => $index, 'media_id' => $media->id];
            }
            
            $primaryVal = $request->input('primary_val', 0);
            $orderedIds = [];
            $primaryMediaId = null;
            
            foreach ($allMediaIds as $item) {
                if ($item['val'] == $primaryVal) {
                    $primaryMediaId = $item['media_id'];
                }
            }
            
            if ($primaryMediaId) {
                $orderedIds[] = $primaryMediaId;
            }
            
            foreach ($allMediaIds as $item) {
                if ($item['media_id'] != $primaryMediaId) {
                    $orderedIds[] = $item['media_id'];
                }
            }
            
            foreach ($orderedIds as $index => $id) {
                \Spatie\MediaLibrary\MediaCollections\Models\Media::where('id', $id)->update(['order_column' => $index + 1]);
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Đã thêm sản phẩm!');
    }

    public function edit(Product $product)
    {
        $categories = Category::where('type', 'product')->get()->map(function($category) {
            $category->name_vi = $category->getTranslation('name', 'vi', false);
            return $category;
        });

        $product->name_vi = $product->getTranslation('name', 'vi', false);
        $product->name_en = $product->getTranslation('name', 'en', false);
        
        $fields = ['type', 'style', 'age', 'drink_style', 'processing_type', 'packaging', 'specialty', 'grade', 'shelf_life', 'weight', 'origin', 'brand_name', 'model_number', 'payment_terms', 'advantage', 'leaf_origin', 'material'];
        foreach ($fields as $field) {
            $product->{$field . '_vi'} = $product->getTranslation($field, 'vi', false);
            $product->{$field . '_en'} = $product->getTranslation($field, 'en', false);
        }
        
        $product->is_featured = $product->is_featured;
        $imageUrl = $product->getFirstMediaUrl('products');
        if (empty($imageUrl)) {
            $img = 'product-tea-generic.png';
            if ($product->slug == 'vietnam-black-tea-pekoe') {
                $img = 'product-black-tea-pekoe.png';
            }
            $imageUrl = asset('assets/images/products/' . $img);
        }
        $product->image_url = $imageUrl;

        return Inertia::render('Admin/Products/Edit', [
            'product' => $product,
            'categories' => $categories
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name_vi' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug,' . $product->id,
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|max:2048'
        ]);

        $product->setTranslations('name', [
            'vi' => $request->name_vi,
            'en' => $request->name_en ?? ''
        ]);
        $fields = ['type', 'style', 'age', 'drink_style', 'processing_type', 'packaging', 'specialty', 'grade', 'shelf_life', 'weight', 'origin', 'brand_name', 'model_number', 'payment_terms', 'advantage', 'leaf_origin', 'material'];
        foreach ($fields as $field) {
            $product->setTranslations($field, [
                'vi' => $request->{$field . '_vi'} ?? '',
                'en' => $request->{$field . '_en'} ?? ''
            ]);
        }
        
        $product->slug = $request->slug;
        $product->category_id = $request->category_id;
        $product->is_active = $request->boolean('is_active', true);
        $product->is_featured = $request->boolean('is_featured', false);
        $product->save();

        if ($request->has('keep_media_ids')) {
            $keepIds = $request->input('keep_media_ids', []);
            if (is_string($keepIds)) {
                $keepIds = explode(',', $keepIds);
            }
            $existingMedia = $product->getMedia('products');
            foreach ($existingMedia as $media) {
                if (!in_array($media->id, $keepIds)) {
                    $media->delete();
                }
            }
        } else {
            $product->clearMediaCollection('products');
        }

        $allMediaIds = [];
        $existingMedia = $product->getMedia('products');
        foreach ($existingMedia as $media) {
            $allMediaIds[] = ['type' => 'existing', 'val' => $media->id, 'media_id' => $media->id];
        }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $file) {
                $media = $product->addMedia($file)->toMediaCollection('products');
                $allMediaIds[] = ['type' => 'new', 'val' => $index, 'media_id' => $media->id];
            }
        }

        $primaryType = $request->input('primary_type', 'existing');
        $primaryVal = $request->input('primary_val');
        
        if (count($allMediaIds) > 0) {
            $orderedIds = [];
            $primaryMediaId = null;
            
            foreach ($allMediaIds as $item) {
                if ($item['type'] == $primaryType && $item['val'] == $primaryVal) {
                    $primaryMediaId = $item['media_id'];
                }
            }

            if (!$primaryMediaId) {
                $primaryMediaId = $allMediaIds[0]['media_id'];
            }

            $orderedIds[] = $primaryMediaId;

            foreach ($allMediaIds as $item) {
                if ($item['media_id'] != $primaryMediaId) {
                    $orderedIds[] = $item['media_id'];
                }
            }

            foreach ($orderedIds as $index => $id) {
                \Spatie\MediaLibrary\MediaCollections\Models\Media::where('id', $id)->update(['order_column' => $index + 1]);
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Đã cập nhật sản phẩm!');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Đã xóa sản phẩm!');
    }
}
