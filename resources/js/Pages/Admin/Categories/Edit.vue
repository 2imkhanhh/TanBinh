<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, Link } from '@inertiajs/vue3';

const props = defineProps({
    category: Object,
    parents: Array
});

const form = useForm({
    name_vi: props.category.name_vi || '',
    name_en: props.category.name_en || '',
    slug: props.category.slug || '',
    type: props.category.type || 'product',
    parent_id: props.category.parent_id || ''
});

const submit = () => {
    form.put(route('admin.categories.update', props.category.id));
};
</script>

<template>
    <Head title="Sửa danh mục" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Sửa Danh mục</h2>
        </template>
        <div class="py-12">
            <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <form @submit.prevent="submit" class="space-y-4">
                        <div>
                            <label class="block font-medium text-sm text-gray-700">Tên (Tiếng Việt) *</label>
                            <input v-model="form.name_vi" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                        </div>
                        <div>
                            <label class="block font-medium text-sm text-gray-700">Tên (Tiếng Anh)</label>
                            <input v-model="form.name_en" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>
                        <div>
                            <label class="block font-medium text-sm text-gray-700">Đường dẫn (Slug) *</label>
                            <input v-model="form.slug" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                            <div class="text-red-500 text-xs mt-1" v-if="form.errors.slug">{{ form.errors.slug }}</div>
                        </div>
                        <div>
                            <label class="block font-medium text-sm text-gray-700">Loại danh mục *</label>
                            <select v-model="form.type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="product">Sản phẩm</option>
                                <option value="post">Bài viết (Blog)</option>
                            </select>
                        </div>
                        <div>
                            <label class="block font-medium text-sm text-gray-700">Danh mục cha</label>
                            <select v-model="form.parent_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">--- Không có ---</option>
                                <option v-for="p in parents" :key="p.id" :value="p.id">{{ p.name_vi }}</option>
                            </select>
                        </div>
                        <div class="flex items-center gap-4 mt-6">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                                Cập nhật
                            </button>
                            <Link :href="route('admin.categories.index')" class="text-sm text-gray-600 underline">Hủy</Link>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
