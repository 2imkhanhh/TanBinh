<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$settings = [
    'product_hero_title' => [
        'vi' => 'SẢN PHẨM',
        'en' => 'PRODUCTS'
    ],
    'product_hero_desc' => [
        'vi' => 'Khám phá các sản phẩm chè đen và chè xanh chất lượng cao từ Tân Bình Tea.',
        'en' => 'Discover high-quality black and green tea products from Tan Binh Tea.'
    ],
    'contact_hero_title' => [
        'vi' => 'LIÊN HỆ',
        'en' => 'CONTACT'
    ],
    'contact_hero_desc' => [
        'vi' => 'Vui lòng liên hệ với chúng tôi để được tư vấn và đặt hàng.',
        'en' => 'Please contact us for advice and ordering.'
    ]
];

foreach ($settings as $key => $value) {
    $setting = App\Models\Setting::firstOrCreate(['key' => $key]);
    $setting->setTranslations('value', $value);
    $setting->save();
}
echo "Done";
