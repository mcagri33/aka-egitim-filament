@php
    $currentLocale = session('locale', \App\Models\Language::where('is_default', true)->first()?->code ?? 'kk');
@endphp

<section class="features-section">
    <div class="container">
        <div class="features-grid">
            <div class="feature-box">
                <div class="feature-icon feature-icon-1">✓</div>
                <div class="feature-content">
                    <h3 class="feature-title">{{ \App\Models\Setting::get('features_free_title_' . $currentLocale, '100% Ücretsiz') }}</h3>
                    <p class="feature-desc">{{ \App\Models\Setting::get('features_free_desc_' . $currentLocale, 'Danışmanlık Hizmeti') }}</p>
                </div>
            </div>
            
            <div class="feature-box">
                <div class="feature-icon feature-icon-2">⏰</div>
                <div class="feature-content">
                    <h3 class="feature-title">{{ \App\Models\Setting::get('features_24h_title_' . $currentLocale, '24 Saat İçinde') }}</h3>
                    <p class="feature-desc">{{ \App\Models\Setting::get('features_24h_desc_' . $currentLocale, 'Geri Dönüş') }}</p>
                </div>
            </div>
            
            <div class="feature-box">
                <div class="feature-icon feature-icon-3">🎓</div>
                <div class="feature-content">
                    <h3 class="feature-title">{{ \App\Models\Setting::get('features_expert_title_' . $currentLocale, 'Uzman Danışmanlar') }}</h3>
                    <p class="feature-desc">{{ \App\Models\Setting::get('features_expert_desc_' . $currentLocale, 'Her Ülke İçin') }}</p>
                </div>
            </div>
            
            <div class="feature-box">
                <div class="feature-icon feature-icon-4">🌍</div>
                <div class="feature-content">
                    <h3 class="feature-title">{{ \App\Models\Setting::get('features_global_title_' . $currentLocale, 'Global Ağ') }}</h3>
                    <p class="feature-desc">{{ \App\Models\Setting::get('features_global_desc_' . $currentLocale, 'Onaylı Kurumlar') }}</p>
                </div>
            </div>
        </div>
    </div>
</section>
