@extends('layouts.app')

@section('title', 'Médias')
@section('meta_description', 'Galerie photos, vidéos et créations artistiques des enfants autistes suivis par l\'ONG EVA Autisme au Bénin.')

@section('styles')
<style>
    /* Tabs */
    .media-tabs-nav {
        display: flex;
        gap: 0;
        border-bottom: 2px solid #e5e7eb;
        margin-bottom: 2.5rem;
        overflow-x: auto;
    }
    .media-tab-btn {
        background: none;
        border: none;
        padding: 0.85rem 1.75rem;
        font-size: 0.95rem;
        font-weight: 600;
        color: #6b7280;
        cursor: pointer;
        font-family: inherit;
        border-bottom: 3px solid transparent;
        margin-bottom: -2px;
        white-space: nowrap;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        transition: color 0.2s;
    }
    .media-tab-btn:hover { color: #0055A5; }
    .media-tab-btn.active {
        color: #0055A5;
        border-bottom-color: #0055A5;
    }
    .media-tab-btn svg { width: 18px; height: 18px; }
    .media-tab-pane { display: none; }
    .media-tab-pane.active { display: block; }

    /* Media Grid photos */
    .media-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 0.75rem;
    }
    @media (max-width: 1024px) { .media-grid { grid-template-columns: repeat(3, 1fr); } }
    @media (max-width: 640px)  { .media-grid { grid-template-columns: repeat(2, 1fr); } }

    .media-item {
        position: relative;
        border-radius: 10px;
        overflow: hidden;
        aspect-ratio: 1;
        cursor: pointer;
        background: #e8f0fb;
    }
    .media-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: transform 0.35s ease;
    }
    .media-item:hover img { transform: scale(1.07); }
    .media-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(180deg, transparent 50%, rgba(0,85,165,0.75) 100%);
        opacity: 0;
        transition: opacity 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        padding: 1rem;
    }
    .media-item:hover .media-overlay { opacity: 1; }
    .media-overlay svg { width: 36px; height: 36px; color: #fff; margin-bottom: 0.5rem; }
    .media-overlay span { color: #fff; font-size: 0.82rem; font-weight: 500; text-align: center; }

    /* Placeholder SVG photos */
    .photo-placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        font-size: 0.8rem;
        font-weight: 500;
        color: #fff;
    }
    .photo-placeholder svg { width: 36px; height: 36px; margin-bottom: 0.5rem; opacity: 0.7; }

    /* Video cards */
    .video-card {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 2px 16px rgba(0,85,165,0.08);
        overflow: hidden;
        border: 1px solid #e8f0fb;
        transition: transform 0.25s, box-shadow 0.25s;
    }
    .video-card:hover { transform: translateY(-4px); box-shadow: 0 8px 32px rgba(0,85,165,0.14); }
    .video-thumbnail {
        position: relative;
        background: #0f172a;
        aspect-ratio: 16/9;
        overflow: hidden;
    }
    .video-thumbnail iframe {
        width: 100%;
        height: 100%;
        border: none;
        display: block;
    }
    .video-thumb-placeholder {
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, #1e3a5f 0%, #0055A5 100%);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }
    .video-thumb-placeholder svg { width: 52px; height: 52px; color: rgba(255,255,255,0.85); }
    .video-thumb-placeholder span { color: rgba(255,255,255,0.65); font-size: 0.82rem; }
    .play-overlay {
        position: absolute;
        inset: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(0,0,0,0.25);
        transition: background 0.25s;
    }
    .play-overlay:hover { background: rgba(0,0,0,0.4); }
    .play-btn-circle {
        width: 56px;
        height: 56px;
        background: rgba(255,255,255,0.95);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 16px rgba(0,0,0,0.3);
    }
    .play-btn-circle svg { width: 22px; height: 22px; color: #0055A5; margin-left: 3px; }
    .video-info { padding: 1.25rem; }
    .video-info h3 { font-size: 0.95rem; font-weight: 700; color: #1a2540; margin-bottom: 0.5rem; }
    .video-info p  { font-size: 0.85rem; color: #6b7280; line-height: 1.55; }
    .grid-3 { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.75rem; }
    @media (max-width: 900px) { .grid-3 { grid-template-columns: repeat(2, 1fr); } }
    @media (max-width: 600px) { .grid-3 { grid-template-columns: 1fr; } }

    /* Créations section */
    .creations-intro {
        background: linear-gradient(135deg, #fff8f5 0%, #fef3e8 100%);
        border-radius: 12px;
        padding: 2rem;
        margin-bottom: 2.5rem;
        display: flex;
        align-items: flex-start;
        gap: 1.25rem;
    }
    .creations-intro svg { width: 42px; height: 42px; color: #E8501A; flex-shrink: 0; margin-top: 0.2rem; }
    .creations-intro h2 { font-size: 1.2rem; font-weight: 700; color: #1a2540; margin-bottom: 0.5rem; }
    .creations-intro p  { font-size: 0.9rem; color: #4b5563; line-height: 1.6; margin: 0; }

    .creation-item {
        position: relative;
        border-radius: 10px;
        overflow: hidden;
        aspect-ratio: 1;
        cursor: pointer;
        background: #fef3e8;
        border: 2px solid transparent;
        transition: border-color 0.25s, transform 0.25s;
    }
    .creation-item:hover { border-color: #E8501A; transform: scale(1.02); }
    .creation-item img { width: 100%; height: 100%; object-fit: cover; }
    .creation-item .media-overlay { background: linear-gradient(180deg, transparent 50%, rgba(232,80,26,0.75) 100%); }

    /* Newsletter section */
    .newsletter-band {
        background: linear-gradient(135deg, #0055A5 0%, #003d7a 100%);
        border-radius: 16px;
        padding: 3rem 2rem;
        text-align: center;
        color: #fff;
        margin-top: 4rem;
    }
    .newsletter-band h2 { font-size: 1.6rem; font-weight: 700; margin-bottom: 0.75rem; color: #fff; }
    .newsletter-band p  { color: #fff; opacity: 0.88; margin-bottom: 1.75rem; max-width: 500px; margin-left: auto; margin-right: auto; }
    .newsletter-form { display: flex; gap: 0.75rem; max-width: 460px; margin: 0 auto; flex-wrap: wrap; justify-content: center; }
    .newsletter-form input[type="email"] {
        flex: 1;
        min-width: 220px;
        padding: 0.75rem 1.1rem;
        border-radius: 8px;
        border: none;
        font-size: 0.95rem;
        outline: none;
        font-family: inherit;
    }
</style>
@endsection

@section('content')

<!-- ===== PAGE HEADER ===== -->
<div class="page-header">
    <div class="container" style="position:relative;z-index:1;">
        <h1 style="color:#fff;">Médiathèque EVA Autisme</h1>
        <p style="color:rgba(255,255,255,0.88);max-width:600px;margin-top:0.75rem;">Photos, vidéos et créations artistiques témoignant de nos activités, de nos événements et du talent extraordinaire de nos enfants accompagnés.</p>
        <nav class="breadcrumb" aria-label="Fil d'Ariane">
            <a href="{{ route('home') }}" style="color:rgba(255,255,255,0.88);">Accueil</a>
            <span style="color:rgba(255,255,255,0.5);">›</span>
            <a href="#" style="color:rgba(255,255,255,0.88);">Ressources</a>
            <span style="color:rgba(255,255,255,0.5);">›</span>
            <span style="color:rgba(255,255,255,0.72);">Médias</span>
        </nav>
    </div>
</div>

<!-- ===== TABS ===== -->
<section class="section">
    <div class="container">

        <!-- Navigation tabs -->
        <div class="media-tabs-nav reveal" role="tablist" aria-label="Catégories médias">
            <button class="media-tab-btn active" onclick="switchTab(this, 'photos')" role="tab" aria-selected="true">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                Photos
            </button>
            <button class="media-tab-btn" onclick="switchTab(this, 'videos')" role="tab" aria-selected="false">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="23 7 16 12 23 17 23 7"/><rect x="1" y="5" width="15" height="14" rx="2" ry="2"/></svg>
                Vidéos
            </button>
            <button class="media-tab-btn" onclick="switchTab(this, 'creations')" role="tab" aria-selected="false">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 19l7-7 3 3-7 7-3-3z"/><path d="M18 13l-1.5-7.5L2 2l3.5 14.5L13 18l5-5z"/><path d="M2 2l7.586 7.586"/><circle cx="11" cy="11" r="2"/></svg>
                Créations des Enfants
            </button>
        </div>

        <!-- ===== ONGLET PHOTOS ===== -->
        <div class="media-tab-pane active" id="tab-photos" role="tabpanel">
            <div class="media-grid">

                @php
                $photoColors = [
                    ['bg' => '#0055A5', 'label' => 'Sensibilisation à l\'école'],
                    ['bg' => '#E8501A', 'label' => 'Journée mondiale autisme'],
                    ['bg' => '#059669', 'label' => 'Atelier parents'],
                    ['bg' => '#7c3aed', 'label' => 'Séance thérapeutique'],
                    ['bg' => '#d97706', 'label' => 'Formation éducateurs'],
                    ['bg' => '#dc2626', 'label' => 'Conférence publique'],
                    ['bg' => '#0891b2', 'label' => 'Activités enfants'],
                    ['bg' => '#be185d', 'label' => 'Club Parents'],
                ];
                $photos = isset($photos) && count($photos) ? $photos : $photoColors;
                @endphp

                @foreach($photos as $idx => $photo)
                @php
                    $isModel = is_object($photo);
                    $imgSrc  = $isModel ? $photo->url         : null;
                    $imgAlt  = $isModel ? $photo->description : $photo['label'];
                    $bgColor = $isModel ? '#0055A5'           : $photo['bg'];
                @endphp
                <div class="media-item reveal" data-lightbox="{{ $isModel ? $photo->url : '' }}" onclick="openLightbox(this)">
                    @if($isModel && $imgSrc)
                    <img src="{{ $imgSrc }}" alt="{{ $imgAlt }}" loading="lazy">
                    @else
                    <div style="position:absolute;inset:0;background:{{ $bgColor }};">
                        <div class="photo-placeholder">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <rect x="3" y="3" width="18" height="18" rx="2"/>
                                <circle cx="8.5" cy="8.5" r="1.5"/>
                                <polyline points="21 15 16 10 5 21"/>
                            </svg>
                            <span style="text-align:center;padding:0 0.5rem;line-height:1.3;">{{ $imgAlt }}</span>
                        </div>
                    </div>
                    @endif
                    <div class="media-overlay">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/><line x1="11" y1="8" x2="11" y2="14"/><line x1="8" y1="11" x2="14" y2="11"/></svg>
                        <span>{{ $imgAlt }}</span>
                    </div>
                </div>
                @endforeach

            </div>

            <div style="text-align:center; margin-top:2rem; color:#6b7280; font-size:0.9rem;">
                <p>Cliquez sur une photo pour l'agrandir &nbsp;·&nbsp; Nos photos sont disponibles pour les médias sur demande.</p>
                <a href="{{ route('contact') }}" class="btn btn-sm btn-blue" style="margin-top:0.75rem; display:inline-flex; align-items:center; gap:6px;">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:15px;height:15px"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                    Demander des visuels presse
                </a>
            </div>
        </div>

        <!-- ===== ONGLET VIDÉOS ===== -->
        <div class="media-tab-pane" id="tab-videos" role="tabpanel">

            @php
            $fallbackVideos = [
                [
                    'titre'       => 'Journée Mondiale de Sensibilisation à l\'Autisme 2024 au Bénin',
                    'description' => 'Retour en images sur la grande journée de sensibilisation organisée par EVA Autisme à Cotonou, avec la participation de centaines de citoyens, de familles et d\'institutions partenaires.',
                    'embed_url'   => '',
                ],
                [
                    'titre'       => 'Témoignages de familles accompagnées par EVA Autisme',
                    'description' => 'Des parents partagent leur expérience avec EVA Autisme : comment l\'ONG les a aidés à mieux comprendre le diagnostic de leur enfant et à accéder aux ressources adaptées.',
                    'embed_url'   => '',
                ],
                [
                    'titre'       => 'Formation sur les Troubles du Spectre de l\'Autisme – Séance 1',
                    'description' => 'Extrait de la formation destinée aux enseignants du primaire sur l\'identification précoce des signes de l\'autisme et les stratégies d\'inclusion en classe.',
                    'embed_url'   => '',
                ],
            ];
            $videos = isset($videos) && count($videos) ? $videos : $fallbackVideos;
            @endphp

            <div class="grid-3">
                @foreach($videos as $video)
                @php
                    $vtitle = is_array($video) ? $video['titre']       : $video->titre;
                    $vdesc  = is_array($video) ? $video['description'] : $video->description;
                    $vembed = is_array($video) ? $video['embed_url']   : ($video->embed_url ?? '');
                @endphp
                <div class="video-card reveal">
                    <div class="video-thumbnail">
                        @if($vembed)
                        <iframe src="{{ $vembed }}" allowfullscreen title="{{ $vtitle }}" loading="lazy"></iframe>
                        @else
                        <div class="video-thumb-placeholder">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <polygon points="23 7 16 12 23 17 23 7"/>
                                <rect x="1" y="5" width="15" height="14" rx="2" ry="2"/>
                            </svg>
                            <span>Vidéo à ajouter</span>
                        </div>
                        <div class="play-overlay">
                            <div class="play-btn-circle">
                                <svg viewBox="0 0 24 24" fill="currentColor"><polygon points="5 3 19 12 5 21 5 3"/></svg>
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="video-info">
                        <h3>{{ $vtitle }}</h3>
                        <p>{{ $vdesc }}</p>
                    </div>
                </div>
                @endforeach
            </div>

            <div style="text-align:center; margin-top:2rem; color:#6b7280; font-size:0.9rem;">
                <p>Retrouvez toutes nos vidéos sur notre chaîne YouTube et sur nos réseaux sociaux.</p>
                <a href="#" class="btn btn-sm btn-blue" style="margin-top:0.75rem; display:inline-flex; align-items:center; gap:6px;" target="_blank" rel="noopener">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:15px;height:15px"><path d="M22.54 6.42a2.78 2.78 0 0 0-1.95-1.97C18.88 4 12 4 12 4s-6.88 0-8.59.45A2.78 2.78 0 0 0 1.46 6.42 29 29 0 0 0 1 12a29 29 0 0 0 .46 5.58 2.78 2.78 0 0 0 1.95 1.97C5.12 20 12 20 12 20s6.88 0 8.59-.45a2.78 2.78 0 0 0 1.95-1.97A29 29 0 0 0 23 12a29 29 0 0 0-.46-5.58z"/><polygon points="9.75 15.02 15.5 12 9.75 8.98 9.75 15.02" fill="currentColor"/></svg>
                    Notre chaîne YouTube
                </a>
            </div>
        </div>

        <!-- ===== ONGLET CRÉATIONS ===== -->
        <div class="media-tab-pane" id="tab-creations" role="tabpanel">

            <div class="creations-intro reveal">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path d="M12 19l7-7 3 3-7 7-3-3z"/>
                    <path d="M18 13l-1.5-7.5L2 2l3.5 14.5L13 18l5-5z"/>
                    <path d="M2 2l7.586 7.586"/>
                    <circle cx="11" cy="11" r="2"/>
                </svg>
                <div>
                    <h2>Les créations artistiques de nos enfants autistes</h2>
                    <p>
                        Chaque œuvre présentée ici est une fenêtre ouverte sur un monde intérieur riche, unique et profondément humain.
                        Nos enfants autistes, souvent sous-estimés par la société, expriment à travers le dessin, la peinture et les arts plastiques
                        une créativité, une précision et une sensibilité qui dépassent les attentes.
                        <strong>L'autisme n'est pas un manque — c'est une différence, souvent une force.</strong>
                        Ces créations nous rappellent que chaque enfant a un talent à révéler, et notre mission est de lui donner l'espace pour s'épanouir.
                    </p>
                </div>
            </div>

            @php
            $artColors = [
                ['bg' => 'linear-gradient(135deg,#fde68a,#f59e0b)', 'label' => 'Peinture – Mohammed, 9 ans'],
                ['bg' => 'linear-gradient(135deg,#a5f3fc,#0891b2)', 'label' => 'Dessin – Fatima, 7 ans'],
                ['bg' => 'linear-gradient(135deg,#bbf7d0,#059669)', 'label' => 'Collage – Koffi, 11 ans'],
                ['bg' => 'linear-gradient(135deg,#fca5a5,#dc2626)', 'label' => 'Peinture – Adiza, 8 ans'],
                ['bg' => 'linear-gradient(135deg,#e9d5ff,#7c3aed)', 'label' => 'Aquarelle – Basile, 10 ans'],
                ['bg' => 'linear-gradient(135deg,#fed7aa,#E8501A)',  'label' => 'Dessin – Mariama, 6 ans'],
            ];
            $creations = isset($creations) && count($creations) ? $creations : $artColors;
            @endphp

            <div class="media-grid">
                @foreach($creations as $idx => $creation)
                @php
                    $isModel = is_object($creation);
                    $imgSrc  = $isModel ? $creation->url         : null;
                    $imgAlt  = $isModel ? $creation->description : $creation['label'];
                    $artBg   = $isModel ? '#fde68a'              : $creation['bg'];
                @endphp
                <div class="creation-item reveal" onclick="openLightbox(this)" data-lightbox="{{ $isModel ? $creation->url : '' }}">
                    @if($isModel && $imgSrc)
                    <img src="{{ $imgSrc }}" alt="{{ $imgAlt }}" loading="lazy">
                    @else
                    <div style="position:absolute;inset:0;background:{{ $artBg }};display:flex;flex-direction:column;align-items:center;justify-content:center;padding:1rem;gap:0.5rem;">
                        <svg viewBox="0 0 24 24" fill="none" stroke="rgba(0,0,0,0.35)" stroke-width="1.5" style="width:40px;height:40px">
                            <path d="M12 19l7-7 3 3-7 7-3-3z"/>
                            <path d="M18 13l-1.5-7.5L2 2l3.5 14.5L13 18l5-5z"/>
                            <circle cx="11" cy="11" r="2"/>
                        </svg>
                        <span style="font-size:0.78rem;font-weight:600;color:rgba(0,0,0,0.55);text-align:center;line-height:1.3;">{{ $imgAlt }}</span>
                    </div>
                    @endif
                    <div class="media-overlay">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="color:#fff;width:32px;height:32px;"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                        <span style="color:#fff;font-size:0.8rem;font-weight:500;text-align:center;">{{ $imgAlt }}</span>
                    </div>
                </div>
                @endforeach
            </div>

            <div style="background:#fff8f5;border-radius:12px;padding:2rem;text-align:center;margin-top:2.5rem;border:1px solid #fde8d8;">
                <svg viewBox="0 0 24 24" fill="none" stroke="#E8501A" stroke-width="1.5" style="width:40px;height:40px;margin:0 auto 1rem;display:block"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
                <h3 style="font-size:1.1rem;font-weight:700;color:#1a2540;margin-bottom:0.5rem;">Soutenez les ateliers artistiques</h3>
                <p style="color:#6b7280;font-size:0.9rem;max-width:520px;margin:0 auto 1.25rem;line-height:1.6;">
                    Vos dons nous permettent de financer les ateliers d'expression artistique, d'acheter du matériel et de valoriser les œuvres de nos enfants lors d'expositions et d'événements publics.
                </p>
                <a href="{{ route('don') }}" class="btn btn-orange" style="display:inline-flex;align-items:center;gap:6px;">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:16px;height:16px"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
                    Soutenir les ateliers
                </a>
            </div>
        </div>

        <!-- ===== NEWSLETTER ===== -->
        <div class="newsletter-band reveal">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="width:48px;height:48px;margin:0 auto 1rem;display:block;opacity:0.85">
                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                <polyline points="22,6 12,13 2,6"/>
            </svg>
            <h2>Restez informé de nos actualités</h2>
            <p>Abonnez-vous à notre newsletter pour recevoir nos dernières photos, vidéos, actualités et invitations à nos événements.</p>
            <form class="newsletter-form" action="{{ route('newsletter.subscribe') }}" method="POST">
                @csrf
                <input type="email" name="email" placeholder="Votre adresse email" required
                       style="flex:1;min-width:220px;padding:0.75rem 1.1rem;border-radius:8px;border:none;font-size:0.95rem;outline:none;font-family:inherit;">
                <button type="submit" class="btn btn-orange">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:16px;height:16px;margin-right:6px"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
                    S'abonner
                </button>
            </form>
        </div>

    </div>
</section>

@endsection

@section('scripts')
<script>
function switchTab(btn, tabId) {
    document.querySelectorAll('.media-tab-btn').forEach(b => {
        b.classList.remove('active');
        b.setAttribute('aria-selected', 'false');
    });
    document.querySelectorAll('.media-tab-pane').forEach(p => p.classList.remove('active'));
    btn.classList.add('active');
    btn.setAttribute('aria-selected', 'true');
    document.getElementById('tab-' + tabId).classList.add('active');
}

function openLightbox(el) {
    var url = el.getAttribute('data-lightbox');
    if (!url) return;
    var lightbox = document.getElementById('lightbox');
    var img      = lightbox.querySelector('img');
    if (img) { img.src = url; }
    lightbox.style.display = 'flex';
    document.body.style.overflow = 'hidden';
}
</script>
@endsection
