@extends('layouts.app')

@section('title', 'Nos Projets')
@section('meta_description', 'Découvrez les projets de l\'ONG EVA Autisme au Bénin : sensibilisation, scolarisation inclusive, formation, accompagnement à domicile et club parents.')

@section('content')

<!-- ===================== PAGE HEADER ===================== -->
<div class="page-header">
    <div class="container">
        <h1>Nos Projets</h1>
        <p>Des initiatives concrètes pour l'inclusion et le mieux-être des personnes autistes au Bénin</p>
        <nav class="breadcrumb">
            <a href="{{ route('home') }}">Accueil</a>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="width:14px;height:14px"><polyline points="9 18 15 12 9 6"/></svg>
            <a href="{{ route('actions.projets') }}">Nos Actions</a>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="width:14px;height:14px"><polyline points="9 18 15 12 9 6"/></svg>
            <span>Nos Projets</span>
        </nav>
    </div>
</div>

<!-- ===================== INTRO ===================== -->
<section class="section bg-light">
    <div class="container">
        <div class="section-header reveal">
            <span class="label">Ce que nous mettons en œuvre</span>
            <h2>Nos projets en cours et réalisés</h2>
            <div class="section-divider"></div>
            <p>Depuis 2022, l'ONG EVA Autisme développe des projets variés pour répondre aux besoins des enfants autistes, de leurs familles et des acteurs éducatifs et sociaux au Bénin.</p>
        </div>
    </div>
</section>

