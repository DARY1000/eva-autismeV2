@extends('layouts.app')

@section('title', 'Nos Réalisations')
@section('meta_description', 'Les réalisations de l\'ONG EVA Autisme au Bénin depuis 2022 : familles accompagnées, formations dispensées, événements organisés et campagnes de sensibilisation.')

@section('content')

<!-- ===================== PAGE HEADER ===================== -->
<div class="page-header">
    <div class="container">
        <h1>Nos Réalisations</h1>
        <p>Un bilan de nos actions et de l'impact créé depuis notre création en 2022</p>
        <nav class="breadcrumb">
            <a href="{{ route('home') }}">Accueil</a>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="width:14px;height:14px"><polyline points="9 18 15 12 9 6"/></svg>
            <span>Nos Réalisations</span>
        </nav>
    </div>
</div>

<!-- ===================== CHIFFRES CLÉS ===================== -->
<section class="section bg-light">
    <div class="container">
        <div class="section-header reveal">
            <span class="label">Notre impact en chiffres</span>
            <h2>Ce que nous avons accompli ensemble</h2>
            <div class="section-divider"></div>
        </div>
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:2rem;margin-top:2.5rem;">
            <div class="reveal" style="text-align:center;background:#fff;border-radius:var(--radius-lg);padding:2.5rem 1.5rem;box-shadow:var(--shadow-sm);border:1px solid var(--border);">
                <div style="width:56px;height:56px;background:var(--primary-light);border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 1rem;">
                    <svg viewBox="0 0 24 24" fill="none" stroke="var(--primary)" stroke-width="2" style="width:26px;height:26px"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                </div>
                <div style="font-size:2.8rem;font-weight:800;color:var(--primary);line-height:1;">200<span style="font-size:1.5rem;">+</span></div>
                <div style="font-size:1rem;font-weight:600;margin:0.5rem 0 0.3rem;">Familles accompagnées</div>
                <p style="font-size:0.82rem;color:var(--text-muted);">Familles d'enfants autistes ayant bénéficié d'un suivi ou d'une orientation depuis 2022.</p>
            </div>
            <div class="reveal" style="text-align:center;background:#fff;border-radius:var(--radius-lg);padding:2.5rem 1.5rem;box-shadow:var(--shadow-sm);border:1px solid var(--border);">
                <div style="width:56px;height:56px;background:#fef3e8;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 1rem;">
                    <svg viewBox="0 0 24 24" fill="none" stroke="#ffa84b" stroke-width="2" style="width:26px;height:26px"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                </div>
                <div style="font-size:2.8rem;font-weight:800;color:#ffa84b;line-height:1;">50<span style="font-size:1.5rem;">+</span></div>
                <div style="font-size:1rem;font-weight:600;margin:0.5rem 0 0.3rem;">Événements organisés</div>
                <p style="font-size:0.82rem;color:var(--text-muted);">Conférences, ateliers, journées de sensibilisation et campagnes menés sur le territoire béninois.</p>
            </div>
            <div class="reveal" style="text-align:center;background:#fff;border-radius:var(--radius-lg);padding:2.5rem 1.5rem;box-shadow:var(--shadow-sm);border:1px solid var(--border);">
                <div style="width:56px;height:56px;background:var(--green-light);border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 1rem;">
                    <svg viewBox="0 0 24 24" fill="none" stroke="var(--green)" stroke-width="2" style="width:26px;height:26px"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>
                </div>
                <div style="font-size:2.8rem;font-weight:800;color:var(--green);line-height:1;">100<span style="font-size:1.5rem;">+</span></div>
                <div style="font-size:1rem;font-weight:600;margin:0.5rem 0 0.3rem;">Professionnels formés</div>
                <p style="font-size:0.82rem;color:var(--text-muted);">Enseignants, professionnels de santé et travailleurs sociaux formés aux réalités du TSA.</p>
            </div>
            <div class="reveal" style="text-align:center;background:#fff;border-radius:var(--radius-lg);padding:2.5rem 1.5rem;box-shadow:var(--shadow-sm);border:1px solid var(--border);">
                <div style="width:56px;height:56px;background:var(--teal-light);border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 1rem;">
                    <svg viewBox="0 0 24 24" fill="none" stroke="var(--teal)" stroke-width="2" style="width:26px;height:26px"><circle cx="12" cy="12" r="10"/><path d="M8 14s1.5 2 4 2 4-2 4-2"/><line x1="9" y1="9" x2="9.01" y2="9"/><line x1="15" y1="9" x2="15.01" y2="9"/></svg>
                </div>
                <div style="font-size:2.8rem;font-weight:800;color:var(--teal);line-height:1;">500<span style="font-size:1.5rem;">+</span></div>
                <div style="font-size:1rem;font-weight:600;margin:0.5rem 0 0.3rem;">Personnes sensibilisées</div>
                <p style="font-size:0.82rem;color:var(--text-muted);">Grand public, élèves, personnels scolaires et entreprises sensibilisés à l'autisme au Bénin.</p>
            </div>
        </div>
    </div>
