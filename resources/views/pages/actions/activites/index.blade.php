@extends('layouts.app')

@section('title', 'Nos Activités')
@section('meta_description', 'Découvrez les activités menées par l\'ONG EVA Autisme au Bénin, année après année : sensibilisation, formations, plaidoyer et rencontres internationales.')

@section('styles')
<style>
.activity-hero { background:linear-gradient(135deg,var(--primary) 0%,#0073e6 100%);padding:5rem 0 4rem;color:#fff;text-align:center; }
.activity-hero h1 { color:#fff;margin-bottom:1rem; }
.activity-hero p { color:rgba(255,255,255,0.88);font-size:1.1rem;max-width:620px;margin:0 auto; }
.activity-filters { display:flex;flex-wrap:wrap;gap:0.5rem;margin-bottom:0.75rem; }
.activity-filters a { padding:0.45rem 1rem;border-radius:30px;background:#fff;border:1px solid var(--border);color:var(--text-mid);font-size:0.85rem;font-weight:600; }
.activity-filters a.active { background:var(--primary);border-color:var(--primary);color:#fff; }
.activity-year { font-size:1.6rem;color:var(--primary);margin:2.5rem 0 1.25rem;padding-bottom:0.5rem;border-bottom:2px solid var(--border); }
.activity-grid { display:grid;grid-template-columns:repeat(auto-fill,minmax(310px,1fr));gap:1.5rem; }
.activity-card { background:#fff;border-radius:var(--radius-lg);overflow:hidden;box-shadow:var(--shadow-sm);display:flex;flex-direction:column;color:inherit;transition:box-shadow 0.2s; }
.activity-card:hover { box-shadow:var(--shadow-md); }
.activity-card-img { aspect-ratio:16/9;background:var(--primary-light);display:flex;align-items:center;justify-content:center;color:var(--primary);font-weight:700;padding:1rem;text-align:center; }
.activity-card-img img { width:100%;height:100%;object-fit:cover; }
.activity-card-body { padding:1.25rem 1.4rem 1.5rem; }
.activity-tag { display:inline-block;font-size:0.72rem;font-weight:700;padding:2px 10px;border-radius:20px;background:var(--primary-light);color:var(--primary);margin-bottom:0.6rem; }
.activity-card h3 { font-size:1.05rem;margin-bottom:0.4rem; }
.activity-card time { display:block;font-size:0.82rem;color:var(--text-muted);margin-bottom:0.6rem; }
.activity-card p { font-size:0.9rem;margin:0; }
</style>
@endsection

@section('content')
<section class="activity-hero">
    <div class="container">
        <h1>Nos Activités</h1>
        <p>Tout ce que l'ONG EVA Autisme a organisé ou rejoint, année après année, au service des personnes autistes et de leurs familles.</p>
    </div>
</section>

<section class="section">
    <div class="container">
        <nav class="activity-filters" aria-label="Filtrer par année">
            <a href="{{ route('actions.activites', array_filter(['categorie' => $category])) }}" class="{{ $year ? '' : 'active' }}">Toutes les années</a>
            @foreach($years as $y)
                <a href="{{ route('actions.activites', array_filter(['annee' => $y, 'categorie' => $category])) }}" class="{{ $year == $y ? 'active' : '' }}">{{ $y }}</a>
            @endforeach
        </nav>
        <nav class="activity-filters" aria-label="Filtrer par catégorie">
            <a href="{{ route('actions.activites', array_filter(['annee' => $year])) }}" class="{{ $category ? '' : 'active' }}">Toutes les catégories</a>
            @foreach($categories as $key => $label)
                <a href="{{ route('actions.activites', array_filter(['annee' => $year, 'categorie' => $key])) }}" class="{{ $category === $key ? 'active' : '' }}">{{ $label }}</a>
            @endforeach
        </nav>

        @forelse($activitiesByYear as $activityYear => $activities)
            <h2 class="activity-year">{{ $activityYear }}</h2>
            <div class="activity-grid">
                @foreach($activities as $activity)
                    <a href="{{ route('actions.activites.show', $activity) }}" class="activity-card">
                        <div class="activity-card-img">
                            @if($activity->cover)
                                <img src="{{ asset('storage/'.$activity->cover) }}" alt="{{ $activity->title }}" loading="lazy">
                            @else
                                {{ $activity->category_label }}
                            @endif
                        </div>
                        <div class="activity-card-body">
                            <span class="activity-tag">{{ $activity->category_label }}</span>
                            <h3>{{ $activity->title }}</h3>
                            <time datetime="{{ $activity->start_date->toDateString() }}">{{ $activity->period_label }}@if($activity->location) · {{ $activity->location }}@endif</time>
                            <p>{{ Str::limit($activity->summary, 130) }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        @empty
            <p style="text-align:center;margin-top:3rem;">Aucune activité pour cette sélection.</p>
        @endforelse
    </div>
</section>
@endsection
