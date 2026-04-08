@extends('layouts.app')
@section('title', 'Mentions Légales')
@section('meta_description', 'Mentions légales de l\'ONG EVA Autisme – Bénin.')

@section('content')

<!-- ===================== PAGE HEADER ===================== -->
<div class="page-header" style="background:linear-gradient(135deg,var(--primary-dark) 0%,var(--primary) 100%);padding:80px 0 60px;">
    <div class="container" style="text-align:center;">
        <span class="label" style="color:rgba(255,255,255,0.8);">Informations légales</span>
        <h1 style="color:#fff;font-size:clamp(2rem,4vw,3rem);margin-top:0.5rem;">Mentions Légales</h1>
    </div>
</div>

<!-- ===================== CONTENU ===================== -->
<section class="section">
    <div class="container" style="max-width:860px;">
        <div class="reveal" style="line-height:1.9;color:var(--text-mid);">

            <h2 style="color:var(--primary);font-size:1.3rem;margin-bottom:0.5rem;margin-top:2rem;">1. Éditeur du site</h2>
            <div class="section-divider" style="margin-left:0;margin-bottom:1.25rem;"></div>
            <p><strong>Dénomination :</strong> ONG EVA Autisme – Espoir Vie Avec Autisme</p>
            <p><strong>Numéro d'enregistrement :</strong> N° 2022/044/DEP-ATL/SG/SAG-ASSOC du 30 Mai 2022</p>
            <p><strong>Siège social :</strong> Abomey-Calavi, département de l'Atlantique, Bénin</p>
            <p><strong>Téléphone :</strong> +229 01 95 17 38 38</p>
            <p><strong>Email :</strong> <a href="mailto:infos@eva-autisme.org" style="color:var(--primary);">infos@eva-autisme.org</a></p>
            <p><strong>Représentant légal :</strong> Présidente de l'ONG EVA Autisme</p>

            <h2 style="color:var(--primary);font-size:1.3rem;margin-bottom:0.5rem;margin-top:2.5rem;">2. Hébergement</h2>
            <div class="section-divider" style="margin-left:0;margin-bottom:1.25rem;"></div>
            <p>Ce site est hébergé par un prestataire dont les coordonnées sont disponibles sur demande à l'adresse <a href="mailto:infos@eva-autisme.org" style="color:var(--primary);">infos@eva-autisme.org</a>.</p>

            <h2 style="color:var(--primary);font-size:1.3rem;margin-bottom:0.5rem;margin-top:2.5rem;">3. Propriété intellectuelle</h2>
            <div class="section-divider" style="margin-left:0;margin-bottom:1.25rem;"></div>
            <p>L'ensemble du contenu de ce site (textes, images, logos, icônes, vidéos, documents) est la propriété exclusive de l'ONG EVA Autisme, sauf mention contraire. Toute reproduction, représentation, modification, publication ou transmission, totale ou partielle, du contenu de ce site est interdite sans l'autorisation écrite préalable de l'ONG EVA Autisme.</p>

            <h2 style="color:var(--primary);font-size:1.3rem;margin-bottom:0.5rem;margin-top:2.5rem;">4. Responsabilité</h2>
            <div class="section-divider" style="margin-left:0;margin-bottom:1.25rem;"></div>
            <p>L'ONG EVA Autisme s'efforce d'assurer l'exactitude et la mise à jour des informations diffusées sur ce site. Cependant, elle ne peut garantir l'exactitude, la précision ou l'exhaustivité des informations mises à disposition. En conséquence, l'utilisateur reconnaît utiliser ces informations sous sa responsabilité exclusive.</p>
            <p>L'ONG EVA Autisme ne saurait être tenue responsable des dommages directs ou indirects résultant de l'utilisation de ce site ou de l'impossibilité d'y accéder.</p>

            <h2 style="color:var(--primary);font-size:1.3rem;margin-bottom:0.5rem;margin-top:2.5rem;">5. Liens hypertextes</h2>
            <div class="section-divider" style="margin-left:0;margin-bottom:1.25rem;"></div>
            <p>Ce site peut contenir des liens vers d'autres sites web. L'ONG EVA Autisme n'est pas responsable du contenu de ces sites externes et décline toute responsabilité quant aux informations qui y sont présentées.</p>

            <h2 style="color:var(--primary);font-size:1.3rem;margin-bottom:0.5rem;margin-top:2.5rem;">6. Données personnelles</h2>
            <div class="section-divider" style="margin-left:0;margin-bottom:1.25rem;"></div>
            <p>La collecte et le traitement de vos données personnelles sont régis par notre <a href="{{ route('politique-confidentialite') }}" style="color:var(--primary);font-weight:600;">Politique de Confidentialité</a>.</p>

            <h2 style="color:var(--primary);font-size:1.3rem;margin-bottom:0.5rem;margin-top:2.5rem;">7. Contact</h2>
            <div class="section-divider" style="margin-left:0;margin-bottom:1.25rem;"></div>
            <p>Pour toute question relative aux présentes mentions légales, vous pouvez nous contacter à :</p>
            <p><strong>Email :</strong> <a href="mailto:infos@eva-autisme.org" style="color:var(--primary);">infos@eva-autisme.org</a><br>
            <strong>Adresse :</strong> ONG EVA Autisme, Abomey-Calavi, Bénin</p>

            <p style="margin-top:3rem;font-size:0.85rem;color:var(--text-light);border-top:1px solid var(--border);padding-top:1.5rem;">
                Dernière mise à jour : Mai 2022
            </p>
        </div>
    </div>
</section>

@endsection
