<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, Link } from '@inertiajs/vue3';

defineProps({
    categories: Array
});

const form = useForm({
    title_vi: '',
    title_en: '',
    slug: '',
    category_id: '',
    excerpt_vi: '',
    excerpt_en: '',
    content_vi: '',
    content_en: '',
    is_active: true,
    image: null
});

const generateSlug = () => {
    let str = form.title_vi.toLowerCase();
    str = str.replace(/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/g, 'a');
    str = str.replace(/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/g, 'e');
    str = str.replace(/(ì|í|ị|ỉ|ĩ)/g, 'i');
    str = str.replace(/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/g, 'o');
    str = str.replace(/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/g, 'u');
    str = str.replace(/(ỳ|ý|ỵ|ỷ|ỹ)/g, 'y');
    str = str.replace(/(đ)/g, 'd');
    str = str.replace(/([^a-z0-9-\s])/g, '');
    str = str.replace(/(\s+)/g, '-');
    str = str.replace(/^-+/g, '');
    str = str.replace(/-+$/g, '');
    if(!form.slug) form.slug = str;
};

const handleImage = (e) => {
    form.image = e.target.files[0];
};

const submit = () => {
    form.post(route('admin.posts.store'));
};
</script>

<template>
    <Head title="Thêm bài viết" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Thêm Bài viết</h2>
        </template>
        <div class="py-12">
            <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <form @submit.prevent="submit" class="space-y-6">
                        
                        <div class="grid grid-cols-2 gap-4 border-b pb-4">
                            <div>
                                <label class="block font-medium text-sm text-gray-700">Tiêu đề (Tiếng Việt) *</label>
                                <input v-model="form.title_vi" @blur="generateSlug" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                            </div>
                            <div>
                                <label class="block font-medium text-sm text-gray-700">Tiêu đề (Tiếng Anh)</label>
                                <input v-model="form.title_en" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
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
                                <label class="block font-medium text-sm text-gray-700">Tóm tắt (VI)</label>
                                <textarea v-model="form.excerpt_vi" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                            </div>
                            <div>
                                <label class="block font-medium text-sm text-gray-700">Tóm tắt (EN)</label>
                                <textarea v-model="form.excerpt_en" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
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
                                <label class="block font-medium text-sm text-gray-700">Hình ảnh đại diện</label>
                                <input type="file" @change="handleImage" class="mt-1 block w-full">
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
                                Lưu lại
                            </button>
                            <Link :href="route('admin.posts.index')" class="text-sm text-gray-600 underline">Hủy</Link>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
