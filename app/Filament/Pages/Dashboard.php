<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    protected static ?string $navigationIcon = 'heroicon-o-home';
    protected static ?string $title = 'Tableau de bord';
    protected static ?string $navigationLabel = 'Tableau de bord';

    public function getWidgets(): array
    {
        return [
            \App\Filament\Widgets\StatsOverviewWidget::class,
            \App\Filament\Widgets\RecentContactsWidget::class,
            \App\Filament\Widgets\RecentDonationsWidget::class,
            \App\Filament\Widgets\UpcomingEventsWidget::class,
        ];
    }

    public function getColumns(): int | array
    {
        return 2;
    }
}
