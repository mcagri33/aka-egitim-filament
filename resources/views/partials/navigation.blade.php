@php
    $menu = \App\Models\Menu::where('location', 'header')->first();
    $menuItems = $menu ? $menu->items()->whereNull('parent_id')->orderBy('order')->get() : collect();
    $currentLocale = session('locale', \App\Models\Language::where('is_default', true)->first()?->code ?? 'kk');
    $currentLanguage = \App\Models\Language::where('code', $currentLocale)->first();
@endphp

<nav class="nav-menu">
    @foreach($menuItems as $item)
        @php
            $translation = $item->translations()->where('language_id', $currentLanguage?->id)->first();
            $title = $translation?->title ?? 'Menu Item';
            $url = $item->url ?? '#';
            $isExternal = $url !== '#' && (str_starts_with($url, 'http://') || str_starts_with($url, 'https://'));
        @endphp
        <a href="{{ $url }}" @if($isExternal) target="_blank" rel="noopener noreferrer" @endif>{{ $title }}</a>
    @endforeach
</nav>
