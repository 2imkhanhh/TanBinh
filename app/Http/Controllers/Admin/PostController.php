<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('category')->latest()->get()->map(function($post) {
            $post->title_vi = $post->getTranslation('title', 'vi', false);
            $post->title_en = $post->getTranslation('title', 'en', false);
            $post->excerpt_vi = $post->getTranslation('excerpt', 'vi', false);
            $post->excerpt_en = $post->getTranslation('excerpt', 'en', false);
            $post->content_vi = $post->getTranslation('content', 'vi', false);
            $post->content_en = $post->getTranslation('content', 'en', false);
            $post->image_url = $post->getFirstMediaUrl('posts');
            return $post;
        });

        $categories = Category::where('type', 'post')->get()->map(function($category) {
            $category->name_vi = $category->getTranslation('name', 'vi', false);
            return $category;
        });

        return Inertia::render('Admin/Posts/Index', [
            'posts' => $posts,
            'categories' => $categories
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title_vi' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:posts,slug',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|max:2048'
        ]);

        $post = new Post();
        $post->setTranslations('title', [
            'vi' => $request->title_vi,
            'en' => $request->title_en ?? ''
        ]);
        $post->setTranslations('excerpt', [
            'vi' => $request->excerpt_vi ?? '',
            'en' => $request->excerpt_en ?? ''
        ]);
        $post->setTranslations('content', [
            'vi' => $request->content_vi ?? '',
            'en' => $request->content_en ?? ''
        ]);
        
        $post->slug = $request->slug;
        $post->category_id = $request->category_id;
        $post->is_active = $request->boolean('is_active', true);
        $post->save();

        if ($request->hasFile('image')) {
            $post->addMediaFromRequest('image')->toMediaCollection('posts');
        }

        return redirect()->route('admin.posts.index')->with('success', 'Đã thêm bài viết!');
    }

    public function edit(Post $post)
    {
        $categories = Category::where('type', 'post')->get()->map(function($category) {
            $category->name_vi = $category->getTranslation('name', 'vi', false);
            return $category;
        });

        $post->title_vi = $post->getTranslation('title', 'vi', false);
        $post->title_en = $post->getTranslation('title', 'en', false);
        $post->excerpt_vi = $post->getTranslation('excerpt', 'vi', false);
        $post->excerpt_en = $post->getTranslation('excerpt', 'en', false);
        $post->content_vi = $post->getTranslation('content', 'vi', false);
        $post->content_en = $post->getTranslation('content', 'en', false);
        $post->image_url = $post->getFirstMediaUrl('posts');

        return Inertia::render('Admin/Posts/Edit', [
            'post' => $post,
            'categories' => $categories
        ]);
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title_vi' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:posts,slug,' . $post->id,
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|max:2048'
        ]);

        $post->setTranslations('title', [
            'vi' => $request->title_vi,
            'en' => $request->title_en ?? ''
        ]);
        $post->setTranslations('excerpt', [
            'vi' => $request->excerpt_vi ?? '',
            'en' => $request->excerpt_en ?? ''
        ]);
        $post->setTranslations('content', [
            'vi' => $request->content_vi ?? '',
            'en' => $request->content_en ?? ''
        ]);
        
        $post->slug = $request->slug;
        $post->category_id = $request->category_id;
        $post->is_active = $request->boolean('is_active', true);
        $post->save();

        if ($request->hasFile('image')) {
            $post->clearMediaCollection('posts');
            $post->addMediaFromRequest('image')->toMediaCollection('posts');
        }

        return redirect()->route('admin.posts.index')->with('success', 'Đã cập nhật bài viết!');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.posts.index')->with('success', 'Đã xóa bài viết!');
    }
}
