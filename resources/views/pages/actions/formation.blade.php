@extends('layouts.app')

@section('title', 'Formations')
@section('meta_description', 'EVA Autisme propose des formations sur l\'autisme pour les parents, enseignants, professionnels de santé et entreprises au Bénin.')

@section('content')

<!-- ===================== PAGE HEADER ===================== -->
<div class="page-header">
    <div class="container">
        <h1>Nos Formations</h1>
        <p>Renforcer les compétences de tous les acteurs pour une meilleure prise en charge de l'autisme au Bénin</p>
        <nav class="breadcrumb">
            <a href="{{ route('home') }}">Accueil</a>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="width:14px;height:14px"><polyline points="9 18 15 12 9 6"/></svg>
            <span>Formation</span>
        </nav>
    </div>
</div>

<!-- ===================== INTRO ===================== -->
<section class="section bg-light">
    <div class="container">
        <div class="grid-2" style="gap:4rem;align-items:center;">
            <div class="reveal">
                <div class="section-header" style="text-align:left;">
                    <span class="label">Pourquoi se former ?</span>
                    <h2>Des formations adaptées à chaque public</h2>
                    <div class="section-divider" style="margin-left:0;"></div>
                </div>
                <p style="margin-top:1.25rem;">
                    L'autisme est encore trop souvent méconnu au Bénin. Les préjugés, le manque de ressources et l'absence de formation spécifique retardent le diagnostic et fragilisent les familles. EVA Autisme propose des formations concrètes, accessibles et ancrées dans le contexte local pour changer cette réalité.
                </p>
                <p style="margin-top:1rem;">
                    Nos formations sont animées par des professionnels expérimentés et des membres de notre réseau. Elles combinent apports théoriques, échanges pratiques et outils directement mobilisables au quotidien.
                </p>
                <div style="margin-top:2rem;display:flex;gap:1rem;flex-wrap:wrap;">
                    <a href="#formations" class="btn btn-blue">Voir les formations</a>
                    <a href="#inscription" class="btn btn-white-light">S'inscrire</a>
                </div>
            </div>
            <div class="reveal">
                <div style="display:flex;flex-direction:column;gap:1rem;">
                    <div style="display:flex;align-items:flex-start;gap:1rem;background:#fff;padding:1.25rem;border-radius:var(--radius);box-shadow:var(--shadow-sm);">
                        <div style="width:44px;height:44px;background:var(--primary-light);border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                            <svg viewBox="0 0 24 24" fill="none" stroke="var(--primary)" stroke-width="2" style="width:22px;height:22px"><polyline points="9 11 12 14 22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
                        </div>
                        <div>
                            <h4 style="font-size:0.95rem;margin-bottom:0.2rem;">Contenu validé par des experts</h4>
                            <p style="font-size:0.83rem;color:var(--text-muted);">Formations élaborées avec des psychologues, orthophonistes et éducateurs spécialisés.</p>
                        </div>
                    </div>
                    <div style="display:flex;align-items:flex-start;gap:1rem;background:#fff;padding:1.25rem;border-radius:var(--radius);box-shadow:var(--shadow-sm);">
                        <div style="width:44px;height:44px;background:var(--primary-light);border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                            <svg viewBox="0 0 24 24" fill="none" stroke="var(--primary)" stroke-width="2" style="width:22px;height:22px"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                        </div>
                        <div>
                            <h4 style="font-size:0.95rem;margin-bottom:0.2rem;">Groupes à taille humaine</h4>
                            <p style="font-size:0.83rem;color:var(--text-muted);">Maximum 30 participants par session pour favoriser les échanges et la pratique.</p>
                        </div>
                    </div>
                    <div style="display:flex;align-items:flex-start;gap:1rem;background:#fff;padding:1.25rem;border-radius:var(--radius);box-shadow:var(--shadow-sm);">
                        <div style="width:44px;height:44px;background:var(--primary-light);border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                            <svg viewBox="0 0 24 24" fill="none" stroke="var(--primary)" stroke-width="2" style="width:22px;height:22px"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        </div>
                        <div>
                            <h4 style="font-size:0.95rem;margin-bottom:0.2rem;">Sur site ou à distance</h4>
                            <p style="font-size:0.83rem;color:var(--text-muted);">Formations organisées à Abomey-Calavi, Cotonou, en région ou en ligne selon les besoins.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===================== LES 4 TYPES DE FORMATION ===================== -->
