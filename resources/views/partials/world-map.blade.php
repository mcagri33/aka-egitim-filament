@php
    $activeCountries = \App\Models\Country::where('is_active', true)->get();
    $activeCountryCodes = $activeCountries->pluck('code')->toArray();
    
    // Ülke kodlarını SVG'deki id/class ile eşleştir
    $countryMapping = [
        'KZ' => ['id' => 'KZ', 'class' => 'Kazakhstan', 'name' => 'Kazakistan'],
        'GB' => ['id' => 'GB', 'class' => 'United Kingdom', 'name' => 'İngiltere'],
        'UK' => ['id' => 'GB', 'class' => 'United Kingdom', 'name' => 'İngiltere'],
        'FI' => ['id' => 'FI', 'class' => 'Finland', 'name' => 'Finlandiya'],
        'DE' => ['id' => 'DE', 'class' => 'Germany', 'name' => 'Almanya'],
        'CA' => ['id' => 'CA', 'class' => 'Canada', 'name' => 'Kanada'],
        'US' => ['id' => 'US', 'class' => 'United States', 'name' => 'Amerika'],
        'TR' => ['id' => 'TR', 'class' => 'Turkey', 'name' => 'Türkiye'],
    ];
    
    // Tüm ülkeler için temsilcilik bilgilerini hazırla
    // Aktif ülkeler = temsilciliğimiz var
    $officesData = [];
    foreach ($countryMapping as $code => $mapping) {
        $country = \App\Models\Country::where('code', $code)->first();
        
        // Ülke aktifse temsilciliğimiz var
        $hasOffice = $country && $country->is_active;
        
        $officesData[$code] = [
            'name' => $mapping['name'] ?? $code,
            'hasOffice' => $hasOffice,
        ];
    }
    
    // SVG dosyasını oku
    $svgPath = public_path('site/world.svg');
    $svgContent = file_exists($svgPath) ? file_get_contents($svgPath) : '';
    
    // SVG içeriğini manipüle et
    if ($svgContent) {
        // Style ekle
        if (strpos($svgContent, '<defs>') === false) {
            $svgContent = preg_replace(
                '/(<svg[^>]*>)/i',
                '$1<defs><style type="text/css">.country { fill: #e0e0e0; stroke: #cccccc; stroke-width: 0.2; cursor: pointer; transition: fill 0.3s; opacity: 0.6; } .country:hover { fill: #d0d0d0; opacity: 0.8; } .country-active { fill: #ffffff !important; stroke: #1a6b6b !important; stroke-width: 1.5 !important; opacity: 1 !important; } .country-active:hover { fill: #f5f5f5 !important; stroke: #1a6b6b !important; opacity: 1 !important; }</style></defs>',
                $svgContent
            );
        }
        
        // Aktif ülkeleri vurgula ve data-country attribute ekle
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
                // Fill, stroke, class ve data-country ekle
                $pattern = '/(<path[^>]*id="' . preg_quote($id, '/') . '"[^>]*)(>)/i';
                $replacement = '$1 fill="#ffffff" stroke="#1a6b6b" stroke-width="1.5" class="country country-active" data-country="' . $code . '"$2';
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
                // Class'ı güncelle, fill, stroke ve data-country ekle
                $pattern = '/(<path[^>]*class=")([^"]*' . preg_quote($className, '/') . '[^"]*)(")/i';
                $replacement = '$1$2 country country-active$3 fill="#ffffff" stroke="#1a6b6b" stroke-width="1.5" data-country="' . $code . '"';
                $svgContent = preg_replace($pattern, $replacement, $svgContent);
            }
        }
        
        // Tüm ülkeler için data-country attribute ekle (aktif olmayanlar için de)
        foreach ($countryMapping as $code => $mapping) {
            if (isset($mapping['id'])) {
                $id = $mapping['id'];
                // Eğer data-country yoksa ekle
                if (strpos($svgContent, 'id="' . $id . '"') !== false && strpos($svgContent, 'data-country="' . $code . '"') === false) {
                    $svgContent = preg_replace(
                        '/(<path[^>]*id="' . preg_quote($id, '/') . '"[^>]*)(?!.*data-country)/i',
                        '$1 data-country="' . $code . '"',
                        $svgContent
                    );
                }
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

<div class="world-map-wrapper" data-offices="{{ json_encode($officesData) }}">
    @if($svgContent)
        {!! $svgContent !!}
    @else
        <p>World map SVG file not found.</p>
    @endif
</div>

<script>
(function() {
    var wrapper = document.querySelector('.world-map-wrapper');
    if (!wrapper) return;
    
    var officesData = JSON.parse(wrapper.getAttribute('data-offices') || '{}');
    
    // Ülke kodlarını SVG'deki id/class ile eşleştir
    var countryCodeMap = {
        'KZ': 'KZ',
        'GB': 'GB',
        'UK': 'GB',
        'FI': 'FI',
        'DE': 'DE',
        'CA': 'CA',
        'US': 'US',
        'TR': 'TR',
    };
    
    // Ülke isimleri
    var countryNames = {
        'KZ': 'Kazakistan',
        'GB': 'İngiltere',
        'UK': 'İngiltere',
        'FI': 'Finlandiya',
        'DE': 'Almanya',
        'CA': 'Kanada',
        'US': 'Amerika',
        'TR': 'Türkiye'
    };
    
    function getCountryCodeFromPath(path) {
        // Önce data-country attribute'undan bul (en güvenilir)
        var dataCountry = path.getAttribute('data-country');
        if (dataCountry) {
            return dataCountry;
        }
        
        // ID'den ülke kodunu bul
        var id = path.getAttribute('id');
        if (id) {
            // Direkt ID'yi döndür (KZ, FI, DE, GB, TR, US, CA)
            if (countryCodeMap[id]) {
                return countryCodeMap[id];
            }
            // ID direkt ülke kodu olabilir
            if (officesData[id]) {
                return id;
            }
        }
        
        // Name attribute'undan bul
        var name = path.getAttribute('name');
        if (name) {
            if (name === 'Kazakhstan') return 'KZ';
            if (name === 'United Kingdom') return 'GB';
            if (name === 'Finland') return 'FI';
            if (name === 'Germany') return 'DE';
            if (name === 'Canada') return 'CA';
            if (name === 'United States') return 'US';
            if (name === 'Turkey') return 'TR';
        }
        
        // Class'tan ülke kodunu bul
        var classList = path.classList;
        for (var i = 0; i < classList.length; i++) {
            var className = classList[i];
            if (className === 'Kazakhstan' || className.indexOf('Kazakhstan') !== -1) return 'KZ';
            if (className === 'United Kingdom' || className.indexOf('United Kingdom') !== -1) return 'GB';
            if (className === 'Finland' || className.indexOf('Finland') !== -1) return 'FI';
            if (className === 'Germany' || className.indexOf('Germany') !== -1) return 'DE';
            if (className === 'Canada' || className.indexOf('Canada') !== -1) return 'CA';
            if (className === 'United States' || className.indexOf('United States') !== -1) return 'US';
            if (className === 'Turkey' || className.indexOf('Turkey') !== -1) return 'TR';
        }
        
        return null;
    }
    
    function showOfficeInfo(countryCode) {
        if (!countryCode) {
            return;
        }
        
        var countryData = officesData[countryCode];
        var countryName = countryNames[countryCode] || (countryData ? countryData.name : countryCode);
        
        if (!countryData || !countryData.hasOffice) {
            alert(countryName + ' için temsilcilik bulunmamaktadır.');
            return;
        }
        
        // Temsilcilik varsa basit mesaj göster
        alert(countryName + ' Temsilciliğimiz');
    }
    
    // Tüm path'lere click event ekle
    function attachClickEvents() {
        var paths = wrapper.querySelectorAll('path.country');
        paths.forEach(function(path) {
            path.style.cursor = 'pointer';
            path.addEventListener('click', function(e) {
                e.stopPropagation();
                var countryCode = getCountryCodeFromPath(path);
                if (countryCode) {
                    showOfficeInfo(countryCode);
                }
            });
        });
    }
    
    // SVG yüklendikten sonra event'leri ekle
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(attachClickEvents, 500);
        });
    } else {
        setTimeout(attachClickEvents, 500);
    }
})();
</script>
