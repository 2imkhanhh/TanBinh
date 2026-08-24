<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, Link } from '@inertiajs/vue3';

const props = defineProps({
    product: Object,
    categories: Array
});

const form = useForm({
    name_vi: props.product.name_vi || '',
    name_en: props.product.name_en || '',
    slug: props.product.slug || '',
    category_id: props.product.category_id || '',
    short_desc_vi: props.product.short_desc_vi || '',
    short_desc_en: props.product.short_desc_en || '',
    content_vi: props.product.content_vi || '',
    content_en: props.product.content_en || '',
    is_active: props.product.is_active,
    image: null,
    _method: 'PUT' // For multipart/form-data with PUT in Laravel
});

const handleImage = (e) => {
    form.image = e.target.files[0];
};

const submit = () => {
    form.post(route('admin.products.update', props.product.id));
};
</script>

<template>
    <Head title="Sửa sản phẩm" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Sửa Sản phẩm</h2>
        </template>
        <div class="py-12">
            <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <form @submit.prevent="submit" class="space-y-6">
                        
                        <div class="grid grid-cols-2 gap-4 border-b pb-4">
                            <div>
                                <label class="block font-medium text-sm text-gray-700">Tên (Tiếng Việt) *</label>
                                <input v-model="form.name_vi" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                            </div>
                            <div>
                                <label class="block font-medium text-sm text-gray-700">Tên (Tiếng Anh)</label>
                                <input v-model="form.name_en" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4 border-b pb-4">
                            <div>
                                <label class="block font-medium text-sm text-gray-700">Đường dẫn (Slug) *</label>
                                <input v-model="form.slug" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                            </div>
                            <div>
                                <label class="block font-medium text-sm text-gray-700">Danh mục *</label>
                                <select v-model="form.category_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                    <option value="">--- Chọn danh mục ---</option>
                                    <option v-for="c in categories" :key="c.id" :value="c.id">{{ c.name_vi }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4 border-b pb-4">
                            <div>
                                <label class="block font-medium text-sm text-gray-700">Mô tả ngắn (VI)</label>
                                <textarea v-model="form.short_desc_vi" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                            </div>
                            <div>
                                <label class="block font-medium text-sm text-gray-700">Mô tả ngắn (EN)</label>
                                <textarea v-model="form.short_desc_en" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4 border-b pb-4">
                            <div>
                                <label class="block font-medium text-sm text-gray-700">Nội dung (VI)</label>
                                <textarea v-model="form.content_vi" rows="6" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                            </div>
                            <div>
                                <label class="block font-medium text-sm text-gray-700">Nội dung (EN)</label>
                                <textarea v-model="form.content_en" rows="6" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4 border-b pb-4">
                            <div>
                                <label class="block font-medium text-sm text-gray-700">Hình ảnh đại diện mới (để trống nếu không đổi)</label>
                                <input type="file" @change="handleImage" class="mt-1 block w-full">
                                <div class="mt-2" v-if="product.image_url">
                                    <img :src="product.image_url" class="h-16 w-16 object-cover rounded border" />
                                </div>
                            </div>
                            <div class="flex items-center mt-6">
                                <label class="flex items-center">
                                    <input type="checkbox" v-model="form.is_active" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                    <span class="ml-2 text-sm text-gray-600">Trạng thái hiển thị</span>
                                </label>
                            </div>
                        </div>

                        <div class="flex items-center gap-4 mt-6">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700" :disabled="form.processing">
                                Cập nhật
                            </button>
                            <Link :href="route('admin.products.index')" class="text-sm text-gray-600 underline">Hủy</Link>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
