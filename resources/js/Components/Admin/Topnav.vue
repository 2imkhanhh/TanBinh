<script setup>
import { Link, router, useForm } from '@inertiajs/vue3';
import { ref, onMounted, onUnmounted, inject } from 'vue';

const showToast = inject('toast');

const isDropdownOpen = ref(false);
const isPasswordModalOpen = ref(false);
const dropdownRef = ref(null);
const showCurrentPassword = ref(false);
const showNewPassword = ref(false);
const showConfirmPassword = ref(false);

const passwordForm = useForm({
    current_password: '',
    password: '',
    password_confirmation: ''
});

const logout = () => {
    router.post(route('logout'));
};

const closeDropdown = (e) => {
    if (dropdownRef.value && !dropdownRef.value.contains(e.target)) {
        isDropdownOpen.value = false;
    }
};

const openPasswordModal = () => {
    passwordForm.reset();
    passwordForm.clearErrors();
    showCurrentPassword.value = false;
    showNewPassword.value = false;
    showConfirmPassword.value = false;
    isPasswordModalOpen.value = true;
    isDropdownOpen.value = false;
};

const updatePassword = () => {
    passwordForm.put(route('password.update'), {
        preserveScroll: true,
        onSuccess: () => {
            isPasswordModalOpen.value = false;
            passwordForm.reset();
            showToast('Đổi mật khẩu thành công!', 'success');
        }
    });
};

onMounted(() => {
    document.addEventListener('click', closeDropdown);
});

onUnmounted(() => {
    document.removeEventListener('click', closeDropdown);
});
</script>

