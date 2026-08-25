<script setup>
import { onMounted, onUnmounted, watch } from 'vue';

const props = defineProps({
    show: {
        type: Boolean,
        default: false,
    },
    maxWidth: {
        type: String,
        default: '2xl',
    },
    closeable: {
        type: Boolean,
        default: true,
    },
});

const emit = defineEmits(['close']);

const close = () => {
    if (props.closeable) {
        emit('close');
    }
};

const closeOnEscape = (e) => {
    if (e.key === 'Escape' && props.show) {
        close();
    }
};

onMounted(() => document.addEventListener('keydown', closeOnEscape));
onUnmounted(() => document.removeEventListener('keydown', closeOnEscape));

const maxWidthClass = {
    'sm': 'sm:max-w-sm',
    'md': 'sm:max-w-md',
    'lg': 'sm:max-w-lg',
    'xl': 'sm:max-w-xl',
    '2xl': 'sm:max-w-2xl',
    '3xl': 'sm:max-w-3xl',
    '4xl': 'sm:max-w-4xl',
    '5xl': 'sm:max-w-5xl',
    '6xl': 'sm:max-w-6xl',
}[props.maxWidth];
</script>

<template>
    <Teleport to="body">
        <transition leave-active-class="duration-200">
            <div v-show="show" class="fixed inset-0 flex items-center justify-center px-4 py-6 sm:px-0 z-[100]" scroll-region>
                <transition
                    enter-active-class="ease-out duration-300"
                    enter-from-class="opacity-0"
                    enter-to-class="opacity-100"
                    leave-active-class="ease-in duration-200"
                    leave-from-class="opacity-100"
                    leave-to-class="opacity-0"
                >
                    <div v-show="show" class="fixed inset-0 transform transition-all" @click="close">
                        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                    </div>
                </transition>

                <transition
                    enter-active-class="ease-out duration-300"
                    enter-from-class="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    enter-to-class="opacity-100 translate-y-0 sm:scale-100"
                    leave-active-class="ease-in duration-200"
                    leave-from-class="opacity-100 translate-y-0 sm:scale-100"
                    leave-to-class="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                >
                    <div
                        v-show="show"
                        class="bg-white rounded-xl overflow-hidden shadow-xl transform transition-all sm:w-full sm:mx-auto flex flex-col"
                        :class="maxWidthClass"
                        style="max-height: 90vh;"
                    >
                        <div class="flex-shrink-0 flex justify-between items-center px-6 py-4 border-b border-gray-100 bg-gray-50/50">
                            <h3 class="text-lg font-bold text-gray-800 m-0">
                                <slot name="title"></slot>
                            </h3>
                            <button @click="close" class="text-gray-400 hover:text-gray-600 transition-colors bg-transparent border-0 cursor-pointer">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                        <div class="flex-1 p-6 overflow-y-auto">
                            <slot name="content"></slot>
                        </div>
                        <div class="flex-shrink-0 px-6 py-4 border-t border-gray-100 bg-gray-50/50 flex justify-end gap-3" v-if="$slots.footer">
                            <slot name="footer"></slot>
                        </div>
                    </div>
                </transition>
            </div>
        </transition>
    </Teleport>
</template>
