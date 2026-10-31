<?php

namespace App\Filament\Pages;

use App\Filament\Resources\ActivityResource;
use App\Models\ClubMember;
use App\Models\Contact;
use App\Models\Donation;
use App\Models\EventRegistration;
use App\Models\Newsletter;
use Filament\Pages\Dashboard as BaseDashboard;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class Dashboard extends BaseDashboard
{
    protected static ?string $navigationIcon = 'heroicon-o-home';
    protected static ?string $title = 'Tableau de bord';
    protected static ?string $navigationLabel = 'Tableau de bord';

    protected static string $view = 'filament.pages.dashboard';

    public int $donationDays = 30;
    public int $messageDays  = 7;
    public int $revenueDays  = 7;

    public function getHeading(): string
    {
        return '';
    }

    public function getWidgets(): array
    {
        return [
            \App\Filament\Widgets\RecentContactsWidget::class,
            \App\Filament\Widgets\UpcomingEventsWidget::class,
        ];
    }

    public function getColumns(): int | array
    {
        return 2;
    }

    protected function getViewData(): array
    {
        return [
            'firstName'   => strtok(auth()->user()->name, ' '),
            'createUrl'   => ActivityResource::getUrl('create'),
            'donations'   => $this->donationSummary(),
            'messages'    => $this->messageSeries(),
            'donors'      => Donation::whereIn('status', ['completed', 'pending'])->latest()->take(4)->get(),
            'community'   => $this->communityGrowth(),
            'revenue'     => $this->revenueSeries(),
            'busyDays'    => $this->busiestWeekdays(),
        ];
    }

    private function donationSummary(): array
    {
        $since    = now()->subDays($this->donationDays);
        $current  = Donation::where('created_at', '>=', $since)->get(['status', 'montant']);
        $previous = Donation::completed()
            ->whereBetween('created_at', [$since->copy()->subDays($this->donationDays), $since])
            ->sum('montant');

        $collected = (float) $current->where('status', 'completed')->sum('montant');
        $total     = max($current->count(), 1);

        $rows = collect(['completed' => 'Confirmés', 'pending' => 'En attente', 'failed' => 'Échoués'])
            ->map(function (string $label, string $status) use ($current, $total) {
                $count = $current->where('status', $status)->count();

                return ['label' => $label, 'count' => $count, 'percent' => (int) round($count / $total * 100)];
            });

        return ['collected' => $collected, 'delta' => $this->delta($collected, (float) $previous), 'rows' => $rows];
    }

    private function messageSeries(): array
    {
        $days   = $this->lastDays($this->messageDays);
        $counts = Contact::real()
            ->where('created_at', '>=', $days->first())
            ->pluck('created_at')
            ->countBy(fn (Carbon $date) => $date->toDateString());

        $series   = $days->map(fn (Carbon $day) => $counts[$day->toDateString()] ?? 0);
        $previous = Contact::real()
            ->whereBetween('created_at', [$days->first()->copy()->subDays($this->messageDays), $days->first()])
            ->count();

        return [
            'total' => $series->sum(),
            'delta' => $this->delta($series->sum(), $previous),
            'path'  => $this->areaPath($series),
            'from'  => $days->first()->locale('fr')->isoFormat('ddd D MMM'),
            'to'    => $days->last()->locale('fr')->isoFormat('ddd D MMM'),
        ];
    }

    /** Inscriptions newsletter et Club Parents des sept derniers mois. */
    private function communityGrowth(): array
    {
        $months = collect(range(6, 0))->map(fn (int $ago) => now()->startOfMonth()->subMonths($ago));
        $since  = $months->first();

        $joined = Newsletter::where('created_at', '>=', $since)->pluck('created_at')
            ->merge(ClubMember::where('created_at', '>=', $since)->pluck('created_at'))
            ->countBy(fn (Carbon $date) => $date->format('Y-m'));

        $bars = $months->map(fn (Carbon $month) => [
            'label' => $month->locale('fr')->isoFormat('MMM'),
            'count' => $joined[$month->format('Y-m')] ?? 0,
        ]);

        return [
            'total' => Newsletter::where('is_active', true)->count() + ClubMember::where('status', 'active')->count(),
            'month' => $bars->last()['count'],
            'bars'  => $this->scaled($bars),
        ];
    }

    private function revenueSeries(): array
    {
        $days    = $this->lastDays($this->revenueDays);
        $amounts = Donation::completed()
            ->where('created_at', '>=', $days->first())
            ->get(['created_at', 'montant'])
            ->groupBy(fn (Donation $donation) => $donation->created_at->toDateString())
            ->map->sum('montant');

        $bars = $days->map(fn (Carbon $day) => [
            'label' => $day->locale('fr')->isoFormat($this->revenueDays > 7 ? 'D' : 'dd'),
            'count' => (float) ($amounts[$day->toDateString()] ?? 0),
        ]);

        return ['total' => $bars->sum('count'), 'bars' => $this->scaled($bars)];
    }

    /** Messages, inscriptions et dons des 90 derniers jours, par jour de semaine. */
    private function busiestWeekdays(): array
    {
        $since = now()->subDays(90);

        $dates = Contact::real()->where('created_at', '>=', $since)->pluck('created_at')
            ->merge(EventRegistration::where('created_at', '>=', $since)->pluck('created_at'))
            ->merge(Donation::where('created_at', '>=', $since)->pluck('created_at'))
            ->countBy(fn (Carbon $date) => $date->dayOfWeekIso);

        $labels = [1 => 'Lun', 2 => 'Mar', 3 => 'Mer', 4 => 'Jeu', 5 => 'Ven', 6 => 'Sam', 7 => 'Dim'];

        return $this->scaled(collect($labels)->map(fn (string $label, int $day) => [
            'label' => $label,
            'count' => $dates[$day] ?? 0,
        ])->values());
    }

    private function lastDays(int $count): Collection
    {
        return collect(range($count - 1, 0))->map(fn (int $ago) => now()->startOfDay()->subDays($ago));
    }

    private function delta(float $current, float $previous): ?int
    {
        return $previous > 0 ? (int) round(($current - $previous) / $previous * 100) : null;
    }

    /** Ajoute à chaque barre sa hauteur en pourcentage de la plus grande. */
    private function scaled(Collection $bars): array
    {
        $max = max($bars->max('count'), 1);

        return $bars->map(fn (array $bar) => $bar + ['height' => (int) round($bar['count'] / $max * 100)])->all();
    }

    /** Tracé SVG (viewBox 300×120) ; la surface fermée s'obtient en ajoutant le bas du cadre. */
    private function areaPath(Collection $series): array
    {
        $max  = max($series->max(), 1);
        $step = 300 / max($series->count() - 1, 1);

        $line = $series->values()
            ->map(fn (int $value, int $i) => ($i ? 'L' : 'M').round($i * $step, 1).' '.round(110 - $value / $max * 95, 1))
            ->implode(' ');

        return ['line' => $line, 'area' => $line.' L300 120 L0 120 Z'];
    }
}
