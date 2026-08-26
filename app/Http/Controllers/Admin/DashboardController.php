<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Product;
use App\Models\Post;

use App\Models\Contact;

class DashboardController extends Controller
{
    public function index()
    {
        return Inertia::render('Dashboard', [
            'stats' => [
                'products' => Product::count(),
                'posts' => Post::count(),
                'contacts' => Contact::count(),
            ],
            'recentContacts' => Contact::latest()->take(5)->get(),
        ]);
    }
}