<!-- ===================== LISTE DES PROJETS ===================== -->
<section class="section">
    <div class="container">

        @php
        $defaultProjects = [
            [
                'titre'       => 'Éco Sens',
                'categorie'   => 'Sensibilisation',
                'description' => 'Un projet innovant qui associe la sensibilisation à l\'autisme à l\'éducation environnementale. Des ateliers ludiques permettent aux enfants autistes de s\'épanouir dans la nature tout en sensibilisant les communautés aux TSA.',
                'statut'      => 'en_cours',
                'image'       => null,
            ],
            [
                'titre'       => 'Club Parents EVA',
                'categorie'   => 'Soutien familial',
                'description' => 'Un espace d\'échange, de formation et de soutien mutuel pour les parents d\'enfants autistes. Des rencontres mensuelles, des ateliers pratiques et un accompagnement personnalisé pour chaque famille.',
                'statut'      => 'en_cours',
                'image'       => null,
            ],
            [
                'titre'       => 'Programme Scolarisation Inclusive',
                'categorie'   => 'Éducation',
                'description' => 'Un programme de plaidoyer et d\'accompagnement pour faciliter l\'accès des enfants autistes à l\'école ordinaire. Formation des enseignants, aménagements pédagogiques et suivi individualisé.',
                'statut'      => 'en_cours',
                'image'       => null,
            ],
            [
                'titre'       => 'Campagne Sensibilisation TSA',
                'categorie'   => 'Sensibilisation',
                'description' => 'Des campagnes annuelles dans les médias, les écoles et les espaces publics pour diffuser une information juste et accessible sur les Troubles du Spectre de l\'Autisme au sein de la population béninoise.',
                'statut'      => 'terminé',
                'image'       => null,
            ],
            [
                'titre'       => 'Programme Formation Professionnels',
                'categorie'   => 'Formation',
                'description' => 'Renforcement des capacités des professionnels de santé, des enseignants et des travailleurs sociaux pour un meilleur dépistage précoce et une prise en charge adaptée des personnes autistes.',
                'statut'      => 'terminé',
                'image'       => null,
            ],
            [
                'titre'       => 'Projet Accompagnement à Domicile',
                'categorie'   => 'Accompagnement',
                'description' => 'Un dispositif de visites à domicile pour soutenir les familles isolées. Des éducateurs spécialisés se déplacent pour former les parents et proposer des stratégies d\'intervention adaptées au contexte familial.',
                'statut'      => 'en_cours',
                'image'       => null,
            ],
        ];
        $projects = $projects ?? $defaultProjects;
        @endphp

        <div class="grid-3">
            @foreach($projects as $project)
            @php
                $titre       = is_array($project) ? $project['titre']       : $project->titre;
                $categorie   = is_array($project) ? $project['categorie']   : $project->categorie;
                $description = is_array($project) ? $project['description'] : $project->description;
                $statut      = is_array($project) ? $project['statut']      : $project->statut;
                $image       = is_array($project) ? $project['image']       : ($project->image ?? null);
                $id          = is_array($project) ? null                    : ($project->id ?? null);
                $statutLabel = ($statut === 'en_cours') ? 'En cours' : 'Terminé';
                $statutColor = ($statut === 'en_cours') ? '#0055A5' : '#6c757d';
            @endphp
            <div class="card reveal">
                <div class="card-img">
                    @if($image)
                        <img src="{{ asset('storage/' . $image) }}" alt="{{ $titre }}" style="width:100%;height:100%;object-fit:cover;">
                    @else
                        <div style="width:100%;height:100%;background:var(--primary-light);display:flex;align-items:center;justify-content:center;min-height:200px;">
                            <svg viewBox="0 0 24 24" fill="none" stroke="var(--primary)" stroke-width="1.2" style="width:64px;height:64px;opacity:0.35">
                                <rect x="3" y="3" width="7" height="7"/>
                                <rect x="14" y="3" width="7" height="7"/>
                                <rect x="14" y="14" width="7" height="7"/>
                                <rect x="3" y="14" width="7" height="7"/>
                            </svg>
                        </div>
                    @endif
                </div>
                <div class="card-body">
                    <span class="card-tag">{{ $categorie }}</span>
                    <h3 style="font-size:1.1rem;margin:0.6rem 0 0.5rem;">{{ $titre }}</h3>
                    <p style="font-size:0.875rem;color:var(--text-muted);line-height:1.6;margin-bottom:1rem;">{{ $description }}</p>
                    <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:0.75rem;margin-top:auto;">
                        <span style="display:inline-flex;align-items:center;gap:5px;font-size:0.78rem;font-weight:600;color:{{ $statutColor }};background:{{ $statutColor }}18;padding:3px 10px;border-radius:20px;">
                            <span style="width:7px;height:7px;border-radius:50%;background:{{ $statutColor }};display:inline-block;"></span>
                            {{ $statutLabel }}
                        </span>
                        @if($id)
                        <a href="{{ route('actions.projets') }}#projet-{{ $id }}" class="btn btn-blue btn-sm">En savoir plus</a>
                        @else
                        <a href="{{ route('actions.projets') }}" class="btn btn-blue btn-sm">En savoir plus</a>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ===================== CTA ===================== -->
<section style="background:linear-gradient(135deg,var(--primary) 0%,#0073e6 100%);padding:80px 0;color:#fff;">
    <div class="container" style="text-align:center;">
        <div class="reveal">
            <span style="display:inline-block;background:rgba(255,255,255,0.15);color:#fff;font-size:0.75rem;font-weight:700;letter-spacing:2px;text-transform:uppercase;padding:4px 14px;border-radius:30px;margin-bottom:1.25rem;">Soutenez nos projets</span>
            <h2 style="color:#fff;margin-bottom:1rem;">Chaque don compte pour nos actions sur le terrain</h2>
            <p style="color:rgba(255,255,255,0.85);max-width:580px;margin:0 auto 2rem;">
                Vos contributions permettent à EVA Autisme de financer les projets, de former davantage de professionnels et d'accompagner plus de familles béninoises confrontées à l'autisme.
            </p>
            <div style="display:flex;gap:1rem;justify-content:center;flex-wrap:wrap;">
                <a href="{{ route('don') }}" class="btn btn-orange" style="font-size:1rem;padding:0.85rem 2rem;">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:18px;height:18px"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
                    Faire un Don
                </a>
                <a href="{{ route('contact') }}" class="btn btn-white" style="font-size:1rem;padding:0.85rem 2rem;">Devenir Partenaire</a>
            </div>
        </div>
    </div>
</section>

@endsection
