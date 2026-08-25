<script setup>
import { ref } from 'vue';

const isVisible = ref(false);
const dialogTitle = ref('');
const dialogMessage = ref('');
let resolvePromise = null;

const show = (title, message) => {
    dialogTitle.value = title;
    dialogMessage.value = message;
    isVisible.value = true;
    return new Promise((resolve) => {
        resolvePromise = resolve;
    });
};

const confirm = () => {
    isVisible.value = false;
    if (resolvePromise) resolvePromise(true);
};

const cancel = () => {
    isVisible.value = false;
    if (resolvePromise) resolvePromise(false);
};

defineExpose({ show });
</script>

<template>
    <Teleport to="body">
        <Transition name="dialog-fade">
            <div v-if="isVisible" class="dialog-overlay" @click.self="cancel">
                <Transition name="dialog-scale">
                    <div v-if="isVisible" class="dialog-card">
                        <div class="dialog-icon-wrap">
                            <div class="dialog-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <line x1="12" y1="8" x2="12" y2="12"></line>
                                    <line x1="12" y1="16" x2="12.01" y2="16"></line>
                                </svg>
                            </div>
                        </div>
                        <h3 class="dialog-title">{{ dialogTitle }}</h3>
                        <p class="dialog-message">{{ dialogMessage }}</p>
                        <div class="dialog-actions">
                            <button class="btn-cancel" @click="cancel">Hủy bỏ</button>
                            <button class="btn-confirm" @click="confirm">Xác nhận</button>
                        </div>
                    </div>
                </Transition>
            </div>
        </Transition>
    </Teleport>
</template>

<style scoped>
.dialog-overlay {
    position: fixed;
    inset: 0;
    background: rgba(15, 23, 42, 0.5);
    backdrop-filter: blur(4px);
    z-index: 10000;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 1rem;
}

.dialog-card {
    background: #ffffff;
    border-radius: 20px;
    padding: 2rem;
    max-width: 400px;
    width: 100%;
    text-align: center;
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
}

.dialog-icon-wrap {
    display: flex;
    justify-content: center;
    margin-bottom: 1.25rem;
}

.dialog-icon {
    width: 56px;
    height: 56px;
    border-radius: 50%;
    background: #fef2f2;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #ef4444;
}

.dialog-icon svg {
    width: 28px;
    height: 28px;
}

.dialog-title {
    font-size: 1.15rem;
    font-weight: 700;
    color: #0f172a;
    margin: 0 0 0.5rem 0;
}

.dialog-message {
    font-size: 0.9rem;
    color: #64748b;
    margin: 0 0 1.5rem 0;
    line-height: 1.5;
}

.dialog-actions {
    display: flex;
    gap: 0.75rem;
}

.btn-cancel,
.btn-confirm {
    flex: 1;
    padding: 0.7rem 1rem;
    border-radius: 12px;
    font-size: 0.9rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s ease;
    border: none;
    font-family: inherit;
}

.btn-cancel {
    background: #f1f5f9;
    color: #475569;
}

.btn-cancel:hover {
    background: #e2e8f0;
}

.btn-confirm {
    background: #ef4444;
    color: #ffffff;
    box-shadow: 0 4px 12px rgba(239, 68, 68, 0.25);
}

.btn-confirm:hover {
    background: #dc2626;
    transform: translateY(-1px);
    box-shadow: 0 6px 16px rgba(239, 68, 68, 0.3);
}

.dialog-fade-enter-active,
.dialog-fade-leave-active {
    transition: opacity 0.3s ease;
}

.dialog-fade-enter-from,
.dialog-fade-leave-to {
    opacity: 0;
}

.dialog-scale-enter-active {
    transition: all 0.3s cubic-bezier(0.22, 1, 0.36, 1);
}

.dialog-scale-leave-active {
    transition: all 0.2s ease;
}

.dialog-scale-enter-from {
    opacity: 0;
    transform: scale(0.9);
}

.dialog-scale-leave-to {
    opacity: 0;
    transform: scale(0.95);
}
</style>
