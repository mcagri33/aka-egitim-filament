@php
    $cities = \App\Models\City::where('is_active', true)->get();
    $defaultLanguage = \App\Models\Language::where('is_default', true)->first();
@endphp

<div class="turkey-map-wrapper">
    <svg class="turkey-map" baseProfile="tiny" fill="#6f9c76" height="422" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-width=".5" version="1.2" viewBox="0 0 1000 422" width="1000" xmlns="http://www.w3.org/2000/svg">
        <g id="features">
            @foreach($cities as $city)
                @php
                    $svgId = $city->svg_id ?? 'TR' . str_pad($city->id, 2, '0', STR_PAD_LEFT);
                    $cityName = $city->name;
                @endphp
                <path class="city {{ $city->offices()->where('is_active', true)->count() > 0 ? 'city-active' : '' }}" 
                      data-city="{{ $cityName }}" 
                      id="{{ $svgId }}" 
                      name="{{ $cityName }}">
                </path>
            @endforeach
        </g>
    </svg>
</div>
