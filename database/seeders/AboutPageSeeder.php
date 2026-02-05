<?php

namespace Database\Seeders;

use App\Models\Language;
use App\Models\Page;
use App\Models\PageTranslation;
use Illuminate\Database\Seeder;

class AboutPageSeeder extends Seeder
{
    public function run(): void
    {
        $kazakh = Language::where('code', 'kk')->first();
        $russian = Language::where('code', 'ru')->first();
        $english = Language::where('code', 'en')->first();
        $turkish = Language::where('code', 'tr')->first();

        if (!$kazakh || !$russian || !$english || !$turkish) {
            $this->command->error('Languages not found. Please run HomepageContentSeeder first.');
            return;
        }

        // Hakkımızda sayfasını oluştur
        $aboutPage = Page::updateOrCreate(
            ['id' => 1],
            ['is_active' => true]
        );

        // Kazakça içerik
        PageTranslation::updateOrCreate(
            [
                'page_id' => $aboutPage->id,
                'language_id' => $kazakh->id,
            ],
            [
                'title' => 'Біз туралы',
                'slug' => 'biz-turaly',
                'seo_title' => 'Біз туралы - AKA Айхан Қорқмаз Академиясы',
                'seo_description' => 'AKA – Айхан Қорқмаз Академиясы – педагогтер бастамасымен құрылған, халықаралық білім беру қызметін оқытушы жетекшілігімен жүзеге асыратын ұйым.',
                'content' => $this->getKazakhContent(),
            ]
        );

        // Rusça içerik
        PageTranslation::updateOrCreate(
            [
                'page_id' => $aboutPage->id,
                'language_id' => $russian->id,
            ],
            [
                'title' => 'О нас',
                'slug' => 'o-nas',
                'seo_title' => 'О нас - AKA Академия Айхан Коркмаз',
                'seo_description' => 'AKA – Академия Айхан Коркмаз – организация, созданная по инициативе педагогов, осуществляющая международные образовательные услуги под руководством преподавателей.',
                'content' => $this->getRussianContent(),
            ]
        );

        // İngilizce içerik
        PageTranslation::updateOrCreate(
            [
                'page_id' => $aboutPage->id,
                'language_id' => $english->id,
            ],
            [
                'title' => 'About Us',
                'slug' => 'about-us',
                'seo_title' => 'About Us - AKA Ayhan Korkmaz Academy',
                'seo_description' => 'AKA – Ayhan Korkmaz Academy – an organization established by teacher initiative, providing international education services under teacher guidance.',
                'content' => $this->getEnglishContent(),
            ]
        );

        // Türkçe içerik
        PageTranslation::updateOrCreate(
            [
                'page_id' => $aboutPage->id,
                'language_id' => $turkish->id,
            ],
            [
                'title' => 'Hakkımızda',
                'slug' => 'hakkimizda',
                'seo_title' => 'Hakkımızda - AKA Ayhan Korkmaz Akademisi',
                'seo_description' => 'AKA – Ayhan Korkmaz Akademisi – öğretmen inisiyatifiyle kurulmuş, öğretmen rehberliğinde uluslararası eğitim hizmetleri sunan organizasyon.',
                'content' => $this->getTurkishContent(),
            ]
        );

        $this->command->info('About page created successfully!');
    }

