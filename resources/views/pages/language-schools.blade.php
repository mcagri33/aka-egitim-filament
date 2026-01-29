@extends('layouts.app')

@section('title', $translation->seo_title ?? $translation->title)

@push('styles')
<style>
    /* Hero Section */
    .language-schools-hero {
        position: relative;
        min-height: 500px;
        display: flex;
        align-items: center;
        background: linear-gradient(135deg, var(--color-burgundy) 0%, #7a1a35 100%);
        color: white;
        padding: 100px 0 80px;
    }
    
    .language-schools-hero .container {
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
        font-size: 56px;
        font-weight: 700;
        line-height: 1.2;
        margin-bottom: 25px;
        max-width: 800px;
    }
    
    .hero-description {
        font-size: 18px;
        line-height: 1.8;
        margin-bottom: 35px;
        max-width: 700px;
        color: rgba(255,255,255,0.95);
    }
    
    .hero-cta {
        display: inline-block;
        background: var(--color-orange);
        color: white;
        padding: 16px 40px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 16px;
        text-decoration: none;
        transition: all 0.3s;
    }
    
    .hero-cta:hover {
        background: #e67e22;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(230, 126, 34, 0.4);
    }
    
    /* Why Section */
    .why-language-section {
        padding: 80px 0;
        background: white;
    }
    
    .section-title {
        font-size: 42px;
        font-weight: 700;
        color: var(--color-text);
        margin-bottom: 50px;
        position: relative;
        padding-left: 20px;
    }
    
    .section-title::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 4px;
        background: var(--color-burgundy);
    }
    
    .features-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 30px;
        margin-top: 40px;
    }
    
    .feature-card {
        background: white;
        padding: 35px;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        transition: all 0.3s;
        border: 1px solid #f0f0f0;
    }
    
    .feature-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.12);
    }
    
    .feature-icon {
        width: 50px;
        height: 50px;
        background: var(--color-burgundy);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
        font-size: 24px;
    }
    
    .feature-card h3 {
        font-size: 20px;
        font-weight: 600;
        color: var(--color-text);
        margin-bottom: 12px;
    }
    
    .feature-card p {
        font-size: 15px;
        color: var(--color-text-light);
        line-height: 1.6;
        margin: 0;
    }
    
    .feature-image,
    .feature-image-placeholder {
        width: 100%;
        height: 200px;
        object-fit: cover;
        border-radius: 8px;
        margin-bottom: 20px;
    }
    
    .feature-image-placeholder {
        min-height: 200px;
    }
    
    /* Programs Section */
    .programs-section {
        padding: 80px 0;
        background: #f8f9fa;
    }
    
    .programs-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 40px;
    }
    
    .programs-subtitle {
        font-size: 18px;
        color: var(--color-text-light);
        margin-top: 10px;
    }
    
    .program-carousel {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 30px;
    }
    
    .program-card {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        transition: all 0.3s;
    }
    
    .program-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 30px rgba(0,0,0,0.12);
    }
    
    .program-image,
    .program-image-placeholder {
        width: 100%;
        height: 250px;
        object-fit: cover;
        min-height: 250px;
    }
    
    .program-content {
        padding: 30px;
    }
    
    .program-title {
        font-size: 24px;
        font-weight: 700;
        color: var(--color-text);
        margin-bottom: 15px;
    }
    
    .program-meta {
        display: flex;
        gap: 20px;
        margin-bottom: 15px;
        font-size: 14px;
        color: var(--color-text-light);
    }
    
    .program-description {
        font-size: 15px;
        line-height: 1.7;
        color: var(--color-text);
        margin-bottom: 20px;
    }
    
    .program-link {
        display: inline-block;
        color: var(--color-teal);
        font-weight: 600;
        text-decoration: none;
        transition: color 0.3s;
    }
    
    .program-link:hover {
        color: var(--color-burgundy);
    }
    
    /* Requirements Section */
    .requirements-section {
        padding: 80px 0;
        background: white;
    }
    
    .requirements-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 40px;
        margin-top: 40px;
    }
    
    .requirement-box {
        background: var(--color-burgundy);
        color: white;
        padding: 50px;
        border-radius: 16px;
        box-shadow: 0 6px 25px rgba(122, 26, 53, 0.3);
    }
    
    .requirement-box h3 {
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 30px;
        color: white;
    }
    
    .requirement-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .requirement-list li {
        display: flex;
        align-items: flex-start;
        gap: 15px;
        margin-bottom: 20px;
        font-size: 16px;
        line-height: 1.6;
    }
    
    .requirement-list li::before {
        content: '✓';
        color: var(--color-orange);
        font-weight: 700;
        font-size: 20px;
        flex-shrink: 0;
    }
    
    /* FAQ Section */
    .faq-section {
        padding: 80px 0;
        background: #f8f9fa;
    }
    
    .faq-container {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 60px;
        margin-top: 40px;
    }
    
    .faq-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .faq-item {
        background: white;
        border-radius: 12px;
        padding: 25px;
        margin-bottom: 20px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.06);
        transition: all 0.3s;
    }
    
    .faq-item:hover {
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    
    .faq-question {
        font-size: 18px;
        font-weight: 600;
        color: var(--color-text);
        margin-bottom: 12px;
        cursor: pointer;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .faq-answer {
        font-size: 15px;
        line-height: 1.7;
        color: var(--color-text-light);
        margin-top: 12px;
    }
    
    .faq-image,
    .faq-image-placeholder {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 12px;
        min-height: 400px;
    }
    
    /* CTA Section */
    .cta-section {
        padding: 80px 0;
        background: var(--color-burgundy);
        color: white;
        position: relative;
        overflow: hidden;
    }
    
    .cta-content {
        display: grid;
        grid-template-columns: 1.2fr 1fr;
        gap: 60px;
        align-items: center;
    }
    
    .cta-title {
        font-size: 42px;
        font-weight: 700;
        line-height: 1.3;
        margin-bottom: 20px;
    }
    
    .cta-title span {
        color: var(--color-orange);
    }
    
    .cta-description {
        font-size: 18px;
        line-height: 1.8;
        color: rgba(255,255,255,0.95);
        margin-bottom: 35px;
    }
    
    .cta-buttons {
        display: flex;
        gap: 20px;
        flex-wrap: wrap;
    }
    
    .cta-button {
        padding: 16px 35px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 16px;
        text-decoration: none;
        transition: all 0.3s;
        display: inline-block;
    }
    
    .cta-button-primary {
        background: var(--color-orange);
        color: white;
    }
    
    .cta-button-primary:hover {
        background: #e67e22;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(230, 126, 34, 0.4);
    }
    
    .cta-button-secondary {
        background: transparent;
        color: white;
        border: 2px solid white;
    }
    
    .cta-button-secondary:hover {
        background: white;
        color: var(--color-burgundy);
    }
    
    .cta-image,
    .cta-image-placeholder {
        width: 100%;
        height: 400px;
        object-fit: cover;
        border-radius: 12px;
        min-height: 400px;
    }
    
    /* Responsive */
    @media (max-width: 1024px) {
        .features-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        
        .requirements-grid {
            grid-template-columns: 1fr;
        }
        
        .faq-container {
            grid-template-columns: 1fr;
        }
        
        .cta-content {
            grid-template-columns: 1fr;
        }
    }
    
    @media (max-width: 768px) {
        .hero-title {
            font-size: 36px;
        }
        
        .features-grid,
        .program-carousel {
            grid-template-columns: 1fr;
        }
        
        .section-title {
            font-size: 32px;
        }
        
        .cta-title {
            font-size: 28px;
        }
        
        .cta-buttons {
            flex-direction: column;
        }
        
        .cta-button {
            width: 100%;
            text-align: center;
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

@push('scripts')
<script>
    // FAQ Accordion
    document.querySelectorAll('.faq-question').forEach(question => {
        question.addEventListener('click', function() {
            const item = this.closest('.faq-item');
            const answer = item.querySelector('.faq-answer');
            const icon = this.querySelector('span:last-child');
            
            // Close other items
            document.querySelectorAll('.faq-item').forEach(otherItem => {
                if (otherItem !== item) {
                    otherItem.querySelector('.faq-answer').style.display = 'none';
                    otherItem.querySelector('.faq-question span:last-child').textContent = '+';
                }
            });
            
            // Toggle current item
            if (answer.style.display === 'block') {
                answer.style.display = 'none';
                icon.textContent = '+';
            } else {
                answer.style.display = 'block';
                icon.textContent = '−';
            }
        });
    });
    
    // Initially hide all answers
    document.querySelectorAll('.faq-answer').forEach(answer => {
        answer.style.display = 'none';
    });
</script>
@endpush
