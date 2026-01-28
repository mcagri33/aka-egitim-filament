<?php

namespace App\Filament\Resources;

use App\Filament\Resources\Concerns\HasAuthorization;
use App\Filament\Resources\PostResource\Pages;
use App\Models\Language;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PostResource extends Resource
{
    use HasAuthorization;

    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    protected static string $permissionPrefix = 'posts';

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
                        ->required(fn ($get) => $language->is_default)
                        ->live(onBlur: true)
                        ->afterStateUpdated(function ($state, Forms\Set $set, $get, $languageId) use ($language) {
                            if ($language->is_default) {
                                $set("translations.{$language->id}.slug", Str::slug($state));
                            }
                        }),
                    Forms\Components\TextInput::make("translations.{$language->id}.slug")
                        ->label('Slug')
                        ->required(fn ($get) => $language->is_default)
                        ->unique(ignoreRecord: true),
                    Forms\Components\RichEditor::make("translations.{$language->id}.content")
                        ->label('İçerik')
                        ->required(fn ($get) => $language->is_default)
                        ->columnSpanFull(),
                    Forms\Components\TextInput::make("translations.{$language->id}.seo_title")
                        ->label('SEO Başlık')
                        ->maxLength(255),
                    Forms\Components\Textarea::make("translations.{$language->id}.seo_description")
                        ->label('SEO Açıklama')
                        ->rows(3),
                ]);
        }

        return $form
            ->schema([
                Forms\Components\Section::make('Genel Bilgiler')
                    ->schema([
                        Forms\Components\DateTimePicker::make('published_at')
                            ->label('Yayın Tarihi')
                            ->displayFormat('d.m.Y H:i'),
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
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),
                Tables\Columns\TextColumn::make('title')
                    ->label('Başlık')
                    ->getStateUsing(function (Post $record) use ($defaultLanguage) {
                        if ($defaultLanguage) {
                            $translation = $record->translation($defaultLanguage->id);
                            return $translation?->title ?? '-';
                        }
                        return '-';
                    })
                    ->searchable(),
                Tables\Columns\TextColumn::make('published_at')
                    ->label('Yayın Tarihi')
                    ->dateTime('d.m.Y H:i')
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
                    ->visible(fn (Post $record) => static::canEdit($record)),
                Tables\Actions\DeleteAction::make()
                    ->visible(fn (Post $record) => static::canDelete($record)),
                Tables\Actions\RestoreAction::make()
                    ->visible(fn (Post $record) => static::canDelete($record)),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->visible(fn () => static::canDelete(new Post())),
                    Tables\Actions\RestoreBulkAction::make()
                        ->visible(fn () => static::canDelete(new Post())),
                    Tables\Actions\ForceDeleteBulkAction::make()
                        ->visible(fn () => static::canDelete(new Post())),
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
