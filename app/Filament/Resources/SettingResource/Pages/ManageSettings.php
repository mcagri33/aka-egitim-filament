<?php

namespace App\Filament\Resources\SettingResource\Pages;

use App\Filament\Resources\SettingResource;
use App\Models\Language;
use App\Models\Setting;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\Page;

class ManageSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string $resource = SettingResource::class;

    protected static string $view = 'filament.resources.setting-resource.pages.manage-settings';

    protected static ?string $title = 'Ayarlar';

    public ?array $data = [];

    public function mount(): void
    {
        $this->loadSettings();
    }

    protected function loadSettings(): void
    {
        $settings = Setting::all()->pluck('value', 'key')->toArray();
        $this->form->fill($settings);
    }

    public function form(Form $form): Form
    {
        $languages = Language::where('is_active', true)->get();
        $footerTabs = [];

        foreach ($languages as $language) {
            $footerTabs[] = Forms\Components\Tabs\Tab::make($language->name)
                ->schema([
                    Forms\Components\Textarea::make("footer_text_{$language->code}")
                        ->label('Footer Metni')
                        ->rows(4),
                    Forms\Components\Textarea::make("footer_copyright_{$language->code}")
                        ->label('Copyright Metni')
                        ->rows(2),
                ]);
        }

        return $form
            ->schema([
                Section::make('Genel Ayarlar')
                    ->schema([
                        Forms\Components\TextInput::make('site_title')
                            ->label('Site Başlığı')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('site_description')
                            ->label('Site Açıklaması')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('site_keywords')
                            ->label('Site Anahtar Kelimeleri')
                            ->maxLength(255)
                            ->helperText('Virgülle ayrılmış'),
                        Forms\Components\FileUpload::make('site_logo')
                            ->label('Site Logosu')
                            ->image()
                            ->directory('settings'),
                    ])
                    ->columns(2),

                Section::make('İletişim Bilgileri')
                    ->schema([
                        Forms\Components\TextInput::make('contact_email')
                            ->label('E-posta')
                            ->email()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('contact_phone')
                            ->label('Telefon')
                            ->tel()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('contact_address')
                            ->label('Adres')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('contact_whatsapp')
                            ->label('WhatsApp')
                            ->maxLength(255),
                    ])
                    ->columns(2),

                Section::make('Sosyal Medya')
                    ->schema([
                        Forms\Components\TextInput::make('social_facebook')
                            ->label('Facebook URL')
                            ->url()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('social_twitter')
                            ->label('Twitter URL')
                            ->url()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('social_instagram')
                            ->label('Instagram URL')
                            ->url()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('social_linkedin')
                            ->label('LinkedIn URL')
                            ->url()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('social_youtube')
                            ->label('YouTube URL')
                            ->url()
                            ->maxLength(255),
                    ])
                    ->columns(2),

                Section::make('Footer')
                    ->schema([
                        Tabs::make('footer_translations')
                            ->tabs($footerTabs)
                            ->columnSpanFull(),
                    ]),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();

        foreach ($data as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        Notification::make()
            ->title('Ayarlar başarıyla kaydedildi')
            ->success()
            ->send();

        $this->loadSettings();
    }

    protected function getHeaderActions(): array
    {
        return [];
    }

    protected function getFormActions(): array
    {
        return [
            \Filament\Actions\Action::make('save')
                ->label('Kaydet')
                ->submit('save')
                ->color('primary'),
        ];
    }
}
