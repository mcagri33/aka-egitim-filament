<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Page;
use App\Models\PageTranslation;
use App\Models\Language;
use Illuminate\Support\Str;

class UniversityPageSeeder extends Seeder
{
    public function run(): void
    {
        $languages = Language::whereIn('code', ['kk', 'ru', 'en', 'tr'])->get()->keyBy('code');
        
        if ($languages->isEmpty()) {
            $this->command->error('Languages not found. Please run LanguageSeeder first.');
            return;
        }

        // Create or get the page
        $page = Page::firstOrCreate(
            ['id' => 3],
            ['is_active' => true]
        );

        $page->update(['is_active' => true]);

        // Kazakh Content
        if ($languages->has('kk')) {
            $this->createTranslation($page, $languages['kk'], [
                'title' => 'Университет',
                'slug' => 'universite',
                'content' => $this->getKazakhContent(),
                'seo_title' => 'Университет - AKA Академиясы',
                'seo_description' => 'Шетелде университет білім беру бағыттары және бағдарламалары',
            ]);
        }

        // Russian Content
        if ($languages->has('ru')) {
            $this->createTranslation($page, $languages['ru'], [
                'title' => 'Университет',
                'slug' => 'universite',
                'content' => $this->getRussianContent(),
                'seo_title' => 'Университет - AKA Академия',
                'seo_description' => 'Направления и программы университетского образования за рубежом',
            ]);
        }

        // English Content
        if ($languages->has('en')) {
            $this->createTranslation($page, $languages['en'], [
                'title' => 'University',
                'slug' => 'universite',
                'content' => $this->getEnglishContent(),
                'seo_title' => 'University - AKA Academy',
                'seo_description' => 'University education destinations and programs abroad',
            ]);
        }

        // Turkish Content
        if ($languages->has('tr')) {
            $this->createTranslation($page, $languages['tr'], [
                'title' => 'Üniversite',
                'slug' => 'universite',
                'content' => $this->getTurkishContent(),
                'seo_title' => 'Üniversite - AKA Akademi',
                'seo_description' => 'Yurt dışında üniversite eğitimi destinasyonları ve programları',
            ]);
        }

        $this->command->info('University page created successfully!');
    }

    private function createTranslation($page, $language, $data)
    {
        PageTranslation::updateOrCreate(
            [
                'page_id' => $page->id,
                'language_id' => $language->id,
            ],
            $data
        );
    }

