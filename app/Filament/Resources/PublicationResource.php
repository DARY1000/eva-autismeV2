<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PublicationResource\Pages;
use App\Models\Publication;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class PublicationResource extends Resource
{
    protected static ?string $model = Publication::class;
    protected static ?string $navigationIcon  = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'Médias & Publications';
    protected static ?string $modelLabel      = 'Publication';
    protected static ?string $pluralModelLabel= 'Publications';
    protected static ?int    $navigationSort  = 2;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make()->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Titre')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn($state, $set) => $set('slug', Str::slug($state))),
                Forms\Components\TextInput::make('slug')
                    ->label('Slug URL')
                    ->required()
                    ->unique(ignoreRecord: true),
                Forms\Components\Select::make('category')
                    ->label('Catégorie')
                    ->options(['rapport' => 'Rapport', 'guide' => 'Guide Pratique', 'article' => 'Article', 'presentation' => 'Présentation'])
                    ->required(),
                Forms\Components\DatePicker::make('published_at')
                    ->label('Date de publication'),
                Forms\Components\Textarea::make('description')
                    ->label('Description')
                    ->rows(3)
                    ->columnSpanFull(),
                Forms\Components\FileUpload::make('cover_image')
                    ->label('Image de couverture')
                    ->image()
                    ->directory('publications/covers'),
                Forms\Components\FileUpload::make('file_path')
                    ->label('Fichier PDF')
                    ->acceptedFileTypes(['application/pdf'])
                    ->directory('publications/files')
                    ->maxSize(20480),
                Forms\Components\TextInput::make('file_url')
                    ->label('URL externe du document')
                    ->url(),
                Forms\Components\Toggle::make('is_featured')->label('Mis en avant'),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('cover_image')->label('')->width(60)->height(80),
                Tables\Columns\TextColumn::make('title')->label('Titre')->searchable()->sortable()->weight('bold'),
                Tables\Columns\BadgeColumn::make('category')
                    ->label('Catégorie')
                    ->colors(['primary' => 'rapport', 'success' => 'guide', 'warning' => 'article', 'secondary' => 'presentation']),
                Tables\Columns\TextColumn::make('download_count')->label('Téléchargements')->sortable(),
                Tables\Columns\IconColumn::make('is_featured')->label('Mis en avant')->boolean(),
                Tables\Columns\TextColumn::make('published_at')->label('Publié le')->date('d/m/Y')->sortable(),
            ])
            ->actions([Tables\Actions\EditAction::make(), Tables\Actions\DeleteAction::make()])
            ->defaultSort('published_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListPublications::route('/'),
            'create' => Pages\CreatePublication::route('/create'),
            'edit'   => Pages\EditPublication::route('/{record}/edit'),
        ];
    }
}
