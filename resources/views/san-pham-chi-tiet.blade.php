@extends('layouts.master')
@section('title', is_array($product->name) ? ($product->name[app()->getLocale()] ?? $product->name['vi']) : $product->name)

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/css/san-pham-chi-tiet.css') }}">
@endpush

@section('content')
    <!-- Page Banner -->
    <section class="page-banner" id="page-banner">
        <div class="page-banner-bg">
            <img src="{{ asset('assets/images/common/banner-tea-field.png') }}" alt="Đồi chè Việt Nam">
        </div>
    </section>

    <!-- Breadcrumb / Back -->
    <div class="chi-tiet-breadcrumb">
        <a href="{{ route('products') }}" class="chi-tiet-back">
            <span class="arrow-circle">
                <svg width="120" height="36" viewBox="-35 0 90 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="12" cy="12" r="11.5" stroke="#108140" stroke-width="0.5" />
                    <path d="M12 6L6 12L12 18" stroke="#108140" stroke-width="0.5" />
                    <path d="M54 12H6" stroke="#108140" stroke-width="0.5" />
                </svg>
            </span>
        </a>
        <h2 class="chi-tiet-category">{{ mb_strtoupper(is_array($product->category->name) ? ($product->category->name[app()->getLocale()] ?? $product->category->name['vi']) : $product->category->name) }}</h2>
    </div>

    <!-- Chi tiết sản phẩm -->
    <section class="chi-tiet-section">
        <div class="chi-tiet-container">

            <!-- Cột trái: ảnh -->
            <div class="chi-tiet-gallery">
                <div class="chi-tiet-main-img">
                    <div class="chi-tiet-main-slider">
                        <div class="chi-tiet-main-track">
                            <img src="{{ $product->getFirstMediaUrl('products') ?: asset('assets/images/products/product-black-tea-pekoe.png') }}" alt="{{ is_array($product->name) ? ($product->name[app()->getLocale()] ?? $product->name['vi']) : $product->name }}" id="main-product-img">
                            <img src="{{ asset('assets/images/products/product-tea-generic.png') }}" alt="{{ is_array($product->name) ? ($product->name[app()->getLocale()] ?? $product->name['vi']) : $product->name }}" class="gallery-slide">
                            <img src="{{ $product->getFirstMediaUrl('products') ?: asset('assets/images/products/product-black-tea-pekoe.png') }}" alt="{{ is_array($product->name) ? ($product->name[app()->getLocale()] ?? $product->name['vi']) : $product->name }}" class="gallery-slide">
                        </div>
                    </div>
                    <button class="chi-tiet-nav chi-tiet-nav-prev" aria-label="Ảnh trước">
                        <span class="nav-dot"></span>
                    </button>
                    <button class="chi-tiet-nav chi-tiet-nav-next" aria-label="Ảnh sau">
                        <span class="nav-dot"></span>
                    </button>
                </div>
                <div class="chi-tiet-thumbnails">
                    <img src="{{ $product->getFirstMediaUrl('products') ?: asset('assets/images/products/product-black-tea-pekoe.png') }}" alt="Ảnh 1" class="chi-tiet-thumb active">
                    <img src="{{ asset('assets/images/products/product-tea-generic.png') }}" alt="Ảnh 2" class="chi-tiet-thumb">
                    <img src="{{ $product->getFirstMediaUrl('products') ?: asset('assets/images/products/product-black-tea-pekoe.png') }}" alt="Ảnh 3" class="chi-tiet-thumb">
                </div>
            </div>

            <!-- Cột phải: thông tin -->
            <div class="chi-tiet-info">
                <h1 class="chi-tiet-name">{{ is_array($product->name) ? ($product->name[app()->getLocale()] ?? $product->name['vi']) : $product->name }}</h1>
                <p class="chi-tiet-subtitle">{{ app()->getLocale() == 'vi' ? 'Chi tiết sản phẩm' : 'Product Details' }}</p>
                <div class="chi-tiet-divider"></div>
                
                @if($product->content && (is_array($product->content) ? ($product->content[app()->getLocale()] ?? '') : $product->content) != '')
                    <div class="chi-tiet-content-html mb-6">
                        {!! is_array($product->content) ? ($product->content[app()->getLocale()] ?? $product->content['vi'] ?? '') : $product->content !!}
                    </div>
                @endif
                
                <table class="chi-tiet-table">
                    <tbody>
                        <tr>
                            <td class="chi-tiet-label">{{ app()->getLocale() == 'vi' ? 'Loại sản phẩm:' : 'Product Type:' }}</td>
                            <td class="chi-tiet-value">{{ is_array($product->category->name) ? ($product->category->name[app()->getLocale()] ?? $product->category->name['vi']) : $product->category->name }}</td>
                        </tr>
                        <tr>
                            <td class="chi-tiet-label">{{ app()->getLocale() == 'vi' ? 'Kiểu:' : 'Style:' }}</td>
                            <td class="chi-tiet-value">{{ app()->getLocale() == 'vi' ? 'Chính thống' : 'Orthodox' }}</td>
                        </tr>
                        <tr>
                            <td class="chi-tiet-label">{{ app()->getLocale() == 'vi' ? 'Bao bì:' : 'Packaging:' }}</td>
                            <td class="chi-tiet-value">{{ app()->getLocale() == 'vi' ? 'Túi, Hộp, Đóng gói quà tặng' : 'Bag, Box, Gift packing' }}</td>
                        </tr>
                        <tr>
                            <td class="chi-tiet-label">{{ app()->getLocale() == 'vi' ? 'Thời hạn sử dụng:' : 'Shelf Life:' }}</td>
                            <td class="chi-tiet-value">{{ app()->getLocale() == 'vi' ? '3 năm' : '3 years' }}</td>
                        </tr>
                        <tr>
                            <td class="chi-tiet-label">{{ app()->getLocale() == 'vi' ? 'Nơi xuất xứ:' : 'Origin:' }}</td>
                            <td class="chi-tiet-value">{{ app()->getLocale() == 'vi' ? 'vùng núi cao Việt Nam' : 'High mountain areas of Vietnam' }}</td>
                        </tr>
                        <tr>
                            <td class="chi-tiet-label">{{ app()->getLocale() == 'vi' ? 'Tên thương hiệu:' : 'Brand:' }}</td>
                            <td class="chi-tiet-value">Tan Binh Tea</td>
                        </tr>
                    </tbody>
                </table>
                <div class="chi-tiet-divider-down"></div>
                <div class="chi-tiet-actions">
                    <a href="{{ route('contact') }}" class="btn-lien-he">{{ app()->getLocale() == 'vi' ? 'LIÊN HỆ' : 'CONTACT' }}</a>
                </div>
            </div>

        </div>
    </section>
@endsection