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
            $imageUrl = $product->getFirstMediaUrl('products');
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

        if ($request->hasFile('image')) {
            $product->addMediaFromRequest('image')->toMediaCollection('products');
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

        if ($request->hasFile('image')) {
            $product->clearMediaCollection('products');
            $product->addMediaFromRequest('image')->toMediaCollection('products');
        }

        return redirect()->route('admin.products.index')->with('success', 'Đã cập nhật sản phẩm!');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Đã xóa sản phẩm!');
    }
}
