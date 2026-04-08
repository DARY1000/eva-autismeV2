@extends('layouts.app')

@section('title', 'Nos Publications')
@section('meta_description', 'Découvrez les publications de l\'ONG EVA Autisme : rapports, guides pratiques, articles et présentations sur l\'autisme au Bénin.')

@section('styles')
<style>
    .publications-filters {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        margin-bottom: 2.5rem;
    }
    .filter-btn {
        padding: 0.5rem 1.25rem;
        border: 2px solid #0055A5;
        background: transparent;
        color: #0055A5;
        border-radius: 25px;
        font-size: 0.9rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.25s ease;
        font-family: inherit;
    }
    .filter-btn:hover,
    .filter-btn.active {
        background: #0055A5;
        color: #fff;
    }
    .pub-card {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 2px 16px rgba(0,85,165,0.08);
        overflow: hidden;
        display: flex;
        flex-direction: column;
        transition: transform 0.25s ease, box-shadow 0.25s ease;
        border: 1px solid #e8f0fb;
    }
    .pub-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 32px rgba(0,85,165,0.14);
    }
    .pub-card-header {
        background: linear-gradient(135deg, #0055A5 0%, #003d7a 100%);
        padding: 2rem 1.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 130px;
        position: relative;
    }
    .pub-card-header svg {
        width: 56px;
        height: 56px;
        color: rgba(255,255,255,0.9);
    }
    .pub-type-badge {
        position: absolute;
        top: 1rem;
        right: 1rem;
        background: rgba(255,255,255,0.2);
        color: #fff;
        font-size: 0.72rem;
        font-weight: 600;
        padding: 0.25rem 0.6rem;
        border-radius: 20px;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
    .pub-card-body {
        padding: 1.5rem;
        flex: 1;
        display: flex;
        flex-direction: column;
    }
    .pub-card-body h3 {
        font-size: 1rem;
        font-weight: 700;
        color: #1a2540;
        margin-bottom: 0.5rem;
        line-height: 1.4;
    }
    .pub-meta {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.8rem;
        color: #6b7280;
        margin-bottom: 0.75rem;
    }
    .pub-meta svg {
        width: 14px;
        height: 14px;
        flex-shrink: 0;
    }
    .pub-desc {
        font-size: 0.88rem;
        color: #4b5563;
        line-height: 1.6;
        flex: 1;
        margin-bottom: 1.25rem;
    }
    .pub-card-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 1rem 1.5rem;
        border-top: 1px solid #f0f4fa;
        background: #fafbff;
    }
    .pub-file-info {
        display: flex;
        align-items: center;
        gap: 0.4rem;
        font-size: 0.78rem;
        color: #6b7280;
    }
    .pub-file-info svg {
        width: 14px;
        height: 14px;
    }
    .publications-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.75rem;
    }
    @media (max-width: 992px) {
        .publications-grid { grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width: 600px) {
        .publications-grid { grid-template-columns: 1fr; }
    }
    .submit-section {
        background: linear-gradient(135deg, #0055A5 0%, #003d7a 100%);
        border-radius: 16px;
        padding: 3rem;
        text-align: center;
        color: #fff;
        margin-top: 4rem;
    }
    .submit-section h2 {
        font-size: 1.6rem;
        font-weight: 700;
        margin-bottom: 1rem;
        color: #fff;
    }
    .submit-section p {
        font-size: 1rem;
        opacity: 0.88;
        max-width: 540px;
        margin: 0 auto 1.75rem;
        line-height: 1.6;
    }
    .badge-rapport    { --bcolor: #0055A5; }
    .badge-guide      { --bcolor: #059669; }
    .badge-article    { --bcolor: #7c3aed; }
    .badge-presentation { --bcolor: #E8501A; }
    .badge-strategie  { --bcolor: #d97706; }
    .pub-card-header.rapport      { background: linear-gradient(135deg, #0055A5 0%, #003d7a 100%); }
    .pub-card-header.guide        { background: linear-gradient(135deg, #059669 0%, #065f46 100%); }
    .pub-card-header.article      { background: linear-gradient(135deg, #7c3aed 0%, #4c1d95 100%); }
    .pub-card-header.presentation { background: linear-gradient(135deg, #E8501A 0%, #b73d14 100%); }
    .pub-card-header.strategie    { background: linear-gradient(135deg, #d97706 0%, #92400e 100%); }
</style>
@endsection

@section('content')

<!-- ===== PAGE HEADER ===== -->
<div class="page-header">
    <div class="container" style="position:relative;z-index:1;">
        <h1 style="color:#fff;">Nos Publications</h1>
        <p style="color:rgba(255,255,255,0.88);max-width:600px;margin-top:0.75rem;">Rapports, guides pratiques, articles de recherche et présentations institutionnelles produits par l'ONG EVA Autisme pour promouvoir la compréhension de l'autisme au Bénin.</p>
        <nav class="breadcrumb" aria-label="Fil d'Ariane">
            <a href="{{ route('home') }}" style="color:rgba(255,255,255,0.88);">Accueil</a>
            <span style="color:rgba(255,255,255,0.5);">›</span>
            <a href="#" style="color:rgba(255,255,255,0.88);">Ressources</a>
            <span style="color:rgba(255,255,255,0.5);">›</span>
            <span style="color:rgba(255,255,255,0.72);">Nos Publications</span>
        </nav>
    </div>
</div>

<!-- ===== PUBLICATIONS SECTION ===== -->
<section class="section">
    <div class="container">

        <!-- Filtres -->
        <div class="publications-filters reveal" id="pubFilters" role="group" aria-label="Filtrer les publications">
            <button class="filter-btn active" data-filter="tous" onclick="filterPubs(this, 'tous')">
                Tous
            </button>
            <button class="filter-btn" data-filter="rapport" onclick="filterPubs(this, 'rapport')">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:15px;height:15px;vertical-align:middle;margin-right:4px"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                Rapports
            </button>
            <button class="filter-btn" data-filter="guide" onclick="filterPubs(this, 'guide')">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:15px;height:15px;vertical-align:middle;margin-right:4px"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
                Guides Pratiques
            </button>
            <button class="filter-btn" data-filter="article" onclick="filterPubs(this, 'article')">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:15px;height:15px;vertical-align:middle;margin-right:4px"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                Articles
            </button>
            <button class="filter-btn" data-filter="presentation" onclick="filterPubs(this, 'presentation')">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:15px;height:15px;vertical-align:middle;margin-right:4px"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
                Présentations
            </button>
        </div>

        <!-- Grille -->
        <div class="publications-grid" id="pubGrid">

            @php
            $fallbackPubs = [
                [
                    'titre'       => 'Guide de sensibilisation à l\'autisme au Bénin',
                    'categorie'   => 'rapport',
                    'label'       => 'Rapport',
                    'annee'       => '2024',
                    'description' => 'Un rapport complet sur l\'état de la sensibilisation à l\'autisme au Bénin, présentant les données épidémiologiques, les défis d\'inclusion et les recommandations pour les politiques publiques.',
                    'file_url'    => '#',
                    'format'      => 'PDF · 2,4 Mo',
                    'action'      => 'Télécharger',
                ],
                [
                    'titre'       => 'Eco Sens et Autisme : Pour un environnement inclusif',
                    'categorie'   => 'guide',
                    'label'       => 'Guide Pratique',
                    'annee'       => '2023',
                    'description' => 'Guide pratique destiné aux familles, enseignants et éducateurs pour aménager des environnements adaptés aux besoins sensoriels et cognitifs des enfants autistes.',
                    'file_url'    => '#',
                    'format'      => 'PDF · 1,8 Mo',
                    'action'      => 'Télécharger',
                ],
                [
                    'titre'       => 'Plan Stratégique ONG EVA Autisme 2023–2026',
                    'categorie'   => 'strategie',
                    'label'       => 'Document Stratégique',
                    'annee'       => '2023',
                    'description' => 'Le plan stratégique triennal d\'EVA Autisme définissant les axes prioritaires, les objectifs, les indicateurs de performance et la feuille de route pour l\'inclusion des personnes autistes au Bénin.',
                    'file_url'    => '#',
                    'format'      => 'PDF · 3,1 Mo',
                    'action'      => 'Consulter',
                ],
                [
                    'titre'       => 'Types de Partenariats EVA Autisme : Guide à l\'intention des partenaires',
                    'categorie'   => 'guide',
                    'label'       => 'Guide Partenariat',
                    'annee'       => '2023',
                    'description' => 'Ce guide présente les différentes formes de partenariats proposés par EVA Autisme : partenariats institutionnels, financiers, techniques et opérationnels. Il détaille les modalités d\'engagement et les avantages mutuels.',
                    'file_url'    => '#',
                    'format'      => 'PDF · 980 Ko',
                    'action'      => 'Télécharger',
                ],
                [
                    'titre'       => 'Présentation Institutionnelle EVA Autisme (EVAA)',
                    'categorie'   => 'presentation',
                    'label'       => 'Présentation',
                    'annee'       => '2024',
                    'description' => 'Présentation officielle de l\'ONG EVA Autisme : mission, vision, valeurs, programmes phares, chiffres d\'impact et perspectives de développement. Document de référence pour nos partenaires et bailleurs.',
                    'file_url'    => '#',
                    'format'      => 'PDF · 5,2 Mo',
                    'action'      => 'Consulter',
                ],
                [
                    'titre'       => 'Comprendre les Troubles du Spectre de l\'Autisme en contexte africain',
                    'categorie'   => 'article',
                    'label'       => 'Article',
                    'annee'       => '2022',
                    'description' => 'Cet article analyse les spécificités du diagnostic et de l\'accompagnement de l\'autisme en Afrique subsaharienne, en tenant compte des représentations culturelles, du système de santé et des ressources disponibles au Bénin.',
                    'file_url'    => '#',
                    'format'      => 'PDF · 620 Ko',
                    'action'      => 'Consulter',
                ],
            ];
            $publications = isset($publications) && count($publications) ? $publications : $fallbackPubs;

            $iconColors = [
                'rapport'      => 'rapport',
                'guide'        => 'guide',
                'article'      => 'article',
                'presentation' => 'presentation',
                'strategie'    => 'strategie',
            ];
            @endphp

            @foreach($publications as $pub)
            @php
                $cat   = is_array($pub) ? $pub['categorie']   : $pub->categorie;
                $titre = is_array($pub) ? $pub['titre']        : $pub->titre;
                $lbl   = is_array($pub) ? $pub['label']        : $pub->label;
                $year  = is_array($pub) ? $pub['annee']        : $pub->annee;
                $desc  = is_array($pub) ? $pub['description']  : $pub->description;
                $url   = is_array($pub) ? $pub['file_url']     : ($pub->file_url ?? '#');
                $fmt   = is_array($pub) ? $pub['format']       : ($pub->format ?? 'PDF');
                $btn   = is_array($pub) ? $pub['action']       : ($pub->action ?? 'Télécharger');
                $colorClass = $iconColors[$cat] ?? 'rapport';
            @endphp
            <article class="pub-card reveal" data-category="{{ $cat }}">
                <div class="pub-card-header {{ $colorClass }}">
                    <span class="pub-type-badge">{{ $lbl }}</span>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                        <polyline points="14 2 14 8 20 8"/>
                        <line x1="16" y1="13" x2="8" y2="13"/>
                        <line x1="16" y1="17" x2="8" y2="17"/>
                        <line x1="10" y1="9" x2="8" y2="9"/>
                    </svg>
                </div>
                <div class="pub-card-body">
                    <h3>{{ $titre }}</h3>
                    <div class="pub-meta">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                        <span>{{ $year }}</span>
                        <span>·</span>
                        <span>EVA Autisme</span>
                    </div>
                    <p class="pub-desc">{{ $desc }}</p>
                </div>
                <div class="pub-card-footer">
                    <div class="pub-file-info">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"/><polyline points="13 2 13 9 20 9"/></svg>
                        {{ $fmt }}
                    </div>
                    <a href="{{ $url }}" class="btn btn-sm {{ $btn === 'Télécharger' ? 'btn-blue' : 'btn-orange' }}"
                       @if($url !== '#' && $btn === 'Télécharger') download @endif>
                        @if($btn === 'Télécharger')
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:15px;height:15px;margin-right:4px"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                        @else
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:15px;height:15px;margin-right:4px"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                        @endif
                        {{ $btn }}
                    </a>
                </div>
            </article>
            @endforeach

        </div>

        <!-- Message si aucun résultat -->
        <div id="noResults" style="display:none; text-align:center; padding:3rem 0; color:#6b7280;">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="width:48px;height:48px;margin:0 auto 1rem;display:block;opacity:0.4"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            <p>Aucune publication trouvée dans cette catégorie.</p>
        </div>

        <!-- CTA soumettre une publication -->
        <div class="submit-section reveal">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="width:52px;height:52px;margin:0 auto 1.25rem;display:block;opacity:0.9;color:#fff">
                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                <polyline points="14 2 14 8 20 8"/>
                <line x1="12" y1="18" x2="12" y2="12"/>
                <line x1="9" y1="15" x2="15" y2="15"/>
            </svg>
            <h2>Vous souhaitez soumettre une publication ?</h2>
            <p>Vous êtes chercheur, praticien ou institution partenaire et vous disposez d'une ressource sur l'autisme en contexte africain ? Partagez-la avec notre communauté.</p>
            <a href="{{ route('contact') }}" class="btn btn-white">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:16px;height:16px;margin-right:6px"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                Nous contacter
            </a>
        </div>

    </div>
</section>

@endsection

@section('scripts')
<script>
function filterPubs(btn, filter) {
    // Mettre à jour les boutons
    document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');

    // Filtrer les cartes
    const cards = document.querySelectorAll('#pubGrid .pub-card');
    let visible = 0;
    cards.forEach(card => {
        const cat = card.getAttribute('data-category');
        if (filter === 'tous' || cat === filter) {
            card.style.display = '';
            visible++;
        } else {
            card.style.display = 'none';
        }
    });

    // Afficher message si aucun résultat
    document.getElementById('noResults').style.display = visible === 0 ? 'block' : 'none';
}
</script>
@endsection
