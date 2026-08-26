<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    email: {
        type: String,
        required: true,
    },
    token: {
        type: String,
        required: true,
    },
});

const form = useForm({
    token: props.token,
    email: props.email,
    password: '',
    password_confirmation: '',
});

const showPassword = ref(false);
const showPasswordConfirm = ref(false);
const isSubmitting = ref(false);

const submit = () => {
    isSubmitting.value = true;
    form.post(route('password.store'), {
        onFinish: () => {
            form.reset('password', 'password_confirmation');
            isSubmitting.value = false;
        },
    });
};
</script>

<template>

    <Head title="TanBinh Admin - Đặt lại mật khẩu" />
    <div class="reset-wrapper">
        <div class="reset-container">
            <div class="reset-left">
                <div class="brand-container">
                    <img src="/assets/images/common/logo.png" alt="TanBinh Logo" class="brand-logo" />
                    <span class="brand-name">TAN BINH TEA</span>
                </div>
            </div>
            <div class="reset-right">
                <div class="form-wrapper">
                    <h2>Đặt lại mật khẩu</h2>
                    <p class="instruction-text">
                        Vui lòng nhập địa chỉ email và thiết lập mật khẩu mới cho tài khoản của bạn.
                    </p>

                    <form @submit.prevent="submit" class="reset-form">
                        <div class="input-group">
                            <label for="email">Email</label>
                            <div class="input-wrapper">
                                <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path
                                        d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z">
                                    </path>
                                    <polyline points="22,6 12,13 2,6"></polyline>
                                </svg>
                                <input id="email" type="email" v-model="form.email" placeholder="admin@tanbinhtea.com" required
                                    autocomplete="username" :class="{ 'has-error': form.errors.email }" />
                            </div>
                            <span v-if="form.errors.email" class="error-text">{{ form.errors.email }}</span>
                        </div>

                        <div class="input-group">
                            <label for="password">Mật khẩu mới</label>
                            <div class="input-wrapper">
                                <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                    <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                </svg>
                                <input id="password" :type="showPassword ? 'text' : 'password'" v-model="form.password"
                                    placeholder="••••••••" required autocomplete="new-password"
                                    :class="{ 'has-error': form.errors.password }" />
                                <button type="button" class="toggle-password" @click="showPassword = !showPassword"
                                    tabindex="-1">
                                    <svg v-if="!showPassword" viewBox="0 0 24 24" fill="none" stroke="currentColor"
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
                            <span v-if="form.errors.password" class="error-text">{{ form.errors.password }}</span>
                        </div>

                        <div class="input-group">
                            <label for="password_confirmation">Xác nhận mật khẩu</label>
                            <div class="input-wrapper">
                                <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                    <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                </svg>
                                <input id="password_confirmation" :type="showPasswordConfirm ? 'text' : 'password'"
                                    v-model="form.password_confirmation" placeholder="••••••••" required
                                    autocomplete="new-password"
                                    :class="{ 'has-error': form.errors.password_confirmation }" />
                                <button type="button" class="toggle-password"
                                    @click="showPasswordConfirm = !showPasswordConfirm" tabindex="-1">
                                    <svg v-if="!showPasswordConfirm" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
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
                            <span v-if="form.errors.password_confirmation" class="error-text">{{
                                form.errors.password_confirmation }}</span>
                        </div>

                        <button type="submit" class="submit-btn" :disabled="form.processing">
                            <span v-if="form.processing">Đang lưu...</span>
                            <span v-else>Cập nhật mật khẩu</span>
                            <svg v-if="!form.processing" class="btn-icon" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </button>
                    </form>

                    <div class="back-to-login">
                        <Link :href="route('login')" class="login-link">
                            <svg class="back-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="19" y1="12" x2="5" y2="12"></line>
                                <polyline points="12 19 5 12 12 5"></polyline>
                            </svg>
                            Quay lại trang đăng nhập
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

.reset-wrapper {
    font-family: 'Inter', sans-serif;
    min-height: 100vh;
    background: #f0f4f8;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 2rem;
    box-sizing: border-box;
    margin: -8px;
}

.reset-container {
    display: flex;
    width: 100%;
    max-width: 1000px;
    min-height: 600px;
    background: #ffffff;
    border-radius: 24px;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.05), 0 1px 3px rgba(0, 0, 0, 0.05);
    overflow: hidden;
    position: relative;
}

