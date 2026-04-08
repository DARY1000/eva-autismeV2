@extends('layouts.app')

@section('title', 'Qui sommes-nous')
@section('meta_description', 'Découvrez l\'ONG EVA Autisme – Espoir Vie Avec Autisme – organisation béninoise dédiée à l\'inclusion des enfants autistes au Bénin depuis 2022.')

@section('content')

<!-- ===================== PAGE HEADER ===================== -->
<section class="page-header">
    <div class="container" style="position:relative;z-index:1;">
        <h1 style="color:#fff;">Qui sommes-nous ?</h1>
        <p style="color:rgba(255,255,255,0.88);max-width:600px;margin-top:0.75rem;">Découvrez l'histoire, les valeurs et les engagements de l'ONG EVA Autisme, organisation béninoise dédiée à l'inclusion des enfants autistes.</p>
        <nav class="breadcrumb" aria-label="Fil d'Ariane">
            <a href="{{ route('home') }}" style="color:rgba(255,255,255,0.88);">Accueil</a>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
            <span style="color:rgba(255,255,255,0.72);">Qui sommes-nous</span>
        </nav>
    </div>
</section>

<!-- ===================== PRÉSENTATION ===================== -->
<section class="section">
    <div class="container">
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:4rem;align-items:center;" class="grid-2">

            <!-- Photo -->
            <div class="reveal" style="position:relative;">
                <div style="border-radius:var(--radius-lg);overflow:hidden;aspect-ratio:4/3;background:var(--primary-light);display:flex;align-items:center;justify-content:center;">
                    <img
                        src="{{ asset('images/about-qui-sommes-nous.jpg') }}"
                        alt="L'équipe EVA Autisme en action"
                        style="width:100%;height:100%;object-fit:cover;"
                        onerror="this.parentElement.innerHTML='<div style=\'text-align:center;color:var(--primary);padding:3rem\'><svg viewBox=\'0 0 24 24\' fill=\'none\' stroke=\'currentColor\' stroke-width=\'1.5\' style=\'width:90px;height:90px;opacity:0.25\'><circle cx=\'12\' cy=\'8\' r=\'5\'/><path d=\'M3 21c0-5 4-9 9-9s9 4 9 9\'/></svg><p style=\'margin-top:1rem;opacity:0.45;font-size:0.9rem\'>Photo à ajouter</p></div>'"
                    >
                </div>
                <!-- Badge année -->
                <div style="position:absolute;bottom:-1.5rem;right:-1.5rem;background:var(--accent);color:#fff;border-radius:var(--radius-lg);padding:1.25rem 1.5rem;text-align:center;min-width:130px;box-shadow:var(--shadow-md);">
                    <div style="font-size:2rem;font-weight:800;line-height:1;">2022</div>
                    <div style="font-size:0.78rem;opacity:0.9;margin-top:3px;">Année de fondation</div>
                </div>
            </div>

            <!-- Texte -->
            <div class="reveal">
                <div class="section-header" style="text-align:left;">
                    <span class="label">À propos de nous</span>
                    <h2>EVA Autisme :<br>Espoir Vie Avec Autisme</h2>
                    <div class="section-divider" style="margin-left:0;"></div>
                </div>
                <p style="margin-top:1.5rem;">
                    L'ONG <strong>EVA Autisme</strong> (Espoir Vie Avec Autisme) est une organisation à but non lucratif, enregistrée sous le numéro
                    <strong>N°2022/044/DEP-ATL/SG/SAG-ASSOC</strong> en date du 30 mai 2022, dont le siège est établi au Bénin.
                    Elle œuvre en faveur de la reconnaissance, de l'inclusion, de l'éducation et du bien-être des personnes autistes en situation de précarité.
                </p>
                <p style="margin-top:1rem;">
                    Créée en 2021, à la suite du constat de la détresse de nombreuses familles démunies face à l'autisme — souvent isolées, sans accès à l'information ni à un accompagnement adapté, et confrontées aux préjugés sociaux — l'ONG EVA Autisme agit officiellement depuis 2022. Elle s'engage à informer, éduquer, soutenir et accompagner ces familles vulnérables, tout en contribuant à une meilleure sensibilisation de la société à l'autisme.
                </p>

                <div style="margin-top:2rem;display:flex;gap:1rem;flex-wrap:wrap;">
                    <a href="{{ route('about.histoire') }}" class="btn btn-blue">Notre Histoire</a>
                    <a href="{{ route('about.demarche') }}" class="btn btn-white" style="border:2px solid var(--border);color:var(--text-dark);">Notre Démarche</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===================== MISSION & VISION ===================== -->
