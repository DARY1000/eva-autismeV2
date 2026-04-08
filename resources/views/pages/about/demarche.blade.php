@extends('layouts.app')

@section('title', 'Notre Démarche')
@section('meta_description', 'Découvrez la démarche d\'EVA Autisme : accueil, évaluation, orientation et suivi des enfants autistes et de leurs familles au Bénin.')

@section('content')

<!-- ===================== PAGE HEADER ===================== -->
<section class="page-header">
    <div class="container">
        <h1>Notre Démarche</h1>
        <nav class="breadcrumb" aria-label="Fil d'Ariane">
            <a href="{{ route('home') }}">Accueil</a>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
            <a href="{{ route('about.qui-sommes-nous') }}">À Propos</a>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
            <span>Notre Démarche</span>
        </nav>
    </div>
</section>

<!-- ===================== INTRO ===================== -->
<section class="section bg-light">
    <div class="container">
        <div class="section-header reveal" style="max-width:750px;margin:0 auto 3rem;">
            <span class="label">Notre approche</span>
            <h2>Une démarche centrée<br>sur la personne et la famille</h2>
            <div class="section-divider"></div>
            <p style="margin-top:1rem;">
                Chez EVA Autisme, nous croyons qu'une intervention efficace commence par l'écoute. Notre démarche est structurée, humaine et adaptée à chaque famille, en tenant compte des réalités socioéconomiques du Bénin.
            </p>
        </div>
    </div>
</section>

