@php
    $currentLocale = session('locale', \App\Models\Language::where('is_default', true)->first()?->code ?? 'kk');
    $faqTitle = \App\Models\Setting::get('faq_title_' . $currentLocale, 'Sıkça Sorulan Sorular');
    $faqItems = [];
    for ($i = 1; $i <= 6; $i++) {
        $q = \App\Models\Setting::get('faq_' . $i . '_question_' . $currentLocale, '');
        $a = \App\Models\Setting::get('faq_' . $i . '_answer_' . $currentLocale, '');
        if ($q || $a) {
            $faqItems[] = ['question' => $q, 'answer' => $a];
        }
    }
@endphp
@if(count($faqItems) > 0)
<section class="home-faq-section" id="faq">
    <div class="container">
        <h2 class="home-faq-title">{{ $faqTitle }}</h2>
        <div class="home-faq-list">
            @foreach($faqItems as $index => $item)
            <div class="home-faq-item">
                <button type="button" class="home-faq-question" aria-expanded="false" aria-controls="faq-answer-{{ $index }}" id="faq-question-{{ $index }}" data-faq-toggle>
                    <span class="home-faq-question-text">{{ $item['question'] }}</span>
                    <span class="home-faq-icon" aria-hidden="true">+</span>
                </button>
                <div class="home-faq-answer" id="faq-answer-{{ $index }}" role="region" aria-labelledby="faq-question-{{ $index }}" hidden>
                    <div class="home-faq-answer-inner">{!! nl2br(e($item['answer'])) !!}</div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<script>
(function() {
    document.querySelectorAll('[data-faq-toggle]').forEach(function(btn) {
        btn.addEventListener('click', function() {
            var item = this.closest('.home-faq-item');
            var answer = item.querySelector('.home-faq-answer');
            var icon = item.querySelector('.home-faq-icon');
            var isOpen = answer.hasAttribute('hidden');
            document.querySelectorAll('.home-faq-item').forEach(function(other) {
                var otherAnswer = other.querySelector('.home-faq-answer');
                var otherIcon = other.querySelector('.home-faq-icon');
                otherAnswer.setAttribute('hidden', '');
                other.querySelector('.home-faq-question').setAttribute('aria-expanded', 'false');
                other.classList.remove('is-open');
                if (otherIcon) otherIcon.textContent = '+';
            });
            if (isOpen) {
                answer.removeAttribute('hidden');
                this.setAttribute('aria-expanded', 'true');
                item.classList.add('is-open');
                if (icon) icon.textContent = '−';
            }
        });
    });
})();
</script>
@endif
