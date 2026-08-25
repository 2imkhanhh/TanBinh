<script setup>
import { ref } from 'vue';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';

defineOptions({ layout: AdminLayout });

const props = defineProps({
    settings: Object
});

const activeTab = ref('vi');

// Helper to ensure each setting has an object with vi and en
const getSetting = (key) => {
    return props.settings[key] || { vi: '', en: '' };
};

const form = useForm({
    site_title: getSetting('site_title'),
    home_intro_title: getSetting('home_intro_title'),
    home_intro_desc: getSetting('home_intro_desc'),
    contact_phone: getSetting('contact_phone'),
    contact_email: getSetting('contact_email'),
    contact_address: getSetting('contact_address'),
});

const submit = () => {
    form.post(route('admin.settings.store'), {
        preserveScroll: true
    });
};
</script>

<template>
    <Head title="Cấu hình chung" />

    <div class="page-header">
        <div>
            <h1 class="title">Cấu hình</h1>
            <p class="subtitle">Cấu hình chung hệ thống</p>
        </div>
    </div>

    <div class="card">
        <div style="padding: 1.5rem 1.5rem 0 1.5rem;">
            <div class="lang-tabs">
                <button type="button" class="lang-tab" :class="{ active: activeTab === 'vi' }" @click="activeTab = 'vi'">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 20" width="24" height="16" style="border-radius: 2px;"><rect width="30" height="20" fill="#da251d"/><polygon points="15,4 11.47,14.85 20.71,8.15 9.29,8.15 18.53,14.85" fill="#ffcd00" fill-rule="nonzero"/></svg> Tiếng Việt
                </button>
                <button type="button" class="lang-tab" :class="{ active: activeTab === 'en' }" @click="activeTab = 'en'">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 480" width="24" height="16" style="border-radius: 2px;"><path fill="#012169" d="M0 0h640v480H0z"/><path fill="#FFF" d="m75 0 244 181L562 0h78v62L400 241l240 178v61h-80L320 301 81 480H0v-60l239-178L0 64V0z"/><path fill="#C8102E" d="m424 281 216 159v40L369 281zm-184 20 6 35L22 480H0zM640 0 439 150l-6-37L640 0zM0 0l227 170 5-31L0 0z"/><path fill="#FFF" d="M241 0v480h160V0zM0 160v160h640V160z"/><path fill="#C8102E" d="M0 193v96h640v-96zM273 0v480h96V0z"/></svg> Tiếng Anh
                </button>
            </div>
        </div>

        <div style="padding: 0 1.5rem 1.5rem 1.5rem;">
            <form @submit.prevent="submit">
                
                <h3 class="form-section-title" style="margin-top: 0;">Thông tin chung</h3>
                <div v-show="activeTab === 'vi'">
                    <div class="form-group">
                        <label>Tiêu đề Website</label>
                        <input v-model="form.site_title.vi" type="text" class="form-control">
                    </div>
                </div>
                <div v-show="activeTab === 'en'">
                    <div class="form-group">
                        <label>Tiêu đề Website</label>
                        <input v-model="form.site_title.en" type="text" class="form-control">
                    </div>
                </div>
                
                <h3 class="form-section-title">Giới thiệu trang chủ</h3>
                <div v-show="activeTab === 'vi'">
                    <div class="form-group">
                        <label>Tiêu đề giới thiệu</label>
                        <input v-model="form.home_intro_title.vi" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Mô tả giới thiệu</label>
                        <textarea v-model="form.home_intro_desc.vi" rows="4" class="form-control"></textarea>
                    </div>
                </div>
                <div v-show="activeTab === 'en'">
                    <div class="form-group">
                        <label>Tiêu đề giới thiệu</label>
                        <input v-model="form.home_intro_title.en" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Mô tả giới thiệu</label>
                        <textarea v-model="form.home_intro_desc.en" rows="4" class="form-control"></textarea>
                    </div>
                </div>

                <h3 class="form-section-title">Thông tin liên hệ</h3>
                <div v-show="activeTab === 'vi'">
                    <div class="form-group">
                        <label>Địa chỉ</label>
                        <input v-model="form.contact_address.vi" type="text" class="form-control">
                    </div>
                </div>
                <div v-show="activeTab === 'en'">
                    <div class="form-group">
                        <label>Địa chỉ</label>
                        <input v-model="form.contact_address.en" type="text" class="form-control">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group flex-1">
                        <label>Số điện thoại</label>
                        <input v-model="form.contact_phone.vi" type="text" class="form-control">
                    </div>
                    <div class="form-group flex-1">
                        <label>Email liên hệ</label>
                        <input v-model="form.contact_email.vi" type="text" class="form-control">
                    </div>
                </div>
                
                <div style="margin-top: 2rem; display: flex; justify-content: flex-end; align-items: center; gap: 1rem; border-top: 1px solid #e2e8f0; padding-top: 1.5rem;">
                    <span v-if="form.recentlySuccessful" style="color: #108140; font-size: 0.9rem; font-weight: 500;">Đã lưu thành công.</span>
                    <button type="submit" class="btn-primary" :disabled="form.processing">
                        {{ form.processing ? 'Đang xử lý...' : 'Lưu cài đặt' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>
