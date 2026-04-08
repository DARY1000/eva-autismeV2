@extends('layouts.app')

@section('title', 'Accueil')
@section('meta_description', 'EVA Autisme - ONG béninoise dédiée à l\'inclusion des enfants autistes. Sensibilisation, orientation, soutien familial et inclusion sociale au Bénin.')

@section('content')

<!-- ===================== HERO SLIDER ===================== -->
<section class="hero">
    <div class="hero-slides" id="heroSlides">

        <!-- Slide 1 -->
        <div class="hero-slide">
            <img src="{{ asset('images/hero/hero-1.jpg') }}" alt="Enfants autistes épanouis - EVA Autisme Bénin">
            <div class="hero-content">
                <div class="hero-content-inner">
                    <span class="hero-badge">ONG EVA Autisme · Bénin</span>
                    <h1>Un monde où chaque<br>enfant autiste <em style="font-style:normal;color:#ffe066;">a sa place</em></h1>
                    <p>Nous agissons pour l'inclusion, la sensibilisation et le soutien des enfants autistes et de leurs familles au Bénin.</p>
                    <div class="hero-actions">
                        <a href="{{ route('about.qui-sommes-nous') }}" class="btn-primary">Découvrir EVA Autisme</a>
                        <a href="{{ route('don') }}" class="btn-outline">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:18px;height:18px"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
                            Faire un Don
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Slide 2 -->
        <div class="hero-slide">
            <img src="{{ asset('images/hero/hero-2.jpg') }}" alt="Formation parents - EVA Autisme">
            <div class="hero-content">
                <div class="hero-content-inner">
                    <span class="hero-badge">Formation & Accompagnement</span>
                    <h1>Nous formons,<br>nous <em style="font-style:normal;color:#ffe066;">orientons</em>, nous soutenons</h1>
                    <p>Des programmes de formation pour les parents, enseignants et professionnels sur les Troubles du Spectre de l'Autisme.</p>
                    <div class="hero-actions">
                        <a href="{{ route('actions.formation') }}" class="btn-primary">Nos Formations</a>
                        <a href="{{ route('actions.club-parents') }}" class="btn-outline">Club Parents</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Slide 3 -->
        <div class="hero-slide">
            <img src="{{ asset('images/hero/hero-3.jpg') }}" alt="Sensibilisation autisme - Bénin">
            <div class="hero-content">
                <div class="hero-content-inner">
                    <span class="hero-badge">Sensibilisation</span>
                    <h1>Briser les <em style="font-style:normal;color:#ffe066;">préjugés</em>,<br>construire l'inclusion</h1>
                    <p>Des campagnes de sensibilisation dans les écoles, entreprises et institutions pour une meilleure compréhension de l'autisme.</p>
                    <div class="hero-actions">
                        <a href="{{ route('actions.projets') }}" class="btn-primary">Nos Actions</a>
                        <a href="{{ route('contact') }}" class="btn-outline">Nous Rejoindre</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Slide 4 -->
        <div class="hero-slide">
            <img src="{{ asset('images/hero/hero-4.jpg') }}" alt="Événements EVA Autisme">
            <div class="hero-content">
                <div class="hero-content-inner">
                    <span class="hero-badge">Nos Événements</span>
                    <h1>Rejoignez-nous pour<br><em style="font-style:normal;color:#ffe066;">agir ensemble</em></h1>
                    <p>Conférences, ateliers, journées de sensibilisation… Participez à nos événements et devenez acteur du changement.</p>
                    <div class="hero-actions">
                        <a href="{{ route('actions.evenements') }}" class="btn-primary">Voir les Événements</a>
                        <a href="{{ route('about.demarche') }}" class="btn-outline">Notre Démarche</a>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Controls -->
    <div class="hero-controls">
        <button class="hero-arrow hero-prev" aria-label="Précédent">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="15 18 9 12 15 6"/></svg>
        </button>
        <div class="hero-dots">
            <button class="hero-dot active" aria-label="Slide 1"></button>
            <button class="hero-dot" aria-label="Slide 2"></button>
            <button class="hero-dot" aria-label="Slide 3"></button>
            <button class="hero-dot" aria-label="Slide 4"></button>
        </div>
        <button class="hero-arrow hero-next" aria-label="Suivant">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
        </button>
    </div>
