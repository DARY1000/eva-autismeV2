@extends('layouts.app')

@section('title', 'Club Parents')
@section('meta_description', 'Rejoignez le Club Parents d\'EVA Autisme au Bénin : un espace de soutien, d\'échange et de formation pour les familles d\'enfants autistes.')

@section('styles')
<style>
.faq-item {
    background: #fff;
    border-radius: var(--radius);
    box-shadow: var(--shadow-sm);
    margin-bottom: 0.75rem;
    overflow: hidden;
}
.faq-question {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1.1rem 1.5rem;
    cursor: pointer;
    font-weight: 600;
    font-size: 0.95rem;
    gap: 1rem;
    border: none;
    background: none;
    width: 100%;
    text-align: left;
    color: var(--text-dark);
    transition: background 0.2s;
}
.faq-question:hover { background: var(--primary-light); }
.faq-question svg {
    flex-shrink: 0;
    transition: transform 0.3s;
    color: var(--primary);
}
.faq-answer {
    display: none;
    padding: 0 1.5rem 1.25rem;
    font-size: 0.88rem;
    color: var(--text-muted);
    line-height: 1.7;
    border-top: 1px solid var(--border);
}
.faq-item.open .faq-answer { display: block; }
.faq-item.open .faq-question svg { transform: rotate(180deg); }
.faq-item.open .faq-question { background: var(--primary-light); color: var(--primary); }
</style>
@endsection

@section('content')

<!-- ===================== PAGE HEADER ===================== -->
<div class="page-header">
    <div class="container">
        <h1>Club Parents EVA Autisme</h1>
        <p>Un espace de soutien, d'échange et de formation pour les familles d'enfants autistes au Bénin</p>
        <nav class="breadcrumb">
            <a href="{{ route('home') }}">Accueil</a>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="width:14px;height:14px"><polyline points="9 18 15 12 9 6"/></svg>
            <span>Club Parents</span>
        </nav>
    </div>
</div>

<!-- ===================== PRÉSENTATION ===================== -->
<section class="section bg-light">
    <div class="container">
        <div class="grid-2" style="gap:4rem;align-items:center;">
            <div class="reveal">
                <div class="section-header" style="text-align:left;">
                    <span class="label">Notre Club</span>
                    <h2>Vous n'êtes pas seuls</h2>
                    <div class="section-divider" style="margin-left:0;"></div>
                </div>
                <p style="margin-top:1.25rem;">
                    Recevoir un diagnostic d'autisme pour son enfant est souvent une épreuve solitaire. Le Club Parents d'EVA Autisme est né de cette réalité : des familles ont besoin de se retrouver, de parler sans jugement, et d'apprendre ensemble comment mieux accompagner leur enfant.
                </p>
                <p style="margin-top:1rem;">
                    Depuis 2022, notre club réunit chaque mois des dizaines de familles à Abomey-Calavi et Cotonou. Parents, grands-parents, frères et sœurs – tout l'entourage est le bienvenu. Nous partageons des expériences, des ressources et des stratégies concrètes dans un climat de confiance et de bienveillance.
                </p>
                <div style="margin-top:2rem;display:flex;gap:1rem;flex-wrap:wrap;">
                    <a href="#rejoindre" class="btn btn-blue">Rejoindre le Club</a>
                    <a href="{{ route('actions.evenements') }}" class="btn btn-white-light">Nos événements</a>
                </div>
            </div>
            <div class="reveal">
                <div style="border-radius:var(--radius-lg);overflow:hidden;aspect-ratio:4/3;background:var(--primary-light);display:flex;align-items:center;justify-content:center;">
                    <img src="{{ asset('images/club-parents.jpg') }}" alt="Club Parents EVA Autisme" style="width:100%;height:100%;object-fit:cover;"
                         onerror="this.parentElement.innerHTML='<div style=\'text-align:center;color:var(--primary);padding:3rem\'><svg viewBox=\'0 0 24 24\' fill=\'none\' stroke=\'currentColor\' stroke-width=\'1.5\' style=\'width:80px;height:80px;opacity:0.3\'><path d=\'M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2\'/><circle cx=\'9\' cy=\'7\' r=\'4\'/><path d=\'M23 21v-2a4 4 0 0 0-3-3.87\'/><path d=\'M16 3.13a4 4 0 0 1 0 7.75\'/></svg><p style=\'margin-top:1rem;opacity:0.5\'>Photo du Club Parents</p></div>'">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===================== OBJECTIFS ===================== -->
