<script setup>
import { ref, inject, watch } from 'vue';
import { Head, router, useForm } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import AdminModal from '@/Components/Admin/AdminModal.vue';
import { QuillEditor } from '@vueup/vue-quill';
import '@vueup/vue-quill/dist/vue-quill.snow.css';

const showConfirm = inject('confirm');

defineOptions({ layout: AdminLayout });

const props = defineProps({
    posts: Array
});

const searchKeyword = ref('');
let searchTimeout = null;
watch(searchKeyword, (value) => {
    clearTimeout(searchTimeout);
    searchTimeout = setTimeout(() => {
        // Placeholder for search logic
    }, 300);
});

// Modal State
const isModalOpen = ref(false);
const isEditing = ref(false);
const activeTab = ref('vi');
const editId = ref(null);
const currentImageUrl = ref('');

const form = useForm({
    title_vi: '',
    title_en: '',
    slug: '',
    type: 'tin-tuc',
    excerpt_vi: '',
    excerpt_en: '',
    content_vi: '',
    content_en: '',
    is_active: true,
    image: null,
    _method: 'POST'
});

const openCreateModal = () => {
    isEditing.value = false;
    form.reset();
    form.clearErrors();
    form._method = 'POST';
    activeTab.value = 'vi';
    currentImageUrl.value = '';
    isModalOpen.value = true;
};

const openEditModal = (post) => {
    isEditing.value = true;
    editId.value = post.id;
    form.clearErrors();
    form.title_vi = post.title_vi || '';
    form.title_en = post.title_en || '';
    form.slug = post.slug || '';
    form.type = post.type || 'tin-tuc';
    form.excerpt_vi = post.excerpt_vi || '';
    form.excerpt_en = post.excerpt_en || '';
    form.content_vi = post.content_vi || '';
    form.content_en = post.content_en || '';
    form.is_active = post.is_active;
    form.image = null;
    form._method = 'PUT';
    currentImageUrl.value = post.image_url || '';
    activeTab.value = 'vi';
    isModalOpen.value = true;
};

const closeModal = () => {
    isModalOpen.value = false;
};

const handleImage = (e) => {
    form.image = e.target.files[0];
};

