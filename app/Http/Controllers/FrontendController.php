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
        })->paginate(12, ['*'], 'black_page');
        $greenProducts = Product::where('is_active', true)->whereHas('category', function($q) {
            $q->where('slug', 'che-xanh');
        })->paginate(12, ['*'], 'green_page');
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
        $posts = Post::where('is_active', true)->where('type', 'tin-tuc')->latest()->paginate(8);
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

    public function submitContact(\Illuminate\Http\Request $request)
    {
        $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'content' => 'required|string|max:1000'
        ]);

        $contact = \App\Models\Contact::create([
            'fullname' => $request->fullname,
            'email' => $request->email,
            'phone' => $request->phone,
            'content' => $request->content,
            'status' => 'pending'
        ]);

        try {
            // Email settings are now loaded globally via AppServiceProvider
            $mailReceiveStr = \App\Models\Setting::where('key', 'mail_receive_address')->first()?->value;
            $mailUsername = \App\Models\Setting::where('key', 'mail_username')->first()?->value;

            $adminEmails = [];
            if (!empty($mailReceiveStr)) {
                $adminEmails = array_map('trim', explode(',', $mailReceiveStr));
                $adminEmails = array_filter($adminEmails, function ($email) {
                    return filter_var($email, FILTER_VALIDATE_EMAIL);
                });
            }

            if (empty($adminEmails)) {
                $adminEmails = !empty($mailUsername) ? [$mailUsername] : [config('mail.from.address')];
            }

            if (!empty($adminEmails)) {
                \Illuminate\Support\Facades\Mail::to($adminEmails)->send(new \App\Mail\ContactNotification($contact));
            }
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Gửi email thông báo liên hệ thất bại: ' . $e->getMessage());
        }

        if ($request->ajax()) {
            return response()->json(['type' => 'success', 'message' => 'Cảm ơn bạn đã liên hệ, chúng tôi sẽ phản hồi sớm nhất!']);
        }

        return redirect()->back()->with('success', 'Cảm ơn bạn đã liên hệ, chúng tôi sẽ phản hồi sớm nhất!');
    }
}
