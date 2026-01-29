@php
    $currentLocale = session('locale', \App\Models\Language::where('is_default', true)->first()?->code ?? 'kk');
    $countries = \App\Models\Country::where('is_active', true)->get();
    $offices = \App\Models\Office::where('is_active', true)->get();
    $totalCountries = $countries->count();
    $totalOffices = $offices->count();
@endphp

<section class="stats-section">
    <div class="container">
        <div class="stats-header">
            <h2 class="stats-title">{{ \App\Models\Setting::get('stats_title_' . $currentLocale, 'Bizimle Yol Yürümeye Var Mısınız?') }}</h2>
            <p class="stats-description">{{ \App\Models\Setting::get('stats_description_' . $currentLocale, 'Dünya genelinde ofislerimiz ve deneyimli temsilcilerimiz sizlere en iyi hizmeti sunmak için hazır. Harita üzerinde ülkelere tıklayarak temsilciliklerimizi görebilirsiniz.') }}</p>
        </div>
        
        <div class="stats-main">
            <div class="globe-icon"></div>
            
            
            <div class="stat-card stat-card-left stat-card-left-top">
                <h3 class="stat-number">{{ $totalCountries }}</h3>
                <span class="stat-label">{{ \App\Models\Setting::get('stats_countries_label_' . $currentLocale, 'Ülkede Ofisimiz') }}</span>
            </div>

            <div class="stat-card stat-card-left stat-card-left-bottom">
                <h3 class="stat-number">50+</h3>
                <span class="stat-label">{{ \App\Models\Setting::get('stats_offices_label_' . $currentLocale, 'Deneyimli Temsilci') }}</span>
            </div>
            
            <div class="stat-card stat-card-right">
                <h3 class="stat-number">7/24</h3>
                <span class="stat-label">{{ \App\Models\Setting::get('stats_support_label_' . $currentLocale, 'Destek Hattı') }}</span>
                <small class="stat-small">{{ \App\Models\Setting::get('stats_support_desc_' . $currentLocale, 'Danışmanlarımız hedef ülkeye göre süreç planı çıkarır.') }}</small>
                <a href="#iletisim" class="btn btn-outline-white">{{ \App\Models\Setting::get('stats_button_' . $currentLocale, 'Detaylı Bilgi Alın') }}</a>
            </div>

            <div class="world-map-container">
     @include('partials.world-map')
 </div>
        </div>
    </div>
</section>
