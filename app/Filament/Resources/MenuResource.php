<?php

namespace App\Filament\Resources;

use App\Filament\Resources\Concerns\HasAuthorization;
use App\Filament\Resources\MenuResource\Pages;
use App\Models\Menu;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class MenuResource extends Resource
{
    use HasAuthorization;

    protected static ?string $model = Menu::class;

    protected static ?string $navigationIcon = 'heroicon-o-bars-3';

    protected static string $permissionPrefix = 'menus';

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
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Ad')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('location')
                    ->label('Konum')
                    ->options([
                        'header' => 'Header',
                        'footer' => 'Footer',
                        'mobile' => 'Mobile',
                    ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Ad')
                    ->searchable(),
                Tables\Columns\TextColumn::make('location')
                    ->label('Konum')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'header' => 'success',
                        'footer' => 'info',
                        'mobile' => 'warning',
                        default => 'gray',
                    }),
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
                    ->visible(fn (Menu $record) => static::canEdit($record)),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->visible(fn () => static::canDelete(new Menu())),
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
            'index' => Pages\ListMenus::route('/'),
            'create' => Pages\CreateMenu::route('/create'),
            'edit' => Pages\EditMenu::route('/{record}/edit'),
        ];
    }
}