<!-- ===================== LES 4 ÉTAPES ===================== -->
<section class="section">
    <div class="container">
        <div class="section-header reveal">
            <span class="label">Notre processus</span>
            <h2>Les 4 Étapes de Notre Accompagnement</h2>
            <div class="section-divider"></div>
        </div>

        <div style="margin-top:3.5rem;display:flex;flex-direction:column;gap:0;">

            <!-- Étape 1 -->
            <div class="reveal" style="display:grid;grid-template-columns:1fr 80px 1fr;gap:0;align-items:center;margin-bottom:0;">
                <div style="padding:2.5rem;background:#fff;border-radius:var(--radius-lg) 0 0 var(--radius-lg);border:1px solid var(--border);border-right:none;text-align:right;">
                    <div style="display:inline-block;background:var(--primary-light);color:var(--primary);font-size:0.75rem;font-weight:700;letter-spacing:2px;padding:3px 12px;border-radius:20px;margin-bottom:0.75rem;">ÉTAPE 1</div>
                    <h3 style="margin-bottom:0.75rem;">Accueil & Écoute</h3>
                    <p style="font-size:0.92rem;">
                        Toute démarche commence par un accueil chaleureux et sans jugement. Nos équipes reçoivent les familles, écoutent leurs préoccupations et créent un espace de confiance. L'objectif : comprendre la situation avant tout.
                    </p>
                    <ul style="margin-top:1rem;list-style:none;padding:0;text-align:right;">
                        <li style="font-size:0.83rem;color:var(--text-mid);margin-bottom:0.3rem;">Premier contact téléphonique ou physique</li>
                        <li style="font-size:0.83rem;color:var(--text-mid);margin-bottom:0.3rem;">Écoute active et empathique</li>
                        <li style="font-size:0.83rem;color:var(--text-mid);">Recueil d'informations initiales</li>
                    </ul>
                </div>
                <!-- Cercle central -->
                <div style="display:flex;flex-direction:column;align-items:center;justify-content:center;padding:0.5rem 0;position:relative;">
                    <div style="width:64px;height:64px;background:var(--primary);border-radius:50%;display:flex;align-items:center;justify-content:center;z-index:2;box-shadow:0 0 0 6px var(--primary-light);">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" style="width:28px;height:28px"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                    </div>
                    <div style="position:absolute;top:100%;width:2px;height:2rem;background:var(--border);"></div>
                </div>
                <div style="padding:2.5rem;opacity:0;pointer-events:none;"></div>
            </div>

            <!-- Étape 2 -->
            <div class="reveal" style="display:grid;grid-template-columns:1fr 80px 1fr;gap:0;align-items:center;padding-top:2rem;">
                <div style="padding:2.5rem;opacity:0;pointer-events:none;"></div>
                <div style="display:flex;flex-direction:column;align-items:center;justify-content:center;padding:0.5rem 0;position:relative;">
                    <div style="position:absolute;bottom:100%;width:2px;height:2rem;background:var(--border);"></div>
                    <div style="width:64px;height:64px;background:var(--accent);border-radius:50%;display:flex;align-items:center;justify-content:center;z-index:2;box-shadow:0 0 0 6px #fff0ed;">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" style="width:28px;height:28px"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                    </div>
                    <div style="position:absolute;top:100%;width:2px;height:2rem;background:var(--border);"></div>
                </div>
                <div style="padding:2.5rem;background:#fff;border-radius:0 var(--radius-lg) var(--radius-lg) 0;border:1px solid var(--border);border-left:none;">
                    <div style="display:inline-block;background:#fff0ed;color:var(--accent);font-size:0.75rem;font-weight:700;letter-spacing:2px;padding:3px 12px;border-radius:20px;margin-bottom:0.75rem;">ÉTAPE 2</div>
                    <h3 style="margin-bottom:0.75rem;">Évaluation des Besoins</h3>
                    <p style="font-size:0.92rem;">
                        Une évaluation approfondie des besoins de l'enfant et de sa famille permet d'identifier les priorités d'intervention. Cette étape implique des entretiens, des observations et si possible des bilans avec des professionnels partenaires.
                    </p>
                    <ul style="margin-top:1rem;list-style:none;padding:0;">
                        <li style="font-size:0.83rem;color:var(--text-mid);margin-bottom:0.3rem;">Entretien approfondi avec la famille</li>
                        <li style="font-size:0.83rem;color:var(--text-mid);margin-bottom:0.3rem;">Observation du comportement de l'enfant</li>
                        <li style="font-size:0.83rem;color:var(--text-mid);">Identification des ressources disponibles</li>
                    </ul>
                </div>
            </div>

            <!-- Étape 3 -->
            <div class="reveal" style="display:grid;grid-template-columns:1fr 80px 1fr;gap:0;align-items:center;padding-top:2rem;">
                <div style="padding:2.5rem;background:#fff;border-radius:var(--radius-lg) 0 0 var(--radius-lg);border:1px solid var(--border);border-right:none;text-align:right;">
                    <div style="display:inline-block;background:var(--primary-light);color:var(--primary);font-size:0.75rem;font-weight:700;letter-spacing:2px;padding:3px 12px;border-radius:20px;margin-bottom:0.75rem;">ÉTAPE 3</div>
                    <h3 style="margin-bottom:0.75rem;">Orientation & Accompagnement</h3>
                    <p style="font-size:0.92rem;">
                        Sur la base de l'évaluation, nous orientons les familles vers des structures adaptées (orthophonistes, psychologues, établissements scolaires inclusifs) et les accompagnons dans leurs démarches pour éviter l'errance diagnostique.
                    </p>
                    <ul style="margin-top:1rem;list-style:none;padding:0;text-align:right;">
                        <li style="font-size:0.83rem;color:var(--text-mid);margin-bottom:0.3rem;">Mise en relation avec des spécialistes</li>
                        <li style="font-size:0.83rem;color:var(--text-mid);margin-bottom:0.3rem;">Orientation scolaire adaptée</li>
                        <li style="font-size:0.83rem;color:var(--text-mid);">Appui dans les démarches administratives</li>
                    </ul>
                </div>
                <div style="display:flex;flex-direction:column;align-items:center;justify-content:center;padding:0.5rem 0;position:relative;">
                    <div style="position:absolute;bottom:100%;width:2px;height:2rem;background:var(--border);"></div>
                    <div style="width:64px;height:64px;background:var(--primary);border-radius:50%;display:flex;align-items:center;justify-content:center;z-index:2;box-shadow:0 0 0 6px var(--primary-light);">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" style="width:28px;height:28px"><polyline points="9 11 12 14 22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
                    </div>
                    <div style="position:absolute;top:100%;width:2px;height:2rem;background:var(--border);"></div>
                </div>
                <div style="padding:2.5rem;opacity:0;pointer-events:none;"></div>
            </div>

            <!-- Étape 4 -->
            <div class="reveal" style="display:grid;grid-template-columns:1fr 80px 1fr;gap:0;align-items:center;padding-top:2rem;">
                <div style="padding:2.5rem;opacity:0;pointer-events:none;"></div>
                <div style="display:flex;align-items:center;justify-content:center;padding:0.5rem 0;position:relative;">
                    <div style="position:absolute;bottom:100%;width:2px;height:2rem;background:var(--border);"></div>
                    <div style="width:64px;height:64px;background:var(--accent);border-radius:50%;display:flex;align-items:center;justify-content:center;z-index:2;box-shadow:0 0 0 6px #fff0ed;">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" style="width:28px;height:28px"><path d="M12 2a10 10 0 1 0 10 10H12V2z"/><path d="M12 2a10 10 0 0 1 10 10"/></svg>
                    </div>
                </div>
                <div style="padding:2.5rem;background:#fff;border-radius:0 var(--radius-lg) var(--radius-lg) 0;border:1px solid var(--border);border-left:none;">
                    <div style="display:inline-block;background:#fff0ed;color:var(--accent);font-size:0.75rem;font-weight:700;letter-spacing:2px;padding:3px 12px;border-radius:20px;margin-bottom:0.75rem;">ÉTAPE 4</div>
                    <h3 style="margin-bottom:0.75rem;">Suivi & Ajustement</h3>
                    <p style="font-size:0.92rem;">
                        L'accompagnement ne s'arrête pas à l'orientation. Nous assurons un suivi régulier pour évaluer les progrès, ajuster le plan d'action si nécessaire et garantir que la famille reste soutenue dans la durée.
                    </p>
                    <ul style="margin-top:1rem;list-style:none;padding:0;">
                        <li style="font-size:0.83rem;color:var(--text-mid);margin-bottom:0.3rem;">Suivi téléphonique et rencontres régulières</li>
                        <li style="font-size:0.83rem;color:var(--text-mid);margin-bottom:0.3rem;">Évaluation des progrès de l'enfant</li>
                        <li style="font-size:0.83rem;color:var(--text-mid);">Ajustement des interventions selon les besoins</li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ===================== MÉTHODES D'INTERVENTION ===================== -->
