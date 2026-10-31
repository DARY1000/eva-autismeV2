@php
    $money = fn ($value) => number_format($value, 0, ',', ' ').' F';
    $delta = fn ($value) => $value === null ? '' : '<span class="eva-delta '.($value < 0 ? 'is-down' : 'is-up').'">'.($value > 0 ? '+' : '').$value.'%</span>';
@endphp

<x-filament-panels::page class="fi-dashboard-page">
    <div class="eva-dash-head">
        <div>
            <h1>Bonjour, {{ $firstName }} 👋</h1>
            <p>Voici ce qui se passe aujourd'hui</p>
        </div>
        <div class="eva-dash-actions">
            <a href="{{ url('/') }}" target="_blank" rel="noopener" class="eva-btn">Voir le site</a>
            <a href="{{ $createUrl }}" class="eva-btn is-dark">Nouvelle activité</a>
        </div>
    </div>

    <div class="eva-grid">
        <section class="eva-card">
            <header>
                <div><h2>Dons collectés</h2><p>Paiements confirmés</p></div>
                <select wire:model.live="donationDays" aria-label="Période des dons">
                    <option value="30">1 mois</option>
                    <option value="90">3 mois</option>
                    <option value="365">12 mois</option>
                </select>
            </header>
            <div class="eva-figure">{{ $money($donations['collected']) }} {!! $delta($donations['delta']) !!}</div>
            <ul class="eva-progress">
                @foreach($donations['rows'] as $row)
                    <li>
                        <span>{{ $row['label'] }}</span>
                        <i><b style="width:{{ $row['percent'] }}%"></b></i>
                        <span>{{ $row['count'] }}</span>
                    </li>
                @endforeach
            </ul>
        </section>

        <section class="eva-card eva-card-chart">
            <header>
                <div><h2>Messages reçus</h2><p>Hors spam</p></div>
                <select wire:model.live="messageDays" aria-label="Période des messages">
                    <option value="7">7 jours</option>
                    <option value="30">30 jours</option>
                </select>
            </header>
            <div class="eva-figure">{{ $messages['total'] }} {!! $delta($messages['delta']) !!}</div>
            <svg viewBox="0 0 300 120" preserveAspectRatio="none" class="eva-area" role="img" aria-label="Messages reçus par jour">
                <defs>
                    <linearGradient id="eva-area-fill" x1="0" y1="0" x2="0" y2="1">
                        <stop offset="0" stop-color="#2563eb" stop-opacity=".22"/>
                        <stop offset="1" stop-color="#2563eb" stop-opacity="0"/>
                    </linearGradient>
                </defs>
                <path d="{{ $messages['path']['area'] }}" fill="url(#eva-area-fill)"/>
                <path d="{{ $messages['path']['line'] }}" fill="none" stroke="#2563eb" stroke-width="2.5" vector-effect="non-scaling-stroke" stroke-linejoin="round"/>
            </svg>
            <div class="eva-axis"><span>{{ $messages['from'] }}</span><span>{{ $messages['to'] }}</span></div>
        </section>

        <section class="eva-card">
            <header><div><h2>Derniers donateurs</h2><p>Dons récents</p></div></header>
            <ul class="eva-people">
                @forelse($donors as $donor)
                    <li>
                        <span class="eva-avatar">{{ mb_strtoupper(mb_substr($donor->prenom, 0, 1).mb_substr($donor->nom, 0, 1)) }}</span>
                        <div>
                            <strong>{{ $donor->full_name }}</strong>
                            <small>{{ $money($donor->montant) }} · {{ $donor->status === 'completed' ? 'confirmé' : 'en attente' }}</small>
                        </div>
                    </li>
                @empty
                    <li class="eva-empty">Aucun don pour l'instant</li>
                @endforelse
            </ul>
        </section>

        <section class="eva-card">
            <header><div><h2>Communauté</h2><p>Newsletter et Club Parents</p></div></header>
            <div class="eva-figure">{{ $community['total'] }} <span class="eva-delta is-up">+{{ $community['month'] }}</span></div>
            <div class="eva-bars is-striped">
                @foreach($community['bars'] as $bar)
                    <div title="{{ $bar['count'] }}"><i style="height:{{ max($bar['height'], 4) }}%"></i><span>{{ $bar['label'] }}</span></div>
                @endforeach
            </div>
        </section>

        <section class="eva-card">
            <header>
                <div><h2>Dons par jour</h2><p>Montants confirmés</p></div>
                <select wire:model.live="revenueDays" aria-label="Période des dons par jour">
                    <option value="7">7 jours</option>
                    <option value="30">30 jours</option>
                </select>
            </header>
            <div class="eva-figure">{{ $money($revenue['total']) }}</div>
            <div class="eva-bars is-thin">
                @foreach($revenue['bars'] as $bar)
                    <div title="{{ $money($bar['count']) }}"><i style="height:{{ max($bar['height'], 3) }}%"></i><span>{{ $revenueDays > 7 ? '' : $bar['label'] }}</span></div>
                @endforeach
            </div>
        </section>

        <section class="eva-card">
            <header><div><h2>Jours les plus actifs</h2><p>Sur les 90 derniers jours</p></div></header>
            <div class="eva-bars is-wide">
                @foreach($busyDays as $bar)
                    <div title="{{ $bar['count'] }}"><i style="height:{{ max($bar['height'], 3) }}%"></i><span>{{ $bar['label'] }}</span></div>
                @endforeach
            </div>
        </section>
    </div>

    <x-filament-widgets::widgets :columns="$this->getColumns()" :widgets="$this->getVisibleWidgets()" />
</x-filament-panels::page>
