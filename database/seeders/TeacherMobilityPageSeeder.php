<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Page;
use App\Models\PageTranslation;
use App\Models\Language;
use Illuminate\Support\Str;

class TeacherMobilityPageSeeder extends Seeder
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
            ['id' => 4],
            ['is_active' => true]
        );

        $page->update(['is_active' => true]);

        // Kazakh Content
        if ($languages->has('kk')) {
            $this->createTranslation($page, $languages['kk'], [
                'title' => 'Мұғалім қозғалысы',
                'slug' => 'ogretmen-hareketliligi',
                'content' => $this->getKazakhContent(),
                'seo_title' => 'Мұғалім қозғалысы - AKA Академиясы',
                'seo_description' => 'Шетелде мұғалім дайындығы және кәсіби даму мүмкіндіктері',
            ]);
        }

        // Russian Content
        if ($languages->has('ru')) {
            $this->createTranslation($page, $languages['ru'], [
                'title' => 'Мобильность учителей',
                'slug' => 'ogretmen-hareketliligi',
                'content' => $this->getRussianContent(),
                'seo_title' => 'Мобильность учителей - AKA Академия',
                'seo_description' => 'Возможности подготовки учителей и профессионального развития за рубежом',
            ]);
        }

        // English Content
        if ($languages->has('en')) {
            $this->createTranslation($page, $languages['en'], [
                'title' => 'Teacher Mobility',
                'slug' => 'ogretmen-hareketliligi',
                'content' => $this->getEnglishContent(),
                'seo_title' => 'Teacher Mobility - AKA Academy',
                'seo_description' => 'Overseas teacher training and professional development opportunities',
            ]);
        }

        // Turkish Content
        if ($languages->has('tr')) {
            $this->createTranslation($page, $languages['tr'], [
                'title' => 'Öğretmen Hareketliliği',
                'slug' => 'ogretmen-hareketliligi',
                'content' => $this->getTurkishContent(),
                'seo_title' => 'Öğretmen Hareketliliği - AKA Akademi',
                'seo_description' => 'Yurtdışında öğretmen eğitimi ve mesleki gelişim fırsatları',
            ]);
        }

        $this->command->info('Teacher Mobility page created successfully!');
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
        return '<section class="teacher-mobility-hero">
            <div class="container">
                <div class="hero-breadcrumb">
                    <a href="/">Басты бет</a> / Мұғалім қозғалысы
                </div>
                <h1 class="hero-title">Мұғалім қозғалысы</h1>
                <p class="hero-description">Шетелде мұғалім дайындығы және кәсіби даму мүмкіндіктері. CELTA, DELTA, TESOL сертификаттары және Erasmus+ бағдарламалары арқылы мансабыңызды халықаралық деңгейде дамытыңыз.</p>
            </div>
        </section>

        <section class="countries-section">
            <div class="container">
                <div class="countries-grid">
                    <div class="country-card">
                        <div class="country-image">🇫🇮</div>
                        <div class="country-content">
                            <h3 class="country-title">Финляндия</h3>
                            <p class="country-description">Финляндияда ағылшын тілін үйрену - бұл скандинавиялық өмір салтын тәжірибе ету және әлемнің ең жақсы білім беру жүйесін жақынан тану мүмкіндігі.</p>
                            <a href="#" class="country-button">Толық ақпарат →</a>
                        </div>
                    </div>
                    <div class="country-card">
                        <div class="country-image">🇨🇭</div>
                        <div class="country-content">
                            <h3 class="country-title">Швейцария</h3>
                            <p class="country-description">Швейцарияда мұғалім дайындығы алу - бұл көптілді ортада кәсіби дамуды қамтамасыз ету және халықаралық стандарттағы сертификаттық бағдарламаларға қатысу мүмкіндігі.</p>
                            <a href="#" class="country-button">Толық ақпарат →</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="what-is-section">
            <div class="container">
                <h2 class="what-is-title">Мұғалім қозғалысы деген не?</h2>
                <p class="what-is-intro">Мұғалім қозғалысы бағдарламалары - бұл білім берушілердің шетелде білім беру әдістерін үйренуі, сертификат алуы және кәсіби дамуын жалғастыруы үшін жасалған бағдарламалар. AKA Білім беру ретінде біз мұғалімдердің мансаптарын халықаралық деңгейде дамытуына көмектесеміз.</p>
                <ul class="what-is-steps">
                    <li class="what-is-step">
                        <div class="step-number">1</div>
                        <p class="step-text">CELTA, DELTA, TESOL сияқты халықаралық мұғалімдік сертификаттарға өтініш көмегі.</p>
                    </li>
                    <li class="what-is-step">
                        <div class="step-number">2</div>
                        <p class="step-text">Еуропа Одағы Erasmus+ мұғалім қозғалысы бағдарламаларына өтініш кеңесі.</p>
                    </li>
                    <li class="what-is-step">
                        <div class="step-number">3</div>
                        <p class="step-text">Шетелде мұғалім дайындығы және кәсіби даму курстары бойынша кеңес.</p>
                    </li>
                    <li class="what-is-step">
                        <div class="step-number">4</div>
                        <p class="step-text">Шет тілін оқыту әдістері және сертификаттық бағдарламалар туралы ақпарат.</p>
                    </li>
                    <li class="what-is-step">
                        <div class="step-number">5</div>
                        <p class="step-text">Бағдарламадан кейін жұмыс табу және мансап жоспарлау көмегі.</p>
                    </li>
                </ul>
            </div>
        </section>

        <section class="form-section">
            <div class="container">
                <div class="form-container">
                    <div>
                        <h2 class="form-title">Шетелде білім беру саяхатыңызды бастаңыз</h2>
                        <p class="form-subtitle">Форманы толтырыңыз, біздің маман кеңесшілеріміз мүмкіндігінше тезірек сізбен байланысып, сізге арнайы білім беру жоспарыңызды құрайды</p>
                        <form class="contact-form" action="/iletisim" method="POST">
                            <input type="hidden" name="_token" value="">
                            <div class="form-section-title">Жеке ақпарат</div>
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
                                    <label>Электрондық поштаңыз</label>
                                    <input type="email" name="email" required>
                                </div>
                                <div class="form-group">
                                    <label>Телефон нөміріңіз</label>
                                    <input type="tel" name="phone" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label>Туған күніңіз</label>
                                    <input type="date" name="birth_date" required>
                                </div>
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
                            <div class="form-section-title">Білім беру таңдаулары</div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label>Бағдарлама түрін таңдаңыз</label>
                                    <select name="program_type" required>
                                        <option value="">Таңдаңыз</option>
                                        <option value="celta">CELTA</option>
                                        <option value="delta">DELTA</option>
                                        <option value="tesol">TESOL</option>
                                        <option value="erasmus">Erasmus+</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-section-title">Хабарламаңыз</div>
                            <div class="form-group">
                                <label>Толық ақпаратты бізбен бөлісіңіз</label>
                                <textarea name="message" required></textarea>
                            </div>
                            <button type="submit" class="submit-button">
                                <span>Тегін кеңес алыңыз</span>
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
        return '<section class="teacher-mobility-hero">
            <div class="container">
                <div class="hero-breadcrumb">
                    <a href="/">Главная</a> / Мобильность учителей
                </div>
                <h1 class="hero-title">Мобильность учителей</h1>
                <p class="hero-description">Возможности подготовки учителей и профессионального развития за рубежом. Развивайте свою карьеру на международном уровне с сертификатами CELTA, DELTA, TESOL и программами Erasmus+.</p>
            </div>
        </section>

        <section class="countries-section">
            <div class="container">
                <div class="countries-grid">
                    <div class="country-card">
                        <div class="country-image">🇫🇮</div>
                        <div class="country-content">
                            <h3 class="country-title">Финляндия</h3>
                            <p class="country-description">Изучение английского языка в Финляндии - это возможность познакомиться со скандинавским образом жизни и узнать лучшую систему образования в мире.</p>
                            <a href="#" class="country-button">Подробнее →</a>
                        </div>
                    </div>
                    <div class="country-card">
                        <div class="country-image">🇨🇭</div>
                        <div class="country-content">
                            <h3 class="country-title">Швейцария</h3>
                            <p class="country-description">Получение педагогического образования в Швейцарии - это возможность обеспечить профессиональное развитие в многоязычной среде и принять участие в сертификационных программах международного стандарта.</p>
                            <a href="#" class="country-button">Подробнее →</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="what-is-section">
            <div class="container">
                <h2 class="what-is-title">Что такое мобильность учителей?</h2>
                <p class="what-is-intro">Программы мобильности учителей - это программы, разработанные для того, чтобы педагоги могли изучать методики обучения за рубежом, получать сертификаты и продолжать свое профессиональное развитие. Как AKA Образование, мы поддерживаем учителей в развитии их карьеры на международном уровне.</p>
                <ul class="what-is-steps">
                    <li class="what-is-step">
                        <div class="step-number">1</div>
                        <p class="step-text">Поддержка заявок на международные педагогические сертификаты, такие как CELTA, DELTA, TESOL.</p>
                    </li>
                    <li class="what-is-step">
                        <div class="step-number">2</div>
                        <p class="step-text">Руководство по подаче заявок на программы мобильности учителей Erasmus+ Европейского Союза.</p>
                    </li>
                    <li class="what-is-step">
                        <div class="step-number">3</div>
                        <p class="step-text">Консультации по курсам подготовки учителей и профессионального развития за рубежом.</p>
                    </li>
                    <li class="what-is-step">
                        <div class="step-number">4</div>
                        <p class="step-text">Информация о методологиях преподавания иностранных языков и сертификационных программах.</p>
                    </li>
                    <li class="what-is-step">
                        <div class="step-number">5</div>
                        <p class="step-text">Поддержка в поиске работы и планировании карьеры после программы.</p>
                    </li>
                </ul>
            </div>
        </section>

        <section class="form-section">
            <div class="container">
                <div class="form-container">
                    <div>
                        <h2 class="form-title">Начните свое путешествие в образовании за рубежом</h2>
                        <p class="form-subtitle">Заполните форму, и наши эксперты-консультанты свяжутся с вами как можно скорее, чтобы создать ваш индивидуальный план обучения</p>
                        <form class="contact-form" action="/iletisim" method="POST">
                            <input type="hidden" name="_token" value="">
                            <div class="form-section-title">Личная информация</div>
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
                                    <label>Ваш email</label>
                                    <input type="email" name="email" required>
                                </div>
                                <div class="form-group">
                                    <label>Ваш номер телефона</label>
                                    <input type="tel" name="phone" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label>Дата рождения</label>
                                    <input type="date" name="birth_date" required>
                                </div>
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
                            <div class="form-section-title">Образовательные предпочтения</div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label>Выберите тип программы</label>
                                    <select name="program_type" required>
                                        <option value="">Выберите</option>
                                        <option value="celta">CELTA</option>
                                        <option value="delta">DELTA</option>
                                        <option value="tesol">TESOL</option>
                                        <option value="erasmus">Erasmus+</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-section-title">Ваше сообщение</div>
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
        return '<section class="teacher-mobility-hero">
            <div class="container">
                <div class="hero-breadcrumb">
                    <a href="/">Home</a> / Teacher Mobility
                </div>
                <h1 class="hero-title">Teacher Mobility</h1>
                <p class="hero-description">Overseas teacher training and professional development opportunities. Develop your career on an international platform with CELTA, DELTA, TESOL certificates and Erasmus+ programs.</p>
            </div>
        </section>

        <section class="countries-section">
            <div class="container">
                <div class="countries-grid">
                    <div class="country-card">
                        <div class="country-image">🇫🇮</div>
                        <div class="country-content">
                            <h3 class="country-title">Finland</h3>
                            <p class="country-description">Learning English in Finland is an opportunity to experience the Scandinavian lifestyle and get to know the world\'s best education system up close.</p>
                            <a href="#" class="country-button">Learn More →</a>
                        </div>
                    </div>
                    <div class="country-card">
                        <div class="country-image">🇨🇭</div>
                        <div class="country-content">
                            <h3 class="country-title">Switzerland</h3>
                            <p class="country-description">Receiving teacher training in Switzerland is an opportunity to ensure professional development in a multilingual environment and participate in international standard certificate programs.</p>
                            <a href="#" class="country-button">Learn More →</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="what-is-section">
            <div class="container">
                <h2 class="what-is-title">What is Teacher Mobility?</h2>
                <p class="what-is-intro">Teacher mobility programs are designed for educators to learn education methodologies abroad, obtain certificates, and continue their professional development. As AKA Education, we support teachers in developing their careers on an international platform.</p>
                <ul class="what-is-steps">
                    <li class="what-is-step">
                        <div class="step-number">1</div>
                        <p class="step-text">Application support for international teaching certificates like CELTA, DELTA, TESOL.</p>
                    </li>
                    <li class="what-is-step">
                        <div class="step-number">2</div>
                        <p class="step-text">Application guidance for European Union Erasmus+ teacher mobility programs.</p>
                    </li>
                    <li class="what-is-step">
                        <div class="step-number">3</div>
                        <p class="step-text">Consultancy for overseas teacher training and professional development courses.</p>
                    </li>
                    <li class="what-is-step">
                        <div class="step-number">4</div>
                        <p class="step-text">Information about foreign language teaching methodologies and certificate programs.</p>
                    </li>
                    <li class="what-is-step">
                        <div class="step-number">5</div>
                        <p class="step-text">Job placement and career planning support after the program.</p>
                    </li>
                </ul>
            </div>
        </section>

        <section class="form-section">
            <div class="container">
                <div class="form-container">
                    <div>
                        <h2 class="form-title">Start Your Overseas Education Journey</h2>
                        <p class="form-subtitle">Fill out the form, and our expert consultants will contact you as soon as possible to create your special education plan</p>
                        <form class="contact-form" action="/iletisim" method="POST">
                            <input type="hidden" name="_token" value="">
                            <div class="form-section-title">Personal Information</div>
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
                                    <label>Your Email</label>
                                    <input type="email" name="email" required>
                                </div>
                                <div class="form-group">
                                    <label>Your Phone Number</label>
                                    <input type="tel" name="phone" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label>Birth Date</label>
                                    <input type="date" name="birth_date" required>
                                </div>
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
                            <div class="form-section-title">Education Preferences</div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label>Select Program Type</label>
                                    <select name="program_type" required>
                                        <option value="">Select</option>
                                        <option value="celta">CELTA</option>
                                        <option value="delta">DELTA</option>
                                        <option value="tesol">TESOL</option>
                                        <option value="erasmus">Erasmus+</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-section-title">Your Message</div>
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
        return '<section class="teacher-mobility-hero">
            <div class="container">
                <div class="hero-breadcrumb">
                    <a href="/">Anasayfa</a> / Öğretmen Hareketliliği
                </div>
                <h1 class="hero-title">Öğretmen Hareketliliği</h1>
                <p class="hero-description">Yurtdışında öğretmen eğitimi ve mesleki gelişim fırsatları. CELTA, DELTA, TESOL sertifikaları ve Erasmus+ programları ile kariyerinizi uluslararası platformda geliştirin.</p>
            </div>
        </section>

        <section class="countries-section">
            <div class="container">
                <div class="countries-grid">
                    <div class="country-card">
                        <div class="country-image">🇫🇮</div>
                        <div class="country-content">
                            <h3 class="country-title">Finlandiya</h3>
                            <p class="country-description">Finlandiya\'da İngilizce öğrenmek, İskandinav yaşam tarzını deneyimleme ve dünya\'nın en iyi eğitim sistemini yakından tanıma fırsatıdır.</p>
                            <a href="#" class="country-button">Detaylı Bilgi →</a>
                        </div>
                    </div>
                    <div class="country-card">
                        <div class="country-image">🇨🇭</div>
                        <div class="country-content">
                            <h3 class="country-title">İsviçre</h3>
                            <p class="country-description">İsviçre\'de öğretmen eğitimi almak, çok dilli bir ortamda profesyonel gelişim sağlama ve uluslararası standartlarda sertifika programlarına katılma fırsatıdır.</p>
                            <a href="#" class="country-button">Detaylı Bilgi →</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="what-is-section">
            <div class="container">
                <h2 class="what-is-title">Öğretmen Hareketliliği Nedir?</h2>
                <p class="what-is-intro">Öğretmen hareketliliği programları, eğitimcilerin yurtdışında eğitim metodolojileri öğrenmesi, sertifika alması ve profesyonel gelişimini sürdürmesi için tasarlanmış programlardır. Aka Eğitim olarak, öğretmenlerin kariyerlerini uluslararası platformda geliştirmelerine destek oluyoruz.</p>
                <ul class="what-is-steps">
                    <li class="what-is-step">
                        <div class="step-number">1</div>
                        <p class="step-text">CELTA, DELTA, TESOL gibi uluslararası öğretmenlik sertifikaları için başvuru desteği.</p>
                    </li>
                    <li class="what-is-step">
                        <div class="step-number">2</div>
                        <p class="step-text">Avrupa Birliği Erasmus+ öğretmen hareketliliği programlarına başvuru rehberliği.</p>
                    </li>
                    <li class="what-is-step">
                        <div class="step-number">3</div>
                        <p class="step-text">Yurtdışında öğretmen eğitimi ve mesleki gelişim kursları için danışmanlık.</p>
                    </li>
                    <li class="what-is-step">
                        <div class="step-number">4</div>
                        <p class="step-text">Yabancı dil öğretimi metodolojileri ve sertifika programları hakkında bilgilendirme.</p>
                    </li>
                    <li class="what-is-step">
                        <div class="step-number">5</div>
                        <p class="step-text">Program sonrası iş bulma ve kariyer planlama desteği.</p>
                    </li>
                </ul>
            </div>
        </section>

        <section class="form-section">
            <div class="container">
                <div class="form-container">
                    <div>
                        <h2 class="form-title">Yurt Dışı Eğitim Yolculuğunuza Başlayın</h2>
                        <p class="form-subtitle">Formu doldurun, uzman danışmanlarımız en kısa sürede sizinle iletişime geçsin ve size özel eğitim planınızı oluşturalım</p>
                        <form class="contact-form" action="/iletisim" method="POST">
                            <input type="hidden" name="_token" value="">
                            <div class="form-section-title">Kişisel Bilgiler</div>
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
                                    <label>E-posta Adresiniz</label>
                                    <input type="email" name="email" required>
                                </div>
                                <div class="form-group">
                                    <label>Telefon Numaranız</label>
                                    <input type="tel" name="phone" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label>Doğum Tarihiniz</label>
                                    <input type="date" name="birth_date" required>
                                </div>
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
                            <div class="form-section-title">Eğitim Tercihleri</div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label>Program Türünü Seçin</label>
                                    <select name="program_type" required>
                                        <option value="">Seçin</option>
                                        <option value="celta">CELTA</option>
                                        <option value="delta">DELTA</option>
                                        <option value="tesol">TESOL</option>
                                        <option value="erasmus">Erasmus+</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-section-title">Mesajınız</div>
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