    private function getKazakhContent(): string
    {
        return '<section class="hero-section">
            <div class="container">
                <h2>"Елдің болашағы туралы сөз қозғалғанда, негізгі тірек – білім."</h2>
                <p>Бізбен бірге дамуға дайынсыз ба?Бірге өсеміз.</p>
                <p>Түркияның әртүрлі қалаларында орналасқан кеңселеріміз бен тәжірибелі өкілдеріміз сіздерге ең сапалы қызмет көрсетуге дайын. Картадан қала атауларын басу арқылы өкілдеріміз туралы ақпаратты көре аласыз.</p>
                <div class="world-map-placeholder"></div>
            </div>
        </section>

        <section class="about-section">
            <h2>AKA – Айхан Қорқмаз Академиясы</h2>
            <h3>Бағдарлама туралы</h3>
            <p>AKA – Айхан Қорқмаз Академиясы – педагогтер бастамасымен құрылған, халықаралық білім беру қызметін оқытушы жетекшілігімен жүзеге асыратын ұйым.</p>
            <p>Академия қызметі «Елдің болашағы – білімде» қағидасына негізделген және студенттер мен оқытушылардың шетелде білім алу, тәжірибе жинақтау үдерістерін жүйелі түрде ұйымдастыруға бағытталған.</p>
        </section>

        <section class="mission-section">
            <h2>Біздің миссиямыз</h2>
            <p>AKA Академиясының миссиясы – шетелде білім алатын жастар мен педагогтердің академиялық, кәсіби және тұлғалық дамуын қамтамасыз ете отырып, саналы, жауапты және қоғамға қызмет етуге дайын тұлға қалыптастыру.</p>
        </section>

        <section class="concept-section">
            <h2>Қызметтің тұжырымдамалық негізі</h2>
            <p>AKA Академиясы қазақтың көрнекті мемлекет және қоғам қайраткері Әлихан Бөкейханның «Халыққа қызмет ету – мінезден» деген стратегиялық көзқарасына сүйенеді.</p>
            <p>Осы қағидаға сәйкес Академия қызметі оқытушының жетекшілігімен үздіксіз әрі сапалы білім беру арқылы қоғамға қызмет ететін мамандар даярлауға септігін тигізеді.</p>
        </section>

        <section class="difference-section">
            <h2>AKA Айырмашылығы</h2>
            
            <div class="highlight-box">
                <h3>Мұғалім жетекшілігі</h3>
                <p>Білім беру үдерісі менеджерлік қызмет ретінде емес, мұғалімнің жетекшілігімен жүзеге асатын педагогикалық процесс ретінде ұйымдастырылады. Әрбір студентке академиялық бағыт-бағдар беретін кәсіби педагог бекітіледі.</p>
            </div>

            <div class="highlight-box">
                <h3>Мінез-құлық пен қабілет ерекшеліктеріне негізделген бағдарлау</h3>
                <p>Студент тек құжаттар жиынтығы ретінде емес, тұлға ретінде қарастырылады. Оның мінезі, қызығушылығы, әлеуеті мен қабілеттері шетелге шықпай тұрып жан-жақты талданады.</p>
            </div>

            <div class="highlight-box">
                <h3>Университеттерді алдын ала іріктеу және тексеру</h3>
                <p>AKA серіктес университеттері алдын ала зерттеліп, аккредитациясы, дипломының мойындалуы және білім беру сапасы тексерілген оқу орындарынан құралады.</p>
            </div>

            <div class="highlight-box">
                <h3>Толық сүйемелдеу жүйесі</h3>
                <p>Студентке үйден әуежайға, қабылдау және тіркеу кеңсесінен оқу орнына дейін мұғалімнің қатысуымен үздіксіз қолдау көрсетіледі. Құжаттандыру, виза, тіркеу және тұру үдерістері толық бақылауда болады.</p>
            </div>

            <div class="highlight-box">
                <h3>Елге оралуға бағытталған көзқарас</h3>
                <p>AKA үшін басты мақсат – студентті тек шетелге жіберу емес, оны елге білімді, саналы әрі жауапты тұлға ретінде қайтару. Елге қосымша зияткерлік құндылық әкелу – қызметтің негізгі ұстанымы.</p>
            </div>

            <div class="highlight-box">
                <h3>Ата-анамен ашық байланыс</h3>
                <p>Бүкіл оқу үдерісі барысында ата-анамен тұрақты байланыс орнатылады, үдеріс туралы ақпарат беріліп отырады.</p>
            </div>

            <div class="highlight-box">
                <h3>Дағдарыс жағдайындағы қолдау</h3>
                <p>Виза, университет немесе ел ауыстыру сияқты күтпеген жағдайларда студент жалғыз қалмайды, педагогикалық және ұйымдастырушылық қолдау жалғасады.</p>
            </div>
        </section>

        <section class="contact-section">
            <h2>Байланыс</h2>
            <p>Тегін консультация алыңыз</p>
            <p>Ең қолайлы білім беру бағдарламаларын бірге таңдайық</p>
            <p>Тел: +7701-270-23-61, +7775-714-53-09</p>
        </section>

        <section class="faq-section">
            <h2>Жиі қойылатын сұрақтар</h2>
            
            <div class="faq-item">
                <div class="faq-question">1. Балам/мен шетелде жалғыз қалмаймын ба?</div>
                <div class="faq-answer">Жоқ. Студентке оқу үдерісінің барлық кезеңінде мұғалім жетекшілігімен толық сүйемелдеу көрсетіледі: үйден әуежайға дейін, қабылдау мен тіркеу кеңсесінен оқу орнына дейін.</div>
            </div>

            <div class="faq-item">
                <div class="faq-question">2. Қандай елдер мен университеттермен жұмыс істейсіздер?</div>
                <div class="faq-answer">AKA Академиясы аккредитациядан өткен, дипломы мойындалатын және алдын ала тексерілген серіктес университеттермен ғана жұмыс істейді. Елдер мен оқу орындары бағдарламаға қарай ұсынылады.</div>
            </div>

            <div class="faq-item">
                <div class="faq-question">3. Ата-ана оқу барысында қалай хабар алып отырады?</div>
                <div class="faq-answer">Ата-анамен тұрақты байланыс орнатылады. Студенттің оқу барысы, бейімделуі және жағдайы туралы уақытылы ақпарат беріліп отырады.</div>
            </div>

            <div class="faq-item">
                <div class="faq-question">4. Виза немесе құжат мәселесі туындаса не болады?</div>
                <div class="faq-answer">Құжаттар мен виза рәсімдеу үдерісі AKA Академиясының сүйемелдеуімен жүргізіледі. Күтпеген жағдай туындаса, балама шешімдер ұсынылады.</div>
            </div>

            <div class="faq-item">
                <div class="faq-question">5. Университет пен мамандық қалай таңдалады?</div>
                <div class="faq-answer">Таңдау студенттің қабілеті, қызығушылығы және болашақ жоспары ескеріле отырып, мұғалімнің кәсіби кеңесі арқылы жүзеге асырылады.</div>
            </div>

            <div class="faq-item">
                <div class="faq-question">6. Бағдарламаның құны қандай және не кіреді?</div>
                <div class="faq-answer">Бағдарлама құны елге және оқу түріне байланысты анықталады. Қызмет құрамына кеңес беру, құжаттарды рәсімдеу, оқу орнына орналастыру және сүйемелдеу кіреді. Барлық шарттар алдын ала ашық түсіндіріледі.</div>
            </div>
        </section>';
    }

