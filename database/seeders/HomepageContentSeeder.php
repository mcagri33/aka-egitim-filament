<?php

namespace Database\Seeders;

use App\Models\Banner;
use App\Models\BannerTranslation;
use App\Models\Language;
use App\Models\Menu;
use App\Models\MenuItem;
use App\Models\MenuItemTranslation;
use App\Models\Setting;
use Illuminate\Database\Seeder;

class HomepageContentSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Dilleri oluştur
        $kazakh = Language::updateOrCreate(
            ['code' => 'kk'],
            [
                'name' => 'Қазақша',
                'is_default' => true,
                'is_active' => true,
            ]
        );

        $russian = Language::updateOrCreate(
            ['code' => 'ru'],
            [
                'name' => 'Русский',
                'is_default' => false,
                'is_active' => true,
            ]
        );

        $english = Language::updateOrCreate(
            ['code' => 'en'],
            [
                'name' => 'English',
                'is_default' => false,
                'is_active' => true,
            ]
        );

        $turkish = Language::updateOrCreate(
            ['code' => 'tr'],
            [
                'name' => 'Türkçe',
                'is_default' => false,
                'is_active' => true,
            ]
        );

        // 2. Hero Banner oluştur
        $banner = Banner::updateOrCreate(
            ['id' => 1],
            [
                'image_path' => 'banners/hero-banner.jpg',
                'is_active' => true,
                'order' => 1,
            ]
        );

        // Banner çevirileri
        BannerTranslation::updateOrCreate(
            [
                'banner_id' => $banner->id,
                'language_id' => $kazakh->id,
            ],
            [
                'title' => 'Мұғалімдік тәсілмен',
                'description' => 'Әлемді зерттеу',
                'button_text' => 'Тегін кеңес',
                'button_url' => '#iletisim',
            ]
        );

        BannerTranslation::updateOrCreate(
            [
                'banner_id' => $banner->id,
                'language_id' => $russian->id,
            ],
            [
                'title' => 'С прикосновением учителя',
                'description' => 'Исследование мира',
                'button_text' => 'Бесплатная консультация',
                'button_url' => '#iletisim',
            ]
        );

        BannerTranslation::updateOrCreate(
            [
                'banner_id' => $banner->id,
                'language_id' => $english->id,
            ],
            [
                'title' => 'With a Teacher\'s Touch',
                'description' => 'World Discovery',
                'button_text' => 'Free Consultation',
                'button_url' => '#iletisim',
            ]
        );

        BannerTranslation::updateOrCreate(
            [
                'banner_id' => $banner->id,
                'language_id' => $turkish->id,
            ],
            [
                'title' => 'Öğretmen Dokunuşuyla',
                'description' => 'Dünya Keşfi',
                'button_text' => 'Ücretsiz Danışmanlık',
                'button_url' => '#iletisim',
            ]
        );

        // 3. Header Menü oluştur
        $headerMenu = Menu::updateOrCreate(
            ['location' => 'header'],
            ['name' => 'Ana Menü']
        );

        $headerMenuItems = [
            ['title_kk' => 'Басты бет', 'title_ru' => 'Главная', 'title_en' => 'Home', 'title_tr' => 'Ana Sayfa', 'url' => '/', 'order' => 1],
            ['title_kk' => 'Біз туралы', 'title_ru' => 'О нас', 'title_en' => 'About Us', 'title_tr' => 'Hakkımızda', 'url' => '/hakkimizda', 'order' => 2],
            ['title_kk' => 'Тіл мектептері', 'title_ru' => 'Языковые школы', 'title_en' => 'Language Schools', 'title_tr' => 'Dil Okulları', 'url' => '/dil-okullari', 'order' => 3],
            ['title_kk' => 'Университет', 'title_ru' => 'Университет', 'title_en' => 'University', 'title_tr' => 'Üniversite', 'url' => '/universite', 'order' => 4],
            ['title_kk' => 'Мұғалім қозғалысы', 'title_ru' => 'Мобильность учителей', 'title_en' => 'Teacher Mobility', 'title_tr' => 'Öğretmen Hareketliliği', 'url' => '/ogretmen-hareketliligi', 'order' => 5],
            ['title_kk' => 'Байланыс', 'title_ru' => 'Контакты', 'title_en' => 'Contact', 'title_tr' => 'İletişim', 'url' => '/iletisim', 'order' => 6],
        ];

        foreach ($headerMenuItems as $itemData) {
            $menuItem = MenuItem::updateOrCreate(
                [
                    'menu_id' => $headerMenu->id,
                    'url' => $itemData['url'],
                ],
                [
                    'order' => $itemData['order'],
                    'is_active' => true,
                ]
            );

            // Kazakça
            MenuItemTranslation::updateOrCreate(
                [
                    'menu_item_id' => $menuItem->id,
                    'language_id' => $kazakh->id,
                ],
                [
                    'title' => $itemData['title_kk'],
                ]
            );

            // Rusça
            MenuItemTranslation::updateOrCreate(
                [
                    'menu_item_id' => $menuItem->id,
                    'language_id' => $russian->id,
                ],
                [
                    'title' => $itemData['title_ru'],
                ]
            );

            // İngilizce
            MenuItemTranslation::updateOrCreate(
                [
                    'menu_item_id' => $menuItem->id,
                    'language_id' => $english->id,
                ],
                [
                    'title' => $itemData['title_en'],
                ]
            );

            // Türkçe
            MenuItemTranslation::updateOrCreate(
                [
                    'menu_item_id' => $menuItem->id,
                    'language_id' => $turkish->id,
                ],
                [
                    'title' => $itemData['title_tr'],
                ]
            );
        }

        // 4. Footer Menü oluştur
        $footerMenu = Menu::updateOrCreate(
            ['location' => 'footer'],
            ['name' => 'Footer Menü']
        );

        // Kurumsal
        $kurumsal = MenuItem::updateOrCreate(
            [
                'menu_id' => $footerMenu->id,
                'url' => '#',
            ],
            [
                'order' => 1,
                'is_active' => true,
            ]
        );

        MenuItemTranslation::updateOrCreate(
            ['menu_item_id' => $kurumsal->id, 'language_id' => $kazakh->id],
            ['title' => 'Корпоративтік']
        );
        MenuItemTranslation::updateOrCreate(
            ['menu_item_id' => $kurumsal->id, 'language_id' => $russian->id],
            ['title' => 'Корпоративный']
        );
        MenuItemTranslation::updateOrCreate(
            ['menu_item_id' => $kurumsal->id, 'language_id' => $english->id],
            ['title' => 'Corporate']
        );
        MenuItemTranslation::updateOrCreate(
            ['menu_item_id' => $kurumsal->id, 'language_id' => $turkish->id],
            ['title' => 'Kurumsal']
        );

        $kurumsalItems = [
            [
                'title_kk' => 'Біз туралы',
                'title_ru' => 'О нас',
                'title_en' => 'About Us',
                'title_tr' => 'Hakkımızda',
                'url' => '/hakkimizda',
                'order' => 1
            ],
            [
                'title_kk' => 'Біз кімбіз',
                'title_ru' => 'Кто мы',
                'title_en' => 'Who We Are',
                'title_tr' => 'Biz Kimiz',
                'url' => '/biz-kimiz',
                'order' => 2
            ],
            [
                'title_kk' => 'Неге құрылды',
                'title_ru' => 'Почему мы созданы',
                'title_en' => 'Why We Were Founded',
                'title_tr' => 'Niçin Kurulduk',
                'url' => '/nicin-kurulduk',
                'order' => 3
            ],
            [
                'title_kk' => 'Біз не істегіміз келеді',
                'title_ru' => 'Что мы хотим делать',
                'title_en' => 'What We Want to Do',
                'title_tr' => 'Ne Yapmak İstiyoruz',
                'url' => '/ne-yapmak-istiyoruz',
                'order' => 4
            ],
        ];

        foreach ($kurumsalItems as $itemData) {
            $menuItem = MenuItem::updateOrCreate(
                [
                    'menu_id' => $footerMenu->id,
                    'parent_id' => $kurumsal->id,
                    'url' => $itemData['url'],
                ],
                [
                    'order' => $itemData['order'],
                    'is_active' => true,
                ]
            );

            MenuItemTranslation::updateOrCreate(
                ['menu_item_id' => $menuItem->id, 'language_id' => $kazakh->id],
                ['title' => $itemData['title_kk']]
            );
            MenuItemTranslation::updateOrCreate(
                ['menu_item_id' => $menuItem->id, 'language_id' => $russian->id],
                ['title' => $itemData['title_ru']]
            );
            MenuItemTranslation::updateOrCreate(
                ['menu_item_id' => $menuItem->id, 'language_id' => $english->id],
                ['title' => $itemData['title_en']]
            );
            MenuItemTranslation::updateOrCreate(
                ['menu_item_id' => $menuItem->id, 'language_id' => $turkish->id],
                ['title' => $itemData['title_tr']]
            );
        }

        // Üniversite
        $universite = MenuItem::updateOrCreate(
            [
                'menu_id' => $footerMenu->id,
                'url' => '#',
            ],
            [
                'order' => 2,
                'is_active' => true,
            ]
        );

        MenuItemTranslation::updateOrCreate(
            ['menu_item_id' => $universite->id, 'language_id' => $kazakh->id],
            ['title' => 'Университет']
        );
        MenuItemTranslation::updateOrCreate(
            ['menu_item_id' => $universite->id, 'language_id' => $russian->id],
            ['title' => 'Университет']
        );
        MenuItemTranslation::updateOrCreate(
            ['menu_item_id' => $universite->id, 'language_id' => $english->id],
            ['title' => 'University']
        );
        MenuItemTranslation::updateOrCreate(
            ['menu_item_id' => $universite->id, 'language_id' => $turkish->id],
            ['title' => 'Üniversite']
        );

        $universiteItems = [
            [
                'title_kk' => 'Ағылшын тілін оқыту',
                'title_ru' => 'Обучение английскому языку',
                'title_en' => 'English Language Education',
                'title_tr' => 'İngiltere Dil Eğitimi',
                'url' => '/ingiltere-dil-egitimi',
                'order' => 1
            ],
            [
                'title_kk' => 'Финляндия университеті',
                'title_ru' => 'Университет Финляндии',
                'title_en' => 'Finland University',
                'title_tr' => 'Finlandiya Üniversite',
                'url' => '/finlandiya-universite',
                'order' => 2
            ],
            [
                'title_kk' => 'Англиядағы университет',
                'title_ru' => 'Университет в Англии',
                'title_en' => 'University in England',
                'title_tr' => 'İngiltere\'de Üniversite',
                'url' => '/ingilterede-universite',
                'order' => 3
            ],
            [
                'title_kk' => 'Германия университеті',
                'title_ru' => 'Университет Германии',
                'title_en' => 'Germany University',
                'title_tr' => 'Almanya Üniversite',
                'url' => '/almanya-universite',
                'order' => 4
            ],
        ];

        foreach ($universiteItems as $itemData) {
            $menuItem = MenuItem::updateOrCreate(
                [
                    'menu_id' => $footerMenu->id,
                    'parent_id' => $universite->id,
                    'url' => $itemData['url'],
                ],
                [
                    'order' => $itemData['order'],
                    'is_active' => true,
                ]
            );

            MenuItemTranslation::updateOrCreate(
                ['menu_item_id' => $menuItem->id, 'language_id' => $kazakh->id],
                ['title' => $itemData['title_kk']]
            );
            MenuItemTranslation::updateOrCreate(
                ['menu_item_id' => $menuItem->id, 'language_id' => $russian->id],
                ['title' => $itemData['title_ru']]
            );
            MenuItemTranslation::updateOrCreate(
                ['menu_item_id' => $menuItem->id, 'language_id' => $english->id],
                ['title' => $itemData['title_en']]
            );
            MenuItemTranslation::updateOrCreate(
                ['menu_item_id' => $menuItem->id, 'language_id' => $turkish->id],
                ['title' => $itemData['title_tr']]
            );
        }

        // Dil Okulları
        $dilOkullari = MenuItem::updateOrCreate(
            [
                'menu_id' => $footerMenu->id,
                'url' => '#',
            ],
            [
                'order' => 3,
                'is_active' => true,
            ]
        );

        MenuItemTranslation::updateOrCreate(
            ['menu_item_id' => $dilOkullari->id, 'language_id' => $kazakh->id],
            ['title' => 'Тіл мектептері']
        );
        MenuItemTranslation::updateOrCreate(
            ['menu_item_id' => $dilOkullari->id, 'language_id' => $russian->id],
            ['title' => 'Языковые школы']
        );
        MenuItemTranslation::updateOrCreate(
            ['menu_item_id' => $dilOkullari->id, 'language_id' => $english->id],
            ['title' => 'Language Schools']
        );
        MenuItemTranslation::updateOrCreate(
            ['menu_item_id' => $dilOkullari->id, 'language_id' => $turkish->id],
            ['title' => 'Dil Okulları']
        );

        $dilOkullariItems = [
            [
                'title_kk' => 'Ағылшын тілін оқыту',
                'title_ru' => 'Обучение английскому языку',
                'title_en' => 'English Language Education',
                'title_tr' => 'İngiltere Dil Eğitimi',
                'url' => '/ingiltere-dil-egitimi',
                'order' => 1
            ],
            [
                'title_kk' => 'Финляндия тілін оқыту',
                'title_ru' => 'Обучение финскому языку',
                'title_en' => 'Finnish Language Education',
                'title_tr' => 'Finlandiya Dil Eğitimi',
                'url' => '/finlandiya-dil-egitimi',
                'order' => 2
            ],
        ];

        foreach ($dilOkullariItems as $itemData) {
            $menuItem = MenuItem::updateOrCreate(
                [
                    'menu_id' => $footerMenu->id,
                    'parent_id' => $dilOkullari->id,
                    'url' => $itemData['url'],
                ],
                [
                    'order' => $itemData['order'],
                    'is_active' => true,
                ]
            );

            MenuItemTranslation::updateOrCreate(
                ['menu_item_id' => $menuItem->id, 'language_id' => $kazakh->id],
                ['title' => $itemData['title_kk']]
            );
            MenuItemTranslation::updateOrCreate(
                ['menu_item_id' => $menuItem->id, 'language_id' => $russian->id],
                ['title' => $itemData['title_ru']]
            );
            MenuItemTranslation::updateOrCreate(
                ['menu_item_id' => $menuItem->id, 'language_id' => $english->id],
                ['title' => $itemData['title_en']]
            );
            MenuItemTranslation::updateOrCreate(
                ['menu_item_id' => $menuItem->id, 'language_id' => $turkish->id],
                ['title' => $itemData['title_tr']]
            );
        }

        // 5. Site Ayarları (çok dilli footer metinleri)
        $settings = [
            'site_title' => 'AKAĞİTİM - Білім беру және кеңес беру қызметтері',
            'site_description' => 'Шетелде білім алу және кеңес беру қызметтері. Мұғалімдік тәсілмен әлемді зерттеу.',
            'site_keywords' => 'шетелде білім, тіл мектебі, университет, кеңес, білім беру',
            'contact_email' => 'info@akaegitim.com',
            'contact_phone' => '+7 777 123 45 67',
            'contact_address' => 'Алматы, Қазақстан',
            'contact_whatsapp' => '+7 777 123 45 67',
            'social_facebook' => 'https://facebook.com/akaegitim',
            'social_instagram' => 'https://instagram.com/aka_egitim',
            'social_twitter' => 'https://twitter.com/akaegitim',
            'social_linkedin' => 'https://linkedin.com/company/akaegitim',
            'social_youtube' => 'https://youtube.com/akaegitim',
            // Footer metinleri - Kazakça (ana dil)
            'footer_text_kk' => 'AKA\'да білім беруге байланысты әрбір саяхат мұғалімнің қатысуымен басталады және мұғалімнің қатысуымен аяқталады. Шетелде білім алу және кеңес беру қызметтерімізбен армандаған білімді іске асырыңыз.',
            'footer_copyright_kk' => '© 2024 Айхан Коркмаз Білім беру және кеңес беру. Барлық құқықтар қорғалған.',
            // Footer metinleri - Rusça
            'footer_text_ru' => 'В AKA каждое путешествие в образовании начинается с участия учителя и заканчивается с участием учителя. Реализуйте образование своей мечты с нашими услугами по обучению за рубежом и консультированию.',
            'footer_copyright_ru' => '© 2024 Айхан Коркмаз Образование и консультирование. Все права защищены.',
            // Footer metinleri - İngilizce
            'footer_text_en' => 'At AKA, every journey in education begins with a teacher\'s involvement and ends with a teacher\'s involvement. Realize your dream education with our overseas education and consulting services.',
            'footer_copyright_en' => '© 2024 Ayhan Korkmaz Education and Consulting. All rights reserved.',
            // Footer metinleri - Türkçe
            'footer_text_tr' => 'AKA\'da eğitime dair her yolculuk bir öğretmen eşliğinde başlar ve öğretmen eşliğinde tamamlanır. Yurt dışı eğitim ve danışmanlık hizmetlerimizle hayallerinizdeki eğitimi gerçekleştirin.',
            'footer_copyright_tr' => '© 2024 Ayhan Korkmaz Eğitim ve Danışmanlık. Tüm hakları saklıdır.',
            
            // Banner CTA Section - Kazakça
            'banner_cta_pill_kk' => 'Кәсіби кеңес',
            'banner_cta_title_kk' => 'Армандаған біліміңіз',
            'banner_cta_title_span_kk' => 'Бір қадам қашықтықта',
            'banner_cta_description_kk' => 'AKA Білім кәсіби кеңесшілерімізбен кездесіңіз және сізге арналған шетелде білім алу жоспарыңызды құрайық.',
            'banner_cta_button_kk' => 'Дереу өтініш беріңіз',
            
            // Banner CTA Section - Rusça
            'banner_cta_pill_ru' => 'Профессиональное консультирование',
            'banner_cta_title_ru' => 'Образование вашей мечты',
            'banner_cta_title_span_ru' => 'В одном шаге',
            'banner_cta_description_ru' => 'Встретьтесь с нашими профессиональными консультантами AKA Education и создадим индивидуальный план обучения за рубежом.',
            'banner_cta_button_ru' => 'Подать заявку сейчас',
            
            // Banner CTA Section - İngilizce
            'banner_cta_pill_en' => 'Professional Consulting',
            'banner_cta_title_en' => 'Your Dream Education',
            'banner_cta_title_span_en' => 'One Step Away',
            'banner_cta_description_en' => 'Meet with our professional consultants at AKA Education and let\'s create your personalized overseas education plan.',
            'banner_cta_button_en' => 'Apply Now',
            
            // Banner CTA Section - Türkçe
            'banner_cta_pill_tr' => 'Profesyonel Danışmanlık',
            'banner_cta_title_tr' => 'Hayalinizdeki Eğitim',
            'banner_cta_title_span_tr' => 'Bir Adım Uzağınızda',
            'banner_cta_description_tr' => 'Aka Eğitim profesyonel danışmanlarımızla görüşün ve size özel yurt dışı eğitim planınızı oluşturalım.',
            'banner_cta_button_tr' => 'Hemen Başvur',
            
            // Values Section - Kazakça
            'values_title_kk' => 'Біздің құндылықтарымыз',
            'values_azim_title_kk' => 'Азаматтық',
            'values_azim_desc_kk' => 'Мақсатқа жету жолында жоспарлы қозғаламыз, процестің барлық кезеңінде сізбен бірге боламыз.',
            'values_kararlilik_title_kk' => 'Белсенділік',
            'values_kararlilik_desc_kk' => 'Бағдарлама таңдау, өтініш және виза қадамдарын тәртіппен басқарамыз.',
            'values_ayricalik_title_kk' => 'Артықшылық',
            'values_ayricalik_desc_kk' => 'Жекелендірілген кеңес, анық байланыс және жылдам жауап.',
            
            // Values Section - Rusça
            'values_title_ru' => 'Наши ценности',
            'values_azim_title_ru' => 'Упорство',
            'values_azim_desc_ru' => 'Мы движемся планомерно к цели и остаемся с вами на протяжении всего процесса.',
            'values_kararlilik_title_ru' => 'Решительность',
            'values_kararlilik_desc_ru' => 'Мы дисциплинированно управляем выбором программы, заявкой и шагами по визе.',
            'values_ayricalik_title_ru' => 'Преимущество',
            'values_ayricalik_desc_ru' => 'Персонализированное консультирование, четкое общение и быстрый ответ.',
            
            // Values Section - İngilizce
            'values_title_en' => 'Our Values',
            'values_azim_title_en' => 'Perseverance',
            'values_azim_desc_en' => 'We move forward with a plan towards the goal and stay with you throughout the process.',
            'values_kararlilik_title_en' => 'Determination',
            'values_kararlilik_desc_en' => 'We manage program selection, application and visa steps with discipline.',
            'values_ayricalik_title_en' => 'Privilege',
            'values_ayricalik_desc_en' => 'Personalized consulting, clear communication and quick response.',
            
            // Values Section - Türkçe
            'values_title_tr' => 'Değerlerimiz',
            'values_azim_title_tr' => 'Azim',
            'values_azim_desc_tr' => 'Hedefe giden yolda planlı ilerler, süreç boyunca yanında oluruz.',
            'values_kararlilik_title_tr' => 'Kararlılık',
            'values_kararlilik_desc_tr' => 'Program seçimi, başvuru ve vize adımlarını disiplinle yönetiriz.',
            'values_ayricalik_title_tr' => 'Ayrıcalık',
            'values_ayricalik_desc_tr' => 'Kişiselleştirilmiş danışmanlık, net iletişim ve hızlı geri dönüş.',
            
            // Why Section - Kazakça
            'why_title_kk' => 'Неге AKA Білім?',
            'why_description_kk' => 'AKA Білім шетелде білім берудің орталығына "Мұғалім жетекшілігі" қояды. Студентіңіздің шетелде білім алу саяхатына отбасы мүшесінің шындығымен қарайды, үйіңізден әуежайға дейін кеңесші мұғалімі сізбен бірге қатысады.',
            'why_global_title_kk' => 'Жаһандық серіктес желіміз',
            'why_global_desc_kk' => 'Бекітілген мекеме желімізбен бағдарламаларды сенімді түрде салыстырамыз және ең қолайлы бағытты анықтаймыз.',
            'why_tracking_title_kk' => 'Студент болашақты бақылау',
            'why_tracking_desc_kk' => 'Өтініштен кейінгі процесте де сізбен бірге қаламыз; бейімделу және бақылау қадамдарын жоспарлаймыз.',
            
            // Why Section - Rusça
            'why_title_ru' => 'Почему AKA Education?',
            'why_description_ru' => 'AKA Education ставит "Руководство учителя" в центр зарубежного образования. С искренностью члена семьи смотрит на путешествие вашего студента за образованием за рубежом, консультант-учитель сопровождает вас от дома до аэропорта.',
            'why_global_title_ru' => 'Наша глобальная сеть партнеров',
            'why_global_desc_ru' => 'Мы безопасно сравниваем программы с нашей сетью утвержденных учреждений и определяем наиболее подходящий маршрут.',
            'why_tracking_title_ru' => 'Отслеживание будущего студента',
            'why_tracking_desc_ru' => 'Мы остаемся с вами и в процессе после подачи заявки; планируем шаги адаптации и отслеживания.',
            
            // Why Section - İngilizce
            'why_title_en' => 'Why AKA Education?',
            'why_description_en' => 'AKA Education places "Teacher Guidance" at the center of overseas education. Looks at your student\'s overseas education journey with the sincerity of a family member, the consultant teacher accompanies you from home to the airport.',
            'why_global_title_en' => 'Our Global Partner Network',
            'why_global_desc_en' => 'We safely compare programs with our network of approved institutions and determine the most suitable route.',
            'why_tracking_title_en' => 'Student Future Tracking',
            'why_tracking_desc_en' => 'We stay with you in the post-application process as well; we plan the steps of adaptation and tracking.',
            
            // Why Section - Türkçe
            'why_title_tr' => 'Neden AKA Eğitim?',
            'why_description_tr' => 'AKA Eğitim, yurtdışı eğitimin merkezine "Öğretmen Rehberliği" koyar. Öğrencinizin yurtdışı eğitim yolculuğuna bir aile ferdi içtenliği ile bakar, evinizden havalimanına danışman öğretmeni sizinle beraber eşlik eder.',
            'why_global_title_tr' => 'Global Partner Ağımız',
            'why_global_desc_tr' => 'Onaylı kurum ağımızla programları güvenle karşılaştırır, en uygun rotayı belirleriz.',
            'why_tracking_title_tr' => 'Öğrenci Gelecek Takibi',
            'why_tracking_desc_tr' => 'Başvuru sonrası süreçte de yanında kalır; adaptasyon ve takip adımlarını planlarız.',
            
            // Contact Section - Kazakça
            'contact_title_kk' => 'Шетелде білім алу саяхатыңызды бастаңыз',
            'contact_description_kk' => 'Ақпаратыңызды қалдырыңыз, кеңесшіміз сізге ең қысқа уақыт ішінде жауап береді.',
            'contact_personal_label_kk' => 'Жеке ақпарат',
            'contact_name_placeholder_kk' => 'Аты-жөніңіз',
            'contact_email_placeholder_kk' => 'Электрондық пошта мекенжайыңыз',
            'contact_phone_placeholder_kk' => 'Телефон нөміріңіз',
            'contact_birth_placeholder_kk' => 'Туған күніңіз',
            'contact_education_label_kk' => 'Білім беру таңдаулары',
            'contact_program_placeholder_kk' => 'Бағдарлама түрін таңдаңыз',
            'contact_language_placeholder_kk' => 'Тіл бағдарламасын таңдаңыз',
            'contact_message_label_kk' => 'Хабарламаңыз',
            'contact_message_placeholder_kk' => 'Хабарламаңызды осы жерге жазыңыз...',
            'contact_button_kk' => 'Тегін кеңес алыңыз',
            'contact_program_dil_kk' => 'Тіл білім беру',
            'contact_program_universite_kk' => 'Университет',
            'contact_program_yuksek_kk' => 'Магистратура',
            'contact_language_ingilizce_kk' => 'Ағылшын тілі',
            'contact_language_almanca_kk' => 'Неміс тілі',
            'contact_language_fransizca_kk' => 'Француз тілі',
            
            // Contact Section - Rusça
            'contact_title_ru' => 'Начните свое путешествие за образованием за рубежом',
            'contact_description_ru' => 'Оставьте свою информацию, наш консультант свяжется с вами в кратчайшие сроки.',
            'contact_personal_label_ru' => 'Личная информация',
            'contact_name_placeholder_ru' => 'Ваше имя и фамилия',
            'contact_email_placeholder_ru' => 'Ваш адрес электронной почты',
            'contact_phone_placeholder_ru' => 'Ваш номер телефона',
            'contact_birth_placeholder_ru' => 'Ваша дата рождения',
            'contact_education_label_ru' => 'Образовательные предпочтения',
            'contact_program_placeholder_ru' => 'Выберите тип программы',
            'contact_language_placeholder_ru' => 'Выберите языковую программу',
            'contact_message_label_ru' => 'Ваше сообщение',
            'contact_message_placeholder_ru' => 'Напишите ваше сообщение здесь...',
            'contact_button_ru' => 'Получить бесплатную консультацию',
            'contact_program_dil_ru' => 'Языковое образование',
            'contact_program_universite_ru' => 'Университет',
            'contact_program_yuksek_ru' => 'Магистратура',
            'contact_language_ingilizce_ru' => 'Английский язык',
            'contact_language_almanca_ru' => 'Немецкий язык',
            'contact_language_fransizca_ru' => 'Французский язык',
            
            // Contact Section - İngilizce
            'contact_title_en' => 'Start Your Overseas Education Journey',
            'contact_description_en' => 'Leave your information, our consultant will get back to you as soon as possible.',
            'contact_personal_label_en' => 'Personal Information',
            'contact_name_placeholder_en' => 'Your Name Surname',
            'contact_email_placeholder_en' => 'Your Email Address',
            'contact_phone_placeholder_en' => 'Your Phone Number',
            'contact_birth_placeholder_en' => 'Your Date of Birth',
            'contact_education_label_en' => 'Education Preferences',
            'contact_program_placeholder_en' => 'Select Program Type',
            'contact_language_placeholder_en' => 'Select Language Program',
            'contact_message_label_en' => 'Your Message',
            'contact_message_placeholder_en' => 'Write your message here...',
            'contact_button_en' => 'Get Free Consultation',
            'contact_program_dil_en' => 'Language Education',
            'contact_program_universite_en' => 'University',
            'contact_program_yuksek_en' => 'Master\'s Degree',
            'contact_language_ingilizce_en' => 'English',
            'contact_language_almanca_en' => 'German',
            'contact_language_fransizca_en' => 'French',
            
            // Contact Section - Türkçe
            'contact_title_tr' => 'Yurt Dışı Eğitim Yolculuğunuza Başlayın',
            'contact_description_tr' => 'Bilgilerinizi bırakın, danışmanımız size en kısa sürede dönüş yapsın.',
            'contact_personal_label_tr' => 'Kişisel Bilgiler',
            'contact_name_placeholder_tr' => 'Adınız Soyadınız',
            'contact_email_placeholder_tr' => 'E-posta Adresiniz',
            'contact_phone_placeholder_tr' => 'Telefon Numaranız',
            'contact_birth_placeholder_tr' => 'Doğum Tarihiniz',
            'contact_education_label_tr' => 'Eğitim Tercihleri',
            'contact_program_placeholder_tr' => 'Program Türü Seçiniz',
            'contact_language_placeholder_tr' => 'Dil Programı Seçiniz',
            'contact_message_label_tr' => 'Mesajınız',
            'contact_message_placeholder_tr' => 'Mesajınızı buraya yazın...',
            'contact_button_tr' => 'Ücretsiz Danışmanlık Alın',
            'contact_program_dil_tr' => 'Dil Eğitimi',
            'contact_program_universite_tr' => 'Üniversite',
            'contact_program_yuksek_tr' => 'Yüksek Lisans',
            'contact_language_ingilizce_tr' => 'İngilizce',
            'contact_language_almanca_tr' => 'Almanca',
            'contact_language_fransizca_tr' => 'Fransızca',
            
            // Features Section - Kazakça
            'features_free_title_kk' => '100% Тегін',
            'features_free_desc_kk' => 'Кеңес қызметі',
            'features_24h_title_kk' => '24 Сағат Ішінде',
            'features_24h_desc_kk' => 'Жауап',
            'features_expert_title_kk' => 'Сарапшы кеңесшілер',
            'features_expert_desc_kk' => 'Әр Елге Арналған',
            'features_global_title_kk' => 'Жаһандық желі',
            'features_global_desc_kk' => 'Бекітілген мекемелер',
            
            // Features Section - Rusça
            'features_free_title_ru' => '100% Бесплатно',
            'features_free_desc_ru' => 'Консультационная услуга',
            'features_24h_title_ru' => 'В течение 24 часов',
            'features_24h_desc_ru' => 'Ответ',
            'features_expert_title_ru' => 'Экспертные консультанты',
            'features_expert_desc_ru' => 'Для каждой страны',
            'features_global_title_ru' => 'Глобальная сеть',
            'features_global_desc_ru' => 'Утвержденные учреждения',
            
            // Features Section - İngilizce
            'features_free_title_en' => '100% Free',
            'features_free_desc_en' => 'Consulting Service',
            'features_24h_title_en' => 'Within 24 Hours',
            'features_24h_desc_en' => 'Response',
            'features_expert_title_en' => 'Expert Consultants',
            'features_expert_desc_en' => 'For Each Country',
            'features_global_title_en' => 'Global Network',
            'features_global_desc_en' => 'Approved Institutions',
            
            // Features Section - Türkçe
            'features_free_title_tr' => '100% Ücretsiz',
            'features_free_desc_tr' => 'Danışmanlık Hizmeti',
            'features_24h_title_tr' => '24 Saat İçinde',
            'features_24h_desc_tr' => 'Geri Dönüş',
            'features_expert_title_tr' => 'Uzman Danışmanlar',
            'features_expert_desc_tr' => 'Her Ülke İçin',
            'features_global_title_tr' => 'Global Ağ',
            'features_global_desc_tr' => 'Onaylı Kurumlar',
            
            // Stats Section - Kazakça
            'stats_title_kk' => 'Бізбен жол жүруге дайынсыз ба?',
            'stats_description_kk' => 'Бүкіл әлем бойынша кеңселеріміз және тәжірибелі өкілдеріміз сіздерге ең жақсы қызмет көрсетуге дайын. Картадағы елдерді басу арқылы өкілдіктерімізді көре аласыз.',
            'stats_countries_label_kk' => 'Елде Кеңсеміз',
            'stats_offices_label_kk' => 'Тәжірибелі Өкіл',
            'stats_support_label_kk' => 'Қолдау Желісі',
            'stats_support_desc_kk' => 'Кеңесшілеріміз мақсатты елге сәйкес процесті жоспарлайды.',
            'stats_button_kk' => 'Толық Ақпарат Алыңыз',
            
            // Stats Section - Rusça
            'stats_title_ru' => 'Готовы ли вы идти по пути с нами?',
            'stats_description_ru' => 'Наши офисы по всему миру и опытные представители готовы предоставить вам лучший сервис. Вы можете увидеть наши представительства, нажав на страны на карте.',
            'stats_countries_label_ru' => 'Офисов в странах',
            'stats_offices_label_ru' => 'Опытных представителей',
            'stats_support_label_ru' => 'Линия поддержки',
            'stats_support_desc_ru' => 'Наши консультанты планируют процесс в соответствии с целевой страной.',
            'stats_button_ru' => 'Получить подробную информацию',
            
            // Stats Section - İngilizce
            'stats_title_en' => 'Are You Ready to Walk the Path with Us?',
            'stats_description_en' => 'Our offices worldwide and experienced representatives are ready to provide you with the best service. You can see our representative offices by clicking on the countries on the map.',
            'stats_countries_label_en' => 'Offices in Countries',
            'stats_offices_label_en' => 'Experienced Representatives',
            'stats_support_label_en' => 'Support Line',
            'stats_support_desc_en' => 'Our consultants plan the process according to the target country.',
            'stats_button_en' => 'Get Detailed Information',
            
            // Stats Section - Türkçe
            'stats_title_tr' => 'Bizimle Yol Yürümeye Var Mısınız?',
            'stats_description_tr' => 'Dünya genelinde ofislerimiz ve deneyimli temsilcilerimiz sizlere en iyi hizmeti sunmak için hazır. Harita üzerinde ülkelere tıklayarak temsilciliklerimizi görebilirsiniz.',
            'stats_countries_label_tr' => 'Ülkede Ofisimiz',
            'stats_offices_label_tr' => 'Deneyimli Temsilci',
            'stats_support_label_tr' => 'Destek Hattı',
            'stats_support_desc_tr' => 'Danışmanlarımız hedef ülkeye göre süreç planı çıkarır.',
            'stats_button_tr' => 'Detaylı Bilgi Alın',
            
            // Instagram Section - Kazakça
            'instagram_title_kk' => 'Instagram Бөлісулері',
            'instagram_button_kk' => '@aka_egitim',
            
            // Instagram Section - Rusça
            'instagram_title_ru' => 'Публикации в Instagram',
            'instagram_button_ru' => '@aka_egitim',
            
            // Instagram Section - İngilizce
            'instagram_title_en' => 'Instagram Posts',
            'instagram_button_en' => '@aka_egitim',
            
            // Instagram Section - Türkçe
            'instagram_title_tr' => 'Instagram Paylaşımları',
            'instagram_button_tr' => '@aka_egitim',
        ];

        foreach ($settings as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }
    }
}
