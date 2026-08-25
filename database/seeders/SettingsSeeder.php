<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingsSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            'site_title' => [
                'vi' => 'Tân Bình Tea',
                'en' => 'Tan Binh Tea'
            ],
            'logo' => [
                'vi' => 'assets/images/common/logo.svg', // will change in master.blade.php to fallback
                'en' => 'assets/images/common/logo.svg'
            ],
            'home_intro_title' => [
                'vi' => "TRÀ VIỆT NAM\nLÀ NGHỆ SĨ",
                'en' => "VIETNAM TEA\nIS AN ARTIST"
            ],
            'home_intro_desc' => [
                'vi' => 'Trong suốt quá trình hình thành và phát triển, chúng tôi hướng đến mục tiêu không chỉ là một thương hiệu chè, mà còn là cầu nối đưa hương vị Việt Nam vươn xa ra thế giới. Từng búp chè nhỏ bé mang theo khát vọng lớn, để bạn bè quốc tế biết đến, yêu mến và trân trọng những giá trị mộc mạc nhưng đầy tự hào của dân tộc Việt Nam.',
                'en' => 'Throughout the process of formation and development, we aim not only to be a tea brand but also a bridge to bring Vietnamese flavor to the world. Each small tea bud carries a great aspiration, so that international friends know, love and appreciate the rustic but proud values of the Vietnamese nation.'
            ],
            'home_about_title' => [
                'vi' => 'Giới thiệu',
                'en' => 'About Us'
            ],
            'home_about_desc' => [
                'vi' => 'Công ty TNHH Xuất Nhập Khẩu Chè Tân Bình với gần 100 cán bộ kỹ thuật và công nhân lành nghề trong sản xuất, chế biến chè...',
                'en' => 'Tan Binh Tea Export Import Co., Ltd with nearly 100 technical staff and skilled workers in tea production and processing...'
            ],
            'home_hero_image' => [
                'vi' => 'assets/images/home/hero-tea-banner.png',
                'en' => 'assets/images/home/hero-tea-banner.png'
            ],
            'home_about_image' => [
                'vi' => 'assets/images/home/intro-tea-harvest.jpg',
                'en' => 'assets/images/home/intro-tea-harvest.jpg'
            ],
            'about_hero_title' => [
                'vi' => 'CHÚNG TÔI LÀ',
                'en' => 'WHO WE ARE'
            ],
            'about_hero_desc' => [
                'vi' => '<p>Trong suốt quá trình hình thành và phát triển, chúng tôi hướng đến mục tiêu không chỉ là một thương hiệu chè, mà còn là cầu nối đưa hương vị Việt Nam vươn xa ra thế giới. Từng búp chè nhỏ bé mang theo khát vọng lớn, để bạn bè quốc tế biết đến, yêu mến và trân trọng những giá trị mộc mạc nhưng đầy tự hào của dân tộc Việt Nam.</p>',
                'en' => '<p>Throughout the process of formation and development, we aim not only to be a tea brand but also a bridge to bring Vietnamese flavor to the world. Each small tea bud carries a great aspiration, so that international friends know, love and appreciate the rustic but proud values of the Vietnamese nation.</p>'
            ],
            'about_hero_image' => [
                'vi' => 'assets/images/home/hero-tea-banner.png',
                'en' => 'assets/images/home/hero-tea-banner.png'
            ],
            'about_short' => [
                'vi' => 'Được thành lập vào ngày 24/07/2017, Công ty TNHH Chè Tân Bình tự hào là đơn vị uy tín trong chế biến và sản xuất búp chè tươi phục vụ xuất khẩu đến các thị trường Trung Quốc, Thái Lan, Pakistan, Afghanistan, Nga, Ấn Độ. Xuất phát từ khát vọng nâng tầm nông sản Việt và tình yêu dành cho lá chè truyền thống của quê hương Đất Tổ Phú Thọ, chúng tôi đã và đang không ngừng nỗ lực mang đến những sản phẩm chè sạch, chất lượng và đậm đà bản sắc.',
                'en' => 'Established on July 24, 2017, Tan Binh Tea Co., Ltd is proud to be a reputable unit in processing and producing fresh tea buds for export to markets in China, Thailand, Pakistan, Afghanistan, Russia, and India. Stemming from the desire to elevate Vietnamese agricultural products and the love for traditional tea leaves of the ancestral land of Phu Tho, we have been constantly striving to bring clean, high-quality, and identity-rich tea products.'
            ],
            'about_long' => [
                'vi' => '<p>Tại Công ty TNHH Chè Tân Bình, mỗi búp chè đều được tuyển chọn kỹ lưỡng, chế biến bằng quy trình hiện đại kết hợp cùng kinh nghiệm được kế thừa và phát triển lâu đời. Chứng chỉ ISO 22000:2018 về hệ thống quản lý an toàn thực phẩm và giấy chứng nhận vệ sinh an toàn thực phẩm (ATTP) chính là lời đảm bảo cho những dòng sản phẩm chất lượng. Chúng tôi tin rằng, một tách chè ngon không chỉ mang đến sự thư thái, mà còn là cầu nối để giới thiệu văn hóa và tinh thần Việt Nam đến với bạn bè quốc tế.</p><p>Với sự tận tâm, uy tín và tinh thần phát triển bền vững, Công ty TNHH Chè Tân Bình đang từng bước khẳng định vị thế của mình trên thị trường quốc tế – trở thành đối tác tin cậy và là niềm tự hào của ngành chè Việt.</p>',
                'en' => '<p>At Tan Binh Tea Co., Ltd, each tea bud is carefully selected, processed using modern procedures combined with long-standing inherited and developed experience. The ISO 22000:2018 certificate for food safety management systems and food safety hygiene certificates are guarantees for quality product lines. We believe that a good cup of tea not only brings relaxation but is also a bridge to introduce Vietnamese culture and spirit to international friends.</p><p>With dedication, prestige, and a spirit of sustainable development, Tan Binh Tea Co., Ltd is gradually asserting its position in the international market - becoming a reliable partner and the pride of the Vietnamese tea industry.</p>'
            ],
            'vision' => [
                'vi' => 'Trong suốt quá trình hình thành và phát triển, chúng tôi hướng đến mục tiêu không chỉ là một thương hiệu chè, mà còn là cầu nối đưa hương vị Việt Nam vươn xa ra thế giới. Từng búp chè nhỏ bé mang theo khát vọng lớn, để bạn bè quốc tế biết đến, yêu mến và trân trọng những giá trị mộc mạc nhưng đầy tự hào của dân tộc Việt Nam.',
                'en' => 'Throughout our establishment and development, we aim not just to be a tea brand, but a bridge taking Vietnamese flavors to the world. Each small tea bud carries a great aspiration for international friends to know, love, and appreciate the rustic yet proud values of the Vietnamese nation.'
            ],
            'mission' => [
                'vi' => 'Mang lại sản phẩm chất lượng, an toàn và mang đậm bản sắc truyền thống chính là sứ mệnh mà Công ty TNHH Chè Tân Bình hướng tới trong từng nỗ lực xây dựng và phát triển doanh nghiệp. Đó còn là kim chỉ nam cho chúng tôi trên hành trình đóng góp những giá trị thiết thực cho đất nước và dân tộc. Trải qua tám năm làm nghề cùng nhiều thăng trầm, cho tới thời điểm hiện tại, đây vẫn là sứ mệnh đúng đắn mà chúng tôi quyết tâm theo đuổi. Hơn cả một sản phẩm, đó là câu chuyện của đất, của người và của niềm tin.',
                'en' => 'Bringing quality, safe products steeped in traditional identity is the mission that Tan Binh Tea Co., Ltd aims for in every effort to build and develop the business. It is also our guideline on the journey to contribute practical values to the country and nation. Over eight years in the profession with many ups and downs, up to now, this remains the right mission we are determined to pursue. More than just a product, it is the story of the land, the people, and belief.'
            ],
            'core_values' => [
                'vi' => [
                    'Tận tâm với chất lượng: Chúng tôi tin rằng, chỉ có sự chỉn chu và chân thành mới tạo nên một sản phẩm thực sự xứng đáng.',
                    'Lấy chữ tín làm gốc: Mỗi cam kết của Công ty TNHH Chè Tân Bình đều xuất phát từ lòng tôn trọng với khách hàng, đối tác và cộng đồng.',
                    'Gìn giữ bản sắc truyền thống: Chúng tôi gìn giữ và phát huy hương vị truyền thống của nông sản vùng đất tổ Vua Hùng. Cùng với đó là tinh thần sẵn sàng đổi mới để bắt kịp thời đại.'
                ],
                'en' => [
                    'Dedication to quality: We believe that only care and sincerity can create a truly worthy product.',
                    'Trust as the root: Every commitment of Tan Binh Tea Co., Ltd stems from respect for customers, partners, and the community.',
                    'Preserving traditional identity: We preserve and promote the traditional flavors of agricultural products while being ready to innovate.'
                ]
            ],
            'company_culture' => [
                'vi' => '<p>Tại Công ty TNHH Chè Tân Bình, chúng tôi tin rằng một doanh nghiệp tốt bắt đầu từ những con người tử tế. Văn hóa công ty không nằm ở những khẩu hiệu to tát, mà hiện diện trong từng hành động nhỏ mỗi ngày – từ cách chúng tôi trân trọng người nông dân, tôn vinh giá trị lao động, đến tinh thần đồng hành và sẻ chia giữa các thành viên trong tập thể.</p><p>Chúng tôi xây dựng một môi trường làm việc ấm áp, chân thành và trách nhiệm, nơi mọi cá nhân đều được lắng nghe, được phát triển và được tự hào vì đang góp phần tạo ra những sản phẩm chất lượng cao mang linh hồn truyền thống đất Việt. Không phân biệt vai trò hay vị trí, mọi cá nhân đều cùng nhau hướng về một mục tiêu chung: làm điều tử tế, sống với niềm tin và để lại giá trị lâu bền.</p>',
                'en' => '<p>At Tan Binh Tea Co., Ltd, we believe a good business starts with kind people. Company culture is not in grand slogans, but is present in every small daily action - from how we respect farmers, honor the value of labor, to the spirit of companionship and sharing among team members.</p><p>We build a warm, sincere, and responsible working environment where every individual is listened to, developed, and proud to be contributing to creating high-quality products carrying the traditional soul of Vietnam. Regardless of role or position, every individual looks towards a common goal together: doing kind things, living with faith, and leaving behind lasting values.</p>'
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
            'contact_map_iframe' => [
                'vi' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14902.955431682496!2d105.1583091!3d21.1374526!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x313481b0a8eb3c73%3A0xd68d0bb9930f1d1!2zWHVcdTExYW5nIGNoXHUwMGU4IFRcdTAwZTJuIELDrG5o!5e0!3m2!1svi!2s!4v1700000000000!5m2!1svi!2s" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
                'en' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14902.955431682496!2d105.1583091!3d21.1374526!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x313481b0a8eb3c73%3A0xd68d0bb9930f1d1!2zWHVcdTExYW5nIGNoXHUwMGU4IFRcdTAwZTJuIELDrG5o!5e0!3m2!1svi!2s!4v1700000000000!5m2!1svi!2s" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>'
            ],
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

        foreach ($settings as $key => $values) {
            $setting = Setting::where('key', $key)->first();
            if (!$setting) {
                $setting = new Setting(['key' => $key]);
                $setting->setTranslations('value', [
                    'vi' => $values['vi'],
                    'en' => $values['en']
                ]);
                $setting->save();
            }
        }
    }
}
