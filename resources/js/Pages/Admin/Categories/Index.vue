<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    categories: Array
});
</script>

<template>
    <Head title="Quản lý danh mục" />
    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Danh mục</h2>
                <Link :href="route('admin.categories.create')" class="px-4 py-2 bg-gray-800 text-white rounded-md text-sm">Thêm mới</Link>
            </div>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tên (VI)</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tên (EN)</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Loại</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Hành động</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr v-for="cat in categories" :key="cat.id">
                                <td class="px-6 py-4 whitespace-nowrap">{{ cat.name_vi }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ cat.name_en }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800" v-if="cat.type === 'product'">Sản phẩm</span>
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800" v-else>Bài viết</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <Link :href="route('admin.categories.edit', cat.id)" class="text-indigo-600 hover:text-indigo-900 mr-4">Sửa</Link>
                                    <Link :href="route('admin.categories.destroy', cat.id)" method="delete" as="button" class="text-red-600 hover:text-red-900">Xóa</Link>
                                </td>
                            </tr>
                            <tr v-if="categories.length === 0">
                                <td colspan="4" class="px-6 py-4 text-center text-gray-500">Chưa có dữ liệu</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
