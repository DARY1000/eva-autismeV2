<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PartnerResource\Pages;
use App\Models\Partner;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PartnerResource extends Resource
{
    protected static ?string $model = Partner::class;
    protected static ?string $navigationIcon  = 'heroicon-o-building-office-2';
    protected static ?string $navigationGroup = 'À Propos';
    protected static ?string $modelLabel      = 'Partenaire';
    protected static ?string $pluralModelLabel= 'Partenaires';
    protected static ?int    $navigationSort  = 2;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Informations')->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nom du partenaire')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('type')
                    ->label('Type de partenariat')
                    ->options([
                        'financier'     => 'Partenaire Financier',
                        'technique'     => 'Partenaire Technique',
                        'professionnel' => 'Partenaire Professionnel',
                        'éducatif'      => 'Partenaire Éducatif',
                        'institutionnel'=> 'Partenaire Institutionnel',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('website')
                    ->label('Site web (optionnel)')
                    ->url()
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->label('Description courte')
                    ->rows(2)
                    ->maxLength(300),
            ])->columns(2),

            Forms\Components\Section::make('Logo & Affichage')->schema([
                Forms\Components\FileUpload::make('logo')
                    ->label('Logo (PNG ou SVG recommandé)')
                    ->image()
                    ->directory('partners')
                    ->imageResizeMode('contain')
                    ->maxSize(2048),
                Forms\Components\TextInput::make('order')
                    ->label('Ordre d\'affichage')
                    ->numeric()
                    ->default(0),
                Forms\Components\Toggle::make('is_active')
                    ->label('Affiché dans le carrousel')
                    ->default(true),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('logo')
                    ->label('')
                    ->width(80)
                    ->height(45)
                    ->fit('contain'),
                Tables\Columns\TextColumn::make('name')
                    ->label('Nom')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                Tables\Columns\TextColumn::make('type')
                    ->label('Type')
                    ->badge(),
                Tables\Columns\TextColumn::make('order')
                    ->label('Ordre')
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Actif')
                    ->boolean()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->options([
                        'financier'     => 'Financier',
                        'technique'     => 'Technique',
                        'professionnel' => 'Professionnel',
                        'éducatif'      => 'Éducatif',
                        'institutionnel'=> 'Institutionnel',
                    ]),
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
            'index'  => Pages\ListPartners::route('/'),
            'create' => Pages\CreatePartner::route('/create'),
            'edit'   => Pages\EditPartner::route('/{record}/edit'),
        ];
    }
}
