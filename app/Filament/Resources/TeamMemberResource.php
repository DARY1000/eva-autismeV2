<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TeamMemberResource\Pages;
use App\Models\TeamMember;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TeamMemberResource extends Resource
{
    protected static ?string $model = TeamMember::class;
    protected static ?string $navigationIcon  = 'heroicon-o-user-group';
    protected static ?string $navigationGroup = 'À Propos';
    protected static ?string $modelLabel      = 'Membre d\'équipe';
    protected static ?string $pluralModelLabel= 'Équipe';
    protected static ?int    $navigationSort  = 1;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Identité')->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nom complet')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('role')
                    ->label('Rôle / Poste')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('bio')
                    ->label('Biographie courte')
                    ->rows(3)
                    ->maxLength(500),
            ])->columns(1),

            Forms\Components\Section::make('Photo & Contact')->schema([
                Forms\Components\FileUpload::make('photo')
                    ->label('Photo de profil')
                    ->image()
                    ->directory('team')
                    ->imageResizeMode('cover')
                    ->imageCropAspectRatio('1:1')
                    ->circular(),
                Forms\Components\TextInput::make('email')
                    ->label('Email (optionnel)')
                    ->email()
                    ->maxLength(255),
                Forms\Components\TextInput::make('linkedin')
                    ->label('LinkedIn URL (optionnel)')
                    ->url()
                    ->maxLength(255),
            ])->columns(2),

            Forms\Components\Section::make('Affichage')->schema([
                Forms\Components\TextInput::make('order')
                    ->label('Ordre d\'affichage')
                    ->numeric()
                    ->default(0),
                Forms\Components\Toggle::make('is_active')
                    ->label('Visible sur le site')
                    ->default(true),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('photo')
                    ->label('')
                    ->circular()
                    ->width(52)
                    ->height(52),
                Tables\Columns\TextColumn::make('name')
                    ->label('Nom')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                Tables\Columns\TextColumn::make('role')
                    ->label('Rôle')
                    ->searchable(),
                Tables\Columns\TextColumn::make('order')
                    ->label('Ordre')
                    ->sortable(),
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
            'index'  => Pages\ListTeamMembers::route('/'),
            'create' => Pages\CreateTeamMember::route('/create'),
            'edit'   => Pages\EditTeamMember::route('/{record}/edit'),
        ];
    }
}
