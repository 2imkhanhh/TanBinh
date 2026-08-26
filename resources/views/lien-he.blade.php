@extends('layouts.master')
@section('title', app()->getLocale() == 'vi' ? 'Liên hệ' : 'Contact')

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/css/index.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/lien-he.css') }}">
@endpush

@section('content')
    <!-- Page Banner -->
    <section class="page-banner" id="page-banner">
        <div class="page-banner-bg">
            <img src="{{ isset($settings['contact_hero_image']) && $settings['contact_hero_image'] ? asset($settings['contact_hero_image']) : asset('assets/images/home/hero-tea-banner.png') }}" alt="Búp chè xanh">
        </div>
        <div class="page-banner-content" data-aos="zoom-in" data-aos-duration="1000">
            <h1 class="page-banner-title">{!! nl2br(e($settings['contact_hero_title'] ?? (app()->getLocale() == 'vi' ? 'LIÊN HỆ' : 'CONTACT'))) !!}</h1>
            <img src="{{ asset('assets/images/common/deco-vector-divider.png') }}" alt="" class="page-banner-vector">
            <p class="page-banner-desc">
                {!! $settings['contact_hero_desc'] ?? (app()->getLocale() == 'vi' ? 'Vui lòng liên hệ với chúng tôi để được tư vấn và đặt hàng.' : 'Please contact us for advice and ordering.') !!}
            </p>
        </div>
    </section>

    <!-- Liên hệ Section -->
    <section class="contact" id="lien-he">
        <div class="contact-container">
            <div class="contact-info" data-aos="fade-right">
                <h2 class="contact-title">{{ app()->getLocale() == 'vi' ? 'Liên hệ' : 'Contact' }}</h2>
                <h3 class="contact-company">CÔNG TY TNHH CHÈ TÂN BÌNH</h3>
                <ul class="contact-details">
                    <li>
                        <span class="contact-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                        </span>
                        <span>{{ $settings['contact_address'] ?? 'Xóm Tân Bình, Xã Võ Miếu, Huyện Thanh Sơn, Tỉnh Phú Thọ' }}</span>
                    </li>
                    <li>
                        <span class="contact-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>
                        </span>
                        <span><a href="https://tanbinhteacoltd.com/" target="_blank">{{ $settings['contact_website'] ?? 'tanbinhteacoltd.com' }}</a></span>
                    </li>
                    <li>
                        <span class="contact-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                        </span>
                        <span><a href="mailto:{{ $settings['contact_email'] ?? 'tanbinhteacompany@gmail.com' }}">{{ $settings['contact_email'] ?? 'tanbinhteacompany@gmail.com' }}</a></span>
                    </li>
                    <li>
                        <span class="contact-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                        </span>
                        <span><a href="tel:{{ $settings['contact_phone'] ?? '+84986843666' }}">{{ $settings['contact_phone'] ?? '(+84) 986 843 666' }}</a></span>
                    </li>
                </ul>
            </div>
            <div class="contact-form-wrapper" data-aos="fade-left" data-aos-delay="200">
                <form class="contact-form" id="contact-form" action="{{ route('contact.submit') }}" method="POST">
                    @csrf
                    <input type="text" name="fullname" placeholder="{{ app()->getLocale() == 'vi' ? 'Họ tên' : 'Name' }}" id="input-name" required>
                    <input type="email" name="email" placeholder="Email" id="input-email" required>
                    <input type="tel" name="phone" placeholder="{{ app()->getLocale() == 'vi' ? 'Số điện thoại' : 'Phone' }}" id="input-phone">
                    <textarea name="content" placeholder="{{ app()->getLocale() == 'vi' ? 'Lời nhắn' : 'Message' }}" id="input-message" rows="5" required></textarea>
                    <button type="submit" class="btn-submit" id="btn-submit">
                        <span class="btn-text">{{ app()->getLocale() == 'vi' ? 'GỬI' : 'SEND' }}</span>
                    </button>
                </form>
            </div>
        </div>
        <div class="contact-leaf-decoration">
            <img src="{{ asset('assets/images/common/leaf-deco-small.png') }}" alt="Lá trà trang trí nhỏ" class="leaf-horizontal-top">
            <img src="{{ asset('assets/images/common/leaf-deco-large.png') }}" alt="Lá trà trang trí lớn" class="leaf-horizontal">
        </div>
    </section>

    <!-- Bản đồ -->
    <section class="map-section" data-aos="fade-up">
        {!! $settings['contact_map_iframe'] ?? '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.8!2d105.07613128296941!3d21.161940695684375!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31347d952a2ea13d%3A0x3d1528d039367989!2zVsO1IE1p4bq_dSwgVGhhbmggU8ahbiwgUGjDuiBUaOG7jQ!5e0!3m2!1svi!2s!4v1786446008842!5m2!1svi!2s" width="100%" height="450" style="border:0; display:block;" allowfullscreen="" loading="lazy" referrerpolicy="strict-origin-when-cross-origin"></iframe>' !!}
    </section>
@endsection

