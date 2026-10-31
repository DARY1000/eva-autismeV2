<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ActivityResource\Pages;
use App\Models\Activity;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class ActivityResource extends Resource
{
    protected static ?string $model = Activity::class;
    protected static ?string $navigationIcon  = 'heroicon-o-flag';
    protected static ?string $navigationGroup = 'Nos Actions';
    protected static ?string $modelLabel      = 'Activité';
    protected static ?string $pluralModelLabel= 'Activités';
    protected static ?int    $navigationSort  = 0;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('L\'activité')->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Titre')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn($state, $set, $operation) => $operation === 'create' ? $set('slug', Str::slug($state)) : null),
                Forms\Components\TextInput::make('slug')
                    ->label('Adresse de la page')
                    ->required()
                    ->alphaDash()
                    ->unique(ignoreRecord: true),
                Forms\Components\Select::make('category')
                    ->label('Catégorie')
                    ->options(Activity::CATEGORIES)
                    ->required(),
                Forms\Components\TextInput::make('theme')
                    ->label('Thème')
                    ->maxLength(255),
                Forms\Components\Textarea::make('summary')
                    ->label('Résumé')
                    ->helperText('Deux ou trois phrases, affichées sur la liste des activités.')
                    ->rows(3)
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\RichEditor::make('content')
                    ->label('Compte rendu complet')
                    ->disableToolbarButtons(['attachFiles'])
                    ->columnSpanFull(),
            ])->columns(2),

            Forms\Components\Section::make('Date & lieu')->schema([
                Forms\Components\DatePicker::make('start_date')
                    ->label('Date de début')
                    ->helperText('Sert à classer l\'activité par année.')
                    ->required(),
                Forms\Components\DatePicker::make('end_date')
                    ->label('Date de fin')
                    ->afterOrEqual('start_date'),
                Forms\Components\TextInput::make('location')->label('Lieu'),
                Forms\Components\TextInput::make('organizer')->label('Organisateur / partenaires'),
            ])->columns(2),

            Forms\Components\Section::make('Photos & vidéo')->schema([
                Forms\Components\FileUpload::make('cover_image')
                    ->label('Photo principale')
                    ->helperText('Si vide, la première photo de la galerie est utilisée.')
                    ->image()
                    ->disk('public')
                    ->directory('activities')
                    ->imageResizeMode('contain')
                    ->imageResizeTargetWidth('1920')
                    ->maxSize(10240),
                Forms\Components\TextInput::make('video_url')
                    ->label('Lien de la vidéo (YouTube, Facebook…)')
                    ->url(),
                Forms\Components\FileUpload::make('gallery')
                    ->label('Galerie de photos')
                    ->helperText('Glissez plusieurs photos à la fois. Vous pouvez les réordonner.')
                    ->image()
                    ->multiple()
                    ->reorderable()
                    ->appendFiles()
                    ->panelLayout('grid')
                    ->disk('public')
                    ->directory('activities')
                    ->imageResizeMode('contain')
                    ->imageResizeTargetWidth('1920')
                    ->maxSize(10240)
                    ->maxFiles(60)
                    ->columnSpanFull(),
            ])->columns(2),

            Forms\Components\Section::make('Publication')->schema([
                Forms\Components\Toggle::make('is_published')
                    ->label('Visible sur le site')
                    ->default(true),
                Forms\Components\Toggle::make('is_featured')
                    ->label('Mettre en avant')
                    ->default(false),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('cover')->label('')->disk('public')->width(72)->height(48),
                Tables\Columns\TextColumn::make('title')->label('Titre')->searchable()->weight('bold')->limit(55),
                Tables\Columns\TextColumn::make('category')
                    ->label('Catégorie')
                    ->badge()
                    ->formatStateUsing(fn($state) => Activity::CATEGORIES[$state] ?? $state),
                Tables\Columns\TextColumn::make('start_date')->label('Date')->date('d/m/Y')->sortable(),
                Tables\Columns\TextColumn::make('location')->label('Lieu')->limit(30)->toggleable(),
                Tables\Columns\TextColumn::make('gallery')
                    ->label('Photos')
                    ->state(fn(Activity $r) => count($r->gallery ?? [])),
                Tables\Columns\IconColumn::make('is_published')->label('En ligne')->boolean(),
            ])
            ->groups([
                Tables\Grouping\Group::make('start_date')
                    ->label('Année')
                    ->getTitleFromRecordUsing(fn(Activity $r) => (string) $r->year)
                    ->getKeyFromRecordUsing(fn(Activity $r) => (string) $r->year)
                    ->orderQueryUsing(fn(Builder $query) => $query->orderByDesc('start_date'))
                    ->collapsible(),
            ])
            ->defaultGroup('start_date')
            ->groupingSettingsHidden()
            ->filters([
                Tables\Filters\SelectFilter::make('year')
                    ->label('Année')
                    ->options(fn() => Activity::years()->mapWithKeys(fn($y) => [$y => $y])->all())
                    ->query(fn(Builder $query, array $data) => $query->when($data['value'], fn($q, $year) => $q->whereYear('start_date', $year))),
                Tables\Filters\SelectFilter::make('category')
                    ->label('Catégorie')
                    ->options(Activity::CATEGORIES),
            ])
            ->actions([
                Tables\Actions\Action::make('view')
                    ->label('Voir')
                    ->icon('heroicon-m-arrow-top-right-on-square')
                    ->url(fn(Activity $r) => route('actions.activites.show', $r), shouldOpenInNewTab: true)
                    ->visible(fn(Activity $r) => $r->is_published),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->defaultSort('start_date', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListActivities::route('/'),
            'create' => Pages\CreateActivity::route('/create'),
            'edit'   => Pages\EditActivity::route('/{record}/edit'),
        ];
    }
}
