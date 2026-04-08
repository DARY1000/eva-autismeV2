<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DonationResource\Pages;
use App\Models\Donation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class DonationResource extends Resource
{
    protected static ?string $model = Donation::class;
    protected static ?string $navigationIcon  = 'heroicon-o-heart';
    protected static ?string $navigationGroup = 'Relations';
    protected static ?string $modelLabel      = 'Don';
    protected static ?string $pluralModelLabel= 'Dons';
    protected static ?int    $navigationSort  = 2;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Donateur')->schema([
                Forms\Components\TextInput::make('prenom')->label('Prénom')->disabled(),
                Forms\Components\TextInput::make('nom')->label('Nom')->disabled(),
                Forms\Components\TextInput::make('email')->label('Email')->disabled(),
                Forms\Components\TextInput::make('telephone')->label('Téléphone')->disabled(),
                Forms\Components\TextInput::make('pays')->label('Pays')->disabled(),
            ])->columns(2),
            Forms\Components\Section::make('Détails du don')->schema([
                Forms\Components\TextInput::make('montant')->label('Montant (FCFA)')->disabled(),
                Forms\Components\TextInput::make('frequence')->label('Fréquence')->disabled(),
                Forms\Components\TextInput::make('reference')->label('Référence')->disabled(),
                Forms\Components\Select::make('status')
                    ->label('Statut')
                    ->options(['pending' => 'En attente', 'completed' => 'Confirmé', 'failed' => 'Échoué'])
                    ->required(),
                Forms\Components\Textarea::make('message')->label('Message du donateur')->disabled()->columnSpanFull(),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('reference')->label('Référence')->searchable()->weight('bold'),
                Tables\Columns\TextColumn::make('prenom')
                    ->label('Donateur')
                    ->formatStateUsing(fn($state, $r) => $state.' '.$r->nom)
                    ->searchable(),
                Tables\Columns\TextColumn::make('montant')->label('Montant')->money('XOF')->sortable(),
                Tables\Columns\TextColumn::make('frequence')->label('Fréquence')->badge(),
                Tables\Columns\BadgeColumn::make('status')
                    ->label('Statut')
                    ->colors(['warning' => 'pending', 'success' => 'completed', 'danger' => 'failed'])
                    ->formatStateUsing(fn($s) => match($s) {
                        'pending' => 'En attente', 'completed' => 'Confirmé', 'failed' => 'Échoué', default => $s
                    }),
                Tables\Columns\TextColumn::make('created_at')->label('Date')->dateTime('d/m/Y')->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options(['pending' => 'En attente', 'completed' => 'Confirmé', 'failed' => 'Échoué']),
                Tables\Filters\SelectFilter::make('frequence')
                    ->options(['ponctuel' => 'Ponctuel', 'mensuel' => 'Mensuel']),
            ])
            ->actions([Tables\Actions\EditAction::make(), Tables\Actions\DeleteAction::make()])
            ->defaultSort('created_at', 'desc')
            ->headerActions([
                Tables\Actions\Action::make('export')
                    ->label('Exporter CSV')
                    ->icon('heroicon-m-arrow-down-tray')
                    ->url(route('filament.admin.resources.donations.index').'?export=csv'),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDonations::route('/'),
            'edit'  => Pages\EditDonation::route('/{record}/edit'),
        ];
    }
}
