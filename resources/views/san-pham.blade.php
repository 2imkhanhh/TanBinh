@extends('layouts.master')
@section('title', app()->getLocale() == 'vi' ? 'Sản phẩm' : 'Products')

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/css/san-pham.css') }}?v={{ time() }}">
@endpush

@section('content')
    <!-- Page Banner -->
    <section class="page-banner" id="page-banner">
        <div class="page-banner-bg">
            <img src="{{ isset($settings['product_hero_image']) && $settings['product_hero_image'] ? asset($settings['product_hero_image']) : asset('assets/images/home/hero-tea-banner.png') }}" alt="Đồi chè Việt Nam">
        </div>
        <div class="page-banner-content" data-aos="zoom-in" data-aos-duration="1000">
            <h1 class="page-banner-title">{!! nl2br(e($settings['product_hero_title'] ?? (app()->getLocale() == 'vi' ? 'SẢN PHẨM' : 'PRODUCTS'))) !!}</h1>
            <img src="{{ asset('assets/images/common/deco-vector-divider.png') }}" alt="" class="page-banner-vector">
            <p class="page-banner-desc">
                {!! $settings['product_hero_desc'] ?? (app()->getLocale() == 'vi' ? 'Khám phá các sản phẩm chè đen và chè xanh chất lượng cao từ Tân Bình Tea.' : 'Discover high-quality black and green tea products from Tan Binh Tea.') !!}
            </p>
        </div>
    </section>

    <div class="products-toggle-wrapper" data-aos="fade-up">
        <div class="products-toggle-switch">
            <span class="products-toggle-btn products-title-den active"
                  role="button"
                  tabindex="0"
                  aria-selected="true">
                {{ app()->getLocale() == 'vi' ? 'CHÈ ĐEN' : 'BLACK TEA' }}
            </span>
            <span class="products-toggle-btn products-title-xanh"
                  role="button"
                  tabindex="0"
                  aria-selected="false">
                {{ app()->getLocale() == 'vi' ? 'CHÈ XANH' : 'GREEN TEA' }}
            </span>
        </div>
    </div>

    <!-- Sản phẩm Chè Đen -->
    <section class="products" id="san-pham-den">
        <div class="products-container">
            <div class="products-header products-header-hidden">
                <h2 class="products-title">
                    <span class="products-title-top">{{ app()->getLocale() == 'vi' ? 'Sản phẩm' : 'Products' }}</span>
                    <span class="products-title-bottom">{{ app()->getLocale() == 'vi' ? 'CHÈ ĐEN' : 'BLACK TEA' }}</span>
                </h2>
            </div>
            <div class="products-grid" id="black-tea-grid">
                @foreach ($blackProducts as $product)
                    @php
                        $img = 'product-tea-generic.png';
                        if ($product->slug == 'vietnam-black-tea-pekoe') {
                            $img = 'product-black-tea-pekoe.png';
                        }
                    @endphp
                    <div class="product-card" id="product-{{ Str::afterLast($product->slug, '-') }}" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        <p class="product-name">
                            <a href="{{ route('product.detail', $product->slug) }}" style="text-decoration: none; color: inherit;">
                                {{ is_array($product->name) ? $product->name[app()->getLocale()] ?? $product->name['vi'] : $product->name }}
                            </a>
                        </p>
                        <div class="product-image">
                            <a href="{{ route('product.detail', $product->slug) }}" style="display: flex; align-items: center; justify-content: center; width: 100%; height: 100%;">
                                <img src="{{ $product->getFirstMediaUrl('products') ?: asset('assets/images/products/' . $img) }}"
                                    alt="{{ is_array($product->name) ? $product->name[app()->getLocale()] ?? $product->name['vi'] : $product->name }}">
                            </a>
                        </div>
                        <div class="product-actions">
                            <a href="{{ route('product.detail', $product->slug) }}" class="product-arrow">
                                <svg width="40" height="12" viewBox="0 0 40 12" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0 6H38" stroke="#108140" stroke-width="1.8" />
                                    <path d="M33 1L38 6L33 11" stroke="#333" stroke-width="1" />
                                </svg>
                            </a>
                            <a href="{{ route('contact') }}" class="btn-lien-he"
                                id="btn-contact-{{ Str::afterLast($product->slug, '-') }}">{{ app()->getLocale() == 'vi' ? 'LIÊN HỆ' : 'CONTACT' }}</a>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-4" style="display: flex; justify-content: center; margin-top: 2rem;">
                {{ $blackProducts->links('vendor.pagination.custom') }}
            </div>
        </div>
    </section>

    <!-- Sản phẩm Chè Xanh -->
    <section class="products products-green" id="san-pham-xanh">
        <div class="products-container">
            <div class="products-header products-header-hidden">
                <h2 class="products-title">
                    <span class="products-title-top">{{ app()->getLocale() == 'vi' ? 'Sản phẩm' : 'Products' }}</span>
                    <span class="products-title-bottom">{{ app()->getLocale() == 'vi' ? 'CHÈ XANH' : 'GREEN TEA' }}</span>
                </h2>
            </div>
            <div class="products-grid" id="green-tea-grid">
                @foreach ($greenProducts as $product)
                    <div class="product-card" id="product-{{ Str::afterLast($product->slug, '-') }}" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        <p class="product-name">
                            <a href="{{ route('product.detail', $product->slug) }}" style="text-decoration: none; color: inherit;">
                                {{ is_array($product->name) ? $product->name[app()->getLocale()] ?? $product->name['vi'] : $product->name }}
                            </a>
                        </p>
                        <div class="product-image">
                            <a href="{{ route('product.detail', $product->slug) }}" style="display: flex; align-items: center; justify-content: center; width: 100%; height: 100%;">
                                <img src="{{ $product->getFirstMediaUrl('products') ?: asset('assets/images/products/product-tea-generic.png') }}"
                                    alt="{{ is_array($product->name) ? $product->name[app()->getLocale()] ?? $product->name['vi'] : $product->name }}">
                            </a>
                        </div>
                        <div class="product-actions">
                            <a href="{{ route('product.detail', $product->slug) }}" class="product-arrow">
                                <svg width="40" height="12" viewBox="0 0 40 12" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0 6H38" stroke="#108140" stroke-width="1.8" />
                                    <path d="M33 1L38 6L33 11" stroke="#333" stroke-width="1" />
                                </svg>
                            </a>
                            <a href="{{ route('contact') }}" class="btn-lien-he"
                                id="btn-contact-{{ Str::afterLast($product->slug, '-') }}">{{ app()->getLocale() == 'vi' ? 'LIÊN HỆ' : 'CONTACT' }}</a>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-4" style="display: flex; justify-content: center; margin-top: 2rem;">
                {{ $greenProducts->links('vendor.pagination.custom') }}
            </div>
        </div>
    </section>
@endsection
