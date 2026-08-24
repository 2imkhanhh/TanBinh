<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';

const props = defineProps({
    settings: Object
});

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

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Cấu hình chung</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <form @submit.prevent="submit" class="space-y-6">
                        
                        <!-- Site Title -->
                        <div class="grid grid-cols-2 gap-4 border-b pb-4">
                            <div>
                                <label class="block font-medium text-sm text-gray-700">Tiêu đề Website (Tiếng Việt)</label>
                                <input v-model="form.site_title.vi" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                            <div>
                                <label class="block font-medium text-sm text-gray-700">Tiêu đề Website (Tiếng Anh)</label>
                                <input v-model="form.site_title.en" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                        </div>
                        
                        <!-- Home Intro Title -->
                        <div class="grid grid-cols-2 gap-4 border-b pb-4">
                            <div>
                                <label class="block font-medium text-sm text-gray-700">Tiêu đề Giới thiệu Trang chủ (Tiếng Việt)</label>
                                <input v-model="form.home_intro_title.vi" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                            <div>
                                <label class="block font-medium text-sm text-gray-700">Tiêu đề Giới thiệu Trang chủ (Tiếng Anh)</label>
                                <input v-model="form.home_intro_title.en" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                        </div>

                        <!-- Home Intro Desc -->
                        <div class="grid grid-cols-2 gap-4 border-b pb-4">
                            <div>
                                <label class="block font-medium text-sm text-gray-700">Mô tả Giới thiệu Trang chủ (Tiếng Việt)</label>
                                <textarea v-model="form.home_intro_desc.vi" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                            </div>
                            <div>
                                <label class="block font-medium text-sm text-gray-700">Mô tả Giới thiệu Trang chủ (Tiếng Anh)</label>
                                <textarea v-model="form.home_intro_desc.en" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                            </div>
                        </div>

                        <!-- Contact Info -->
                        <div class="grid grid-cols-2 gap-4 border-b pb-4">
                            <div>
                                <label class="block font-medium text-sm text-gray-700">Địa chỉ (Tiếng Việt)</label>
                                <input v-model="form.contact_address.vi" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                            <div>
                                <label class="block font-medium text-sm text-gray-700">Địa chỉ (Tiếng Anh)</label>
                                <input v-model="form.contact_address.en" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4 border-b pb-4">
                            <div>
                                <label class="block font-medium text-sm text-gray-700">Số điện thoại</label>
                                <input v-model="form.contact_phone.vi" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                            <div>
                                <label class="block font-medium text-sm text-gray-700">Email liên hệ</label>
                                <input v-model="form.contact_email.vi" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                        </div>
                        
                        <div class="flex items-center gap-4">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150" :disabled="form.processing">
                                Lưu cài đặt
                            </button>
                            <span v-if="form.recentlySuccessful" class="text-sm text-green-600">Đã lưu thành công.</span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
