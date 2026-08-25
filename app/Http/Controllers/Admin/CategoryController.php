<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CategoryController extends Controller
{
    public function index()
    {
        // Get translations to send to Vue properly
        $categories = Category::with('parent')->latest()->get()->map(function($category) {
            $category->name_vi = $category->getTranslation('name', 'vi', false);
            $category->name_en = $category->getTranslation('name', 'en', false);
            return $category;
        });

        $parents = Category::whereNull('parent_id')->get()->map(function($category) {
            $category->name_vi = $category->getTranslation('name', 'vi', false);
            return $category;
        });

        return Inertia::render('Admin/Categories/Index', [
            'categories' => $categories,
            'parents' => $parents
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_vi' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:categories,slug',
            'type' => 'required|in:product,post',
        ]);

        $category = new Category();
        $category->setTranslations('name', [
            'vi' => $request->name_vi,
            'en' => $request->name_en ?? ''
        ]);
        $category->slug = $request->slug;
        $category->type = $request->type;
        $category->parent_id = $request->parent_id;
        $category->save();

        return redirect()->route('admin.categories.index')->with('success', 'Đã thêm danh mục!');
    }

    public function edit(Category $category)
    {
        $parents = Category::whereNull('parent_id')->where('id', '!=', $category->id)->get()->map(function($category) {
            $category->name_vi = $category->getTranslation('name', 'vi', false);
            return $category;
        });

        $category->name_vi = $category->getTranslation('name', 'vi', false);
        $category->name_en = $category->getTranslation('name', 'en', false);

        return Inertia::render('Admin/Categories/Edit', [
            'category' => $category,
            'parents' => $parents
        ]);
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name_vi' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:categories,slug,' . $category->id,
            'type' => 'required|in:product,post',
        ]);

        $category->setTranslations('name', [
            'vi' => $request->name_vi,
            'en' => $request->name_en ?? ''
        ]);
        $category->slug = $request->slug;
        $category->type = $request->type;
        $category->parent_id = $request->parent_id;
        $category->save();

        return redirect()->route('admin.categories.index')->with('success', 'Đã cập nhật danh mục!');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Đã xóa danh mục!');
    }
}
