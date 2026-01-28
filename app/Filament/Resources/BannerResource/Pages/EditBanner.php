<?php

namespace App\Filament\Resources\BannerResource\Pages;

use App\Filament\Resources\BannerResource;
use App\Models\BannerTranslation;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBanner extends EditRecord
{
    protected static string $resource = BannerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $translations = BannerTranslation::where('banner_id', $this->record->id)->get();
        $data['translations'] = [];

        foreach ($translations as $translation) {
            $data['translations'][$translation->language_id] = [
                'title' => $translation->title,
                'description' => $translation->description,
                'button_text' => $translation->button_text,
                'button_url' => $translation->button_url,
            ];
        }

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $translations = $data['translations'] ?? [];
        unset($data['translations']);

        return $data;
    }

    protected function afterSave(): void
    {
        $translations = $this->form->getState()['translations'] ?? [];
        
        foreach ($translations as $languageId => $translationData) {
            BannerTranslation::updateOrCreate(
                [
                    'banner_id' => $this->record->id,
                    'language_id' => $languageId,
                ],
                [
                    'title' => $translationData['title'] ?? '',
                    'description' => $translationData['description'] ?? null,
                    'button_text' => $translationData['button_text'] ?? null,
                    'button_url' => $translationData['button_url'] ?? null,
                ]
            );
        }
    }
}