</section>

<!-- ===================== BAND : MISSION ===================== -->
<section class="homepage-mission-band" style="background:#fff;padding:3rem 0;border-bottom:1px solid var(--border);">
    <div class="container">
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:2rem;">
            <div style="display:flex;align-items:center;gap:1rem;" class="reveal">
                <div style="width:48px;height:48px;background:var(--primary-light);border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <svg viewBox="0 0 24 24" fill="none" stroke="var(--primary)" stroke-width="2" style="width:24px;height:24px"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
                </div>
                <h4 style="font-size:1.05rem;font-weight:700;margin:0;">Soutien aux familles</h4>
            </div>
            <div style="display:flex;align-items:center;gap:1rem;" class="reveal">
                <div style="width:48px;height:48px;background:var(--primary-light);border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <svg viewBox="0 0 24 24" fill="none" stroke="var(--primary)" stroke-width="2" style="width:24px;height:24px"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>
                </div>
                <h4 style="font-size:1.05rem;font-weight:700;margin:0;">Formation & Éducation</h4>
            </div>
            <div style="display:flex;align-items:center;gap:1rem;" class="reveal">
                <div style="width:48px;height:48px;background:var(--primary-light);border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <svg viewBox="0 0 24 24" fill="none" stroke="var(--primary)" stroke-width="2" style="width:24px;height:24px"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                </div>
                <h4 style="font-size:1.05rem;font-weight:700;margin:0;">Sensibilisation</h4>
            </div>
            <div style="display:flex;align-items:center;gap:1rem;" class="reveal">
                <div style="width:48px;height:48px;background:var(--primary-light);border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <svg viewBox="0 0 24 24" fill="none" stroke="var(--primary)" stroke-width="2" style="width:24px;height:24px"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/></svg>
                </div>
                <h4 style="font-size:1.05rem;font-weight:700;margin:0;">Inclusion sociale</h4>
            </div>
        </div>
    </div>
</section>

