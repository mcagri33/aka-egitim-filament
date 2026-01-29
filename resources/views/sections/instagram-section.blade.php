@php
    $currentLocale = session('locale', \App\Models\Language::where('is_default', true)->first()?->code ?? 'kk');
    $instagramUrl = \App\Models\Setting::where('key', 'social_instagram')->first()?->value ?? 'https://www.instagram.com/aka_egitim/';
@endphp

<section class="instagram-section">
    <div class="container">
        <div class="section-header section-header-row">
            <h2 class="section-title">{{ \App\Models\Setting::get('instagram_title_' . $currentLocale, 'Instagram Paylaşımları') }}</h2>
            <a href="{{ $instagramUrl }}" target="_blank" rel="noopener noreferrer" class="btn btn-instagram">
                <span>📷</span>
                {{ \App\Models\Setting::get('instagram_button_' . $currentLocale, '@aka_egitim') }}
            </a>
        </div>

        <div class="instagram-slider">
            <div class="instagram-grid" id="instagram-feed">
                <!-- JS + instagram-config.js ile doldurulur -->
            </div>
        </div>
    </div>
</section>
