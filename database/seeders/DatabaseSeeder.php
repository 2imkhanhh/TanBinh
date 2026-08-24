<?php

namespace Database\Seeders;

use App\Models\Setting;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Cấu hình chung (Settings)
        $settings = [
            'site_title' => [
                'vi' => 'Tân Bình Tea - Trà Việt Nam Là Nghệ Sĩ',
                'en' => 'Tan Binh Tea - Vietnamese Tea is an Artist'
            ],
            'contact_address' => [
                'vi' => 'Xóm Tân Bình, Xã Võ Miếu, Huyện Thanh Sơn, Tỉnh Phú Thọ',
                'en' => 'Tan Binh Hamlet, Vo Mieu Commune, Thanh Son District, Phu Tho Province'
            ],
            'contact_phone' => [
                'vi' => '(+84) 986 843 666',
                'en' => '(+84) 986 843 666'
            ],
            'contact_email' => [
                'vi' => 'tanbinhteacompany@gmail.com',
                'en' => 'tanbinhteacompany@gmail.com'
            ],
            'contact_website' => [
                'vi' => 'tanbinhteacoltd.com',
                'en' => 'tanbinhteacoltd.com'
            ],
            'home_intro_title' => [
                'vi' => "TRÀ VIỆT NAM\nLÀ NGHỆ SĨ",
                'en' => "VIETNAMESE TEA\nIS AN ARTIST"
            ],
            'home_intro_desc' => [
                'vi' => "Trong suốt quá trình hình thành và phát triển, chúng tôi\nhướng đến mục tiêu không chỉ là một thương hiệu chè, mà\ncòn là cầu nối đưa hương vị Việt Nam vươn xa ra thế giới.\nTừng búp chè nhỏ bé mang theo khát vọng lớn, để bạn bè\nquốc tế biết đến, yêu mến và trân trọng những giá trị mộc\nmạc nhưng đầy tự hào của\ndân tộc Việt Nam.",
                'en' => "Throughout our formation and development, we aim not only to be a tea brand but also a bridge bringing Vietnamese flavors to the world. Each small tea bud carries a great aspiration, so that international friends know, love, and appreciate the rustic but proud values of the Vietnamese nation."
            ],
            'about_short' => [
                'vi' => 'Công ty TNHH Xuất Nhập Khẩu Chè Tân Bình với gần 100 cán bộ kỹ thuật và công nhân lành nghề trong sản xuất, chế biến chè. Nhà máy chè của chúng tôi đặt tại tỉnh Phú Thọ có chất lượng và năng suất cao. Nhà máy được trang bị cơ sở vật chất tiên tiến, hiện',
                'en' => 'Tan Binh Tea Import Export Co., Ltd with nearly 100 technical staff and skilled workers in tea production and processing. Our tea factory located in Phu Tho province has high quality and productivity. The factory is equipped with advanced facilities.'
            ],
            'about_long' => [
                'vi' => "Tại Công ty TNHH Chè Tân Bình, mỗi búp chè đều được tuyển chọn kỹ lưỡng, chế biến bằng quy trình hiện đại kết hợp cùng kinh nghiệm được kế thừa và phát triển lâu đời. Chứng chỉ ISO 22000:2018 về hệ thống quản lý an toàn thực phẩm và giấy chứng nhận vệ sinh an toàn thực phẩm (ATTP) chính là lời đảm bảo cho những dòng sản phẩm chất lượng. Chúng tôi tin rằng, một tách chè ngon không chỉ mang đến sự thư thái, mà còn là cầu nối để giới thiệu văn hóa và tinh thần Việt Nam đến với bạn bè quốc tế.\n\nVới sự tận tâm, uy tín và tinh thần phát triển bền vững, Công ty TNHH Chè Tân Bình đang từng bước khẳng định vị thế của mình trên thị trường quốc tế – trở thành đối tác tin cậy và là niềm tự hào của ngành chè Việt.",
                'en' => "At Tan Binh Tea, each tea bud is carefully selected, processed using modern procedures combined with long-standing inherited experience. ISO 22000:2018 certification for food safety management systems and food safety hygiene certificates are the guarantee for our quality product lines...\n\nWith dedication, prestige, and a spirit of sustainable development, Tan Binh Tea is gradually asserting its position in the international market - becoming a reliable partner and the pride of the Vietnamese tea industry."
            ],
            'vision' => [
                'vi' => 'Trong suốt quá trình hình thành và phát triển, chúng tôi hướng đến mục tiêu không chỉ là một thương hiệu chè, mà còn là cầu nối đưa hương vị Việt Nam vươn xa ra thế giới. Từng búp chè nhỏ bé mang theo khát vọng lớn, để bạn bè quốc tế biết đến, yêu mến và trân trọng những giá trị mộc mạc nhưng đầy tự hào của dân tộc Việt Nam.',
                'en' => 'Throughout our formation and development, we aim not only to be a tea brand but also a bridge bringing Vietnamese flavors to the world.'
            ],
            'mission' => [
                'vi' => 'Mang lại sản phẩm chất lượng, an toàn và mang đậm bản sắc truyền thống chính là sứ mệnh mà Công ty TNHH Chè Tân Bình hướng tới trong từng nỗ lực xây dựng và phát triển doanh nghiệp. Đó còn là kim chỉ nam cho chúng tôi trên hành trình đóng góp những giá trị thiết thực cho đất nước và dân tộc. Trải qua tám năm làm nghề cùng nhiều thăng trầm, cho tới thời điểm hiện tại, đây vẫn là sứ mệnh đúng đắn mà chúng tôi quyết tâm theo đuổi. Hơn cả một sản phẩm, đó là câu chuyện của đất, của người và của niềm tin.',
                'en' => 'Bringing quality, safe products with strong traditional identity is the mission that Tan Binh Tea aims for in every effort to build and develop the enterprise.'
            ],
            'core_values' => [
                'vi' => "Tận tâm với chất lượng: Chúng tôi tin rằng, chỉ có sự chỉn chu và chân thành mới tạo nên một sản phẩm thực sự xứng đáng.\n\nLấy chữ tín làm gốc: Mỗi cam kết của Công ty TNHH Chè Tân Bình đều xuất phát từ lòng tôn trọng với khách hàng, đối tác và cộng đồng.\n\nGìn giữ bản sắc truyền thống: Chúng tôi gìn giữ và phát huy hương vị truyền thống của nông sản vùng đất tổ Vua Hùng. Cùng với đó là tinh thần sẵn sàng đổi mới để bắt kịp thời đại.",
                'en' => "Dedicated to quality: We believe that only care and sincerity can create a truly worthy product.\n\nPrestige as the root: Every commitment comes from respect for customers, partners, and the community.\n\nPreserving traditional identity: We preserve and promote the traditional flavors of agricultural products while being ready to innovate."
            ],
            'company_culture' => [
                'vi' => "Tại Công ty TNHH Chè Tân Bình, chúng tôi tin rằng một doanh nghiệp tốt bắt đầu từ những con người tử tế. Văn hóa công ty không nằm ở những khẩu hiệu to tát, mà hiện diện trong từng hành động nhỏ mỗi ngày – từ cách chúng tôi trân trọng người nông dân, tôn vinh giá trị lao động, đến tinh thần đồng hành và sẻ chia giữa các thành viên trong tập thể.\n\nChúng tôi xây dựng một môi trường làm việc ấm áp, chân thành và trách nhiệm, nơi mọi cá nhân đều được lắng nghe, được phát triển và được tự hào vì đang góp phần tạo ra những sản phẩm chất lượng cao mang linh hồn truyền thống đất Việt. Không phân biệt vai trò hay vị trí, mọi cá nhân đều cùng nhau hướng về một mục tiêu chung: làm điều tử tế, sống với niềm tin và để lại giá trị lâu bền.",
                'en' => "At Tan Binh Tea, we believe a good business starts with kind people. Company culture is not in grand slogans, but in small daily actions..."
            ]
        ];

        foreach ($settings as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        // 2. Categories
        $catBlack = Category::create([
            'name' => ['vi' => 'Chè Đen', 'en' => 'Black Tea'],
            'slug' => 'che-den',
        ]);

        $catGreen = Category::create([
            'name' => ['vi' => 'Chè Xanh', 'en' => 'Green Tea'],
            'slug' => 'che-xanh',
        ]);

        // 3. Products
        $products = [
            ['name' => 'Vietnam Black Tea: Pekoe', 'cat' => $catBlack->id, 'image' => 'product-black-tea-pekoe.png'],
            ['name' => 'Vietnam Black Tea: BPS', 'cat' => $catBlack->id, 'image' => 'product-tea-generic.png'],
            ['name' => 'Vietnam Black Tea: Dust', 'cat' => $catBlack->id, 'image' => 'product-tea-generic.png'],
            ['name' => 'Vietnam Black Tea: F', 'cat' => $catBlack->id, 'image' => 'product-tea-generic.png'],
            
            ['name' => 'Vietnam Green Tea: Madina', 'cat' => $catGreen->id, 'image' => 'product-tea-generic.png'],
            ['name' => 'Vietnam Green Tea: Dust', 'cat' => $catGreen->id, 'image' => 'product-tea-generic.png'],
            ['name' => 'Vietnam Green Tea: PS', 'cat' => $catGreen->id, 'image' => 'product-tea-generic.png'],
            ['name' => 'Vietnam Green Tea: BPS', 'cat' => $catGreen->id, 'image' => 'product-tea-generic.png'],
        ];

        foreach ($products as $p) {
            Product::create([
                'category_id' => $p['cat'],
                'name' => ['vi' => $p['name'], 'en' => $p['name']],
                'slug' => \Illuminate\Support\Str::slug($p['name']),
                'short_description' => ['vi' => 'Mô tả ngắn cho ' . $p['name'], 'en' => 'Short desc for ' . $p['name']],
                'content' => ['vi' => 'Mô tả chi tiết ' . $p['name'], 'en' => 'Detail desc ' . $p['name']],
                'is_active' => true,
            ]);
            // Media will not be seeded automatically because files are in assets/images, 
            // but the blade file can fallback to assets/images if no media.
        }
        // 4. Posts (Blog)
        // Hình ảnh (16 posts)
        for ($i = 1; $i <= 16; $i++) {
            \App\Models\Post::create([
                'title' => ['vi' => "Trà Tân Bình - Hình ảnh $i", 'en' => "Tan Binh Tea - Image $i"],
                'slug' => "tra-tan-binh-hinh-anh-$i",
                'type' => 'hinh-anh',
                'is_active' => true,
            ]);
        }
        
        // Tin tức (4 posts)
        $tinTucs = [
            'Những công dụng hay của chè xanh với sức khoẻ',
            'Người đi tìm màu xanh cho đất',
            'Tân Bình Tea tham dự Hội chợ Nông sản Việt 2026',
            'Cách pha trà xanh đúng chuẩn để giữ nguyên dưỡng chất'
        ];
        foreach ($tinTucs as $index => $title) {
            \App\Models\Post::create([
                'title' => ['vi' => $title, 'en' => $title],
                'slug' => \Illuminate\Support\Str::slug($title),
                'type' => 'tin-tuc',
                'is_active' => true,
            ]);
        }
        
        // Khác (4 posts)
        foreach ($tinTucs as $index => $title) {
            \App\Models\Post::create([
                'title' => ['vi' => "$title (Khác)", 'en' => "$title (Other)"],
                'slug' => \Illuminate\Support\Str::slug("$title Khac"),
                'type' => 'khac',
                'is_active' => true,
            ]);
        }
    }
}