    private function getKazakhContent(): string
    {
        return '<section class="university-hero">
            <div class="container">
                <div class="hero-breadcrumb">
                    <a href="/">Басты бет</a> / Университет
                </div>
                <h1 class="hero-title">Біздің білім беру бағыттарымыз</h1>
                <p class="hero-description">Біз шетелде университет оқуға қалайтын қазақ студенттеріне де, Қазақстанда білім алуға қалайтын халықаралық студенттерге де мақсаттарына сәйкес университет орналастыру үшін кеңес қызметін ұсынамыз.</p>
            </div>
        </section>

        <section class="destinations-section">
            <div class="container">
                <h2 class="section-title">Білім беру бағыттары</h2>
                <div class="destinations-grid">
                    <div class="destination-card">
                        <div class="destination-image">🇬🇧</div>
                        <div class="destination-content">
                            <h3 class="destination-title">Ұлыбритания</h3>
                            <p class="destination-description">Ұлыбританияның беделді университеттері әлем бойынша танымал бакалавриат бағдарламаларын ұсынады. Сапалы академиялық тәжірибе және халықаралық танымалдылық.</p>
                            <a href="#" class="destination-button">Толық ақпарат →</a>
                        </div>
                    </div>
                    <div class="destination-card">
                        <div class="destination-image">🇫🇮</div>
                        <div class="destination-content">
                            <h3 class="destination-title">Финляндия</h3>
                            <p class="destination-description">Финляндияда ағылшын тілін үйрену - бұл скандинавиялық өмір салтын тәжірибе ету және әлемнің ең жақсы білім беру жүйесін жақынан тану мүмкіндігі.</p>
                            <a href="#" class="destination-button">Толық ақпарат →</a>
                        </div>
                    </div>
                    <div class="destination-card">
                        <div class="destination-image">🇩🇪</div>
                        <div class="destination-content">
                            <h3 class="destination-title">Германия</h3>
                            <p class="destination-description">Германияның беделді университеттері әлем бойынша танымал бакалавриат бағдарламаларын ұсынады. Тегін немесе өте төмен құнды білім беру арқылы сапалы академиялық тәжірибе.</p>
                            <a href="#" class="destination-button">Толық ақпарат →</a>
                        </div>
                    </div>
                    <div class="destination-card">
                        <div class="destination-image">🇮🇹</div>
                        <div class="destination-content">
                            <h3 class="destination-title">Италия</h3>
                            <p class="destination-description">Италияның тамырлы университеттері әлем бойынша танымал академиялық бағдарламаларды ұсынады.</p>
                            <a href="#" class="destination-button">Толық ақпарат →</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="support-section">
            <div class="container">
                <h2 class="support-title">Өтініш процесінде қалай көмектесеміз?</h2>
                <p class="support-intro">AKA Білім беру ретінде біз бағдарлама салыстыру, өтініш кестесін жоспарлау, мотивациялық хат дайындау, грант және қаржылық жоспарлау, студент визасы және тұру орны процестерінің әрбір қадамында сізбен біргеміз. Біз процесті ашық түрде басқарып, құжаттарыңыздың толық және уақытында жіберілуін қамтамасыз етеміз.</p>
                <div class="support-steps">
                    <div class="support-step">
                        <div class="step-number">1</div>
                        <div class="step-content">
                            <p class="step-text">Университет және мамандық зерттегеннен кейін жеке өтініш стратегиясын құрамыз.</p>
                        </div>
                    </div>
                    <div class="support-step">
                        <div class="step-number">2</div>
                        <div class="step-content">
                            <p class="step-text">Қажетті академиялық және тілдік құжаттардың дұрыстығы мен ресми аудармасын тексеріп отырамыз.</p>
                        </div>
                    </div>
                    <div class="support-step">
                        <div class="step-number">3</div>
                        <div class="step-content">
                            <p class="step-text">Uni-Assist, Studielink сияқты платформаларда өтініш файлыңызды бірге аяқтаймыз.</p>
                        </div>
                    </div>
                    <div class="support-step">
                        <div class="step-number">4</div>
                        <div class="step-content">
                            <p class="step-text">Виза сұхбаты, бұғатталған шот және денсаулық сақтандыру сияқты маңызды кезеңдерде кеңес беріп отырамыз.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>';
    }

    private function getRussianContent(): string
    {
        return '<section class="university-hero">
            <div class="container">
                <div class="hero-breadcrumb">
                    <a href="/">Главная</a> / Университет
                </div>
                <h1 class="hero-title">Наши направления образования</h1>
                <p class="hero-description">Мы предлагаем услуги консультирования по размещению в университетах, соответствующих целям, как казахстанским студентам, желающим учиться за границей, так и международным студентам, желающим учиться в Казахстане.</p>
            </div>
        </section>

        <section class="destinations-section">
            <div class="container">
                <h2 class="section-title">Направления образования</h2>
                <div class="destinations-grid">
                    <div class="destination-card">
                        <div class="destination-image">🇬🇧</div>
                        <div class="destination-content">
                            <h3 class="destination-title">Великобритания</h3>
                            <p class="destination-description">Престижные университеты Великобритании предлагают признанные во всем мире программы бакалавриата. Качественный академический опыт и международное признание.</p>
                            <a href="#" class="destination-button">Подробнее →</a>
                        </div>
                    </div>
                    <div class="destination-card">
                        <div class="destination-image">🇫🇮</div>
                        <div class="destination-content">
                            <h3 class="destination-title">Финляндия</h3>
                            <p class="destination-description">Изучение английского языка в Финляндии - это возможность познакомиться со скандинавским образом жизни и узнать лучшую систему образования в мире.</p>
                            <a href="#" class="destination-button">Подробнее →</a>
                        </div>
                    </div>
                    <div class="destination-card">
                        <div class="destination-image">🇩🇪</div>
                        <div class="destination-content">
                            <h3 class="destination-title">Германия</h3>
                            <p class="destination-description">Престижные университеты Германии предлагают признанные во всем мире программы бакалавриата. Качественный академический опыт с бесплатным или очень низким образованием.</p>
                            <a href="#" class="destination-button">Подробнее →</a>
                        </div>
                    </div>
                    <div class="destination-card">
                        <div class="destination-image">🇮🇹</div>
                        <div class="destination-content">
                            <h3 class="destination-title">Италия</h3>
                            <p class="destination-description">Устоявшиеся университеты Италии предлагают признанные во всем мире академические программы.</p>
                            <a href="#" class="destination-button">Подробнее →</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="support-section">
            <div class="container">
                <h2 class="support-title">Как мы поддерживаем в процессе подачи заявки?</h2>
                <p class="support-intro">Как AKA Образование, мы с вами на каждом этапе процесса сравнения программ, планирования графика заявок, подготовки мотивационного письма, планирования стипендий и финансов, студенческой визы и процессов размещения. Мы управляем процессом прозрачно, обеспечивая полноту и своевременность отправки ваших документов.</p>
                <div class="support-steps">
                    <div class="support-step">
                        <div class="step-number">1</div>
                        <div class="step-content">
                            <p class="step-text">После исследования университета и специальности мы создаем личную стратегию подачи заявки.</p>
                        </div>
                    </div>
                    <div class="support-step">
                        <div class="step-number">2</div>
                        <div class="step-content">
                            <p class="step-text">Мы проверяем точность и официальный перевод необходимых академических и языковых документов.</p>
                        </div>
                    </div>
                    <div class="support-step">
                        <div class="step-number">3</div>
                        <div class="step-content">
                            <p class="step-text">Мы вместе завершаем ваш файл заявки на платформах, таких как Uni-Assist, Studielink.</p>
                        </div>
                    </div>
                    <div class="support-step">
                        <div class="step-number">4</div>
                        <div class="step-content">
                            <p class="step-text">Мы предоставляем руководство на критических этапах, таких как визовое собеседование, заблокированный счет и медицинское страхование.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>';
    }

