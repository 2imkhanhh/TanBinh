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
    products: Array,
    categories: Array
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
    name_vi: '', name_en: '', slug: '', category_id: '',
    type_vi: '', type_en: '', style_vi: '', style_en: '',
    age_vi: '', age_en: '', drink_style_vi: '', drink_style_en: '',
    processing_type_vi: '', processing_type_en: '', packaging_vi: '', packaging_en: '',
    specialty_vi: '', specialty_en: '', grade_vi: '', grade_en: '',
    shelf_life_vi: '', shelf_life_en: '', weight_vi: '', weight_en: '',
    origin_vi: '', origin_en: '', brand_name_vi: '', brand_name_en: '',
    model_number_vi: '', model_number_en: '', payment_terms_vi: '', payment_terms_en: '',
    advantage_vi: '', advantage_en: '', leaf_origin_vi: '', leaf_origin_en: '',
    material_vi: '', material_en: '',
    is_active: true, is_featured: false, image: null, _method: 'POST'
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

const openEditModal = (product) => {
    isEditing.value = true;
    editId.value = product.id;
    form.clearErrors();
    form.name_vi = product.name_vi || '';
    form.name_en = product.name_en || '';
    form.slug = product.slug || '';
    form.category_id = product.category_id || '';
    form.type_vi = product.type_vi || '';
    form.type_en = product.type_en || '';
    form.style_vi = product.style_vi || '';
    form.style_en = product.style_en || '';
    form.age_vi = product.age_vi || '';
    form.age_en = product.age_en || '';
    form.drink_style_vi = product.drink_style_vi || '';
    form.drink_style_en = product.drink_style_en || '';
    form.processing_type_vi = product.processing_type_vi || '';
    form.processing_type_en = product.processing_type_en || '';
    form.packaging_vi = product.packaging_vi || '';
    form.packaging_en = product.packaging_en || '';
    form.specialty_vi = product.specialty_vi || '';
    form.specialty_en = product.specialty_en || '';
    form.grade_vi = product.grade_vi || '';
    form.grade_en = product.grade_en || '';
    form.shelf_life_vi = product.shelf_life_vi || '';
    form.shelf_life_en = product.shelf_life_en || '';
    form.weight_vi = product.weight_vi || '';
    form.weight_en = product.weight_en || '';
    form.origin_vi = product.origin_vi || '';
    form.origin_en = product.origin_en || '';
    form.brand_name_vi = product.brand_name_vi || '';
    form.brand_name_en = product.brand_name_en || '';
    form.model_number_vi = product.model_number_vi || '';
    form.model_number_en = product.model_number_en || '';
    form.payment_terms_vi = product.payment_terms_vi || '';
    form.payment_terms_en = product.payment_terms_en || '';
    form.advantage_vi = product.advantage_vi || '';
    form.advantage_en = product.advantage_en || '';
    form.leaf_origin_vi = product.leaf_origin_vi || '';
    form.leaf_origin_en = product.leaf_origin_en || '';
    form.material_vi = product.material_vi || '';
    form.material_en = product.material_en || '';
    form.is_active = product.is_active;
    form.is_featured = product.is_featured || false;
    form.image = null;
    form._method = 'PUT';
    currentImageUrl.value = product.image_url || '';
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
    let str = form.name_vi.toLowerCase();
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
    form.slug = str;
};

const submit = () => {
    if (isEditing.value) {
        form.post(route('admin.products.update', editId.value), {
            onSuccess: () => closeModal()
        });
    } else {
        form.post(route('admin.products.store'), {
            onSuccess: () => closeModal()
        });
    }
};

const deleteProduct = async (id) => {
    const confirmed = await showConfirm('Xóa sản phẩm', 'Bạn có chắc chắn muốn xóa sản phẩm này? Thao tác này không thể hoàn tác.');
    if (confirmed) {
        router.delete(route('admin.products.destroy', id), {
            preserveScroll: true
        });
    }
};
</script>

