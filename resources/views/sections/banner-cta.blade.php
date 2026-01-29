@php
    $currentLocale = session('locale', \App\Models\Language::where('is_default', true)->first()?->code ?? 'kk');
@endphp

<section class="banner-cta">
    <div class="container">
        <div class="banner-box">
            <div class="banner-text">
                <span class="banner-pill">{{ \App\Models\Setting::get('banner_cta_pill_' . $currentLocale, 'Profesyonel Danışmanlık') }}</span>

                <h2 class="banner-title">
                    {{ \App\Models\Setting::get('banner_cta_title_' . $currentLocale, 'Hayalinizdeki Eğitim') }}<br>
                    <span>{{ \App\Models\Setting::get('banner_cta_title_span_' . $currentLocale, 'Bir Adım Uzağınızda') }}</span>
                </h2>

                <p class="banner-description">
                    {{ \App\Models\Setting::get('banner_cta_description_' . $currentLocale, 'Aka Eğitim profesyonel danışmanlarımızla görüşün ve size özel yurt dışı eğitim planınızı oluşturalım.') }}
                </p>

                <a href="#iletisim" class="btn btn-primary">
                    {{ \App\Models\Setting::get('banner_cta_button_' . $currentLocale, 'Hemen Başvur') }} →
                </a>
            </div>

            <div class="banner-image">
                <img src="{{ asset('site/img/banner-student.png') }}" alt="AKA Eğitim Öğrenci">
                <div class="banner-watermark"></div>
            </div>
        </div>
    </div>
</section>
