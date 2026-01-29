@php
    $currentLocale = session('locale', \App\Models\Language::where('is_default', true)->first()?->code ?? 'kk');
@endphp

<section class="why-section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">{{ \App\Models\Setting::get('why_title_' . $currentLocale, 'Neden AKA Eğitim?') }}</h2>
            <p class="section-description">{{ \App\Models\Setting::get('why_description_' . $currentLocale, 'AKA Eğitim, yurtdışı eğitimin merkezine "Öğretmen Rehberliği" koyar. Öğrencinizin yurtdışı eğitim yolculuğuna bir aile ferdi içtenliği ile bakar, evinizden havalimanına danışman öğretmeni sizinle beraber eşlik eder.') }}</p>
        </div>
        
        <div class="why-grid">
            <div class="why-card">
                <div class="why-image why-image-1"></div>
                <div class="why-content">
                    <h3 class="why-title">{{ \App\Models\Setting::get('why_global_title_' . $currentLocale, 'Global Partner Ağımız') }}</h3>
                    <p class="why-description">{{ \App\Models\Setting::get('why_global_desc_' . $currentLocale, 'Onaylı kurum ağımızla programları güvenle karşılaştırır, en uygun rotayı belirleriz.') }}</p>
                </div>
            </div>
            
            <div class="why-card">
                <div class="why-image why-image-2"></div>
                <div class="why-content">
                    <h3 class="why-title">{{ \App\Models\Setting::get('why_tracking_title_' . $currentLocale, 'Öğrenci Gelecek Takibi') }}</h3>
                    <p class="why-description">{{ \App\Models\Setting::get('why_tracking_desc_' . $currentLocale, 'Başvuru sonrası süreçte de yanında kalır; adaptasyon ve takip adımlarını planlarız.') }}</p>
                </div>
            </div>
        </div>
    </div>
</section>
