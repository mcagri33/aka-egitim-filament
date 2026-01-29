@php
    $banners = \App\Models\Banner::where('is_active', true)->orderBy('order')->get();
    $currentLocale = session('locale', \App\Models\Language::where('is_default', true)->first()?->code ?? 'kk');
    $currentLanguage = \App\Models\Language::where('code', $currentLocale)->first();
@endphp

<section class="hero-slider">
    <div class="container">
        <div class="hero-content">
            <div class="hero-text">
                @if($banners->count() > 0)
                    @php
                        $banner = $banners->first();
                               $translation = $banner->translations()->where('language_id', $currentLanguage?->id)->first();
                    @endphp
                    <p class="hero-eyebrow">{{ $translation?->title ?? 'Öğretmen Dokunuşuyla' }}</p>
                    <h1 class="hero-title">{{ $translation?->description ?? 'Dünya Keşfi' }}</h1>
                    <p class="hero-description">{{ $translation?->button_text ?? 'AKA\'da eğitime dair her yolculuk bir öğretmen eşliğinde başlar ve öğretmen eşliğinde tamamlanır.' }}</p>
                    <div class="hero-buttons">
                        @if($translation?->button_url)
                            <a href="{{ $translation->button_url }}" class="btn btn-primary">{{ $translation->button_text ?? 'Ücretsiz Danışmanlık' }} →</a>
                        @else
                            <a href="#iletisim" class="btn btn-primary">Ücretsiz Danışmanlık →</a>
                        @endif
                        <a href="#programlar" class="btn btn-secondary">Programları İncele</a>
                    </div>
                @else
                    <p class="hero-eyebrow">Öğretmen Dokunuşuyla</p>
                    <h1 class="hero-title">Dünya Keşfi</h1>
                    <p class="hero-description">AKA'da eğitime dair her yolculuk bir öğretmen eşliğinde başlar ve öğretmen eşliğinde tamamlanır.</p>
                    <div class="hero-buttons">
                        <a href="#iletisim" class="btn btn-primary">Ücretsiz Danışmanlık →</a>
                        <a href="#programlar" class="btn btn-secondary">Programları İncele</a>
                    </div>
                @endif
                <div class="slider-dots">
                    @foreach($banners as $index => $banner)
                        <span class="dot {{ $index === 0 ? 'active' : '' }}"></span>
                    @endforeach
                </div>
            </div>
            <div class="hero-image">
                @if($banners->count() > 0 && $banners->first()->image_path)
                    <img src="{{ asset('storage/' . $banners->first()->image_path) }}" alt="Hero Image">
                @else
                    <div class="hero-image-placeholder"></div>
                @endif
                <div class="hero-badge">
                    <span class="badge-icon">✋⭐</span>
                </div>
            </div>
        </div>
        <button class="slider-arrow slider-arrow-prev" aria-label="Önceki">‹</button>
        <button class="slider-arrow slider-arrow-next" aria-label="Sonraki">›</button>
    </div>
</section>