<!-- ===================== À PROPOS ===================== -->
<section class="section" style="background:#fff;overflow:hidden;">
    <div class="container">
        <div class="about-grid">

            <!-- Texte gauche -->
            <div class="reveal">
                <span style="display:inline-block;background:var(--primary-light);color:var(--primary);font-size:0.72rem;font-weight:700;letter-spacing:2.5px;text-transform:uppercase;padding:5px 16px;border-radius:30px;margin-bottom:1.5rem;">Qui sommes-nous</span>
                <h2 style="font-size:clamp(2rem,4vw,3rem);font-weight:800;line-height:1.15;margin-bottom:1.25rem;">
                    EVA <span style="color:var(--primary);">Autisme</span>
                </h2>
                <p style="font-size:1rem;color:var(--text-mid);line-height:1.75;margin-bottom:1rem;">
                    EVA Autisme est une organisation béninoise basée à Abomey-Calavi. Nous œuvrons pour l'inclusion des enfants autistes à travers la sensibilisation, l'orientation et le soutien familial.
                </p>
                <p style="font-size:1rem;color:var(--text-mid);line-height:1.75;margin-bottom:2rem;">
                    Notre mission est d'agir pour l'accès des enfants autistes à la scolarisation, à l'autonomie et à l'intégration sociale, tout en sensibilisant le grand public béninois aux réalités du TSA.
                </p>
                <a href="{{ route('about.qui-sommes-nous') }}" class="btn btn-blue" style="display:inline-flex;align-items:center;gap:8px;padding:0.85rem 2rem;border-radius:8px;font-size:0.95rem;">
                    En savoir plus
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="width:16px;height:16px"><polyline points="9 18 15 12 9 6"/></svg>
                </a>
            </div>

            <!-- Photos grille droite — SVG blob + photos proportionnelles exactes -->
            <div class="reveal about-photo-grid" style="position:relative;">

                <!-- ① SVG blob — forme exacte du site original -->
                <div style="position:absolute;top:0;left:0;width:100%;z-index:0;pointer-events:none;user-select:none;">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1109.8 797.1" style="width:100%;height:auto;display:block;">
                        <path fill="#f1f3f2" d="M105.1 267.1C35.5 331.5-3.5 423 .3 517.7 6.1 663 111 831.9 588.3 790.8c753-64.7 481.3-358.3 440.4-398.3-4-3.9-7.9-7.9-11.7-12L761.9 104.8C639.4-27.6 432.5-35.6 299.9 87L105.1 267.1z"/>
                    </svg>
                </div>

                <!-- ② Grille photos — proportions exactes originales -->
                <div style="position:relative;z-index:1;padding:1.5rem 0.5rem;">

                    <!-- Rangée 1 : img4 (40% bas) + img3 (60% haut) -->
                    <div class="about-photo-row" style="display:flex;gap:0.75rem;align-items:flex-end;margin-bottom:0.75rem;">
                        <!-- Photo 1 — 40%, alignée en bas -->
                        <div style="width:40%;flex-shrink:0;">
                            <div style="border-radius:12px;overflow:hidden;background:var(--primary-light);position:relative;min-height:160px;">
                                <img src="{{ asset('images/about-eva.jpg') }}" alt="EVA Autisme" style="width:100%;display:block;object-fit:cover;" onerror="this.style.display='none'">
                                <div style="position:absolute;inset:0;display:flex;align-items:center;justify-content:center;">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="var(--primary)" stroke-width="1.5" style="width:32px;height:32px;opacity:0.3;"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                                </div>
                            </div>
                        </div>
                        <!-- Photo 2 — 60%, alignée en haut -->
                        <div style="width:60%;flex-shrink:0;">
                            <div style="border-radius:12px;overflow:hidden;background:#e8f0fb;position:relative;min-height:220px;">
                                <img src="{{ asset('images/gallery/photo-1.jpg') }}" alt="EVA Autisme action" style="width:100%;display:block;object-fit:cover;" onerror="this.style.display='none'">
                                <div style="position:absolute;inset:0;display:flex;align-items:center;justify-content:center;">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="var(--primary)" stroke-width="1.5" style="width:32px;height:32px;opacity:0.3;"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Rangée 2 : offset 10% + img2 (40%) + img1 (50%) -->
                    <div class="about-photo-row" style="display:flex;gap:0.75rem;align-items:flex-start;">
                        <!-- Décalage 10% -->
                        <div class="about-photo-spacer" style="width:10%;flex-shrink:0;"></div>
                        <!-- Photo 3 — 40% -->
                        <div style="width:40%;flex-shrink:0;">
                            <div style="border-radius:12px;overflow:hidden;background:#e8f5e9;position:relative;min-height:185px;">
                                <img src="{{ asset('images/gallery/photo-2.jpg') }}" alt="EVA Autisme famille" style="width:100%;display:block;object-fit:cover;" onerror="this.style.display='none'">
                                <div style="position:absolute;inset:0;display:flex;align-items:center;justify-content:center;">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="var(--green)" stroke-width="1.5" style="width:32px;height:32px;opacity:0.3;"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                                </div>
                            </div>
                        </div>
                        <!-- Photo 4 — 50% -->
                        <div style="width:50%;flex-shrink:0;">
                            <div style="border-radius:12px;overflow:hidden;background:#fef3e8;position:relative;min-height:185px;">
                                <img src="{{ asset('images/gallery/photo-3.jpg') }}" alt="EVA Autisme événement" style="width:100%;display:block;object-fit:cover;" onerror="this.style.display='none'">
                                <div style="position:absolute;inset:0;display:flex;align-items:center;justify-content:center;">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="#ffa84b" stroke-width="1.5" style="width:32px;height:32px;opacity:0.3;"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>

