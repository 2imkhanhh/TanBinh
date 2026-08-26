<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\Admin\DashboardController;

// Language Switch Route
Route::get('/lang/{locale}', function ($locale) {
    if (!in_array($locale, ['en', 'vi'])) {
        abort(400);
    }
    session()->put('locale', $locale);
    return redirect()->back();
})->name('lang.switch');

// Public Routes (Blade) with FrontendController
Route::get('/', [FrontendController::class, 'index'])->name('home');
Route::get('/gioi-thieu', [FrontendController::class, 'about'])->name('about');
Route::get('/san-pham', [FrontendController::class, 'products'])->name('products');
Route::get('/san-pham/{slug}', [FrontendController::class, 'productDetail'])->name('product.detail');
Route::get('/blog', [FrontendController::class, 'blog'])->name('blog');
Route::get('/blog-tin-tuc', [FrontendController::class, 'blogTinTuc'])->name('blog.tin-tuc');
Route::get('/blog-khac', [FrontendController::class, 'blogKhac'])->name('blog.khac');
Route::get('/blog/{slug}', [FrontendController::class, 'blogDetail'])->name('blog.detail');
Route::get('/lien-he', [FrontendController::class, 'contact'])->name('contact');
Route::post('/lien-he', [FrontendController::class, 'submitContact'])->name('contact.submit');

// Admin Dashboard Route (Inertia)
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

// Admin Routes Group
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('settings', SettingController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);
    Route::resource('posts', PostController::class);
    Route::resource('contacts', \App\Http\Controllers\Admin\ContactController::class)->only(['index', 'update', 'destroy']);
    Route::get('/email-settings', [SettingController::class, 'email'])->name('settings.email');
});

// Auth & Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
