@extends('layouts.app')

@section('title', 'Notre Histoire')
@section('meta_description', 'Découvrez l\'histoire d\'EVA Autisme, de sa fondation en 2022 à Abomey-Calavi jusqu\'à son développement au service des familles d\'enfants autistes au Bénin.')

@section('content')

<!-- ===================== PAGE HEADER ===================== -->
<section class="page-header">
    <div class="container">
        <h1>Notre Histoire</h1>
        <nav class="breadcrumb" aria-label="Fil d'Ariane">
            <a href="{{ route('home') }}">Accueil</a>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
            <a href="{{ route('about.qui-sommes-nous') }}">À Propos</a>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
            <span>Notre Histoire</span>
        </nav>
    </div>
</section>

<!-- ===================== INTRO ===================== -->
<section class="section">
    <div class="container">
        <div class="section-header reveal" style="max-width:750px;margin:0 auto 3rem;">
            <span class="label">Depuis 2022</span>
            <h2>Du rêve à la réalité :<br>la naissance d'EVA Autisme</h2>
            <div class="section-divider"></div>
            <p style="margin-top:1rem;">
                L'ONG EVA Autisme est née en 2021 du constat commun, au Bénin, de la réalité de nombreuses familles démunies face à l'autisme : se retrouvant seules, sans informations, ni moyen d'orientation ; perdues à la recherche de solutions d'accompagnement adaptées et confrontées aux préjugés, à la marginalisation et à l'isolement. Cette situation leur faisait perdre tout espoir en l'avenir, enfermant leurs enfants autistes dans des conditions de vie indignes.
            </p>
            <p style="margin-top:0.75rem;font-style:italic;color:var(--primary);font-weight:600;font-size:1.05rem;">
                « Pour nous, chaque être humain constitue une valeur unique. »
            </p>
        </div>

        <!-- Photo illustrative -->
        <div class="reveal" style="border-radius:var(--radius-lg);overflow:hidden;max-height:420px;background:var(--primary-light);display:flex;align-items:center;justify-content:center;margin-bottom:5rem;">
            <img
                src="{{ asset('images/histoire-eva.jpg') }}"
                alt="Les débuts d'EVA Autisme"
                style="width:100%;max-height:420px;object-fit:cover;"
                onerror="this.parentElement.innerHTML='<div style=\'text-align:center;color:var(--primary);padding:4rem\'><svg viewBox=\'0 0 24 24\' fill=\'none\' stroke=\'currentColor\' stroke-width=\'1.5\' style=\'width:80px;height:80px;opacity:0.25\'><path d=\'M12 2a10 10 0 1 0 10 10H12V2z\'/><path d=\'M12 2a10 10 0 0 1 10 10\'/></svg><p style=\'margin-top:1rem;opacity:0.45;font-size:0.9rem\'>Photo à ajouter</p></div>'"
            >
        </div>

        <!-- ===== TIMELINE ===== -->
        <div style="position:relative;max-width:900px;margin:0 auto;">

            <!-- Ligne verticale centrale -->
            <div style="position:absolute;left:50%;top:0;bottom:0;width:3px;background:linear-gradient(to bottom,var(--primary),var(--accent));transform:translateX(-50%);border-radius:2px;"></div>

            <!-- Étape 1 – 2022 Création -->
            <div class="reveal timeline-left" style="display:flex;justify-content:flex-end;padding-right:calc(50% + 2.5rem);margin-bottom:3.5rem;position:relative;">
                <!-- Cercle central -->
                <div style="position:absolute;right:calc(50% - 22px);top:1.2rem;width:44px;height:44px;background:var(--primary);border-radius:50%;border:4px solid #fff;box-shadow:0 0 0 3px var(--primary);z-index:2;display:flex;align-items:center;justify-content:center;">
                    <svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5" style="width:20px;height:20px"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01z"/></svg>
                </div>
                <div class="card" style="max-width:380px;border-radius:var(--radius-lg);padding:1.75rem;border:1px solid var(--border);">
                    <div style="display:inline-block;background:var(--primary);color:#fff;font-size:0.78rem;font-weight:700;letter-spacing:2px;padding:3px 12px;border-radius:20px;margin-bottom:0.75rem;">2022</div>
                    <h3 style="margin-bottom:0.75rem;">Naissance d'un rêve</h3>
                    <p style="font-size:0.9rem;">
                        L'ONG EVA Autisme est officiellement créée et enregistrée sous le <strong>N°2022/044/DEP-ATL/SG/SAG-ASSOC</strong> du 30 mai 2022 à Abomey-Calavi. Face au manque criant de ressources pour les enfants autistes au Bénin, des femmes et hommes décident d'agir.
                    </p>
                </div>
            </div>

            <!-- Étape 2 – 2022-2023 Premières actions -->
            <div class="reveal timeline-right" style="display:flex;justify-content:flex-start;padding-left:calc(50% + 2.5rem);margin-bottom:3.5rem;position:relative;">
                <!-- Cercle central -->
                <div style="position:absolute;left:calc(50% - 22px);top:1.2rem;width:44px;height:44px;background:var(--accent);border-radius:50%;border:4px solid #fff;box-shadow:0 0 0 3px var(--accent);z-index:2;display:flex;align-items:center;justify-content:center;">
                    <svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5" style="width:20px;height:20px"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                </div>
                <div class="card" style="max-width:380px;border-radius:var(--radius-lg);padding:1.75rem;border:1px solid var(--border);">
                    <div style="display:inline-block;background:var(--accent);color:#fff;font-size:0.78rem;font-weight:700;letter-spacing:2px;padding:3px 12px;border-radius:20px;margin-bottom:0.75rem;">2022 – 2023</div>
                    <h3 style="margin-bottom:0.75rem;">Premières actions de terrain</h3>
                    <p style="font-size:0.9rem;">
                        Début des actions de sensibilisation sur le terrain. Rencontres avec les familles, identification des besoins réels, écoute et recueil des témoignages. Les bases d'une démarche inclusive et humaine se construisent.
                    </p>
                </div>
            </div>

            <!-- Étape 3 – 2023 Club Parents -->
            <div class="reveal timeline-left" style="display:flex;justify-content:flex-end;padding-right:calc(50% + 2.5rem);margin-bottom:3.5rem;position:relative;">
                <div style="position:absolute;right:calc(50% - 22px);top:1.2rem;width:44px;height:44px;background:var(--primary);border-radius:50%;border:4px solid #fff;box-shadow:0 0 0 3px var(--primary);z-index:2;display:flex;align-items:center;justify-content:center;">
                    <svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5" style="width:20px;height:20px"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                </div>
                <div class="card" style="max-width:380px;border-radius:var(--radius-lg);padding:1.75rem;border:1px solid var(--border);">
                    <div style="display:inline-block;background:var(--primary);color:#fff;font-size:0.78rem;font-weight:700;letter-spacing:2px;padding:3px 12px;border-radius:20px;margin-bottom:0.75rem;">2023</div>
                    <h3 style="margin-bottom:0.75rem;">Club Parents & Premières formations</h3>
                    <p style="font-size:0.9rem;">
                        Développement du Club Parents, premier espace de solidarité et d'échange entre familles. Lancement des premières formations sur les Troubles du Spectre de l'Autisme (TSA) destinées aux parents et enseignants.
                    </p>
                </div>
            </div>

            <!-- Étape 4 – 2024 Extension -->
            <div class="reveal timeline-right" style="display:flex;justify-content:flex-start;padding-left:calc(50% + 2.5rem);margin-bottom:3.5rem;position:relative;">
                <div style="position:absolute;left:calc(50% - 22px);top:1.2rem;width:44px;height:44px;background:var(--accent);border-radius:50%;border:4px solid #fff;box-shadow:0 0 0 3px var(--accent);z-index:2;display:flex;align-items:center;justify-content:center;">
                    <svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5" style="width:20px;height:20px"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/></svg>
                </div>
                <div class="card" style="max-width:380px;border-radius:var(--radius-lg);padding:1.75rem;border:1px solid var(--border);">
                    <div style="display:inline-block;background:var(--accent);color:#fff;font-size:0.78rem;font-weight:700;letter-spacing:2px;padding:3px 12px;border-radius:20px;margin-bottom:0.75rem;">2024</div>
                    <h3 style="margin-bottom:0.75rem;">Extension & Partenariats</h3>
                    <p style="font-size:0.9rem;">
                        Extension des activités de l'ONG, développement des partenariats institutionnels et associatifs, organisation d'événements de grande envergure. EVA Autisme gagne en visibilité et consolide son ancrage local.
                    </p>
                </div>
            </div>

            <!-- Étape 5 – 2025-2026 Consolidation -->
            <div class="reveal timeline-left" style="display:flex;justify-content:flex-end;padding-right:calc(50% + 2.5rem);margin-bottom:1rem;position:relative;">
                <div style="position:absolute;right:calc(50% - 22px);top:1.2rem;width:44px;height:44px;background:linear-gradient(135deg,var(--primary),var(--accent));border-radius:50%;border:4px solid #fff;box-shadow:0 0 0 3px var(--primary);z-index:2;display:flex;align-items:center;justify-content:center;">
                    <svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5" style="width:20px;height:20px"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                </div>
                <div class="card" style="max-width:380px;border-radius:var(--radius-lg);padding:1.75rem;border:2px solid var(--primary);background:var(--primary-light);">
                    <div style="display:inline-block;background:linear-gradient(135deg,var(--primary),var(--accent));color:#fff;font-size:0.78rem;font-weight:700;letter-spacing:2px;padding:3px 12px;border-radius:20px;margin-bottom:0.75rem;">2025 – 2026</div>
                    <h3 style="margin-bottom:0.75rem;">Consolidation & Nouveaux projets</h3>
                    <p style="font-size:0.9rem;">
                        Consolidation des acquis, lancement de nouveaux projets innovants au service des enfants autistes. EVA Autisme s'affirme comme une référence de l'inclusion au Bénin, avec une vision toujours plus ambitieuse pour demain.
                    </p>
                </div>
            </div>

        </div><!-- fin timeline -->
    </div>
