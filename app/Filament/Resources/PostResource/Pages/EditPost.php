<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Filament\Resources\PostResource;
use App\Models\PostTranslation;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPost extends EditRecord
{
    protected static string $resource = PostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $translations = PostTranslation::where('post_id', $this->record->id)->get();
        $data['translations'] = [];

        foreach ($translations as $translation) {
            $data['translations'][$translation->language_id] = [
                'title' => $translation->title,
                'slug' => $translation->slug,
                'content' => $translation->content,
                'seo_title' => $translation->seo_title,
                'seo_description' => $translation->seo_description,
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
            PostTranslation::updateOrCreate(
                [
                    'post_id' => $this->record->id,
                    'language_id' => $languageId,
                ],
                [
                    'title' => $translationData['title'] ?? '',
                    'slug' => $translationData['slug'] ?? \Illuminate\Support\Str::slug($translationData['title'] ?? ''),
                    'content' => $translationData['content'] ?? '',
                    'seo_title' => $translationData['seo_title'] ?? null,
                    'seo_description' => $translationData['seo_description'] ?? null,
                ]
            );
        }
    }
}
