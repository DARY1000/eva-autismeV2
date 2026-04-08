<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Models\Project;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;
    protected static ?string $navigationIcon  = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Nos Actions';
    protected static ?string $modelLabel      = 'Projet';
    protected static ?string $pluralModelLabel= 'Projets';
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
                Forms\Components\TextInput::make('slug')->label('Slug')->required()->unique(ignoreRecord: true),
                Forms\Components\TextInput::make('category')->label('Catégorie'),
                Forms\Components\Select::make('status')
                    ->options(['active' => 'En cours', 'completed' => 'Terminé', 'upcoming' => 'À venir'])
                    ->required(),
                Forms\Components\Textarea::make('description')->label('Description courte')->rows(3)->columnSpanFull(),
                Forms\Components\RichEditor::make('content')->label('Contenu détaillé')->columnSpanFull(),
                Forms\Components\DatePicker::make('start_date')->label('Date de début'),
                Forms\Components\DatePicker::make('end_date')->label('Date de fin'),
                Forms\Components\TextInput::make('order')->label('Ordre')->numeric()->default(0),
                Forms\Components\FileUpload::make('image')->label('Image')->image()->directory('projects'),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')->label('')->width(80)->height(50),
                Tables\Columns\TextColumn::make('title')->label('Titre')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('category')->label('Catégorie')->badge(),
                Tables\Columns\BadgeColumn::make('status')
                    ->label('Statut')
                    ->colors(['success' => 'active', 'secondary' => 'completed', 'warning' => 'upcoming'])
                    ->formatStateUsing(fn($s) => match($s) {
                        'active' => 'En cours', 'completed' => 'Terminé', 'upcoming' => 'À venir', default => $s
                    }),
                Tables\Columns\TextColumn::make('order')->label('Ordre')->sortable(),
            ])
            ->reorderable('order')
            ->actions([Tables\Actions\EditAction::make(), Tables\Actions\DeleteAction::make()]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit'   => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}