<section class="section bg-light">
    <div class="container">
        <div class="section-header reveal">
            <span class="label">Nos engagements fondateurs</span>
            <h2>Mission & Vision</h2>
            <div class="section-divider"></div>
        </div>
        <div class="grid-2" style="margin-top:2.5rem;gap:2rem;">

            <!-- Mission -->
            <div class="reveal" style="background:#fff;border-radius:var(--radius-lg);padding:2.5rem;box-shadow:var(--shadow-sm);border:1px solid var(--border);display:flex;flex-direction:column;gap:1.25rem;">
                <div style="width:60px;height:60px;background:var(--primary-light);border-radius:14px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <svg viewBox="0 0 24 24" fill="none" stroke="var(--primary)" stroke-width="2" style="width:28px;height:28px"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                </div>
                <div>
                    <div style="display:inline-block;background:var(--primary);color:#fff;font-size:0.72rem;font-weight:700;letter-spacing:2px;text-transform:uppercase;padding:3px 12px;border-radius:20px;margin-bottom:0.75rem;">Notre Mission</div>
                    <h3 style="font-size:1.15rem;margin-bottom:0.75rem;color:var(--primary);">Soutenir, orienter, inclure</h3>
                    <p style="font-size:0.93rem;color:var(--text-mid);line-height:1.7;">
                        Soutenir les enfants autistes en situation de vulnérabilité et leurs familles à travers l'information, la sensibilisation, des actions sociales, éducatives et ludiques, afin de favoriser leur développement, renforcer leur autonomie et promouvoir leur inclusion dans la société béninoise.
                    </p>
                </div>
            </div>

            <!-- Vision -->
            <div class="reveal" style="background:#fff;border-radius:var(--radius-lg);padding:2.5rem;box-shadow:var(--shadow-sm);border:1px solid var(--border);display:flex;flex-direction:column;gap:1.25rem;">
                <div style="width:60px;height:60px;background:#fff5f2;border-radius:14px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <svg viewBox="0 0 24 24" fill="none" stroke="var(--accent)" stroke-width="2" style="width:28px;height:28px"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                </div>
                <div>
                    <div style="display:inline-block;background:var(--accent);color:#fff;font-size:0.72rem;font-weight:700;letter-spacing:2px;text-transform:uppercase;padding:3px 12px;border-radius:20px;margin-bottom:0.75rem;">Notre Vision</div>
                    <h3 style="font-size:1.15rem;margin-bottom:0.75rem;color:var(--accent);">Un monde inclusif pour chaque enfant</h3>
                    <p style="font-size:0.93rem;color:var(--text-mid);line-height:1.7;">
                        Un monde inclusif où chaque enfant autiste s'épanouit convenablement et accède à l'autonomie. Nous rêvons d'un Bénin où chaque enfant autiste est compris, soutenu et peut apprendre pour grandir sainement et s'épanouir dignement au sein de sa communauté.
                    </p>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ===================== NOS VALEURS ===================== -->
<section class="section bg-light">
    <div class="container">
        <div class="section-header reveal">
            <span class="label">Ce qui nous guide</span>
            <h2>Nos Valeurs</h2>
            <div class="section-divider"></div>
            <p>Quatre piliers fondamentaux orientent chacune de nos actions et décisions au sein d'EVA Autisme.</p>
        </div>

        <div class="grid-3" style="margin-top:2.5rem;display:grid;grid-template-columns:repeat(auto-fit,minmax(250px,1fr));gap:1.5rem;">

            <!-- Inclusion -->
            <div class="feature-card reveal">
                <div class="feature-icon" style="background:#e8f0fb;">
                    <svg viewBox="0 0 24 24" fill="none" stroke="var(--primary)" stroke-width="2" style="width:26px;height:26px">
                        <circle cx="9" cy="7" r="4"/>
                        <path d="M3 21v-2a4 4 0 0 1 4-4h4a4 4 0 0 1 4 4v2"/>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                        <path d="M21 21v-2a4 4 0 0 0-3-3.87"/>
                    </svg>
                </div>
                <h3>Inclusion</h3>
                <p>Nous croyons que chaque enfant autiste a le droit d'être accueilli, éduqué et intégré dans la société, sans discrimination ni exclusion.</p>
            </div>

            <!-- Bienveillance -->
            <div class="feature-card reveal">
                <div class="feature-icon" style="background:#fff0ed;">
                    <svg viewBox="0 0 24 24" fill="none" stroke="var(--accent)" stroke-width="2" style="width:26px;height:26px">
                        <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
                    </svg>
                </div>
                <h3>Bienveillance</h3>
                <p>Nous accompagnons les familles avec écoute, empathie et respect, sans jugement, en reconnaissant la singularité de chaque enfant et de chaque famille.</p>
            </div>

            <!-- Engagement -->
            <div class="feature-card reveal">
                <div class="feature-icon" style="background:#e8f0fb;">
                    <svg viewBox="0 0 24 24" fill="none" stroke="var(--primary)" stroke-width="2" style="width:26px;height:26px">
                        <polyline points="9 11 12 14 22 4"/>
                        <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/>
                    </svg>
                </div>
                <h3>Engagement</h3>
                <p>Nous nous engageons avec détermination pour faire avancer la cause de l'autisme au Bénin, en mobilisant toutes les ressources disponibles pour chaque action.</p>
            </div>

            <!-- Transparence -->
            <div class="feature-card reveal">
                <div class="feature-icon" style="background:#fff0ed;">
                    <svg viewBox="0 0 24 24" fill="none" stroke="var(--accent)" stroke-width="2" style="width:26px;height:26px">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                    </svg>
                </div>
                <h3>Transparence</h3>
                <p>Nous gérons nos ressources et nos actions avec rigueur et honnêteté, en rendant compte à nos donateurs, partenaires et bénéficiaires de manière claire.</p>
            </div>

        </div>
    </div>