const generateSlug = () => {
    if (isEditing.value) return; // Don't auto-generate on edit unless empty
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

const submit = () => {
    if (isEditing.value) {
        form.post(route('admin.posts.update', editId.value), {
            onSuccess: () => closeModal()
        });
    } else {
        form.post(route('admin.posts.store'), {
            onSuccess: () => closeModal()
        });
    }
};

const deletePost = async (id) => {
    const confirmed = await showConfirm('Xóa bài viết', 'Bạn có chắc chắn muốn xóa bài viết này? Thao tác này không thể hoàn tác.');
    if (confirmed) {
        router.delete(route('admin.posts.destroy', id), {
            preserveScroll: true
        });
    }
};
</script>

<template>
    <Head title="Quản lý bài viết" />
    
    <div class="page-header">
        <div>
            <h1 class="title">Bài viết</h1>
        </div>
        <button @click="openCreateModal" class="btn-primary">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="12" y1="5" x2="12" y2="19"></line>
                <line x1="5" y1="12" x2="19" y2="12"></line>
            </svg>
            Thêm bài viết
        </button>
    </div>
    
    <div class="card">
        <div class="table-toolbar">
            <input type="text" v-model="searchKeyword" class="form-control search-input"
                placeholder="Tìm kiếm bài viết..." />
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th width="60">STT</th>
                        <th width="100">Ảnh bìa</th>
                        <th>Tiêu đề</th>
                        <th>Phân loại</th>
                        <th>Trạng thái</th>
                        <th width="120" class="text-right">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(post, index) in posts" :key="post.id">
                        <td>{{ index + 1 }}</td>
                        <td>
                            <div class="thumb thumb-wide">
                                <img v-if="post.image_url" :src="post.image_url" alt="Post" />
                                <div v-else class="no-img">No IMG</div>
                            </div>
                        </td>
                        <td class="font-medium text-dark">
                            <div class="text-truncate" style="max-width: 300px;">{{ post.title_vi }}</div>
                        </td>
                        <td>
                            <span v-if="post.type === 'hinh-anh'">Hình ảnh</span>
                            <span v-else-if="post.type === 'khac'">Khác</span>
                            <span v-else>Tin tức</span>
                        </td>
                        <td>
                            <span :class="['status-dot', post.is_active ? 'active' : 'inactive']"></span>
                            {{ post.is_active ? 'Hiển thị' : 'Ẩn' }}
                        </td>
                        <td class="text-right">
                            <div class="actions">
                                <button @click="openEditModal(post)" class="btn-icon text-blue" title="Sửa">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                    </svg>
                                </button>
                                <button @click="deletePost(post.id)" class="btn-icon text-red" title="Xóa">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <polyline points="3 6 5 6 21 6"></polyline>
                                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr v-if="posts.length === 0">
                        <td colspan="6" class="text-center py-4 text-gray">Không có bài viết nào.</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Form -->
    <AdminModal :show="isModalOpen" @close="closeModal" maxWidth="4xl">
        <template #title>
            {{ isEditing ? 'Cập nhật bài viết' : 'Thêm bài viết mới' }}
        </template>
        
        <template #content>
            <form @submit.prevent="submit" id="postForm">
                <div class="lang-tabs" style="margin-top: -0.5rem;">
                    <button type="button" class="lang-tab" :class="{ active: activeTab === 'vi' }" @click="activeTab = 'vi'">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 20" width="24" height="16" style="border-radius: 2px;"><rect width="30" height="20" fill="#da251d"/><polygon points="15,4 11.47,14.85 20.71,8.15 9.29,8.15 18.53,14.85" fill="#ffcd00" fill-rule="nonzero"/></svg> Tiếng Việt
                    </button>
                    <button type="button" class="lang-tab" :class="{ active: activeTab === 'en' }" @click="activeTab = 'en'">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 480" width="24" height="16" style="border-radius: 2px;"><path fill="#012169" d="M0 0h640v480H0z"/><path fill="#FFF" d="m75 0 244 181L562 0h78v62L400 241l240 178v61h-80L320 301 81 480H0v-60l239-178L0 64V0z"/><path fill="#C8102E" d="m424 281 216 159v40L369 281zm-184 20 6 35L22 480H0zM640 0 439 150l-6-37L640 0zM0 0l227 170 5-31L0 0z"/><path fill="#FFF" d="M241 0v480h160V0zM0 160v160h640V160z"/><path fill="#C8102E" d="M0 193v96h640v-96zM273 0v480h96V0z"/></svg> Tiếng Anh
                    </button>
                </div>

                <div v-show="activeTab === 'vi'">
                    <div class="form-group">
                        <label>Tiêu đề bài viết <span class="required">*</span></label>
                        <input v-model="form.title_vi" @blur="generateSlug" type="text" class="form-control" :required="activeTab === 'vi'">
                    </div>
                    
                    <div class="form-group">
                        <label>Tóm tắt</label>
                        <textarea v-model="form.excerpt_vi" rows="3" class="form-control"></textarea>
                    </div>

                    <div class="form-group">
                        <label>Nội dung chi tiết</label>
                        <QuillEditor v-model:content="form.content_vi" contentType="html" theme="snow" toolbar="full" style="height: 300px;" />
                    </div>
                </div>

                <div v-show="activeTab === 'en'">
                    <div class="form-group">
                        <label>Tiêu đề bài viết</label>
                        <input v-model="form.title_en" type="text" class="form-control">
                    </div>
                    
                    <div class="form-group">
                        <label>Tóm tắt</label>
                        <textarea v-model="form.excerpt_en" rows="3" class="form-control"></textarea>
                    </div>

                    <div class="form-group">
                        <label>Nội dung chi tiết</label>
                        <QuillEditor v-model:content="form.content_en" contentType="html" theme="snow" toolbar="full" style="height: 300px;" />
                    </div>
                </div>

                <h3 class="form-section-title" style="margin-top: 1rem;">Thông tin chung</h3>
                <div class="form-row">
                    <div class="form-group flex-1">
                        <label>Đường dẫn (Slug) <span class="required">*</span></label>
                        <input v-model="form.slug" type="text" class="form-control" required>
                    </div>
                    <div class="form-group flex-1">
                        <label>Phân loại <span class="required">*</span></label>
                        <select v-model="form.type" class="form-control" required>
                            <option value="tin-tuc">Tin tức</option>
                            <option value="hinh-anh">Hình ảnh</option>
                            <option value="khac">Khác</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group flex-1">
                        <label>Hình ảnh đại diện</label>
                        <div style="display: flex; gap: 1rem; align-items: flex-start; margin-top: 0.25rem;">
                            <div v-if="currentImageUrl" style="flex-shrink: 0;">
                                <img :src="currentImageUrl" style="height: 64px; width: 64px; object-fit: cover; border-radius: 8px; border: 1px solid #e2e8f0;" />
                            </div>
                            <div style="flex-grow: 1;">
                                <input type="file" @change="handleImage" class="form-control" style="padding: 0.4rem 1rem;">
                            </div>
                        </div>
                    </div>
                    <div class="form-group flex-1" style="display: flex; flex-direction: column; justify-content: center; gap: 0.75rem; padding-top: 1.5rem;">
                        <label style="display: flex; align-items: center; gap: 8px; cursor: pointer; margin-bottom: 0;">
                            <input type="checkbox" v-model="form.is_active" style="width: 18px; height: 18px; outline: none; box-shadow: none;" class="focus:ring-0 focus:ring-offset-0">
                            <span>Trạng thái hiển thị</span>
                        </label>
                    </div>
                </div>
            </form>
        </template>
        
        <template #footer>
            <button type="button" @click="closeModal" class="btn-default">Hủy</button>
            <button type="submit" form="postForm" class="btn-primary" :disabled="form.processing">
                {{ form.processing ? 'Đang xử lý...' : (isEditing ? 'Cập nhật' : 'Lưu lại') }}
            </button>
        </template>
    </AdminModal>
</template>

<style scoped>
.page-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
}

