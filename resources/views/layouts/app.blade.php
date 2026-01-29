<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'AKAĞİTİM - Eğitim ve Danışmanlık Hizmetleri')</title>
    @vite(['resources/css/site.css'])
    @stack('styles')
</head>
<body>
    @include('partials.header')
    
    <main>
        @yield('content')
    </main>
    
    @include('partials.footer')
    
    <a href="#top" class="scroll-top" aria-label="Yukarı çık">↑</a>
    
    @vite(['resources/js/site.js'])
    <script src="{{ asset('site/instagram-config.js') }}"></script>
    @stack('scripts')
</body>
</html>
