<script setup>
import { Link, usePage } from '@inertiajs/vue3';

const isActive = (routePattern) => {
    return usePage().url.startsWith(routePattern);
};
</script>

<template>
    <aside class="sidebar">
        <div class="sidebar-header">
            <img src="/assets/images/common/logo2.png" alt="Logo" class="logo" />
        </div>

        <nav class="sidebar-nav">
            <Link :href="route('dashboard')" class="nav-item" :class="{ active: isActive('/dashboard') }">
                <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="3" width="7" height="7"></rect>
                    <rect x="14" y="3" width="7" height="7"></rect>
                    <rect x="14" y="14" width="7" height="7"></rect>
                    <rect x="3" y="14" width="7" height="7"></rect>
                </svg>
                Dashboard
            </Link>

            <Link :href="route('admin.categories.index')" class="nav-item"
                :class="{ active: isActive('/admin/categories') }">
                <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polygon points="12 2 2 7 12 12 22 7 12 2"></polygon>
                    <polyline points="2 17 12 22 22 17"></polyline>
                    <polyline points="2 12 12 17 22 12"></polyline>
                </svg>
                Danh mục
            </Link>

            <Link :href="route('admin.products.index')" class="nav-item"
                :class="{ active: isActive('/admin/products') }">
                <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="16.5" y1="9.4" x2="7.5" y2="4.21"></line>
                    <path
                        d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z">
                    </path>
                    <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                    <line x1="12" y1="22.08" x2="12" y2="12"></line>
                </svg>
                Sản phẩm
            </Link>

            <Link :href="route('admin.posts.index')" class="nav-item" :class="{ active: isActive('/admin/posts') }">
                <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                    <polyline points="14 2 14 8 20 8"></polyline>
                    <line x1="16" y1="13" x2="8" y2="13"></line>
                    <line x1="16" y1="17" x2="8" y2="17"></line>
                    <polyline points="10 9 9 9 8 9"></polyline>
                </svg>
                Bài viết
            </Link>

            <Link :href="route('admin.contacts.index')" class="nav-item"
                :class="{ active: isActive('/admin/contacts') }">
                <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path
                        d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z">
                    </path>
                </svg>
                Liên hệ
            </Link>

            <Link :href="route('admin.settings.email')" class="nav-item"
                :class="{ active: isActive('/admin/email-settings') }">
                <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                    <polyline points="22,6 12,13 2,6"></polyline>
                </svg>
                Email
            </Link>

            <Link :href="route('admin.settings.index')" class="nav-item"
                :class="{ active: isActive('/admin/settings') }">
                <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                    <line x1="3" y1="9" x2="21" y2="9"></line>
                    <line x1="9" y1="21" x2="9" y2="9"></line>
                </svg>
                Nội dung
            </Link>
        </nav>
    </aside>
</template>

<style scoped>
.sidebar {
    width: 260px;
    height: 100vh;
    background: #ffffff;
    border-right: 1px solid #e2e8f0;
    display: flex;
    flex-direction: column;
    position: fixed;
    top: 0;
    left: 0;
    z-index: 100;
}

.sidebar-header {
    height: 80px;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0.75rem 1.5rem;
    border-bottom: 1px solid #f1f5f9;
}

.logo {
    width: auto;
    height: 55px;
    object-fit: contain;
}

.brand-name {
    font-size: 0.75rem;
    font-weight: 600;
    color: #038d0d;
    letter-spacing: 1px;
    text-transform: uppercase;
    white-space: nowrap;
}

.sidebar-nav {
    padding: 1.5rem 1rem;
    flex: 1;
    overflow-y: auto;
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.nav-item {
    display: flex;
    align-items: center;
    padding: 0.75rem 1rem;
    color: #64748b;
    text-decoration: none;
    border-radius: 12px;
    font-size: 0.95rem;
    font-weight: 500;
    transition: all 0.2s ease;
}

.nav-item:hover {
    background: #f8fafc;
    color: #0f172a;
}

.nav-item.active {
    background: #e6f4ea;
    color: #108140;
}

.nav-item .icon {
    width: 20px;
    height: 20px;
    margin-right: 12px;
    opacity: 0.8;
}

.sidebar-footer {
    padding: 1rem;
    border-top: 1px solid #f1f5f9;
}
</style>
