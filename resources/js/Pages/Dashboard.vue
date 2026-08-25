<script setup>
import { Head, Link } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';

defineOptions({ layout: AdminLayout });

defineProps({
    stats: {
        type: Object,
        default: () => ({
            products: 0,
            posts: 0,
            contacts: 0
        })
    },
    recentContacts: {
        type: Array,
        default: () => []
    }
});
</script>

<template>

    <Head title="Admin Dashboard" />

    <div class="page-header">
        <div>
            <h1 class="title">Tổng quan</h1>
            <p class="subtitle">Chào mừng bạn trở lại với trang quản trị Tân Bình.</p>
        </div>
    </div>

    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon bg-green-light">
                <svg viewBox="0 0 24 24" fill="none" stroke="#108140" stroke-width="2">
                    <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path>
                </svg>
            </div>
            <div class="stat-info">
                <h3>Sản phẩm</h3>
                <p class="value">{{ stats.products }}</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon bg-blue-light">
                <svg viewBox="0 0 24 24" fill="none" stroke="#0ea5e9" stroke-width="2">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                    <polyline points="14 2 14 8 20 8"></polyline>
                </svg>
            </div>
            <div class="stat-info">
                <h3>Bài viết</h3>
                <p class="value">{{ stats.posts }}</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon bg-purple-light">
                <svg viewBox="0 0 24 24" fill="none" stroke="#8b5cf6" stroke-width="2">
                    <path
                        d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z">
                    </path>
                </svg>
            </div>
            <div class="stat-info">
                <h3>Liên hệ</h3>
                <p class="value">{{ stats.contacts }}</p>
            </div>
        </div>
    </div>

    <div class="recent-section">
        <div class="card">
            <div class="card-header">
                <h2>Liên hệ gần đây</h2>
                <Link href="#" class="btn-link">Xem tất cả</Link>
            </div>
            <div class="card-body" v-if="recentContacts && recentContacts.length > 0">
                <div class="table-responsive">
                    <table class="table-dashboard">
                        <thead>
                            <tr>
                                <th>Họ & tên</th>
                                <th>Email</th>
                                <th>Nội dung</th>
                                <th>Thời gian</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="contact in recentContacts" :key="contact.id">
                                <td class="font-medium">{{ contact.fullname }}</td>
                                <td>{{ contact.email }}</td>
                                <td class="text-truncate" :title="contact.content">{{ contact.content }}</td>
                                <td>{{ new Date(contact.created_at).toLocaleDateString('vi-VN') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-body empty-state" v-else>
                <img src="https://illustrations.popsy.co/amber/freelancer.svg" alt="Empty" class="empty-img" />
                <p>Chưa có liên hệ mới nào trong hôm nay.</p>
            </div>
        </div>
    </div>
</template>

<style scoped>
.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.stat-card {
    background: #ffffff;
    border-radius: 16px;
    padding: 1.5rem;
    display: flex;
    align-items: flex-start;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    border: 1px solid #f1f5f9;
    position: relative;
    overflow: hidden;
    transition: transform 0.2s, box-shadow 0.2s;
}

.stat-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05);
}

.stat-icon {
    width: 48px;
    height: 48px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 1rem;
}

.stat-icon svg {
    width: 24px;
    height: 24px;
}

.bg-blue-light {
    background: #f0f9ff;
}

.bg-green-light {
    background: #e6f4ea;
}

.bg-purple-light {
    background: #f5f3ff;
}

.bg-orange-light {
    background: #fffbeb;
}

.stat-info {
    flex: 1;
}

.stat-info h3 {
    margin: 0;
    font-size: 0.85rem;
    font-weight: 600;
    color: #64748b;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.stat-info .value {
    margin: 0.25rem 0 0 0;
    font-size: 1.75rem;
    font-weight: 700;
    color: #0f172a;
}

.stat-trend {
    display: flex;
    align-items: center;
    gap: 0.25rem;
    font-size: 0.85rem;
    font-weight: 600;
    padding: 0.25rem 0.5rem;
    border-radius: 20px;
}

.stat-trend svg {
    width: 14px;
    height: 14px;
}

.stat-trend.positive {
    color: #108140;
    background: #e6f4ea;
}

.stat-trend.negative {
    color: #ef4444;
    background: #fee2e2;
}

.stat-trend.neutral {
    color: #64748b;
    background: #f1f5f9;
}

.recent-section {
    display: grid;
    grid-template-columns: 1fr;
}



.card-header {
    padding: 1.5rem;
    border-bottom: 1px solid #f1f5f9;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.card-header h2 {
    margin: 0;
    font-size: 1.1rem;
    font-weight: 600;
    color: #0f172a;
}

.btn-link {
    background: none;
    border: none;
    color: #108140;
    font-size: 0.9rem;
    font-weight: 500;
    cursor: pointer;
    text-decoration: none;
}

.btn-link:hover {
    text-decoration: underline;
}

.empty-state {
    padding: 4rem 2rem;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
    color: #64748b;
}

.empty-img {
    width: 200px;
    opacity: 0.7;
    margin-bottom: 1.5rem;
}

.card-body {
    padding: 1.5rem;
}

.table-responsive {
    overflow-x: auto;
}

.table-dashboard {
    width: 100%;
    border-collapse: collapse;
    text-align: left;
}

.table-dashboard th {
    padding: 0.75rem 1rem;
    font-size: 0.8rem;
    font-weight: 600;
    color: #64748b;
    text-transform: uppercase;
    border-bottom: 1px solid #f1f5f9;
}

.table-dashboard td {
    padding: 1rem;
    font-size: 0.9rem;
    color: #475569;
    border-bottom: 1px solid #f1f5f9;
    vertical-align: middle;
}

.table-dashboard tr:last-child td {
    border-bottom: none;
}

.font-medium {
    font-weight: 500;
    color: #0f172a;
}

.text-truncate {
    max-width: 250px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
</style>
