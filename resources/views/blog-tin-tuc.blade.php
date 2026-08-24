@extends('layouts.master')
@section('title', app()->getLocale() == 'vi' ? 'Tin Tức - Tân Bình Tea' : 'News - Tan Binh Tea')

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/css/blog.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/blog-tin-tuc.css') }}">
@endpush

@section('content')
    <!-- Page Banner -->
    <section class="page-banner" id="page-banner">
        <div class="page-banner-bg">
            <img src="{{ asset('assets/images/common/banner-tea-field.png') }}" alt="Đồi chè Việt Nam">
        </div>
        <div class="page-banner-content">
            <h1 class="page-banner-title">BLOG</h1>
        </div>
    </section>

    <!-- Blog Gallery Wrapper -->
    <div class="blog-gallery-wrapper">
        <!-- Lá trang trí -->
        <div class="blog-leaf-decoration">
            <img src="{{ asset('assets/images/common/leaf-vertical-top.png') }}" alt="" class="blog-leaf-top">
            <img src="{{ asset('assets/images/common/leaf-vertical-bottom.png') }}" alt="" class="blog-leaf-bottom">
        </div>

        <!-- Tin tức Section -->
        <section class="news-section">
            <!-- Lưới bài viết -->
            <div class="news-grid">
                @php
                    $fallbackImages = [
                        'news-green-tea-health.png',
                        'news-green-land.png',
                        'news-fair-2026.png',
                        'news-brew-guide.png'
                    ];
                @endphp
                @forelse($posts as $index => $post)
                    <article class="news-card">
                        <div class="news-card-image">
                            <img src="{{ $post->getFirstMediaUrl('posts') ?: asset('assets/images/blog/news/' . ($fallbackImages[$index % 4])) }}" alt="{{ is_array($post->title) ? ($post->title[app()->getLocale()] ?? $post->title['vi']) : $post->title }}">
                        </div>
                        <div class="news-card-body">
                            <div class="news-card-middle">
                                <h3 class="news-card-title">{{ is_array($post->title) ? ($post->title[app()->getLocale()] ?? $post->title['vi']) : $post->title }}</h3>
                            </div>
                            <a href="{{ route('blog.detail', $post->slug) }}" class="news-link">{{ app()->getLocale() == 'vi' ? 'Xem chi tiết' : 'Read more' }}</a>
                            <span class="news-date-badge">{{ $post->created_at->format('d/m/Y') }}</span>
                        </div>
                    </article>
                @empty
                    <article class="news-card">
                        <div class="news-card-image">
                            <img src="{{ asset('assets/images/blog/news/news-green-tea-health.png') }}" alt="Tin tức trà">
                        </div>
                        <div class="news-card-body">
                            <div class="news-card-middle">
                                <h3 class="news-card-title">Những công dụng hay của chè xanh với sức khoẻ</h3>
                            </div>
                            <a href="#" class="news-link">Xem chi tiết</a>
                            <span class="news-date-badge">27/04/2025</span>
                        </div>
                    </article>
                    <article class="news-card">
                        <div class="news-card-image">
                            <img src="{{ asset('assets/images/blog/news/news-green-land.png') }}" alt="Tin tức trà">
                        </div>
                        <div class="news-card-body">
                            <div class="news-card-middle">
                                <h3 class="news-card-title">Người đi tìm màu xanh cho đất</h3>
                            </div>
                            <a href="#" class="news-link">Xem chi tiết</a>
                            <span class="news-date-badge">20/04/2025</span>
                        </div>
                    </article>
                    <article class="news-card">
                        <div class="news-card-image">
                            <img src="{{ asset('assets/images/blog/news/news-fair-2026.png') }}" alt="Tin tức trà">
                        </div>
                        <div class="news-card-body">
                            <div class="news-card-middle">
                                <h3 class="news-card-title">Tân Bình Tea tham dự Hội chợ Nông sản Việt 2026</h3>
                            </div>
                            <a href="#" class="news-link">Xem chi tiết</a>
                            <span class="news-date-badge">15/04/2025</span>
                        </div>
                    </article>
                    <article class="news-card">
                        <div class="news-card-image">
                            <img src="{{ asset('assets/images/blog/news/news-brew-guide.png') }}" alt="Tin tức trà">
                        </div>
                        <div class="news-card-body">
                            <div class="news-card-middle">
                                <h3 class="news-card-title">Cách pha trà xanh đúng chuẩn để giữ nguyên dưỡng chất</h3>
                            </div>
                            <a href="#" class="news-link">Xem chi tiết</a>
                            <span class="news-date-badge">10/04/2025</span>
                        </div>
                    </article>
                @endforelse
            </div>

            @if($posts->hasPages())
                <div class="mt-8 flex justify-center">
                    {{ $posts->links() }}
                </div>
            @endif

            <!-- Xem thêm -->
            <div class="news-footer">
                <a href="#" class="xem-them-link">
                    <span>{{ app()->getLocale() == 'vi' ? 'Xem thêm' : 'Load more' }}</span>
                    <span class="arrow-circle">
                        <svg width="54" height="24" viewBox="-30 0 54 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="12" cy="12" r="11.5" stroke="#108140" stroke-width="0.5"/>
                            <path d="M12 6L18 12L12 18" stroke="#108140" stroke-width="0.5"/>
                            <path d="M-30 12H18" stroke="#108140" stroke-width="0.5"/>
                        </svg>
                    </span>
                </a>
            </div>
        </section>

        <!-- Lá trang trí dưới + Footer spacing -->
        <div class="blog-bottom-row">
            <div class="blog-gallery-leaf-decoration">
                <img src="{{ asset('assets/images/common/leaf-deco-small.png') }}" alt="" class="leaf-horizontal-top">
                <img src="{{ asset('assets/images/common/leaf-deco-large.png') }}" alt="" class="leaf-horizontal">
            </div>
        </div>
    </div><!-- end blog-gallery-wrapper -->
@endsection
