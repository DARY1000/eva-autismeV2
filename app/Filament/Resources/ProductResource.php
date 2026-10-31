<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use App\Services\FeexPay;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;
    protected static ?string $navigationIcon  = 'heroicon-o-shopping-bag';
    protected static ?string $navigationGroup = 'Boutique';
    protected static ?string $modelLabel      = 'Produit';
    protected static ?string $pluralModelLabel= 'Produits';
    protected static ?int    $navigationSort  = 0;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Le produit')->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nom')
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
                    ->options(Product::CATEGORIES)
                    ->required(),
                Forms\Components\TextInput::make('order')->label('Ordre')->numeric()->minValue(0)->default(0),
                Forms\Components\Textarea::make('summary')
                    ->label('Résumé')
                    ->helperText('Une ou deux phrases, affichées sur la liste des produits.')
                    ->rows(2)
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\RichEditor::make('description')
                    ->label('Description complète')
                    ->disableToolbarButtons(['attachFiles'])
                    ->columnSpanFull(),
            ])->columns(2),

            Forms\Components\Section::make('Prix & stock')->schema([
                Forms\Components\TextInput::make('price')
                    ->label('Prix (F CFA)')
                    ->numeric()
                    ->minValue(FeexPay::MIN_AMOUNT)
                    ->maxValue(FeexPay::MAX_AMOUNT)
                    ->required(fn(Get $get) => (bool) $get('is_published')),
                Forms\Components\TextInput::make('stock')
                    ->label('Quantité disponible')
                    ->helperText('Laissez vide si le produit est toujours disponible.')
                    ->numeric()
                    ->minValue(0),
            ])->columns(2),

            Forms\Components\Section::make('Photos')->schema([
                Forms\Components\FileUpload::make('image')
                    ->label('Photo principale')
                    ->image()
                    ->disk('public')
                    ->directory('products')
                    ->imageResizeMode('contain')
                    ->imageResizeTargetWidth('1200')
                    ->maxSize(10240),
                Forms\Components\FileUpload::make('gallery')
                    ->label('Autres photos')
                    ->image()
                    ->multiple()
                    ->reorderable()
                    ->appendFiles()
                    ->disk('public')
                    ->directory('products')
                    ->imageResizeMode('contain')
                    ->imageResizeTargetWidth('1200')
                    ->maxSize(10240)
                    ->maxFiles(8),
            ])->columns(2),

            Forms\Components\Section::make('Publication')->schema([
                Forms\Components\Toggle::make('is_published')
                    ->label('Visible dans la boutique')
                    ->live()
                    ->default(false),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')->label('')->disk('public')->width(56)->height(56),
                Tables\Columns\TextColumn::make('name')->label('Produit')->searchable()->weight('bold')->limit(50),
                Tables\Columns\TextColumn::make('category')
                    ->label('Catégorie')
                    ->badge()
                    ->formatStateUsing(fn($state) => Product::CATEGORIES[$state] ?? $state),
                Tables\Columns\TextColumn::make('price')->label('Prix')->money('XOF')->placeholder('À définir')->sortable(),
                Tables\Columns\TextColumn::make('stock')->label('Stock')->placeholder('Illimité')->sortable(),
                Tables\Columns\IconColumn::make('is_published')->label('En ligne')->boolean(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category')->label('Catégorie')->options(Product::CATEGORIES),
            ])
            ->actions([Tables\Actions\EditAction::make(), Tables\Actions\DeleteAction::make()])
            ->reorderable('order')
            ->defaultSort('order');
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit'   => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
