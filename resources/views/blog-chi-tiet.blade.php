@extends('layouts.master')
@section('title', is_array($post->title) ? ($post->title[app()->getLocale()] ?? $post->title['vi']) : $post->title)

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/css/blog.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/blog-tin-tuc.css') }}">
    <style>
        .blog-detail-wrapper {
            background-color: #fafafa;
        }
        .blog-detail-content {
            max-width: 900px;
            margin: -60px auto 40px;
            padding: 50px 60px;
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 15px 50px rgba(0,0,0,0.05);
            position: relative;
            z-index: 10;
        }
        .blog-detail-title {
            font-family: 'Playfair Display', serif;
            font-size: 42px;
            color: #108140;
            margin-bottom: 20px;
            text-align: center;
            font-weight: 700;
            line-height: 1.3;
        }
        .blog-separator {
            width: 60px;
            height: 3px;
            background: #108140;
            margin: 0 auto 25px;
            border-radius: 2px;
        }
        .blog-detail-meta {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 15px;
            color: #888;
            margin-bottom: 40px;
            font-family: 'Inter', sans-serif;
            font-size: 15px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .blog-detail-meta span {
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .blog-detail-image-wrapper {
            position: relative;
            margin-bottom: 40px;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 8px 25px rgba(0,0,0,0.08);
        }
        .blog-detail-image {
            width: 100%;
            display: block;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        .blog-detail-image-wrapper:hover .blog-detail-image {
            transform: scale(1.02);
        }
        .blog-detail-body {
            font-family: 'Inter', sans-serif;
            line-height: 1.9;
            color: #444;
            font-size: 17px;
        }
        .blog-detail-body p {
            margin-bottom: 24px;
        }
        .blog-detail-body img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin: 25px 0;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            display: block;
        }
        .blog-detail-body h2, .blog-detail-body h3, .blog-detail-body h4 {
            font-family: 'Playfair Display', serif;
            color: #108140;
            margin-top: 45px;
            margin-bottom: 25px;
            font-weight: 700;
        }
        .blog-detail-body blockquote {
            border-left: 4px solid #108140;
            margin: 35px 0;
            font-style: italic;
            color: #555;
            background: #f4fbf6;
            padding: 25px;
            border-radius: 0 8px 8px 0;
            font-size: 18px;
        }
        .blog-detail-body ul, .blog-detail-body ol {
            margin-bottom: 24px;
            padding-left: 20px;
        }
        .blog-detail-body li {
            margin-bottom: 12px;
        }
        
        @media (max-width: 768px) {
            .blog-detail-content {
                margin: -40px 15px 40px;
                padding: 35px 20px;
                border-radius: 12px;
            }
            .blog-detail-title {
                font-size: 30px;
            }
            .blog-detail-body {
                font-size: 16px;
            }
        }
    </style>
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

    <!-- Blog Detail Wrapper -->
    <div class="blog-gallery-wrapper blog-detail-wrapper">
        <!-- Lá trang trí -->
        <div class="blog-leaf-decoration">
            <img src="{{ asset('assets/images/common/leaf-vertical-top.png') }}" alt="" class="blog-leaf-top">
            <img src="{{ asset('assets/images/common/leaf-vertical-bottom.png') }}" alt="" class="blog-leaf-bottom">
        </div>

        <section class="blog-detail-content" data-aos="fade-up">
            <h1 class="blog-detail-title">{{ is_array($post->title) ? ($post->title[app()->getLocale()] ?? $post->title['vi']) : $post->title }}</h1>
            <div class="blog-separator"></div>
            <div class="blog-detail-meta">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                    {{ $post->created_at->format('d/m/Y') }}
                </span>
            </div>
            
            @if($post->getFirstMediaUrl('posts'))
                <div class="blog-detail-image-wrapper" data-aos="fade-up" data-aos-delay="200">
                    <img src="{{ $post->getFirstMediaUrl('posts') }}" alt="{{ is_array($post->title) ? ($post->title[app()->getLocale()] ?? $post->title['vi']) : $post->title }}" class="blog-detail-image">
                </div>
            @endif

            <div class="blog-detail-body" data-aos="fade-up" data-aos-delay="300">
                @if($post->content && (is_array($post->content) ? ($post->content[app()->getLocale()] ?? '') : $post->content) != '')
                    {!! is_array($post->content) ? ($post->content[app()->getLocale()] ?? $post->content['vi'] ?? '') : $post->content !!}
                @else
                    <p>{{ app()->getLocale() == 'vi' ? 'Nội dung đang được cập nhật.' : 'Content is being updated.' }}</p>
                @endif
            </div>
        </section>

        <!-- Lá trang trí dưới -->
        <div class="blog-bottom-row">
            <div class="blog-gallery-leaf-decoration">
                <img src="{{ asset('assets/images/common/leaf-deco-small.png') }}" alt="" class="leaf-horizontal-top">
                <img src="{{ asset('assets/images/common/leaf-deco-large.png') }}" alt="" class="leaf-horizontal">
            </div>
        </div>
    </div>
@endsection