<template>
    <Head title="Quản lý sản phẩm" />
    
    <div class="page-header">
        <div>
            <h1 class="title">Sản phẩm</h1>
        </div>
        <button @click="openCreateModal" class="btn-primary">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="12" y1="5" x2="12" y2="19"></line>
                <line x1="5" y1="12" x2="19" y2="12"></line>
            </svg>
            Thêm sản phẩm
        </button>
    </div>
    
    <div class="card">
        <div class="table-toolbar">
            <input type="text" v-model="searchKeyword" class="form-control search-input"
                placeholder="Tìm kiếm sản phẩm..." />
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th width="60">STT</th>
                        <th width="80">Ảnh</th>
                        <th>Tên sản phẩm</th>
                        <th>Danh mục</th>
                        <th>Trạng thái</th>
                        <th>Nổi bật</th>
                        <th width="120" class="text-right">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(product, index) in products" :key="product.id">
                        <td>{{ index + 1 }}</td>
                        <td>
                            <div class="thumb">
                                <img v-if="product.image_url" :src="product.image_url" alt="Product" />
                                <div v-else class="no-img">No IMG</div>
                            </div>
                        </td>
                        <td class="font-medium text-dark">{{ product.name_vi }}</td>
                        <td>{{ product.category_name_vi }}</td>
                        <td>
                            <span :class="['status-dot', product.is_active ? 'active' : 'inactive']"></span>
                            {{ product.is_active ? 'Hiển thị' : 'Ẩn' }}
                        </td>
                        <td>
                            <span :class="['status-dot', product.is_featured ? 'active' : 'inactive']"></span>
                            {{ product.is_featured ? 'Nổi bật' : 'Không' }}
                        </td>
                        <td class="text-right">
                            <div class="actions">
                                <button @click="openEditModal(product)" class="btn-icon text-blue" title="Sửa">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                    </svg>
                                </button>
                                <button @click="deleteProduct(product.id)" class="btn-icon text-red" title="Xóa">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <polyline points="3 6 5 6 21 6"></polyline>
                                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr v-if="products.length === 0">
                        <td colspan="7" class="text-center py-4 text-gray">Không có sản phẩm nào.</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Form -->
    <AdminModal :show="isModalOpen" @close="closeModal" maxWidth="4xl">
        <template #title>
            {{ isEditing ? 'Cập nhật sản phẩm' : 'Thêm sản phẩm mới' }}
        </template>
        
        <template #content>
            <form @submit.prevent="submit" id="productForm">
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
                        <label>Tên sản phẩm <span class="required">*</span></label>
                        <input v-model="form.name_vi" @input="generateSlug" type="text" class="form-control" :required="activeTab === 'vi'">
                    </div>
                    
                    <div class="specs-grid">
                        <div class="form-group"><label>Loại sản phẩm</label><input v-model="form.type_vi" type="text" class="form-control"></div>
                        <div class="form-group"><label>Kiểu</label><input v-model="form.style_vi" type="text" class="form-control"></div>
                        <div class="form-group"><label>Độ tuổi</label><input v-model="form.age_vi" type="text" class="form-control"></div>
                        <div class="form-group"><label>Phong cách</label><input v-model="form.drink_style_vi" type="text" class="form-control"></div>
                        <div class="form-group"><label>Loại xử lý</label><input v-model="form.processing_type_vi" type="text" class="form-control"></div>
                        <div class="form-group"><label>Bao bì</label><input v-model="form.packaging_vi" type="text" class="form-control"></div>
                        <div class="form-group"><label>Đặc sản</label><input v-model="form.specialty_vi" type="text" class="form-control"></div>
                        <div class="form-group"><label>Lớp</label><input v-model="form.grade_vi" type="text" class="form-control"></div>
                        <div class="form-group"><label>Thời hạn sử dụng</label><input v-model="form.shelf_life_vi" type="text" class="form-control"></div>
                        <div class="form-group"><label>Trọng lượng</label><input v-model="form.weight_vi" type="text" class="form-control"></div>
                        <div class="form-group"><label>Nơi xuất xứ</label><input v-model="form.origin_vi" type="text" class="form-control"></div>
                        <div class="form-group"><label>Tên thương hiệu</label><input v-model="form.brand_name_vi" type="text" class="form-control"></div>
                        <div class="form-group"><label>Số mô hình</label><input v-model="form.model_number_vi" type="text" class="form-control"></div>
                        <div class="form-group"><label>Điều khoản thanh toán</label><input v-model="form.payment_terms_vi" type="text" class="form-control"></div>
                        <div class="form-group"><label>Lợi thế</label><input v-model="form.advantage_vi" type="text" class="form-control"></div>
                        <div class="form-group"><label>Nguồn gốc lá trà</label><input v-model="form.leaf_origin_vi" type="text" class="form-control"></div>
                        <div class="form-group"><label>Chất liệu</label><input v-model="form.material_vi" type="text" class="form-control"></div>
                    </div>
                </div>

                <div v-show="activeTab === 'en'">
                    <div class="form-group">
                        <label>Tên sản phẩm</label>
                        <input v-model="form.name_en" type="text" class="form-control">
                    </div>
                    
                    <div class="specs-grid">
                        <div class="form-group"><label>Loại sản phẩm</label><input v-model="form.type_en" type="text" class="form-control"></div>
                        <div class="form-group"><label>Kiểu</label><input v-model="form.style_en" type="text" class="form-control"></div>
                        <div class="form-group"><label>Độ tuổi</label><input v-model="form.age_en" type="text" class="form-control"></div>
                        <div class="form-group"><label>Phong cách</label><input v-model="form.drink_style_en" type="text" class="form-control"></div>
                        <div class="form-group"><label>Loại xử lý</label><input v-model="form.processing_type_en" type="text" class="form-control"></div>
                        <div class="form-group"><label>Bao bì</label><input v-model="form.packaging_en" type="text" class="form-control"></div>
                        <div class="form-group"><label>Đặc sản</label><input v-model="form.specialty_en" type="text" class="form-control"></div>
                        <div class="form-group"><label>Lớp</label><input v-model="form.grade_en" type="text" class="form-control"></div>
                        <div class="form-group"><label>Thời hạn sử dụng</label><input v-model="form.shelf_life_en" type="text" class="form-control"></div>
                        <div class="form-group"><label>Trọng lượng</label><input v-model="form.weight_en" type="text" class="form-control"></div>
                        <div class="form-group"><label>Nơi xuất xứ</label><input v-model="form.origin_en" type="text" class="form-control"></div>
                        <div class="form-group"><label>Tên thương hiệu</label><input v-model="form.brand_name_en" type="text" class="form-control"></div>
                        <div class="form-group"><label>Số mô hình</label><input v-model="form.model_number_en" type="text" class="form-control"></div>
                        <div class="form-group"><label>Điều khoản thanh toán</label><input v-model="form.payment_terms_en" type="text" class="form-control"></div>
                        <div class="form-group"><label>Lợi thế</label><input v-model="form.advantage_en" type="text" class="form-control"></div>
                        <div class="form-group"><label>Nguồn gốc lá trà</label><input v-model="form.leaf_origin_en" type="text" class="form-control"></div>
                        <div class="form-group"><label>Chất liệu</label><input v-model="form.material_en" type="text" class="form-control"></div>
                    </div>
                </div>

                <h3 class="form-section-title" style="margin-top: 1rem;">Thông tin chung</h3>
                <div class="form-row">
                    <div class="form-group flex-1">
                        <label>Đường dẫn (Slug) <span class="required">*</span></label>
                        <input v-model="form.slug" type="text" class="form-control" required>
                    </div>
                    <div class="form-group flex-1">
                        <label>Danh mục <span class="required">*</span></label>
                        <select v-model="form.category_id" class="form-control" required>
                            <option value="">--- Chọn danh mục ---</option>
                            <option v-for="c in categories" :key="c.id" :value="c.id">{{ c.name_vi }}</option>
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
                        <label style="display: flex; align-items: center; gap: 8px; cursor: pointer; margin-bottom: 0;">
                            <input type="checkbox" v-model="form.is_featured" style="width: 18px; height: 18px; outline: none; box-shadow: none;" class="focus:ring-0 focus:ring-offset-0">
                            <span>Sản phẩm nổi bật (Hiển thị trang chủ)</span>
                        </label>
                    </div>
                </div>
            </form>
        </template>
        
        <template #footer>
            <button type="button" @click="closeModal" class="btn-default">Hủy</button>
            <button type="submit" form="productForm" class="btn-primary" :disabled="form.processing">
                {{ form.processing ? 'Đang xử lý...' : (isEditing ? 'Cập nhật' : 'Lưu lại') }}
            </button>
        </template>
    </AdminModal>
</template>

<style scoped>

.specs-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 15px;
    margin-top: 10px;
    padding: 15px;
    background: #f8fafc;
    border-radius: 8px;
    border: 1px solid #e2e8f0;
}
.specs-grid .form-group {
    margin-bottom: 0;
}
.specs-grid .form-group label {
    font-size: 0.8rem;
    color: #64748b;
    margin-bottom: 4px;
}
.specs-grid .form-group input {
    padding: 0.5rem;
    font-size: 0.9rem;
}

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