<template>
    <header class="topnav">
        <div>
            <!-- Breadcrumbs or empty left side -->
        </div>

        <div class="user-actions">
            <div class="profile-dropdown" ref="dropdownRef">
                <button class="profile-btn" @click="isDropdownOpen = !isDropdownOpen">
                    <img src="https://ui-avatars.com/api/?name=Admin&background=e6f4ea&color=108140" alt="Avatar"
                        class="avatar" />
                    <span class="user-name">{{ $page.props.auth.user.name }}</span>
                    <svg class="chevron" :class="{ open: isDropdownOpen }" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </button>

                <div v-if="isDropdownOpen" class="dropdown-menu">
                    <button @click="openPasswordModal" class="dropdown-item">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                        </svg>
                        Đổi mật khẩu
                    </button>
                    <button @click="logout" class="dropdown-item text-danger">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                            <polyline points="16 17 21 12 16 7"></polyline>
                            <line x1="21" y1="12" x2="9" y2="12"></line>
                        </svg>
                        Đăng xuất
                    </button>
                </div>
            </div>
        </div>
    </header>

    <!-- Change Password Modal -->
    <div class="modal-overlay" :class="{ show: isPasswordModalOpen }" @click="isPasswordModalOpen = false"></div>
    <div class="center-modal" :class="{ show: isPasswordModalOpen }">
        <div class="modal-header">
            <h2>Đổi mật khẩu tài khoản</h2>
            <button class="close-btn" @click="isPasswordModalOpen = false">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
        </div>
        <div class="modal-body">
            <form @submit.prevent="updatePassword">
                <div class="form-group">
                    <label>Mật khẩu hiện tại</label>
                    <div class="password-input-wrapper">
                        <input :type="showCurrentPassword ? 'text' : 'password'" v-model="passwordForm.current_password"
                            class="form-control" required />
                        <button type="button" class="toggle-password"
                            @click="showCurrentPassword = !showCurrentPassword" tabindex="-1">
                            <svg v-if="!showCurrentPassword" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                            </svg>
                            <svg v-else viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path
                                    d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24">
                                </path>
                                <line x1="1" y1="1" x2="23" y2="23"></line>
                            </svg>
                        </button>
                    </div>
                    <span class="error" v-if="passwordForm.errors.current_password">{{
                        passwordForm.errors.current_password }}</span>
                </div>

                <div class="form-group">
                    <label>Mật khẩu mới</label>
                    <div class="password-input-wrapper">
                        <input :type="showNewPassword ? 'text' : 'password'" v-model="passwordForm.password"
                            class="form-control" required />
                        <button type="button" class="toggle-password" @click="showNewPassword = !showNewPassword"
                            tabindex="-1">
                            <svg v-if="!showNewPassword" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                            </svg>
                            <svg v-else viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path
                                    d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24">
                                </path>
                                <line x1="1" y1="1" x2="23" y2="23"></line>
                            </svg>
                        </button>
                    </div>
                    <span class="error" v-if="passwordForm.errors.password">{{ passwordForm.errors.password }}</span>
                </div>

                <div class="form-group">
                    <label>Nhập lại mật khẩu mới</label>
                    <div class="password-input-wrapper">
                        <input :type="showConfirmPassword ? 'text' : 'password'"
                            v-model="passwordForm.password_confirmation" class="form-control" required />
                        <button type="button" class="toggle-password"
                            @click="showConfirmPassword = !showConfirmPassword" tabindex="-1">
                            <svg v-if="!showConfirmPassword" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                            </svg>
                            <svg v-else viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path
                                    d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24">
                                </path>
                                <line x1="1" y1="1" x2="23" y2="23"></line>
                            </svg>
                        </button>
                    </div>
                    <span class="error" v-if="passwordForm.errors.password_confirmation">{{
                        passwordForm.errors.password_confirmation }}</span>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn-default" @click="isPasswordModalOpen = false">Hủy</button>
                    <button type="submit" class="btn-primary" :disabled="passwordForm.processing">
                        {{ passwordForm.processing ? 'Đang cập nhật...' : 'Đổi mật khẩu' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<style scoped>
.topnav {
    height: 70px;
    background: #ffffff;
    border-bottom: 1px solid #e2e8f0;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 2rem;
    position: sticky;
    top: 0;
    z-index: 99;
}

.user-actions {
    display: flex;
    align-items: center;
    gap: 1.5rem;
}

.profile-dropdown {
    position: relative;
}

.profile-btn {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    background: none;
    border: none;
    cursor: pointer;
    padding: 0.25rem;
    border-radius: 20px;
    transition: background 0.2s;
}

.profile-btn:hover {
    background: #f8fafc;
}

.avatar {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    object-fit: cover;
}

.user-name {
    font-size: 0.9rem;
    font-weight: 600;
    color: #334155;
}

.chevron {
    width: 16px;
    height: 16px;
    color: #64748b;
    transition: transform 0.2s;
}

.chevron.open {
    transform: rotate(180deg);
}

.dropdown-menu {
    position: absolute;
    top: calc(100% + 0.5rem);
    right: 0;
    width: 220px;
    background: #ffffff;
    border-radius: 12px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    border: 1px solid #f1f5f9;
    overflow: hidden;
    animation: fadeInDown 0.2s ease;
}

@keyframes fadeInDown {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.dropdown-item {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    width: 100%;
    padding: 0.75rem 1rem;
    background: none;
    border: none;
    text-align: left;
    font-size: 0.9rem;
    color: #475569;
    cursor: pointer;
    text-decoration: none;
    transition: background 0.2s;
}

.dropdown-item:hover {
    background: #f1f5f9;
    color: #0f172a;
}

.dropdown-item svg {
    width: 16px;
    height: 16px;
}

.text-danger {
    color: #ef4444;
}

.text-danger:hover {
    background: #fef2f2;
    color: #dc2626;
}

.modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(15, 23, 42, 0.4);
    backdrop-filter: blur(4px);
    z-index: 1000;
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
}

.modal-overlay.show {
    opacity: 1;
    visibility: visible;
}

.center-modal {
    position: fixed;
    top: 50%;
    left: 50%;
    width: 100%;
    max-width: 450px;
    background: #ffffff;
    z-index: 1001;
    border-radius: 16px;
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    transform: translate(-50%, -50%) scale(0.95);
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    display: flex;
    flex-direction: column;
}

.center-modal.show {
    transform: translate(-50%, -50%) scale(1);
    opacity: 1;
    visibility: visible;
}

.modal-header {
    padding: 1.25rem 1.5rem;
    border-bottom: 1px solid #f1f5f9;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.modal-header h2 {
    margin: 0;
    font-size: 1.15rem;
    font-weight: 700;
    color: #0f172a;
}

.close-btn {
    background: none;
    border: none;
    cursor: pointer;
    color: #64748b;
    border-radius: 50%;
    padding: 0.5rem;
    transition: background 0.2s;
    display: flex;
    align-items: center;
    justify-content: center;
}

.close-btn:hover {
    background: #f1f5f9;
    color: #0f172a;
}

.close-btn svg {
    width: 18px;
    height: 18px;
}

.modal-body {
    padding: 1.5rem;
}

.modal-footer {
    padding-top: 1.25rem;
    margin-top: 1.25rem;
    border-top: 1px solid #f1f5f9;
    display: flex;
    justify-content: flex-end;
    gap: 0.75rem;
}

.form-group {
    margin-bottom: 1.25rem;
}

.form-group:last-of-type {
    margin-bottom: 0;
}

.form-group label {
    display: block;
    font-size: 0.85rem;
    font-weight: 600;
    color: #334155;
    margin-bottom: 0.5rem;
}

.form-control {
    width: 100%;
    padding: 0.65rem 0.85rem;
    border: 1px solid #cbd5e1;
    border-radius: 8px;
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

.error {
    display: block;
    color: #ef4444;
    font-size: 0.8rem;
    margin-top: 0.4rem;
}

.btn-primary {
    background: #108140;
    color: white;
    border: none;
    padding: 0.6rem 1.25rem;
    border-radius: 8px;
    font-weight: 600;
    font-size: 0.9rem;
    cursor: pointer;
    transition: all 0.2s;
}

.btn-primary:hover {
    background: #0d6e35;
}

.btn-primary:disabled {
    opacity: 0.6;
    cursor: not-allowed;
}

.btn-default {
    background: #f1f5f9;
    color: #475569;
    border: none;
    padding: 0.6rem 1.25rem;
    border-radius: 8px;
    font-weight: 600;
    font-size: 0.9rem;
    cursor: pointer;
    transition: all 0.2s;
}

.btn-default:hover {
    background: #e2e8f0;
}

.password-input-wrapper {
    position: relative;
    display: flex;
    align-items: center;
}

.password-input-wrapper .form-control {
    padding-right: 2.5rem;
}

.toggle-password {
    position: absolute;
    right: 0.6rem;
    background: none;
    border: none;
    cursor: pointer;
    padding: 0.25rem;
    color: #94a3b8;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: color 0.2s ease;
}

.toggle-password:hover {
    color: #475569;
}

.toggle-password svg {
    width: 18px;
    height: 18px;
}
</style>
