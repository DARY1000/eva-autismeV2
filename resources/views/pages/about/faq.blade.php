@extends('layouts.app')

@section('title', 'FAQ')
@section('meta_description', 'Foire aux questions sur l\'autisme, les TSA et les actions d\'EVA Autisme au Bénin. Trouvez des réponses claires sur le diagnostic, les thérapies et comment nous contacter.')

@section('content')

<!-- ===================== PAGE HEADER ===================== -->
<section class="page-header">
    <div class="container">
        <h1>Questions Fréquentes</h1>
        <nav class="breadcrumb" aria-label="Fil d'Ariane">
            <a href="{{ route('home') }}">Accueil</a>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
            <a href="{{ route('about.qui-sommes-nous') }}">À Propos</a>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
            <span>FAQ</span>
        </nav>
    </div>
</section>

<!-- ===================== INTRO ===================== -->
<section class="section bg-light" style="padding-bottom:0;">
    <div class="container">
        <div class="section-header reveal">
            <span class="label">Vos questions, nos réponses</span>
            <h2>Foire Aux Questions</h2>
            <div class="section-divider"></div>
            <p>Vous avez des questions sur l'autisme, les TSA ou sur les actions d'EVA Autisme ? Retrouvez ici les réponses aux questions les plus fréquemment posées.</p>
        </div>
    </div>
</section>

