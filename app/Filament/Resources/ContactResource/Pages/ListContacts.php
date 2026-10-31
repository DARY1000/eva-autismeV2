<?php

namespace App\Filament\Resources\ContactResource\Pages;

use App\Filament\Resources\ContactResource;
use App\Models\Contact;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListContacts extends ListRecords
{
    protected static string $resource = ContactResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('scan')
                ->label('Détecter le spam')
                ->icon('heroicon-m-shield-check')
                ->color('gray')
                ->action(function () {
                    Notification::make()
                        ->title(Contact::flagExistingSpam().' message(s) classé(s) en spam')
                        ->success()
                        ->send();
                }),
            Actions\Action::make('purge')
                ->label('Vider le spam')
                ->icon('heroicon-m-trash')
                ->color('danger')
                ->requiresConfirmation()
                ->modalDescription('Tous les messages classés en spam seront supprimés définitivement.')
                ->visible(fn () => Contact::where('status', 'spam')->exists())
                ->action(function () {
                    Notification::make()
                        ->title(Contact::where('status', 'spam')->delete().' message(s) supprimé(s)')
                        ->success()
                        ->send();
                }),
        ];
    }

    public function getTabs(): array
    {
        $tab = fn (string $label, string ...$statuses) => Tab::make($label)
            ->badge(Contact::whereIn('status', $statuses)->count())
            ->modifyQueryUsing(fn (Builder $query) => $query->whereIn('status', $statuses));

        return [
            'inbox'   => $tab('Boîte de réception', 'new', 'read'),
            'replied' => $tab('Répondus', 'replied'),
            'spam'    => $tab('Spam', 'spam'),
        ];
    }
}
