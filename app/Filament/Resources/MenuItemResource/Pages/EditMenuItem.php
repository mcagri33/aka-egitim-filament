<?php

namespace App\Filament\Resources\MenuItemResource\Pages;

use App\Filament\Resources\MenuItemResource;
use App\Models\MenuItemTranslation;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMenuItem extends EditRecord
{
    protected static string $resource = MenuItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $translations = MenuItemTranslation::where('menu_item_id', $this->record->id)->get();
        $data['translations'] = [];

        foreach ($translations as $translation) {
            $data['translations'][$translation->language_id] = [
                'title' => $translation->title,
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
            MenuItemTranslation::updateOrCreate(
                [
                    'menu_item_id' => $this->record->id,
                    'language_id' => $languageId,
                ],
                [
                    'title' => $translationData['title'] ?? '',
                ]
            );
        }
    }
}