    private function getEnglishContent(): string
    {
        return '<section class="university-hero">
            <div class="container">
                <div class="hero-breadcrumb">
                    <a href="/">Home</a> / University
                </div>
                <h1 class="hero-title">Our Education Destinations</h1>
                <p class="hero-description">We offer guidance services for suitable university placement to both students who want to study abroad and international students who want to study in our country.</p>
            </div>
        </section>

        <section class="destinations-section">
            <div class="container">
                <h2 class="section-title">Education Destinations</h2>
                <div class="destinations-grid">
                    <div class="destination-card">
                        <div class="destination-image">🇬🇧</div>
                        <div class="destination-content">
                            <h3 class="destination-title">United Kingdom</h3>
                            <p class="destination-description">The UK\'s prestigious universities offer globally recognized bachelor\'s programs. Quality academic experience and international recognition.</p>
                            <a href="#" class="destination-button">Learn More →</a>
                        </div>
                    </div>
                    <div class="destination-card">
                        <div class="destination-image">🇫🇮</div>
                        <div class="destination-content">
                            <h3 class="destination-title">Finland</h3>
                            <p class="destination-description">Learning English in Finland is an opportunity to experience the Scandinavian lifestyle and get to know the world\'s best education system up close.</p>
                            <a href="#" class="destination-button">Learn More →</a>
                        </div>
                    </div>
                    <div class="destination-card">
                        <div class="destination-image">🇩🇪</div>
                        <div class="destination-content">
                            <h3 class="destination-title">Germany</h3>
                            <p class="destination-description">Germany\'s prestigious universities offer globally recognized bachelor\'s programs. Quality academic experience with free or very low-cost education.</p>
                            <a href="#" class="destination-button">Learn More →</a>
                        </div>
                    </div>
                    <div class="destination-card">
                        <div class="destination-image">🇮🇹</div>
                        <div class="destination-content">
                            <h3 class="destination-title">Italy</h3>
                            <p class="destination-description">Italy\'s well-established universities offer globally recognized academic programs.</p>
                            <a href="#" class="destination-button">Learn More →</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="support-section">
            <div class="container">
                <h2 class="support-title">How Do We Support During the Application Process?</h2>
                <p class="support-intro">As AKA Education, we are with you at every step of program comparison, application timeline planning, motivation letter preparation, scholarship and financial planning, student visa, and accommodation processes. We manage the process transparently, ensuring your documents are complete and submitted on time.</p>
                <div class="support-steps">
                    <div class="support-step">
                        <div class="step-number">1</div>
                        <div class="step-content">
                            <p class="step-text">We create a personal application strategy after university and department research.</p>
                        </div>
                    </div>
                    <div class="support-step">
                        <div class="step-number">2</div>
                        <div class="step-content">
                            <p class="step-text">We check the accuracy and official translation of required academic and language documents.</p>
                        </div>
                    </div>
                    <div class="support-step">
                        <div class="step-number">3</div>
                        <div class="step-content">
                            <p class="step-text">We complete your application file together on platforms like Uni-Assist, Studielink.</p>
                        </div>
                    </div>
                    <div class="support-step">
                        <div class="step-number">4</div>
                        <div class="step-content">
                            <p class="step-text">We provide guidance during critical stages such as visa interviews, blocked accounts, and health insurance.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>';
    }

