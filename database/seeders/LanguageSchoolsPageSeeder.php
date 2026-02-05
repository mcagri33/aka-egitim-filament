<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Page;
use App\Models\PageTranslation;
use App\Models\Language;
use Illuminate\Support\Str;

class LanguageSchoolsPageSeeder extends Seeder
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
            ['id' => 2],
            ['is_active' => true]
        );

        $page->update(['is_active' => true]);

        // Kazakh Content
        if ($languages->has('kk')) {
            $this->createTranslation($page, $languages['kk'], [
                'title' => 'Тіл мектептері',
                'slug' => 'dil-okullari',
                'content' => $this->getKazakhContent(),
                'seo_title' => 'Тіл мектептері - AKA Академиясы',
                'seo_description' => 'Ұлыбританияда ағылшын тілін үйреніңіз, мәдениетті тәжірибе етіңіз және British Council бекіткен діл мектептерінде білім алыңыз.',
            ]);
        }

        // Russian Content
        if ($languages->has('ru')) {
            $this->createTranslation($page, $languages['ru'], [
                'title' => 'Языковые школы',
                'slug' => 'dil-okullari',
                'content' => $this->getRussianContent(),
                'seo_title' => 'Языковые школы - AKA Академия',
                'seo_description' => 'Изучайте английский язык в Великобритании, познакомьтесь с культурой и учитесь в языковых школах, аккредитованных British Council.',
            ]);
        }

        // English Content
        if ($languages->has('en')) {
            $this->createTranslation($page, $languages['en'], [
                'title' => 'Language Schools',
                'slug' => 'dil-okullari',
                'content' => $this->getEnglishContent(),
                'seo_title' => 'Language Schools - AKA Academy',
                'seo_description' => 'Learn English in the UK, experience the culture and study at British Council accredited language schools.',
            ]);
        }

        // Turkish Content
        if ($languages->has('tr')) {
            $this->createTranslation($page, $languages['tr'], [
                'title' => 'Dil Okulları',
                'slug' => 'dil-okullari',
                'content' => $this->getTurkishContent(),
                'seo_title' => 'Dil Okulları - AKA Akademi',
                'seo_description' => 'İngiltere\'de İngilizce öğrenin, kültürü yaşayın ve British Council onaylı dil okullarında eğitim alın.',
            ]);
        }

        $this->command->info('Language Schools page created successfully!');
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
        return '<section class="language-schools-hero">
            <div class="container">
                <div class="hero-breadcrumb">
                    <a href="/">Басты бет</a> / Тіл мектептері
                </div>
                <h1 class="hero-title">Ұлыбритания тіл мектебі бағдарламалары</h1>
                <p class="hero-description">Ұлыбританияда ағылшын тілін үйреніңіз, мәдениетімен танысыңыз және British Council бекіткен тіл мектептерінде білім алыңыз.</p>
                <a href="#programs" class="hero-cta">Бағдарламаларды қарап шық</a>
            </div>
        </section>

        <section class="language-intro-section">
            <div class="container">
                <h2 class="language-intro-title">Тіл курстары</h2>
                <div class="language-intro-underline"></div>
                <h3 class="language-intro-subtitle">Тіл мектептері және даму бағдарламалары</h3>
                <h4 class="language-intro-question">Неліктен тіл үйрену тәжірибесі маңызды?</h4>
                <ul class="language-intro-list">
                    <li>Тіл тек аудиторияда емес, нақты өмірде қолдану арқылы меңгеріледі</li>
                    <li>Оқушылар тілді өз ортасында, құрдастарымен қарым-қатынас арқылы тәжірибеде қолданады</li>
                    <li>Бағдарлама тілмен қатар сол елдің мәдениеті мен қалалық ортасын тануға бағытталған</li>
                    <li>Тіл дамуы тәулігіне 24 сағаттық тәжірибе мен өзара әрекетке негізделген</li>
                    <li>Қаланың тарихи және маңызды орындары сол елдің тілі арқылы танылады</li>
                </ul>
                <h4 class="language-intro-heading">Оқу үдерісі:</h4>
                <ul class="language-intro-list">
                    <li>Қазақстаннан барған мұғаліммен басталады</li>
                    <li>Қабылдаушы елдегі кәсіби тіл маманының жетекшілігімен жалғасады</li>
                </ul>
                <h4 class="language-intro-heading">Бағдарлама нәтижесінде оқушы:</h4>
                <ul class="language-intro-list">
                    <li>тіл қолдану қабілетін дамытады</li>
                    <li>өзіне деген сенімін арттырады</li>
                    <li>дүниетанымын кеңейтіп, саналы тұлға ретінде қалыптасады</li>
                </ul>
                <p class="language-intro-note"><strong>AKA-ның басты айырмашылығы</strong> – оқушымен тәулік бойы бірге болып, оқу мен өмірді ұштастыра алатын өз еліміздің мұғалімінің тұрақты жетекшілігі.</p>
            </div>
        </section>

        <section class="why-language-section">
            <div class="container">
                <h2 class="section-title">Неліктен Ұлыбританияда тіл үйрену?</h2>
                <div class="features-grid">
                    <div class="feature-card">
                        <div class="feature-icon">⭐</div>
                        <h3>British Council аккредитацияланған тіл мектептері</h3>
                        <p>Сапалы білім беру стандарттары және халықаралық танымалдылық</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">⭐</div>
                        <h3>Ана тілі ағылшын тілі болатын мұғалімдер</h3>
                        <p>Тәжірибелі және сертификатталған native speaker мұғалімдер</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">⭐</div>
                        <h3>Халықаралық танымалдылық</h3>
                        <p>Ұлыбританияда алынған білім беру сертификаттары әлем бойынша мойындалады</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">⭐</div>
                        <h3>Дайындық бағдарламалары</h3>
                        <p>IELTS, TOEFL және басқа емтихандарға арналған арнайы бағдарламалар</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">⭐</div>
                        <h3>Мәдени іс-шаралар және саяхаттар</h3>
                        <p>Ағылшын мәдениетін жақынан тану мүмкіндіктері</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">⭐</div>
                        <h3>Әртүрлі тұру мүмкіншіліктері</h3>
                        <p>Жатақхана, отбасында тұру және жеке тұру мүмкіншіліктері</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="programs-section" id="programs">
            <div class="container">
                <div class="programs-header">
                    <div>
                        <h2 class="section-title">Діл бағдарламалары</h2>
                        <p class="programs-subtitle">Қажеттілігіңізге сәйкес бағдарламаны таңдаңыз</p>
                    </div>
                </div>
                <div class="program-carousel">
                    <div class="program-card">
                        <div class="program-image-placeholder" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center; color: white; font-size: 64px;">📚</div>
                        <div class="program-content">
                            <h3 class="program-title">Жалпы ағылшын тілі курсы</h3>
                            <div class="program-meta">
                                <span>2-48 апта</span>
                                <span>|</span>
                                <span>£250-400 / апта</span>
                            </div>
                            <p class="program-description">Күнделікті өмірде қолдана алатын ағылшын тілі дағдыларыңызды дамытыңыз. Сөйлеу, тыңдау, оқу және жазу салаларында кең ауқымды білім беру.</p>
                            <a href="#" class="program-link">Толық ақпарат →</a>
                        </div>
                    </div>
                    <div class="program-card">
                        <div class="program-image-placeholder" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); display: flex; align-items: center; justify-content: center; color: white; font-size: 64px;">🎓</div>
                        <div class="program-content">
                            <h3 class="program-title">IELTS дайындығы</h3>
                            <div class="program-meta">
                                <span>4-12 апта</span>
                                <span>|</span>
                                <span>£300-450 / апта</span>
                            </div>
                            <p class="program-description">IELTS емтиханына арналған қарқынды дайындық бағдарламасы. Емтихан әдістері, практикалық тесттер және жеке кері байланыс арқылы мақсатыңызға жетіңіз.</p>
                            <a href="#" class="program-link">Толық ақпарат →</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="requirements-section">
            <div class="container">
                <div class="requirements-grid">
                    <div class="requirement-box">
                        <h3>Өтініш талаптары</h3>
                        <ul class="requirement-list">
                            <li>16 жас және одан жоғары болу</li>
                            <li>Жарамды паспорт</li>
                            <li>Қаржылық жағдай құжаты</li>
                            <li>Діл деңгейі құжаты (міндетті емес)</li>
                            <li>Денсаулық сақтандыру</li>
                            <li>Виза өтініш формасы</li>
                        </ul>
                    </div>
                    <div class="requirement-box">
                        <h3>Өтініш процесі</h3>
                        <ul class="requirement-list">
                            <li>Мектеп және бағдарлама таңдау</li>
                            <li>Өтініш формасын толтыру</li>
                            <li>Қажетті құжаттарды дайындау</li>
                            <li>Қабылдау хатын алу</li>
                            <li>Виза өтініші</li>
                            <li>Тұру орнын реттеу</li>
                            <li>Саяхат және келу</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <section class="faq-section">
            <div class="container">
                <h2 class="section-title">Жиі қойылатын сұрақтар</h2>
                <div class="faq-container">
                    <div>
                        <ul class="faq-list">
                            <li class="faq-item">
                                <div class="faq-question">
                                    <span>Қай діл емтиханын таңдаған жөн?</span>
                                    <span>+</span>
                                </div>
                                <div class="faq-answer">
                                    IELTS және TOEFL ең кең таралған қабылданатын емтихандар. Мақсатыңызға сәйкес (университет, жұмыс, көші-қон) сәйкес емтиханды таңдай аласыз. Кеңесшілеріміз сізге көмектеседі.
                                </div>
                            </li>
                            <li class="faq-item">
                                <div class="faq-question">
                                    <span>Homestay деген не?</span>
                                    <span>+</span>
                                </div>
                                <div class="faq-answer">
                                    Homestay - бұл ағылшын отбасының үйінде тұру мүмкіндігі. Осылайша сіз діл тәжірибесін жинай аласыз және ағылшын мәдениетін жақынан танып біле аласыз.
                                </div>
                            </li>
                            <li class="faq-item">
                                <div class="faq-question">
                                    <span>Виза процесі қанша уақыт алады?</span>
                                    <span>+</span>
                                </div>
                                <div class="faq-answer">
                                    Стандартты виза өтініштері әдетте 3-4 апта ішінде нәтиже береді. Қарқынды кезеңдерде бұл уақыт ұзаруы мүмкін, сондықтан ерте өтініш беруіңізді ұсынамыз.
                                </div>
                            </li>
                            <li class="faq-item">
                                <div class="faq-question">
                                    <span>Апталық сабақ сағаты қанша?</span>
                                    <span>+</span>
                                </div>
                                <div class="faq-answer">
                                    Бағдарламаларға байланысты өзгереді, бірақ әдетте аптасына 15-25 сағат аралығында сабақ беріледі. Қарқынды бағдарламалар үшін көбірек сағат опциялары да қолжетімді.
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <div class="faq-image-placeholder" style="background: linear-gradient(135deg, var(--color-teal), #1a7a73); display: flex; align-items: center; justify-content: center; color: white; font-size: 120px; border-radius: 12px;">🎓</div>
                    </div>
                </div>
            </div>
        </section>

        <section class="cta-section">
            <div class="container">
                <div class="cta-content">
                    <div>
                        <h2 class="cta-title">Ұлыбританияда діл білім беруді <span>бастауға</span> дайынсыз ба?</h2>
                        <p class="cta-description">Біздің маман командамен байланысыңыз және сізге ең қолайлы бағдарламаны бірге анықтайық. Біздің тегін кеңес қызметімізден пайдаланыңыз.</p>
                        <div class="cta-buttons">
                            <a href="/iletisim" class="cta-button cta-button-primary">Тегін кеңес</a>
                            <a href="#programs" class="cta-button cta-button-secondary">Бағдарламаларды қарап шық</a>
                        </div>
                    </div>
                    <div>
                        <div class="cta-image-placeholder" style="background: linear-gradient(135deg, var(--color-burgundy), #7a1a35); display: flex; align-items: center; justify-content: center; color: white; font-size: 120px; border-radius: 12px;">💼</div>
                    </div>
                </div>
            </div>
        </section>';
    }

    private function getRussianContent(): string
    {
        return '<section class="language-schools-hero">
            <div class="container">
                <div class="hero-breadcrumb">
                    <a href="/">Главная</a> / Языковые школы
                </div>
                <h1 class="hero-title">Программы языковых школ Великобритании</h1>
                <p class="hero-description">Изучайте английский язык в Великобритании, познакомьтесь с культурой и учитесь в языковых школах, аккредитованных British Council.</p>
                <a href="#programs" class="hero-cta">Просмотреть программы</a>
            </div>
        </section>

        <section class="language-intro-section">
            <div class="container">
                <h2 class="language-intro-title">Языковые курсы</h2>
                <div class="language-intro-underline"></div>
                <h3 class="language-intro-subtitle">Языковые школы и программы развития</h3>
                <h4 class="language-intro-question">Почему важна практика изучения языка?</h4>
                <ul class="language-intro-list">
                    <li>Язык осваивается не в аудитории, а через использование в реальной жизни</li>
                    <li>Учащиеся используют язык на практике в своей среде, общаясь со сверстниками</li>
                    <li>Программа направлена на знакомство не только с языком, но и с культурой и городской средой этой страны</li>
                    <li>Развитие языка основано на 24-часовом опыте и взаимодействии в день</li>
                    <li>Исторические и важные места города познаются на языке этой страны</li>
                </ul>
                <h4 class="language-intro-heading">Учебный процесс:</h4>
                <ul class="language-intro-list">
                    <li>Начинается с преподавателя, приехавшего из Казахстана</li>
                    <li>Продолжается под руководством профессионального языкового специалиста принимающей страны</li>
                </ul>
                <h4 class="language-intro-heading">В результате программы учащийся:</h4>
                <ul class="language-intro-list">
                    <li>развивает способность использовать язык</li>
                    <li>повышает уверенность в себе</li>
                    <li>расширяет мировоззрение и формируется как сознательная личность</li>
                </ul>
                <p class="language-intro-note"><strong>Главное отличие AKA</strong> – постоянное руководство нашего преподавателя, который может быть со студентом 24 часа в сутки и сочетать учебу и жизнь.</p>
            </div>
        </section>

        <section class="why-language-section">
            <div class="container">
                <h2 class="section-title">Почему языковое образование в Великобритании?</h2>
                <div class="features-grid">
                    <div class="feature-card">
                        <div class="feature-icon">⭐</div>
                        <h3>Аккредитованные British Council языковые школы</h3>
                        <p>Качественные стандарты образования и международное признание</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">⭐</div>
                        <h3>Преподаватели - носители английского языка</h3>
                        <p>Опытные и сертифицированные преподаватели-носители языка</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">⭐</div>
                        <h3>Международное признание</h3>
                        <p>Образовательные сертификаты, полученные в Великобритании, признаются во всем мире</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">⭐</div>
                        <h3>Подготовительные программы</h3>
                        <p>Специальные программы для IELTS, TOEFL и других экзаменов</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">⭐</div>
                        <h3>Культурные мероприятия и экскурсии</h3>
                        <p>Возможности ближе познакомиться с британской культурой</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">⭐</div>
                        <h3>Различные варианты размещения</h3>
                        <p>Общежития, проживание в семье и частное размещение</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="programs-section" id="programs">
            <div class="container">
                <div class="programs-header">
                    <div>
                        <h2 class="section-title">Языковые программы</h2>
                        <p class="programs-subtitle">Выберите программу, подходящую вашим потребностям</p>
                    </div>
                </div>
                <div class="program-carousel">
                    <div class="program-card">
                        <div class="program-image-placeholder" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center; color: white; font-size: 64px;">📚</div>
                        <div class="program-content">
                            <h3 class="program-title">Курс общего английского</h3>
                            <div class="program-meta">
                                <span>2-48 недель</span>
                                <span>|</span>
                                <span>£250-400 / неделя</span>
                            </div>
                            <p class="program-description">Развивайте навыки английского языка, которые вы можете использовать в повседневной жизни. Комплексное обучение в области говорения, аудирования, чтения и письма.</p>
                            <a href="#" class="program-link">Подробнее →</a>
                        </div>
                    </div>
                    <div class="program-card">
                        <div class="program-image-placeholder" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); display: flex; align-items: center; justify-content: center; color: white; font-size: 64px;">🎓</div>
                        <div class="program-content">
                            <h3 class="program-title">Подготовка к IELTS</h3>
                            <div class="program-meta">
                                <span>4-12 недель</span>
                                <span>|</span>
                                <span>£300-450 / неделя</span>
                            </div>
                            <p class="program-description">Интенсивная программа подготовки к экзамену IELTS. Техники экзамена, практические тесты и индивидуальная обратная связь помогут вам достичь цели.</p>
                            <a href="#" class="program-link">Подробнее →</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="requirements-section">
            <div class="container">
                <div class="requirements-grid">
                    <div class="requirement-box">
                        <h3>Требования для заявки</h3>
                        <ul class="requirement-list">
                            <li>Возраст 16 лет и старше</li>
                            <li>Действительный паспорт</li>
                            <li>Документ о финансовом положении</li>
                            <li>Документ об уровне языка (необязательно)</li>
                            <li>Медицинская страховка</li>
                            <li>Форма заявки на визу</li>
                        </ul>
                    </div>
                    <div class="requirement-box">
                        <h3>Процесс подачи заявки</h3>
                        <ul class="requirement-list">
                            <li>Выбор школы и программы</li>
                            <li>Заполнение формы заявки</li>
                            <li>Подготовка необходимых документов</li>
                            <li>Получение письма о зачислении</li>
                            <li>Подача заявки на визу</li>
                            <li>Организация размещения</li>
                            <li>Путешествие и прибытие</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <section class="faq-section">
            <div class="container">
                <h2 class="section-title">Часто задаваемые вопросы</h2>
                <div class="faq-container">
                    <div>
                        <ul class="faq-list">
                            <li class="faq-item">
                                <div class="faq-question">
                                    <span>Какой языковой экзамен выбрать?</span>
                                    <span>+</span>
                                </div>
                                <div class="faq-answer">
                                    IELTS и TOEFL - наиболее широко признанные экзамены. Вы можете выбрать подходящий экзамен в зависимости от вашей цели (университет, работа, иммиграция). Наши консультанты помогут вам.
                                </div>
                            </li>
                            <li class="faq-item">
                                <div class="faq-question">
                                    <span>Что такое Homestay?</span>
                                    <span>+</span>
                                </div>
                                <div class="faq-answer">
                                    Homestay - это вариант проживания в британской семье. Таким образом, вы можете практиковать язык и ближе познакомиться с британской культурой.
                                </div>
                            </li>
                            <li class="faq-item">
                                <div class="faq-question">
                                    <span>Сколько времени занимает процесс получения визы?</span>
                                    <span>+</span>
                                </div>
                                <div class="faq-answer">
                                    Стандартные заявки на визу обычно обрабатываются в течение 3-4 недель. В напряженные периоды это время может увеличиться, поэтому мы рекомендуем подавать заявку заранее.
                                </div>
                            </li>
                            <li class="faq-item">
                                <div class="faq-question">
                                    <span>Сколько часов занятий в неделю?</span>
                                    <span>+</span>
                                </div>
                                <div class="faq-answer">
                                    Варьируется в зависимости от программы, но обычно проводится 15-25 часов занятий в неделю. Для интенсивных программ доступны варианты с большим количеством часов.
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <div class="faq-image-placeholder" style="background: linear-gradient(135deg, var(--color-teal), #1a7a73); display: flex; align-items: center; justify-content: center; color: white; font-size: 120px; border-radius: 12px;">🎓</div>
                    </div>
                </div>
            </div>
        </section>

        <section class="cta-section">
            <div class="container">
                <div class="cta-content">
                    <div>
                        <h2 class="cta-title">Готовы <span>начать</span> языковое образование в Великобритании?</h2>
                        <p class="cta-description">Свяжитесь с нашей экспертной командой и вместе определим наиболее подходящую для вас программу. Воспользуйтесь нашей бесплатной консультацией.</p>
                        <div class="cta-buttons">
                            <a href="/iletisim" class="cta-button cta-button-primary">Бесплатная консультация</a>
                            <a href="#programs" class="cta-button cta-button-secondary">Просмотреть программы</a>
                        </div>
                    </div>
                    <div>
                        <div class="cta-image-placeholder" style="background: linear-gradient(135deg, var(--color-burgundy), #7a1a35); display: flex; align-items: center; justify-content: center; color: white; font-size: 120px; border-radius: 12px;">💼</div>
                    </div>
                </div>
            </div>
        </section>';
    }

    private function getEnglishContent(): string
    {
        return '<section class="language-schools-hero">
            <div class="container">
                <div class="hero-breadcrumb">
                    <a href="/">Home</a> / Language Schools
                </div>
                <h1 class="hero-title">UK Language School Programs</h1>
                <p class="hero-description">Learn English in the UK, experience the culture and study at British Council accredited language schools.</p>
                <a href="#programs" class="hero-cta">Explore Programs</a>
            </div>
        </section>

        <section class="language-intro-section">
            <div class="container">
                <h2 class="language-intro-title">Language Courses</h2>
                <div class="language-intro-underline"></div>
                <h3 class="language-intro-subtitle">Language Schools and Development Programs</h3>
                <h4 class="language-intro-question">Why is language learning experience important?</h4>
                <ul class="language-intro-list">
                    <li>Language is mastered not in the classroom, but through use in real life</li>
                    <li>Students use the language in practice in their environment, communicating with peers</li>
                    <li>The program is aimed at getting to know not only the language but also the culture and urban environment of that country</li>
                    <li>Language development is based on 24-hour experience and interaction per day</li>
                    <li>Historical and important places of the city are learned through the language of that country</li>
                </ul>
                <h4 class="language-intro-heading">Learning Process:</h4>
                <ul class="language-intro-list">
                    <li>Starts with a teacher who came from Kazakhstan</li>
                    <li>Continues under the guidance of a professional language specialist in the host country</li>
                </ul>
                <h4 class="language-intro-heading">As a result of the program, the student:</h4>
                <ul class="language-intro-list">
                    <li>develops language use ability</li>
                    <li>increases self-confidence</li>
                    <li>expands worldview and forms as a conscious personality</li>
                </ul>
                <p class="language-intro-note"><strong>The main difference of AKA</strong> – constant guidance of our teacher who can be with the student 24 hours a day and combine study and life.</p>
            </div>
        </section>

        <section class="why-language-section">
            <div class="container">
                <h2 class="section-title">Why UK Language Education?</h2>
                <div class="features-grid">
                    <div class="feature-card">
                        <div class="feature-icon">⭐</div>
                        <h3>British Council accredited language schools</h3>
                        <p>Quality education standards and international recognition</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">⭐</div>
                        <h3>Native English speaking teachers</h3>
                        <p>Experienced and certified native speaker instructors</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">⭐</div>
                        <h3>International Recognition</h3>
                        <p>Educational certificates obtained in the UK are recognized worldwide</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">⭐</div>
                        <h3>Preparation programs</h3>
                        <p>Special programs for IELTS, TOEFL and other exams</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">⭐</div>
                        <h3>Cultural activities and trips</h3>
                        <p>Opportunities to experience British culture up close</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">⭐</div>
                        <h3>Various accommodation options</h3>
                        <p>Dormitories, homestay and private accommodation facilities</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="programs-section" id="programs">
            <div class="container">
                <div class="programs-header">
                    <div>
                        <h2 class="section-title">Language Programs</h2>
                        <p class="programs-subtitle">Choose the program that suits your needs</p>
                    </div>
                </div>
                <div class="program-carousel">
                    <div class="program-card">
                        <div class="program-image-placeholder" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center; color: white; font-size: 64px;">📚</div>
                        <div class="program-content">
                            <h3 class="program-title">General English Course</h3>
                            <div class="program-meta">
                                <span>2-48 weeks</span>
                                <span>|</span>
                                <span>£250-400 / week</span>
                            </div>
                            <p class="program-description">Develop your English language skills that you can use in daily life. Comprehensive training in speaking, listening, reading and writing.</p>
                            <a href="#" class="program-link">Learn More →</a>
                        </div>
                    </div>
                    <div class="program-card">
                        <div class="program-image-placeholder" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); display: flex; align-items: center; justify-content: center; color: white; font-size: 64px;">🎓</div>
                        <div class="program-content">
                            <h3 class="program-title">IELTS Preparation</h3>
                            <div class="program-meta">
                                <span>4-12 weeks</span>
                                <span>|</span>
                                <span>£300-450 / week</span>
                            </div>
                            <p class="program-description">Intensive preparation program for the IELTS exam. Exam techniques, practice tests and individual feedback to help you reach your goal.</p>
                            <a href="#" class="program-link">Learn More →</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="requirements-section">
            <div class="container">
                <div class="requirements-grid">
                    <div class="requirement-box">
                        <h3>Application Requirements</h3>
                        <ul class="requirement-list">
                            <li>Be 16 years of age or older</li>
                            <li>Valid passport</li>
                            <li>Financial status document</li>
                            <li>Language level document (optional)</li>
                            <li>Health insurance</li>
                            <li>Visa application form</li>
                        </ul>
                    </div>
                    <div class="requirement-box">
                        <h3>Application Process</h3>
                        <ul class="requirement-list">
                            <li>School and program selection</li>
                            <li>Filling out the application form</li>
                            <li>Preparing required documents</li>
                            <li>Receiving acceptance letter</li>
                            <li>Visa application</li>
                            <li>Arranging accommodation</li>
                            <li>Travel and arrival</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <section class="faq-section">
            <div class="container">
                <h2 class="section-title">Frequently Asked Questions</h2>
                <div class="faq-container">
                    <div>
                        <ul class="faq-list">
                            <li class="faq-item">
                                <div class="faq-question">
                                    <span>Which language exam should I choose?</span>
                                    <span>+</span>
                                </div>
                                <div class="faq-answer">
                                    IELTS and TOEFL are the most widely accepted exams. You can choose the appropriate exam depending on your goal (university, work, immigration). Our consultants will help you.
                                </div>
                            </li>
                            <li class="faq-item">
                                <div class="faq-question">
                                    <span>What is Homestay?</span>
                                    <span>+</span>
                                </div>
                                <div class="faq-answer">
                                    Homestay is an option to stay with a British family. This way, you can practice the language and get to know British culture up close.
                                </div>
                            </li>
                            <li class="faq-item">
                                <div class="faq-question">
                                    <span>How long does the visa process take?</span>
                                    <span>+</span>
                                </div>
                                <div class="faq-answer">
                                    Standard visa applications are usually processed within 3-4 weeks. During busy periods, this time may be extended, so we recommend applying early.
                                </div>
                            </li>
                            <li class="faq-item">
                                <div class="faq-question">
                                    <span>How many hours of classes per week?</span>
                                    <span>+</span>
                                </div>
                                <div class="faq-answer">
                                    Varies depending on the program, but typically 15-25 hours of classes are held per week. More hours options are also available for intensive programs.
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <div class="faq-image-placeholder" style="background: linear-gradient(135deg, var(--color-teal), #1a7a73); display: flex; align-items: center; justify-content: center; color: white; font-size: 120px; border-radius: 12px;">🎓</div>
                    </div>
                </div>
            </div>
        </section>

        <section class="cta-section">
            <div class="container">
                <div class="cta-content">
                    <div>
                        <h2 class="cta-title">Ready to <span>Start</span> Your UK Language Education?</h2>
                        <p class="cta-description">Contact our expert team and together we will determine the most suitable program for you. Take advantage of our free consultation service.</p>
                        <div class="cta-buttons">
                            <a href="/iletisim" class="cta-button cta-button-primary">Free Consultation</a>
                            <a href="#programs" class="cta-button cta-button-secondary">Explore Programs</a>
                        </div>
                    </div>
                    <div>
                        <div class="cta-image-placeholder" style="background: linear-gradient(135deg, var(--color-burgundy), #7a1a35); display: flex; align-items: center; justify-content: center; color: white; font-size: 120px; border-radius: 12px;">💼</div>
                    </div>
                </div>
            </div>
        </section>';
    }

    private function getTurkishContent(): string
    {
        return '<section class="language-schools-hero">
            <div class="container">
                <div class="hero-breadcrumb">
                    <a href="/">Anasayfa</a> / Dil Okulları
                </div>
                <h1 class="hero-title">İngiltere Dil Okulu Programları</h1>
                <p class="hero-description">İngiltere\'de İngilizce öğrenin, kültürü yaşayın ve British Council onaylı dil okullarında eğitim alın.</p>
                <a href="#programs" class="hero-cta">Programları İncele</a>
            </div>
        </section>

        <section class="language-intro-section">
            <div class="container">
                <h2 class="language-intro-title">Dil Kursları</h2>
                <div class="language-intro-underline"></div>
                <h3 class="language-intro-subtitle">Dil Okulları ve Gelişim Programları</h3>
                <h4 class="language-intro-question">Neden dil öğrenme deneyimi önemlidir?</h4>
                <ul class="language-intro-list">
                    <li>Dil sadece sınıfta değil, gerçek hayatta kullanım yoluyla öğrenilir</li>
                    <li>Öğrenciler dili kendi ortamlarında, akranlarıyla iletişim kurarak pratikte kullanır</li>
                    <li>Program sadece dil ile değil, o ülkenin kültürü ve kentsel ortamını tanımaya yöneliktir</li>
                    <li>Dil gelişimi günde 24 saatlik deneyim ve karşılıklı etkileşime dayanır</li>
                    <li>Şehrin tarihi ve önemli yerleri o ülkenin dili aracılığıyla tanınır</li>
                </ul>
                <h4 class="language-intro-heading">Eğitim Süreci:</h4>
                <ul class="language-intro-list">
                    <li>Kazakistan\'dan gelen öğretmenle başlar</li>
                    <li>Ev sahibi ülkedeki profesyonel dil uzmanının rehberliğinde devam eder</li>
                </ul>
                <h4 class="language-intro-heading">Program sonucunda öğrenci:</h4>
                <ul class="language-intro-list">
                    <li>dil kullanma yeteneğini geliştirir</li>
                    <li>kendine güvenini artırır</li>
                    <li>dünya görüşünü genişletir ve bilinçli kişilik olarak şekillenir</li>
                </ul>
                <p class="language-intro-note"><strong>AKA\'nın ana farkı</strong> – öğrenciyle gün boyu birlikte olup, eğitim ve yaşamı birleştirebilen kendi ülkemizin öğretmeninin sürekli rehberliğidir.</p>
            </div>
        </section>

        <section class="why-language-section">
            <div class="container">
                <h2 class="section-title">Neden İngiltere Dil Eğitimi?</h2>
                <div class="features-grid">
                    <div class="feature-card">
                        <div class="feature-icon">⭐</div>
                        <h3>British Council akreditasyonlu dil okulları</h3>
                        <p>Kaliteli eğitim standartları ve uluslararası tanınırlık</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">⭐</div>
                        <h3>Anadili İngilizce olan öğretmenler</h3>
                        <p>Deneyimli ve sertifikalı native speaker eğitmenler</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">⭐</div>
                        <h3>Uluslararası tanınırlık</h3>
                        <p>İngiltere\'de alınan eğitim sertifikaları dünya çapında tanınır</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">⭐</div>
                        <h3>Hazırlık programları</h3>
                        <p>IELTS, TOEFL ve diğer sınavlara yönelik özel programlar</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">⭐</div>
                        <h3>Kültürel aktiviteler ve geziler</h3>
                        <p>İngiliz kültürünü yakından tanıma fırsatları</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">⭐</div>
                        <h3>Çeşitli konaklama seçenekleri</h3>
                        <p>Yurt, aile yanı ve özel konaklama imkanları</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="programs-section" id="programs">
            <div class="container">
                <div class="programs-header">
                    <div>
                        <h2 class="section-title">Dil Programları</h2>
                        <p class="programs-subtitle">İhtiyacınıza uygun programı seçin</p>
                    </div>
                </div>
                <div class="program-carousel">
                    <div class="program-card">
                        <div class="program-image-placeholder" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center; color: white; font-size: 64px;">📚</div>
                        <div class="program-content">
                            <h3 class="program-title">Genel İngilizce Kursu</h3>
                            <div class="program-meta">
                                <span>2-48 hafta</span>
                                <span>|</span>
                                <span>£250-400 / hafta</span>
                            </div>
                            <p class="program-description">Günlük hayatta kullanabileceğiniz İngilizce becerilerinizi geliştirin. Konuşma, dinleme, okuma ve yazma alanlarında kapsamlı eğitim.</p>
                            <a href="#" class="program-link">Detaylı Bilgi →</a>
                        </div>
                    </div>
                    <div class="program-card">
                        <div class="program-image-placeholder" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); display: flex; align-items: center; justify-content: center; color: white; font-size: 64px;">🎓</div>
                        <div class="program-content">
                            <h3 class="program-title">IELTS Hazırlık</h3>
                            <div class="program-meta">
                                <span>4-12 hafta</span>
                                <span>|</span>
                                <span>£300-450 / hafta</span>
                            </div>
                            <p class="program-description">IELTS sınavına yönelik yoğun hazırlık programı. Sınav teknikleri, pratik testler ve bireysel geri bildirim ile hedefinize ulaşın.</p>
                            <a href="#" class="program-link">Detaylı Bilgi →</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="requirements-section">
            <div class="container">
                <div class="requirements-grid">
                    <div class="requirement-box">
                        <h3>Başvuru Gereksinimleri</h3>
                        <ul class="requirement-list">
                            <li>16 yaş ve üzeri olmak</li>
                            <li>Geçerli pasaport</li>
                            <li>Mali durum belgesi</li>
                            <li>Dil seviyesi belgesi (opsiyonel)</li>
                            <li>Sağlık sigortası</li>
                            <li>Vize başvuru formu</li>
                        </ul>
                    </div>
                    <div class="requirement-box">
                        <h3>Başvuru Süreci</h3>
                        <ul class="requirement-list">
                            <li>Okul ve program seçimi</li>
                            <li>Başvuru formu doldurma</li>
                            <li>Gerekli belgelerin hazırlanması</li>
                            <li>Kabul mektubu alma</li>
                            <li>Vize başvurusu</li>
                            <li>Konaklama ayarlama</li>
                            <li>Seyahat ve varış</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <section class="faq-section">
            <div class="container">
                <h2 class="section-title">Sıkça Sorulan Sorular</h2>
                <div class="faq-container">
                    <div>
                        <ul class="faq-list">
                            <li class="faq-item">
                                <div class="faq-question">
                                    <span>Hangi dil sınavını tercih etmeliyim?</span>
                                    <span>+</span>
                                </div>
                                <div class="faq-answer">
                                    IELTS ve TOEFL en yaygın kabul edilen sınavlardır. Hedefinize göre (üniversite, iş, göçmenlik) uygun sınavı seçebilirsiniz. Danışmanlarımız size yardımcı olacaktır.
                                </div>
                            </li>
                            <li class="faq-item">
                                <div class="faq-question">
                                    <span>Homestay nedir?</span>
                                    <span>+</span>
                                </div>
                                <div class="faq-answer">
                                    Homestay, bir İngiliz ailesinin yanında konaklama seçeneğidir. Bu sayede hem dil pratiği yapabilir hem de İngiliz kültürünü yakından tanıyabilirsiniz.
                                </div>
                            </li>
                            <li class="faq-item">
                                <div class="faq-question">
                                    <span>Vize süreci ne kadar sürer?</span>
                                    <span>+</span>
                                </div>
                                <div class="faq-answer">
                                    Standart vize başvuruları genellikle 3-4 hafta içinde sonuçlanır. Yoğun dönemlerde bu süre uzayabilir, bu yüzden erken başvuru yapmanızı öneririz.
                                </div>
                            </li>
                            <li class="faq-item">
                                <div class="faq-question">
                                    <span>Haftalık ders saati ne kadar?</span>
                                    <span>+</span>
                                </div>
                                <div class="faq-answer">
                                    Programlara göre değişmekle birlikte, genellikle haftada 15-25 saat arası ders verilmektedir. Yoğun programlar için daha fazla saat seçenekleri de mevcuttur.
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <div class="faq-image-placeholder" style="background: linear-gradient(135deg, var(--color-teal), #1a7a73); display: flex; align-items: center; justify-content: center; color: white; font-size: 120px; border-radius: 12px;">🎓</div>
                    </div>
                </div>
            </div>
        </section>

        <section class="cta-section">
            <div class="container">
                <div class="cta-content">
                    <div>
                        <h2 class="cta-title">İngiltere Dil Eğitimine <span>Başlamaya</span> Hazır Mısınız?</h2>
                        <p class="cta-description">Uzman ekibimizle iletişime geçin ve size en uygun programı birlikte belirleyelim. Ücretsiz danışmanlık hizmetimizden yararlanın.</p>
                        <div class="cta-buttons">
                            <a href="/iletisim" class="cta-button cta-button-primary">Ücretsiz Danışmanlık</a>
                            <a href="#programs" class="cta-button cta-button-secondary">Programları İncele</a>
                        </div>
                    </div>
                    <div>
                        <div class="cta-image-placeholder" style="background: linear-gradient(135deg, var(--color-burgundy), #7a1a35); display: flex; align-items: center; justify-content: center; color: white; font-size: 120px; border-radius: 12px;">💼</div>
                    </div>
                </div>
            </div>
        </section>';
    }
}
