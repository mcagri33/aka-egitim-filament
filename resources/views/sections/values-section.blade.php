@php
    $currentLocale = session('locale', \App\Models\Language::where('is_default', true)->first()?->code ?? 'kk');
@endphp

<section class="values-section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">{{ \App\Models\Setting::get('values_title_' . $currentLocale, 'Değerlerimiz') }}</h2>
        </div>
        
        <div class="values-grid">
            <div class="value-card">
                <div class="value-icon">
                    <span>✏️</span>
                </div>
                <h3 class="value-title">{{ \App\Models\Setting::get('values_azim_title_' . $currentLocale, 'Azim') }}</h3>
                <p class="value-description">{{ \App\Models\Setting::get('values_azim_desc_' . $currentLocale, 'Hedefe giden yolda planlı ilerler, süreç boyunca yanında oluruz.') }}</p>
            </div>
            
            <div class="value-card">
                <div class="value-icon">
                    <span>📐</span>
                </div>
                <h3 class="value-title">{{ \App\Models\Setting::get('values_kararlilik_title_' . $currentLocale, 'Kararlılık') }}</h3>
                <p class="value-description">{{ \App\Models\Setting::get('values_kararlilik_desc_' . $currentLocale, 'Program seçimi, başvuru ve vize adımlarını disiplinle yönetiriz.') }}</p>
            </div>
            
            <div class="value-card">
                <div class="value-icon">
                    <span>⭐</span>
                </div>
                <h3 class="value-title">{{ \App\Models\Setting::get('values_ayricalik_title_' . $currentLocale, 'Ayrıcalık') }}</h3>
                <p class="value-description">{{ \App\Models\Setting::get('values_ayricalik_desc_' . $currentLocale, 'Kişiselleştirilmiş danışmanlık, net iletişim ve hızlı geri dönüş.') }}</p>
            </div>
        </div>
    </div>
</section>
