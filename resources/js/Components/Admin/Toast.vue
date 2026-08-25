<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import { usePage, router } from '@inertiajs/vue3';

const toasts = ref([]);
let toastId = 0;

const addToast = (message, type = 'success') => {
    const id = ++toastId;
    toasts.value.push({ id, message, type, visible: false });
    setTimeout(() => {
        const toast = toasts.value.find(t => t.id === id);
        if (toast) toast.visible = true;
    }, 50);
    setTimeout(() => removeToast(id), 5000);
};

const removeToast = (id) => {
    const toast = toasts.value.find(t => t.id === id);
    if (toast) toast.visible = false;
    setTimeout(() => {
        toasts.value = toasts.value.filter(t => t.id !== id);
    }, 400);
};

const checkFlash = () => {
    const page = usePage();
    const flash = page.props.flash;
    if (flash?.message) addToast(flash.message, 'success');
    if (flash?.success) addToast(flash.success, 'success');
    if (flash?.error) addToast(flash.error, 'error');
};

let removeFinishListener = null;

onMounted(() => {
    checkFlash();
    removeFinishListener = router.on('finish', () => {
        setTimeout(checkFlash, 50);
    });
});

onUnmounted(() => {
    if (removeFinishListener) removeFinishListener();
});

defineExpose({ addToast });
</script>

<template>
    <div class="toast-container">
        <TransitionGroup name="toast">
            <div v-for="toast in toasts" :key="toast.id" class="toast-item"
                :class="[toast.type, { 'toast-visible': toast.visible }]">
                <div class="toast-icon">
                    <svg v-if="toast.type === 'success'" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                    </svg>
                    <svg v-else-if="toast.type === 'error'" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="15" y1="9" x2="9" y2="15"></line>
                        <line x1="9" y1="9" x2="15" y2="15"></line>
                    </svg>
                    <svg v-else viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                        stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="16" x2="12" y2="12"></line>
                        <line x1="12" y1="8" x2="12.01" y2="8"></line>
                    </svg>
                </div>
                <span class="toast-message">{{ toast.message }}</span>
                <button class="toast-close" @click="removeToast(toast.id)">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
                <div class="toast-progress" :class="toast.type"></div>
            </div>
        </TransitionGroup>
    </div>
</template>

<style scoped>
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

.toast-item.info .toast-icon {
    background: #eff6ff;
    color: #3b82f6;
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

.toast-progress.info {
    background: linear-gradient(90deg, #60a5fa, #3b82f6);
}

@keyframes progress {
    from {
        width: 100%;
    }

    to {
        width: 0%;
    }
}

/* Transition group animations */
.toast-enter-active,
.toast-leave-active {
    transition: all 0.4s cubic-bezier(0.22, 1, 0.36, 1);
}

.toast-enter-from {
    opacity: 0;
    transform: translateX(100%);
}

.toast-leave-to {
    opacity: 0;
    transform: translateX(100%);
}
</style>
