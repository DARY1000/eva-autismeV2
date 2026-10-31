@extends('layouts.app')

@section('title', 'Le Centre NESA')
@section('meta_description', 'Découvrez en 3D le Centre NESA, projet de centre de jour et de logement adapté de l\'ONG EVA Autisme au Bénin : éducation, thérapies, formation et soutien aux familles.')

@section('styles')
<script type="importmap">{"imports":{"three":"{{ asset('js/vendor/three/three.module.min.js') }}"}}</script>
@endsection

@section('content')

<div class="page-header">
    <div class="container">
        <span class="centre-status">Projet en préparation</span>
        <h1>Le Centre NESA</h1>
        <p>Un centre de jour et de logement adapté pour les personnes autistes et leurs familles au Bénin</p>
        <nav class="breadcrumb">
            <a href="{{ route('home') }}">Accueil</a>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="width:14px;height:14px"><polyline points="9 18 15 12 9 6"/></svg>
            <a href="{{ route('actions.projets') }}">Nos Projets</a>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="width:14px;height:14px"><polyline points="9 18 15 12 9 6"/></svg>
            <span>Le Centre NESA</span>
        </nav>
    </div>
</div>

<!-- Pourquoi -->
<section class="section">
    <div class="container">
        <div class="section-header reveal">
            <span class="label">Pourquoi ce centre</span>
            <h2>Un lieu qui réunit ce que les familles cherchent aujourd'hui séparément</h2>
            <div class="section-divider"></div>
            <p>Au Bénin, l'autisme reste mal connu et les familles parcourent souvent un long chemin pour trouver une écoute, un accompagnement et une place à l'école. Le centre rassemblera ces réponses en un seul lieu.</p>
        </div>
        <div class="grid-3 centre-facts">
            <div class="centre-fact reveal">
                <strong>1 personne sur 127</strong>
                <p>était autiste dans le monde en 2021, selon l'OMS. Ce chiffre reste une moyenne : la prévalence est encore inconnue dans de nombreux pays à revenu faible ou intermédiaire.</p>
            </div>
            <div class="centre-fact reveal">
                <strong>Agir tôt</strong>
                <p>L'OMS souligne qu'un accès rapide à des interventions fondées sur des données factuelles peut améliorer la communication et le comportement social des enfants.</p>
            </div>
            <div class="centre-fact reveal">
                <strong>Santé, école, emploi</strong>
                <p>L'accompagnement doit relier la santé, l'éducation, l'emploi et l'action sociale, avec la participation des personnes autistes elles-mêmes.</p>
            </div>
        </div>
    </div>
</section>

<!-- Visite 3D -->
<section class="section bg-light" id="visite">
    <div class="container">
        <div class="section-header reveal">
            <span class="label">Visite en 3D</span>
            <h2>Explorez le futur centre</h2>
            <div class="section-divider"></div>
            <p>Faites tourner la maquette, puis choisissez un espace pour le découvrir.</p>
        </div>

        <div class="c3d" data-c3d>
            <div class="c3d-stage">
                <canvas aria-hidden="true"></canvas>
                <div class="c3d-pins" data-c3d-pins></div>
                <div class="c3d-tools">
                    <button type="button" data-c3d-zoom="in" aria-label="Rapprocher la vue">+</button>
                    <button type="button" data-c3d-zoom="out" aria-label="Éloigner la vue">−</button>
                    <button type="button" data-c3d-reset>Vue d'ensemble</button>
                </div>
                <p class="c3d-note">Maquette d'intention, non contractuelle : les plans définitifs seront établis avec des architectes.</p>
                <p class="c3d-fallback" data-c3d-fallback hidden>La maquette 3D ne peut pas s'afficher sur cet appareil. Tous les espaces du centre sont décrits ici.</p>
            </div>

            <ol class="c3d-zones">
                @foreach($zones as $id => $zone)
                    <li>
                        <button type="button" class="c3d-zone" data-c3d-zone="{{ $id }}" aria-expanded="false">
                            <span class="c3d-number">{{ $loop->iteration }}</span>
                            <span class="c3d-zone-title">{{ $zone['title'] }}</span>
                        </button>
                        <p>{{ $zone['text'] }}</p>
                    </li>
                @endforeach
            </ol>
        </div>
    </div>
</section>

<!-- Architecture -->
<section class="section">
    <div class="container">
        <div class="section-header reveal">
            <span class="label">Pensé pour l'autisme</span>
            <h2>Un bâtiment qui respecte la sensibilité de chacun</h2>
            <div class="section-divider"></div>
            <p>Le plan s'inspire des sept principes de l'index ASPECTSS, élaboré par l'architecte Magda Mostafa pour concevoir des lieux adaptés aux personnes autistes.</p>
        </div>
        <div class="centre-principles reveal">
            @foreach($principles as $principle)
                <div>
                    <h3>{{ $principle['title'] }}</h3>
                    <p>{{ $principle['text'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Orientations nationales -->
<section class="section bg-light">
    <div class="container">
        <div class="section-header reveal">
            <span class="label">Pour le Bénin</span>
            <h2>Un projet en phase avec les ambitions du pays</h2>
            <div class="section-divider"></div>
            <p>L'éducation et l'inclusion figurent dans le projet de société du Président Romuald Wadagni pour 2026-2033 et dans la vision Bénin 2060 Alafia. Voici ce que le centre peut y apporter.</p>
        </div>

        <div class="centre-align reveal">
            @foreach($alignment as $row)
                <article>
                    <span>{{ $row['source'] }}</span>
                    <div>
                        <h3>L'orientation</h3>
                        <p>{{ $row['public'] }}</p>
                    </div>
                    <div>
                        <h3>L'apport du centre</h3>
                        <p>{{ $row['centre'] }}</p>
                    </div>
                </article>
            @endforeach
        </div>

        <div class="centre-context reveal">
            <p>Le centre prolongera aussi l'action déjà engagée par l'État : une phase pilote de prise en charge des enfants autistes a été lancée en juin 2024 à Cotonou et à Abomey-Calavi, et le Conseil des ministres du 2 septembre 2026 a exonéré de frais de scolarité 5 000 élèves handicapés.</p>
            <p><strong>Le Centre NESA est un projet de l'ONG EVA Autisme.</strong> Ce n'est pas un programme de l'État et il ne bénéficie à ce jour d'aucune validation officielle.</p>
            <details>
                <summary>Voir les sources (octobre 2026)</summary>
                <ul>
                    @foreach($sources as $source)
                        <li><a href="{{ $source['url'] }}" target="_blank" rel="noopener">{{ $source['label'] }}</a></li>
                    @endforeach
                </ul>
            </details>
        </div>
    </div>
</section>

<!-- Appel -->
<section class="band" style="padding:80px 0;color:#fff;">
    <div class="container" style="text-align:center;">
        <div class="reveal">
            <h2 style="color:#fff;margin-bottom:1rem;">Construisons ce centre ensemble</h2>
            <p style="max-width:580px;margin:0 auto 2rem;">Partenaires, institutions, entreprises, architectes ou donateurs : chaque soutien nous rapproche de l'ouverture du centre.</p>
            <div style="display:flex;gap:1rem;justify-content:center;flex-wrap:wrap;">
                <a href="{{ route('don') }}" class="btn btn-orange">Faire un Don</a>
                <a href="{{ route('contact') }}" class="btn btn-white">Devenir Partenaire</a>
            </div>
        </div>
    </div>
</section>

@endsection

@section('scripts')
<script type="module" src="{{ asset('js/centre-3d.js') }}?v={{ filemtime(public_path('js/centre-3d.js')) }}"></script>
@endsection
