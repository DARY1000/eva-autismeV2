<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactResource\Pages;
use App\Models\Contact;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Collection;

class ContactResource extends Resource
{
    protected static ?string $model = Contact::class;
    protected static ?string $navigationIcon  = 'heroicon-o-envelope';
    protected static ?string $navigationGroup = 'Relations';
    protected static ?string $modelLabel      = 'Message';
    protected static ?string $pluralModelLabel= 'Messages reçus';
    protected static ?int    $navigationSort  = 1;

    public static function getNavigationBadge(): ?string
    {
        return (string) Contact::where('status', 'new')->count() ?: null;
    }

    public static function getNavigationBadgeColor(): string | array | null
    {
        return Contact::where('status', 'new')->count() > 0 ? 'danger' : null;
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Informations du contact')->schema([
                Forms\Components\TextInput::make('name')->label('Nom')->disabled(),
                Forms\Components\TextInput::make('email')->label('Email')->disabled(),
                Forms\Components\TextInput::make('phone')->label('Téléphone')->disabled(),
                Forms\Components\TextInput::make('organization')->label('Organisation')->disabled(),
                Forms\Components\TextInput::make('subject')->label('Objet')->disabled()->columnSpanFull(),
                Forms\Components\Textarea::make('message')->label('Message')->disabled()->rows(5)->columnSpanFull(),
            ])->columns(2),
            Forms\Components\Section::make('Gestion')->schema([
                Forms\Components\Select::make('status')
                    ->label('Statut')
                    ->options(['new' => 'Nouveau', 'read' => 'Lu', 'replied' => 'Répondu', 'spam' => 'Spam'])
                    ->required(),
                Forms\Components\TextInput::make('ip_address')->label('Adresse IP')->disabled(),
                Forms\Components\TextInput::make('spam_reason')
                    ->label('Raison du classement en spam')
                    ->disabled()
                    ->columnSpanFull()
                    ->visible(fn(?Contact $record) => filled($record?->spam_reason)),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Nom')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('email')->label('Email')->searchable(),
                Tables\Columns\TextColumn::make('subject')->label('Objet')->limit(40),
                Tables\Columns\BadgeColumn::make('status')
                    ->label('Statut')
                    ->colors(['danger' => 'new', 'warning' => 'read', 'success' => 'replied', 'gray' => 'spam'])
                    ->formatStateUsing(fn($state) => match($state) {
                        'new' => 'Nouveau', 'read' => 'Lu', 'replied' => 'Répondu', 'spam' => 'Spam', default => $state
                    }),
                Tables\Columns\TextColumn::make('created_at')->label('Reçu le')->dateTime('d/m/Y H:i')->sortable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('Voir / Gérer'),
                Tables\Actions\Action::make('mark_read')
                    ->label('Marquer lu')
                    ->icon('heroicon-m-check')
                    ->action(fn(Contact $r) => $r->update(['status' => 'read']))
                    ->visible(fn(Contact $r) => $r->status === 'new'),
                Tables\Actions\Action::make('not_spam')
                    ->label('Pas un spam')
                    ->icon('heroicon-m-arrow-uturn-left')
                    ->action(fn(Contact $r) => $r->update(['status' => 'new', 'spam_reason' => null]))
                    ->visible(fn(Contact $r) => $r->status === 'spam'),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkAction::make('mark_spam')
                    ->label('Classer en spam')
                    ->icon('heroicon-m-no-symbol')
                    ->requiresConfirmation()
                    ->deselectRecordsAfterCompletion()
                    ->action(fn(Collection $records) => $records->each->update(['status' => 'spam', 'spam_reason' => 'Classé manuellement'])),
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListContacts::route('/'),
            'edit'  => Pages\EditContact::route('/{record}/edit'),
        ];
    }
}
