@php
    $languages = \App\Models\Language::where('is_active', true)->orderBy('is_default', 'desc')->get();
    $currentLocale = session('locale', \App\Models\Language::where('is_default', true)->first()?->code ?? 'kk');
    $currentLanguage = $languages->firstWhere('code', $currentLocale);
@endphp

<div class="language-switcher">
    <div class="language-current" id="languageCurrent">
        <span class="language-code">{{ strtoupper($currentLanguage?->code ?? 'KK') }}</span>
        <svg class="language-arrow" width="12" height="8" viewBox="0 0 12 8" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M1 1L6 6L11 1" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </div>
    <div class="language-dropdown" id="languageDropdown" style="display: none; opacity: 0; visibility: hidden;">
        @foreach($languages as $language)
            <a href="{{ route('language.switch', $language->code) }}" 
               class="language-option {{ $language->code === $currentLocale ? 'active' : '' }}"
               data-code="{{ $language->code }}">
                <span class="language-name">{{ $language->name }}</span>
                <span class="language-code-small">{{ strtoupper($language->code) }}</span>
            </a>
        @endforeach
    </div>
</div>