.title {
    font-size: 1.5rem;
    font-weight: 700;
    color: #0f172a;
    margin: 0;
}

.card {
    background: #ffffff;
    border-radius: 16px;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    border: 1px solid #f1f5f9;
    overflow: hidden;
}

.table-toolbar {
    padding: 1rem;
    border-bottom: 1px solid #e2e8f0;
}

.search-input {
    max-width: 300px;
}

.table-responsive {
    overflow-x: auto;
}

.table {
    width: 100%;
    border-collapse: collapse;
}

.table th {
    background: #f8fafc;
    color: #64748b;
    font-weight: 600;
    font-size: 0.8rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    padding: 1rem;
    text-align: left;
    border-bottom: 1px solid #e2e8f0;
}

.table td {
    padding: 1rem;
    vertical-align: middle;
    border-bottom: 1px solid #f1f5f9;
    font-size: 0.9rem;
    color: #475569;
}

.table tr:last-child td {
    border-bottom: none;
}

.table tr:hover {
    background: #f8fafc;
}

.text-right {
    text-align: right;
}

.text-center {
    text-align: center;
}

.font-medium {
    font-weight: 500;
}

.text-dark {
    color: #0f172a;
}

.text-gray {
    color: #94a3b8;
}

.text-truncate {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.py-4 {
    padding-top: 1.5rem;
    padding-bottom: 1.5rem;
}

.thumb {
    width: 40px;
    height: 40px;
    border-radius: 8px;
    background: #f1f5f9;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
}

.thumb-wide {
    width: 60px;
    height: 40px;
}

.thumb img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.no-img {
    font-size: 0.6rem;
    color: #94a3b8;
    font-weight: bold;
}

.status-dot {
    display: inline-block;
    width: 8px;
    height: 8px;
    border-radius: 50%;
    margin-right: 6px;
}

.status-dot.active {
    background: #108140;
}

.status-dot.inactive {
    background: #cbd5e1;
}

.actions {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 0.5rem;
}

.btn-icon {
    background: none;
    border: none;
    cursor: pointer;
    padding: 0.4rem;
    border-radius: 8px;
    transition: all 0.2s;
    display: flex;
    align-items: center;
    justify-content: center;
}

.btn-icon svg {
    width: 18px;
    height: 18px;
}

.btn-icon:hover {
    background: #f1f5f9;
}

.text-blue {
    color: #3b82f6;
}

.text-red {
    color: #ef4444;
}
</style>