    private function getRussianContent(): string
    {
        return '<section class="hero-section">
            <div class="container">
                <h2>"Когда речь идет о будущем страны, основная опора – образование."</h2>
                <p>Готовы ли вы идти по пути с нами? Мы растем вместе.</p>
                <p>Наши офисы и опытные представители в различных городах Турции готовы предоставить вам качественные услуги. Вы можете увидеть информацию о наших представителях, нажав на названия городов на карте.</p>
                <div class="world-map-placeholder"></div>
            </div>
        </section>

        <section class="about-section">
            <h2>AKA – Академия Айхан Коркмаз</h2>
            <h3>О программе</h3>
            <p>AKA – Академия Айхан Коркмаз – организация, созданная по инициативе педагогов, осуществляющая международные образовательные услуги под руководством преподавателей.</p>
            <p>Деятельность Академии основана на принципе «Будущее страны – в образовании» и направлена на систематическую организацию процессов получения образования за рубежом и накопления опыта студентами и преподавателями.</p>
        </section>

        <section class="mission-section">
            <h2>Наша миссия</h2>
            <p>Миссия Академии AKA – формирование сознательной, ответственной и готовой служить обществу личности, обеспечивая академическое, профессиональное и личностное развитие молодежи и педагогов, получающих образование за рубежом.</p>
        </section>

        <section class="concept-section">
            <h2>Концептуальная основа деятельности</h2>
            <p>Академия AKA опирается на стратегический подход выдающегося казахского государственного и общественного деятеля Алихана Букейханова «Служить народу – от природы».</p>
            <p>В соответствии с этим принципом деятельность Академии направлена на подготовку специалистов, служащих обществу, через непрерывное и качественное образование под руководством преподавателя.</p>
        </section>

        <section class="difference-section">
            <h2>Отличие AKA</h2>
            
            <div class="highlight-box">
                <h3>Руководство учителя</h3>
                <p>Образовательное движение организуется не как управленческая услуга, а как педагогический процесс, осуществляемый под руководством учителя. Каждому студенту назначается профессиональный педагог, обеспечивающий академическое руководство.</p>
            </div>

            <div class="highlight-box">
                <h3>Ориентация на характер и способности</h3>
                <p>Студент рассматривается не просто как набор документов, а как личность. Его характер, интересы, потенциал и способности всесторонне анализируются до выезда за границу.</p>
            </div>

            <div class="highlight-box">
                <h3>Предварительный отбор и проверка университетов</h3>
                <p>Университеты-партнеры AKA состоят из учебных заведений, которые были предварительно изучены, проверены на аккредитацию, признание дипломов и качество образования.</p>
            </div>

            <div class="highlight-box">
                <h3>Полная система поддержки</h3>
                <p>Студенту оказывается непрерывная поддержка с участием преподавателя от дома до аэропорта, от приемной и регистрационной службы до места учебы. Процессы документирования, визы, регистрации и проживания находятся под полным контролем.</p>
            </div>

            <div class="highlight-box">
                <h3>Подход, ориентированный на возвращение в страну</h3>
                <p>Главная цель AKA – не просто отправить студента за границу, а вернуть его в страну образованным, сознательным и ответственным человеком. Привнесение дополнительной интеллектуальной ценности в страну – основной принцип деятельности.</p>
            </div>

            <div class="highlight-box">
                <h3>Открытое общение с родителями</h3>
                <p>На протяжении всего учебного процесса устанавливается постоянная связь с родителями, предоставляется информация о процессе.</p>
            </div>

            <div class="highlight-box">
                <h3>Поддержка в кризисных ситуациях</h3>
                <p>В непредвиденных ситуациях, таких как виза, университет или смена страны, студент не остается один, продолжается педагогическая и организационная поддержка.</p>
            </div>
        </section>

        <section class="contact-section">
            <h2>Контакты</h2>
            <p>Получите бесплатную консультацию</p>
            <p>Давайте вместе выберем наиболее подходящие образовательные программы</p>
            <p>Тел: +7701-270-23-61, +7775-714-53-09</p>
        </section>

        <section class="faq-section">
            <h2>Часто задаваемые вопросы</h2>
            
            <div class="faq-item">
                <div class="faq-question">1. Мой ребенок/я не останется один за границей?</div>
                <div class="faq-answer">Нет. Студенту оказывается полная поддержка под руководством преподавателя на всех этапах учебного процесса: от дома до аэропорта, от приемной и регистрационной службы до места учебы.</div>
            </div>

            <div class="faq-item">
                <div class="faq-question">2. С какими странами и университетами вы работаете?</div>
                <div class="faq-answer">Академия AKA работает только с партнерскими университетами, которые прошли аккредитацию, признаны дипломы и были предварительно проверены. Страны и учебные заведения предлагаются в соответствии с программой.</div>
            </div>

            <div class="faq-item">
                <div class="faq-question">3. Как родители получают информацию в процессе учебы?</div>
                <div class="faq-answer">Устанавливается постоянная связь с родителями. Своевременно предоставляется информация о ходе учебы, адаптации и ситуации студента.</div>
            </div>

            <div class="faq-item">
                <div class="faq-question">4. Что происходит, если возникает проблема с визой или документами?</div>
                <div class="faq-answer">Процесс документирования и оформления визы проводится при поддержке Академии AKA. В случае непредвиденной ситуации предлагаются альтернативные решения.</div>
            </div>

            <div class="faq-item">
                <div class="faq-question">5. Как выбираются университет и специальность?</div>
                <div class="faq-answer">Выбор осуществляется через профессиональную консультацию преподавателя с учетом способностей, интересов и будущих планов студента.</div>
            </div>

            <div class="faq-item">
                <div class="faq-question">6. Какова стоимость программы и что входит?</div>
                <div class="faq-answer">Стоимость программы определяется в зависимости от страны и типа обучения. В состав услуг входят консультирование, оформление документов, размещение в учебном заведении и поддержка. Все условия заранее объясняются открыто.</div>
            </div>
        </section>';
    }