<!-- ===================== CTA PHOTO BACKGROUND ===================== -->
<section class="photo-bg-section" style="background-image: url('{{ asset('images/bg-section-1.jpg') }}');">
    <div class="container">
        <div class="cta-photo-grid">
            <div class="reveal">
                <span style="display:inline-block;background:rgba(255,255,255,0.15);border:1px solid rgba(255,255,255,0.3);color:#fff;font-size:0.75rem;font-weight:700;letter-spacing:2px;text-transform:uppercase;padding:4px 14px;border-radius:30px;margin-bottom:1rem;backdrop-filter:blur(6px);">Notre Mission</span>
                <h2 style="color:#fff;font-size:clamp(1.8rem,3vw,2.6rem);line-height:1.2;">Pour nous, chaque être humain constitue une <span style="color:#ffe066;">valeur unique</span></h2>
                <p style="margin-top:1rem;font-size:1.05rem;">Nous croyons que chaque enfant autiste mérite une chance d'épanouissement. Votre soutien nous permet d'agir concrètement au Bénin.</p>
                <div style="margin-top:2rem;display:flex;gap:1rem;flex-wrap:wrap;">
                    <a href="{{ route('don') }}" class="btn btn-orange btn-lg" style="background:var(--accent);color:#fff;">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:18px;height:18px"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
                        Faire un Don
                    </a>
                    <a href="{{ route('contact') }}" class="btn" style="background:rgba(255,255,255,0.15);color:#fff;border:2px solid rgba(255,255,255,0.5);backdrop-filter:blur(4px);">
                        Nous Rejoindre
                    </a>
                </div>
            </div>
            <div class="reveal mini-stats-grid">
                <!-- 4 mini stats -->
                <div style="background:rgba(255,255,255,0.12);backdrop-filter:blur(8px);border:1px solid rgba(255,255,255,0.2);border-radius:var(--radius-lg);padding:1.5rem;text-align:center;">
                    <div style="font-size:2.4rem;font-weight:800;color:#ffe066;line-height:1;">200+</div>
                    <div style="font-size:0.82rem;color:rgba(255,255,255,0.8);margin-top:0.4rem;">Familles</div>
                </div>
                <div style="background:rgba(255,255,255,0.12);backdrop-filter:blur(8px);border:1px solid rgba(255,255,255,0.2);border-radius:var(--radius-lg);padding:1.5rem;text-align:center;">
                    <div style="font-size:2.4rem;font-weight:800;color:#ffe066;line-height:1;">50+</div>
                    <div style="font-size:0.82rem;color:rgba(255,255,255,0.8);margin-top:0.4rem;">Événements</div>
                </div>
                <div style="background:rgba(255,255,255,0.12);backdrop-filter:blur(8px);border:1px solid rgba(255,255,255,0.2);border-radius:var(--radius-lg);padding:1.5rem;text-align:center;">
                    <div style="font-size:2.4rem;font-weight:800;color:#ffe066;line-height:1;">30+</div>
                    <div style="font-size:0.82rem;color:rgba(255,255,255,0.8);margin-top:0.4rem;">Partenaires</div>
                </div>
                <div style="background:rgba(255,255,255,0.12);backdrop-filter:blur(8px);border:1px solid rgba(255,255,255,0.2);border-radius:var(--radius-lg);padding:1.5rem;text-align:center;">
                    <div style="font-size:2.4rem;font-weight:800;color:#ffe066;line-height:1;">500+</div>
                    <div style="font-size:0.82rem;color:rgba(255,255,255,0.8);margin-top:0.4rem;">Sensibilisés</div>
                </div>
            </div>
        </div>
    </div>
    <!-- Note admin : placer une photo dans public/images/bg-section-1.jpg (paysage 1920x700) -->
</section>

