<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @php
        $defaultTitle = $settings['site_title'] ?? 'Tân Bình Tea';
        $defaultDesc = isset($settings['home_about_desc']) ? Str::limit(strip_tags($settings['home_about_desc']), 150) : 'Công ty TNHH Xuất Nhập Khẩu Chè Tân Bình';
        $logoUrl = isset($settings['logo']) && $settings['logo'] ? asset($settings['logo']) : asset('assets/images/common/logo.png');
    @endphp

    <!-- ── Title & Basic SEO ── -->
    <title>@yield('title', $defaultTitle)</title>
    <meta name="description" content="@yield('meta_description', $defaultDesc)">
    <meta name="keywords" content="@yield('meta_keywords', 'Trà, Chè, Tân Bình Tea, Trà xanh, Trà đen')">
    
    @if(app()->environment('production'))
        <meta name="robots" content="index, follow">
    @else
        <meta name="robots" content="noindex, nofollow">
    @endif
    
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- ── Open Graph (Facebook, Zalo...) ── -->
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title', $defaultTitle)">
    <meta property="og:description" content="@yield('meta_description', $defaultDesc)">
    <meta property="og:image" content="@yield('og_image', $logoUrl)">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:site_name" content="{{ $defaultTitle }}">
    <meta property="og:locale" content="{{ app()->getLocale() }}">

    <!-- ── Twitter Card ── -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', $defaultTitle)">
    <meta name="twitter:description" content="@yield('meta_description', $defaultDesc)">
    <meta name="twitter:image" content="@yield('og_image', $logoUrl)">

    <!-- ── Favicon ── -->
    <link rel="shortcut icon" href="{{ $logoUrl }}">
    <link rel="apple-touch-icon" href="{{ $logoUrl }}">

    <!-- ── Schema.org JSON-LD ── -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Organization",
      "name": "{{ $defaultTitle }}",
      "url": "{{ url('/') }}",
      "logo": "{{ $logoUrl }}",
      "contactPoint": {
        "@type": "ContactPoint",
        "telephone": "{{ $settings['contact_phone'] ?? '' }}",
        "contactType": "customer service"
      },
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "{{ $settings['contact_address'] ?? '' }}",
        "addressCountry": "VN"
      }
    }
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Bodoni+Moda:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&amp;family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&amp;family=Inter:wght@300;400;500;600;700&amp;family=Noto+Serif+Display:ital,opsz,wght@0,6..36,400;0,6..36,500;0,6..36,600;0,6..36,700;1,6..36,400;1,6..36,500;1,6..36,600;1,6..36,700&amp;family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&amp;display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}?v=3">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    @stack('css')
</head>

