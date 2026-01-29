<header class="header">
    <div class="main-header">
        <div class="container">
            <div class="header-inner">
                <div class="logo">
                    <a href="{{ route('home') }}">
                        <div class="logo-icon"></div>
                        <div class="logo-text">
                            <div class="logo-title">AKAĞİTİM</div>
                            <div class="logo-subtitle">Eğitim ve Danışmanlık Hizmetleri</div>
                        </div>
                    </a>
                </div>
                
                @include('partials.navigation')
                
                @include('partials.language-switcher')
                
                <div class="header-social">
                    @php
                        $socialFacebook = \App\Models\Setting::where('key', 'social_facebook')->first()?->value;
                        $socialInstagram = \App\Models\Setting::where('key', 'social_instagram')->first()?->value;
                        $socialTwitter = \App\Models\Setting::where('key', 'social_twitter')->first()?->value;
                    @endphp
                    
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
                
                <button class="mobile-menu-toggle" aria-label="Menüyü aç/kapat">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>
        </div>
    </div>
</header>
