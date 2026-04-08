@extends('layouts.app')
@section('title', 'Politique de Confidentialité')
@section('meta_description', 'Politique de confidentialité et protection des données personnelles – ONG EVA Autisme Bénin.')

@section('content')

<!-- ===================== PAGE HEADER ===================== -->
<div class="page-header" style="background:linear-gradient(135deg,var(--primary-dark) 0%,var(--primary) 100%);padding:80px 0 60px;">
    <div class="container" style="text-align:center;">
        <span class="label" style="color:rgba(255,255,255,0.8);">Protection des données</span>
        <h1 style="color:#fff;font-size:clamp(2rem,4vw,3rem);margin-top:0.5rem;">Politique de Confidentialité</h1>
    </div>
</div>

<!-- ===================== CONTENU ===================== -->
<section class="section">
    <div class="container" style="max-width:860px;">
        <div class="reveal" style="line-height:1.9;color:var(--text-mid);">

            <p style="background:var(--primary-light);border-left:4px solid var(--primary);padding:1rem 1.25rem;border-radius:0 var(--radius) var(--radius) 0;color:var(--primary-dark);font-size:0.9rem;">
                L'ONG EVA Autisme s'engage à protéger votre vie privée. Cette politique explique comment nous collectons, utilisons et protégeons vos données personnelles.
            </p>

            <h2 style="color:var(--primary);font-size:1.3rem;margin-bottom:0.5rem;margin-top:2.5rem;">1. Responsable du traitement</h2>
            <div class="section-divider" style="margin-left:0;margin-bottom:1.25rem;"></div>
            <p>Le responsable du traitement de vos données est :</p>
            <p><strong>ONG EVA Autisme</strong><br>
            Abomey-Calavi, Bénin<br>
            Email : <a href="mailto:infos@eva-autisme.org" style="color:var(--primary);">infos@eva-autisme.org</a><br>
            Tél : +229 01 95 17 38 38</p>

            <h2 style="color:var(--primary);font-size:1.3rem;margin-bottom:0.5rem;margin-top:2.5rem;">2. Données collectées</h2>
            <div class="section-divider" style="margin-left:0;margin-bottom:1.25rem;"></div>
            <p>Nous pouvons collecter les données suivantes :</p>
            <ul style="padding-left:1.5rem;display:flex;flex-direction:column;gap:0.5rem;margin-top:0.5rem;">
                <li><strong>Formulaire de contact :</strong> nom, prénom, email, téléphone, message</li>
                <li><strong>Newsletter :</strong> adresse email</li>
                <li><strong>Club Parents :</strong> nom, prénom, email, téléphone, informations sur votre enfant (uniquement ce que vous fournissez)</li>
                <li><strong>Dons :</strong> nom, email, montant (les données bancaires sont traitées par un prestataire sécurisé)</li>
                <li><strong>Données de navigation :</strong> adresse IP, type de navigateur (via cookies analytiques, si activés)</li>
            </ul>

            <h2 style="color:var(--primary);font-size:1.3rem;margin-bottom:0.5rem;margin-top:2.5rem;">3. Finalités du traitement</h2>
            <div class="section-divider" style="margin-left:0;margin-bottom:1.25rem;"></div>
            <p>Vos données sont utilisées pour :</p>
            <ul style="padding-left:1.5rem;display:flex;flex-direction:column;gap:0.5rem;margin-top:0.5rem;">
                <li>Répondre à vos demandes de contact</li>
                <li>Vous envoyer notre newsletter (avec votre consentement)</li>
                <li>Gérer votre adhésion au Club Parents</li>
                <li>Traiter vos dons et vous envoyer un reçu</li>
                <li>Améliorer notre site web</li>
            </ul>

            <h2 style="color:var(--primary);font-size:1.3rem;margin-bottom:0.5rem;margin-top:2.5rem;">4. Base légale</h2>
            <div class="section-divider" style="margin-left:0;margin-bottom:1.25rem;"></div>
            <p>Le traitement de vos données est basé sur :</p>
            <ul style="padding-left:1.5rem;display:flex;flex-direction:column;gap:0.5rem;margin-top:0.5rem;">
                <li><strong>Votre consentement</strong> (newsletter, cookies analytiques)</li>
                <li><strong>L'exécution d'un contrat</strong> (traitement des dons)</li>
                <li><strong>Notre intérêt légitime</strong> (amélioration du service, suivi des contacts)</li>
            </ul>

            <h2 style="color:var(--primary);font-size:1.3rem;margin-bottom:0.5rem;margin-top:2.5rem;">5. Conservation des données</h2>
            <div class="section-divider" style="margin-left:0;margin-bottom:1.25rem;"></div>
            <p>Vos données sont conservées pendant la durée nécessaire à la finalité pour laquelle elles ont été collectées :</p>
            <ul style="padding-left:1.5rem;display:flex;flex-direction:column;gap:0.5rem;margin-top:0.5rem;">
                <li>Données de contact : 3 ans après le dernier contact</li>
                <li>Newsletter : jusqu'à désinscription</li>
                <li>Dons : 10 ans (obligation légale comptable)</li>
            </ul>

            <h2 style="color:var(--primary);font-size:1.3rem;margin-bottom:0.5rem;margin-top:2.5rem;">6. Partage des données</h2>
            <div class="section-divider" style="margin-left:0;margin-bottom:1.25rem;"></div>
            <p>L'ONG EVA Autisme ne vend ni ne loue vos données personnelles à des tiers. Vos données peuvent être partagées uniquement avec :</p>
            <ul style="padding-left:1.5rem;display:flex;flex-direction:column;gap:0.5rem;margin-top:0.5rem;">
                <li>Nos prestataires techniques (hébergement, paiement sécurisé) dans le cadre strict de leurs missions</li>
                <li>Les autorités compétentes, si la loi l'exige</li>
            </ul>

            <h2 style="color:var(--primary);font-size:1.3rem;margin-bottom:0.5rem;margin-top:2.5rem;">7. Vos droits</h2>
            <div class="section-divider" style="margin-left:0;margin-bottom:1.25rem;"></div>
            <p>Conformément aux réglementations en vigueur, vous disposez des droits suivants :</p>
            <ul style="padding-left:1.5rem;display:flex;flex-direction:column;gap:0.5rem;margin-top:0.5rem;">
                <li><strong>Droit d'accès</strong> : obtenir une copie de vos données</li>
                <li><strong>Droit de rectification</strong> : corriger des données inexactes</li>
                <li><strong>Droit à l'effacement</strong> : demander la suppression de vos données</li>
                <li><strong>Droit d'opposition</strong> : s'opposer à un traitement</li>
                <li><strong>Droit à la portabilité</strong> : recevoir vos données dans un format structuré</li>
                <li><strong>Retrait du consentement</strong> : vous désinscrire de la newsletter à tout moment</li>
            </ul>
            <p style="margin-top:1rem;">Pour exercer ces droits, contactez-nous à : <a href="mailto:infos@eva-autisme.org" style="color:var(--primary);font-weight:600;">infos@eva-autisme.org</a></p>

            <h2 style="color:var(--primary);font-size:1.3rem;margin-bottom:0.5rem;margin-top:2.5rem;">8. Cookies</h2>
            <div class="section-divider" style="margin-left:0;margin-bottom:1.25rem;"></div>
            <p>Ce site peut utiliser des cookies techniques nécessaires à son fonctionnement. Aucun cookie de tracking commercial n'est utilisé sans votre consentement préalable.</p>

            <h2 style="color:var(--primary);font-size:1.3rem;margin-bottom:0.5rem;margin-top:2.5rem;">9. Sécurité</h2>
            <div class="section-divider" style="margin-left:0;margin-bottom:1.25rem;"></div>
            <p>L'ONG EVA Autisme met en œuvre des mesures techniques et organisationnelles appropriées pour protéger vos données contre tout accès non autorisé, perte ou divulgation.</p>

            <h2 style="color:var(--primary);font-size:1.3rem;margin-bottom:0.5rem;margin-top:2.5rem;">10. Modifications</h2>
            <div class="section-divider" style="margin-left:0;margin-bottom:1.25rem;"></div>
            <p>Cette politique peut être mise à jour. Toute modification sera publiée sur cette page avec la date de mise à jour. Nous vous encourageons à la consulter régulièrement.</p>

            <p style="margin-top:3rem;font-size:0.85rem;color:var(--text-light);border-top:1px solid var(--border);padding-top:1.5rem;">
                Dernière mise à jour : Avril 2026 · <a href="{{ route('mentions-legales') }}" style="color:var(--primary);">Voir les Mentions légales</a>
            </p>
        </div>
    </div>
</section>

@endsection
