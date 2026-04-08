<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EventResource\Pages;
use App\Models\Event;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class EventResource extends Resource
{
    protected static ?string $model = Event::class;
    protected static ?string $navigationIcon  = 'heroicon-o-calendar';
    protected static ?string $navigationGroup = 'Nos Actions';
    protected static ?string $modelLabel      = 'Événement';
    protected static ?string $pluralModelLabel= 'Événements';
    protected static ?int    $navigationSort  = 1;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Informations générales')->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Titre')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn($state, $set) => $set('slug', Str::slug($state))),
                Forms\Components\TextInput::make('slug')
                    ->label('Slug URL')
                    ->required()
                    ->unique(ignoreRecord: true),
                Forms\Components\Textarea::make('description')
                    ->label('Description courte')
                    ->rows(3)
                    ->required(),
                Forms\Components\RichEditor::make('content')
                    ->label('Contenu complet')
                    ->columnSpanFull(),
            ])->columns(2),

            Forms\Components\Section::make('Date & Lieu')->schema([
                Forms\Components\DateTimePicker::make('date')
                    ->label('Date de début')
                    ->required(),
                Forms\Components\DateTimePicker::make('end_date')
                    ->label('Date de fin'),
                Forms\Components\TextInput::make('location')
                    ->label('Ville')
                    ->required(),
                Forms\Components\TextInput::make('address')
                    ->label('Adresse complète'),
                Forms\Components\Select::make('type')
                    ->label('Type')
                    ->options(['présentiel' => 'Présentiel', 'en ligne' => 'En ligne', 'hybride' => 'Hybride'])
                    ->required(),
                Forms\Components\Select::make('status')
                    ->label('Statut')
                    ->options(['upcoming' => 'À venir', 'past' => 'Passé', 'cancelled' => 'Annulé'])
                    ->required(),
            ])->columns(2),

            Forms\Components\Section::make('Inscriptions')->schema([
                Forms\Components\TextInput::make('max_participants')
                    ->label('Participants max')
                    ->numeric(),
                Forms\Components\DateTimePicker::make('registration_deadline')
                    ->label('Date limite d\'inscription'),
                Forms\Components\Toggle::make('is_free')
                    ->label('Événement gratuit')
                    ->default(true),
                Forms\Components\TextInput::make('price')
                    ->label('Prix (FCFA)')
                    ->numeric()
                    ->visible(fn($get) => !$get('is_free')),
            ])->columns(2),

            Forms\Components\Section::make('Image')->schema([
                Forms\Components\FileUpload::make('image')
                    ->label('Image de couverture')
                    ->image()
                    ->directory('events')
                    ->imageResizeMode('cover')
                    ->imageCropAspectRatio('16:9'),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')->label('')->circular(false)->width(80)->height(50),
                Tables\Columns\TextColumn::make('title')->label('Titre')->searchable()->sortable()->weight('bold'),
                Tables\Columns\TextColumn::make('date')->label('Date')->dateTime('d/m/Y H:i')->sortable(),
                Tables\Columns\TextColumn::make('location')->label('Lieu'),
                Tables\Columns\TextColumn::make('registrations_count')->counts('registrations')->label('Inscrits'),
                Tables\Columns\BadgeColumn::make('type')
                    ->label('Type')
                    ->colors(['primary' => 'présentiel', 'success' => 'en ligne', 'warning' => 'hybride']),
                Tables\Columns\BadgeColumn::make('status')
                    ->label('Statut')
                    ->colors(['success' => 'upcoming', 'secondary' => 'past', 'danger' => 'cancelled'])
                    ->formatStateUsing(fn($state) => match($state) {
                        'upcoming'  => 'À venir', 'past' => 'Passé', 'cancelled' => 'Annulé', default => $state
                    }),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options(['upcoming' => 'À venir', 'past' => 'Passé', 'cancelled' => 'Annulé']),
            ])
            ->actions([Tables\Actions\EditAction::make(), Tables\Actions\DeleteAction::make()])
            ->defaultSort('date', 'desc');
    }

    public static function getRelations(): array { return []; }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListEvents::route('/'),
            'create' => Pages\CreateEvent::route('/create'),
            'edit'   => Pages\EditEvent::route('/{record}/edit'),
        ];
    }
}
