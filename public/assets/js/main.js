// =============================================
// Tân Bình Tea - Main JavaScript
// =============================================

document.addEventListener('DOMContentLoaded', () => {

    // =========================================
    // Elements (null-safe)
    // =========================================
    const header       = document.getElementById('header');
    const hamburger    = document.getElementById('hamburger');
    const nav          = document.getElementById('main-nav');
    const navLinks     = document.querySelectorAll('.nav-link');
    const scrollTopBtn = document.getElementById('scroll-top');
    const contactForm  = document.getElementById('contact-form');
    const footer       = document.querySelector('.site-footer');

    // =========================================
    // Header — scroll shadow + hide-on-scroll-down
    // =========================================
    let lastScrollY = 0;
    let ticking = false;

    function onScroll() {
        if (!ticking) {
            requestAnimationFrame(handleScroll);
            ticking = true;
        }
    }

    function handleScroll() {
        const currentY = window.scrollY;

        // Shadow on scroll
        if (header) {
            header.classList.toggle('scrolled', currentY > 50);
        }

        // Scroll-to-top visibility
        if (scrollTopBtn) {
            scrollTopBtn.classList.toggle('visible', currentY > 500);

            // Keep button above footer and add extra spacing on mobile
            if (footer) {
                const footerTop = footer.getBoundingClientRect().top;
                const wh = window.innerHeight;
                const mobileExtraGap = window.innerWidth <= 768 ? 74 : 0;
                if (footerTop < wh) {
                    scrollTopBtn.style.bottom = (wh - footerTop + 20 + mobileExtraGap) + 'px';
                } else {
                    scrollTopBtn.style.bottom = '';
                }
            }
        }

        lastScrollY = currentY;
        ticking = false;
    }

    window.addEventListener('scroll', onScroll, { passive: true });

    // =========================================
    // Scroll-to-top button
    // =========================================
    if (scrollTopBtn) {
        scrollTopBtn.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }

    // =========================================
    // Mobile hamburger
    // =========================================
    if (hamburger && nav) {
        hamburger.addEventListener('click', () => {
            const isOpen = hamburger.classList.toggle('active');
            nav.classList.toggle('active', isOpen);
            // Prevent body scroll when menu is open
            document.body.style.overflow = isOpen ? 'hidden' : '';
        });

        // Close on nav link click (but not on Blog dropdown trigger)
        navLinks.forEach(link => {
            const parent = link.parentElement;
            const isDropdown = parent && parent.classList.contains('nav-item-dropdown');
            
            // Only close menu if it's NOT a dropdown link
            if (!isDropdown) {
                link.addEventListener('click', () => {
                    hamburger.classList.remove('active');
                    nav.classList.remove('active');
                    document.body.style.overflow = '';
                });
            }
        });

        // Close on outside click
        document.addEventListener('click', (e) => {
            if (
                nav.classList.contains('active') &&
                !nav.contains(e.target) &&
                !hamburger.contains(e.target)
            ) {
                hamburger.classList.remove('active');
                nav.classList.remove('active');
                document.body.style.overflow = '';
            }
        });
    }

    // =========================================
    // Blog dropdown — mobile touch support
    // =========================================
    const dropdownItems = document.querySelectorAll('.nav-item-dropdown');
    dropdownItems.forEach(item => {
        const link = item.querySelector('.nav-link');
        const dropdownLinks = item.querySelectorAll('.blog-dropdown-link');
        if (!link) return;

        // Click "Blog" link to toggle dropdown on mobile
        link.addEventListener('click', (e) => {
            if (window.innerWidth <= 768) {
                e.preventDefault();
                // If dropdown is already open, close it; otherwise open it
                if (item.classList.contains('active')) {
                    item.classList.remove('active');
                } else {
                    item.classList.add('active');
                }
            }
        });

        // Close dropdown + hamburger menu when clicking on a dropdown link (mobile only)
        dropdownLinks.forEach(linkItem => {
            linkItem.addEventListener('click', () => {
                if (window.innerWidth <= 768) {
                    item.classList.remove('active');
                    // Close hamburger menu too
                    const hamburger = document.getElementById('hamburger');
                    const nav = document.getElementById('main-nav');
                    if (hamburger && nav) {
                        hamburger.classList.remove('active');
                        nav.classList.remove('active');
                        document.body.style.overflow = '';
                    }
                }
            });
        });
    });

    // =========================================
    // Active nav link highlight (URL based) - handled by Laravel Blade
    // =========================================
    /*
    const currentPath = window.location.pathname;
    navLinks.forEach(link => {
        const href = link.getAttribute('href');
        if (href === currentPath || (href !== '/' && currentPath.startsWith(href))) {
            link.classList.add('active');
        } else {
            link.classList.remove('active');
        }
    });
    */

    // =========================================
    // Smooth scroll for internal anchor links
    // =========================================
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const targetId = this.getAttribute('href');
            if (targetId === '#') return;
            const targetEl = document.querySelector(targetId);
            if (!targetEl) return;
            e.preventDefault();
            const headerH = parseInt(
                getComputedStyle(document.documentElement)
                    .getPropertyValue('--header-height')
            ) || 70;
            const top = targetEl.getBoundingClientRect().top + window.scrollY - headerH;
            window.scrollTo({ top, behavior: 'smooth' });
        });
    });

    // =========================================
    // Scroll-reveal animations (IntersectionObserver)
    // =========================================
    function addAnimationClasses() {
        // Intro section
        const introImage = document.querySelector('.intro-image');
        const introTitle = document.querySelector('.intro-title');
        const introDesc  = document.querySelector('.intro-desc');

        if (introImage) introImage.classList.add('fade-in-up');
        if (introTitle) introTitle.classList.add('fade-in-up');
        if (introDesc)  introDesc.classList.add('fade-in-up');

        // Products headers
        document.querySelectorAll('.products-header').forEach(el => {
            el.classList.add('fade-in-up');
        });

        // Product cards — staggered
        document.querySelectorAll('.product-card').forEach((card, i) => {
            card.classList.add('fade-in-up');
            card.style.transitionDelay = (i * 0.08) + 's';
        });

        // About sections
        document.querySelectorAll('.about-split-left').forEach(el => el.classList.add('fade-in-left'));
        document.querySelectorAll('.about-split-right').forEach(el => el.classList.add('fade-in-right'));
        document.querySelectorAll('.about-image-section-left').forEach(el => el.classList.add('fade-in-left'));
        document.querySelectorAll('.about-image-section-right').forEach(el => el.classList.add('fade-in-right'));
        document.querySelectorAll('.about-bar-content').forEach(el => el.classList.add('fade-in-up'));

        // Contact section
        const contactInfo = document.querySelector('.contact-info');
        const contactWrap = document.querySelector('.contact-form-wrapper');
        if (contactInfo) contactInfo.classList.add('fade-in-left');
        if (contactWrap) contactWrap.classList.add('fade-in-right');

        // Blog / news cards — staggered
        document.querySelectorAll('.blog-gallery-item, .news-card').forEach((el, i) => {
            el.classList.add('fade-in-up');
            el.style.transitionDelay = (i * 0.06) + 's';
        });

        // Chi tiết product
        const chiTietGallery = document.querySelector('.chi-tiet-gallery');
        const chiTietInfo    = document.querySelector('.chi-tiet-info');
        if (chiTietGallery) chiTietGallery.classList.add('fade-in-left');
        if (chiTietInfo)    chiTietInfo.classList.add('fade-in-right');
    }

    addAnimationClasses();

    // Reduced-motion check
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                if (prefersReducedMotion) {
                    // Skip animation, just make visible immediately
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'none';
                } else {
                    // Add will-change before animation for better performance
                    entry.target.style.willChange = 'opacity, transform';
                    entry.target.classList.add('visible');
                }
                observer.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.08,
        rootMargin: '0px 0px -40px 0px'
    });

    document.querySelectorAll('.fade-in-up, .fade-in-left, .fade-in-right').forEach(el => {
        observer.observe(el);
    });

    // =========================================
    // Hero parallax (RAF-throttled)
    // =========================================
    const heroBgImg = document.querySelector('.hero-bg img');
    if (heroBgImg && !prefersReducedMotion) {
        let parallaxTicking = false;

        window.addEventListener('scroll', () => {
            if (!parallaxTicking) {
                requestAnimationFrame(() => {
                    const heroEl = document.querySelector('.hero');
                    if (!heroEl) { parallaxTicking = false; return; }
                    const scrolled = window.scrollY;
                    const heroBottom = heroEl.offsetTop + heroEl.offsetHeight;
                    if (scrolled < heroBottom) {
                        heroBgImg.style.transform = `translateY(${scrolled * 0.25}px)`;
                    }
                    parallaxTicking = false;
                });
                parallaxTicking = true;
            }
        }, { passive: true });
    }

    // =========================================
    // Contact form handler
    // =========================================
    // Global showToast function
    window.showToast = function(message, type = 'success') {
        const toastContainer = document.getElementById('toast-container');
        if (!toastContainer) return;
        
        const toast = document.createElement('div');
        toast.className = `toast-item ${type}`;
        
        const iconSvg = type === 'success' 
            ? '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>'
            : '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>';

        toast.innerHTML = `
            <div class="toast-icon">${iconSvg}</div>
            <span class="toast-message">${message}</span>
            <button class="toast-close" onclick="this.parentElement.classList.remove('toast-visible'); setTimeout(() => this.parentElement.remove(), 400);">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
            <div class="toast-progress ${type}"></div>
        `;
        
        toastContainer.prepend(toast);
        
        // Trigger animation
        setTimeout(() => toast.classList.add('toast-visible'), 50);
        
        // Remove after 5s to match CSS animation
        setTimeout(() => {
            toast.classList.remove('toast-visible');
            setTimeout(() => toast.remove(), 400);
        }, 5000);
    };

    if (contactForm) {
        contactForm.addEventListener('submit', (e) => {
            e.preventDefault();

            const nameEl    = document.getElementById('input-name');
            const emailEl   = document.getElementById('input-email');
            const submitBtn = document.getElementById('btn-submit');

            const name  = nameEl  ? nameEl.value.trim()  : '';
            const email = emailEl ? emailEl.value.trim() : '';

            if (!name || !email) {
                window.showToast('Vui lòng nhập họ tên và email.', 'error');
                return;
            }

            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                window.showToast('Vui lòng nhập email hợp lệ.', 'error');
                return;
            }

            let originalText = 'GỬI';
            if (submitBtn) {
                originalText = submitBtn.textContent;
                submitBtn.textContent = (originalText.trim() === 'SEND') ? 'SENDING...' : 'ĐANG GỬI...';
                submitBtn.disabled = true;
            }

            const formData = new FormData(contactForm);
            
            fetch(contactForm.getAttribute('action') || '/lien-he', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => {
                if (!response.ok) throw new Error('Network error');
                return response.json();
            })
            .then(data => {
                if (data.type === 'success') {
                    window.showToast(data.message, 'success');
                    contactForm.reset();
                } else {
                    window.showToast(data.message || 'Có lỗi xảy ra, vui lòng thử lại.', 'error');
                }
            })
            .catch(error => {
                window.showToast('Có lỗi xảy ra, vui lòng thử lại sau.', 'error');
                console.error('Error:', error);
            })
            .finally(() => {
                if (submitBtn) {
                    submitBtn.textContent = originalText;
                    submitBtn.disabled = false;
                }
            });
        });
    }

    // =========================================
    // Header height CSS variable update on resize
    // =========================================
    function updateHeaderHeight() {
        if (header) {
            document.documentElement.style.setProperty(
                '--header-height',
                header.offsetHeight + 'px'
            );
        }
    }

    updateHeaderHeight();
    window.addEventListener('resize', updateHeaderHeight, { passive: true });

});

