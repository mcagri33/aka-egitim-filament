<?php

namespace App\Filament\Resources\BannerResource\Pages;

use App\Filament\Resources\BannerResource;
use App\Models\BannerTranslation;
use Filament\Resources\Pages\CreateRecord;

class CreateBanner extends CreateRecord
{
    protected static string $resource = BannerResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $translations = $data['translations'] ?? [];
        unset($data['translations']);

        return $data;
    }

    protected function afterCreate(): void
    {
        $translations = $this->form->getState()['translations'] ?? [];
        
        foreach ($translations as $languageId => $translationData) {
            if (!empty($translationData['title'])) {
                BannerTranslation::create([
                    'banner_id' => $this->record->id,
                    'language_id' => $languageId,
                    'title' => $translationData['title'],
                    'description' => $translationData['description'] ?? null,
                    'button_text' => $translationData['button_text'] ?? null,
                    'button_url' => $translationData['button_url'] ?? null,
                ]);
            }
        }
    }
}