<section class="section" id="formations">
    <div class="container">
        <div class="section-header reveal">
            <span class="label">Nos offres de formation</span>
            <h2>Quatre programmes pour agir ensemble</h2>
            <div class="section-divider"></div>
        </div>

        @php
        $iconColors = [
            'primary' => ['bg' => 'var(--primary-light)', 'stroke' => 'var(--primary)'],
            'accent'  => ['bg' => '#fff0ed',              'stroke' => 'var(--accent)'],
            'green'   => ['bg' => 'var(--green-light)',   'stroke' => 'var(--green)'],
            'teal'    => ['bg' => 'var(--teal-light)',    'stroke' => 'var(--teal)'],
        ];
        $defaultFormations = [
            ['titre' => 'Formation Parents', 'public_cible' => 'Parents & familles', 'duree' => '1 journée (8h)', 'icon_color' => 'primary', 'description' => 'Destinée aux parents d\'enfants autistes, cette formation aborde les TSA de manière concrète : comprendre le diagnostic, gérer les comportements au quotidien, utiliser des stratégies éducatives adaptées et connaître les ressources disponibles au Bénin.', 'objectifs' => "Comprendre les Troubles du Spectre de l'Autisme\nStratégies éducatives et de communication adaptées\nGestion des situations de crise et des comportements difficiles\nDroits des enfants autistes et accès aux services", 'format' => 'présentiel'],
            ['titre' => 'Formation Enseignants', 'public_cible' => 'Enseignants & éducateurs', 'duree' => '2 jours (16h)', 'icon_color' => 'green', 'description' => 'Formation spécialisée pour les enseignants des écoles maternelles, primaires et secondaires sur l\'accueil et l\'inclusion scolaire des élèves avec TSA. Des outils pratiques immédiatement utilisables en classe.', 'objectifs' => "Identifier les signes d'alerte en classe et orienter\nAdapter les supports pédagogiques et la communication\nAménager l'environnement scolaire pour favoriser l'inclusion\nCollaborer avec les familles et les professionnels spécialisés", 'format' => 'présentiel'],
            ['titre' => 'Formation Professionnels de Santé', 'public_cible' => 'Médecins, infirmiers, sages-femmes', 'duree' => '2 jours (16h)', 'icon_color' => 'primary', 'description' => 'Une formation rigoureuse pour les professionnels de santé sur le dépistage précoce de l\'autisme, l\'annonce du diagnostic aux familles et l\'orientation vers des structures adaptées dans le contexte béninois.', 'objectifs' => "Signes cliniques précoces du TSA chez l'enfant\nOutils de dépistage utilisables en consultation de routine\nAnnonce du diagnostic : protocole et soutien aux familles\nRéseau de prise en charge et orientation au Bénin", 'format' => 'présentiel'],
            ['titre' => 'Sensibilisation Entreprises', 'public_cible' => 'RH, managers & équipes', 'duree' => 'Demi-journée (4h)', 'icon_color' => 'teal', 'description' => 'Intervention en entreprise pour sensibiliser les équipes à l\'autisme et à l\'inclusion en milieu professionnel. Particulièrement utile pour les DRH, managers et salariés qui accueillent ou accompagnent des personnes autistes.', 'objectifs' => "Comprendre l'autisme pour mieux collaborer\nInclusion en milieu de travail : bonnes pratiques\nAdapter le management et l'environnement professionnel\nRSE et engagement sociétal : pourquoi s'impliquer", 'format' => 'présentiel'],
        ];
        $formationList = (isset($formations) && $formations->count()) ? $formations : collect($defaultFormations);
        @endphp

        <div class="grid-2" style="margin-top:2.5rem;gap:2rem;">

            @foreach($formationList as $formation)
            @php
                $isModel   = is_object($formation) && method_exists($formation, 'getKey');
                $titre     = $isModel ? $formation->titre       : $formation['titre'];
                $public    = $isModel ? $formation->public_cible: $formation['public_cible'];
                $duree     = $isModel ? ($formation->duree ?? '') : ($formation['duree'] ?? '');
                $desc      = $isModel ? $formation->description  : $formation['description'];
                $objectifs = $isModel ? ($formation->objectifs ?? '') : ($formation['objectifs'] ?? '');
                $colorKey  = $isModel ? ($formation->icon_color ?? 'primary') : ($formation['icon_color'] ?? 'primary');
                $colors    = $iconColors[$colorKey] ?? $iconColors['primary'];
                $slugPublic= \Illuminate\Support\Str::slug($titre);
            @endphp
            <div class="card reveal">
                <div class="card-body" style="padding:2rem;">
                    <div style="width:56px;height:56px;background:{{ $colors['bg'] }};border-radius:12px;display:flex;align-items:center;justify-content:center;margin-bottom:1.25rem;">
                        <svg viewBox="0 0 24 24" fill="none" stroke="{{ $colors['stroke'] }}" stroke-width="2" style="width:28px;height:28px">
                            <path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/>
                        </svg>
                    </div>
                    <h3 style="font-size:1.15rem;margin-bottom:0.5rem;">{{ $titre }}</h3>
                    <div style="display:flex;gap:0.75rem;flex-wrap:wrap;margin-bottom:1rem;">
                        @if($duree)
                        <span style="font-size:0.78rem;background:{{ $colors['bg'] }};color:{{ $colors['stroke'] }};padding:3px 10px;border-radius:20px;font-weight:600;">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:12px;height:12px;display:inline;vertical-align:middle;margin-right:3px"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                            {{ $duree }}
                        </span>
                        @endif
                        <span style="font-size:0.78rem;background:#f0f7f0;color:#2e7d32;padding:3px 10px;border-radius:20px;font-weight:600;">{{ $public }}</span>
                    </div>
                    <p style="font-size:0.875rem;color:var(--text-muted);line-height:1.7;margin-bottom:1rem;">{{ $desc }}</p>
                    @if($objectifs)
                    <ul style="font-size:0.85rem;color:var(--text-muted);padding-left:1.2rem;margin-bottom:1.5rem;line-height:1.8;">
                        @foreach(array_filter(explode("\n", trim($objectifs))) as $obj)
                        <li>{{ trim($obj) }}</li>
                        @endforeach
                    </ul>
                    @endif
                    <a href="#inscription" class="btn btn-blue btn-sm" onclick="document.getElementById('formation_type').value='{{ $slugPublic }}'">S'inscrire à cette formation</a>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</section>

