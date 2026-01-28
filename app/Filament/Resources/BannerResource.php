<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BannerResource\Pages;
use App\Filament\Resources\Concerns\HasAuthorization;
use App\Models\Banner;
use App\Models\Language;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class BannerResource extends Resource
{
    use HasAuthorization;

    protected static ?string $model = Banner::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';

    protected static string $permissionPrefix = 'banners';

    public static function canViewAny(): bool
    {
        return static::checkPermission(static::$permissionPrefix . '.view');
    }

    public static function canCreate(): bool
    {
        return static::checkPermission(static::$permissionPrefix . '.create');
    }

    public static function canEdit(Model $record): bool
    {
        return static::checkPermission(static::$permissionPrefix . '.update');
    }

    public static function canDelete(Model $record): bool
    {
        return static::checkPermission(static::$permissionPrefix . '.delete');
    }

    public static function shouldRegisterNavigation(): bool
    {
        return static::checkPermission(static::$permissionPrefix . '.view');
    }

    public static function form(Form $form): Form
    {
        $languages = Language::where('is_active', true)->get();
        $tabs = [];

        foreach ($languages as $language) {
            $tabs[] = Forms\Components\Tabs\Tab::make($language->name)
                ->schema([
                    Forms\Components\TextInput::make("translations.{$language->id}.title")
                        ->label('Başlık')
                        ->required(fn ($get) => $language->is_default),
                    Forms\Components\Textarea::make("translations.{$language->id}.description")
                        ->label('Açıklama')
                        ->rows(3),
                    Forms\Components\TextInput::make("translations.{$language->id}.button_text")
                        ->label('Buton Metni'),
                    Forms\Components\TextInput::make("translations.{$language->id}.button_url")
                        ->label('Buton URL')
                        ->url(),
                ]);
        }

        return $form
            ->schema([
                Forms\Components\Section::make('Genel Bilgiler')
                    ->schema([
                        Forms\Components\FileUpload::make('image_path')
                            ->label('Görsel')
                            ->image()
                            ->directory('banners')
                            ->required(),
                        Forms\Components\TextInput::make('order')
                            ->label('Sıra')
                            ->numeric()
                            ->default(0)
                            ->required(),
                        Forms\Components\Toggle::make('is_active')
                            ->label('Aktif')
                            ->default(true),
                    ]),
                Forms\Components\Tabs::make('translations')
                    ->tabs($tabs)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        $defaultLanguage = Language::where('is_default', true)->first();

        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image_path')
                    ->label('Görsel'),
                Tables\Columns\TextColumn::make('title')
                    ->label('Başlık')
                    ->getStateUsing(function (Banner $record) use ($defaultLanguage) {
                        if ($defaultLanguage) {
                            $translation = $record->translation($defaultLanguage->id);
                            return $translation?->title ?? '-';
                        }
                        return '-';
                    })
                    ->searchable(),
                Tables\Columns\TextColumn::make('order')
                    ->label('Sıra')
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Oluşturulma')
                    ->dateTime('d.m.Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->visible(fn (Banner $record) => static::canEdit($record)),
                Tables\Actions\DeleteAction::make()
                    ->visible(fn (Banner $record) => static::canDelete($record)),
                Tables\Actions\RestoreAction::make()
                    ->visible(fn (Banner $record) => static::canDelete($record)),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->visible(fn () => static::canDelete(new Banner())),
                    Tables\Actions\RestoreBulkAction::make()
                        ->visible(fn () => static::canDelete(new Banner())),
                    Tables\Actions\ForceDeleteBulkAction::make()
                        ->visible(fn () => static::canDelete(new Banner())),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBanners::route('/'),
            'create' => Pages\CreateBanner::route('/create'),
            'edit' => Pages\EditBanner::route('/{record}/edit'),
        ];
    }
}
