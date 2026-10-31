<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Models\Order;
use App\Services\FeexPay;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\HtmlString;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;
    protected static ?string $navigationIcon  = 'heroicon-o-shopping-cart';
    protected static ?string $navigationGroup = 'Boutique';
    protected static ?string $modelLabel      = 'Commande';
    protected static ?string $pluralModelLabel= 'Commandes';
    protected static ?int    $navigationSort  = 1;

    private const PAYMENT = ['pending' => 'En attente', 'completed' => 'Payée', 'failed' => 'Échouée'];

    public static function getNavigationBadge(): ?string
    {
        $count = Order::where('status', 'completed')->where('fulfillment_status', 'to_prepare')->count();

        return $count > 0 ? (string) $count : null;
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Suivi')->schema([
                Forms\Components\Select::make('fulfillment_status')
                    ->label('Préparation')
                    ->options(Order::FULFILLMENT)
                    ->required(),
                Forms\Components\TextInput::make('reference')->label('Référence')->disabled(),
                Forms\Components\Placeholder::make('payment')
                    ->label('Paiement')
                    ->content(fn(Order $r) => self::PAYMENT[$r->status] ?? $r->status),
                Forms\Components\TextInput::make('total')->label('Total (F CFA)')->disabled(),
                Forms\Components\Placeholder::make('items')
                    ->label('Articles')
                    ->columnSpanFull()
                    ->content(fn(Order $r) => new HtmlString($r->items
                        ->map(fn($item) => e($item->quantity.' × '.$item->name.' · '.number_format($item->unit_price, 0, ',', ' ').' F'))
                        ->implode('<br>'))),
            ])->columns(2),
            Forms\Components\Section::make('Client')->schema([
                Forms\Components\TextInput::make('prenom')->label('Prénom')->disabled(),
                Forms\Components\TextInput::make('nom')->label('Nom')->disabled(),
                Forms\Components\TextInput::make('email')->label('Email')->disabled(),
                Forms\Components\TextInput::make('telephone')->label('Téléphone')->disabled(),
                Forms\Components\TextInput::make('pays')->label('Pays')->disabled(),
                Forms\Components\TextInput::make('ville')->label('Ville')->disabled(),
                Forms\Components\Select::make('delivery_mode')->label('Remise')->options(Order::DELIVERY_MODES)->disabled(),
                Forms\Components\TextInput::make('adresse')->label('Adresse')->disabled(),
                Forms\Components\Textarea::make('note')->label('Note du client')->disabled()->columnSpanFull(),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('reference')->label('Référence')->searchable()->weight('bold'),
                Tables\Columns\TextColumn::make('prenom')
                    ->label('Client')
                    ->formatStateUsing(fn($state, Order $r) => $state.' '.$r->nom)
                    ->searchable(['prenom', 'nom', 'email']),
                Tables\Columns\TextColumn::make('total')->label('Total')->money('XOF')->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Paiement')
                    ->badge()
                    ->color(fn($state) => ['pending' => 'warning', 'completed' => 'success', 'failed' => 'danger'][$state] ?? 'gray')
                    ->formatStateUsing(fn($state) => self::PAYMENT[$state] ?? $state),
                Tables\Columns\TextColumn::make('fulfillment_status')
                    ->label('Préparation')
                    ->badge()
                    ->formatStateUsing(fn($state) => Order::FULFILLMENT[$state] ?? $state),
                Tables\Columns\TextColumn::make('created_at')->label('Date')->dateTime('d/m/Y H:i')->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')->label('Paiement')->options(self::PAYMENT),
                Tables\Filters\SelectFilter::make('fulfillment_status')->label('Préparation')->options(Order::FULFILLMENT),
            ])
            ->actions([
                Tables\Actions\Action::make('verify')
                    ->label('Vérifier le paiement')
                    ->icon('heroicon-m-arrow-path')
                    ->visible(fn(Order $r) => $r->status === 'pending' && filled($r->payment_reference))
                    ->action(function (Order $r) {
                        try {
                            $r->syncPayment(app(FeexPay::class));
                            Notification::make()->title('Paiement : '.(self::PAYMENT[$r->status] ?? $r->status))->success()->send();
                        } catch (\RuntimeException) {
                            Notification::make()->title('FeexPay ne répond pas, réessayez plus tard')->danger()->send();
                        }
                    }),
                Tables\Actions\Action::make('cancel')
                    ->label('Abandonner')
                    ->icon('heroicon-m-x-mark')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->modalDescription('La commande non payée est abandonnée et son stock redevient disponible. Vérifiez d\'abord le paiement.')
                    ->visible(fn(Order $r) => $r->status === 'pending')
                    ->action(fn(Order $r) => $r->markPaymentFailed('Abandonnée par l\'équipe')),
                Tables\Actions\EditAction::make()->label('Ouvrir'),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'edit'  => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