.reset-left {
    flex: 1;
    background: linear-gradient(135deg, #e6f4ea 0%, #d1e7dd 100%);
    padding: 3rem;
    display: flex;
    flex-direction: column;
    justify-content: center;
    position: relative;
    overflow: hidden;
}

.reset-left::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(255, 255, 255, 0.8) 0%, rgba(255, 255, 255, 0) 60%);
    opacity: 0.5;
    animation: rotate 20s linear infinite;
}

@keyframes rotate {
    0% {
        transform: rotate(0deg);
    }

    100% {
        transform: rotate(360deg);
    }
}

.brand-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 1rem;
    z-index: 2;
    flex: 1;
}

.brand-logo {
    width: 140px;
    height: auto;
    object-fit: contain;
    filter: drop-shadow(0 10px 30px rgba(16, 129, 64, 0.2));
}

.brand-name {
    font-size: 1.5rem;
    font-weight: 700;
    color: #038d0d;
    letter-spacing: 2px;
    text-transform: uppercase;
}

.reset-right {
    flex: 1;
    padding: 3rem;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #ffffff;
}

.form-wrapper {
    width: 100%;
    max-width: 380px;
}

.form-wrapper h2 {
    font-size: 2rem;
    font-weight: 700;
    color: #0f172a;
    margin-bottom: 0.5rem;
}

.instruction-text {
    color: #64748b;
    margin-bottom: 2.5rem;
    font-size: 0.95rem;
    line-height: 1.5;
}

.input-group {
    margin-bottom: 1.5rem;
}

.input-group label {
    display: block;
    font-size: 0.875rem;
    font-weight: 600;
    color: #334155;
    margin-bottom: 0.5rem;
}

.input-wrapper {
    position: relative;
    display: flex;
    align-items: center;
}

.input-wrapper input {
    width: 100%;
    padding: 0.875rem 1rem 0.875rem 3rem;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    font-size: 0.95rem;
    color: #0f172a;
    background: #f8fafc;
    transition: all 0.3s ease;
    outline: none;
    font-family: inherit;
    box-sizing: border-box;
}

.input-wrapper input:focus {
    background: #ffffff;
    border-color: #108140;
    box-shadow: 0 0 0 4px rgba(16, 129, 64, 0.1);
}

.input-wrapper input.has-error {
    border-color: #ef4444;
    background: #fef2f2;
}

.input-wrapper input.has-error:focus {
    box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.1);
}

.input-icon {
    position: absolute;
    left: 1rem;
    width: 20px;
    height: 20px;
    color: #94a3b8;
    transition: color 0.3s ease;
}

.input-wrapper input:focus+.input-icon,
.input-wrapper input:focus~.input-icon {
    color: #108140;
}

.toggle-password {
    position: absolute;
    right: 0.75rem;
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

.error-text {
    display: block;
    color: #ef4444;
    font-size: 0.8rem;
    margin-top: 0.5rem;
}

.submit-btn {
    width: 100%;
    padding: 1rem;
    background: linear-gradient(135deg, #108140 0%, #0d6e35 100%);
    color: white;
    border: none;
    border-radius: 12px;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(13, 110, 53, 0.2);
    font-family: inherit;
    margin-bottom: 2rem;
}

.submit-btn:hover:not(:disabled) {
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(13, 110, 53, 0.3);
}

.submit-btn:disabled {
    opacity: 0.7;
    cursor: not-allowed;
}

.btn-icon {
    width: 20px;
    height: 20px;
    transition: transform 0.3s ease;
}

.submit-btn:hover:not(:disabled) .btn-icon {
    transform: translateX(4px);
}

.back-to-login {
    display: flex;
    justify-content: center;
}

.login-link {
    font-size: 0.875rem;
    color: #64748b;
    text-decoration: none;
    font-weight: 500;
    transition: color 0.2s ease;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.login-link:hover {
    color: #108140;
}

.back-icon {
    width: 16px;
    height: 16px;
    transition: transform 0.2s ease;
}

.login-link:hover .back-icon {
    transform: translateX(-4px);
}

@media (max-width: 768px) {
    .reset-container {
        flex-direction: column;
    }

    .reset-left {
        padding: 2rem;
        flex: none;
        height: 200px;
    }

    .brand-container {
        height: 100%;
    }

    .brand-logo {
        width: 100px;
    }

    .reset-right {
        padding: 2rem;
    }
}
</style>
