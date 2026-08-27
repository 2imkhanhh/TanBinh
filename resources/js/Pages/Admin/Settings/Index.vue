<script setup>
import { ref, computed } from 'vue';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head, useForm, usePage } from '@inertiajs/vue3';
import { QuillEditor } from '@vueup/vue-quill';
import '@vueup/vue-quill/dist/vue-quill.snow.css';

defineOptions({ layout: AdminLayout });

const props = defineProps({
    settings: Object
});

const page = usePage();

const activeSection = ref('general');
const activeLang = ref('vi');

// Helper to ensure each setting has an object with vi and en
const getSetting = (key) => {
    let val = props.settings[key];
    if (!val) return { vi: '', en: '' };
    if (typeof val === 'string') return { vi: val, en: val };
    return { vi: val.vi || '', en: val.en || '' };
};

const getSettingStr = (key) => {
    // If it's a file path, both vi and en are typically the same, just get vi.
    return props.settings[key]?.vi || '';
};

const getSettingJson = (key) => {
    try {
        let jsonStr = props.settings[key]?.vi || '[]';
        return JSON.parse(jsonStr);
    } catch (e) {
        return [];
    }
}

const form = useForm({
    // General
    site_title: getSetting('site_title'),
    contact_phone: getSetting('contact_phone'),
    contact_email: getSetting('contact_email'),
    contact_address: getSetting('contact_address'),
    contact_website: getSetting('contact_website'),

    // Images
    logo: null,
    footer_logo: null,

    // Home
    home_hero_image: null,
    home_intro_title: getSetting('home_intro_title'),
    home_intro_desc: getSetting('home_intro_desc'),
    home_about_title: getSetting('home_about_title'),
    home_about_desc: getSetting('home_about_desc'),
    home_about_image: null,

    // About
    about_hero_image: null,
    about_hero_title: getSetting('about_hero_title'),
    about_hero_desc: getSetting('about_hero_desc'),
    about_short: getSetting('about_short'),
    about_long: getSetting('about_long'),
    core_values: {
        vi: Array.isArray(props.settings['core_values']?.vi) ? props.settings['core_values'].vi : [],
        en: Array.isArray(props.settings['core_values']?.en) ? props.settings['core_values'].en : []
    },
    vision: getSetting('vision'),
    mission: getSetting('mission'),
    company_culture: getSetting('company_culture'),

    // Products
    product_hero_image: null,
    product_hero_title: getSetting('product_hero_title'),
    product_hero_desc: getSetting('product_hero_desc'),

    // Contact
    contact_hero_image: null,
    contact_hero_title: getSetting('contact_hero_title'),
    contact_hero_desc: getSetting('contact_hero_desc'),
    contact_phone: getSetting('contact_phone'),
    contact_email: getSetting('contact_email'),
    contact_address: getSetting('contact_address'),
    contact_website: getSetting('contact_website'),
    contact_map_iframe: getSetting('contact_map_iframe'),
});

const addCoreValue = () => {
    form.core_values.vi.push('');
    form.core_values.en.push('');
};
const removeCoreValue = (index) => {
    form.core_values.vi.splice(index, 1);
    form.core_values.en.splice(index, 1);
};

const handleFileChange = (e, key) => {
    form[key] = e.target.files[0];
};

const submit = () => {
    form.post(route('admin.settings.store'), {
        preserveScroll: true,
        forceFormData: true,
    });
};
</script>