    private function getEnglishContent(): string
    {
        return '<section class="hero-section">
            <div class="container">
                <h2>"When it comes to the future of the country, the main support is education."</h2>
                <p>Are you ready to walk the path with us? We grow together.</p>
                <p>Our offices and experienced representatives in various cities of Turkey are ready to provide you with quality services. You can see information about our representatives by clicking on the city names on the map.</p>
                <div class="world-map-placeholder"></div>
            </div>
        </section>

        <section class="about-section">
            <h2>AKA – Ayhan Korkmaz Academy</h2>
            <h3>About the Program</h3>
            <p>AKA – Ayhan Korkmaz Academy – an organization established by teacher initiative, providing international education services under teacher guidance.</p>
            <p>The Academy\'s activities are based on the principle "The future of the country is in education" and are aimed at systematically organizing the processes of students and teachers obtaining education abroad and gaining experience.</p>
        </section>

        <section class="mission-section">
            <h2>Our Mission</h2>
            <p>The mission of AKA Academy is to form a conscious, responsible and ready-to-serve-society personality by ensuring the academic, professional and personal development of youth and teachers studying abroad.</p>
        </section>

        <section class="concept-section">
            <h2>Conceptual Basis of Activities</h2>
            <p>AKA Academy relies on the strategic approach of the prominent Kazakh statesman and public figure Alikhan Bukeikhanov "To serve the people – from nature".</p>
            <p>In accordance with this principle, the Academy\'s activities are aimed at contributing to the training of specialists who serve society through continuous and quality education under the guidance of a teacher.</p>
        </section>

        <section class="difference-section">
            <h2>AKA Difference</h2>
            
            <div class="highlight-box">
                <h3>Teacher Guidance</h3>
                <p>The education movement is organized not as a management service, but as a pedagogical process carried out under teacher guidance. Each student is assigned a professional teacher who provides academic guidance.</p>
            </div>

            <div class="highlight-box">
                <h3>Character and Ability-Based Orientation</h3>
                <p>The student is considered not just as a set of documents, but as a personality. Their character, interests, potential and abilities are comprehensively analyzed before going abroad.</p>
            </div>

            <div class="highlight-box">
                <h3>Pre-selection and Verification of Universities</h3>
                <p>AKA partner universities consist of educational institutions that have been pre-studied, verified for accreditation, diploma recognition and quality of education.</p>
            </div>

            <div class="highlight-box">
                <h3>Full Support System</h3>
                <p>The student receives continuous support with teacher participation from home to airport, from admission and registration office to place of study. Documentation, visa, registration and accommodation processes are under full control.</p>
            </div>

            <div class="highlight-box">
                <h3>Return-to-Country Oriented Approach</h3>
                <p>The main goal of AKA is not just to send the student abroad, but to return them to the country as an educated, conscious and responsible person. Bringing additional intellectual value to the country is the main principle of the service.</p>
            </div>

            <div class="highlight-box">
                <h3>Open Communication with Parents</h3>
                <p>Throughout the entire learning process, constant communication is established with parents, and information about the process is provided.</p>
            </div>

            <div class="highlight-box">
                <h3>Support in Crisis Situations</h3>
                <p>In unforeseen situations such as visa, university or country change, the student is not left alone, pedagogical and organizational support continues.</p>
            </div>
        </section>

        <section class="contact-section">
            <h2>Contact</h2>
            <p>Get Free Consultation</p>
            <p>Let\'s choose the most suitable education programs together</p>
            <p>Tel: +7701-270-23-61, +7775-714-53-09</p>
        </section>

        <section class="faq-section">
            <h2>Frequently Asked Questions</h2>
            
            <div class="faq-item">
                <div class="faq-question">1. Will my child/I not be left alone abroad?</div>
                <div class="faq-answer">No. The student receives full support under teacher guidance at all stages of the learning process: from home to airport, from admission and registration office to place of study.</div>
            </div>

            <div class="faq-item">
                <div class="faq-question">2. Which countries and universities do you work with?</div>
                <div class="faq-answer">AKA Academy works only with partner universities that have been accredited, recognized diplomas and pre-verified. Countries and educational institutions are offered according to the program.</div>
            </div>

            <div class="faq-item">
                <div class="faq-question">3. How do parents get information during the study process?</div>
                <div class="faq-answer">Constant communication is established with parents. Timely information is provided about the student\'s study progress, adaptation and situation.</div>
            </div>

            <div class="faq-item">
                <div class="faq-question">4. What happens if a visa or document issue arises?</div>
                <div class="faq-answer">The documentation and visa processing process is carried out with the support of AKA Academy. In case of an unforeseen situation, alternative solutions are offered.</div>
            </div>

            <div class="faq-item">
                <div class="faq-question">5. How are university and major selected?</div>
                <div class="faq-answer">Selection is carried out through the professional consultation of the teacher, taking into account the student\'s abilities, interests and future plans.</div>
            </div>

            <div class="faq-item">
                <div class="faq-question">6. What is the cost of the program and what is included?</div>
                <div class="faq-answer">The program cost is determined depending on the country and type of study. The service includes counseling, document processing, placement in educational institution and support. All conditions are explained openly in advance.</div>
            </div>
        </section>';
    }