<!-- ===================== NOS ACTIONS ===================== -->
<section class="section">
    <div class="container">
        <div class="section-header reveal">
            <span class="label">Ce que nous faisons</span>
            <h2>Nos Actions Principales</h2>
            <div class="section-divider"></div>
            <p>Nous agissons sur quatre piliers fondamentaux pour améliorer la vie des enfants autistes et de leurs familles au Bénin.</p>
        </div>
        <div class="grid-3" style="margin-top:2.5rem;">
            <div class="feature-card reveal">
                <div class="feature-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                </div>
                <h3>Sensibiliser & Informer</h3>
                <p>Organisation de campagnes de sensibilisation physiques et digitales pour une meilleure compréhension de l'autisme dans la société béninoise.</p>
                <a href="{{ route('actions.projets') }}" style="display:inline-flex;align-items:center;gap:5px;color:var(--primary);font-weight:600;font-size:0.87rem;margin-top:1rem;">
                    En savoir plus <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:14px;height:14px"><polyline points="9 18 15 12 9 6"/></svg>
                </a>
            </div>
            <div class="feature-card reveal">
                <div class="feature-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                </div>
                <h3>Orienter & Dépister</h3>
                <p>Accueil et orientation des parents et enfants vers des spécialistes adaptés pour éviter l'errance diagnostique dans un contexte aux ressources limitées.</p>
                <a href="{{ route('about.demarche') }}" style="display:inline-flex;align-items:center;gap:5px;color:var(--primary);font-weight:600;font-size:0.87rem;margin-top:1rem;">
                    En savoir plus <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:14px;height:14px"><polyline points="9 18 15 12 9 6"/></svg>
                </a>
            </div>
            <div class="feature-card reveal">
                <div class="feature-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                </div>
                <h3>Soutien Familial</h3>
                <p>Évaluation des besoins familiaux, accompagnement des parents, club parents et formations pour renforcer les compétences parentales au quotidien.</p>
                <a href="{{ route('actions.club-parents') }}" style="display:inline-flex;align-items:center;gap:5px;color:var(--primary);font-weight:600;font-size:0.87rem;margin-top:1rem;">
                    En savoir plus <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:14px;height:14px"><polyline points="9 18 15 12 9 6"/></svg>
                </a>
            </div>
            <div class="feature-card reveal">
                <div class="feature-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>
                </div>
                <h3>Formation Professionnelle</h3>
                <p>Formation des enseignants, professionnels de santé et de l'éducation pour mieux accompagner les enfants avec TSA dans les structures spécialisées.</p>
                <a href="{{ route('actions.formation') }}" style="display:inline-flex;align-items:center;gap:5px;color:var(--primary);font-weight:600;font-size:0.87rem;margin-top:1rem;">
                    En savoir plus <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:14px;height:14px"><polyline points="9 18 15 12 9 6"/></svg>
                </a>
            </div>
            <div class="feature-card reveal">
                <div class="feature-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                </div>
                <h3>Événements & Campagnes</h3>
                <p>Journées de sensibilisation, conférences, ateliers interactifs et événements culturels mettant en valeur les talents des enfants autistes.</p>
                <a href="{{ route('actions.evenements') }}" style="display:inline-flex;align-items:center;gap:5px;color:var(--primary);font-weight:600;font-size:0.87rem;margin-top:1rem;">
                    En savoir plus <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:14px;height:14px"><polyline points="9 18 15 12 9 6"/></svg>
                </a>
            </div>
            <div class="feature-card reveal">
                <div class="feature-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2a10 10 0 1 0 10 10H12V2z"/></svg>
                </div>
                <h3>Accès aux Solutions</h3>
                <p>Facilitation de l'accès à des thérapies, interventions adaptées et programmes éducatifs individualisés grâce à des dons et parrainages.</p>
                <a href="{{ route('don') }}" style="display:inline-flex;align-items:center;gap:5px;color:var(--primary);font-weight:600;font-size:0.87rem;margin-top:1rem;">
                    Soutenir <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:14px;height:14px"><polyline points="9 18 15 12 9 6"/></svg>
                </a>
            </div>
            <div class="feature-card reveal">
                <div class="feature-icon" style="background:var(--green-light);">
                    <svg viewBox="0 0 24 24" fill="none" stroke="var(--green)" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 8v4l3 3"/><path d="M4.93 4.93l4.24 4.24M14.83 14.83l4.24 4.24M4.93 19.07l4.24-4.24M14.83 9.17l4.24-4.24"/></svg>
                </div>
                <h3>Sport & Inclusion</h3>
                <p>Nous facilitons l'accès au sport pour les personnes autistes : activités physiques adaptées, clubs sportifs inclusifs et programmes thérapeutiques par le mouvement.</p>
                <a href="{{ route('actions.projets') }}" style="display:inline-flex;align-items:center;gap:5px;color:var(--green);font-weight:600;font-size:0.87rem;margin-top:1rem;">
                    En savoir plus <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:14px;height:14px"><polyline points="9 18 15 12 9 6"/></svg>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- ===================== GALERIE PHOTOS ===================== -->
