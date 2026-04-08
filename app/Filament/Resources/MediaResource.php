<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MediaResource\Pages;
use App\Models\Media;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class MediaResource extends Resource
{
    protected static ?string $model = Media::class;
    protected static ?string $navigationIcon  = 'heroicon-o-photo';
    protected static ?string $navigationGroup = 'Médias & Publications';
    protected static ?string $modelLabel      = 'Média';
    protected static ?string $pluralModelLabel= 'Médias';
    protected static ?int    $navigationSort  = 1;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make()->schema([
                Forms\Components\TextInput::make('title')->label('Titre')->required(),
                Forms\Components\Select::make('type')
                    ->label('Type')
                    ->options([
                        'photo'    => 'Photo',
                        'video'    => 'Vidéo',
                        'audio'    => 'Audio',
                        'creation' => 'Création d\'enfant',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('album')->label('Album / Catégorie'),
                Forms\Components\Textarea::make('description')->label('Description')->rows(2),
                Forms\Components\TextInput::make('alt_text')->label('Texte alternatif (accessibilité)'),
                Forms\Components\TextInput::make('file_url')
                    ->label('URL externe (YouTube, etc.)')
                    ->url()
                    ->helperText('Remplir seulement pour les vidéos externes'),
                Forms\Components\FileUpload::make('file_path')
                    ->label('Fichier média')
                    ->image()
                    ->directory('medias')
                    ->maxSize(10240),
                Forms\Components\FileUpload::make('thumbnail')
                    ->label('Miniature')
                    ->image()
                    ->directory('medias/thumbnails'),
                Forms\Components\TextInput::make('order')->label('Ordre d\'affichage')->numeric()->default(0),
                Forms\Components\Toggle::make('is_featured')->label('Mis en avant')->default(false),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('file_path')->label('Aperçu')->width(80)->height(60),
                Tables\Columns\TextColumn::make('title')->label('Titre')->searchable()->sortable(),
                Tables\Columns\BadgeColumn::make('type')
                    ->label('Type')
                    ->colors([
                        'primary'   => 'photo',
                        'success'   => 'video',
                        'warning'   => 'audio',
                        'secondary' => 'creation',
                    ]),
                Tables\Columns\TextColumn::make('album')->label('Album'),
                Tables\Columns\IconColumn::make('is_featured')->label('Mis en avant')->boolean(),
                Tables\Columns\TextColumn::make('created_at')->label('Ajouté le')->date('d/m/Y'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->options(['photo' => 'Photo', 'video' => 'Vidéo', 'audio' => 'Audio', 'creation' => 'Création']),
            ])
            ->actions([Tables\Actions\EditAction::make(), Tables\Actions\DeleteAction::make()])
            ->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListMedias::route('/'),
            'create' => Pages\CreateMedia::route('/create'),
            'edit'   => Pages\EditMedia::route('/{record}/edit'),
        ];
    }
}