    private function getTurkishContent(): string
    {
        return '<section class="hero-section">
            <div class="container">
                <h2>"Ülkenin geleceğinden söz edildiğinde, temel dayanak – eğitimdir."</h2>
                <p>Bizimle yol yürümeye hazır mısınız? Birlikte büyüyoruz.</p>
                <p>Türkiye\'nin çeşitli şehirlerinde bulunan ofislerimiz ve deneyimli temsilcilerimiz size en kaliteli hizmeti sunmaya hazır. Haritadan şehir isimlerine tıklayarak temsilcilerimiz hakkında bilgi görebilirsiniz.</p>
                <div class="world-map-placeholder"></div>
            </div>
        </section>

        <section class="about-section">
            <h2>AKA – Ayhan Korkmaz Akademisi</h2>
            <h3>Program Hakkında</h3>
            <p>AKA – Ayhan Korkmaz Akademisi – öğretmen inisiyatifiyle kurulmuş, öğretmen rehberliğinde uluslararası eğitim hizmetleri sunan organizasyon.</p>
            <p>Akademi faaliyetleri «Ülkenin geleceği – eğitimde» ilkesine dayanır ve öğrenciler ile öğretmenlerin yurt dışında eğitim alma, deneyim biriktirme süreçlerini sistematik olarak organize etmeye yöneliktir.</p>
        </section>

        <section class="mission-section">
            <h2>Misyonumuz</h2>
            <p>AKA Akademisi\'nin misyonu – yurt dışında eğitim alan gençler ve öğretmenlerin akademik, mesleki ve kişisel gelişimini sağlayarak, bilinçli, sorumlu ve topluma hizmet etmeye hazır kişilik oluşturmaktır.</p>
        </section>

        <section class="concept-section">
            <h2>Hizmetin Kavramsal Temeli</h2>
            <p>AKA Akademisi, Kazakistan\'ın önde gelen devlet ve toplum önderi Alihan Bökeyhan\'ın «Halka hizmet etmek – doğadan gelir» stratejik yaklaşımına dayanır.</p>
            <p>Bu ilkeye uygun olarak Akademi faaliyetleri, öğretmen rehberliğinde sürekli ve kaliteli eğitim yoluyla topluma hizmet eden uzmanlar yetiştirmeye katkı sağlar.</p>
        </section>

        <section class="difference-section">
            <h2>AKA Farkı</h2>
            
            <div class="highlight-box">
                <h3>Öğretmen Rehberliği</h3>
                <p>Eğitim hareketi yönetim hizmeti olarak değil, öğretmen rehberliğinde gerçekleştirilen pedagojik süreç olarak organize edilir. Her öğrenciye akademik yönlendirme sağlayan profesyonel öğretmen atanır.</p>
            </div>

            <div class="highlight-box">
                <h3>Karakter ve Yeteneğe Dayalı Yönlendirme</h3>
                <p>Öğrenci sadece belgeler topluluğu olarak değil, kişilik olarak ele alınır. Karakteri, ilgileri, potansiyeli ve yetenekleri yurt dışına çıkmadan önce kapsamlı olarak analiz edilir.</p>
            </div>

            <div class="highlight-box">
                <h3>Üniversitelerin Önceden Seçilmesi ve Kontrolü</h3>
                <p>AKA ortak üniversiteleri, önceden incelenmiş, akreditasyonu, diplomasının tanınması ve eğitim kalitesi kontrol edilmiş eğitim kurumlarından oluşur.</p>
            </div>

            <div class="highlight-box">
                <h3>Tam Destek Sistemi</h3>
                <p>Öğrenciye evden havalimanına, kabul ve kayıt ofisinden eğitim yerine kadar öğretmen katılımıyla sürekli destek sağlanır. Belgelendirme, vize, kayıt ve konaklama süreçleri tam kontrol altındadır.</p>
            </div>

            <div class="highlight-box">
                <h3>Ülkeye Dönüş Odaklı Yaklaşım</h3>
                <p>AKA için ana hedef – öğrenciyi sadece yurt dışına göndermek değil, onu ülkeye eğitimli, bilinçli ve sorumlu kişilik olarak geri döndürmektir. Ülkeye ek entelektüel değer getirmek – hizmetin temel ilkesidir.</p>
            </div>

            <div class="highlight-box">
                <h3>Ebeveynlerle Açık İletişim</h3>
                <p>Tüm eğitim süreci boyunca ebeveynlerle sürekli iletişim kurulur, süreç hakkında bilgi verilir.</p>
            </div>

            <div class="highlight-box">
                <h3>Kriz Durumlarında Destek</h3>
                <p>Vize, üniversite veya ülke değişikliği gibi beklenmedik durumlarda öğrenci yalnız kalmaz, pedagojik ve organizasyonel destek devam eder.</p>
            </div>
        </section>

        <section class="contact-section">
            <h2>İletişim</h2>
            <p>Ücretsiz Danışmanlık Alın</p>
            <p>En uygun eğitim programlarını birlikte seçelim</p>
            <p>Tel: +7701-270-23-61, +7775-714-53-09</p>
        </section>

        <section class="faq-section">
            <h2>Sıkça Sorulan Sorular</h2>
            
            <div class="faq-item">
                <div class="faq-question">1. Çocuğum/Ben yurt dışında yalnız kalmayacak mı?</div>
                <div class="faq-answer">Hayır. Öğrenciye eğitim sürecinin tüm aşamalarında öğretmen rehberliğinde tam destek sağlanır: evden havalimanına kadar, kabul ve kayıt ofisinden eğitim yerine kadar.</div>
            </div>

            <div class="faq-item">
                <div class="faq-question">2. Hangi ülkeler ve üniversitelerle çalışıyorsunuz?</div>
                <div class="faq-answer">AKA Akademisi sadece akreditasyondan geçmiş, diploması tanınan ve önceden kontrol edilmiş ortak üniversitelerle çalışır. Ülkeler ve eğitim kurumları programa göre önerilir.</div>
            </div>

            <div class="faq-item">
                <div class="faq-question">3. Ebeveynler eğitim sürecinde nasıl bilgi alır?</div>
                <div class="faq-answer">Ebeveynlerle sürekli iletişim kurulur. Öğrencinin eğitim ilerlemesi, uyumu ve durumu hakkında zamanında bilgi verilir.</div>
            </div>

            <div class="faq-item">
                <div class="faq-question">4. Vize veya belge sorunu çıkarsa ne olur?</div>
                <div class="faq-answer">Belgeler ve vize işlem süreci AKA Akademisi\'nin desteğiyle yürütülür. Beklenmedik durum çıkarsa, alternatif çözümler önerilir.</div>
            </div>

            <div class="faq-item">
                <div class="faq-question">5. Üniversite ve bölüm nasıl seçilir?</div>
                <div class="faq-answer">Seçim öğrencinin yetenekleri, ilgileri ve gelecek planları dikkate alınarak öğretmenin mesleki danışmanlığı aracılığıyla gerçekleştirilir.</div>
            </div>

            <div class="faq-item">
                <div class="faq-question">6. Programın maliyeti nedir ve ne dahildir?</div>
                <div class="faq-answer">Program maliyeti ülkeye ve eğitim türüne göre belirlenir. Hizmet kapsamına danışmanlık, belge işlemleri, eğitim kurumuna yerleştirme ve destek dahildir. Tüm koşullar önceden açıkça açıklanır.</div>
            </div>
        </section>';
    }
}