<!-- ===================== FORMULAIRE D'INSCRIPTION ===================== -->
<section class="section bg-light" id="inscription">
    <div class="container">
        <div class="section-header reveal">
            <span class="label">Inscrivez-vous</span>
            <h2>Formulaire d'inscription</h2>
            <div class="section-divider"></div>
            <p>Remplissez ce formulaire pour vous inscrire à l'une de nos formations. Nous vous contacterons sous 48h pour confirmer votre inscription.</p>
        </div>

        <div style="max-width:720px;margin:2.5rem auto 0;">

            @if($errors->any())
            <div class="alert" style="background:#fff3f3;border-left:4px solid #dc3545;color:#721c24;padding:1rem 1.25rem;border-radius:var(--radius);margin-bottom:1.5rem;">
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
                    <form action="{{ route('formation.register') }}" method="POST" novalidate>
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
                            <label for="organisation" class="form-label">Organisation / Établissement</label>
                            <input type="text" id="organisation" name="organisation" class="form-control"
                                   value="{{ old('organisation') }}" placeholder="Nom de votre école, structure de santé, entreprise...">
                        </div>

                        <div class="form-group">
                            <label for="formation_type" class="form-label">Type de formation souhaité <span style="color:var(--accent);">*</span></label>
                            <select id="formation_type" name="formation_type" class="form-control {{ $errors->has('formation_type') ? 'is-invalid' : '' }}" required>
                                <option value="" disabled {{ old('formation_type') ? '' : 'selected' }}>Choisissez une formation</option>
                                <option value="parents" {{ old('formation_type') === 'parents' ? 'selected' : '' }}>Formation Parents – Comprendre et accompagner les TSA</option>
                                <option value="enseignants" {{ old('formation_type') === 'enseignants' ? 'selected' : '' }}>Formation Enseignants – Inclusion scolaire</option>
                                <option value="professionnels_sante" {{ old('formation_type') === 'professionnels_sante' ? 'selected' : '' }}>Formation Professionnels de Santé – Dépistage et accompagnement</option>
                                <option value="entreprises" {{ old('formation_type') === 'entreprises' ? 'selected' : '' }}>Sensibilisation Entreprises – Inclusion en milieu de travail</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="message" class="form-label">Message ou question complémentaire</label>
                            <textarea id="message" name="message" class="form-control" rows="4"
                                      placeholder="Précisez vos attentes, contraintes de dates, nombre de participants si vous représentez un groupe...">{{ old('message') }}</textarea>
                        </div>

                        <div style="margin-top:1.5rem;display:flex;gap:1rem;flex-wrap:wrap;align-items:center;">
                            <button type="submit" class="btn btn-blue" style="font-size:1rem;padding:0.8rem 2.5rem;">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:16px;height:16px"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
                                Envoyer ma demande d'inscription
                            </button>
                            <span style="font-size:0.8rem;color:var(--text-muted);">* Champs obligatoires</span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===================== CTA ===================== -->
<section style="background:linear-gradient(135deg,var(--primary) 0%,#0073e6 100%);padding:70px 0;color:#fff;">
    <div class="container" style="text-align:center;">
        <div class="reveal">
            <h2 style="color:#fff;margin-bottom:1rem;">Vous souhaitez organiser une formation pour votre structure ?</h2>
            <p style="color:rgba(255,255,255,0.85);max-width:560px;margin:0 auto 2rem;">
                EVA Autisme peut se déplacer dans votre école, votre hôpital ou votre entreprise. Contactez-nous pour discuter de vos besoins et construire un programme sur mesure.
            </p>
            <a href="{{ route('contact') }}" class="btn btn-orange" style="font-size:1rem;padding:0.85rem 2rem;">Nous Contacter</a>
        </div>
    </div>
</section>

@endsection
