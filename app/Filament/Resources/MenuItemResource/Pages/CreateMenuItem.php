<?php

namespace App\Filament\Resources\MenuItemResource\Pages;

use App\Filament\Resources\MenuItemResource;
use App\Models\MenuItemTranslation;
use Filament\Resources\Pages\CreateRecord;

class CreateMenuItem extends CreateRecord
{
    protected static string $resource = MenuItemResource::class;

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
                MenuItemTranslation::create([
                    'menu_item_id' => $this->record->id,
                    'language_id' => $languageId,
                    'title' => $translationData['title'],
                ]);
            }
        }
    }
}
