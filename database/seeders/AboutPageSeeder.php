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

        <section class="teacher-mobility-section">
            <h2>Оқытушыларға арналған халықаралық бағдарламалар</h2>
            <p>AKA Академиясы оқытушылардың үздіксіз кәсіби дамуын білім сапасының негізгі кепілі ретінде қарастырады.</p>
            <p>Осы бағытта:</p>
            <ul>
                <li>тақырыптық халықаралық стажировкалар</li>
                <li>университеттермен бірлескен сертификаттық бағдарламалар</li>
                <li>халықаралық деңгейде мойындалған кәсіби курстар ұйымдастырылады.</li>
            </ul>
        </section>

        <section class="university-section">
            <h2>ОҚУ ОРЫНДАРЫ</h2>
            <h3>Академиялық кеңес беру және университетке орналастыру</h3>
            <p>AKA Академиясы студентті үйінен бастап, қабылданған университеттің тіркеу бөліміне дейін мұғалім жетекшілігімен толық сүйемелдейді.</p>
            <p>Білім беру жолы Қазақстанның барлық өңірінде мұғаліммен басталып, шетелдік университетте мұғалімнің қатысуымен аяқталады.</p>
            <p>Университет пен мамандық таңдау студенттің қабілеті мен қызығушылығына сай жүзеге асырылады.</p>
            <p>AKA Академиясы серіктес елдер мен университеттердің оқу бағдарламаларын, ресми сәйкестігін, аккредитациясын және дипломдардың мойындалуын алдын ала тексереді.</p>
            <p>Бағдарламаға енгізілген барлық оқу орындары біздің мұғалімдеріміз барып көрген, танысқан және сенімді деп танылған университеттер.</p>
            <p>Басты мақсатымыз – студентке болашағы бар, саналы әрі дұрыс кәсіби бағыт ұсыну.</p>

            <h3>Шетелге оқуға түсу: 5 жеңіл қадам</h3>
            <ol class="steps-list">
                <li>
                    <h4>Байланысқа шығу</h4>
                    <p>Бізге хабарласқаннан кейін сіздің білім деңгейіңіз, мақсатыңыз және мүмкіндіктеріңіз анықталады. Осы мәліметтерге сүйене отырып, сізге ең қолайлы оқу елдері ұсынылады. Әрбір ментор – шетелде оқыған немесе сол елдің білім жүйесін жақсы білетін маман.</p>
                </li>
                <li>
                    <h4>Алғашқы кеңес алу</h4>
                    <p>Елді, университетті немесе грант түрін таңдауда күмәніңіз болса, ментордан жеке консультация ала аласыз. Егер бір реттік кеңес жеткіліксіз болса, шетелге түсуге арналған толық қолдау бағдарламасын таңдауға мүмкіндік бар.</p>
                </li>
                <li>
                    <h4>Жеке дайындық кезеңі</h4>
                    <p>Толық қолдау аясында келісімшарт рәсімделіп, дайындық үдерісі басталады. Бұл кезеңге:</p>
                    <ul>
                        <li>ментормен жеке онлайн кездесулер</li>
                        <li>чат арқылы тұрақты кері байланыс</li>
                        <li>құжаттарды дайындау</li>
                        <li>мотивациялық хаттар мен эсселерді редакциялау</li>
                        <li>гранттарды іздеу және іріктеу</li>
                    </ul>
                </li>
                <li>
                    <h4>Университет пен гранттарға өтініш беру</h4>
                    <p>Барлық қажетті құжаттар ментордың жетекшілігімен дайындалып, университеттер мен гранттарға бірге тапсырылады. Қабылдау мүмкіндігін арттыру үшін бір ел ішінде бірнеше оқу орнына өтініш беріледі.</p>
                </li>
                <li>
                    <h4>Қорытынды кеңес және келесі қадамдар</h4>
                    <p>Өтініштер тапсырылғаннан кейін ментор виза рәсімдеу бойынша соңғы кеңес береді және оқуға қабылданғаннан кейінгі барлық келесі қадамдарды егжей-тегжейлі түсіндіреді.</p>
                </li>
            </ol>
        </section>

        <section class="language-schools-section">
            <h2>Тіл курстары</h2>
            <h3>Тіл мектептері және даму бағдарламалары</h3>
            <h4>Неліктен тіл үйрену тәжірибесі маңызды?</h4>
            <ul>
                <li>Тіл тек аудиторияда емес, нақты өмірде қолдану арқылы меңгеріледі</li>
                <li>Оқушылар тілді өз ортасында, құрдастарымен қарым-қатынас арқылы тәжірибеде қолданады</li>
                <li>Бағдарлама тілмен қатар сол елдің мәдениеті мен қалалық ортасын тануға бағытталған</li>
                <li>Тіл дамуы тәулігіне 24 сағаттық тәжірибе мен өзара әрекетке негізделген</li>
                <li>Қаланың тарихи және маңызды орындары сол елдің тілі арқылы танылады</li>
            </ul>
            <h4>Оқу үдерісі:</h4>
            <ul>
                <li>Қазақстаннан барған мұғаліммен басталады</li>
                <li>Қабылдаушы елдегі кәсіби тіл маманының жетекшілігімен жалғасады</li>
            </ul>
            <h4>Бағдарлама нәтижесінде оқушы:</h4>
            <ul>
                <li>тіл қолдану қабілетін дамытады</li>
                <li>өзіне деген сенімін арттырады</li>
                <li>дүниетанымын кеңейтіп, саналы тұлға ретінде қалыптасады</li>
            </ul>
            <p><strong>AKA-ның басты айырмашылығы</strong> – оқушымен тәулік бойы бірге болып, оқу мен өмірді ұштастыра алатын өз еліміздің мұғалімінің тұрақты жетекшілігі.</p>
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

        <section class="teacher-mobility-section">
            <h2>Международные программы для преподавателей</h2>
            <p>Академия AKA рассматривает непрерывное профессиональное развитие преподавателей как основную гарантию качества образования.</p>
            <p>В этом направлении организуются:</p>
            <ul>
                <li>тематические международные стажировки</li>
                <li>сертификационные программы совместно с университетами</li>
                <li>профессиональные курсы, признанные на международном уровне</li>
            </ul>
        </section>

        <section class="university-section">
            <h2>УЧЕБНЫЕ ЗАВЕДЕНИЯ</h2>
            <h3>Академическое консультирование и размещение в университете</h3>
            <p>Академия AKA полностью сопровождает студента под руководством преподавателя от дома до приемной части принятого университета.</p>
            <p>Путь образования начинается с преподавателя во всех регионах Казахстана и заканчивается участием преподавателя в зарубежном университете.</p>
            <p>Выбор университета и специальности осуществляется в соответствии со способностями и интересами студента.</p>
            <p>Академия AKA заранее проверяет учебные программы, официальное соответствие, аккредитацию и признание дипломов стран-партнеров и университетов.</p>
            <p>Все учебные заведения, включенные в программу, – это университеты, которые посетили, познакомились и признаны надежными нашими преподавателями.</p>
            <p>Наша главная цель – предоставить студенту перспективное, сознательное и правильное профессиональное направление.</p>

            <h3>Поступление на учебу за границу: 5 простых шагов</h3>
            <ol class="steps-list">
                <li>
                    <h4>Связаться</h4>
                    <p>После обращения к нам определяется ваш уровень образования, цели и возможности. На основе этой информации вам предлагаются наиболее подходящие страны для учебы. Каждый ментор – специалист, который учился за границей или хорошо знает систему образования этой страны.</p>
                </li>
                <li>
                    <h4>Получить первоначальную консультацию</h4>
                    <p>Если у вас есть сомнения в выборе страны, университета или типа гранта, вы можете получить индивидуальную консультацию от ментора. Если разовая консультация недостаточна, есть возможность выбрать полную программу поддержки для поступления за границу.</p>
                </li>
                <li>
                    <h4>Этап индивидуальной подготовки</h4>
                    <p>В рамках полной поддержки оформляется договор и начинается процесс подготовки. Этот этап включает:</p>
                    <ul>
                        <li>индивидуальные онлайн-встречи с ментором</li>
                        <li>постоянная обратная связь через чат</li>
                        <li>подготовка документов</li>
                        <li>редактирование мотивационных писем и эссе</li>
                        <li>поиск и отбор грантов</li>
                    </ul>
                </li>
                <li>
                    <h4>Подача заявок в университеты и на гранты</h4>
                    <p>Все необходимые документы готовятся под руководством ментора и вместе подаются в университеты и на гранты. Для увеличения возможности приема заявки подаются в несколько учебных заведений в одной стране.</p>
                </li>
                <li>
                    <h4>Заключительная консультация и следующие шаги</h4>
                    <p>После подачи заявок ментор дает финальную консультацию по оформлению визы и подробно объясняет все следующие шаги после поступления на учебу.</p>
                </li>
            </ol>
        </section>

        <section class="language-schools-section">
            <h2>Языковые курсы</h2>
            <h3>Языковые школы и программы развития</h3>
            <h4>Почему языковое движение?</h4>
            <ul>
                <li>Язык осваивается не в аудитории, а через использование в реальной жизни</li>
                <li>Учащиеся используют язык на практике в своей среде, общаясь со сверстниками</li>
                <li>Программа направлена на знакомство не только с языком, но и с культурой и городской средой этой страны</li>
                <li>Развитие языка основано на 24-часовом опыте и взаимодействии в день</li>
                <li>Исторические и важные места города познаются на языке этой страны</li>
            </ul>
            <h4>Учебный процесс:</h4>
            <ul>
                <li>Начинается с преподавателя, приехавшего из Казахстана</li>
                <li>Продолжается под руководством профессионального языкового специалиста принимающей страны</li>
            </ul>
            <h4>В результате программы учащийся:</h4>
            <ul>
                <li>развивает способность использовать язык</li>
                <li>повышает уверенность в себе</li>
                <li>расширяет мировоззрение и формируется как сознательная личность</li>
            </ul>
            <p><strong>Главное отличие AKA</strong> – постоянное руководство нашего преподавателя, который может быть со студентом 24 часа в сутки и сочетать учебу и жизнь.</p>
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

        <section class="teacher-mobility-section">
            <h2>International Programs for Teachers</h2>
            <p>AKA Academy considers the continuous professional development of teachers as the main guarantee of education quality.</p>
            <p>In this direction:</p>
            <ul>
                <li>thematic international internships</li>
                <li>certification programs in cooperation with universities</li>
                <li>professionally recognized courses at international level are organized</li>
            </ul>
        </section>

        <section class="university-section">
            <h2>EDUCATIONAL INSTITUTIONS</h2>
            <h3>Academic Counseling and University Placement</h3>
            <p>AKA Academy fully supports the student under teacher guidance from home to the registration department of the accepted university.</p>
            <p>The education path starts with a teacher in all regions of Kazakhstan and ends with teacher participation in a foreign university.</p>
            <p>University and major selection is carried out according to the student\'s abilities and interests.</p>
            <p>AKA Academy pre-checks the educational programs, official compliance, accreditation and diploma recognition of partner countries and universities.</p>
            <p>All educational institutions included in the program are universities that our teachers have visited, met and recognized as reliable.</p>
            <p>Our main goal is to provide the student with a promising, conscious and correct professional direction.</p>

            <h3>Studying Abroad: 5 Easy Steps</h3>
            <ol class="steps-list">
                <li>
                    <h4>Contact</h4>
                    <p>After contacting us, your education level, goals and opportunities are determined. Based on this information, the most suitable countries for study are offered to you. Each mentor is a specialist who has studied abroad or knows the education system of that country well.</p>
                </li>
                <li>
                    <h4>Get Initial Consultation</h4>
                    <p>If you have doubts about choosing a country, university or type of grant, you can get individual consultation from a mentor. If a one-time consultation is insufficient, there is an opportunity to choose a full support program for studying abroad.</p>
                </li>
                <li>
                    <h4>Individual Preparation Phase</h4>
                    <p>Under full support, a contract is signed and the preparation process begins. This phase includes:</p>
                    <ul>
                        <li>individual online meetings with mentor</li>
                        <li>constant feedback through chat</li>
                        <li>document preparation</li>
                        <li>editing motivation letters and essays</li>
                        <li>searching and selecting grants</li>
                    </ul>
                </li>
                <li>
                    <h4>Apply to Universities and Grants</h4>
                    <p>All necessary documents are prepared under mentor guidance and submitted together to universities and grants. To increase acceptance possibility, applications are submitted to several educational institutions within one country.</p>
                </li>
                <li>
                    <h4>Final Consultation and Next Steps</h4>
                    <p>After applications are submitted, the mentor gives final consultation on visa processing and explains all next steps after being accepted for study in detail.</p>
                </li>
            </ol>
        </section>

        <section class="language-schools-section">
            <h2>Language Courses</h2>
            <h3>Language Schools and Development Programs</h3>
            <h4>Why Language Movement?</h4>
            <ul>
                <li>Language is mastered not in the classroom, but through use in real life</li>
                <li>Students use the language in practice in their environment, communicating with peers</li>
                <li>The program is aimed at getting to know not only the language but also the culture and urban environment of that country</li>
                <li>Language development is based on 24-hour experience and interaction per day</li>
                <li>Historical and important places of the city are learned through the language of that country</li>
            </ul>
            <h4>Learning Process:</h4>
            <ul>
                <li>Starts with a teacher who came from Kazakhstan</li>
                <li>Continues under the guidance of a professional language specialist in the host country</li>
            </ul>
            <h4>As a result of the program, the student:</h4>
            <ul>
                <li>develops language use ability</li>
                <li>increases self-confidence</li>
                <li>expands worldview and forms as a conscious personality</li>
            </ul>
            <p><strong>The main difference of AKA</strong> – constant guidance of our teacher who can be with the student 24 hours a day and combine study and life.</p>
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

        <section class="teacher-mobility-section">
            <h2>Öğretmen Hareketliliği</h2>
            <p>AKA Akademisi, öğretmenlerin sürekli mesleki gelişimini eğitim kalitesinin temel garantisi olarak görür.</p>
            <p>Bu yönde:</p>
            <ul>
                <li>temalı uluslararası stajlar</li>
                <li>üniversitelerle ortak sertifikasyon programları</li>
                <li>uluslararası düzeyde tanınan mesleki kurslar organize edilir.</li>
            </ul>
        </section>

        <section class="university-section">
            <h2>ÜNİVERSİTE</h2>
            <h3>Akademik Danışmanlık ve Üniversite Yerleştirme</h3>
            <p>AKA Akademisi öğrenciyi evinden başlayarak, kabul edilen üniversitenin kayıt bölümüne kadar öğretmen rehberliğinde tam destekler.</p>
            <p>Eğitim yolu Kazakistan\'ın tüm bölgelerinde öğretmenle başlar ve yabancı üniversitede öğretmenin katılımıyla sona erer.</p>
            <p>Üniversite ve bölüm seçimi öğrencinin yetenekleri ve ilgilerine göre gerçekleştirilir.</p>
            <p>AKA Akademisi ortak ülkeler ve üniversitelerin eğitim programlarını, resmi uygunluğunu, akreditasyonunu ve diplomaların tanınmasını önceden kontrol eder.</p>
            <p>Programa dahil edilen tüm eğitim kurumları öğretmenlerimizin gidip gördüğü, tanıştığı ve güvenilir olarak kabul edilen üniversitelerdir.</p>
            <p>Ana hedefimiz – öğrenciye geleceği olan, bilinçli ve doğru mesleki yön sunmaktır.</p>

            <h3>Yurt Dışına Okumaya Giriş: 5 Kolay Adım</h3>
            <ol class="steps-list">
                <li>
                    <h4>İletişime Geçmek</h4>
                    <p>Bize ulaştıktan sonra eğitim seviyeniz, hedefleriniz ve imkanlarınız belirlenir. Bu bilgilere dayanarak size en uygun eğitim ülkeleri önerilir. Her mentor – yurt dışında okumuş veya o ülkenin eğitim sistemini iyi bilen uzmandır.</p>
                </li>
                <li>
                    <h4>İlk Danışmanlık Almak</h4>
                    <p>Ülke, üniversite veya burs türünü seçerken şüpheniz varsa, mentordan bireysel danışmanlık alabilirsiniz. Tek seferlik danışmanlık yetersizse, yurt dışına giriş için tam destek programını seçme imkanı vardır.</p>
                </li>
                <li>
                    <h4>Bireysel Hazırlık Aşaması</h4>
                    <p>Tam destek kapsamında sözleşme düzenlenir ve hazırlık süreci başlar. Bu aşama şunları içerir:</p>
                    <ul>
                        <li>mentor ile bireysel online görüşmeler</li>
                        <li>chat aracılığıyla sürekli geri bildirim</li>
                        <li>belgelerin hazırlanması</li>
                        <li>motivasyon mektupları ve denemelerin düzenlenmesi</li>
                        <li>bursların aranması ve seçilmesi</li>
                    </ul>
                </li>
                <li>
                    <h4>Üniversite ve Burslara Başvuru</h4>
                    <p>Tüm gerekli belgeler mentor rehberliğinde hazırlanır ve üniversitelere ve burslara birlikte sunulur. Kabul imkanını artırmak için bir ülke içinde birkaç eğitim kurumuna başvuru yapılır.</p>
                </li>
                <li>
                    <h4>Son Danışmanlık ve Sonraki Adımlar</h4>
                    <p>Başvurular sunulduktan sonra mentor vize işlemleri konusunda son danışmanlığı verir ve eğitime kabul edildikten sonraki tüm sonraki adımları detaylı olarak açıklar.</p>
                </li>
            </ol>
        </section>

        <section class="language-schools-section">
            <h2>Dil Okulları</h2>
            <h3>Dil Okulları ve Gelişim Programları</h3>
            <h4>Neden Dil Hareketi?</h4>
            <ul>
                <li>Dil sadece sınıfta değil, gerçek hayatta kullanım yoluyla öğrenilir</li>
                <li>Öğrenciler dili kendi ortamlarında, akranlarıyla iletişim kurarak pratikte kullanır</li>
                <li>Program sadece dil ile değil, o ülkenin kültürü ve kentsel ortamını tanımaya yöneliktir</li>
                <li>Dil gelişimi günde 24 saatlik deneyim ve karşılıklı etkileşime dayanır</li>
                <li>Şehrin tarihi ve önemli yerleri o ülkenin dili aracılığıyla tanınır</li>
            </ul>
            <h4>Eğitim Süreci:</h4>
            <ul>
                <li>Kazakistan\'dan gelen öğretmenle başlar</li>
                <li>Ev sahibi ülkedeki profesyonel dil uzmanının rehberliğinde devam eder</li>
            </ul>
            <h4>Program sonucunda öğrenci:</h4>
            <ul>
                <li>dil kullanma yeteneğini geliştirir</li>
                <li>kendine güvenini artırır</li>
                <li>dünya görüşünü genişletir ve bilinçli kişilik olarak şekillenir</li>
            </ul>
            <p><strong>AKA\'nın ana farkı</strong> – öğrenciyle gün boyu birlikte olup, eğitim ve yaşamı birleştirebilen kendi ülkemizin öğretmeninin sürekli rehberliğidir.</p>
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
