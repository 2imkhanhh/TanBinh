@extends('layouts.master')
@section('title', $settings['site_title'] ?? 'Tân Bình Tea')

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/css/index.css') }}">
@endpush

@section('content')
    <!-- Hero Section -->
    <section class="hero" id="hero">
        <div class="hero-bg">
            <img src="{{ isset($settings['home_hero_image']) && $settings['home_hero_image'] ? asset($settings['home_hero_image']) : asset('assets/images/home/hero-tea-banner.png') }}" alt="Đồi chè Việt Nam">
        </div>
        <div class="hero-content">
            <h1 class="hero-title">{!! nl2br(e($settings['home_intro_title'] ?? "TRÀ VIỆT NAM\nLÀ NGHỆ SĨ")) !!}</h1>
            <div class="hero-desc">
                {!! $settings['home_intro_desc'] ??
                            'Trong suốt quá trình hình thành và phát triển, chúng tôi hướng đến mục tiêu không chỉ là một thương hiệu chè, mà còn là cầu nối đưa hương vị Việt Nam vươn xa ra thế giới. Từng búp chè nhỏ bé mang theo khát vọng lớn, để bạn bè quốc tế biết đến, yêu mến và trân trọng những giá trị mộc mạc nhưng đầy tự hào của dân tộc Việt Nam'
                !!}
            </div>
        </div>
    </section>

    <!-- Giới thiệu Section -->
    <section class="intro" id="gioi-thieu">
        <div class="intro-container">
            <div class="intro-left">
                <div class="intro-image">
                    <img src="{{ isset($settings['home_about_image']) && $settings['home_about_image'] ? asset($settings['home_about_image']) : asset('assets/images/home/intro-tea-harvest.jpg') }}" alt="Thu hái chè tại Phú Thọ">
                </div>
                <div class="intro-text-block">
                    <h2 class="intro-title">{{ $settings['home_about_title'] ?? (app()->getLocale() == 'vi' ? 'Giới thiệu' : 'About Us') }}</h2>
                    <div class="intro-desc">
                        {!! nl2br(e($settings['home_about_desc'] ?? ($settings['about_short'] ?? 'Công ty TNHH Xuất Nhập Khẩu Chè Tân Bình với gần 100 cán bộ kỹ thuật và công nhân lành nghề trong sản xuất, chế biến chè...'))) !!}
                    </div>
                </div>
            </div>
            <div class="intro-right">
                <div class="intro-leaf-decoration">
                    <img src="{{ asset('assets/images/common/leaf-vertical-top.png') }}" alt="Lá trà trang trí trên"
                        class="leaf-vertical-top">
                    <img src="{{ asset('assets/images/common/leaf-vertical-bottom.png') }}" alt="Lá trà trang trí dưới"
                        class="leaf-vertical-down">
                </div>
                <a href="{{ route('about') }}" class="xem-them-link" id="btn-xem-them-intro">
                    <span>{{ app()->getLocale() == 'vi' ? 'Xem thêm' : 'Read more' }}</span>
                    <span class="arrow-circle">
                        <svg width="54" height="24" viewBox="-30 0 54 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <circle cx="12" cy="12" r="11.5" stroke="#108140" stroke-width="0.5" />
                            <path d="M12 6L18 12L12 18" stroke="#108140" stroke-width="0.5" />
                            <path d="M-30 12H18" stroke="#108140" stroke-width="0.5" />
                        </svg>
                    </span>
                </a>
            </div>
        </div>
    </section>

    <!-- Sản phẩm Chè Đen -->
    <section class="products" id="san-pham">
        <div class="products-container">
            <div class="products-header">
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
                    <div class="product-card" id="product-{{ Str::afterLast($product->slug, '-') }}">
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
            <div class="products-footer">
                <a href="{{ route('products') }}" class="xem-them-link" id="btn-xem-them-black">
                    <span>{{ app()->getLocale() == 'vi' ? 'Xem thêm' : 'See more' }}</span>
                    <span class="arrow-circle">
                        <svg width="54" height="24" viewBox="-30 0 54 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <circle cx="12" cy="12" r="11.5" stroke="#108140" stroke-width="0.5" />
                            <path d="M12 6L18 12L12 18" stroke="#108140" stroke-width="0.5" />
                            <path d="M-30 12H18" stroke="#108140" stroke-width="0.5" />
                        </svg>
                    </span>
                </a>
            </div>
        </div>
    </section>

    <!-- Sản phẩm Chè Xanh -->
    <section class="products products-green" id="san-pham-xanh">
        <div class="products-container">
            <div class="products-header">
                <h2 class="products-title">
                    <span class="products-title-top">{{ app()->getLocale() == 'vi' ? 'Sản phẩm' : 'Products' }}</span>
                    <span class="products-title-bottom">{{ app()->getLocale() == 'vi' ? 'CHÈ XANH' : 'GREEN TEA' }}</span>
                </h2>
            </div>
            <div class="products-grid" id="green-tea-grid">
                @foreach ($greenProducts as $product)
                    <div class="product-card" id="product-{{ Str::afterLast($product->slug, '-') }}">
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
            <div class="products-footer">
                <a href="{{ route('products') }}" class="xem-them-link" id="btn-xem-them-green">
                    <span>{{ app()->getLocale() == 'vi' ? 'Xem thêm' : 'See more' }}</span>
                    <span class="arrow-circle">
                        <svg width="54" height="24" viewBox="-30 0 54 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <circle cx="12" cy="12" r="11.5" stroke="#108140" stroke-width="0.5" />
                            <path d="M12 6L18 12L12 18" stroke="#108140" stroke-width="0.5" />
                            <path d="M-30 12H18" stroke="#108140" stroke-width="0.5" />
                        </svg>
                    </span>
                </a>
            </div>
        </div>
    </section>

    <!-- Liên hệ Section -->
    <section class="contact" id="lien-he">
        <div class="contact-container">
            <div class="contact-info">
                <h2 class="contact-title">{{ app()->getLocale() == 'vi' ? 'Liên hệ' : 'Contact' }}</h2>
                <h3 class="contact-company">
                    {{ app()->getLocale() == 'vi' ? 'CÔNG TY TNHH CHÈ TÂN BÌNH' : 'TAN BINH TEA CO., LTD' }}</h3>
                <ul class="contact-details">
                    <li>
                        <span class="contact-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                <circle cx="12" cy="10" r="3"></circle>
                            </svg>
                        </span>
                        <span>{{ $settings['contact_address'] ?? 'Xóm Tân Bình, Xã Võ Miếu, Huyện Thanh Sơn, Tỉnh Phú Thọ' }}</span>
                    </li>
                    <li>
                        <span class="contact-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"></circle>
                                <line x1="2" y1="12" x2="22" y2="12"></line>
                                <path
                                    d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z">
                                </path>
                            </svg>
                        </span>
                        <span><a href="https://{{ $settings['contact_website'] ?? 'tanbinhteacoltd.com' }}"
                                target="_blank">{{ $settings['contact_website'] ?? 'tanbinhteacoltd.com' }}</a></span>
                    </li>
                    <li>
                        <span class="contact-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z">
                                </path>
                                <polyline points="22,6 12,13 2,6"></polyline>
                            </svg>
                        </span>
                        <span><a
                                href="mailto:{{ $settings['contact_email'] ?? 'tanbinhteacompany@gmail.com' }}">{{ $settings['contact_email'] ?? 'tanbinhteacompany@gmail.com' }}</a></span>
                    </li>
                    <li>
                        <span class="contact-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                <path
                                    d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z">
                                </path>
                            </svg>
                        </span>
                        <span><a
                                href="tel:{{ $settings['contact_phone'] ?? '+84986843666' }}">{{ $settings['contact_phone'] ?? '(+84) 986 843 666' }}</a></span>
                    </li>
                </ul>
            </div>
            <div class="contact-form-wrapper">
                <form class="contact-form" id="contact-form">
                    <input type="text" placeholder="{{ app()->getLocale() == 'vi' ? 'Họ tên' : 'Name' }}"
                        id="input-name" required>
                    <input type="email" placeholder="Email" id="input-email" required>
                    <input type="tel" placeholder="{{ app()->getLocale() == 'vi' ? 'Số điện thoại' : 'Phone' }}"
                        id="input-phone">
                    <textarea placeholder="{{ app()->getLocale() == 'vi' ? 'Lời nhắn' : 'Message' }}" id="input-message" rows="5"></textarea>
                    <button type="submit" class="btn-submit"
                        id="btn-submit">{{ app()->getLocale() == 'vi' ? 'GỬI' : 'SEND' }}</button>
                </form>
            </div>
        </div>
        <div class="contact-leaf-decoration">
            <img src="{{ asset('assets/images/common/leaf-deco-small.png') }}" alt="Lá trà trang trí nhỏ"
                class="leaf-horizontal-top">
            <img src="{{ asset('assets/images/common/leaf-deco-large.png') }}" alt="Lá trà trang trí lớn"
                class="leaf-horizontal">
        </div>
    </section>

    <!-- Lá trang trí trước footer -->
    <div class="contact-bottom-row">
        <div class="contact-bottom-leaf-decoration">
            <img src="{{ asset('assets/images/common/leaf-deco-small.png') }}" alt=""
                class="leaf-horizontal-top">
            <img src="{{ asset('assets/images/common/leaf-deco-large.png') }}" alt="" class="leaf-horizontal">
        </div>
    </div>
@endsection
