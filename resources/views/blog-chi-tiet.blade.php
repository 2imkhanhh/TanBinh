@extends('layouts.master')
@section('title', (is_array($post->title) ? ($post->title[app()->getLocale()] ?? $post->title['vi']) : $post->title) . ' - Tân Bình Tea')

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/css/blog.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/blog-tin-tuc.css') }}">
    <style>
        .blog-detail-content {
            max-width: 900px;
            margin: 0 auto;
            padding: 40px 20px;
            background: #fff;
        }
        .blog-detail-title {
            font-family: 'Playfair Display', serif;
            font-size: 32px;
            color: #108140;
            margin-bottom: 15px;
            text-align: center;
        }
        .blog-detail-meta {
            text-align: center;
            color: #666;
            margin-bottom: 30px;
            font-family: 'Inter', sans-serif;
            font-size: 14px;
        }
        .blog-detail-image {
            width: 100%;
            border-radius: 8px;
            margin-bottom: 30px;
        }
        .blog-detail-body {
            font-family: 'Inter', sans-serif;
            line-height: 1.8;
            color: #333;
            font-size: 16px;
        }
        .blog-detail-body p {
            margin-bottom: 20px;
        }
    </style>
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

    <!-- Blog Detail Wrapper -->
    <div class="blog-gallery-wrapper">
        <!-- Lá trang trí -->
        <div class="blog-leaf-decoration">
            <img src="{{ asset('assets/images/common/leaf-vertical-top.png') }}" alt="" class="blog-leaf-top">
            <img src="{{ asset('assets/images/common/leaf-vertical-bottom.png') }}" alt="" class="blog-leaf-bottom">
        </div>

        <section class="blog-detail-content">
            <h1 class="blog-detail-title">{{ is_array($post->title) ? ($post->title[app()->getLocale()] ?? $post->title['vi']) : $post->title }}</h1>
            <div class="blog-detail-meta">
                <span>{{ $post->created_at->format('d/m/Y') }}</span>
            </div>
            
            @if($post->getFirstMediaUrl('posts'))
                <img src="{{ $post->getFirstMediaUrl('posts') }}" alt="{{ is_array($post->title) ? ($post->title[app()->getLocale()] ?? $post->title['vi']) : $post->title }}" class="blog-detail-image">
            @endif

            <div class="blog-detail-body">
                @if($post->content && (is_array($post->content) ? ($post->content[app()->getLocale()] ?? '') : $post->content) != '')
                    {!! nl2br(e(is_array($post->content) ? ($post->content[app()->getLocale()] ?? $post->content['vi'] ?? '') : $post->content)) !!}
                @else
                    <p>{{ app()->getLocale() == 'vi' ? 'Nội dung đang được cập nhật.' : 'Content is being updated.' }}</p>
                @endif
            </div>
            
            <div style="text-align: center; margin-top: 40px;">
                <a href="{{ url()->previous() == url()->current() ? route('blog.tin-tuc') : url()->previous() }}" class="btn-lien-he" style="display: inline-block; padding: 10px 30px; background: #108140; color: white; border-radius: 4px; text-decoration: none;">
                    {{ app()->getLocale() == 'vi' ? 'Quay lại' : 'Go back' }}
                </a>
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
