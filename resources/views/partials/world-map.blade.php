@php
    $activeCountries = \App\Models\Country::where('is_active', true)->get();
    $activeCountryCodes = $activeCountries->pluck('code')->toArray();
    
    // Ülke kodlarını SVG'deki id/class ile eşleştir
    $countryMapping = [
        'KZ' => ['id' => 'KZ', 'class' => 'Kazakhstan'],
        'GB' => ['id' => 'GB', 'class' => 'United Kingdom'],
        'UK' => ['id' => 'GB', 'class' => 'United Kingdom'],
        'FI' => ['id' => 'FI', 'class' => 'Finland'],
        'DE' => ['id' => 'DE', 'class' => 'Germany'],
        'CA' => ['id' => 'CA', 'class' => 'Canada'],
        'US' => ['id' => 'US', 'class' => 'United States'],
        'TR' => ['id' => 'TR', 'class' => 'Turkey'],
    ];
    
    // SVG dosyasını oku
    $svgPath = public_path('site/world.svg');
    $svgContent = file_exists($svgPath) ? file_get_contents($svgPath) : '';
    
    // SVG içeriğini manipüle et
    if ($svgContent) {
        // Style ekle
        if (strpos($svgContent, '<defs>') === false) {
            $svgContent = preg_replace(
                '/(<svg[^>]*>)/i',
                '$1<defs><style type="text/css">.country { fill: #e0e0e0; stroke: #cccccc; stroke-width: 0.2; cursor: pointer; transition: fill 0.3s; opacity: 0.6; } .country:hover { fill: #d0d0d0; opacity: 0.8; } .country-active { fill: #ffffff !important; stroke: #209990 !important; stroke-width: 1.5 !important; opacity: 1 !important; } .country-active:hover { fill: #f5f5f5 !important; stroke: #1a7a73 !important; opacity: 1 !important; }</style></defs>',
                $svgContent
            );
        }
        
        // Aktif ülkeleri vurgula
        foreach ($activeCountryCodes as $code) {
            if (!isset($countryMapping[$code])) continue;
            
            $mapping = $countryMapping[$code];
            
            // ID ile eşleşen path'leri bul ve beyaz yap
            if (isset($mapping['id'])) {
                $id = $mapping['id'];
                // Mevcut fill attribute'unu kaldır
                $svgContent = preg_replace(
                    '/(<path[^>]*id="' . preg_quote($id, '/') . '"[^>]*)\s*fill="[^"]*"/i',
                    '$1',
                    $svgContent
                );
                // Mevcut stroke attribute'unu kaldır
                $svgContent = preg_replace(
                    '/(<path[^>]*id="' . preg_quote($id, '/') . '"[^>]*)\s*stroke="[^"]*"/i',
                    '$1',
                    $svgContent
                );
                // Mevcut stroke-width attribute'unu kaldır
                $svgContent = preg_replace(
                    '/(<path[^>]*id="' . preg_quote($id, '/') . '"[^>]*)\s*stroke-width="[^"]*"/i',
                    '$1',
                    $svgContent
                );
                // Fill, stroke ve class ekle
                $pattern = '/(<path[^>]*id="' . preg_quote($id, '/') . '"[^>]*)(>)/i';
                $replacement = '$1 fill="#ffffff" stroke="#209990" stroke-width="1.5" class="country country-active"$2';
                $svgContent = preg_replace($pattern, $replacement, $svgContent);
            }
            
            // Class ile eşleşen path'leri bul ve beyaz yap
            if (isset($mapping['class'])) {
                $className = $mapping['class'];
                // Mevcut fill attribute'unu kaldır
                $svgContent = preg_replace(
                    '/(<path[^>]*class="[^"]*' . preg_quote($className, '/') . '[^"]*"[^>]*)\s*fill="[^"]*"/i',
                    '$1',
                    $svgContent
                );
                // Mevcut stroke attribute'unu kaldır
                $svgContent = preg_replace(
                    '/(<path[^>]*class="[^"]*' . preg_quote($className, '/') . '[^"]*"[^>]*)\s*stroke="[^"]*"/i',
                    '$1',
                    $svgContent
                );
                // Mevcut stroke-width attribute'unu kaldır
                $svgContent = preg_replace(
                    '/(<path[^>]*class="[^"]*' . preg_quote($className, '/') . '[^"]*"[^>]*)\s*stroke-width="[^"]*"/i',
                    '$1',
                    $svgContent
                );
                // Class'ı güncelle ve fill, stroke ekle
                $pattern = '/(<path[^>]*class=")([^"]*' . preg_quote($className, '/') . '[^"]*)(")/i';
                $replacement = '$1$2 country country-active$3 fill="#ffffff" stroke="#209990" stroke-width="1.5"';
                $svgContent = preg_replace($pattern, $replacement, $svgContent);
            }
        }
        
        // Tüm path'lere country class'ı ekle (eğer yoksa)
        $svgContent = preg_replace('/(<path[^>]*class=")([^"]*)(")/i', '$1country $2$3', $svgContent);
        $svgContent = preg_replace('/(<path[^>]*)(?!.*class=)(>)/i', '$1 class="country"$2', $svgContent);
        
        // SVG'yi responsive yap
        // Width'i 100% yap
        $svgContent = preg_replace('/(<svg[^>]*width=")([^"]*)(")/i', '$1"100%"$3', $svgContent);
        // Height attribute'unu tamamen kaldır (viewBox ile otomatik hesaplanacak)
        $svgContent = preg_replace('/\s+height="[^"]*"/i', '', $svgContent);
        $svgContent = preg_replace('/\s+height=\'[^\']*\'/i', '', $svgContent);
        // preserveAspectRatio ekle
        if (strpos($svgContent, 'preserveAspectRatio') === false) {
            $svgContent = preg_replace('/(<svg[^>]*)(>)/i', '$1 preserveAspectRatio="xMidYMid meet"$2', $svgContent);
        }
    }
@endphp

<div class="world-map-wrapper">
    @if($svgContent)
        {!! $svgContent !!}
    @else
        <p>World map SVG file not found.</p>
    @endif
</div>
