@php
    $currentLocale = session('locale', \App\Models\Language::where('is_default', true)->first()?->code ?? 'kk');
    $currentLanguage = \App\Models\Language::where('code', $currentLocale)->first();
    $defaultLanguage = \App\Models\Language::where('is_default', true)->first();
    
    $footerMenu = \App\Models\Menu::where('location', 'footer')->first();
    $footerMenuItems = $footerMenu ? $footerMenu->items()->whereNull('parent_id')->orderBy('order')->get() : collect();
    
    // Çoklu dil desteği için footer metinleri
    $footerText = \App\Models\Setting::where('key', 'footer_text_' . ($currentLanguage?->code ?? 'kk'))->first()?->value;
    $footerCopyright = \App\Models\Setting::where('key', 'footer_copyright_' . ($currentLanguage?->code ?? 'kk'))->first()?->value;
    
    // Tagline - çoklu dil desteği
    $tagline = \App\Models\Setting::where('key', 'site_tagline_' . ($currentLanguage?->code ?? 'kk'))->first()?->value;
    if (!$tagline && $defaultLanguage) {
        $tagline = \App\Models\Setting::where('key', 'site_tagline_' . $defaultLanguage->code)->first()?->value;
    }
    if (!$tagline) {
        // Fallback tagline'lar
        $taglines = [
            'kk' => 'AKA – Асқақтық. Кемелділік. Айрықшылық.',
            'ru' => 'Решимость, Решительность, Привилегия',
            'en' => 'Determination, Resolution, Privilege',
            'tr' => 'Azim, Kararlılık, Ayrıcalık'
        ];
        $tagline = $taglines[$currentLocale] ?? $taglines['tr'];
    }
    
    $socialFacebook = \App\Models\Setting::where('key', 'social_facebook')->first()?->value;
    $socialInstagram = \App\Models\Setting::where('key', 'social_instagram')->first()?->value;
    $socialTwitter = \App\Models\Setting::where('key', 'social_twitter')->first()?->value;
    
    $siteLogo = \App\Models\Setting::get('site_logo');
@endphp

<footer class="footer">
    <div class="container">
        <div class="footer-grid">
            <div class="footer-col footer-col-main">
                <div class="footer-logo">
                    <a href="{{ route('home') }}">
                        @if($siteLogo)
                            <img src="{{ asset('storage/' . $siteLogo) }}" alt="AKA Academy" class="footer-logo-image" onerror="this.parentElement.querySelector('.logo-text-only').style.display='flex'; this.style.display='none';">
                            <div class="logo-text-only" style="display: none;">
                                <div class="logo-title">AKA Academy</div>
                            </div>
                        @else
                            <div class="logo-text-only">
                                <div class="logo-title">AKA Academy</div>
                            </div>
                        @endif
                    </a>
                </div>
                @if($tagline)
                    <p class="footer-tagline">{{ $tagline }}</p>
                @endif
                @if($footerText)
                    <p class="footer-description">{{ $footerText }}</p>
                @endif
                <div class="footer-social">
                    @if($socialInstagram)
                        <a href="{{ $socialInstagram }}" target="_blank" aria-label="Instagram">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                            </svg>
                        </a>
                    @endif
                    @if($socialFacebook)
                        <a href="{{ $socialFacebook }}" target="_blank" aria-label="Facebook">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                        </a>
                    @endif
                    @if($socialTwitter)
                        <a href="{{ $socialTwitter }}" target="_blank" aria-label="X">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                            </svg>
                        </a>
                    @endif
                </div>
            </div>
            
            @if($footerMenuItems->isNotEmpty())
                @foreach($footerMenuItems as $footerItem)
                    @php
                        $itemTranslation = $footerItem->translations()->where('language_id', $currentLanguage?->id)->first();
                        if (!$itemTranslation && $defaultLanguage) {
                            $itemTranslation = $footerItem->translations()->where('language_id', $defaultLanguage->id)->first();
                        }
                        $itemTitle = $itemTranslation?->title ?? 'Menu';
                        $childItems = $footerItem->children()->where('is_active', true)->orderBy('order')->get();
                    @endphp
                    <div class="footer-col">
                        <h4>{{ $itemTitle }}</h4>
                        @if($childItems->isNotEmpty())
                            @foreach($childItems as $child)
                                @php
                                    $childTranslation = $child->translations()->where('language_id', $currentLanguage?->id)->first();
                                    if (!$childTranslation && $defaultLanguage) {
                                        $childTranslation = $child->translations()->where('language_id', $defaultLanguage->id)->first();
                                    }
                                    $childTitle = $childTranslation?->title ?? 'Link';
                                    $childUrl = $child->url ?? '#';
                                    $childExternal = $childUrl !== '#' && (str_starts_with($childUrl, 'http://') || str_starts_with($childUrl, 'https://'));
                                @endphp
                                <a href="{{ $childUrl }}" @if($childExternal) target="_blank" rel="noopener noreferrer" @endif>{{ $childTitle }}</a>
                            @endforeach
                        @else
                            @php
                                $itemUrl = $footerItem->url ?? '#';
                                $itemExternal = $itemUrl !== '#' && (str_starts_with($itemUrl, 'http://') || str_starts_with($itemUrl, 'https://'));
                            @endphp
                            <a href="{{ $itemUrl }}" @if($itemExternal) target="_blank" rel="noopener noreferrer" @endif>{{ $itemTitle }}</a>
                        @endif
                    </div>
                @endforeach
            @endif
        </div>
        
        <div class="footer-bottom">
            @if($footerCopyright)
                <p>{{ $footerCopyright }}</p>
            @else
                @php
                    $copyrightTexts = [
                        'kk' => '©' . date('Y') . ' Айхан Коркмаз. Білім беру және кеңес беру. Барлық құқықтар қорғалған.',
                        'ru' => '©' . date('Y') . ' Айхан Коркмаз. Образование и консультирование. Все права защищены.',
                        'en' => '©' . date('Y') . ' Ayhan Korkmaz. Education and Consultancy. All rights reserved.',
                        'tr' => '©' . date('Y') . ' Ayhan Korkmaz. Eğitim ve Danışmanlık. Tüm hakları saklıdır.'
                    ];
                    $copyrightText = $copyrightTexts[$currentLocale] ?? $copyrightTexts['tr'];
                @endphp
                <p>{{ $copyrightText }}</p>
            @endif
        </div>
    </div>
</footer>
