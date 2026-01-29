@php
    $currentLocale = session('locale', \App\Models\Language::where('is_default', true)->first()?->code ?? 'kk');
    $currentLanguage = \App\Models\Language::where('code', $currentLocale)->first();
    $footerMenu = \App\Models\Menu::where('location', 'footer')->first();
    $footerMenuItems = $footerMenu ? $footerMenu->items()->whereNull('parent_id')->orderBy('order')->get() : collect();
    
    $footerText = \App\Models\Setting::where('key', 'footer_text_' . ($currentLanguage?->code ?? 'kk'))->first()?->value;
    $footerCopyright = \App\Models\Setting::where('key', 'footer_copyright_' . ($currentLanguage?->code ?? 'kk'))->first()?->value;
    
    $socialFacebook = \App\Models\Setting::where('key', 'social_facebook')->first()?->value;
    $socialInstagram = \App\Models\Setting::where('key', 'social_instagram')->first()?->value;
    $socialTwitter = \App\Models\Setting::where('key', 'social_twitter')->first()?->value;
@endphp

<footer class="footer">
    <div class="container">
        <div class="footer-grid">
            <div class="footer-col footer-col-main">
                       <div class="footer-logo">
                           @php
                               $siteLogo = \App\Models\Setting::get('site_logo');
                           @endphp
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
                       </div>
                @if($footerText)
                    <p class="footer-description">{{ $footerText }}</p>
                @endif
                <div class="footer-social">
                    @if($socialInstagram)
                        <a href="{{ $socialInstagram }}" target="_blank" aria-label="Instagram">IG</a>
                    @endif
                    @if($socialFacebook)
                        <a href="{{ $socialFacebook }}" target="_blank" aria-label="Facebook">FB</a>
                    @endif
                    @if($socialTwitter)
                        <a href="{{ $socialTwitter }}" target="_blank" aria-label="X">X</a>
                    @endif
                </div>
            </div>
            
            @if($footerMenuItems->isNotEmpty())
                @foreach($footerMenuItems as $footerItem)
                    @php
                               $itemTranslation = $footerItem->translations()->where('language_id', $currentLanguage?->id)->first();
                        $itemTitle = $itemTranslation?->title ?? 'Menu';
                        $childItems = $footerItem->children()->orderBy('order')->get();
                    @endphp
                    <div class="footer-col">
                        <h4>{{ $itemTitle }}</h4>
                        @foreach($childItems as $child)
                            @php
                                       $childTranslation = $child->translations()->where('language_id', $currentLanguage?->id)->first();
                                $childTitle = $childTranslation?->title ?? 'Link';
                                $childUrl = $child->url ?? '#';
                            @endphp
                            <a href="{{ $childUrl }}">{{ $childTitle }}</a>
                        @endforeach
                    </div>
                @endforeach
            @endif
        </div>
        
        <div class="footer-bottom">
            @if($footerCopyright)
                <p>{{ $footerCopyright }}</p>
            @else
                <p>© {{ date('Y') }} Ayhan Korkmaz. Eğitim ve Danışmanlık. Tüm hakları saklıdır.</p>
            @endif
        </div>
    </div>
</footer>