</section>

<!-- ===================== CTA ===================== -->
<section style="background:linear-gradient(135deg,var(--primary) 0%,#0073e6 100%);padding:80px 0;color:#fff;">
    <div class="container" style="text-align:center;">
        <div class="reveal">
            <span style="display:inline-block;background:rgba(255,255,255,0.15);color:#fff;font-size:0.75rem;font-weight:700;letter-spacing:2px;text-transform:uppercase;padding:4px 14px;border-radius:30px;margin-bottom:1rem;">Écrivons l'histoire ensemble</span>
            <h2 style="color:#fff;margin-bottom:1rem;">Rejoignez EVA Autisme</h2>
            <p style="color:rgba(255,255,255,0.85);max-width:560px;margin:0 auto 2rem;">
                L'histoire d'EVA Autisme est loin d'être terminée. Chaque bénévole, chaque donateur, chaque partenaire en est l'un des auteurs.
            </p>
            <div style="display:flex;gap:1rem;justify-content:center;flex-wrap:wrap;">
                <a href="{{ route('about.impact') }}" class="btn btn-orange btn-lg">Notre Impact</a>
                <a href="{{ route('contact') }}" class="btn" style="background:rgba(255,255,255,0.15);color:#fff;border:2px solid rgba(255,255,255,0.5);font-size:1rem;padding:1rem 2.5rem;">
                    Nous Contacter
                </a>
            </div>
        </div>
    </div>
