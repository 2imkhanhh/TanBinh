@extends('layouts.master')

@section('title', 'Hình ảnh')

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/css/blog.css') }}">
@endpush

@section('content')
    <!-- Page Banner -->
    <section class="page-banner" id="page-banner">
        <div class="page-banner-bg">
            <img src="{{ asset('assets/images/common/banner-tea-field.png') }}" alt="Đồi chè Việt Nam">
        </div>
        <div class="page-banner-content" data-aos="zoom-in" data-aos-duration="1000">
            <h1 class="page-banner-title">BLOG</h1>
        </div>
    </section>

    <!-- Blog Gallery Wrapper (gives leaf decoration a positioning context) -->
    <div class="blog-gallery-wrapper">

        <!-- Lá trang trí -->
        <div class="blog-leaf-decoration">
            <img src="{{ asset('assets/images/common/leaf-vertical-top.png') }}" alt="" class="blog-leaf-top">
            <img src="{{ asset('assets/images/common/leaf-vertical-bottom.png') }}" alt="" class="blog-leaf-bottom">
        </div>

        <!-- Blog Gallery Section -->
        <section class="blog-gallery-section">
            <div class="blog-gallery-grid">
                @php
                    $fallbackImages = [
                        'gallery-01.png',
                        'gallery-01.png', // Just repeat or loop through
                    ];
                @endphp
                @forelse($posts as $index => $post)
                    <div class="blog-gallery-item" data-aos="zoom-in-up" data-aos-delay="{{ ($index % 3) * 100 }}">
                        <img src="{{ $post->getFirstMediaUrl('posts') ?: asset('assets/images/blog/gallery/' . $fallbackImages[$index % count($fallbackImages)]) }}" alt="{{ is_array($post->title) ? ($post->title[app()->getLocale()] ?? $post->title['vi']) : $post->title }}">
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <p>{{ app()->getLocale() == 'vi' ? 'Chưa có hình ảnh nào.' : 'No images yet.' }}</p>
                    </div>
                @endforelse
            </div>
            
            <div class="pagination-wrapper mt-5">
                {{ $posts->links() }}
            </div>
        </section>

        <!-- Lá trang trí + Xem thêm -->
        <div class="blog-bottom-row">
            <div class="blog-gallery-leaf-decoration">
                <img src="{{ asset('assets/images/common/leaf-deco-small.png') }}" alt="" class="leaf-horizontal-top">
                <img src="{{ asset('assets/images/common/leaf-deco-large.png') }}" alt="" class="leaf-horizontal">
            </div>

            <div class="blog-gallery-footer">
                <a href="#" class="xem-them-link">
                    <span>{{ app()->getLocale() == 'vi' ? 'Xem thêm' : 'Load more' }}</span>
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
        </div><!-- end blog-bottom-row -->
    </div><!-- end blog-gallery-wrapper -->

    <!-- Lightbox -->
    <div class="blog-lightbox" id="blog-lightbox">
        <div class="blog-lightbox-overlay" id="blog-lightbox-overlay"></div>
        <div class="blog-lightbox-content">
            <button class="blog-lightbox-close" id="blog-lightbox-close" aria-label="Đóng">×</button>
            <img class="blog-lightbox-img" id="blog-lightbox-img" src="#" alt="">
        </div>
    </div>
@endsection