</section>

<!-- ===================== NOTRE ÉQUIPE ===================== -->
<section class="section">
    <div class="container">
        <div class="section-header reveal">
            <span class="label">Les personnes derrière EVA Autisme</span>
            <h2>Notre Équipe</h2>
            <div class="section-divider"></div>
            <p>Des femmes et des hommes engagés, portés par la conviction que chaque enfant autiste mérite une chance.</p>
        </div>

        <div class="team-grid">

            @if(isset($teamMembers) && $teamMembers->count())
                @foreach($teamMembers as $member)
                <div class="team-card reveal">
                    <div class="team-photo">
                        @if($member->photo)
                            <img src="{{ asset('storage/'.$member->photo) }}" alt="{{ $member->name }}">
                        @else
                            <svg class="team-photo-placeholder" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="width:50px;height:50px;"><circle cx="12" cy="8" r="5"/><path d="M3 21c0-5 4-9 9-9s9 4 9 9"/></svg>
                        @endif
                    </div>
                    <div class="team-name">{{ $member->name }}</div>
                    <div class="team-role">{{ $member->role }}</div>
                    @if($member->bio)
                        <div class="team-bio" style="margin-top:0.6rem;">{{ $member->bio }}</div>
                    @endif
                </div>
                @endforeach
            @else
                {{-- Placeholders — à remplacer via l'admin Filament --}}
                @php
                $placeholders = [
                    ['name' => 'Nom & Prénom', 'role' => 'Fondatrice & Présidente'],
                    ['name' => 'Nom & Prénom', 'role' => 'Coordinatrice des Programmes'],
                    ['name' => 'Nom & Prénom', 'role' => 'Chargée de Communication'],
                    ['name' => 'Nom & Prénom', 'role' => 'Chargée de Formation'],
                    ['name' => 'Nom & Prénom', 'role' => 'Responsable Terrain'],
                    ['name' => 'Nom & Prénom', 'role' => 'Chargé(e) des Partenariats'],
                ];
                @endphp
                @foreach($placeholders as $p)
                <div class="team-card reveal">
                    <div class="team-photo">
                        <svg class="team-photo-placeholder" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="width:50px;height:50px;"><circle cx="12" cy="8" r="5"/><path d="M3 21c0-5 4-9 9-9s9 4 9 9"/></svg>
                    </div>
                    <div class="team-name">{{ $p['name'] }}</div>
                    <div class="team-role">{{ $p['role'] }}</div>
                </div>
                @endforeach
            @endif

        </div>

        <div style="text-align:center;margin-top:3rem;" class="reveal">
            <a href="{{ route('contact') }}" class="btn btn-blue">Rejoindre l'équipe</a>
        </div>
    </div>
</section>

<!-- ===================== CTA ===================== -->
<section style="background:linear-gradient(135deg,var(--primary) 0%,#0073e6 100%);padding:80px 0;color:#fff;">
    <div class="container" style="text-align:center;">
        <div class="reveal">
            <span style="display:inline-block;background:rgba(255,255,255,0.15);color:#fff;font-size:0.75rem;font-weight:700;letter-spacing:2px;text-transform:uppercase;padding:4px 14px;border-radius:30px;margin-bottom:1rem;">Agir ensemble</span>
            <h2 style="color:#fff;margin-bottom:1rem;">Soutenez la cause EVA Autisme</h2>
            <p style="color:rgba(255,255,255,0.85);max-width:580px;margin:0 auto 2rem;">
                Chaque contribution – financière, bénévole ou en nature – nous permet d'étendre notre impact auprès des familles d'enfants autistes au Bénin.
            </p>
            <div style="display:flex;gap:1rem;justify-content:center;flex-wrap:wrap;">
                <a href="{{ route('don') }}" class="btn btn-orange btn-lg">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:18px;height:18px"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
                    Faire un Don
                </a>
                <a href="{{ route('contact') }}" class="btn" style="background:rgba(255,255,255,0.15);color:#fff;border:2px solid rgba(255,255,255,0.5);font-size:1rem;padding:1rem 2.5rem;">
                    Devenir Bénévole
                </a>
            </div>
        </div>
    </div>
</section>

@endsection