<section class="section bg-light">
    <div class="container">
        <div class="section-header reveal">
            <span class="label">Approches thérapeutiques</span>
            <h2>Nos Méthodes d'Intervention</h2>
            <div class="section-divider"></div>
            <p>EVA Autisme promeut et oriente vers des méthodes validées scientifiquement et adaptées à chaque profil d'enfant autiste.</p>
        </div>

        <div class="grid-3" style="margin-top:2.5rem;display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:1.5rem;">

            <!-- ABA -->
            <div class="feature-card reveal">
                <div style="display:inline-flex;align-items:center;justify-content:center;width:50px;height:50px;background:var(--primary);border-radius:10px;margin-bottom:1rem;">
                    <span style="color:#fff;font-weight:800;font-size:1rem;">ABA</span>
                </div>
                <h3>Analyse du Comportement Appliquée</h3>
                <p style="font-size:0.88rem;">La méthode ABA (Applied Behavior Analysis) utilise des techniques de renforcement positif pour développer des comportements adaptés et réduire les comportements problématiques chez l'enfant autiste.</p>
                <div style="margin-top:1rem;padding:0.75rem;background:var(--primary-light);border-radius:var(--radius);font-size:0.8rem;color:var(--primary);">
                    <strong>Bénéfices :</strong> Développement du langage, autonomie, compétences sociales
                </div>
            </div>

            <!-- PECS -->
            <div class="feature-card reveal">
                <div style="display:inline-flex;align-items:center;justify-content:center;width:50px;height:50px;background:var(--accent);border-radius:10px;margin-bottom:1rem;">
                    <span style="color:#fff;font-weight:800;font-size:0.85rem;">PECS</span>
                </div>
                <h3>Système de Communication par Échange d'Images</h3>
                <p style="font-size:0.88rem;">Le PECS (Picture Exchange Communication System) permet aux enfants non verbaux ou peu verbaux de communiquer en utilisant des images, favorisant ainsi leur autonomie de communication.</p>
                <div style="margin-top:1rem;padding:0.75rem;background:#fff0ed;border-radius:var(--radius);font-size:0.8rem;color:var(--accent);">
                    <strong>Bénéfices :</strong> Communication fonctionnelle, réduction de la frustration
                </div>
            </div>

            <!-- TEACCH -->
            <div class="feature-card reveal">
                <div style="display:inline-flex;align-items:center;justify-content:center;width:50px;height:50px;background:var(--primary);border-radius:10px;margin-bottom:1rem;">
                    <span style="color:#fff;font-weight:800;font-size:0.75rem;text-align:center;line-height:1.2;">TEA<br>CCH</span>
                </div>
                <h3>Approche Structurée TEACCH</h3>
                <p style="font-size:0.88rem;">L'approche TEACCH mise sur la structuration de l'environnement et des activités pour favoriser la compréhension et l'indépendance. Particulièrement adaptée aux contextes éducatifs.</p>
                <div style="margin-top:1rem;padding:0.75rem;background:var(--primary-light);border-radius:var(--radius);font-size:0.8rem;color:var(--primary);">
                    <strong>Bénéfices :</strong> Organisation, autonomie, réduction de l'anxiété
                </div>
            </div>

            <!-- Sensorielle -->
            <div class="feature-card reveal">
                <div style="display:inline-flex;align-items:center;justify-content:center;width:50px;height:50px;background:var(--accent);border-radius:10px;margin-bottom:1rem;">
                    <svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" style="width:24px;height:24px"><path d="M12 2a9 9 0 0 1 9 9c0 4.97-9 13-9 13S3 15.97 3 11a9 9 0 0 1 9-9z"/><circle cx="12" cy="11" r="3"/></svg>
                </div>
                <h3>Approche Sensorielle & Intégration</h3>
                <p style="font-size:0.88rem;">De nombreux enfants autistes présentent des sensibilités sensorielles particulières. L'approche sensorielle travaille à régulariser ces sensibilités pour améliorer le confort et les apprentissages de l'enfant.</p>
                <div style="margin-top:1rem;padding:0.75rem;background:#fff0ed;border-radius:var(--radius);font-size:0.8rem;color:var(--accent);">
                    <strong>Bénéfices :</strong> Confort sensoriel, concentration, bien-être
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ===================== PARTENARIATS ===================== -->
<section class="section">
    <div class="container">
        <div class="section-header reveal">
            <span class="label">Ensemble, nous sommes plus forts</span>
            <h2>Nos Types de Partenariats</h2>
            <div class="section-divider"></div>
            <p>EVA Autisme développe des partenariats diversifiés pour maximiser son impact sur le terrain béninois.</p>
        </div>

        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:1.25rem;margin-top:2.5rem;">

            <!-- Financiers -->
            <div class="reveal" style="background:var(--primary-light);border-radius:var(--radius-lg);padding:1.75rem;text-align:center;">
                <div style="width:56px;height:56px;background:var(--primary);border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 1rem;">
                    <svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" style="width:24px;height:24px"><circle cx="12" cy="12" r="10"/><path d="M12 8v4l3 3"/></svg>
                </div>
                <h4 style="margin-bottom:0.5rem;color:var(--primary);">Partenaires Financiers</h4>
                <p style="font-size:0.83rem;">Entreprises, fondations et donateurs individuels qui soutiennent financièrement nos programmes et actions.</p>
            </div>

            <!-- Techniques -->
            <div class="reveal" style="background:var(--bg-light);border-radius:var(--radius-lg);padding:1.75rem;text-align:center;">
                <div style="width:56px;height:56px;background:var(--accent);border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 1rem;">
                    <svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" style="width:24px;height:24px"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>
                </div>
                <h4 style="margin-bottom:0.5rem;color:var(--accent);">Partenaires Techniques</h4>
                <p style="font-size:0.83rem;">Organisations apportant expertise, outils et ressources techniques pour renforcer nos capacités d'action.</p>
            </div>

            <!-- Professionnels -->
            <div class="reveal" style="background:var(--primary-light);border-radius:var(--radius-lg);padding:1.75rem;text-align:center;">
                <div style="width:56px;height:56px;background:var(--primary);border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 1rem;">
                    <svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" style="width:24px;height:24px"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>
                </div>
                <h4 style="margin-bottom:0.5rem;color:var(--primary);">Partenaires Professionnels</h4>
                <p style="font-size:0.83rem;">Médecins, orthophonistes, psychologues et thérapeutes qui accompagnent bénévolement les enfants et familles.</p>
            </div>

            <!-- Éducatifs -->
            <div class="reveal" style="background:var(--bg-light);border-radius:var(--radius-lg);padding:1.75rem;text-align:center;">
                <div style="width:56px;height:56px;background:var(--accent);border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 1rem;">
                    <svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" style="width:24px;height:24px"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18"/><path d="M9 21V9"/></svg>
                </div>
                <h4 style="margin-bottom:0.5rem;color:var(--accent);">Partenaires Éducatifs</h4>
                <p style="font-size:0.83rem;">Écoles, universités et centres de formation qui collaborent à la sensibilisation et à l'inclusion scolaire des enfants TSA.</p>
            </div>

            <!-- Institutionnels -->
            <div class="reveal" style="background:var(--primary-light);border-radius:var(--radius-lg);padding:1.75rem;text-align:center;">
                <div style="width:56px;height:56px;background:var(--primary);border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 1rem;">
                    <svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" style="width:24px;height:24px"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                </div>
                <h4 style="margin-bottom:0.5rem;color:var(--primary);">Partenaires Institutionnels</h4>
                <p style="font-size:0.83rem;">Ministères, mairies et organismes publics béninois qui reconnaissent et soutiennent le travail d'EVA Autisme.</p>
            </div>

        </div>

        <!-- Carousel logos partenaires -->
        <div style="margin-top:3rem;" class="reveal">
            <p style="font-size:0.85rem;color:var(--text-light);margin-bottom:1.5rem;font-style:italic;text-align:center;">Nos partenaires et soutiens</p>
            <div class="partners-carousel-track-wrap">
                <div class="partners-carousel-track" id="partnersTrack">
                    @if(isset($partners) && $partners->count())
                        @foreach($partners as $partner)
                        <div class="partner-logo-item">
                            @if($partner->logo)
                                <img src="{{ asset('storage/'.$partner->logo) }}" alt="{{ $partner->name }}">
                            @else
                                <span>{{ $partner->name }}</span>
                            @endif
                        </div>
                        @endforeach
                        {{-- Duplicate for seamless loop --}}
                        @foreach($partners as $partner)
                        <div class="partner-logo-item" aria-hidden="true">
                            @if($partner->logo)
                                <img src="{{ asset('storage/'.$partner->logo) }}" alt="{{ $partner->name }}">
                            @else
                                <span>{{ $partner->name }}</span>
                            @endif
                        </div>
                        @endforeach
                    @else
                        @php
                        $placeholderPartners = ['Ministère de la Santé', 'UNICEF Bénin', 'Mairie d\'Abomey-Calavi', 'OMS Bénin', 'MASM Bénin', 'Fondation Orange', 'UDAB', 'Cruz Roja'];
                        @endphp
                        @foreach($placeholderPartners as $pname)
                        <div class="partner-logo-item"><span>{{ $pname }}</span></div>
                        @endforeach
                        @foreach($placeholderPartners as $pname)
                        <div class="partner-logo-item" aria-hidden="true"><span>{{ $pname }}</span></div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===================== CTA PARTENARIAT ===================== -->