<section class="section">
    <div class="container">
        <div class="section-header reveal">
            <span class="label">Pourquoi rejoindre le club ?</span>
            <h2>Les objectifs du Club Parents</h2>
            <div class="section-divider"></div>
        </div>
        <div class="grid-4" style="margin-top:2.5rem;gap:1.5rem;">
            <div class="feature-card reveal" style="text-align:center;">
                <div class="feature-icon" style="margin:0 auto 1rem;">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                        <circle cx="9" cy="7" r="4"/>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                    </svg>
                </div>
                <h3 style="font-size:1rem;">Réseau de soutien</h3>
                <p style="font-size:0.85rem;">Créer des liens durables entre familles qui partagent les mêmes réalités et s'entraident au quotidien.</p>
            </div>
            <div class="feature-card reveal" style="text-align:center;">
                <div class="feature-icon" style="margin:0 auto 1rem;">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                    </svg>
                </div>
                <h3 style="font-size:1rem;">Partage d'expériences</h3>
                <p style="font-size:0.85rem;">Échanger librement sur les difficultés et les réussites du quotidien, sans crainte du jugement.</p>
            </div>
            <div class="feature-card reveal" style="text-align:center;">
                <div class="feature-icon" style="margin:0 auto 1rem;">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                        <polyline points="14 2 14 8 20 8"/>
                        <line x1="16" y1="13" x2="8" y2="13"/>
                        <line x1="16" y1="17" x2="8" y2="17"/>
                        <polyline points="10 9 9 9 8 9"/>
                    </svg>
                </div>
                <h3 style="font-size:1rem;">Accès aux ressources</h3>
                <p style="font-size:0.85rem;">Bénéficier d'informations fiables, de guides pratiques et d'orientations vers des spécialistes adaptés.</p>
            </div>
            <div class="feature-card reveal" style="text-align:center;">
                <div class="feature-icon" style="margin:0 auto 1rem;">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M22 10v6M2 10l10-5 10 5-10 5z"/>
                        <path d="M6 12v5c3 3 9 3 12 0v-5"/>
                    </svg>
                </div>
                <h3 style="font-size:1rem;">Formation mutuelle</h3>
                <p style="font-size:0.85rem;">Participer à des ateliers pratiques animés par des professionnels pour renforcer vos compétences parentales.</p>
            </div>
        </div>
    </div>
</section>

<!-- ===================== ACTIVITÉS ===================== -->
<section class="section bg-light">
    <div class="container">
        <div class="section-header reveal">
            <span class="label">Ce que nous faisons ensemble</span>
            <h2>Les activités du Club Parents</h2>
            <div class="section-divider"></div>
        </div>
        <div class="grid-2" style="margin-top:2.5rem;gap:2rem;">

            <div class="card reveal">
                <div class="card-body" style="display:flex;align-items:flex-start;gap:1.25rem;padding:1.75rem;">
                    <div style="width:52px;height:52px;background:var(--primary-light);border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <svg viewBox="0 0 24 24" fill="none" stroke="var(--primary)" stroke-width="2" style="width:26px;height:26px">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                            <line x1="16" y1="2" x2="16" y2="6"/>
                            <line x1="8" y1="2" x2="8" y2="6"/>
                            <line x1="3" y1="10" x2="21" y2="10"/>
                        </svg>
                    </div>
                    <div>
                        <h3 style="font-size:1rem;margin-bottom:0.4rem;">Réunions mensuelles</h3>
                        <p style="font-size:0.875rem;color:var(--text-muted);line-height:1.6;">
                            Un samedi par mois à Abomey-Calavi, nous nous retrouvons pour des séances d'échange facilités par un professionnel. Thèmes abordés : gestion des comportements, scolarisation, alimentation, sommeil, communication.
                        </p>
                    </div>
                </div>
            </div>

            <div class="card reveal">
                <div class="card-body" style="display:flex;align-items:flex-start;gap:1.25rem;padding:1.75rem;">
                    <div style="width:52px;height:52px;background:#fff4f0;border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <svg viewBox="0 0 24 24" fill="none" stroke="var(--accent)" stroke-width="2" style="width:26px;height:26px">
                            <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/>
                            <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 style="font-size:1rem;margin-bottom:0.4rem;">Ateliers pratiques</h3>
                        <p style="font-size:0.875rem;color:var(--text-muted);line-height:1.6;">
                            Des ateliers thématiques trimestriels animés par des psychologues, orthophonistes et éducateurs spécialisés : communication alternative, jeux d'éveil, activités sensorielles, aide aux devoirs adaptée.
                        </p>
                    </div>
                </div>
            </div>

            <div class="card reveal">
                <div class="card-body" style="display:flex;align-items:flex-start;gap:1.25rem;padding:1.75rem;">
                    <div style="width:52px;height:52px;background:var(--primary-light);border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <svg viewBox="0 0 24 24" fill="none" stroke="var(--primary)" stroke-width="2" style="width:26px;height:26px">
                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12 19.79 19.79 0 0 1 1.61 3.37 2 2 0 0 1 3.6 1h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 8.6a16 16 0 0 0 6 6l.96-.96a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 style="font-size:1rem;margin-bottom:0.4rem;">Groupe WhatsApp d'entraide</h3>
                        <p style="font-size:0.875rem;color:var(--text-muted);line-height:1.6;">
                            Un groupe WhatsApp privé et modéré pour les membres du club. Partage d'actualités, questions rapides, alertes sur des événements à venir, et soutien moral entre parents à toute heure.
                        </p>
                    </div>
                </div>
            </div>

            <div class="card reveal">
                <div class="card-body" style="display:flex;align-items:flex-start;gap:1.25rem;padding:1.75rem;">
                    <div style="width:52px;height:52px;background:#fff4f0;border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <svg viewBox="0 0 24 24" fill="none" stroke="var(--accent)" stroke-width="2" style="width:26px;height:26px">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                            <circle cx="12" cy="10" r="3"/>
                        </svg>
                    </div>
                    <div>
                        <h3 style="font-size:1rem;margin-bottom:0.4rem;">Visites de terrain</h3>
                        <p style="font-size:0.875rem;color:var(--text-muted);line-height:1.6;">
                            Des sorties collectives dans des centres spécialisés, des écoles inclusives ou des structures de prise en charge pour découvrir les possibilités offertes aux enfants autistes au Bénin.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ===================== TÉMOIGNAGES ===================== -->
