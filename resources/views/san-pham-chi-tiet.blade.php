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
    <div class="chi-tiet-breadcrumb" data-aos="fade-down">
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

            <div class="chi-tiet-gallery" data-aos="fade-right">
                <div class="chi-tiet-main-img">
                    <div class="chi-tiet-main-slider">
                        <div class="chi-tiet-main-track">
                            @php
                                $mediaItems = $product->getMedia('products')->sortBy('order_column')->values();
                                $hasMedia = count($mediaItems) > 0;
                            @endphp
                            
                            @if($hasMedia)
                                @foreach($mediaItems as $index => $media)
                                    <img src="{{ $media->getUrl() }}" alt="{{ is_array($product->name) ? ($product->name[app()->getLocale()] ?? $product->name['vi']) : $product->name }}" class="gallery-slide" id="main-product-img-{{ $index }}">
                                @endforeach
                            @else
                                <img src="{{ asset('assets/images/products/product-tea-generic.png') }}" alt="{{ is_array($product->name) ? ($product->name[app()->getLocale()] ?? $product->name['vi']) : $product->name }}" id="main-product-img">
                            @endif
                        </div>
                    </div>
                    @if($hasMedia && count($mediaItems) > 1)
                    <button class="chi-tiet-nav chi-tiet-nav-prev" aria-label="Ảnh trước">
                        <span class="nav-dot"></span>
                    </button>
                    <button class="chi-tiet-nav chi-tiet-nav-next" aria-label="Ảnh sau">
                        <span class="nav-dot"></span>
                    </button>
                    @endif
                </div>
                
                @if($hasMedia && count($mediaItems) > 1)
                <div class="chi-tiet-thumbnails">
                    @foreach($mediaItems as $index => $media)
                        <img src="{{ $media->getUrl() }}" alt="Ảnh {{ $index + 1 }}" class="chi-tiet-thumb {{ $index === 0 ? 'active' : '' }}">
                    @endforeach
                </div>
                @endif
            </div>

            <!-- Cột phải: thông tin -->
            <div class="chi-tiet-info" data-aos="fade-left">
                <h1 class="chi-tiet-name">{{ is_array($product->name) ? ($product->name[app()->getLocale()] ?? $product->name['vi']) : $product->name }}</h1>
                <p class="chi-tiet-subtitle">{{ app()->getLocale() == 'vi' ? 'Chi tiết sản phẩm' : 'Product Details' }}</p>
                <div class="chi-tiet-divider"></div>
                
                                @php
                    $locale = app()->getLocale();
                    $specs = [
                        ['label_vi' => 'Loại sản phẩm:', 'label_en' => 'Product Type:', 'val' => is_array($product->type) ? ($product->type[$locale] ?? '') : $product->type],
                        ['label_vi' => 'Kiểu:', 'label_en' => 'Style:', 'val' => is_array($product->style) ? ($product->style[$locale] ?? '') : $product->style],
                        ['label_vi' => 'Độ tuổi:', 'label_en' => 'Age:', 'val' => is_array($product->age) ? ($product->age[$locale] ?? '') : $product->age],
                        ['label_vi' => 'Phong cách:', 'label_en' => 'Drink Style:', 'val' => is_array($product->drink_style) ? ($product->drink_style[$locale] ?? '') : $product->drink_style],
                        ['label_vi' => 'Loại xử lý:', 'label_en' => 'Processing Type:', 'val' => is_array($product->processing_type) ? ($product->processing_type[$locale] ?? '') : $product->processing_type],
                        ['label_vi' => 'Bao bì:', 'label_en' => 'Packaging:', 'val' => is_array($product->packaging) ? ($product->packaging[$locale] ?? '') : $product->packaging],
                        ['label_vi' => 'Đặc sản:', 'label_en' => 'Specialty:', 'val' => is_array($product->specialty) ? ($product->specialty[$locale] ?? '') : $product->specialty],
                        ['label_vi' => 'Lớp:', 'label_en' => 'Grade:', 'val' => is_array($product->grade) ? ($product->grade[$locale] ?? '') : $product->grade],
                        ['label_vi' => 'Thời hạn sử dụng:', 'label_en' => 'Shelf Life:', 'val' => is_array($product->shelf_life) ? ($product->shelf_life[$locale] ?? '') : $product->shelf_life],
                        ['label_vi' => 'Trọng lượng:', 'label_en' => 'Weight:', 'val' => is_array($product->weight) ? ($product->weight[$locale] ?? '') : $product->weight],
                        ['label_vi' => 'Nơi xuất xứ:', 'label_en' => 'Place of Origin:', 'val' => is_array($product->origin) ? ($product->origin[$locale] ?? '') : $product->origin],
                        ['label_vi' => 'Tên thương hiệu:', 'label_en' => 'Brand Name:', 'val' => is_array($product->brand_name) ? ($product->brand_name[$locale] ?? '') : $product->brand_name],
                        ['label_vi' => 'Số mô hình:', 'label_en' => 'Model Number:', 'val' => is_array($product->model_number) ? ($product->model_number[$locale] ?? '') : $product->model_number],
                        ['label_vi' => 'Điều khoản thanh toán:', 'label_en' => 'Payment Terms:', 'val' => is_array($product->payment_terms) ? ($product->payment_terms[$locale] ?? '') : $product->payment_terms],
                        ['label_vi' => 'Lợi thế:', 'label_en' => 'Advantage:', 'val' => is_array($product->advantage) ? ($product->advantage[$locale] ?? '') : $product->advantage],
                        ['label_vi' => 'Nguồn gốc lá trà:', 'label_en' => 'Origin of Tea Leaves:', 'val' => is_array($product->leaf_origin) ? ($product->leaf_origin[$locale] ?? '') : $product->leaf_origin],
                        ['label_vi' => 'Chất liệu:', 'label_en' => 'Material:', 'val' => is_array($product->material) ? ($product->material[$locale] ?? '') : $product->material],
                    ];
                @endphp
                <table class="chi-tiet-table">
                    <tbody>
                        @foreach($specs as $spec)
                            @if(!empty($spec['val']))
                            <tr>
                                <td class="chi-tiet-label">{{ $locale == 'vi' ? $spec['label_vi'] : $spec['label_en'] }}</td>
                                <td class="chi-tiet-value">{{ $spec['val'] }}</td>
                            </tr>
                            @endif
                        @endforeach
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