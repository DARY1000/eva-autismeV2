<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FormationResource\Pages;
use App\Models\Formation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class FormationResource extends Resource
{
    protected static ?string $model = Formation::class;
    protected static ?string $navigationIcon  = 'heroicon-o-academic-cap';
    protected static ?string $navigationGroup = 'Nos Actions';
    protected static ?string $modelLabel      = 'Formation';
    protected static ?string $pluralModelLabel= 'Formations';
    protected static ?int    $navigationSort  = 3;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Informations générales')->schema([
                Forms\Components\TextInput::make('titre')
                    ->label('Titre de la formation')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('public_cible')
                    ->label('Public cible')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('ex: Parents d\'enfants autistes'),
                Forms\Components\Textarea::make('description')
                    ->label('Description')
                    ->required()
                    ->rows(4),
                Forms\Components\Textarea::make('objectifs')
                    ->label('Objectifs pédagogiques')
                    ->rows(4)
                    ->placeholder("Un objectif par ligne…"),
            ])->columns(1),

            Forms\Components\Section::make('Détails pratiques')->schema([
                Forms\Components\TextInput::make('duree')
                    ->label('Durée')
                    ->maxLength(100)
                    ->placeholder('ex: 1 journée, 2 demi-journées'),
                Forms\Components\Select::make('format')
                    ->label('Format')
                    ->options([
                        'présentiel' => 'Présentiel',
                        'en ligne'   => 'En ligne',
                        'hybride'    => 'Hybride',
                    ]),
                Forms\Components\TextInput::make('lieu')
                    ->label('Lieu')
                    ->maxLength(255)
                    ->placeholder('ex: Abomey-Calavi / En ligne'),
                Forms\Components\Select::make('icon_color')
                    ->label('Couleur d\'icône')
                    ->options([
                        'primary' => 'Bleu (principal)',
                        'accent'  => 'Orange',
                        'green'   => 'Vert',
                        'teal'    => 'Teal',
                    ])
                    ->default('primary'),
            ])->columns(2),

            Forms\Components\Section::make('Publication')->schema([
                Forms\Components\TextInput::make('order')
                    ->label('Ordre d\'affichage')
                    ->numeric()
                    ->default(0),
                Forms\Components\Toggle::make('is_active')
                    ->label('Formation active')
                    ->default(true),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('ordre')
                    ->label('#')
                    ->sortable()
                    ->getStateUsing(fn($record) => $record->order),
                Tables\Columns\TextColumn::make('titre')
                    ->label('Titre')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                Tables\Columns\TextColumn::make('public_cible')
                    ->label('Public cible')
                    ->searchable(),
                Tables\Columns\TextColumn::make('duree')
                    ->label('Durée'),
                Tables\Columns\TextColumn::make('format')
                    ->label('Format')
                    ->badge()
                    ->color(fn($state) => match($state) {
                        'présentiel' => 'primary',
                        'en ligne'   => 'success',
                        'hybride'    => 'warning',
                        default      => 'gray',
                    }),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Actif')
                    ->boolean()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')->label('Actif'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->reorderable('order')
            ->defaultSort('order');
    }

    public static function getRelations(): array { return []; }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListFormations::route('/'),
            'create' => Pages\CreateFormation::route('/create'),
            'edit'   => Pages\EditFormation::route('/{record}/edit'),
        ];
    }
}