<section class="section-teal section" style="padding:60px 0;">
    <div class="container">
        <div class="section-header reveal" style="margin-bottom:2rem;">
            <span class="label">Nos Photos</span>
            <h2>EVA Autisme en Images</h2>
            <div class="section-divider" style="background:var(--teal);"></div>
            <p>Retrouvez nos événements, actions et moments forts en images.</p>
        </div>
        <!-- Bande photos 4 colonnes -->
        <div class="photo-strip reveal">
            <div class="photo-strip-item">
                <img src="{{ asset('images/gallery/photo-1.jpg') }}" alt="EVA Autisme - Photo 1" onerror="this.parentElement.classList.add('photo-strip-item-placeholder'); this.style.display='none'">
                <div class="photo-strip-item-placeholder" style="display:none;">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                </div>
            </div>
            <div class="photo-strip-item">
                <img src="{{ asset('images/gallery/photo-2.jpg') }}" alt="EVA Autisme - Photo 2" onerror="this.parentElement.classList.add('photo-strip-item-placeholder'); this.style.display='none'">
                <div class="photo-strip-item-placeholder" style="display:none;">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                </div>
            </div>
            <div class="photo-strip-item">
                <img src="{{ asset('images/gallery/photo-3.jpg') }}" alt="EVA Autisme - Photo 3" onerror="this.parentElement.classList.add('photo-strip-item-placeholder'); this.style.display='none'">
                <div class="photo-strip-item-placeholder" style="display:none;">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                </div>
            </div>
            <div class="photo-strip-item">
                <img src="{{ asset('images/gallery/photo-4.jpg') }}" alt="EVA Autisme - Photo 4" onerror="this.parentElement.classList.add('photo-strip-item-placeholder'); this.style.display='none'">
                <div class="photo-strip-item-placeholder" style="display:none;">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                </div>
            </div>
        </div>
        <div style="text-align:center;margin-top:1.5rem;">
            <a href="{{ route('resources.medias') }}" class="btn btn-teal">Voir toute la galerie</a>
        </div>
        {{-- Note admin: Ajouter les photos dans public/images/gallery/photo-1.jpg à photo-4.jpg --}}
    </div>
</section>