<template>

    <Head title="Nội dung" />

    <div class="page-header flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Nội dung</h1>
        </div>
    </div>

    <div class="w-full">
        <form @submit.prevent="submit" class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <!-- Tabs Menu -->
            <div class="flex border-b border-gray-200 overflow-x-auto bg-gray-50/50">
                <button type="button"
                    class="px-6 py-4 text-sm font-medium transition-colors whitespace-nowrap border-b-2"
                    :class="activeSection === 'general' ? 'border-green-600 text-green-700 bg-white' : 'border-transparent text-gray-600 hover:text-gray-900 hover:bg-white'"
                    @click="activeSection = 'general'">
                    Cấu hình chung
                </button>
                <button type="button"
                    class="px-6 py-4 text-sm font-medium transition-colors whitespace-nowrap border-b-2"
                    :class="activeSection === 'home' ? 'border-green-600 text-green-700 bg-white' : 'border-transparent text-gray-600 hover:text-gray-900 hover:bg-white'"
                    @click="activeSection = 'home'">
                    Trang chủ
                </button>
                <button type="button"
                    class="px-6 py-4 text-sm font-medium transition-colors whitespace-nowrap border-b-2"
                    :class="activeSection === 'about' ? 'border-green-600 text-green-700 bg-white' : 'border-transparent text-gray-600 hover:text-gray-900 hover:bg-white'"
                    @click="activeSection = 'about'">
                    Trang giới thiệu
                </button>
                <button type="button"
                    class="px-6 py-4 text-sm font-medium transition-colors whitespace-nowrap border-b-2"
                    :class="activeSection === 'product' ? 'border-green-600 text-green-700 bg-white' : 'border-transparent text-gray-600 hover:text-gray-900 hover:bg-white'"
                    @click="activeSection = 'product'">
                    Trang sản phẩm
                </button>
                <button type="button"
                    class="px-6 py-4 text-sm font-medium transition-colors whitespace-nowrap border-b-2"
                    :class="activeSection === 'contact' ? 'border-green-600 text-green-700 bg-white' : 'border-transparent text-gray-600 hover:text-gray-900 hover:bg-white'"
                    @click="activeSection = 'contact'">
                    Trang liên hệ
                </button>
            </div>

            <!-- Form Content -->
            <div class="p-6">
                <!-- Language Tabs -->
                <div class="lang-tabs mb-6">
                    <button type="button" class="lang-tab" :class="{ active: activeLang === 'vi' }"
                        @click="activeLang = 'vi'">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 20" width="24" height="16"
                            style="border-radius: 2px;">
                            <rect width="30" height="20" fill="#da251d" />
                            <polygon points="15,4 11.47,14.85 20.71,8.15 9.29,8.15 18.53,14.85" fill="#ffcd00"
                                fill-rule="nonzero" />
                        </svg> Tiếng Việt
                    </button>
                    <button type="button" class="lang-tab" :class="{ active: activeLang === 'en' }"
                        @click="activeLang = 'en'">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 480" width="24" height="16"
                            style="border-radius: 2px;">
                            <path fill="#012169" d="M0 0h640v480H0z" />
                            <path fill="#FFF"
                                d="m75 0 244 181L562 0h78v62L400 241l240 178v61h-80L320 301 81 480H0v-60l239-178L0 64V0z" />
                            <path fill="#C8102E"
                                d="m424 281 216 159v40L369 281zm-184 20 6 35L22 480H0zM640 0 439 150l-6-37L640 0zM0 0l227 170 5-31L0 0z" />
                            <path fill="#FFF" d="M241 0v480h160V0zM0 160v160h640V160z" />
                            <path fill="#C8102E" d="M0 193v96h640v-96zM273 0v480h96V0z" />
                        </svg> Tiếng Anh
                    </button>
                </div>

                <!-- General Settings -->
                <div v-show="activeSection === 'general'">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tiêu đề Website</label>
                            <input v-model="form.site_title[activeLang]" type="text"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Logo</label>
                            <div class="flex items-center gap-4">
                                <img v-if="getSettingStr('logo')" :src="'/' + getSettingStr('logo')"
                                    class="h-12 object-contain border p-1 rounded" alt="Logo">
                                <input type="file" @change="e => handleFileChange(e, 'logo')"
                                    class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100"
                                    accept="image/*">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Logo Footer</label>
                            <div class="flex items-center gap-4">
                                <img v-if="getSettingStr('footer_logo')" :src="'/' + getSettingStr('footer_logo')"
                                    class="h-12 object-contain border p-1 rounded" alt="Footer Logo">
                                <input type="file" @change="e => handleFileChange(e, 'footer_logo')"
                                    class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100"
                                    accept="image/*">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Home Page -->
                <div v-show="activeSection === 'home'">
                    <h3 class="text-lg font-semibold mb-4 border-b pb-2">Hero Banner</h3>
                    <div class="space-y-6 mb-8">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Hình nền Hero Banner</label>
                            <div class="flex items-center gap-4">
                                <img v-if="getSettingStr('home_hero_image')"
                                    :src="'/' + getSettingStr('home_hero_image')"
                                    class="h-16 object-cover border p-1 rounded" alt="Hero Image">
                                <input type="file" @change="e => handleFileChange(e, 'home_hero_image')"
                                    class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100"
                                    accept="image/*">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tiêu đề Hero Banner</label>
                            <textarea v-model="form.home_intro_title[activeLang]" rows="2"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500"></textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Mô tả Hero Banner</label>
                            <div class="h-64 mb-12">
                                <QuillEditor :key="activeLang" v-model:content="form.home_intro_desc[activeLang]"
                                    contentType="html" theme="snow" />
                            </div>
                        </div>
                    </div>

                    <h3 class="text-lg font-semibold mb-4 border-b pb-2 mt-8">Phần Giới thiệu</h3>
                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Hình ảnh phần giới thiệu</label>
                            <div class="flex items-center gap-4">
                                <img v-if="getSettingStr('home_about_image')"
                                    :src="'/' + getSettingStr('home_about_image')"
                                    class="h-16 object-cover border p-1 rounded" alt="About Image">
                                <input type="file" @change="e => handleFileChange(e, 'home_about_image')"
                                    class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100"
                                    accept="image/*">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tiêu đề phần giới thiệu</label>
                            <input v-model="form.home_about_title[activeLang]" type="text"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nội dung ngắn giới thiệu</label>
                            <textarea v-model="form.home_about_desc[activeLang]" rows="4"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500"></textarea>
                        </div>
                    </div>
                </div>

                <!-- About Page -->
                <div v-show="activeSection === 'about'">
                    <h3 class="text-lg font-semibold mb-4 border-b pb-2">Phần Hero Banner</h3>
                    <div class="space-y-6 mb-8">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Hình nền Banner</label>
                            <div class="flex items-center gap-4">
                                <img v-if="getSettingStr('about_hero_image')"
                                    :src="'/' + getSettingStr('about_hero_image')"
                                    class="h-16 object-cover border p-1 rounded" alt="Hero Image">
                                <input type="file" @change="e => handleFileChange(e, 'about_hero_image')"
                                    class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100"
                                    accept="image/*">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tiêu đề</label>
                            <textarea v-model="form.about_hero_title[activeLang]" rows="2"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500"></textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nội dung Banner</label>
                            <div class="h-64 mb-12">
                                <QuillEditor :key="activeLang" v-model:content="form.about_hero_desc[activeLang]"
                                    contentType="html" theme="snow" />
                            </div>
                        </div>
                    </div>

                    <h3 class="text-lg font-semibold mb-4 border-b pb-2 mt-8">Nội dung Giới thiệu</h3>
                    <div class="space-y-8">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Mô tả ngắn (Giới thiệu đầu
                                trang)</label>
                            <textarea v-model="form.about_short[activeLang]" rows="4"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500"></textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nội dung giới thiệu chi
                                tiết</label>
                            <div class="h-64 mb-12">
                                <QuillEditor :key="activeLang" v-model:content="form.about_long[activeLang]"
                                    contentType="html" theme="snow" />
                            </div>
                        </div>

                        <div class="mt-8 border-t pt-6">
                            <div class="flex justify-between items-center mb-4">
                                <label class="block text-lg font-medium text-gray-700">Giá trị cốt lõi</label>
                                <button type="button" @click="addCoreValue"
                                    class="text-sm bg-green-50 text-green-600 px-3 py-1 rounded hover:bg-green-100">
                                    + Thêm mới
                                </button>
                            </div>

                            <div v-for="(val, idx) in form.core_values[activeLang]" :key="idx" class="flex gap-2 mb-3">
                                <input v-model="form.core_values[activeLang][idx]" type="text"
                                    class="flex-1 rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500"
                                    placeholder="Nhập giá trị cốt lõi...">
                                <button type="button" @click="removeCoreValue(idx)"
                                    class="px-3 py-2 bg-red-50 text-red-600 rounded hover:bg-red-100">
                                    Xóa
                                </button>
                            </div>
                            <p v-if="form.core_values[activeLang].length === 0" class="text-sm text-gray-500 italic">
                                Chưa có giá trị cốt lõi nào. Hãy nhấn "Thêm mới".</p>
                        </div>

                        <div class="mt-8 border-t pt-6">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tầm nhìn</label>
                            <textarea v-model="form.vision[activeLang]" rows="3"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500"></textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Sứ mệnh</label>
                            <textarea v-model="form.mission[activeLang]" rows="3"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500"></textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Văn hóa công ty</label>
                            <div class="h-64 mb-12">
                                <QuillEditor :key="activeLang" v-model:content="form.company_culture[activeLang]"
                                    contentType="html" theme="snow" />
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Product Page -->
                <div v-show="activeSection === 'product'">
                    <h3 class="text-lg font-semibold mb-4 border-b pb-2">Phần Hero Banner</h3>
                    <div class="space-y-6 mb-8">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Hình nền Banner</label>
                            <div class="flex items-center gap-4">
                                <img v-if="getSettingStr('product_hero_image')"
                                    :src="'/' + getSettingStr('product_hero_image')"
                                    class="h-16 object-cover border p-1 rounded" alt="Hero Image">
                                <input type="file" @change="e => handleFileChange(e, 'product_hero_image')"
                                    class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100"
                                    accept="image/*">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tiêu đề</label>
                            <textarea v-model="form.product_hero_title[activeLang]" rows="2"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500"></textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Mô tả</label>
                            <textarea v-model="form.product_hero_desc[activeLang]" rows="3"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500"></textarea>
                        </div>
                    </div>
                </div>

                <!-- Contact Page -->
                <div v-show="activeSection === 'contact'">
                    <h3 class="text-lg font-semibold mb-4 border-b pb-2">Phần Hero Banner</h3>
                    <div class="space-y-6 mb-8">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Hình nền Banner</label>
                            <div class="flex items-center gap-4">
                                <img v-if="getSettingStr('contact_hero_image')"
                                    :src="'/' + getSettingStr('contact_hero_image')"
                                    class="h-16 object-cover border p-1 rounded" alt="Hero Image">
                                <input type="file" @change="e => handleFileChange(e, 'contact_hero_image')"
                                    class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100"
                                    accept="image/*">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tiêu đề Banner</label>
                            <textarea v-model="form.contact_hero_title[activeLang]" rows="2"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500"></textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Mô tả Banner</label>
                            <textarea v-model="form.contact_hero_desc[activeLang]" rows="3"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500"></textarea>
                        </div>
                    </div>

                    <h3 class="text-lg font-semibold mb-4 border-b pb-2">Thông tin liên hệ</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Địa chỉ</label>
                            <input v-model="form.contact_address[activeLang]" type="text"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Điện thoại</label>
                            <input v-model="form.contact_phone[activeLang]" type="text"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input v-model="form.contact_email[activeLang]" type="email"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Website</label>
                            <input v-model="form.contact_website[activeLang]" type="text"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                        </div>

                        <div class="col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Bản đồ (Mã iframe Google
                                Maps)</label>
                            <textarea v-model="form.contact_map_iframe.vi" rows="3"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 font-mono text-sm"></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-gray-50 px-6 py-4 flex items-center justify-end gap-4 border-t">

                <button type="submit"
                    class="px-6 py-2 bg-green-600 text-white rounded-lg font-medium hover:bg-green-700 transition-colors"
                    :disabled="form.processing">
                    {{ form.processing ? 'Đang lưu...' : 'Lưu' }}
                </button>
            </div>
        </form>
    </div>
</template>
