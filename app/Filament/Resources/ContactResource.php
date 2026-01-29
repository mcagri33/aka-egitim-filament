<?php

namespace App\Filament\Resources;

use App\Filament\Resources\Concerns\HasAuthorization;
use App\Filament\Resources\ContactResource\Pages;
use App\Filament\Resources\ContactResource\RelationManagers;
use App\Models\Contact;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ContactResource extends Resource
{
    use HasAuthorization;

    protected static ?string $model = Contact::class;

    protected static ?string $navigationIcon = 'heroicon-o-envelope';

    protected static ?string $navigationLabel = 'İletişim Formları';

    protected static string $permissionPrefix = 'contacts';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Kişisel Bilgiler')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Ad Soyad')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('email')
                            ->label('E-posta')
                            ->email()
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('phone')
                            ->label('Telefon')
                            ->required()
                            ->maxLength(20),
                        Forms\Components\DatePicker::make('birth_date')
                            ->label('Doğum Tarihi')
                            ->required()
                            ->displayFormat('d.m.Y'),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Eğitim Tercihleri')
                    ->schema([
                        Forms\Components\TextInput::make('program_type')
                            ->label('Program Türü')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('language')
                            ->label('Dil Programı')
                            ->required()
                            ->maxLength(255),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Mesaj')
                    ->schema([
                        Forms\Components\Textarea::make('message')
                            ->label('Mesaj')
                            ->rows(4)
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Durum')
                    ->schema([
                        Forms\Components\Toggle::make('is_read')
                            ->label('Okundu')
                            ->default(false),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Ad Soyad')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('E-posta')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('phone')
                    ->label('Telefon')
                    ->searchable(),
                Tables\Columns\TextColumn::make('program_type')
                    ->label('Program Türü')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('language')
                    ->label('Dil Programı')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_read')
                    ->label('Okundu')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Gönderim Tarihi')
                    ->dateTime('d.m.Y H:i')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_read')
                    ->label('Okundu')
                    ->placeholder('Tümü')
                    ->trueLabel('Okundu')
                    ->falseLabel('Okunmadı'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make()
                    ->visible(fn (Model $record) => static::canEdit($record)),
                Tables\Actions\Action::make('markAsRead')
                    ->label('Okundu İşaretle')
                    ->icon('heroicon-o-check')
                    ->color('success')
                    ->visible(fn (Model $record) => !$record->is_read && static::canEdit($record))
                    ->action(function (Model $record) {
                        $record->update(['is_read' => true]);
                    })
                    ->requiresConfirmation(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->visible(fn () => static::canDeleteAny()),
                    Tables\Actions\BulkAction::make('markAsRead')
                        ->label('Okundu İşaretle')
                        ->icon('heroicon-o-check')
                        ->color('success')
                        ->action(function ($records) {
                            $records->each->update(['is_read' => true]);
                        })
                        ->requiresConfirmation(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
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
            'index' => Pages\ListContacts::route('/'),
            'edit' => Pages\EditContact::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        return static::checkPermission(static::$permissionPrefix . '.view');
    }

    public static function canCreate(): bool
    {
        return false; // İletişim formları sadece web sitesinden oluşturulabilir
    }

    public static function canEdit(Model $record): bool
    {
        return static::checkPermission(static::$permissionPrefix . '.update');
    }

    public static function canDelete(Model $record): bool
    {
        return static::checkPermission(static::$permissionPrefix . '.delete');
    }

    public static function canDeleteAny(): bool
    {
        return static::checkPermission(static::$permissionPrefix . '.delete');
    }

    public static function shouldRegisterNavigation(): bool
    {
        return static::canViewAny();
    }
}
