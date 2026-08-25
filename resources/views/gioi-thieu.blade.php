@extends('layouts.master')
@section('title', app()->getLocale() == 'vi' ? 'Giới thiệu' : 'About Us')

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/css/gioi-thieu.css') }}">
@endpush

@section('content')
    <!-- Hero Section (kế thừa từ trang chủ) -->
    <section class="hero" id="hero">
        <div class="hero-bg">
            <img src="{{ isset($settings['about_hero_image']) && $settings['about_hero_image'] ? asset($settings['about_hero_image']) : asset('assets/images/home/hero-tea-banner.png') }}" alt="Đồi chè Việt Nam">
        </div>
        <div class="hero-content">
            <h1 class="hero-title">{!! nl2br(e($settings['about_hero_title'] ?? (app()->getLocale() == 'vi' ? 'CHÚNG TÔI LÀ' : 'WHO WE ARE'))) !!}</h1>
            <img src="{{ asset('assets/images/common/deco-vector-divider.png') }}" alt="" class="hero-vector">
            <div class="hero-desc">
                {!! $settings['about_hero_desc'] ?? 'Trong suốt quá trình hình thành và phát triển, chúng tôi hướng đến mục tiêu không chỉ là một thương hiệu chè, mà còn là cầu nối đưa hương vị Việt Nam vươn xa ra thế giới. Từng búp chè nhỏ bé mang theo khát vọng lớn, để bạn bè quốc tế biết đến, yêu mến và trân trọng những giá trị mộc mạc nhưng đầy tự hào của<br>dân tộc Việt Nam.' !!}
            </div>
        </div>
    </section>

    <!-- About Split Section -->
    <section class="about-split" id="about-split">
        <div class="about-split-left">
            <img src="{{ asset('assets/images/about/about-split-photo.png') }}" alt="Giới thiệu Tân Bình Tea">
            <div class="about-split-text">
                <h2 class="about-split-title">{{ app()->getLocale() == 'vi' ? 'GIỚI THIỆU' : 'ABOUT US' }}</h2>
                <p class="about-split-desc">{{ $settings['about_short'] ?? 'Được thành lập vào ngày 24/07/2017, Công ty TNHH Chè Tân Bình tự hào là đơn vị uy tín trong chế biến và sản xuất búp chè tươi phục vụ xuất khẩu đến các thị trường Trung Quốc, Thái Lan, Pakistan, Afghanistan, Nga, Ấn Độ. Xuất phát từ khát vọng nâng tầm nông sản Việt và tình yêu dành cho lá chè truyền thống của quê hương Đất Tổ Phú Thọ, chúng tôi đã và đang không ngừng nỗ lực mang đến những sản phẩm chè sạch, chất lượng và đậm đà bản sắc.' }}</p>
            </div>
        </div>
        <div class="about-split-right">
            <div class="about-split-right-text">
                {!! $settings['about_long'] ?? '<p>Tại Công ty TNHH Chè Tân Bình, mỗi búp chè đều được tuyển chọn kỹ lưỡng, chế biến bằng quy trình hiện đại kết hợp cùng kinh nghiệm được kế thừa và phát triển lâu đời. Chứng chỉ ISO 22000:2018 về hệ thống quản lý an toàn thực phẩm và giấy chứng nhận vệ sinh an toàn thực phẩm (ATTP) chính là lời đảm bảo cho những dòng sản phẩm chất lượng. Chúng tôi tin rằng, một tách chè ngon không chỉ mang đến sự thư thái, mà còn là cầu nối để giới thiệu văn hóa và tinh thần Việt Nam đến với bạn bè quốc tế.</p><p>Với sự tận tâm, uy tín và tinh thần phát triển bền vững, Công ty TNHH Chè Tân Bình đang từng bước khẳng định vị thế của mình trên thị trường quốc tế – trở thành đối tác tin cậy và là niềm tự hào của ngành chè Việt.</p>' !!}
            </div>
        </div>
    </section>

    <!-- About Bar -->
    <div class="about-bar">
        <div class="about-bar-content">
            <h2 class="about-bar-title">{{ app()->getLocale() == 'vi' ? 'Tầm nhìn' : 'Vision' }}</h2>
            <p class="about-bar-desc">{{ $settings['vision'] ?? 'Trong suốt quá trình hình thành và phát triển, chúng tôi hướng đến mục tiêu không chỉ là một thương hiệu chè, mà còn là cầu nối đưa hương vị Việt Nam vươn xa ra thế giới. Từng búp chè nhỏ bé mang theo khát vọng lớn, để bạn bè quốc tế biết đến, yêu mến và trân trọng những giá trị mộc mạc nhưng đầy tự hào của dân tộc Việt Nam.' }}</p>
        </div>
    </div>

    <!-- About Image Section -->
    <section class="about-image-section" id="about-image-section">
        <div class="about-image-section-left">
            <div class="about-image-section-text">
                <h2 class="about-image-section-title">{{ app()->getLocale() == 'vi' ? 'Sứ mệnh' : 'Mission' }}</h2>
                <p class="about-image-section-desc">{{ $settings['mission'] ?? 'Mang lại sản phẩm chất lượng, an toàn và mang đậm bản sắc truyền thống chính là sứ mệnh mà Công ty TNHH Chè Tân Bình hướng tới trong từng nỗ lực xây dựng và phát triển doanh nghiệp. Đó còn là kim chỉ nam cho chúng tôi trên hành trình đóng góp những giá trị thiết thực cho đất nước và dân tộc. Trải qua tám năm làm nghề cùng nhiều thăng trầm, cho tới thời điểm hiện tại, đây vẫn là sứ mệnh đúng đắn mà chúng tôi quyết tâm theo đuổi. Hơn cả một sản phẩm, đó là câu chuyện của đất, của người và của niềm tin.' }}</p>
            </div>
        </div>
        <div class="about-image-section-right">
            <img src="{{ asset('assets/images/about/about-mission-photo.jpg') }}" alt="Giới thiệu Tân Bình Tea">
        </div>
    </section>

    <!-- About Aerial Section -->
    <div class="about-aerial" id="about-aerial">
        <!-- Background image -->
        <img src="{{ asset('assets/images/about/about-aerial-sapa.png') }}" alt="Cánh đồng lúa Việt Nam">

        <!-- Responsive inner grid -->
        <div class="about-aerial-inner">
            <!-- Row 1: Giá trị cốt lõi -->
            <div class="about-aerial-left">
                <h2 class="about-aerial-title">{{ app()->getLocale() == 'vi' ? 'Giá trị cốt lõi' : 'Core Values' }}</h2>
            </div>
            <div class="about-aerial-right">
                <div class="about-aerial-image">
                    @if(isset($settings['core_values']) && is_array($settings['core_values']) && count($settings['core_values']) > 0)
                        @foreach($settings['core_values'] as $value)
                            <div class="about-aerial-item">
                                <img src="{{ asset('assets/images/about/about-core-value-icon.png') }}" alt="Giá trị cốt lõi {{ $loop->iteration }}">
                                <p class="about-aerial-item-text">{{ $value }}</p>
                            </div>
                        @endforeach
                    @else
                        <div class="about-aerial-item">
                            <img src="{{ asset('assets/images/about/about-core-value-icon.png') }}" alt="Giá trị cốt lõi 1">
                            <p class="about-aerial-item-text">Tận tâm với chất lượng: Chúng tôi tin rằng, chỉ có sự chỉn chu và chân thành mới tạo nên một sản phẩm thực sự xứng đáng.</p>
                        </div>
                        <div class="about-aerial-item">
                            <img src="{{ asset('assets/images/about/about-core-value-icon.png') }}" alt="Giá trị cốt lõi 2">
                            <p class="about-aerial-item-text">Lấy chữ tín làm gốc: Mỗi cam kết của Công ty TNHH Chè Tân Bình đều xuất phát từ lòng tôn trọng với khách hàng, đối tác và cộng đồng.</p>
                        </div>
                        <div class="about-aerial-item">
                            <img src="{{ asset('assets/images/about/about-core-value-icon.png') }}" alt="Giá trị cốt lõi 3">
                            <p class="about-aerial-item-text">{{ app()->getLocale() == 'vi' ? 'Gìn giữ bản sắc truyền thống: Chúng tôi gìn giữ và phát huy hương vị truyền thống của nông sản vùng đất tổ Vua Hùng. Cùng với đó là tinh thần sẵn sàng đổi mới để bắt kịp thời đại.' : 'Preserving traditional identity: We preserve and promote the traditional flavors of agricultural products while being ready to innovate.' }}</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Row 2: Văn hoá công ty -->
            <div class="about-aerial-left about-aerial-van-hoa-left">
                <h2 class="about-aerial-title">{{ app()->getLocale() == 'vi' ? 'Văn hoá công ty' : 'Company Culture' }}</h2>
            </div>
            <div class="about-aerial-right about-aerial-van-hoa-right">
                <div class="about-aerial-van-hoa-desc">
                    {!! $settings['company_culture'] ?? '<p>Tại Công ty TNHH Chè Tân Bình, chúng tôi tin rằng một doanh nghiệp tốt bắt đầu từ những con người tử tế. Văn hóa công ty không nằm ở những khẩu hiệu to tát, mà hiện diện trong từng hành động nhỏ mỗi ngày – từ cách chúng tôi trân trọng người nông dân, tôn vinh giá trị lao động, đến tinh thần đồng hành và sẻ chia giữa các thành viên trong tập thể.</p><p>Chúng tôi xây dựng một môi trường làm việc ấm áp, chân thành và trách nhiệm, nơi mọi cá nhân đều được lắng nghe, được phát triển và được tự hào vì đang góp phần tạo ra những sản phẩm chất lượng cao mang linh hồn truyền thống đất Việt. Không phân biệt vai trò hay vị trí, mọi cá nhân đều cùng nhau hướng về một mục tiêu chung: làm điều tử tế, sống với niềm tin và để lại giá trị lâu bền.</p>' !!}
                </div>
            </div>
        </div>
    </div>
@endsection
