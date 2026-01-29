<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Page;
use App\Models\PageTranslation;
use App\Models\Language;
use Illuminate\Support\Str;

class ContactPageSeeder extends Seeder
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
            ['id' => 5],
            ['is_active' => true]
        );

        $page->update(['is_active' => true]);

        // Kazakh Content
        if ($languages->has('kk')) {
            $this->createTranslation($page, $languages['kk'], [
                'title' => 'Байланыс',
                'slug' => 'iletisim',
                'content' => $this->getKazakhContent(),
                'seo_title' => 'Байланыс - AKA Академиясы',
                'seo_description' => 'Бізбен байланысыңыз, тегін кеңес алыңыз',
            ]);
        }

        // Russian Content
        if ($languages->has('ru')) {
            $this->createTranslation($page, $languages['ru'], [
                'title' => 'Связь',
                'slug' => 'iletisim',
                'content' => $this->getRussianContent(),
                'seo_title' => 'Связь - AKA Академия',
                'seo_description' => 'Свяжитесь с нами, получите бесплатную консультацию',
            ]);
        }

        // English Content
        if ($languages->has('en')) {
            $this->createTranslation($page, $languages['en'], [
                'title' => 'Contact',
                'slug' => 'iletisim',
                'content' => $this->getEnglishContent(),
                'seo_title' => 'Contact - AKA Academy',
                'seo_description' => 'Contact us, get free consultation',
            ]);
        }

        // Turkish Content
        if ($languages->has('tr')) {
            $this->createTranslation($page, $languages['tr'], [
                'title' => 'İletişim',
                'slug' => 'iletisim',
                'content' => $this->getTurkishContent(),
                'seo_title' => 'İletişim - AKA Akademi',
                'seo_description' => 'Bizimle iletişime geçin, ücretsiz danışmanlık alın',
            ]);
        }

        $this->command->info('Contact page created successfully!');
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
        return '<section class="contact-hero">
            <div class="container">
                <div class="hero-breadcrumb">
                    <a href="/">Басты бет</a> / Байланыс
                </div>
                <h1 class="hero-title">Байланыс</h1>
                <p class="hero-description">Тегін консультация алыңыз. Ең қолайлы білім беру бағдарламаларын бірге таңдайық.</p>
                <div class="hero-buttons">
                    <a href="#form" class="hero-button hero-button-primary">Тегін консультация алыңыз</a>
                    <a href="#programs" class="hero-button hero-button-secondary">Бағдарламаларға шолу</a>
                </div>
            </div>
        </section>

        <section class="contact-info-section">
            <div class="container">
                <div class="contact-info-grid">
                    <div class="contact-info-card">
                        <div class="contact-icon">📞</div>
                        <div class="contact-label">Телефон</div>
                        <div class="contact-value">
                            <a href="tel:+77012702361">+7701 270 23 61</a><br>
                            <a href="tel:+77757145309">+7775 714 53 09</a>
                        </div>
                    </div>
                    <div class="contact-info-card">
                        <div class="contact-icon">✉️</div>
                        <div class="contact-label">Электрондық пошта</div>
                        <div class="contact-value">
                            <a href="mailto:info@akaegitim.com.tr">info@akaegitim.com.tr</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="form-section" id="form">
            <div class="container">
                <div class="form-container">
                    <div>
                        <h2 class="form-title">Шетелде білім беру саяхатыңызды бастаңыз</h2>
                        <p class="form-subtitle">Форманы толтырыңыз, біздің маман кеңесшілеріміз мүмкіндігінше тезірек сізбен байланысып, сізге арнайы білім беру жоспарыңызды құрайды</p>
                        <form class="contact-form" action="/iletisim" method="POST">
                            <input type="hidden" name="_token" value="">
                            <div class="form-section-title">
                                <span>👤</span>
                                <span>Жеке ақпарат</span>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label>Атыңыз</label>
                                    <input type="text" name="name" required>
                                </div>
                                <div class="form-group">
                                    <label>Тегіңіз</label>
                                    <input type="text" name="surname" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label>Телефон нөміріңіз</label>
                                    <input type="tel" name="phone" required>
                                </div>
                                <div class="form-group">
                                    <label>Қалаңыз</label>
                                    <input type="text" name="city" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label>Электрондық поштаңыз</label>
                                    <input type="email" name="email" required>
                                </div>
                                <div class="form-group">
                                    <label>Туған күніңіз</label>
                                    <input type="date" name="birth_date" required>
                                </div>
                            </div>
                            <div class="form-section-title">
                                <span>🎓</span>
                                <span>Білім беру таңдаулары</span>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label>Бағдарлама түрін таңдаңыз</label>
                                    <select name="program_type" required>
                                        <option value="">Таңдаңыз</option>
                                        <option value="dil-okulu">Діл мектебі</option>
                                        <option value="universite">Университет</option>
                                        <option value="ogretmen-hareketliligi">Мұғалім қозғалысы</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Бағдарламаны таңдаңыз</label>
                                    <select name="program" required>
                                        <option value="">Таңдаңыз</option>
                                        <option value="ingiltere">Ұлыбритания</option>
                                        <option value="finlandiya">Финляндия</option>
                                        <option value="almanya">Германия</option>
                                        <option value="isvicre">Швейцария</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label>Тіл</label>
                                    <select name="language" required>
                                        <option value="">Таңдаңыз</option>
                                        <option value="kk">Қазақша</option>
                                        <option value="ru">Орысша</option>
                                        <option value="en">Ағылшынша</option>
                                        <option value="tr">Түрікше</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-section-title">
                                <span>💬</span>
                                <span>Хабарламаңыз</span>
                            </div>
                            <div class="form-group">
                                <label>Толық ақпаратты бізбен бөлісіңіз</label>
                                <textarea name="message" required></textarea>
                            </div>
                            <button type="submit" class="submit-button">
                                <span>Тегін консультация алыңыз</span>
                                <span>✈️</span>
                            </button>
                        </form>
                    </div>
                    <div>
                        <div class="form-image">🎓</div>
                    </div>
                </div>
            </div>
        </section>

        <section class="benefits-section">
            <div class="container">
                <div class="benefits-grid">
                    <div class="benefit-card">
                        <div class="benefit-icon">✓</div>
                        <h3 class="benefit-title">100% Тегін</h3>
                        <p class="benefit-description">Кеңес қызметі</p>
                    </div>
                    <div class="benefit-card">
                        <div class="benefit-icon">⏱️</div>
                        <h3 class="benefit-title">24 сағат ішінде</h3>
                        <p class="benefit-description">Жылдам жауап</p>
                    </div>
                    <div class="benefit-card">
                        <div class="benefit-icon">👥</div>
                        <h3 class="benefit-title">Маман құрамы</h3>
                        <p class="benefit-description">Кәсіби көмек</p>
                    </div>
                </div>
            </div>
        </section>';
    }

    private function getRussianContent(): string
    {
        return '<section class="contact-hero">
            <div class="container">
                <div class="hero-breadcrumb">
                    <a href="/">Главная</a> / Связь
                </div>
                <h1 class="hero-title">Связь</h1>
                <p class="hero-description">Получите бесплатную консультацию. Давайте вместе выберем наиболее подходящие образовательные программы.</p>
                <div class="hero-buttons">
                    <a href="#form" class="hero-button hero-button-primary">Получить бесплатную консультацию</a>
                    <a href="#programs" class="hero-button hero-button-secondary">Обзор программ</a>
                </div>
            </div>
        </section>

        <section class="contact-info-section">
            <div class="container">
                <div class="contact-info-grid">
                    <div class="contact-info-card">
                        <div class="contact-icon">📞</div>
                        <div class="contact-label">Телефон</div>
                        <div class="contact-value">
                            <a href="tel:+77012702361">+7701 270 23 61</a><br>
                            <a href="tel:+77757145309">+7775 714 53 09</a>
                        </div>
                    </div>
                    <div class="contact-info-card">
                        <div class="contact-icon">✉️</div>
                        <div class="contact-label">Электронная почта</div>
                        <div class="contact-value">
                            <a href="mailto:info@akaegitim.com.tr">info@akaegitim.com.tr</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="form-section" id="form">
            <div class="container">
                <div class="form-container">
                    <div>
                        <h2 class="form-title">Начните свое путешествие в образовании за рубежом</h2>
                        <p class="form-subtitle">Заполните форму, и наши эксперты-консультанты свяжутся с вами как можно скорее, чтобы создать ваш индивидуальный план обучения</p>
                        <form class="contact-form" action="/iletisim" method="POST">
                            <input type="hidden" name="_token" value="">
                            <div class="form-section-title">
                                <span>👤</span>
                                <span>Личная информация</span>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label>Ваше имя</label>
                                    <input type="text" name="name" required>
                                </div>
                                <div class="form-group">
                                    <label>Ваша фамилия</label>
                                    <input type="text" name="surname" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label>Ваш номер телефона</label>
                                    <input type="tel" name="phone" required>
                                </div>
                                <div class="form-group">
                                    <label>Ваш город</label>
                                    <input type="text" name="city" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label>Ваш email</label>
                                    <input type="email" name="email" required>
                                </div>
                                <div class="form-group">
                                    <label>Дата рождения</label>
                                    <input type="date" name="birth_date" required>
                                </div>
                            </div>
                            <div class="form-section-title">
                                <span>🎓</span>
                                <span>Образовательные предпочтения</span>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label>Выберите тип программы</label>
                                    <select name="program_type" required>
                                        <option value="">Выберите</option>
                                        <option value="dil-okulu">Языковая школа</option>
                                        <option value="universite">Университет</option>
                                        <option value="ogretmen-hareketliligi">Мобильность учителей</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Выберите программу</label>
                                    <select name="program" required>
                                        <option value="">Выберите</option>
                                        <option value="ingiltere">Великобритания</option>
                                        <option value="finlandiya">Финляндия</option>
                                        <option value="almanya">Германия</option>
                                        <option value="isvicre">Швейцария</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label>Язык</label>
                                    <select name="language" required>
                                        <option value="">Выберите</option>
                                        <option value="kk">Казахский</option>
                                        <option value="ru">Русский</option>
                                        <option value="en">Английский</option>
                                        <option value="tr">Турецкий</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-section-title">
                                <span>💬</span>
                                <span>Ваше сообщение</span>
                            </div>
                            <div class="form-group">
                                <label>Поделитесь деталями с нами</label>
                                <textarea name="message" required></textarea>
                            </div>
                            <button type="submit" class="submit-button">
                                <span>Получить бесплатную консультацию</span>
                                <span>✈️</span>
                            </button>
                        </form>
                    </div>
                    <div>
                        <div class="form-image">🎓</div>
                    </div>
                </div>
            </div>
        </section>

        <section class="benefits-section">
            <div class="container">
                <div class="benefits-grid">
                    <div class="benefit-card">
                        <div class="benefit-icon">✓</div>
                        <h3 class="benefit-title">100% Бесплатно</h3>
                        <p class="benefit-description">Консультационная услуга</p>
                    </div>
                    <div class="benefit-card">
                        <div class="benefit-icon">⏱️</div>
                        <h3 class="benefit-title">В течение 24 часов</h3>
                        <p class="benefit-description">Быстрый ответ</p>
                    </div>
                    <div class="benefit-card">
                        <div class="benefit-icon">👥</div>
                        <h3 class="benefit-title">Экспертный состав</h3>
                        <p class="benefit-description">Профессиональная поддержка</p>
                    </div>
                </div>
            </div>
        </section>';
    }

    private function getEnglishContent(): string
    {
        return '<section class="contact-hero">
            <div class="container">
                <div class="hero-breadcrumb">
                    <a href="/">Home</a> / Contact
                </div>
                <h1 class="hero-title">Contact</h1>
                <p class="hero-description">Get free consultation. Let\'s choose the most suitable education programs together.</p>
                <div class="hero-buttons">
                    <a href="#form" class="hero-button hero-button-primary">Get Free Consultation</a>
                    <a href="#programs" class="hero-button hero-button-secondary">Browse Programs</a>
                </div>
            </div>
        </section>

        <section class="contact-info-section">
            <div class="container">
                <div class="contact-info-grid">
                    <div class="contact-info-card">
                        <div class="contact-icon">📞</div>
                        <div class="contact-label">Phone</div>
                        <div class="contact-value">
                            <a href="tel:+77012702361">+7701 270 23 61</a><br>
                            <a href="tel:+77757145309">+7775 714 53 09</a>
                        </div>
                    </div>
                    <div class="contact-info-card">
                        <div class="contact-icon">✉️</div>
                        <div class="contact-label">Email</div>
                        <div class="contact-value">
                            <a href="mailto:info@akaegitim.com.tr">info@akaegitim.com.tr</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="form-section" id="form">
            <div class="container">
                <div class="form-container">
                    <div>
                        <h2 class="form-title">Start Your Overseas Education Journey</h2>
                        <p class="form-subtitle">Fill out the form, and our expert consultants will contact you as soon as possible to create your special education plan</p>
                        <form class="contact-form" action="/iletisim" method="POST">
                            <input type="hidden" name="_token" value="">
                            <div class="form-section-title">
                                <span>👤</span>
                                <span>Personal Information</span>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label>Your Name</label>
                                    <input type="text" name="name" required>
                                </div>
                                <div class="form-group">
                                    <label>Your Surname</label>
                                    <input type="text" name="surname" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label>Your Phone Number</label>
                                    <input type="tel" name="phone" required>
                                </div>
                                <div class="form-group">
                                    <label>Your City</label>
                                    <input type="text" name="city" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label>Your Email</label>
                                    <input type="email" name="email" required>
                                </div>
                                <div class="form-group">
                                    <label>Birth Date</label>
                                    <input type="date" name="birth_date" required>
                                </div>
                            </div>
                            <div class="form-section-title">
                                <span>🎓</span>
                                <span>Education Preferences</span>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label>Select Program Type</label>
                                    <select name="program_type" required>
                                        <option value="">Select</option>
                                        <option value="dil-okulu">Language School</option>
                                        <option value="universite">University</option>
                                        <option value="ogretmen-hareketliligi">Teacher Mobility</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Select a Program</label>
                                    <select name="program" required>
                                        <option value="">Select</option>
                                        <option value="ingiltere">United Kingdom</option>
                                        <option value="finlandiya">Finland</option>
                                        <option value="almanya">Germany</option>
                                        <option value="isvicre">Switzerland</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label>Language</label>
                                    <select name="language" required>
                                        <option value="">Select</option>
                                        <option value="kk">Kazakh</option>
                                        <option value="ru">Russian</option>
                                        <option value="en">English</option>
                                        <option value="tr">Turkish</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-section-title">
                                <span>💬</span>
                                <span>Your Message</span>
                            </div>
                            <div class="form-group">
                                <label>Share Details with Us</label>
                                <textarea name="message" required></textarea>
                            </div>
                            <button type="submit" class="submit-button">
                                <span>Get Free Consultancy</span>
                                <span>✈️</span>
                            </button>
                        </form>
                    </div>
                    <div>
                        <div class="form-image">🎓</div>
                    </div>
                </div>
            </div>
        </section>

        <section class="benefits-section">
            <div class="container">
                <div class="benefits-grid">
                    <div class="benefit-card">
                        <div class="benefit-icon">✓</div>
                        <h3 class="benefit-title">100% Free</h3>
                        <p class="benefit-description">Consultancy Service</p>
                    </div>
                    <div class="benefit-card">
                        <div class="benefit-icon">⏱️</div>
                        <h3 class="benefit-title">Within 24 Hours</h3>
                        <p class="benefit-description">Fast Response</p>
                    </div>
                    <div class="benefit-card">
                        <div class="benefit-icon">👥</div>
                        <h3 class="benefit-title">Expert Staff</h3>
                        <p class="benefit-description">Professional Support</p>
                    </div>
                </div>
            </div>
        </section>';
    }

    private function getTurkishContent(): string
    {
        return '<section class="contact-hero">
            <div class="container">
                <div class="hero-breadcrumb">
                    <a href="/">Anasayfa</a> / İletişim
                </div>
                <h1 class="hero-title">İletişim</h1>
                <p class="hero-description">Ücretsiz danışmanlık alın, size en uygun eğitim programını bulalım.</p>
                <div class="hero-buttons">
                    <a href="#form" class="hero-button hero-button-primary">Ücretsiz Danışmanlık</a>
                    <a href="#programs" class="hero-button hero-button-secondary">Programları İncele</a>
                </div>
            </div>
        </section>

        <section class="contact-info-section">
            <div class="container">
                <div class="contact-info-grid">
                    <div class="contact-info-card">
                        <div class="contact-icon">📞</div>
                        <div class="contact-label">Telefon</div>
                        <div class="contact-value">
                            <a href="tel:+77012702361">+7701 270 23 61</a><br>
                            <a href="tel:+77757145309">+7775 714 53 09</a>
                        </div>
                    </div>
                    <div class="contact-info-card">
                        <div class="contact-icon">✉️</div>
                        <div class="contact-label">E-posta</div>
                        <div class="contact-value">
                            <a href="mailto:info@akaegitim.com.tr">info@akaegitim.com.tr</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="form-section" id="form">
            <div class="container">
                <div class="form-container">
                    <div>
                        <h2 class="form-title">Yurt Dışı Eğitim Yolculuğunuza Başlayın</h2>
                        <p class="form-subtitle">Formu doldurun, uzman danışmanlarımız en kısa sürede sizinle iletişime geçsin ve size özel eğitim planınızı oluşturalım</p>
                        <form class="contact-form" action="/iletisim" method="POST">
                            <input type="hidden" name="_token" value="">
                            <div class="form-section-title">
                                <span>👤</span>
                                <span>Kişisel Bilgiler</span>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label>Adınız</label>
                                    <input type="text" name="name" required>
                                </div>
                                <div class="form-group">
                                    <label>Soyadınız</label>
                                    <input type="text" name="surname" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label>Telefon Numaranız</label>
                                    <input type="tel" name="phone" required>
                                </div>
                                <div class="form-group">
                                    <label>Bulunduğunuz Şehir</label>
                                    <input type="text" name="city" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label>E-posta Adresiniz</label>
                                    <input type="email" name="email" required>
                                </div>
                                <div class="form-group">
                                    <label>Doğum Tarihiniz</label>
                                    <input type="date" name="birth_date" required>
                                </div>
                            </div>
                            <div class="form-section-title">
                                <span>🎓</span>
                                <span>Eğitim Tercihleri</span>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label>Program Türünü Seçin</label>
                                    <select name="program_type" required>
                                        <option value="">Seçin</option>
                                        <option value="dil-okulu">Dil Okulu</option>
                                        <option value="universite">Üniversite</option>
                                        <option value="ogretmen-hareketliligi">Öğretmen Hareketliliği</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Bir Program Seçin</label>
                                    <select name="program" required>
                                        <option value="">Seçin</option>
                                        <option value="ingiltere">İngiltere</option>
                                        <option value="finlandiya">Finlandiya</option>
                                        <option value="almanya">Almanya</option>
                                        <option value="isvicre">İsviçre</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label>Dil</label>
                                    <select name="language" required>
                                        <option value="">Seçin</option>
                                        <option value="kk">Kazakça</option>
                                        <option value="ru">Rusça</option>
                                        <option value="en">İngilizce</option>
                                        <option value="tr">Türkçe</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-section-title">
                                <span>💬</span>
                                <span>Mesajınız</span>
                            </div>
                            <div class="form-group">
                                <label>Detayları Bizimle Paylaşın</label>
                                <textarea name="message" required></textarea>
                            </div>
                            <button type="submit" class="submit-button">
                                <span>Ücretsiz Danışmanlık Alın</span>
                                <span>✈️</span>
                            </button>
                        </form>
                    </div>
                    <div>
                        <div class="form-image">🎓</div>
                    </div>
                </div>
            </div>
        </section>

        <section class="benefits-section">
            <div class="container">
                <div class="benefits-grid">
                    <div class="benefit-card">
                        <div class="benefit-icon">✓</div>
                        <h3 class="benefit-title">100% Ücretsiz</h3>
                        <p class="benefit-description">Danışmanlık Hizmeti</p>
                    </div>
                    <div class="benefit-card">
                        <div class="benefit-icon">⏱️</div>
                        <h3 class="benefit-title">24 Saat İçinde</h3>
                        <p class="benefit-description">Hızlı Geri Dönüş</p>
                    </div>
                    <div class="benefit-card">
                        <div class="benefit-icon">👥</div>
                        <h3 class="benefit-title">Uzman Kadro</h3>
                        <p class="benefit-description">Profesyonel Destek</p>
                    </div>
                </div>
            </div>
        </section>';
    }
}
