<script setup>
import Sidebar from '../Components/Admin/Sidebar.vue';
import Topnav from '../Components/Admin/Topnav.vue';
import Toast from '../Components/Admin/Toast.vue';
import ConfirmDialog from '../Components/Admin/ConfirmDialog.vue';
import { onMounted, onUnmounted, provide, ref } from 'vue';

const toastRef = ref(null);
const confirmDialogRef = ref(null);

const showToast = (message, type = 'success') => {
    toastRef.value?.addToast(message, type);
};

const showConfirm = (title, message) => {
    return confirmDialogRef.value?.show(title, message);
};

provide('toast', showToast);
provide('confirm', showConfirm);

onMounted(() => {
    document.body.classList.add('admin-mode');
});

onUnmounted(() => {
    document.body.classList.remove('admin-mode');
});
</script>

<template>
    <div class="admin-layout">
        <Sidebar />
        <div class="main-content">
            <Topnav />
            <main class="page-content">
                <slot />
            </main>
        </div>
        <Toast ref="toastRef" />
        <ConfirmDialog ref="confirmDialogRef" />
    </div>
</template>

<style>
body.admin-mode {
    background-color: #f8fafc;
    margin: 0;
    font-family: 'Inter', sans-serif;
    color: #334155;
}

/* Global Admin Styles */
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

.btn-primary {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    background: #108140;
    color: white;
    border: none;
    padding: 0.6rem 1.25rem;
    border-radius: 10px;
    font-weight: 500;
    font-size: 0.9rem;
    cursor: pointer;
    text-decoration: none;
    transition: all 0.2s;
    box-shadow: 0 4px 6px -1px rgba(16, 129, 64, 0.2);
}

.btn-primary:hover {
    background: #0d6e35;
    transform: translateY(-1px);
}

.btn-primary svg {
    width: 18px;
    height: 18px;
}

.btn-default {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    background: #f1f5f9;
    color: #475569;
    border: none;
    padding: 0.6rem 1.25rem;
    border-radius: 10px;
    font-weight: 500;
    font-size: 0.9rem;
    cursor: pointer;
    text-decoration: none;
    transition: all 0.2s;
}

.btn-default:hover {
    background: #e2e8f0;
}

.btn-default svg {
    width: 18px;
    height: 18px;
}

.card {
    background: #ffffff;
    border-radius: 16px;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    border: 1px solid #f1f5f9;
    overflow: hidden;
}

.form-group {
    margin-bottom: 1.25rem;
}

.form-row {
    display: flex;
    gap: 1rem;
    margin-bottom: 1.25rem;
}

.form-row .form-group {
    margin-bottom: 0;
}

.flex-1 {
    flex: 1;
}

.form-group label {
    display: block;
    font-size: 0.85rem;
    font-weight: 600;
    color: #334155;
    margin-bottom: 0.5rem;
}

.required {
    color: #ef4444;
}

.form-control {
    width: 100%;
    padding: 0.65rem 1rem;
    border: 1px solid #cbd5e1;
    border-radius: 10px;
    font-size: 0.95rem;
    color: #0f172a;
    background: #ffffff;
    transition: all 0.2s;
    font-family: inherit;
    box-sizing: border-box;
}

.form-control:focus {
    outline: none;
    border-color: #108140;
    box-shadow: 0 0 0 3px rgba(16, 129, 64, 0.1);
}

textarea.form-control {
    resize: vertical;
}

.error {
    display: block;
    color: #ef4444;
    font-size: 0.8rem;
    margin-top: 0.4rem;
}

.form-section-title {
    font-size: 1.05rem;
    font-weight: 700;
    color: #1e293b;
    margin: 1.5rem 0 1rem 0;
    padding-bottom: 0.5rem;
    border-bottom: 1px solid #f1f5f9;
}

.lang-tabs {
    display: flex;
    gap: 0.5rem;
    margin-bottom: 1.5rem;
    border-bottom: 2px solid #e2e8f0;
}

.lang-tab {
    padding: 0.75rem 1.5rem;
    font-weight: 600;
    font-size: 0.95rem;
    color: #64748b;
    background: transparent;
    border: none;
    border-bottom: 2px solid transparent;
    margin-bottom: -2px;
    cursor: pointer;
    transition: all 0.2s;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.lang-tab:hover {
    color: #108140;
}

.lang-tab.active {
    color: #108140;
    border-bottom-color: #108140;
}
</style>

<style scoped>
.admin-layout {
    display: flex;
    min-height: 100vh;
    background: #f8fafc;
}

.main-content {
    flex: 1;
    margin-left: 260px;
    display: flex;
    flex-direction: column;
}

.page-content {
    padding: 2rem;
    flex: 1;
}

@media (max-width: 768px) {
    .main-content {
        margin-left: 0;
    }
}
</style>
