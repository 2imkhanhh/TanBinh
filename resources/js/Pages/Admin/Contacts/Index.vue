<script setup>
import { Head, router, Link } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { inject } from 'vue';

const showConfirm = inject('confirm');

defineOptions({ layout: AdminLayout });

const props = defineProps({
    contacts: Object,
});

const toggleStatus = (contact) => {
    const newStatus = contact.status === 'pending' ? 'done' : 'pending';
    router.put(route('admin.contacts.update', contact.id), { status: newStatus }, {
        preserveScroll: true
    });
};

const deleteContact = async (id) => {
    const confirmed = await showConfirm('Xóa liên hệ', 'Bạn có chắc chắn muốn xóa tin nhắn liên hệ này? Thao tác này không thể hoàn tác.');
    if (confirmed) {
        router.delete(route('admin.contacts.destroy', id), {
            preserveScroll: true
        });
    }
};

const formatDate = (dateString) => {
    if (!dateString) return '';
    const date = new Date(dateString);
    return date.toLocaleString('vi-VN', { hour: '2-digit', minute: '2-digit', day: '2-digit', month: '2-digit', year: 'numeric' });
};
</script>

<template>

    <Head title="Hòm thư Liên hệ" />

    <div class="page-header">
        <div>
            <h1 class="title">Liên hệ</h1>
        </div>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th width="80">STT</th>
                        <th>Họ tên</th>
                        <th>Số điện thoại</th>
                        <th>Email</th>
                        <th width="30%">Nội dung</th>
                        <th>Thời gian</th>
                        <th>Trạng thái</th>
                        <th width="120" class="text-right">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(contact, index) in contacts.data" :key="contact.id">
                        <td>{{ (contacts.current_page - 1) * contacts.per_page + index + 1 }}</td>
                        <td class="font-medium text-dark">{{ contact.fullname }}</td>
                        <td>{{ contact.phone || 'N/A' }}</td>
                        <td><a :href="'mailto:' + contact.email" class="text-blue">{{ contact.email }}</a></td>
                        <td>
                            <div class="truncate-content" :title="contact.content">{{ contact.content }}</div>
                        </td>
                        <td class="text-gray text-sm">{{ formatDate(contact.created_at) }}</td>
                        <td>
                            <button @click="toggleStatus(contact)"
                                :class="['badge-btn', contact.status === 'done' ? 'badge-success' : 'badge-warning']"
                                title="Bấm để đổi trạng thái">
                                {{ contact.status === 'done' ? 'Đã xử lý' : 'Chưa xử lý' }}
                            </button>
                        </td>
                        <td class="text-right">
                            <div class="actions">
                                <button @click="deleteContact(contact.id)" class="btn-icon text-red" title="Xóa">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <polyline points="3 6 5 6 21 6"></polyline>
                                        <path
                                            d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                        </path>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr v-if="contacts.data.length === 0">
                        <td colspan="7" class="text-center py-4 text-gray">Không có liên hệ nào.</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="pagination-wrap" v-if="contacts.links && contacts.links.length > 3">
            <div class="pagination">
                <template v-for="(link, i) in contacts.links" :key="i">
                    <Link v-if="link.url" :href="link.url" class="page-link" :class="{ active: link.active }"
                        v-html="link.label"></Link>
                    <span v-else class="page-link disabled" v-html="link.label"></span>
                </template>
            </div>
        </div>
    </div>
</template>

<style scoped>
.page-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
}

.title {
    font-size: 1.5rem;
    font-weight: 700;
    color: #0f172a;
    margin: 0;
}

.subtitle {
    color: #64748b;
    margin: 0.25rem 0 0 0;
    font-size: 0.9rem;
}

.alert-success {
    background: #ecfdf5;
    color: #059669;
    padding: 1rem;
    border-radius: 12px;
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: 500;
    font-size: 0.9rem;
    border: 1px solid #a7f3d0;
}

.alert-success svg {
    width: 20px;
    height: 20px;
}

.card {
    background: #ffffff;
    border-radius: 16px;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    border: 1px solid #f1f5f9;
    overflow: hidden;
}

.table-responsive {
    overflow-x: auto;
}

.table {
    width: 100%;
    border-collapse: collapse;
}

.table th {
    background: #f8fafc;
    color: #64748b;
    font-weight: 600;
    font-size: 0.8rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    padding: 1rem;
    text-align: left;
    border-bottom: 1px solid #e2e8f0;
}

.table td {
    padding: 1rem;
    vertical-align: middle;
    border-bottom: 1px solid #f1f5f9;
    font-size: 0.9rem;
    color: #475569;
}

.table tr:last-child td {
    border-bottom: none;
}

.table tr:hover {
    background: #f8fafc;
}

.truncate-content {
    max-width: 300px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.text-right {
    text-align: right;
}

.text-center {
    text-align: center;
}

.font-medium {
    font-weight: 500;
}

.text-dark {
    color: #0f172a;
}

.text-gray {
    color: #94a3b8;
}

.text-sm {
    font-size: 0.85rem;
}

.py-4 {
    padding-top: 1.5rem;
    padding-bottom: 1.5rem;
}

.badge-btn {
    padding: 0.4rem 0.8rem;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
    cursor: pointer;
    border: none;
    transition: all 0.2s;
}

.badge-success {
    background: #ecfdf5;
    color: #059669;
}

.badge-success:hover {
    background: #d1fae5;
}

.badge-warning {
    background: #fffbeb;
    color: #d97706;
}

.badge-warning:hover {
    background: #fef3c7;
}

.actions {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 0.5rem;
}

.btn-icon {
    background: none;
    border: none;
    cursor: pointer;
    padding: 0.4rem;
    border-radius: 8px;
    transition: all 0.2s;
    display: flex;
    align-items: center;
    justify-content: center;
}

.btn-icon svg {
    width: 18px;
    height: 18px;
}

.btn-icon:hover {
    background: #f1f5f9;
}

.text-blue {
    color: #3b82f6;
    text-decoration: none;
}

.text-red {
    color: #ef4444;
}

.pagination-wrap {
    padding: 1.5rem;
    border-top: 1px solid #f1f5f9;
    display: flex;
    justify-content: center;
}

.pagination {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.page-link {
    display: flex;
    align-items: center;
    justify-content: center;
    min-width: 36px;
    height: 36px;
    border-radius: 50%;
    background: transparent;
    border: none;
    color: #64748b;
    text-decoration: none;
    font-size: 0.95rem;
    font-weight: 600;
    transition: all 0.25s ease;
    cursor: pointer;
}

.page-link:hover:not(.disabled) {
    background: #f1f5f9;
    color: #0f172a;
    transform: translateY(-2px);
}

.page-link.active {
    background: #3b82f6;
    color: #ffffff;
    box-shadow: 0 4px 10px rgba(59, 130, 246, 0.35);
}

.page-link.disabled {
    opacity: 0.4;
    pointer-events: none;
    cursor: default;
}
</style>
