@extends('layouts.app')

@section('title', $translation->seo_title ?? $translation->title)

@push('styles')
<style>
    /* Hero Section */
    .university-hero {
        position: relative;
        min-height: 400px;
        display: flex;
        align-items: center;
        background: var(--color-burgundy);
        color: white;
        padding: 100px 0 80px;
    }
    
    .university-hero .container {
        position: relative;
        z-index: 2;
    }
    
    .hero-breadcrumb {
        font-size: 14px;
        color: rgba(255,255,255,0.8);
        margin-bottom: 20px;
    }
    
    .hero-breadcrumb a {
        color: rgba(255,255,255,0.8);
        text-decoration: none;
    }
    
    .hero-breadcrumb a:hover {
        color: white;
    }
    
    .hero-title {
        font-size: 48px;
        font-weight: 700;
        line-height: 1.2;
        margin-bottom: 25px;
        max-width: 900px;
    }
    
    .hero-description {
        font-size: 18px;
        line-height: 1.8;
        margin-bottom: 35px;
        max-width: 900px;
        color: rgba(255,255,255,0.95);
    }
    
    /* Destinations Section */
    .destinations-section {
        padding: 80px 0;
        background: white;
    }
    
    .section-title {
        font-size: 42px;
        font-weight: 700;
        color: var(--color-text);
        margin-bottom: 50px;
        text-align: center;
    }
    
    .destinations-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 40px;
        margin-top: 40px;
    }
    
    .destination-card {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        transition: all 0.3s;
        border: 1px solid #f0f0f0;
    }
    
    .destination-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 30px rgba(0,0,0,0.12);
    }
    
    .destination-image {
        width: 100%;
        height: 250px;
        object-fit: cover;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 80px;
    }
    
    .destination-content {
        padding: 30px;
    }
    
    .destination-title {
        font-size: 28px;
        font-weight: 700;
        color: var(--color-text);
        margin-bottom: 15px;
    }
    
    .destination-description {
        font-size: 16px;
        line-height: 1.7;
        color: var(--color-text);
        margin-bottom: 25px;
    }
    
    .destination-button {
        display: inline-block;
        background: #4a5568;
        color: white;
        padding: 12px 30px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 15px;
        text-decoration: none;
        transition: all 0.3s;
    }
    
    .destination-button:hover {
        background: var(--color-burgundy);
        transform: translateY(-2px);
    }
    
    /* Support Process Section */
    .support-section {
        padding: 80px 0;
        background: var(--color-burgundy);
        color: white;
    }
    
    .support-title {
        font-size: 42px;
        font-weight: 700;
        margin-bottom: 25px;
        color: white;
        text-align: center;
    }
    
    .support-intro {
        font-size: 18px;
        line-height: 1.8;
        color: rgba(255,255,255,0.95);
        margin-bottom: 50px;
        text-align: center;
        max-width: 1000px;
        margin-left: auto;
        margin-right: auto;
    }
    
    .support-steps {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 30px;
        margin-top: 40px;
        max-width: 1000px;
        margin-left: auto;
        margin-right: auto;
    }
    
    .support-step {
        display: flex;
        gap: 20px;
        align-items: flex-start;
    }
    
    .step-number {
        width: 50px;
        height: 50px;
        background: var(--color-orange);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 24px;
        color: white;
        flex-shrink: 0;
    }
    
    .step-content {
        flex: 1;
    }
    
    .step-text {
        font-size: 16px;
        line-height: 1.7;
        color: rgba(255,255,255,0.95);
    }
    
    /* Responsive */
    @media (max-width: 1024px) {
        .destinations-grid {
            grid-template-columns: 1fr;
        }
        
        .support-steps {
            grid-template-columns: 1fr;
        }
    }
    
    @media (max-width: 768px) {
        .hero-title {
            font-size: 36px;
        }
        
        .section-title,
        .support-title {
            font-size: 32px;
        }
        
        .destination-content {
            padding: 20px;
        }
        
        .destination-title {
            font-size: 24px;
        }
    }
</style>
@endpush

@section('content')
    @php
        $content = $translation->content;
    @endphp
    {!! $content !!}
@endsection
