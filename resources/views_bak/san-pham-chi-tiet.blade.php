<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Chi tiết sản phẩm chè Tân Bình Tea.">
    <title>Chi tiết sản phẩm - Tân Bình Tea</title>
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&amp;family=Inter:wght@300;400;500;600;700&amp;family=Noto+Serif+Display:ital,opsz,wght@0,6..36,400;0,6..36,500;0,6..36,600;0,6..36,700;1,6..36,400;1,6..36,500;1,6..36,600;1,6..36,700&amp;family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&amp;display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/san-pham-chi-tiet.css">
</head>

<body>
    <!-- Header -->
    <header class="header" id="header">
        <div class="header-container">
            <a href="/" class="logo" id="logo">
                <img src="assets/images/common/logo.png" alt="Tân Bình Tea Logo">
                <span class="logo-text">TAN BINH TEA</span>
            </a>
            <nav class="nav" id="main-nav">
                <ul class="nav-list">
                    <li><a href="/" class="nav-link" id="nav-home">Trang chủ</a></li>
                    <li><a href="/gioi-thieu" class="nav-link" id="nav-about">Giới thiệu</a></li>
                    <li><a href="/san-pham" class="nav-link active" id="nav-products">Sản phẩm</a></li>
                    <li><a href="/lien-he" class="nav-link" id="nav-contact">Liên hệ</a></li>
                    <li class="nav-item-dropdown">
                        <a href="/blog" class="nav-link" id="nav-blog">Blog</a>
                        <ul class="blog-dropdown">
                            <li><a href="/blog" class="blog-dropdown-link">Hình ảnh</a></li>
                            <li><a href="/blog-tin-tuc" class="blog-dropdown-link">Tin tức</a></li>
                            <li><a href="/blog-khac" class="blog-dropdown-link">Khác</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
            <div class="lang-switch" id="lang-switch">
                <a href="#" class="lang-link active">VN</a>
                <span>/</span>
                <a href="#" class="lang-link">EN</a>
            </div>
            <button class="hamburger" id="hamburger" aria-label="Menu">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </header>

    <!-- Page Banner -->
    <section class="page-banner" id="page-banner">
        <div class="page-banner-bg">
            <img src="assets/images/common/banner-tea-field.png" alt="Đồi chè Việt Nam">
        </div>
    </section>

    <!-- Breadcrumb / Back -->
    <div class="chi-tiet-breadcrumb">
        <a href="/san-pham" class="chi-tiet-back">
            <span class="arrow-circle">
                <svg width="120" height="36" viewBox="-35 0 90 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="12" cy="12" r="11.5" stroke="#108140" stroke-width="0.5" />
                    <path d="M12 6L6 12L12 18" stroke="#108140" stroke-width="0.5" />
                    <path d="M54 12H6" stroke="#108140" stroke-width="0.5" />
                </svg>
            </span>
        </a>
        <h2 class="chi-tiet-category">CHÈ ĐEN</h2>
    </div>

    <!-- Chi tiết sản phẩm -->
    <section class="chi-tiet-section">
        <div class="chi-tiet-container">

            <!-- Cột trái: ảnh -->
            <div class="chi-tiet-gallery">
                <div class="chi-tiet-main-img">
                    <div class="chi-tiet-main-slider">
                        <div class="chi-tiet-main-track">
                            <img src="assets/images/products/product-black-tea-pekoe.png" alt="Vietnam Black Tea: Pekoe" id="main-product-img">
                            <img src="assets/images/products/product-tea-generic.png" alt="Vietnam Black Tea: chi tiết" class="gallery-slide">
                            <img src="assets/images/products/product-black-tea-pekoe.png" alt="Vietnam Black Tea: phom" class="gallery-slide">
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
                    <img src="assets/images/products/product-black-tea-pekoe.png" alt="Ảnh 1" class="chi-tiet-thumb active">
                    <img src="assets/images/products/product-tea-generic.png" alt="Ảnh 2" class="chi-tiet-thumb">
                    <img src="assets/images/products/product-black-tea-pekoe.png" alt="Ảnh 3" class="chi-tiet-thumb">
                </div>
            </div>

            <!-- Cột phải: thông tin -->
            <div class="chi-tiet-info">
                <h1 class="chi-tiet-name">Vietnam Black Tea: Pekoe</h1>
                <p class="chi-tiet-subtitle">Chi tiết sản phẩm</p>
                <div class="chi-tiet-divider"></div>
                <table class="chi-tiet-table">
                    <tbody>
                        <tr>
                            <td class="chi-tiet-label">Loại sản phẩm:</td>
                            <td class="chi-tiet-value">Chè đen</td>
                        </tr>
                        <tr>
                            <td class="chi-tiet-label">Kiểu:</td>
                            <td class="chi-tiet-value">Chính thống</td>
                        </tr>
                        <tr>
                            <td class="chi-tiet-label">Độ tuổi:</td>
                            <td class="chi-tiet-value">1-2 tuổi</td>
                        </tr>
                        <tr>
                            <td class="chi-tiet-label">Phong cách:</td>
                            <td class="chi-tiet-value">Đồ uống trà</td>
                        </tr>
                        <tr>
                            <td class="chi-tiet-label">Loại xử lý:</td>
                            <td class="chi-tiet-value">Nguyên</td>
                        </tr>
                        <tr>
                            <td class="chi-tiet-label">Bao bì:</td>
                            <td class="chi-tiet-value">Túi, Hộp, Số lượng lớn, Đóng gói quà tặng, Gói chân không</td>
                        </tr>
                        <tr>
                            <td class="chi-tiet-label">Đặc sản:</td>
                            <td class="chi-tiet-value">Trà sức khỏe, Trà hữu cơ, Trà giảm béo, Trà xanh</td>
                        </tr>
                        <tr>
                            <td class="chi-tiet-label">Lớp:</td>
                            <td class="chi-tiet-value">Chất lượng cao</td>
                        </tr>
                        <tr>
                            <td class="chi-tiet-label">Thời hạn sử dụng:</td>
                            <td class="chi-tiet-value">3 năm</td>
                        </tr>
                        <tr>
                            <td class="chi-tiet-label">Trọng lượng:</td>
                            <td class="chi-tiet-value">40</td>
                        </tr>
                        <tr>
                            <td class="chi-tiet-label">Nơi xuất xứ:</td>
                            <td class="chi-tiet-value">vùng núi cao Việt Nam</td>
                        </tr>
                        <tr>
                            <td class="chi-tiet-label">Tên thương hiệu:</td>
                            <td class="chi-tiet-value">Trà Nam Giang</td>
                        </tr>
                        <tr>
                            <td class="chi-tiet-label">Số mô hình:</td>
                            <td class="chi-tiet-value">NGGBPS</td>
                        </tr>
                        <tr>
                            <td class="chi-tiet-label">Điều khoản thanh toán:</td>
                            <td class="chi-tiet-value">đặt cọc 30%, số dư so với biên sao tải liệu được quét</td>
                        </tr>
                        <tr>
                            <td class="chi-tiet-label">Lợi thế:</td>
                            <td class="chi-tiet-value">Nhà máy</td>
                        </tr>
                        <tr>
                            <td class="chi-tiet-label">Nguồn gốc lá trà:</td>
                            <td class="chi-tiet-value">Đồn điền trà hữu cơ Việt Nam</td>
                        </tr>
                        <tr>
                            <td class="chi-tiet-label">Chất liệu:</td>
                            <td class="chi-tiet-value">Lá trà xanh tươi</td>
                        </tr>
                    </tbody>
                </table>
                <div class="chi-tiet-divider-down"></div>
                <div class="chi-tiet-actions">
                    <a href="/lien-he" class="btn-lien-he">LIÊN HỆ</a>
                </div>
            </div>

        </div>
    </section>

    <!-- Scroll to Top -->
    <button class="scroll-top" id="scroll-top" aria-label="Lên đầu trang">
        <svg width="24" height="54" viewBox="0 0 24 54" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle cx="12" cy="12" r="11.5" fill="rgba(255,255,255,0.3)"/>
            <circle cx="12" cy="12" r="11.5" stroke="#108140" stroke-width="0.5" />
            <path d="M7 14L12 7L17 14" stroke="#108140" stroke-width="0.5" />
            <path d="M12 7V54" stroke="#108140" stroke-width="0.5" />
        </svg>
    </button>

    <!-- Footer -->
    <footer class="site-footer" id="site-footer">
        <div class="footer-bg-leaf">
            <img src="assets/images/common/leaf-footer-bg.png" alt="" class="footer-leaf-img">
        </div>
        <div class="footer-container">
            <div class="footer-logo">
                <img src="assets/images/common/logo.png" alt="Tân Bình Tea Logo" class="footer-logo-img">
                <span class="footer-logo-text">TAN BINH TEA</span>
            </div>
                                    <div class="footer-info">
                <p><span class="footer-icon"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg></span>Xóm Tân Bình, Xã Võ Miếu, Huyện Thanh Sơn, Tỉnh Phú Thọ</p>
                <p><span class="footer-icon"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg></span>tanbinhteacoltd.com</p>
                <p><span class="footer-icon"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg></span>tanbinhteacompany@gmail.com</p>
                <p><span class="footer-icon"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg></span>(+84) 986 843 666</p>
            </div>
            <div class="footer-right">
                <div class="footer-legal">
                    <p>MST 2601039326</p>
                    <p>được Sở KH và ĐT Tỉnh Phú Thọ cấp ngày 03/02/2020</p>
                </div>
                                <div class="footer-social">
                    <a href="#" aria-label="YouTube" class="social-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 0 0-1.94 2A29 29 0 0 0 1 11.75a29 29 0 0 0 .46 5.33A2.78 2.78 0 0 0 3.4 19c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 0 0 1.94-2 29 29 0 0 0 .46-5.25 29 29 0 0 0-.46-5.33z"></path><polygon points="9.75 15.02 15.5 11.75 9.75 8.48 9.75 15.02"></polygon></svg>
                    </a>
                    <a href="#" aria-label="Facebook" class="social-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>
                    </a>
                    <a href="#" aria-label="Instagram" class="social-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <script src="assets/js/main.js"></script>
</body>


</html>