<body>
    <!-- Header -->
    <header class="header" id="header">
        <div class="header-container">
            <a href="{{ route('home') }}" class="logo" id="logo">
                <img src="{{ isset($settings['logo']) && $settings['logo'] ? asset($settings['logo']) : asset('assets/images/common/logo2.png') }}" alt="Tân Bình Tea Logo">
            </a>
            <nav class="nav" id="main-nav">
                <ul class="nav-list">
                    <li><a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}"
                            id="nav-home">{{ app()->getLocale() == 'vi' ? 'Trang chủ' : 'Home' }}</a></li>
                    <li><a href="{{ route('about') }}"
                            class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" id="nav-about">{{ app()->getLocale() == 'vi' ? 'Giới thiệu' : 'About Us' }}</a></li>
                    <li><a href="{{ route('products') }}"
                            class="nav-link {{ request()->routeIs('products') || request()->routeIs('product.detail') ? 'active' : '' }}"
                            id="nav-products">{{ app()->getLocale() == 'vi' ? 'Sản phẩm' : 'Products' }}</a></li>
                    <li><a href="{{ route('contact') }}"
                            class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" id="nav-contact">{{ app()->getLocale() == 'vi' ? 'Liên hệ' : 'Contact' }}</a></li>
                    <li class="nav-item-dropdown">
                        <a href="{{ route('blog') }}"
                            class="nav-link {{ request()->routeIs('blog*') ? 'active' : '' }}" id="nav-blog">Blog</a>
                        <ul class="blog-dropdown">
                            <li><a href="{{ route('blog') }}" class="blog-dropdown-link">{{ app()->getLocale() == 'vi' ? 'Hình ảnh' : 'Gallery' }}</a></li>
                            <li><a href="{{ route('blog.tin-tuc') }}" class="blog-dropdown-link">{{ app()->getLocale() == 'vi' ? 'Tin tức' : 'News' }}</a></li>
                            <li><a href="{{ route('blog.khac') }}" class="blog-dropdown-link">{{ app()->getLocale() == 'vi' ? 'Khác' : 'Others' }}</a></li>
                        </ul>
                    </li>
                    <li class="lang-switch-mobile-wrapper">
                        <div class="lang-switch-mobile">
                            <a href="{{ route('lang.switch', 'vi') }}" class="lang-link {{ app()->getLocale() == 'vi' ? 'active' : '' }}">VN</a>
                            <span>/</span>
                            <a href="{{ route('lang.switch', 'en') }}" class="lang-link {{ app()->getLocale() == 'en' ? 'active' : '' }}">EN</a>
                        </div>
                    </li>
                </ul>
            </nav>
            <div class="lang-switch" id="lang-switch">
                <a href="{{ route('lang.switch', 'vi') }}"
                    class="lang-link {{ app()->getLocale() == 'vi' ? 'active' : '' }}">VN</a>
                <span>/</span>
                <a href="{{ route('lang.switch', 'en') }}"
                    class="lang-link {{ app()->getLocale() == 'en' ? 'active' : '' }}">EN</a>
            </div>
            <button class="hamburger" id="hamburger" aria-label="Menu">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </header>

    @yield('content')

    <!-- Scroll to Top -->
    @php
        $isAbout = request()->routeIs('about');
        $arrowColor = $isAbout ? '#ffffff' : '#108140';
        $arrowFill = 'none';
    @endphp
    <button class="scroll-top" id="scroll-top" aria-label="Lên đầu trang">
        <svg width="24" height="54" viewBox="0 0 24 54" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle cx="12" cy="12" r="11.5" fill="{{ $arrowFill }}" />
            <circle cx="12" cy="12" r="11.5" stroke="{{ $arrowColor }}" stroke-width="0.5" />
            <path d="M7 14L12 7L17 14" stroke="{{ $arrowColor }}" stroke-width="0.5" />
            <path d="M12 7V54" stroke="{{ $arrowColor }}" stroke-width="0.5" />
        </svg>
    </button>

    <!-- Footer -->
    <footer class="site-footer" id="site-footer">
        <div class="footer-bg-leaf">
            <img src="{{ asset('assets/images/common/leaf-footer-bg.png') }}" alt="" class="footer-leaf-img">
        </div>
        <div class="footer-container">
            <div class="footer-logo">
                <img src="{{ isset($settings['footer_logo']) && $settings['footer_logo'] ? asset($settings['footer_logo']) : asset('assets/images/common/logo.png') }}" alt="Tân Bình Tea Logo"
                    class="footer-logo-img">
            </div>
            <div class="footer-info">
                <p><span class="footer-icon"><svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                            <circle cx="12" cy="10" r="3"></circle>
                        </svg></span>{{ $settings['contact_address'] ?? 'Xóm Tân Bình, Xã Võ Miếu, Huyện Thanh Sơn, Tỉnh Phú Thọ' }}
                </p>
                <p><span class="footer-icon"><svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="2" y1="12" x2="22" y2="12"></line>
                            <path
                                d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z">
                            </path>
                        </svg></span>{{ $settings['contact_website'] ?? 'tanbinhteacoltd.com' }}</p>
                <p><span class="footer-icon"><svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z">
                            </path>
                            <polyline points="22,6 12,13 2,6"></polyline>
                        </svg></span>{{ $settings['contact_email'] ?? 'tanbinhteacompany@gmail.com' }}</p>
                <p><span class="footer-icon"><svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <path
                                d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z">
                            </path>
                        </svg></span>{{ $settings['contact_phone'] ?? '(+84) 986 843 666' }}</p>
            </div>
            <div class="footer-right">
                <div class="footer-legal">
                    <p>MST 2601039326</p>
                    <p>được Sở KH và ĐT Tỉnh Phú Thọ cấp ngày 03/02/2020</p>
                </div>
                <div class="footer-social">
                    <a href="#" aria-label="YouTube" class="social-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path
                                d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 0 0-1.94 2A29 29 0 0 0 1 11.75a29 29 0 0 0 .46 5.33A2.78 2.78 0 0 0 3.4 19c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 0 0 1.94-2 29 29 0 0 0 .46-5.25 29 29 0 0 0-.46-5.33z">
                            </path>
                            <polygon points="9.75 15.02 15.5 11.75 9.75 8.48 9.75 15.02"></polygon>
                        </svg>
                    </a>
                    <a href="#" aria-label="Facebook" class="social-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                        </svg>
                    </a>
                    <a href="#" aria-label="Instagram" class="social-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                            <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                            <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Global Toast Notification Container -->
    <div id="toast-container" class="toast-container"></div>

    <script src="{{ asset('assets/js/main.js') }}"></script>
    @stack('js')

    <!-- Toast CSS -->
    <style>
        .toast-container {
            position: fixed;
            bottom: 1.5rem;
            right: 1.5rem;
            z-index: 9999;
            display: flex;
            flex-direction: column-reverse;
            gap: 0.75rem;
            max-width: 420px;
            width: 100%;
            pointer-events: none;
        }
        
        .toast-item {
            pointer-events: auto;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 1rem 1.25rem;
            border-radius: 14px;
            background: #ffffff;
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.12), 0 4px 12px rgba(0, 0, 0, 0.06);
            overflow: hidden;
            position: relative;
            opacity: 0;
            transform: translateX(100%);
            transition: all 0.4s cubic-bezier(0.22, 1, 0.36, 1);
            font-family: 'Inter', sans-serif;
        }
        
        .toast-item.toast-visible {
            opacity: 1;
            transform: translateX(0);
        }
        
        .toast-icon {
            flex-shrink: 0;
            width: 28px;
            height: 28px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 4px;
        }
        
        .toast-item.success .toast-icon {
            background: #e6f4ea;
            color: #108140;
        }
        
        .toast-item.error .toast-icon {
            background: #fef2f2;
            color: #dc2626;
        }
        
        .toast-icon svg {
            width: 100%;
            height: 100%;
        }
        
        .toast-message {
            flex: 1;
            font-size: 0.9rem;
            font-weight: 500;
            color: #1e293b;
            line-height: 1.4;
        }
        
        .toast-close {
            flex-shrink: 0;
            background: none;
            border: none;
            color: #94a3b8;
            cursor: pointer;
            padding: 4px;
            border-radius: 6px;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .toast-close:hover {
            background: #f1f5f9;
            color: #475569;
        }
        
        .toast-close svg {
            width: 16px;
            height: 16px;
        }
        
        .toast-progress {
            position: absolute;
            bottom: 0;
            left: 0;
            height: 3px;
            animation: progress 5s linear forwards;
        }
        
        .toast-progress.success {
            background: linear-gradient(90deg, #108140, #0d6e35);
        }
        
        .toast-progress.error {
            background: linear-gradient(90deg, #f87171, #dc2626);
        }
        
        @keyframes progress {
            from {
                width: 100%;
            }
            to {
                width: 0%;
            }
        }
    </style>
    
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            AOS.init({
                duration: 800,
                once: true,
                offset: 50,
                easing: 'ease-out-cubic'
            });
        });
    </script>
</body>

</html>
