<?php

namespace App\Filament\Widgets;

use App\Models\Donation;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class RecentDonationsWidget extends BaseWidget
{
    protected static ?string $heading = 'Derniers dons reçus';
    protected static ?int $sort = 3;
    protected int | string | array $columnSpan = 1;

    public function table(Table $table): Table
    {
        return $table
            ->query(Donation::query()->latest()->limit(5))
            ->columns([
                Tables\Columns\TextColumn::make('prenom')
                    ->label('Donateur')
                    ->formatStateUsing(fn($state, $record) => $state.' '.$record->nom),
                Tables\Columns\TextColumn::make('montant')
                    ->label('Montant')
                    ->money('XOF')
                    ->weight('bold'),
                Tables\Columns\TextColumn::make('frequence')
                    ->label('Type')
                    ->badge()
                    ->color(fn($state) => $state === 'mensuel' ? 'success' : 'primary'),
                Tables\Columns\BadgeColumn::make('status')
                    ->label('Statut')
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'completed',
                        'danger'  => 'failed',
                    ])
                    ->formatStateUsing(fn($state) => match($state) {
                        'pending'   => 'En attente',
                        'completed' => 'Confirmé',
                        'failed'    => 'Échoué',
                        default     => $state,
                    }),
                Tables\Columns\TextColumn::make('created_at')->label('Date')->since(),
            ]);
    }
}