<section style="background:linear-gradient(135deg,var(--primary) 0%,#0073e6 100%);padding:80px 0;color:#fff;">
    <div class="container" style="text-align:center;">
        <div class="reveal">
            <span style="display:inline-block;background:rgba(255,255,255,0.15);color:#fff;font-size:0.75rem;font-weight:700;letter-spacing:2px;text-transform:uppercase;padding:4px 14px;border-radius:30px;margin-bottom:1rem;">Rejoignez notre réseau</span>
            <h2 style="color:#fff;margin-bottom:1rem;">Devenez partenaire d'EVA Autisme</h2>
            <p style="color:rgba(255,255,255,0.85);max-width:580px;margin:0 auto 2rem;">
                Vous souhaitez contribuer à notre mission ? Que vous soyez une entreprise, une institution ou un professionnel, il existe une forme de partenariat adaptée à votre situation.
            </p>
            <div style="display:flex;gap:1rem;justify-content:center;flex-wrap:wrap;">
                <a href="{{ route('contact') }}" class="btn btn-orange btn-lg">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:18px;height:18px"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                    Devenir Partenaire
                </a>
                <a href="{{ route('about.impact') }}" class="btn" style="background:rgba(255,255,255,0.15);color:#fff;border:2px solid rgba(255,255,255,0.5);font-size:1rem;padding:1rem 2.5rem;">
                    Voir Notre Impact
                </a>
            </div>
        </div>
    </div>
</section>

@endsection

@section('styles')
<style>
@media (max-width: 768px) {
    /* Sur mobile, les étapes alternées deviennent linéaires */
    .section [style*="grid-template-columns:1fr 80px 1fr"] {
        grid-template-columns: 64px 1fr !important;
    }
    .section [style*="opacity:0;pointer-events:none"] {
        display: none !important;
    }
    .section [style*="text-align:right"] {
        text-align: left !important;
    }
    .section [style*="border-radius:var(--radius-lg) 0 0"] {
        border-radius: 0 var(--radius-lg) var(--radius-lg) 0 !important;
        border-right: 1px solid var(--border) !important;
        border-left: none !important;
    }
}
</style>
@endsection