</section>

<!-- ===================== TIMELINE ===================== -->
<section class="section">
    <div class="container">
        <div class="section-header reveal">
            <span class="label">Chronologie</span>
            <h2>Notre parcours depuis 2022</h2>
            <div class="section-divider"></div>
        </div>

        @php
        $defaultRealizations = [
            [
                'annee'       => '2022',
                'mois'        => 'Mai',
                'titre'       => 'Création officielle de l\'ONG EVA Autisme',
                'description' => 'Enregistrement de l\'association sous le N°2022/044/DEP-ATL/SG/SAG-ASSOC à Abomey-Calavi. Lancement des premières actions d\'accueil et d\'orientation des familles.',
                'categorie'   => 'Fondation',
            ],
            [
                'annee'       => '2022',
                'mois'        => 'Septembre',
                'titre'       => 'Lancement du Club Parents',
                'description' => 'Création d\'un espace de soutien et d\'échange pour les parents d\'enfants autistes. Premières réunions mensuelles à Abomey-Calavi avec une dizaine de familles fondatrices.',
                'categorie'   => 'Soutien familial',
            ],
            [
                'annee'       => '2023',
                'mois'        => 'Avril',
                'titre'       => 'Journée Mondiale de l\'Autisme – Édition 2023',
                'description' => 'Organisation de la Journée Mondiale de l\'Autisme avec plus de 150 participants. Conférence publique, exposition et activités culturelles mettant en valeur les talents des enfants autistes.',
                'categorie'   => 'Sensibilisation',
            ],
            [
                'annee'       => '2023',
                'mois'        => 'Juillet',
                'titre'       => 'Première formation d\'enseignants sur les TSA',
                'description' => 'Formation de 35 enseignants des communes d\'Abomey-Calavi et Cotonou sur la scolarisation inclusive et les stratégies d\'accompagnement des élèves avec TSA en classe ordinaire.',
                'categorie'   => 'Formation',
            ],
            [
                'annee'       => '2024',
                'mois'        => 'Février',
                'titre'       => 'Lancement du projet Éco Sens',
                'description' => 'Démarrage du projet innovant associant sensibilisation à l\'autisme et éducation environnementale. Ateliers menés avec 40 enfants autistes dans trois communes du département de l\'Atlantique.',
                'categorie'   => 'Projets',
            ],
            [
                'annee'       => '2024',
                'mois'        => 'Avril',
                'titre'       => 'Journée Mondiale de l\'Autisme – Édition 2024',
                'description' => 'Deuxième édition avec plus de 300 participants. Partenariat avec les autorités locales d\'Abomey-Calavi, tables rondes avec des médecins et témoignages de familles.',
                'categorie'   => 'Sensibilisation',
            ],
            [
                'annee'       => '2024',
                'mois'        => 'Novembre',
                'titre'       => 'Formation de professionnels de santé',
                'description' => 'Atelier de deux jours à l\'attention de 28 professionnels de santé (infirmiers, sages-femmes, médecins généralistes) sur le dépistage précoce de l\'autisme et l\'orientation des familles.',
                'categorie'   => 'Formation',
            ],
            [
                'annee'       => '2025',
                'mois'        => 'Janvier',
                'titre'       => 'Programme d\'Accompagnement à Domicile',
                'description' => 'Mise en place de visites à domicile pour soutenir les familles les plus isolées. 20 familles bénéficient désormais d\'un accompagnement personnalisé par des éducateurs spécialisés.',
                'categorie'   => 'Accompagnement',
            ],
            [
                'annee'       => '2025',
                'mois'        => 'Avril',
                'titre'       => 'Journée Mondiale de l\'Autisme – Édition 2025',
                'description' => 'Troisième édition, la plus grande à ce jour, avec plus de 500 participants. Caravane de sensibilisation dans 5 quartiers d\'Abomey-Calavi, dépistage gratuit et concert caritatif.',
                'categorie'   => 'Sensibilisation',
            ],
            [
                'annee'       => '2026',
                'mois'        => 'Janvier',
                'titre'       => 'Nouveau partenariat pour la scolarisation inclusive',
                'description' => 'Signature d\'une convention avec la Direction Départementale de l\'Enseignement Secondaire de l\'Atlantique pour intégrer le volet autisme dans les programmes de formation des enseignants.',
                'categorie'   => 'Éducation',
            ],
        ];
        $realizations = $realizations ?? $defaultRealizations;
        @endphp

        <div style="position:relative;margin-top:3rem;padding-left:2rem;">
            <!-- Ligne verticale -->
            <div style="position:absolute;left:0;top:0;bottom:0;width:3px;background:linear-gradient(to bottom,var(--primary),var(--accent));border-radius:2px;"></div>

            @foreach($realizations as $index => $item)
            @php
                $annee       = is_array($item) ? $item['annee']       : $item->annee;
                $mois        = is_array($item) ? $item['mois']        : $item->mois;
                $titre       = is_array($item) ? $item['titre']       : $item->titre;
                $description = is_array($item) ? $item['description'] : $item->description;
                $categorie   = is_array($item) ? $item['categorie']   : $item->categorie;
                $dotColor    = ($index % 2 === 0) ? 'var(--primary)' : 'var(--accent)';
            @endphp
            <div class="reveal" style="position:relative;margin-bottom:2.5rem;padding-left:2rem;">
                <!-- Point sur la timeline -->
                <div style="position:absolute;left:-2.5rem;top:0.3rem;width:18px;height:18px;border-radius:50%;background:{{ $dotColor }};border:3px solid #fff;box-shadow:0 0 0 2px {{ $dotColor }};"></div>
                <div style="background:#fff;border-radius:var(--radius-lg);padding:1.5rem 2rem;box-shadow:var(--shadow-sm);border:1px solid var(--border);">
                    <div style="display:flex;align-items:center;gap:0.75rem;flex-wrap:wrap;margin-bottom:0.5rem;">
                        <span style="font-size:0.78rem;font-weight:700;color:#fff;background:{{ $dotColor }};padding:2px 10px;border-radius:20px;">{{ $mois }} {{ $annee }}</span>
                        <span class="card-tag" style="font-size:0.75rem;">{{ $categorie }}</span>
                    </div>
                    <h3 style="font-size:1.05rem;margin-bottom:0.5rem;">{{ $titre }}</h3>
                    <p style="font-size:0.875rem;color:var(--text-muted);line-height:1.6;margin:0;">{{ $description }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ===================== GALERIE PHOTOS ===================== -->
<section class="section bg-light">
    <div class="container">
        <div class="section-header reveal">
            <span class="label">Galerie</span>
            <h2>Moments forts de nos activités</h2>
            <div class="section-divider"></div>
            <p>Quelques images illustrant notre engagement quotidien sur le terrain au Bénin.</p>
        </div>

        <div class="media-grid reveal" style="display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:1rem;margin-top:2.5rem;">
            @php
            $photos = $photos ?? [];
            $placeholderPhotos = [
                ['alt' => 'Journée Mondiale de l\'Autisme 2025 – Abomey-Calavi', 'label' => 'Sensibilisation 2025'],
                ['alt' => 'Atelier Club Parents – Cotonou', 'label' => 'Club Parents'],
                ['alt' => 'Formation enseignants sur les TSA', 'label' => 'Formation 2024'],
                ['alt' => 'Projet Éco Sens – Enfants autistes et nature', 'label' => 'Éco Sens'],
                ['alt' => 'Conférence sur l\'autisme – Abomey-Calavi', 'label' => 'Conférence'],
                ['alt' => 'Accompagnement à domicile', 'label' => 'Terrain'],
            ];
            @endphp

            @forelse($photos as $photo)
            @php
                $photoSrc   = $photo->file_url ?: ($photo->file_path ? asset('storage/'.$photo->file_path) : null);
                $photoAlt   = $photo->alt_text ?? $photo->title ?? 'EVA Autisme';
                $photoAlbum = $photo->album ?? '';
            @endphp
            <div class="reveal" style="border-radius:var(--radius);overflow:hidden;aspect-ratio:4/3;cursor:pointer;position:relative;box-shadow:var(--shadow-sm);"
                 data-lightbox="galerie" data-src="{{ $photoSrc }}">
                @if($photoSrc)
                <img src="{{ $photoSrc }}" alt="{{ $photoAlt }}"
                     style="width:100%;height:100%;object-fit:cover;transition:transform 0.35s ease;">
                @endif
                @if($photoAlbum)
                <div style="position:absolute;top:0.6rem;left:0.6rem;background:rgba(0,85,165,0.85);color:#fff;font-size:0.72rem;font-weight:700;padding:2px 10px;border-radius:20px;backdrop-filter:blur(4px);">{{ $photoAlbum }}</div>
                @endif
                <div style="position:absolute;bottom:0;left:0;right:0;padding:0.65rem 0.85rem;color:#fff;font-size:0.82rem;font-weight:600;background:linear-gradient(transparent,rgba(0,0,0,0.65));">{{ $photoAlt }}</div>
            </div>
            @empty
            @foreach($placeholderPhotos as $placeholder)
            <div class="reveal" style="border-radius:var(--radius);overflow:hidden;aspect-ratio:4/3;cursor:pointer;position:relative;box-shadow:var(--shadow-sm);background:var(--primary-light);"
                 data-lightbox="galerie">
                <div style="position:absolute;top:0.6rem;left:0.6rem;background:rgba(0,85,165,0.18);color:var(--primary);font-size:0.72rem;font-weight:700;padding:2px 10px;border-radius:20px;">{{ $placeholder['label'] }}</div>
                <div style="width:100%;height:100%;display:flex;flex-direction:column;align-items:center;justify-content:center;gap:0.5rem;padding:1.5rem;text-align:center;">
                    <svg viewBox="0 0 24 24" fill="none" stroke="var(--primary)" stroke-width="1.2" style="width:52px;height:52px;opacity:0.35">
                        <rect x="3" y="3" width="18" height="18" rx="2"/>
                        <circle cx="8.5" cy="8.5" r="1.5"/>
                        <polyline points="21 15 16 10 5 21"/>
                    </svg>
                    <span style="font-size:0.82rem;color:var(--text-mid);line-height:1.4;">{{ $placeholder['alt'] }}</span>
                </div>
            </div>
            @endforeach
            @endforelse
        </div>

        <div style="text-align:center;margin-top:2rem;" class="reveal">
            <a href="{{ route('resources.medias') }}" class="btn btn-blue">Voir toutes nos activités</a>
        </div>
    </div>
</section>

<!-- ===================== CTA ===================== -->
<section style="background:linear-gradient(135deg,var(--primary) 0%,#0073e6 100%);padding:70px 0;color:#fff;">
    <div class="container" style="text-align:center;">
        <div class="reveal">
            <h2 style="color:#fff;margin-bottom:1rem;">Soutenez nos prochaines réalisations</h2>
            <p style="color:rgba(255,255,255,0.85);max-width:560px;margin:0 auto 2rem;">
                Grâce à votre générosité, EVA Autisme peut continuer à agir concrètement pour les enfants autistes et leurs familles à travers tout le Bénin.
            </p>
            <div style="display:flex;gap:1rem;justify-content:center;flex-wrap:wrap;">
                <a href="{{ route('don') }}" class="btn btn-orange" style="font-size:1rem;padding:0.85rem 2rem;">Faire un Don</a>
                <a href="{{ route('contact') }}" class="btn btn-white" style="font-size:1rem;padding:0.85rem 2rem;">Nous Contacter</a>
            </div>
        </div>
    </div>
</section>

@endsection