<section class="section">
    <div class="container">
        <div class="section-header reveal">
            <span class="label">Ils en parlent</span>
            <h2>Témoignages de membres du club</h2>
            <div class="section-divider"></div>
        </div>
        <div class="grid-3" style="margin-top:2.5rem;">

            <!-- Témoignage 1 -->
            <div class="card reveal">
                <div class="card-body" style="padding:2rem;">
                    <div style="margin-bottom:1rem;">
                        <svg viewBox="0 0 24 24" fill="var(--primary)" style="width:28px;height:28px;opacity:0.18"><path d="M3 21c3 0 7-1 7-8V5c0-1.25-.756-2.017-2-2H4c-1.25 0-2 .75-2 1.972V11c0 1.25.75 2 2 2 1 0 1 0 1 1v1c0 1-1 2-2 2s-1 .008-1 1.031V20c0 1 0 1 1 1z"/><path d="M15 21c3 0 7-1 7-8V5c0-1.25-.757-2.017-2-2h-4c-1.25 0-2 .75-2 1.972V11c0 1.25.75 2 2 2h.75c0 2.25.25 4-2.75 4v3c0 1 0 1 1 1z"/></svg>
                    </div>
                    <p style="font-size:0.9rem;color:var(--text-muted);line-height:1.7;margin-bottom:1.5rem;font-style:italic;">
                        Avant de rejoindre le Club Parents, je me sentais complètement isolée. Mon fils a été diagnostiqué autiste à 4 ans et je ne savais pas vers qui me tourner. Grâce au club, j'ai trouvé une vraie famille de soutien. Les ateliers m'ont donné des outils concrets que j'applique chaque jour.
                    </p>
                    <div style="display:flex;align-items:center;gap:0.75rem;">
                        <div style="width:42px;height:42px;border-radius:50%;background:var(--primary-light);display:flex;align-items:center;justify-content:center;font-weight:700;color:var(--primary);font-size:1rem;">A</div>
                        <div>
                            <div style="font-size:0.9rem;font-weight:600;">Adjoavi M.</div>
                            <div style="font-size:0.78rem;color:var(--text-muted);">Mère de Kofi, 6 ans – Abomey-Calavi</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Témoignage 2 -->
            <div class="card reveal">
                <div class="card-body" style="padding:2rem;">
                    <div style="margin-bottom:1rem;">
                        <svg viewBox="0 0 24 24" fill="var(--green)" style="width:28px;height:28px;opacity:0.18"><path d="M3 21c3 0 7-1 7-8V5c0-1.25-.756-2.017-2-2H4c-1.25 0-2 .75-2 1.972V11c0 1.25.75 2 2 2 1 0 1 0 1 1v1c0 1-1 2-2 2s-1 .008-1 1.031V20c0 1 0 1 1 1z"/><path d="M15 21c3 0 7-1 7-8V5c0-1.25-.757-2.017-2-2h-4c-1.25 0-2 .75-2 1.972V11c0 1.25.75 2 2 2h.75c0 2.25.25 4-2.75 4v3c0 1 0 1 1 1z"/></svg>
                    </div>
                    <p style="font-size:0.9rem;color:var(--text-muted);line-height:1.7;margin-bottom:1.5rem;font-style:italic;">
                        Le groupe WhatsApp du club m'a sauvé plus d'une fois. À 22h, quand ma fille faisait une crise que je ne comprenais pas, j'ai posé la question et en quelques minutes j'avais des réponses d'autres parents qui avaient vécu la même chose. Ce lien est précieux.
                    </p>
                    <div style="display:flex;align-items:center;gap:0.75rem;">
                        <div style="width:42px;height:42px;border-radius:50%;background:var(--green-light);display:flex;align-items:center;justify-content:center;font-weight:700;color:var(--green);font-size:1rem;">R</div>
                        <div>
                            <div style="font-size:0.9rem;font-weight:600;">Rodrigue K.</div>
                            <div style="font-size:0.78rem;color:var(--text-muted);">Père de Bénédicte, 8 ans – Cotonou</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Témoignage 3 -->
            <div class="card reveal">
                <div class="card-body" style="padding:2rem;">
                    <div style="margin-bottom:1rem;">
                        <svg viewBox="0 0 24 24" fill="var(--teal)" style="width:28px;height:28px;opacity:0.18"><path d="M3 21c3 0 7-1 7-8V5c0-1.25-.756-2.017-2-2H4c-1.25 0-2 .75-2 1.972V11c0 1.25.75 2 2 2 1 0 1 0 1 1v1c0 1-1 2-2 2s-1 .008-1 1.031V20c0 1 0 1 1 1z"/><path d="M15 21c3 0 7-1 7-8V5c0-1.25-.757-2.017-2-2h-4c-1.25 0-2 .75-2 1.972V11c0 1.25.75 2 2 2h.75c0 2.25.25 4-2.75 4v3c0 1 0 1 1 1z"/></svg>
                    </div>
                    <p style="font-size:0.9rem;color:var(--text-muted);line-height:1.7;margin-bottom:1.5rem;font-style:italic;">
                        EVA Autisme ne nous a pas seulement donné de l'information. Ils nous ont redonné espoir. Grâce aux visites de terrain organisées par le club, j'ai découvert qu'il existait une école ordinaire prête à accueillir mon enfant avec un accompagnement adapté.
                    </p>
                    <div style="display:flex;align-items:center;gap:0.75rem;">
                        <div style="width:42px;height:42px;border-radius:50%;background:var(--teal-light);display:flex;align-items:center;justify-content:center;font-weight:700;color:var(--teal);font-size:1rem;">F</div>
                        <div>
                            <div style="font-size:0.9rem;font-weight:600;">Fatima D.</div>
                            <div style="font-size:0.78rem;color:var(--text-muted);">Mère de Théo, 7 ans – Sèmè-Podji</div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ===================== FORMULAIRE D'ADHÉSION ===================== -->
