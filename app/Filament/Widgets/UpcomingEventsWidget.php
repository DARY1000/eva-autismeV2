<?php

namespace App\Filament\Widgets;

use App\Models\Event;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class UpcomingEventsWidget extends BaseWidget
{
    protected static ?string $heading = 'Prochains événements';
    protected static ?int $sort = 4;
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(Event::upcoming()->limit(5))
            ->columns([
                Tables\Columns\TextColumn::make('title')->label('Événement')->weight('bold'),
                Tables\Columns\TextColumn::make('date')->label('Date')->dateTime('d/m/Y H:i'),
                Tables\Columns\TextColumn::make('location')->label('Lieu'),
                Tables\Columns\TextColumn::make('registrations_count')
                    ->label('Inscrits')
                    ->counts('registrations'),
                Tables\Columns\TextColumn::make('max_participants')->label('Max'),
                Tables\Columns\BadgeColumn::make('type')
                    ->label('Type')
                    ->colors([
                        'primary' => 'présentiel',
                        'success' => 'en ligne',
                        'warning' => 'hybride',
                    ]),
            ])
            ->actions([
                Tables\Actions\Action::make('edit')
                    ->label('Modifier')
                    ->url(fn(Event $r) => route('filament.admin.resources.events.edit', $r))
                    ->icon('heroicon-m-pencil'),
            ]);
    }
}
