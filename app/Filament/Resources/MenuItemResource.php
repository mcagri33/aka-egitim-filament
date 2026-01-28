<?php

namespace App\Filament\Resources;

use App\Filament\Resources\Concerns\HasAuthorization;
use App\Filament\Resources\MenuItemResource\Pages;
use App\Models\Language;
use App\Models\Menu;
use App\Models\MenuItem;
use App\Models\MenuItemTranslation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class MenuItemResource extends Resource
{
    use HasAuthorization;

    protected static ?string $model = MenuItem::class;

    protected static ?string $navigationIcon = 'heroicon-o-link';

    protected static string $permissionPrefix = 'menu-items';

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
                ]);
        }

        return $form
            ->schema([
                Forms\Components\Section::make('Genel Bilgiler')
                    ->schema([
                        Forms\Components\Select::make('menu_id')
                            ->label('Menü')
                            ->relationship('menu', 'name')
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(fn (Forms\Set $set) => $set('parent_id', null)),
                        Forms\Components\Select::make('parent_id')
                            ->label('Üst Menü')
                            ->options(function ($get) {
                                $menuId = $get('menu_id');
                                if (!$menuId) {
                                    return [];
                                }
                                $defaultLanguage = Language::where('is_default', true)->first();
                                return MenuItem::where('menu_id', $menuId)
                                    ->get()
                                    ->mapWithKeys(function ($item) use ($defaultLanguage) {
                                        $title = $item->translation($defaultLanguage?->id)?->title ?? "ID: {$item->id}";
                                        return [$item->id => $title];
                                    });
                            })
                            ->searchable()
                            ->preload(),
                        Forms\Components\TextInput::make('url')
                            ->label('URL')
                            ->url(),
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
                Tables\Columns\TextColumn::make('menu.name')
                    ->label('Menü')
                    ->sortable(),
                Tables\Columns\TextColumn::make('title')
                    ->label('Başlık')
                    ->getStateUsing(function (MenuItem $record) use ($defaultLanguage) {
                        if ($defaultLanguage) {
                            $translation = $record->translation($defaultLanguage->id);
                            return $translation?->title ?? '-';
                        }
                        return '-';
                    })
                    ->searchable(),
                Tables\Columns\TextColumn::make('url')
                    ->label('URL')
                    ->limit(30),
                Tables\Columns\TextColumn::make('order')
                    ->label('Sıra')
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->visible(fn (MenuItem $record) => static::canEdit($record)),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->visible(fn () => static::canDelete(new MenuItem())),
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
            'index' => Pages\ListMenuItems::route('/'),
            'create' => Pages\CreateMenuItem::route('/create'),
            'edit' => Pages\EditMenuItem::route('/{record}/edit'),
        ];
    }
}