<!-- ===================== PROCHAINS ÉVÉNEMENTS ===================== -->
<section class="section bg-light">
    <div class="container">
        <div class="section-header reveal">
            <span class="label">Agenda</span>
            <h2>Prochains Événements</h2>
            <div class="section-divider"></div>
        </div>
        <div style="display:flex;flex-direction:column;gap:1rem;max-width:850px;margin:2rem auto 0;">
            @forelse($upcomingEvents ?? [] as $event)
            <div class="event-card reveal">
                <div class="event-date-block">
                    <div class="day">{{ \Carbon\Carbon::parse($event->date)->format('d') }}</div>
                    <div class="month">{{ \Carbon\Carbon::parse($event->date)->translatedFormat('M') }}</div>
                </div>
                <div class="event-info">
                    <span class="event-badge badge-upcoming">À venir</span>
                    <h4>{{ $event->title }}</h4>
                    <div class="event-meta">
                        <span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>{{ \Carbon\Carbon::parse($event->date)->format('H:i') }}</span>
                        <span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>{{ $event->location }}</span>
                    </div>
                    <a href="{{ route('actions.evenements') }}#event-{{ $event->id }}" class="btn btn-blue btn-sm">S'inscrire</a>
                </div>
            </div>
            @empty
            <!-- Placeholder events -->
            <div class="event-card reveal">
                <div class="event-date-block">
                    <div class="day">18</div>
                    <div class="month">Avr</div>
                </div>
                <div class="event-info">
                    <span class="event-badge badge-upcoming">À venir</span>
                    <h4>Journée de Sensibilisation à l'Autisme – Abomey-Calavi</h4>
                    <div class="event-meta">
                        <span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>09:00</span>
                        <span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>Abomey-Calavi</span>
                    </div>
                    <a href="{{ route('actions.evenements') }}" class="btn btn-blue btn-sm">S'inscrire</a>
                </div>
            </div>
            <div class="event-card reveal">
                <div class="event-date-block" style="background:var(--accent);">
                    <div class="day">02</div>
                    <div class="month">Mai</div>
                </div>
                <div class="event-info">
                    <span class="event-badge badge-upcoming">À venir</span>
                    <h4>Atelier Formation Parents – Comprendre les TSA</h4>
                    <div class="event-meta">
                        <span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>10:00 – 16:00</span>
                        <span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>Cotonou, Bénin</span>
                    </div>
                    <a href="{{ route('actions.evenements') }}" class="btn btn-blue btn-sm">S'inscrire</a>
                </div>
            </div>
            @endforelse
        </div>
        <div style="text-align:center;margin-top:2.5rem;" class="reveal">
            <a href="{{ route('actions.evenements') }}" class="btn btn-blue">Voir tous les événements</a>
        </div>
    </div>
</section>

<!-- ===================== CTA SOUTIEN ===================== -->
<section style="background:#6bc0e7;padding:80px 0;">
    <div class="container" style="text-align:center;">
        <div class="reveal">
            <span style="display:inline-block;background:rgba(0,55,105,0.12);color:#0d3d6b;font-size:0.75rem;font-weight:700;letter-spacing:2px;text-transform:uppercase;padding:4px 16px;border-radius:30px;margin-bottom:1rem;border:1px solid rgba(0,55,105,0.2);">Rejoignez le mouvement</span>
            <h2 style="color:#0d3d6b;margin-bottom:1rem;font-size:clamp(1.7rem,3vw,2.4rem);">Ensemble, agissons pour l'inclusion de l'autisme au Bénin</h2>
            <p style="color:#1a4a6e;max-width:600px;margin:0 auto 2rem;font-size:1.05rem;">Votre soutien, qu'il soit financier, bénévole ou en nature, nous permet de continuer à œuvrer pour les droits et l'inclusion des enfants autistes.</p>
            <div style="display:flex;gap:1rem;justify-content:center;flex-wrap:wrap;">
                <a href="{{ route('don') }}" class="btn btn-lg" style="background:var(--primary);color:#fff;font-size:1rem;padding:1rem 2.5rem;border-radius:30px;box-shadow:0 4px 15px rgba(0,55,165,0.3);">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:18px;height:18px"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
                    Faire un Don
                </a>
                <a href="{{ route('contact') }}" class="btn" style="background:#f2b244;color:#5a3800;border:2px solid #f2b244;font-size:1rem;padding:1rem 2.5rem;border-radius:30px;font-weight:700;">
                    Devenir Bénévole
                </a>
                <a href="{{ route('contact') }}" class="btn" style="background:rgba(0,55,105,0.1);color:#0d3d6b;border:2px solid rgba(0,55,105,0.3);font-size:1rem;padding:1rem 2.5rem;border-radius:30px;">
                    Devenir Partenaire
                </a>
            </div>
        </div>
    </div>
</section>

@endsection
