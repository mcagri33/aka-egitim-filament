<?php

namespace App\Filament\Resources;

use App\Filament\Resources\Concerns\HasAuthorization;
use App\Filament\Resources\CountryResource\Pages;
use App\Models\Country;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class CountryResource extends Resource
{
    use HasAuthorization;

    protected static ?string $model = Country::class;

    protected static ?string $navigationIcon = 'heroicon-o-globe-alt';

    protected static string $permissionPrefix = 'countries';

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
                Forms\Components\TextInput::make('code')
                    ->label('Kod')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('TR, UK, DE'),
                Forms\Components\Toggle::make('is_active')
                    ->label('Aktif')
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('code')
                    ->label('Kod')
                    ->searchable()
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
                    ->visible(fn (Country $record) => static::canEdit($record)),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->visible(fn () => static::canDelete(new Country())),
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
            'index' => Pages\ListCountries::route('/'),
            'create' => Pages\CreateCountry::route('/create'),
            'edit' => Pages\EditCountry::route('/{record}/edit'),
        ];
    }
}