    private function getTurkishContent(): string
    {
        return '<section class="university-hero">
            <div class="container">
                <div class="hero-breadcrumb">
                    <a href="/">Anasayfa</a> / Üniversite
                </div>
                <h1 class="hero-title">Eğitim Destinasyonlarımız</h1>
                <p class="hero-description">Hem yurt dışında üniversite okumak isteyen öğrencilere hem de ülkemizde eğitim almak isteyen uluslararası öğrencilere hedeflerine uygun üniversite yerleşimi için rehberlik hizmeti sunuyoruz.</p>
            </div>
        </section>

        <section class="destinations-section">
            <div class="container">
                <h2 class="section-title">Eğitim Destinasyonları</h2>
                <div class="destinations-grid">
                    <div class="destination-card">
                        <div class="destination-image">🇬🇧</div>
                        <div class="destination-content">
                            <h3 class="destination-title">İngiltere</h3>
                            <p class="destination-description">İngiltere\'nin prestijli üniversiteleri dünya çapında tanınan lisans programları sunar. Kaliteli akademik deneyim ve uluslararası tanınırlık.</p>
                            <a href="#" class="destination-button">Detaylı Bilgi →</a>
                        </div>
                    </div>
                    <div class="destination-card">
                        <div class="destination-image">🇫🇮</div>
                        <div class="destination-content">
                            <h3 class="destination-title">Finlandiya</h3>
                            <p class="destination-description">Finlandiya\'da İngilizce öğrenmek, İskandinav yaşam tarzını deneyimleme ve dünya\'nın en iyi eğitim sistemini yakından tanıma fırsatıdır.</p>
                            <a href="#" class="destination-button">Detaylı Bilgi →</a>
                        </div>
                    </div>
                    <div class="destination-card">
                        <div class="destination-image">🇩🇪</div>
                        <div class="destination-content">
                            <h3 class="destination-title">Almanya</h3>
                            <p class="destination-description">Almanya\'nın prestijli üniversiteleri dünya çapında tanınan lisans programları sunar. Ücretsiz veya çok düşük maliyetli eğitim ile kaliteli akademik deneyim.</p>
                            <a href="#" class="destination-button">Detaylı Bilgi →</a>
                        </div>
                    </div>
                    <div class="destination-card">
                        <div class="destination-image">🇮🇹</div>
                        <div class="destination-content">
                            <h3 class="destination-title">İtalya</h3>
                            <p class="destination-description">İtalya\'nın köklü üniversiteleri, dünya çapında tanınan akademik programlar sunar.</p>
                            <a href="#" class="destination-button">Detaylı Bilgi →</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="support-section">
            <div class="container">
                <h2 class="support-title">Başvuru Sürecinde Nasıl Destek Oluyoruz?</h2>
                <p class="support-intro">Aka Eğitim olarak program karşılaştırması, başvuru takvimi planlaması, motivasyon mektubu hazırlığı, burs ve finansal planlama, öğrenci vizesi ve konaklama süreçlerinin her adımında yanınızdayız. Süreci şeffaf biçimde yöneterek belgelerinizin eksiksiz ve zamanında gönderilmesini sağlıyoruz.</p>
                <div class="support-steps">
                    <div class="support-step">
                        <div class="step-number">1</div>
                        <div class="step-content">
                            <p class="step-text">Üniversite ve bölüm araştırması sonrasında kişisel başvuru stratejisi oluşturuyoruz.</p>
                        </div>
                    </div>
                    <div class="support-step">
                        <div class="step-number">2</div>
                        <div class="step-content">
                            <p class="step-text">Gerekli akademik ve dil belgelerinin doğruluğunu ve resmi tercümesini kontrol ediyoruz.</p>
                        </div>
                    </div>
                    <div class="support-step">
                        <div class="step-number">3</div>
                        <div class="step-content">
                            <p class="step-text">Uni-Assist, Studielink gibi platformlarda başvuru dosyanızı birlikte tamamlıyoruz.</p>
                        </div>
                    </div>
                    <div class="support-step">
                        <div class="step-number">4</div>
                        <div class="step-content">
                            <p class="step-text">Vize mülakatı, bloke hesap ve sağlık sigortası gibi kritik aşamalarda rehberlik sunuyoruz.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>';
    }
}
