<?php

namespace App\Filament\Resources\PageResource\Pages;

use App\Filament\Resources\PageResource;
use App\Models\PageTranslation;
use Filament\Resources\Pages\CreateRecord;

class CreatePage extends CreateRecord
{
    protected static string $resource = PageResource::class;

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
                PageTranslation::create([
                    'page_id' => $this->record->id,
                    'language_id' => $languageId,
                    'title' => $translationData['title'],
                    'slug' => $translationData['slug'] ?? \Illuminate\Support\Str::slug($translationData['title']),
                    'content' => $translationData['content'] ?? '',
                    'seo_title' => $translationData['seo_title'] ?? null,
                    'seo_description' => $translationData['seo_description'] ?? null,
                ]);
            }
        }
    }
}