<section class="section bg-light" id="rejoindre">
    <div class="container">
        <div class="section-header reveal">
            <span class="label">Rejoignez-nous</span>
            <h2>Formulaire d'adhésion au Club Parents</h2>
            <div class="section-divider"></div>
            <p>L'adhésion au Club Parents est gratuite et ouverte à toute famille concernée par l'autisme. Remplissez ce formulaire et nous vous contacterons pour vous accueillir à notre prochaine réunion.</p>
        </div>

        <div style="max-width:720px;margin:2.5rem auto 0;">

            @if($errors->any())
            <div style="background:#fff3f3;border-left:4px solid #dc3545;color:#721c24;padding:1rem 1.25rem;border-radius:var(--radius);margin-bottom:1.5rem;">
                <strong>Veuillez corriger les erreurs suivantes :</strong>
                <ul style="margin:0.5rem 0 0 1.2rem;font-size:0.875rem;">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            @if(session('success'))
            <div class="alert alert-success" style="margin-bottom:1.5rem;">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:18px;height:18px"><polyline points="20 6 9 17 4 12"/></svg>
                {{ session('success') }}
            </div>
            @endif

            <div class="card reveal" style="padding:0;">
                <div class="card-body" style="padding:2.5rem;">
                    <form action="{{ route('club-parents.join') }}" method="POST" novalidate>
                        @csrf

                        <div class="form-row" style="display:grid;grid-template-columns:1fr 1fr;gap:1.25rem;">
                            <div class="form-group">
                                <label for="nom" class="form-label">Nom <span style="color:var(--accent);">*</span></label>
                                <input type="text" id="nom" name="nom" class="form-control {{ $errors->has('nom') ? 'is-invalid' : '' }}"
                                       value="{{ old('nom') }}" placeholder="Votre nom de famille" required>
                            </div>
                            <div class="form-group">
                                <label for="prenom" class="form-label">Prénom <span style="color:var(--accent);">*</span></label>
                                <input type="text" id="prenom" name="prenom" class="form-control {{ $errors->has('prenom') ? 'is-invalid' : '' }}"
                                       value="{{ old('prenom') }}" placeholder="Votre prénom" required>
                            </div>
                        </div>

                        <div class="form-row" style="display:grid;grid-template-columns:1fr 1fr;gap:1.25rem;">
                            <div class="form-group">
                                <label for="email" class="form-label">Adresse email <span style="color:var(--accent);">*</span></label>
                                <input type="email" id="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                       value="{{ old('email') }}" placeholder="votre@email.com" required>
                            </div>
                            <div class="form-group">
                                <label for="telephone" class="form-label">Téléphone <span style="color:var(--accent);">*</span></label>
                                <input type="tel" id="telephone" name="telephone" class="form-control {{ $errors->has('telephone') ? 'is-invalid' : '' }}"
                                       value="{{ old('telephone') }}" placeholder="+229 XX XX XX XX" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="ville" class="form-label">Ville de résidence <span style="color:var(--accent);">*</span></label>
                            <input type="text" id="ville" name="ville" class="form-control {{ $errors->has('ville') ? 'is-invalid' : '' }}"
                                   value="{{ old('ville') }}" placeholder="Ex : Abomey-Calavi, Cotonou, Porto-Novo..." required>
                        </div>

                        <div class="form-group">
                            <label for="situation_enfant" class="form-label">Situation de votre enfant <span style="color:var(--accent);">*</span></label>
                            <textarea id="situation_enfant" name="situation_enfant" class="form-control {{ $errors->has('situation_enfant') ? 'is-invalid' : '' }}"
                                      rows="4" placeholder="Décrivez brièvement la situation de votre enfant : âge, diagnostic reçu ou en cours, difficultés rencontrées, attentes vis-à-vis du club..." required>{{ old('situation_enfant') }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="comment_nous_connu" class="form-label">Comment avez-vous connu EVA Autisme ?</label>
                            <select id="comment_nous_connu" name="comment_nous_connu" class="form-control">
                                <option value="" disabled {{ old('comment_nous_connu') ? '' : 'selected' }}>Choisissez...</option>
                                <option value="bouche_oreille" {{ old('comment_nous_connu') === 'bouche_oreille' ? 'selected' : '' }}>Bouche à oreille / famille / amis</option>
                                <option value="facebook" {{ old('comment_nous_connu') === 'facebook' ? 'selected' : '' }}>Facebook / Réseaux sociaux</option>
                                <option value="professionnel_sante" {{ old('comment_nous_connu') === 'professionnel_sante' ? 'selected' : '' }}>Un professionnel de santé</option>
                                <option value="ecole" {{ old('comment_nous_connu') === 'ecole' ? 'selected' : '' }}>L'école de mon enfant</option>
                                <option value="evenement" {{ old('comment_nous_connu') === 'evenement' ? 'selected' : '' }}>Un événement / une campagne</option>
                                <option value="recherche_internet" {{ old('comment_nous_connu') === 'recherche_internet' ? 'selected' : '' }}>Recherche sur internet</option>
                                <option value="autre" {{ old('comment_nous_connu') === 'autre' ? 'selected' : '' }}>Autre</option>
                            </select>
                        </div>

                        <div style="margin-top:1.5rem;display:flex;gap:1rem;flex-wrap:wrap;align-items:center;">
                            <button type="submit" class="btn btn-blue" style="font-size:1rem;padding:0.8rem 2.5rem;">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:16px;height:16px"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                                Rejoindre le Club Parents
                            </button>
                            <span style="font-size:0.8rem;color:var(--text-muted);">* Champs obligatoires · Adhésion gratuite</span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===================== FAQ ===================== -->
<section class="section">
    <div class="container">
        <div class="section-header reveal">
            <span class="label">Questions fréquentes</span>
            <h2>FAQ – Club Parents</h2>
            <div class="section-divider"></div>
        </div>
        <div style="max-width:800px;margin:2.5rem auto 0;">

            <div class="faq-item reveal">
                <button class="faq-question" onclick="toggleFaq(this)">
                    L'adhésion au Club Parents est-elle payante ?
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="width:18px;height:18px"><polyline points="6 9 12 15 18 9"/></svg>
                </button>
                <div class="faq-answer">
                    Non, l'adhésion au Club Parents d'EVA Autisme est entièrement gratuite. Toutes les familles concernées par l'autisme sont les bienvenues, quelle que soit leur situation financière. Certaines activités spécifiques, comme des ateliers animés par des spécialistes externes, peuvent occasionnellement faire l'objet d'une participation symbolique aux frais.
                </div>
            </div>

            <div class="faq-item reveal">
                <button class="faq-question" onclick="toggleFaq(this)">
                    Mon enfant n'a pas encore de diagnostic officiel. Puis-je quand même rejoindre le club ?
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="width:18px;height:18px"><polyline points="6 9 12 15 18 9"/></svg>
                </button>
                <div class="faq-answer">
                    Absolument. Le Club Parents est ouvert à toutes les familles qui observent des signes évocateurs d'autisme chez leur enfant, que le diagnostic soit confirmé, en cours ou simplement suspecté. Nous pouvons aussi vous orienter vers les professionnels compétents pour entamer un bilan diagnostic au Bénin.
                </div>
            </div>

            <div class="faq-item reveal">
                <button class="faq-question" onclick="toggleFaq(this)">
                    Les réunions du club se tiennent-elles uniquement à Abomey-Calavi ?
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="width:18px;height:18px"><polyline points="6 9 12 15 18 9"/></svg>
                </button>
                <div class="faq-answer">
                    Les réunions principales ont lieu à Abomey-Calavi, mais nous organisons régulièrement des rencontres à Cotonou. Certaines sessions sont également disponibles en ligne via visioconférence pour les familles des autres villes et communes du Bénin. Si vous êtes dans une région éloignée, contactez-nous pour trouver la meilleure option.
                </div>
            </div>

            <div class="faq-item reveal">
                <button class="faq-question" onclick="toggleFaq(this)">
                    Quel est le rôle des professionnels qui interviennent dans le club ?
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="width:18px;height:18px"><polyline points="6 9 12 15 18 9"/></svg>
                </button>
                <div class="faq-answer">
                    Les professionnels (psychologues, orthophonistes, éducateurs spécialisés, médecins) interviennent bénévolement lors de certaines réunions ou ateliers pour apporter des éléments scientifiques, répondre aux questions des parents et animer des exercices pratiques. Ils ne remplacent pas un suivi individuel mais enrichissent les échanges collectifs et peuvent orienter les familles vers des consultations personnalisées si nécessaire.
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ===================== CTA ===================== -->
<section style="background:linear-gradient(135deg,var(--primary) 0%,#0073e6 100%);padding:70px 0;color:#fff;">
    <div class="container" style="text-align:center;">
        <div class="reveal">
            <h2 style="color:#fff;margin-bottom:1rem;">Une question avant de rejoindre le club ?</h2>
            <p style="color:rgba(255,255,255,0.85);max-width:540px;margin:0 auto 2rem;">
                Notre équipe est disponible pour répondre à vos questions et vous accompagner dans vos premiers pas avec le Club Parents EVA Autisme.
            </p>
            <div style="display:flex;gap:1rem;justify-content:center;flex-wrap:wrap;">
                <a href="{{ route('contact') }}" class="btn btn-orange" style="font-size:1rem;padding:0.85rem 2rem;">Nous Contacter</a>
                <a href="{{ route('actions.formation') }}" class="btn btn-white" style="font-size:1rem;padding:0.85rem 2rem;">Nos Formations</a>
            </div>
        </div>
    </div>
</section>

@endsection

@section('scripts')
<script>
function toggleFaq(btn) {
    var item = btn.closest('.faq-item');
    var isOpen = item.classList.contains('open');
    document.querySelectorAll('.faq-item').forEach(function(el) { el.classList.remove('open'); });
    if (!isOpen) item.classList.add('open');
}
</script>
@endsection