</section>

@endsection

@section('styles')
<style>
@media (max-width: 768px) {
    /* Mobile: timeline linéaire à gauche */
    .timeline-left, .timeline-right {
        padding-left: 3.5rem !important;
        padding-right: 0 !important;
        justify-content: flex-start !important;
    }
    /* Cacher la ligne centrale sur mobile */
    .timeline-left [style*="left:50%"],
    .timeline-right [style*="left:50%"] {
        left: 0 !important;
        right: auto !important;
        transform: none !important;
    }
    /* Repositionner les cercles à gauche */
    .timeline-left [style*="right:calc(50%"],
    .timeline-right [style*="left:calc(50%"],
    .timeline-left [style*="right:calc(50% - 22px)"],
    .timeline-right [style*="left:calc(50% - 22px)"] {
        left: 0 !important;
        right: auto !important;
    }
    /* Cacher l'élément invisible des étapes alternées */
    .timeline-left [style*="opacity:0"],
    .timeline-right [style*="opacity:0"] {
        display: none !important;
    }
    /* Cartes full width */
    .timeline-left .card,
    .timeline-right .card {
        max-width: 100% !important;
        text-align: left !important;
    }
    .timeline-left .card ul,
    .timeline-right .card ul {
        text-align: left !important;
    }
}
</style>
@endsection
