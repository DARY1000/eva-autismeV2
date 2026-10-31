<?php

namespace App\Filament\Pages;

use App\Models\SiteSetting;
use App\Support\BeninDepartments;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class SiteSettingsPage extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon  = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationGroup = 'Administration';
    protected static ?string $navigationLabel = 'Réglages du site';
    protected static ?string $title           = 'Réglages du site';
    protected static ?int    $navigationSort  = 10;

    protected static string $view = 'filament.pages.site-settings';

    public ?array $data = [];

    public function mount(): void
    {
        $keys = [
            'social_facebook', 'social_instagram', 'social_tiktok', 'social_whatsapp', 'social_youtube',
        ];

        $values = [];
        foreach ($keys as $key) {
            $values[$key] = SiteSetting::get($key);
        }

        foreach (BeninDepartments::map()['departments'] as $key => $department) {
            $values["dept_status_{$key}"] = SiteSetting::get("dept_status_{$key}", BeninDepartments::defaultStatus($key));
            $values["dept_note_{$key}"]   = SiteSetting::get("dept_note_{$key}", BeninDepartments::defaultDescription($key));
        }

        $this->form->fill($values);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Réseaux sociaux')
                    ->description('Entrez les URLs complètes de vos pages. Laissez vide pour masquer l\'icône.')
                    ->icon('heroicon-o-share')
                    ->schema([
                        TextInput::make('social_facebook')
                            ->label('Facebook')
                            ->url()
                            ->placeholder('https://facebook.com/evaautisme'),
                        TextInput::make('social_instagram')
                            ->label('Instagram')
                            ->url()
                            ->placeholder('https://instagram.com/evaautisme'),
                        TextInput::make('social_tiktok')
                            ->label('TikTok')
                            ->url()
                            ->placeholder('https://tiktok.com/@evaautisme'),
                        TextInput::make('social_whatsapp')
                            ->label('WhatsApp (lien wa.me)')
                            ->url()
                            ->placeholder('https://wa.me/22901951738038'),
                        TextInput::make('social_youtube')
                            ->label('YouTube')
                            ->url()
                            ->placeholder('https://youtube.com/@evaautisme'),
                    ])->columns(2),
                Section::make('Présence par département')
                    ->description('Page Notre Impact : colore la carte du Bénin et remplit la liste des zones d\'intervention.')
                    ->icon('heroicon-o-map')
                    ->schema($this->departmentFields())
                    ->columns(2),
            ])
            ->statePath('data');
    }

    private function departmentFields(): array
    {
        return collect(BeninDepartments::map()['departments'])
            ->sortBy('name')
            ->flatMap(fn (array $department, string $key) => [
                Select::make("dept_status_{$key}")
                    ->label($department['name'])
                    ->options(BeninDepartments::STATUSES)
                    ->selectablePlaceholder(false)
                    ->required(),
                TextInput::make("dept_note_{$key}")
                    ->label('Description')
                    ->maxLength(120),
            ])
            ->all();
    }

    public function save(): void
    {
        $data = $this->form->getState();

        foreach ($data as $key => $value) {
            SiteSetting::set($key, $value ?: null);
        }

        Notification::make()
            ->title('Réglages sauvegardés')
            ->success()
            ->send();
    }
}
