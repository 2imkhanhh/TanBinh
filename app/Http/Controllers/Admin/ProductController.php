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
        $products = Product::with('category')->latest()->get()->map(function($product) {
            $product->name_vi = $product->getTranslation('name', 'vi', false);
            $product->name_en = $product->getTranslation('name', 'en', false);
            $product->image_url = $product->getFirstMediaUrl('products');
            return $product;
        });

        return Inertia::render('Admin/Products/Index', [
            'products' => $products
        ]);
    }

    public function create()
    {
        $categories = Category::where('type', 'product')->get()->map(function($category) {
            $category->name_vi = $category->getTranslation('name', 'vi', false);
            return $category;
        });
        
        return Inertia::render('Admin/Products/Create', [
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
        $product->setTranslations('short_description', [
            'vi' => $request->short_desc_vi ?? '',
            'en' => $request->short_desc_en ?? ''
        ]);
        $product->setTranslations('content', [
            'vi' => $request->content_vi ?? '',
            'en' => $request->content_en ?? ''
        ]);
        
        $product->slug = $request->slug;
        $product->category_id = $request->category_id;
        $product->is_active = $request->boolean('is_active', true);
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
        $product->short_desc_vi = $product->getTranslation('short_description', 'vi', false);
        $product->short_desc_en = $product->getTranslation('short_description', 'en', false);
        $product->content_vi = $product->getTranslation('content', 'vi', false);
        $product->content_en = $product->getTranslation('content', 'en', false);
        $product->image_url = $product->getFirstMediaUrl('products');

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
        $product->setTranslations('short_description', [
            'vi' => $request->short_desc_vi ?? '',
            'en' => $request->short_desc_en ?? ''
        ]);
        $product->setTranslations('content', [
            'vi' => $request->content_vi ?? '',
            'en' => $request->content_en ?? ''
        ]);
        
        $product->slug = $request->slug;
        $product->category_id = $request->category_id;
        $product->is_active = $request->boolean('is_active', true);
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
