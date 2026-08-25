<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\Category;
use App\Models\Product;
use App\Models\Post;

class FrontendController extends Controller
{
    // Lấy config chung
    private function getSettings()
    {
        return Setting::all()->pluck('value', 'key')->toArray();
    }

    public function index()
    {
        $settings = $this->getSettings();
        $blackProducts = Product::where('is_active', true)->where('is_featured', true)->whereHas('category', function($q) {
            $q->where('slug', 'che-den');
        })->latest()->take(4)->get();
        $greenProducts = Product::where('is_active', true)->where('is_featured', true)->whereHas('category', function($q) {
            $q->where('slug', 'che-xanh');
        })->latest()->take(4)->get();
        $posts = Post::where('is_active', true)->latest()->take(3)->get();
        return view('index', compact('settings', 'blackProducts', 'greenProducts', 'posts'));
    }

    public function about()
    {
        $settings = $this->getSettings();
        return view('gioi-thieu', compact('settings'));
    }

    public function products()
    {
        $settings = $this->getSettings();
        $blackProducts = Product::where('is_active', true)->whereHas('category', function($q) {
            $q->where('slug', 'che-den');
        })->get();
        $greenProducts = Product::where('is_active', true)->whereHas('category', function($q) {
            $q->where('slug', 'che-xanh');
        })->get();
        return view('san-pham', compact('settings', 'blackProducts', 'greenProducts'));
    }

    public function productDetail($slug)
    {
        $settings = $this->getSettings();
        $product = Product::where('slug', $slug)->where('is_active', true)->firstOrFail();
        
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('is_active', true)
            ->take(4)->get();
            
        return view('san-pham-chi-tiet', compact('settings', 'product', 'relatedProducts'));
    }

    public function blog()
    {
        $settings = $this->getSettings();
        $posts = Post::where('is_active', true)->where('type', 'hinh-anh')->latest()->paginate(16);
        return view('blog', compact('settings', 'posts'));
    }
    
    public function blogTinTuc()
    {
        $settings = $this->getSettings();
        $posts = Post::where('is_active', true)->where('type', 'tin-tuc')->latest()->paginate(9);
        return view('blog-tin-tuc', compact('settings', 'posts'));
    }

    public function blogKhac()
    {
        $settings = $this->getSettings();
        $posts = Post::where('is_active', true)->where('type', 'khac')->latest()->paginate(9);
        return view('blog-khac', compact('settings', 'posts'));
    }
    
    public function blogDetail($slug)
    {
        $settings = $this->getSettings();
        $post = Post::where('slug', $slug)->where('is_active', true)->firstOrFail();
        return view('blog-chi-tiet', compact('settings', 'post'));
    }

    public function contact()
    {
        $settings = $this->getSettings();
        return view('lien-he', compact('settings'));
    }
}
