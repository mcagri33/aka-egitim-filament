@extends('layouts.app')

@section('title', $translation->seo_title ?? $translation->title)

@push('styles')
<style>
    /* Page Header */
    .page-header {
        background: linear-gradient(135deg, var(--color-burgundy) 0%, #7a1a35 100%);
        padding: 80px 0 60px;
        color: white;
        text-align: center;
        position: relative;
        overflow: hidden;
    }
    
    .page-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><circle cx="50" cy="50" r="2" fill="rgba(255,255,255,0.1)"/></svg>');
        opacity: 0.3;
    }
    
    .page-title {
        font-size: 56px;
        font-weight: 700;
        margin-bottom: 20px;
        position: relative;
        z-index: 1;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
        letter-spacing: -0.5px;
    }
    
    /* Page Content */
    .page-content {
        padding: 80px 0;
        background: #fafafa;
    }
    
    .page-body {
        max-width: 900px;
        margin: 0 auto;
        background: var(--color-white);
        padding: 60px;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    }
    
    /* Sections */
    .page-body section {
        margin-bottom: 60px;
    }
    
    .page-body section:last-child {
        margin-bottom: 0;
    }
    
    /* Hero Section */
    .page-body .hero-section {
        text-align: center;
        padding: 40px 0;
        margin-bottom: 60px;
        border-bottom: 2px solid var(--color-light-gray);
    }
    
    .page-body .hero-section h2 {
        font-size: 32px;
        font-weight: 600;
        color: var(--color-burgundy);
        margin-bottom: 20px;
        font-style: italic;
        line-height: 1.4;
    }
    
    .page-body .hero-section p {
        font-size: 18px;
        color: var(--color-text-light);
        margin-bottom: 15px;
    }
    
    .page-body .world-map-placeholder,
    .page-body .world-map-wrapper {
        margin: 40px auto;
        max-width: 100%;
    }
    
    /* Typography */
    .page-body h2 {
        font-size: 36px;
        font-weight: 700;
        margin: 50px 0 25px;
        color: var(--color-burgundy);
        position: relative;
        padding-bottom: 15px;
    }
    
    .page-body h2::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 60px;
        height: 4px;
        background: linear-gradient(90deg, var(--color-teal), var(--color-orange));
        border-radius: 2px;
    }
    
    .page-body h3 {
        font-size: 26px;
        font-weight: 600;
        margin: 35px 0 20px;
        color: var(--color-teal);
    }
    
    .page-body h4 {
        font-size: 20px;
        font-weight: 600;
        margin: 25px 0 15px;
        color: var(--color-text);
    }
    
    .page-body p {
        font-size: 17px;
        line-height: 1.9;
        margin-bottom: 20px;
        color: var(--color-text);
    }
    
    .page-body ul,
    .page-body ol {
        margin: 25px 0;
        padding-left: 35px;
    }
    
    .page-body li {
        margin-bottom: 12px;
        line-height: 1.9;
        font-size: 17px;
        color: var(--color-text);
    }
    
    .page-body ul li::marker {
        color: var(--color-teal);
    }
    
    /* Highlight Boxes */
    .page-body .highlight-box {
        background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
        padding: 35px;
        border-radius: 12px;
        margin: 35px 0;
        border-left: 5px solid var(--color-teal);
        box-shadow: 0 3px 15px rgba(0,0,0,0.08);
        transition: transform 0.3s, box-shadow 0.3s;
    }
    
    .page-body .highlight-box:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 20px rgba(0,0,0,0.12);
    }
    
    .page-body .highlight-box h3 {
        margin-top: 0;
        color: var(--color-teal);
        font-size: 24px;
    }
    
    .page-body .highlight-box p {
        margin-bottom: 0;
    }
    
    /* Steps List */
    .page-body .steps-list {
        counter-reset: step-counter;
        list-style: none;
        padding: 0;
        margin: 40px 0;
    }
    
    .page-body .steps-list li {
        counter-increment: step-counter;
        position: relative;
        padding: 30px 30px 30px 90px;
        margin-bottom: 25px;
        background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
        border-radius: 12px;
        border-left: 4px solid var(--color-teal);
        box-shadow: 0 2px 10px rgba(0,0,0,0.06);
        transition: all 0.3s;
    }
    
    .page-body .steps-list li:hover {
        transform: translateX(5px);
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    
    .page-body .steps-list li::before {
        content: counter(step-counter);
        position: absolute;
        left: 25px;
        top: 30px;
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, var(--color-teal), #1a7a73);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 20px;
        box-shadow: 0 3px 10px rgba(32, 153, 144, 0.3);
    }
    
    .page-body .steps-list li h4 {
        margin-top: 0;
        color: var(--color-burgundy);
        font-size: 22px;
    }
    
    .page-body .steps-list li ul {
        margin-top: 15px;
        margin-bottom: 0;
    }
    
    /* FAQ Section */
    .page-body .faq-section {
        margin-top: 60px;
        padding-top: 40px;
        border-top: 2px solid var(--color-light-gray);
    }
    
    .page-body .faq-item {
        margin-bottom: 25px;
        background: var(--color-white);
        border-radius: 12px;
        padding: 25px 30px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.06);
        border: 1px solid var(--color-border);
        transition: all 0.3s;
    }
    
    .page-body .faq-item:hover {
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        border-color: var(--color-teal);
    }
    
    .page-body .faq-question {
        font-weight: 700;
        font-size: 19px;
        color: var(--color-burgundy);
        margin-bottom: 12px;
        display: flex;
        align-items: center;
    }
    
    .page-body .faq-question::before {
        content: '❓';
        margin-right: 12px;
        font-size: 20px;
    }
    
    .page-body .faq-answer {
        color: var(--color-text);
        line-height: 1.9;
        font-size: 16px;
        padding-left: 32px;
    }
    
    /* Contact Section */
    .page-body .contact-section {
        background: linear-gradient(135deg, var(--color-teal) 0%, #1a7a73 100%);
        padding: 40px;
        border-radius: 12px;
        color: white;
        text-align: center;
        margin: 50px 0;
    }
    
    .page-body .contact-section h2 {
        color: white;
        margin-top: 0;
    }
    
    .page-body .contact-section h2::after {
        background: white;
    }
    
    .page-body .contact-section p {
        color: rgba(255,255,255,0.95);
        font-size: 18px;
        margin-bottom: 15px;
    }
    
    /* Teacher Mobility & University Sections */
    .page-body .teacher-mobility-section,
    .page-body .university-section,
    .page-body .language-schools-section {
        background: #f8f9fa;
        padding: 40px;
        border-radius: 12px;
        margin: 40px 0;
    }
    
    .page-body .teacher-mobility-section ul,
    .page-body .language-schools-section ul {
        list-style: none;
        padding-left: 0;
    }
    
    .page-body .teacher-mobility-section li,
    .page-body .language-schools-section li {
        padding-left: 30px;
        position: relative;
    }
    
    .page-body .teacher-mobility-section li::before,
    .page-body .language-schools-section li::before {
        content: '✓';
        position: absolute;
        left: 0;
        color: var(--color-teal);
        font-weight: 700;
        font-size: 20px;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .page-header {
            padding: 50px 0 40px;
        }
        
        .page-title {
            font-size: 36px;
        }
        
        .page-body {
            padding: 30px 20px;
        }
        
        .page-body h2 {
            font-size: 28px;
        }
        
        .page-body h3 {
            font-size: 22px;
        }
        
        .page-body .steps-list li {
            padding: 25px 20px 25px 70px;
        }
        
        .page-body .steps-list li::before {
            width: 40px;
            height: 40px;
            font-size: 18px;
            left: 15px;
        }
        
        .page-body .highlight-box,
        .page-body .contact-section,
        .page-body .teacher-mobility-section,
        .page-body .university-section,
        .page-body .language-schools-section {
            padding: 25px 20px;
        }
    }
</style>
@endpush

@section('content')
    <div class="page-header">
        <div class="container">
            <h1 class="page-title">{{ $translation->title }}</h1>
        </div>
    </div>
    
    <div class="page-content">
        <div class="container">
            <div class="page-body">
                @php
                    $content = $translation->content;
                    if (strpos($content, 'world-map-placeholder') !== false) {
                        $mapHtml = view('partials.world-map')->render();
                        $content = str_replace('<div class="world-map-placeholder"></div>', $mapHtml, $content);
                    }
                @endphp
                {!! $content !!}
            </div>
        </div>
    </div>
@endsection
