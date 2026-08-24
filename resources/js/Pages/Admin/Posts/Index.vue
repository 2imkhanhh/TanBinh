<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    posts: Array
});
</script>

<template>
    <Head title="Quản lý bài viết" />
    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Bài viết (Blog)</h2>
                <Link :href="route('admin.posts.create')" class="px-4 py-2 bg-gray-800 text-white rounded-md text-sm">Thêm mới</Link>
            </div>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Hình ảnh</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tiêu đề</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Danh mục</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Trạng thái</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Hành động</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr v-for="post in posts" :key="post.id">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <img v-if="post.image_url" :src="post.image_url" class="h-12 w-12 object-cover rounded" />
                                    <div v-else class="h-12 w-12 bg-gray-200 rounded"></div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ post.title_vi }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ post.category ? post.category.name_vi : '' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span v-if="post.is_active" class="px-2 text-xs font-semibold rounded-full bg-green-100 text-green-800">Hiển thị</span>
                                    <span v-else class="px-2 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">Ẩn</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <Link :href="route('admin.posts.edit', post.id)" class="text-indigo-600 hover:text-indigo-900 mr-4">Sửa</Link>
                                    <Link :href="route('admin.posts.destroy', post.id)" method="delete" as="button" class="text-red-600 hover:text-red-900">Xóa</Link>
                                </td>
                            </tr>
                            <tr v-if="posts.length === 0">
                                <td colspan="5" class="px-6 py-4 text-center text-gray-500">Chưa có dữ liệu</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