// =============================================
// Blog Lightbox
// =============================================
(function () {
    const lightbox = document.getElementById('blog-lightbox');
    if (!lightbox) return;

    const lightboxImg = document.getElementById('blog-lightbox-img');
    const closeBtn    = document.getElementById('blog-lightbox-close');
    const overlay     = document.getElementById('blog-lightbox-overlay');

    document.querySelectorAll('.blog-gallery-item img').forEach(function (img) {
        img.style.cursor = 'pointer';
        img.addEventListener('click', function () {
            if (!lightboxImg) return;
            lightboxImg.src = img.src;
            lightboxImg.alt = img.alt;
            lightbox.classList.add('active');
            document.body.style.overflow = 'hidden';
        });
    });

    function closeLightbox() {
        lightbox.classList.remove('active');
        document.body.style.overflow = '';
    }

    if (closeBtn)  closeBtn.addEventListener('click', closeLightbox);
    if (overlay)   overlay.addEventListener('click', closeLightbox);

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') closeLightbox();
    });
})();

// =============================================
// Product detail — thumbnail switcher + sliding gallery
// =============================================
(function () {
    const slider = document.querySelector('.chi-tiet-main-track');
    const slides = slider ? slider.querySelectorAll('img') : [];
    const thumbs = document.querySelectorAll('.chi-tiet-thumb');
    const prevBtn = document.querySelector('.chi-tiet-nav-prev');
    const nextBtn = document.querySelector('.chi-tiet-nav-next');

    if (!slider || !slides.length || !thumbs.length) return;

    let currentIndex = 0;
    let autoSlideTimer = null;

    function updateGallery(index) {
        currentIndex = (index + slides.length) % slides.length;
        slider.style.transform = `translateX(-${currentIndex * 100}%)`;

        thumbs.forEach((thumb, thumbIndex) => {
            thumb.classList.toggle('active', thumbIndex === currentIndex);
        });
    }

    function startAutoSlide() {
        clearInterval(autoSlideTimer);
        autoSlideTimer = setInterval(() => {
            updateGallery(currentIndex + 1);
        }, 2800);
    }

    prevBtn && prevBtn.addEventListener('click', () => {
        updateGallery(currentIndex - 1);
        startAutoSlide();
    });

    nextBtn && nextBtn.addEventListener('click', () => {
        updateGallery(currentIndex + 1);
        startAutoSlide();
    });

    thumbs.forEach((thumb, index) => {
        thumb.addEventListener('click', () => {
            updateGallery(index);
            startAutoSlide();
        });
    });

    const gallery = document.querySelector('.chi-tiet-main-img');
    gallery && gallery.addEventListener('mouseenter', () => clearInterval(autoSlideTimer));
    gallery && gallery.addEventListener('mouseleave', startAutoSlide);

    updateGallery(0);
    startAutoSlide();
})();

document.addEventListener("DOMContentLoaded", function () {
    const denButton = document.querySelector(".products-title-den");
    const xanhButton = document.querySelector(".products-title-xanh");

    const denSection = document.getElementById("san-pham-den");
    const xanhSection = document.getElementById("san-pham-xanh");

    if (!denButton || !xanhButton || !denSection || !xanhSection) {
        return;
    }

    function showCategory(category) {
        const isDen = category === "den";

        denButton.classList.toggle("active", isDen);
        xanhButton.classList.toggle("active", !isDen);

        denButton.setAttribute("aria-selected", isDen);
        xanhButton.setAttribute("aria-selected", !isDen);

        denSection.classList.toggle(
            "products-category-hidden",
            !isDen
        );

        xanhSection.classList.toggle(
            "products-category-hidden",
            isDen
        );
    }

    denButton.addEventListener("click", function () {
        showCategory("den");
    });

    xanhButton.addEventListener("click", function () {
        showCategory("xanh");
    });

    // Mặc định: CHÈ ĐEN
    showCategory("den");
});