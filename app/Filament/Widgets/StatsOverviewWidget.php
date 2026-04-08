<?php

namespace App\Filament\Widgets;

use App\Models\Contact;
use App\Models\Donation;
use App\Models\Event;
use App\Models\EventRegistration;
use App\Models\Newsletter;
use App\Models\ClubMember;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverviewWidget extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $totalDonations     = Donation::where('status', 'completed')->sum('montant');
        $pendingDonations   = Donation::where('status', 'pending')->count();
        $newContacts        = Contact::where('status', 'new')->count();
        $newsletterSubs     = Newsletter::where('is_active', true)->count();
        $clubMembers        = ClubMember::where('status', 'active')->count();
        $upcomingEvents     = Event::upcoming()->count();
        $totalRegistrations = EventRegistration::count();
        $thisMonthDonations = Donation::whereMonth('created_at', now()->month)
                                      ->whereYear('created_at', now()->year)
                                      ->sum('montant');

        return [
            Stat::make('Dons reçus (total)', number_format($totalDonations, 0, ',', ' ').' FCFA')
                ->description($pendingDonations.' dons en attente de validation')
                ->descriptionIcon('heroicon-m-heart')
                ->color('warning')
                ->chart([7, 12, 8, 15, 10, 18, 14]),

            Stat::make('Dons ce mois', number_format($thisMonthDonations, 0, ',', ' ').' FCFA')
                ->description('Donations du mois en cours')
                ->descriptionIcon('heroicon-m-currency-dollar')
                ->color('success'),

            Stat::make('Abonnés Newsletter', $newsletterSubs)
                ->description('Inscrits actifs à la newsletter')
                ->descriptionIcon('heroicon-m-envelope')
                ->color('primary')
                ->chart([10, 15, 12, 20, 18, 25, 22]),

            Stat::make('Membres Club Parents', $clubMembers)
                ->description('Membres actifs du Club Parents')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('info'),

            Stat::make('Messages non lus', $newContacts)
                ->description('Demandes de contact en attente')
                ->descriptionIcon('heroicon-m-chat-bubble-left')
                ->color($newContacts > 0 ? 'danger' : 'success'),

            Stat::make('Événements à venir', $upcomingEvents)
                ->description($totalRegistrations.' inscriptions au total')
                ->descriptionIcon('heroicon-m-calendar')
                ->color('primary'),
        ];
    }
}
