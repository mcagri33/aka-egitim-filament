@extends('layouts.app')

@section('title', $translation->seo_title ?? $translation->title)

@push('styles')
<style>
    /* Hero Section */
    .teacher-mobility-hero {
        position: relative;
        min-height: 400px;
        display: flex;
        align-items: center;
        background: var(--color-burgundy);
        color: white;
        padding: 100px 0 80px;
    }
    
    .teacher-mobility-hero .container {
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
        color: var(--color-orange);
    }
    
    .hero-description {
        font-size: 18px;
        line-height: 1.8;
        margin-bottom: 35px;
        max-width: 900px;
        color: rgba(255,255,255,0.95);
    }
    
    /* Country Cards Section */
    .countries-section {
        padding: 80px 0;
        background: white;
    }
    
    .countries-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 40px;
        margin-top: 40px;
    }
    
    .country-card {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        transition: all 0.3s;
        border: 1px solid #f0f0f0;
    }
    
    .country-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 30px rgba(0,0,0,0.12);
    }
    
    .country-image {
        width: 100%;
        height: 300px;
        object-fit: cover;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 100px;
    }
    
    .country-content {
        padding: 30px;
    }
    
    .country-title {
        font-size: 28px;
        font-weight: 700;
        color: var(--color-text);
        margin-bottom: 15px;
    }
    
    .country-description {
        font-size: 16px;
        line-height: 1.7;
        color: var(--color-text);
        margin-bottom: 25px;
    }
    
    .country-button {
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
    
    .country-button:hover {
        background: var(--color-teal);
        transform: translateY(-2px);
    }
    
    /* Programs Intro Section (Оқытушыларға арналған халықаралық бағдарламалар) */
    .programs-intro-section {
        padding: 70px 0;
        background: var(--color-white);
    }
    
    .programs-intro-section .container {
        max-width: 800px;
        margin: 0 auto;
        padding: 40px 32px;
        background: var(--color-white);
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.06);
        border: 1px solid var(--color-border);
    }
    
    .programs-intro-title {
        font-size: 28px;
        font-weight: 700;
        color: var(--color-burgundy);
        margin-bottom: 12px;
        line-height: 1.3;
    }
    
    .programs-intro-underline {
        width: 80px;
        height: 4px;
        background: var(--color-orange);
        border-radius: 2px;
        margin-bottom: 24px;
    }
    
    .programs-intro-text {
        font-size: 16px;
        line-height: 1.8;
        color: var(--color-text);
        margin-bottom: 20px;
    }
    
    .programs-intro-subtitle {
        font-size: 16px;
        font-weight: 600;
        color: var(--color-teal);
        margin-bottom: 14px;
    }
    
    .programs-intro-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .programs-intro-list li {
        position: relative;
        padding-left: 28px;
        margin-bottom: 10px;
        font-size: 15px;
        line-height: 1.7;
        color: var(--color-text);
    }
    
    .programs-intro-list li::before {
        content: '✓';
        position: absolute;
        left: 0;
        color: var(--color-teal);
        font-weight: 700;
        font-size: 18px;
    }
    
    /* What Is Section */
    .what-is-section {
        padding: 80px 0;
        background: var(--color-burgundy);
        color: white;
    }
    
    .what-is-title {
        font-size: 42px;
        font-weight: 700;
        margin-bottom: 25px;
        color: white;
        text-align: center;
    }
    
    .what-is-intro {
        font-size: 18px;
        line-height: 1.8;
        color: rgba(255,255,255,0.95);
        margin-bottom: 50px;
        text-align: center;
        max-width: 1000px;
        margin-left: auto;
        margin-right: auto;
    }
    
    .what-is-steps {
        list-style: none;
        padding: 0;
        margin: 0;
        max-width: 900px;
        margin-left: auto;
        margin-right: auto;
    }
    
    .what-is-step {
        display: flex;
        gap: 20px;
        align-items: flex-start;
        margin-bottom: 30px;
        padding: 25px;
        background: rgba(255,255,255,0.05);
        border-radius: 12px;
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
    
    .step-text {
        font-size: 16px;
        line-height: 1.7;
        color: rgba(255,255,255,0.95);
        margin: 0;
    }
    
    /* Form Section */
    .form-section {
        padding: 80px 0;
        background: white;
    }
    
    .form-container {
        display: grid;
        grid-template-columns: 1.2fr 1fr;
        gap: 60px;
        align-items: center;
    }
    
    .form-title {
        font-size: 42px;
        font-weight: 700;
        color: var(--color-text);
        margin-bottom: 15px;
    }
    
    .form-subtitle {
        font-size: 16px;
        color: var(--color-text-light);
        margin-bottom: 40px;
        line-height: 1.6;
    }
    
    .contact-form {
        display: flex;
        flex-direction: column;
        gap: 25px;
    }
    
    .form-group {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }
    
    .form-group label {
        font-size: 14px;
        font-weight: 600;
        color: var(--color-text);
    }
    
    .form-group input,
    .form-group select,
    .form-group textarea {
        padding: 12px 15px;
        border: 2px solid #e0e0e0;
        border-radius: 8px;
        font-size: 15px;
        transition: border-color 0.3s;
        font-family: inherit;
    }
    
    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
        outline: none;
        border-color: var(--color-teal);
    }
    
    .form-group textarea {
        min-height: 120px;
        resize: vertical;
    }
    
    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }
    
    .form-section-title {
        font-size: 20px;
        font-weight: 700;
        color: var(--color-text);
        margin-top: 20px;
        margin-bottom: 15px;
        padding-bottom: 10px;
        border-bottom: 2px solid var(--color-light-gray);
    }
    
    .submit-button {
        background: linear-gradient(135deg, var(--color-teal), var(--color-teal-light));
        color: white;
        padding: 16px 40px;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        font-size: 16px;
        cursor: pointer;
        transition: all 0.3s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }
    
    .submit-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(32, 153, 144, 0.4);
    }
    
    .form-image {
        width: 100%;
        height: 500px;
        object-fit: cover;
        border-radius: 12px;
        background: linear-gradient(135deg, var(--color-teal), var(--color-burgundy));
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 120px;
    }
    
    /* Benefits Section */
    .benefits-section {
        padding: 80px 0;
        background: #f8f9fa;
    }
    
    .benefits-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 30px;
        margin-top: 40px;
    }
    
    .benefit-card {
        background: white;
        padding: 40px 30px;
        border-radius: 12px;
        text-align: center;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        transition: all 0.3s;
        border-top: 4px solid;
    }
    
    .benefit-card:nth-child(1) {
        border-color: #28a745;
    }
    
    .benefit-card:nth-child(2) {
        border-color: var(--color-teal);
    }
    
    .benefit-card:nth-child(3) {
        border-color: var(--color-burgundy);
    }
    
    .benefit-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.12);
    }
    
    .benefit-icon {
        font-size: 48px;
        margin-bottom: 20px;
    }
    
    .benefit-title {
        font-size: 24px;
        font-weight: 700;
        color: var(--color-text);
        margin-bottom: 10px;
    }
    
    .benefit-description {
        font-size: 16px;
        color: var(--color-text-light);
    }
    
    /* Responsive */
    @media (max-width: 1024px) {
        .countries-grid {
            grid-template-columns: 1fr;
        }
        
        .form-container {
            grid-template-columns: 1fr;
        }
        
        .benefits-grid {
            grid-template-columns: 1fr;
        }
    }
    
    @media (max-width: 768px) {
        .hero-title {
            font-size: 36px;
        }
        
        .what-is-title,
        .form-title {
            font-size: 32px;
        }
        
        .form-row {
            grid-template-columns: 1fr;
        }
        
        .country-content {
            padding: 20px;
        }
    }
</style>
@endpush

@section('content')
    @if(session('success'))
        <div class="container" style="margin-top: 20px;">
            <div style="background: #28a745; color: white; padding: 15px 20px; border-radius: 8px; margin-bottom: 20px;">
                {{ session('success') }}
            </div>
        </div>
    @endif
    
    @if($errors->any())
        <div class="container" style="margin-top: 20px;">
            <div style="background: #dc3545; color: white; padding: 15px 20px; border-radius: 8px; margin-bottom: 20px;">
                <strong>Hata:</strong>
                <ul style="margin: 10px 0 0 0; padding-left: 20px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
    
    @php
        $content = $translation->content;
        // CSRF token'ı formlara ekle
        $content = str_replace('name="_token" value=""', 'name="_token" value="' . csrf_token() . '"', $content);
    @endphp
    {!! $content !!}
@endsection

@push('scripts')
<script>
    // Form submission handled by Laravel
</script>
@endpush