<!-- ===================== FAQ ACCORDION ===================== -->
<section class="section" style="padding-top:3rem;">
    <div class="container">
        <div style="max-width:860px;margin:0 auto;">

            <!-- Catégorie : Comprendre l'Autisme -->
            <div class="reveal" style="margin-bottom:2rem;">
                <div style="display:flex;align-items:center;gap:0.75rem;margin-bottom:1.25rem;">
                    <div style="width:36px;height:36px;background:var(--primary);border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" style="width:18px;height:18px"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                    </div>
                    <h3 style="font-size:1.05rem;color:var(--primary);">Comprendre l'Autisme</h3>
                </div>

                <!-- Q1 -->
                <div class="accordion-item">
                    <button class="accordion-header" type="button" aria-expanded="false">
                        <span>Qu'est-ce que l'autisme ou le TSA ?</span>
                        <svg class="accordion-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"/></svg>
                    </button>
                    <div class="accordion-body">
                        <div class="accordion-body-inner">
                            <p>Le Trouble du Spectre de l'Autisme (TSA) est un trouble neurodéveloppemental caractérisé par des différences dans la communication sociale et des modes de comportement, d'intérêts ou d'activités restreints et répétitifs.</p>
                            <p style="margin-top:0.75rem;">Le terme "spectre" reflète la grande variabilité des symptômes et de leur intensité d'une personne à l'autre. Chaque enfant autiste est unique : certains sont non verbaux, d'autres très communicatifs ; certains nécessitent un soutien intensif, d'autres une aide minimale.</p>
                            <p style="margin-top:0.75rem;">L'autisme n'est pas une maladie à guérir, mais une façon différente d'être au monde qui, avec un bon accompagnement, permet à l'enfant de s'épanouir et de s'intégrer.</p>
                        </div>
                    </div>
                </div>

                <!-- Q2 -->
                <div class="accordion-item">
                    <button class="accordion-header" type="button" aria-expanded="false">
                        <span>Quels signes peuvent indiquer un TSA chez un enfant ?</span>
                        <svg class="accordion-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"/></svg>
                    </button>
                    <div class="accordion-body">
                        <div class="accordion-body-inner">
                            <p>Certains signes peuvent apparaître dès les premiers mois de vie. Voici les principaux signaux d'alerte :</p>
                            <ul style="margin-top:0.75rem;padding-left:1.5rem;list-style:disc;">
                                <li style="margin-bottom:0.4rem;">Absence ou retard du babillage, du pointage ou des gestes significatifs avant 12 mois</li>
                                <li style="margin-bottom:0.4rem;">Absence de mots isolés avant 16 mois</li>
                                <li style="margin-bottom:0.4rem;">Absence de phrases de deux mots avant 24 mois</li>
                                <li style="margin-bottom:0.4rem;">Perte de langage ou de compétences sociales à tout âge</li>
                                <li style="margin-bottom:0.4rem;">Peu de contact visuel, difficultés à interagir avec les autres enfants</li>
                                <li style="margin-bottom:0.4rem;">Comportements répétitifs (balancement, alignement d'objets, routines rigides)</li>
                                <li style="margin-bottom:0.4rem;">Sensibilités sensorielles atypiques (sons, textures, lumières)</li>
                            </ul>
                            <p style="margin-top:0.75rem;font-style:italic;color:var(--text-light);">Si vous observez plusieurs de ces signes, contactez EVA Autisme pour une orientation vers un professionnel.</p>
                        </div>
                    </div>
                </div>

                <!-- Q3 -->
                <div class="accordion-item">
                    <button class="accordion-header" type="button" aria-expanded="false">
                        <span>L'autisme est-il guérissable ?</span>
                        <svg class="accordion-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"/></svg>
                    </button>
                    <div class="accordion-body">
                        <div class="accordion-body-inner">
                            <p>L'autisme n'est pas une maladie au sens médical du terme et n'a donc pas de "guérison". C'est une différence neurologique qui fait partie intégrante de la personne.</p>
                            <p style="margin-top:0.75rem;">En revanche, avec un accompagnement adapté, précoce et individualisé, les enfants autistes peuvent développer de nombreuses compétences, progresser dans leur communication et améliorer considérablement leur qualité de vie.</p>
                            <p style="margin-top:0.75rem;">L'objectif n'est pas de "changer" l'enfant autiste, mais de lui donner les outils pour exprimer son potentiel et s'épanouir à sa manière dans la société.</p>
                        </div>
                    </div>
                </div>

                <!-- Q4 -->
                <div class="accordion-item">
                    <button class="accordion-header" type="button" aria-expanded="false">
                        <span>Quelles thérapies et méthodes existent pour accompagner un enfant autiste ?</span>
                        <svg class="accordion-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"/></svg>
                    </button>
                    <div class="accordion-body">
                        <div class="accordion-body-inner">
                            <p>Plusieurs approches validées scientifiquement sont utilisées dans le monde pour accompagner les enfants autistes :</p>
                            <ul style="margin-top:0.75rem;padding-left:1.5rem;list-style:disc;">
                                <li style="margin-bottom:0.5rem;"><strong>ABA (Analyse du Comportement Appliquée)</strong> : Renforcement positif pour développer les compétences</li>
                                <li style="margin-bottom:0.5rem;"><strong>PECS</strong> : Communication par échange d'images pour les enfants peu verbaux</li>
                                <li style="margin-bottom:0.5rem;"><strong>TEACCH</strong> : Structuration de l'environnement pour favoriser l'autonomie</li>
                                <li style="margin-bottom:0.5rem;"><strong>Intégration sensorielle</strong> : Travail sur les sensibilités sensorielles</li>
                                <li style="margin-bottom:0.5rem;"><strong>Orthophonie</strong> : Développement du langage et de la communication</li>
                                <li style="margin-bottom:0.5rem;"><strong>Psychomotricité</strong> : Coordination et intégration corporelle</li>
                            </ul>
                            <p style="margin-top:0.75rem;">EVA Autisme vous oriente vers les professionnels et ressources adaptées à la situation de votre enfant.</p>
                        </div>
                    </div>
                </div>

                <!-- Q5 -->
                <div class="accordion-item">
                    <button class="accordion-header" type="button" aria-expanded="false">
                        <span>Comment aider un enfant autiste au quotidien à la maison ?</span>
                        <svg class="accordion-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"/></svg>
                    </button>
                    <div class="accordion-body">
                        <div class="accordion-body-inner">
                            <p>Voici quelques conseils pratiques pour accompagner votre enfant autiste à la maison :</p>
                            <ul style="margin-top:0.75rem;padding-left:1.5rem;list-style:disc;">
                                <li style="margin-bottom:0.4rem;"><strong>Maintenir une routine stable</strong> : Les enfants autistes s'épanouissent mieux avec des horaires prévisibles</li>
                                <li style="margin-bottom:0.4rem;"><strong>Utiliser des supports visuels</strong> : Images, pictogrammes pour communiquer et structurer la journée</li>
                                <li style="margin-bottom:0.4rem;"><strong>Créer un environnement calme</strong> : Réduire les stimulations sensorielles excessives</li>
                                <li style="margin-bottom:0.4rem;"><strong>Valoriser les intérêts de l'enfant</strong> : S'appuyer sur ses centres d'intérêt pour l'apprentissage</li>
                                <li style="margin-bottom:0.4rem;"><strong>Communiquer simplement</strong> : Phrases courtes, claires et positives</li>
                                <li style="margin-bottom:0.4rem;"><strong>Se former</strong> : Participer aux formations d'EVA Autisme pour mieux comprendre votre enfant</li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Catégorie : EVA Autisme -->
            <div class="reveal" style="margin-bottom:2rem;">
                <div style="display:flex;align-items:center;gap:0.75rem;margin-bottom:1.25rem;">
                    <div style="width:36px;height:36px;background:var(--accent);border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" style="width:18px;height:18px"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
                    </div>
                    <h3 style="font-size:1.05rem;color:var(--accent);">EVA Autisme & Nos Services</h3>
                </div>

                <!-- Q6 -->
                <div class="accordion-item">
                    <button class="accordion-header" type="button" aria-expanded="false">
                        <span>Comment EVA Autisme peut-il nous aider ?</span>
                        <svg class="accordion-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"/></svg>
                    </button>
                    <div class="accordion-body">
                        <div class="accordion-body-inner">
                            <p>EVA Autisme offre plusieurs types d'accompagnement aux familles béninoises :</p>
                            <ul style="margin-top:0.75rem;padding-left:1.5rem;list-style:disc;">
                                <li style="margin-bottom:0.4rem;"><strong>Écoute et orientation</strong> : Premier accueil, évaluation des besoins et orientation vers des spécialistes</li>
                                <li style="margin-bottom:0.4rem;"><strong>Club Parents</strong> : Espace d'échange et de soutien mutuel entre parents d'enfants autistes</li>
                                <li style="margin-bottom:0.4rem;"><strong>Formations</strong> : Sessions pour les parents, enseignants et professionnels sur les TSA</li>
                                <li style="margin-bottom:0.4rem;"><strong>Événements de sensibilisation</strong> : Journées, conférences et ateliers ouverts au public</li>
                                <li style="margin-bottom:0.4rem;"><strong>Ressources documentaires</strong> : Publications et guides pratiques sur l'autisme</li>
                            </ul>
                            <p style="margin-top:0.75rem;">Tous nos services sont gratuits pour les familles dans le besoin.</p>
                        </div>
                    </div>
                </div>

                <!-- Q7 -->
                <div class="accordion-item">
                    <button class="accordion-header" type="button" aria-expanded="false">
                        <span>Comment nous contacter pour obtenir de l'aide ?</span>
                        <svg class="accordion-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"/></svg>
                    </button>
                    <div class="accordion-body">
                        <div class="accordion-body-inner">
                            <p>Vous pouvez nous contacter de plusieurs façons :</p>
                            <ul style="margin-top:0.75rem;padding-left:1.5rem;list-style:disc;">
                                <li style="margin-bottom:0.4rem;"><strong>Par téléphone ou WhatsApp</strong> : <a href="tel:+22901951738038" style="color:var(--primary);font-weight:600;">+229 01 95 17 38 38</a></li>
                                <li style="margin-bottom:0.4rem;"><strong>Par email</strong> : <a href="mailto:infos@eva-autisme.org" style="color:var(--primary);font-weight:600;">infos@eva-autisme.org</a></li>
                                <li style="margin-bottom:0.4rem;"><strong>Via notre formulaire de contact</strong> : <a href="{{ route('contact') }}" style="color:var(--primary);font-weight:600;">Page de contact</a></li>
                                <li style="margin-bottom:0.4rem;"><strong>Sur nos réseaux sociaux</strong> : Facebook, Instagram</li>
                            </ul>
                            <p style="margin-top:0.75rem;">Nous nous efforçons de répondre à toutes les demandes dans les 48 heures.</p>
                        </div>
                    </div>
                </div>

                <!-- Q8 -->
                <div class="accordion-item">
                    <button class="accordion-header" type="button" aria-expanded="false">
                        <span>Comment faire un don à EVA Autisme ?</span>
                        <svg class="accordion-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"/></svg>
                    </button>
                    <div class="accordion-body">
                        <div class="accordion-body-inner">
                            <p>Vous pouvez soutenir EVA Autisme de différentes manières :</p>
                            <ul style="margin-top:0.75rem;padding-left:1.5rem;list-style:disc;">
                                <li style="margin-bottom:0.4rem;"><strong>Don financier en ligne</strong> : Via notre page de don sécurisée</li>
                                <li style="margin-bottom:0.4rem;"><strong>Don en nature</strong> : Matériel pédagogique, équipements thérapeutiques</li>
                                <li style="margin-bottom:0.4rem;"><strong>Parrainage</strong> : Soutien régulier d'un enfant ou d'un programme spécifique</li>
                                <li style="margin-bottom:0.4rem;"><strong>Partenariat entreprise</strong> : Responsabilité Sociale des Entreprises (RSE)</li>
                            </ul>
                            <p style="margin-top:0.75rem;">Tous les dons sont tracés et utilisés uniquement pour nos programmes d'accompagnement. Nous envoyons un reçu à chaque donateur.</p>
                            <div style="margin-top:1rem;">
                                <a href="{{ route('don') }}" style="display:inline-flex;align-items:center;gap:6px;background:var(--accent);color:#fff;padding:0.6rem 1.25rem;border-radius:30px;font-weight:700;font-size:0.88rem;">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:16px;height:16px"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
                                    Faire un Don maintenant
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Q9 -->
                <div class="accordion-item">
                    <button class="accordion-header" type="button" aria-expanded="false">
                        <span>Comment devenir bénévole chez EVA Autisme ?</span>
                        <svg class="accordion-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"/></svg>
                    </button>
                    <div class="accordion-body">
                        <div class="accordion-body-inner">
                            <p>Nous sommes toujours à la recherche de bénévoles motivés ! Plusieurs profils sont les bienvenus :</p>
                            <ul style="margin-top:0.75rem;padding-left:1.5rem;list-style:disc;">
                                <li style="margin-bottom:0.4rem;"><strong>Professionnels de santé</strong> : Médecins, orthophonistes, psychologues, psychomotriciens</li>
                                <li style="margin-bottom:0.4rem;"><strong>Enseignants</strong> : Pour les formations et ateliers éducatifs</li>
                                <li style="margin-bottom:0.4rem;"><strong>Communicants & créatifs</strong> : Graphistes, photographes, vidéastes, journalistes</li>
                                <li style="margin-bottom:0.4rem;"><strong>Administratifs & juridiques</strong> : Comptables, juristes, gestionnaires</li>
                                <li style="margin-bottom:0.4rem;"><strong>Tout citoyen engagé</strong> : Pour les événements et actions de terrain</li>
                            </ul>
                            <p style="margin-top:0.75rem;">Pour postuler, remplissez notre formulaire de contact en précisant vos compétences et disponibilités.</p>
                        </div>
                    </div>
                </div>

                <!-- Q10 -->
                <div class="accordion-item">
                    <button class="accordion-header" type="button" aria-expanded="false">
                        <span>Comment participer à vos événements ?</span>
                        <svg class="accordion-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"/></svg>
                    </button>
                    <div class="accordion-body">
                        <div class="accordion-body-inner">
                            <p>Nos événements sont généralement ouverts à tous. Pour participer :</p>
                            <ul style="margin-top:0.75rem;padding-left:1.5rem;list-style:disc;">
                                <li style="margin-bottom:0.4rem;"><strong>Consultez notre calendrier</strong> : Page <a href="{{ route('actions.evenements') }}" style="color:var(--primary);font-weight:600;">Nos Événements</a> pour voir les prochaines dates</li>
                                <li style="margin-bottom:0.4rem;"><strong>Inscrivez-vous</strong> : Certains événements nécessitent une inscription préalable via le formulaire en ligne</li>
                                <li style="margin-bottom:0.4rem;"><strong>Suivez-nous sur les réseaux</strong> : Facebook et Instagram pour les annonces en temps réel</li>
                                <li style="margin-bottom:0.4rem;"><strong>Abonnez-vous à notre newsletter</strong> : Pour recevoir toutes nos actualités directement par email</li>
                            </ul>
                            <p style="margin-top:0.75rem;">La plupart de nos événements sont gratuits et ouverts au grand public. Nous accueillons aussi bien les professionnels que les familles et les simples curieux.</p>
                        </div>
                    </div>
                </div>

            </div>

        </div><!-- fin max-width -->
    </div>
</section>

<!-- ===================== CONTACT RAPIDE ===================== -->
<section class="section bg-light">
    <div class="container">
        <div style="max-width:860px;margin:0 auto;">
            <div class="section-header reveal" style="margin-bottom:2.5rem;">
                <span class="label">Vous n'avez pas trouvé votre réponse ?</span>
                <h2>Contactez-nous directement</h2>
                <div class="section-divider"></div>
                <p>Notre équipe est disponible pour répondre à toutes vos questions sur l'autisme et les services d'EVA Autisme.</p>
            </div>

            <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(240px,1fr));gap:1.5rem;">

                <!-- Téléphone -->
                <div class="card reveal" style="border-radius:var(--radius-lg);padding:1.75rem;text-align:center;border:1px solid var(--border);">
                    <div style="width:56px;height:56px;background:var(--primary-light);border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 1rem;">
                        <svg viewBox="0 0 24 24" fill="none" stroke="var(--primary)" stroke-width="2" style="width:24px;height:24px"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12 19.79 19.79 0 0 1 1.61 3.37 2 2 0 0 1 3.6 1h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L7.91 8.6a16 16 0 0 0 6 6l.96-.96a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                    </div>
                    <h4 style="margin-bottom:0.5rem;">Téléphone / WhatsApp</h4>
                    <a href="tel:+22901951738038" style="color:var(--primary);font-weight:700;font-size:1rem;">+229 01 95 17 38 38</a>
                    <p style="font-size:0.82rem;color:var(--text-light);margin-top:0.5rem;">Lun – Ven : 8h – 18h</p>
                </div>

                <!-- Email -->
                <div class="card reveal" style="border-radius:var(--radius-lg);padding:1.75rem;text-align:center;border:1px solid var(--border);">
                    <div style="width:56px;height:56px;background:var(--primary-light);border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 1rem;">
                        <svg viewBox="0 0 24 24" fill="none" stroke="var(--primary)" stroke-width="2" style="width:24px;height:24px"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                    </div>
                    <h4 style="margin-bottom:0.5rem;">Email</h4>
                    <a href="mailto:infos@eva-autisme.org" style="color:var(--primary);font-weight:700;font-size:0.95rem;">infos@eva-autisme.org</a>
                    <p style="font-size:0.82rem;color:var(--text-light);margin-top:0.5rem;">Réponse sous 48h</p>
                </div>

                <!-- Formulaire -->
                <div class="card reveal" style="border-radius:var(--radius-lg);padding:1.75rem;text-align:center;border:1px solid var(--border);">
                    <div style="width:56px;height:56px;background:var(--primary-light);border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 1rem;">
                        <svg viewBox="0 0 24 24" fill="none" stroke="var(--primary)" stroke-width="2" style="width:24px;height:24px"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
                    </div>
                    <h4 style="margin-bottom:0.5rem;">Formulaire en ligne</h4>
                    <p style="font-size:0.85rem;color:var(--text-mid);margin-bottom:1rem;">Décrivez votre situation en détail</p>
                    <a href="{{ route('contact') }}" class="btn btn-blue" style="display:inline-flex;">Accéder au formulaire</a>
                </div>


            </div>

            <div style="text-align:center;margin-top:2.5rem;" class="reveal">
                <a href="{{ route('contact') }}" class="btn btn-blue btn-lg">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:18px;height:18px"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                    Nous écrire
                </a>
            </div>
        </div>
    </div>
</section>

@endsection

