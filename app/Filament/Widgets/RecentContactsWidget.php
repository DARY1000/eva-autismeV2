<?php

namespace App\Filament\Widgets;

use App\Models\Contact;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class RecentContactsWidget extends BaseWidget
{
    protected static ?string $heading = 'Derniers messages reçus';
    protected static ?int $sort = 2;
    protected int | string | array $columnSpan = 1;

    public function table(Table $table): Table
    {
        return $table
            ->query(Contact::query()->latest()->limit(5))
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Nom')->weight('bold'),
                Tables\Columns\TextColumn::make('subject')->label('Objet')->limit(30),
                Tables\Columns\BadgeColumn::make('status')
                    ->label('Statut')
                    ->colors([
                        'danger'  => 'new',
                        'warning' => 'read',
                        'success' => 'replied',
                    ])
                    ->formatStateUsing(fn($state) => match($state) {
                        'new'     => 'Nouveau',
                        'read'    => 'Lu',
                        'replied' => 'Répondu',
                        default   => $state,
                    }),
                Tables\Columns\TextColumn::make('created_at')->label('Date')->since(),
            ])
            ->actions([
                Tables\Actions\Action::make('view')
                    ->label('Voir')
                    ->url(fn(Contact $r) => route('filament.admin.resources.contacts.edit', $r))
                    ->icon('heroicon-m-eye'),
            ]);
    }
}
