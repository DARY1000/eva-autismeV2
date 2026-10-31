<?php
namespace App\Filament\Resources\DonationResource\Pages;
use App\Filament\Resources\DonationResource;
use App\Models\Donation;
use App\Services\FeexPay;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
class ListDonations extends ListRecords {
    protected static string $resource = DonationResource::class;
    protected function getHeaderActions(): array {
        return [
            Actions\Action::make('verify_pending')
                ->label('Vérifier les paiements en attente')
                ->icon('heroicon-m-arrow-path')
                ->color('gray')
                ->action(function () {
                    $confirmed = 0;

                    Donation::pending()->whereNotNull('payment_reference')->each(function (Donation $donation) use (&$confirmed) {
                        try {
                            $donation->syncPayment(app(FeexPay::class));
                            $confirmed += $donation->status === 'completed' ? 1 : 0;
                        } catch (\RuntimeException) {
                            // FeexPay indisponible pour ce don : il sera revérifié au prochain passage.
                        }
                    });

                    Notification::make()->title($confirmed.' don(s) confirmé(s)')->success()->send();
                }),
        ];
    }
}
