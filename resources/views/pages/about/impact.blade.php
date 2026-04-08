@extends('layouts.app')

@section('title', 'Notre Impact')
@section('meta_description', 'Découvrez l\'impact concret d\'EVA Autisme : familles accompagnées, événements organisés, partenaires mobilisés et personnes sensibilisées au Bénin.')

@section('content')

<!-- ===================== PAGE HEADER ===================== -->
<section class="page-header">
    <div class="container">
        <h1>Notre Impact</h1>
        <nav class="breadcrumb" aria-label="Fil d'Ariane">
            <a href="{{ route('home') }}">Accueil</a>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
            <a href="{{ route('about.qui-sommes-nous') }}">À Propos</a>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
            <span>Notre Impact</span>
        </nav>
    </div>
</section>

<!-- ===================== INTRO ===================== -->
<section class="section bg-light">
    <div class="container">
        <div class="section-header reveal">
            <span class="label">Des chiffres qui parlent</span>
            <h2>L'impact concret d'EVA Autisme</h2>
            <div class="section-divider"></div>
            <p>Depuis 2022, chaque action menée par EVA Autisme laisse une trace dans la vie de familles béninoises. Voici les chiffres qui témoignent de notre engagement au quotidien.</p>
        </div>

        <!-- Statistiques animées -->
        <div class="stats-section" style="background:transparent;padding:0;">
            <div class="stats-grid" style="margin-top:2rem;">
                <div class="stat-item reveal" style="background:#fff;border-radius:var(--radius-lg);padding:2.5rem 1.5rem;box-shadow:0 2px 12px rgba(0,0,0,0.07);border:1px solid var(--border);text-align:center;">
                    <div class="stat-number" data-target="200" data-suffix="+" style="color:var(--primary);font-size:3rem;font-weight:800;line-height:1;margin-bottom:0.3rem;">200<span style="color:var(--primary);">+</span></div>
                    <div class="stat-label" style="color:var(--text-dark);font-weight:600;font-size:1rem;margin-bottom:0.4rem;">Familles accompagnées</div>
                    <p style="font-size:0.8rem;color:var(--text-light);">Orientation, soutien et suivi personnalisé</p>
                </div>
                <div class="stat-item reveal" style="background:#fff;border-radius:var(--radius-lg);padding:2.5rem 1.5rem;box-shadow:0 2px 12px rgba(0,0,0,0.07);border:1px solid var(--border);text-align:center;">
                    <div class="stat-number" data-target="50" data-suffix="+" style="color:#ffa84b;font-size:3rem;font-weight:800;line-height:1;margin-bottom:0.3rem;">50<span style="color:#ffa84b;">+</span></div>
                    <div class="stat-label" style="color:var(--text-dark);font-weight:600;font-size:1rem;margin-bottom:0.4rem;">Événements organisés</div>
                    <p style="font-size:0.8rem;color:var(--text-light);">Conférences, ateliers, journées de sensibilisation</p>
                </div>
                <div class="stat-item reveal" style="background:#fff;border-radius:var(--radius-lg);padding:2.5rem 1.5rem;box-shadow:0 2px 12px rgba(0,0,0,0.07);border:1px solid var(--border);text-align:center;">
                    <div class="stat-number" data-target="30" data-suffix="+" style="color:var(--green);font-size:3rem;font-weight:800;line-height:1;margin-bottom:0.3rem;">30<span style="color:var(--green);">+</span></div>
                    <div class="stat-label" style="color:var(--text-dark);font-weight:600;font-size:1rem;margin-bottom:0.4rem;">Partenaires actifs</div>
                    <p style="font-size:0.8rem;color:var(--text-light);">Institutionnels, associatifs et privés</p>
                </div>
                <div class="stat-item reveal" style="background:#fff;border-radius:var(--radius-lg);padding:2.5rem 1.5rem;box-shadow:0 2px 12px rgba(0,0,0,0.07);border:1px solid var(--border);text-align:center;">
                    <div class="stat-number" data-target="500" data-suffix="+" style="color:var(--teal);font-size:3rem;font-weight:800;line-height:1;margin-bottom:0.3rem;">500<span style="color:var(--teal);">+</span></div>
                    <div class="stat-label" style="color:var(--text-dark);font-weight:600;font-size:1rem;margin-bottom:0.4rem;">Personnes sensibilisées</div>
                    <p style="font-size:0.8rem;color:var(--text-light);">Dans les écoles, entreprises et communautés</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===================== RÉSULTATS CONCRETS ===================== -->
<section class="section">
    <div class="container">
        <div class="section-header reveal">
            <span class="label">Ce que nous avons accompli</span>
            <h2>Résultats Concrets</h2>
            <div class="section-divider"></div>
        </div>

        <div class="grid-3" style="margin-top:2.5rem;">

            <div class="feature-card reveal">
                <div class="feature-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="var(--primary)" stroke-width="2" style="width:26px;height:26px">
                        <path d="M22 10v6M2 10l10-5 10 5-10 5z"/>
                        <path d="M6 12v5c3 3 9 3 12 0v-5"/>
                    </svg>
                </div>
                <h3>Éducation & Scolarisation</h3>
                <p>Orientation de familles vers des structures éducatives adaptées et sensibilisation des enseignants à l'accueil inclusif des enfants TSA dans les écoles béninoises.</p>
                <div style="margin-top:1rem;display:flex;align-items:center;gap:0.5rem;">
                    <div style="width:8px;height:8px;background:var(--primary);border-radius:50%;"></div>
                    <span style="font-size:0.82rem;color:var(--primary);font-weight:600;">Formation de plus de 100 enseignants</span>
                </div>
            </div>

            <div class="feature-card reveal">
                <div class="feature-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="var(--primary)" stroke-width="2" style="width:26px;height:26px">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                        <circle cx="9" cy="7" r="4"/>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                    </svg>
                </div>
                <h3>Soutien aux Familles</h3>
                <p>Accompagnement continu des familles vulnérables : écoute, orientation médicale, soutien psychologique et accès facilité aux ressources thérapeutiques disponibles au Bénin.</p>
                <div style="margin-top:1rem;display:flex;align-items:center;gap:0.5rem;">
                    <div style="width:8px;height:8px;background:var(--primary);border-radius:50%;"></div>
                    <span style="font-size:0.82rem;color:var(--primary);font-weight:600;">200+ familles suivies activement</span>
                </div>
            </div>

            <div class="feature-card reveal">
                <div class="feature-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="var(--primary)" stroke-width="2" style="width:26px;height:26px">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                        <line x1="16" y1="2" x2="16" y2="6"/>
                        <line x1="8" y1="2" x2="8" y2="6"/>
                        <line x1="3" y1="10" x2="21" y2="10"/>
                    </svg>
                </div>
                <h3>Événements Marquants</h3>
                <p>Organisation de journées de sensibilisation, conférences, ateliers et expositions mettant en lumière les talents des enfants autistes et brisant les préjugés dans la société.</p>
                <div style="margin-top:1rem;display:flex;align-items:center;gap:0.5rem;">
                    <div style="width:8px;height:8px;background:var(--primary);border-radius:50%;"></div>
                    <span style="font-size:0.82rem;color:var(--primary);font-weight:600;">50+ événements depuis 2022</span>
                </div>
            </div>

            <div class="feature-card reveal">
                <div class="feature-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="var(--primary)" stroke-width="2" style="width:26px;height:26px">
                        <circle cx="12" cy="12" r="10"/>
                        <path d="M2 12h20M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>
                    </svg>
                </div>
                <h3>Rayonnement Régional</h3>
                <p>Présence active dans plusieurs communes du Bénin, participation à des événements nationaux et développement d'un réseau de partenaires locaux et internationaux.</p>
                <div style="margin-top:1rem;display:flex;align-items:center;gap:0.5rem;">
                    <div style="width:8px;height:8px;background:var(--primary);border-radius:50%;"></div>
                    <span style="font-size:0.82rem;color:var(--primary);font-weight:600;">Présence dans 5+ communes</span>
                </div>
            </div>

            <div class="feature-card reveal">
                <div class="feature-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="var(--primary)" stroke-width="2" style="width:26px;height:26px">
                        <polyline points="9 11 12 14 22 4"/>
                        <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/>
                    </svg>
                </div>
                <h3>Club Parents</h3>
                <p>Création et animation d'un Club Parents actif : espace d'échange, de formation et de solidarité entre familles, animé régulièrement par des professionnels bénévoles.</p>
                <div style="margin-top:1rem;display:flex;align-items:center;gap:0.5rem;">
                    <div style="width:8px;height:8px;background:var(--primary);border-radius:50%;"></div>
                    <span style="font-size:0.82rem;color:var(--primary);font-weight:600;">Réunions mensuelles régulières</span>
                </div>
            </div>

            <div class="feature-card reveal">
                <div class="feature-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="var(--primary)" stroke-width="2" style="width:26px;height:26px">
                        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                    </svg>
                </div>
                <h3>Sensibilisation Digitale</h3>
                <p>Campagnes de communication sur les réseaux sociaux, publications éducatives et diffusion de contenus adaptés pour toucher un public large et sensibiliser au-delà des frontières physiques.</p>
                <div style="margin-top:1rem;display:flex;align-items:center;gap:0.5rem;">
                    <div style="width:8px;height:8px;background:var(--primary);border-radius:50%;"></div>
                    <span style="font-size:0.82rem;color:var(--primary);font-weight:600;">Milliers d'interactions en ligne</span>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ===================== TÉMOIGNAGES ===================== -->
<section class="section bg-light">
    <div class="container">
        <div class="section-header reveal">
            <span class="label">Ils nous font confiance</span>
            <h2>Témoignages de Familles</h2>
            <div class="section-divider"></div>
            <p>Des parents témoignent de la différence qu'EVA Autisme a faite dans leur quotidien.</p>
        </div>

        <div class="grid-3" style="margin-top:2.5rem;">

            <!-- Témoignage 1 -->
            <div class="card reveal" style="border-radius:var(--radius-lg);padding:2rem;border:1px solid var(--border);position:relative;">
                <!-- Guillemets décoratifs -->
                <div style="position:absolute;top:1.25rem;right:1.5rem;font-size:4rem;line-height:1;color:var(--primary-light);font-family:Georgia,serif;font-weight:900;">"</div>
                <div style="display:flex;align-items:center;gap:0.75rem;margin-bottom:1.25rem;">
                    <div style="width:52px;height:52px;border-radius:50%;background:var(--primary-light);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <svg viewBox="0 0 24 24" fill="none" stroke="var(--primary)" stroke-width="1.5" style="width:28px;height:28px;opacity:0.5"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
                    </div>
                    <div>
                        <div style="font-weight:700;font-size:0.95rem;">Mère d'un enfant de 7 ans</div>
                        <div style="font-size:0.8rem;color:var(--text-light);">Abomey-Calavi</div>
                    </div>
                </div>
                <p style="font-size:0.9rem;line-height:1.75;font-style:italic;color:var(--text-mid);">
                    "Avant de rencontrer EVA Autisme, je ne savais pas vers qui me tourner. Mon fils avait des comportements que je ne comprenais pas. Grâce à l'accompagnement de l'ONG, j'ai pu comprendre le TSA et trouver des solutions adaptées à ma situation."
                </p>
                <div style="margin-top:1rem;display:flex;gap:3px;">
                    @for($i = 0; $i < 5; $i++)
                    <svg viewBox="0 0 24 24" fill="var(--accent)" style="width:14px;height:14px"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01z"/></svg>
                    @endfor
                </div>
            </div>

            <!-- Témoignage 2 -->
            <div class="card reveal" style="border-radius:var(--radius-lg);padding:2rem;border:1px solid var(--border);position:relative;">
                <div style="position:absolute;top:1.25rem;right:1.5rem;font-size:4rem;line-height:1;color:var(--primary-light);font-family:Georgia,serif;font-weight:900;">"</div>
                <div style="display:flex;align-items:center;gap:0.75rem;margin-bottom:1.25rem;">
                    <div style="width:52px;height:52px;border-radius:50%;background:var(--primary-light);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <svg viewBox="0 0 24 24" fill="none" stroke="var(--primary)" stroke-width="1.5" style="width:28px;height:28px;opacity:0.5"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
                    </div>
                    <div>
                        <div style="font-weight:700;font-size:0.95rem;">Père d'une enfant de 5 ans</div>
                        <div style="font-size:0.8rem;color:var(--text-light);">Cotonou</div>
                    </div>
                </div>
                <p style="font-size:0.9rem;line-height:1.75;font-style:italic;color:var(--text-mid);">
                    "Le Club Parents a été une révélation. J'y ai rencontré d'autres pères dans la même situation. Nous partageons nos expériences, nos craintes et nos victoires. EVA Autisme a su créer un espace de solidarité réelle entre familles."
                </p>
                <div style="margin-top:1rem;display:flex;gap:3px;">
                    @for($i = 0; $i < 5; $i++)
                    <svg viewBox="0 0 24 24" fill="var(--accent)" style="width:14px;height:14px"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01z"/></svg>
                    @endfor
                </div>
            </div>

            <!-- Témoignage 3 -->
            <div class="card reveal" style="border-radius:var(--radius-lg);padding:2rem;border:1px solid var(--border);position:relative;">
                <div style="position:absolute;top:1.25rem;right:1.5rem;font-size:4rem;line-height:1;color:var(--primary-light);font-family:Georgia,serif;font-weight:900;">"</div>
                <div style="display:flex;align-items:center;gap:0.75rem;margin-bottom:1.25rem;">
                    <div style="width:52px;height:52px;border-radius:50%;background:var(--primary-light);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <svg viewBox="0 0 24 24" fill="none" stroke="var(--primary)" stroke-width="1.5" style="width:28px;height:28px;opacity:0.5"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
                    </div>
                    <div>
                        <div style="font-weight:700;font-size:0.95rem;">Grand-mère d'un enfant autiste</div>
                        <div style="font-size:0.8rem;color:var(--text-light);">Calavi, Bénin</div>
                    </div>
                </div>
                <p style="font-size:0.9rem;line-height:1.75;font-style:italic;color:var(--text-mid);">
                    "Dans notre famille, on pensait que notre petit-fils était possédé. EVA Autisme nous a ouvert les yeux et aidés à comprendre. Aujourd'hui, il est dans une école adaptée et il progresse. Nous leur sommes infiniment reconnaissants."
                </p>
                <div style="margin-top:1rem;display:flex;gap:3px;">
                    @for($i = 0; $i < 5; $i++)
                    <svg viewBox="0 0 24 24" fill="var(--accent)" style="width:14px;height:14px"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01z"/></svg>
                    @endfor
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ===================== IMPACT GÉOGRAPHIQUE ===================== -->
<section class="section">
    <div class="container">
        <div class="section-header reveal">
            <span class="label">Couverture géographique</span>
            <h2>Notre Présence au Bénin</h2>
            <div class="section-divider"></div>
            <p>EVA Autisme étend progressivement ses actions dans les principales villes du Bénin et ambitionne, à terme, de couvrir l'ensemble du territoire national.</p>
        </div>

        <div style="display:grid;grid-template-columns:1fr 1.2fr;gap:3rem;align-items:start;margin-top:2.5rem;" class="grid-2">

            <!-- Zones d'intervention -->
            <div class="reveal">
                <h3 style="margin-bottom:1.5rem;color:var(--primary);">Zones d'intervention principales</h3>

                @php
                $zones = [
                    ['ville' => 'Abomey-Calavi', 'desc' => 'Siège de l\'ONG – Centre d\'activités principal', 'niveau' => 100],
                    ['ville' => 'Cotonou', 'desc' => 'Capitale économique – Événements & partenariats', 'niveau' => 80],
                    ['ville' => 'Porto-Novo', 'desc' => 'Capitale politique – Sensibilisation institutionnelle', 'niveau' => 60],
                    ['ville' => 'Parakou', 'desc' => 'Expansion vers le nord du Bénin', 'niveau' => 35],
                    ['ville' => 'Ouidah', 'desc' => 'Actions communautaires et culturelles', 'niveau' => 45],
                ];
                @endphp

                @foreach($zones as $zone)
                <div style="margin-bottom:1.25rem;">
                    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:0.4rem;">
                        <div>
                            <span style="font-weight:700;font-size:0.93rem;">{{ $zone['ville'] }}</span>
                            <span style="font-size:0.8rem;color:var(--text-light);margin-left:0.5rem;">– {{ $zone['desc'] }}</span>
                        </div>
                        <span style="font-size:0.8rem;font-weight:600;color:var(--primary);">{{ $zone['niveau'] }}%</span>
                    </div>
                    <div style="height:6px;background:var(--border);border-radius:3px;overflow:hidden;">
                        <div style="height:100%;width:{{ $zone['niveau'] }}%;background:linear-gradient(90deg,var(--primary),var(--accent));border-radius:3px;transition:width 1s ease;"></div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Carte textuelle Bénin -->
            <div class="reveal">
                <div style="background:var(--primary-light);border-radius:var(--radius-lg);padding:2.5rem;position:relative;min-height:380px;">
                    <h4 style="text-align:center;color:var(--primary);margin-bottom:2rem;">Carte de présence – Bénin</h4>

                    <!-- Représentation schématique -->
                    <div style="position:relative;text-align:center;">
                        <!-- SVG schématique du Bénin avec points -->
                        <svg viewBox="0 0 200 350" style="width:100%;max-width:220px;margin:0 auto;display:block;" aria-label="Carte schématique du Bénin">
                            <!-- Silhouette simplifiée -->
                            <path d="M60 30 L140 30 L155 80 L150 140 L160 180 L155 230 L140 280 L120 320 L100 330 L80 320 L60 280 L45 230 L40 180 L50 140 L45 80 Z" fill="#c8d9f0" stroke="#0055A5" stroke-width="2"/>
                            <!-- Points de présence -->
                            <!-- Abomey-Calavi (siège) -->
                            <circle cx="90" cy="270" r="10" fill="#0055A5" opacity="0.9"/>
                            <text x="108" y="274" font-size="9" fill="#0055A5" font-weight="bold">Abomey-Calavi</text>
                            <!-- Cotonou -->
                            <circle cx="95" cy="290" r="7" fill="#E8501A" opacity="0.9"/>
                            <text x="108" y="294" font-size="8" fill="#E8501A">Cotonou</text>
                            <!-- Porto-Novo -->
                            <circle cx="135" cy="278" r="6" fill="#0055A5" opacity="0.7"/>
                            <text x="145" y="282" font-size="7" fill="#0055A5">Porto-Novo</text>
                            <!-- Ouidah -->
                            <circle cx="72" cy="283" r="5" fill="#0055A5" opacity="0.6"/>
                            <text x="30" y="287" font-size="7" fill="#0055A5">Ouidah</text>
                            <!-- Parakou -->
                            <circle cx="100" cy="140" r="5" fill="#0055A5" opacity="0.5"/>
                            <text x="110" y="144" font-size="7" fill="#0055A5">Parakou</text>
                        </svg>

                        <!-- Légende -->
                        <div style="margin-top:1.5rem;display:flex;flex-wrap:wrap;gap:1rem;justify-content:center;">
                            <div style="display:flex;align-items:center;gap:0.4rem;font-size:0.8rem;">
                                <div style="width:12px;height:12px;border-radius:50%;background:var(--primary);"></div>
                                <span>Présence principale</span>
                            </div>
                            <div style="display:flex;align-items:center;gap:0.4rem;font-size:0.8rem;">
                                <div style="width:12px;height:12px;border-radius:50%;background:var(--accent);"></div>
                                <span>Activités régulières</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===================== CTA ===================== -->
<section style="background:linear-gradient(135deg,var(--primary) 0%,#0073e6 100%);padding:80px 0;color:#fff;">
    <div class="container" style="text-align:center;">
        <div class="reveal">
            <span style="display:inline-block;background:rgba(255,255,255,0.15);color:#fff;font-size:0.75rem;font-weight:700;letter-spacing:2px;text-transform:uppercase;padding:4px 14px;border-radius:30px;margin-bottom:1rem;">Amplifier l'impact</span>
            <h2 style="color:#fff;margin-bottom:1rem;">Aidez-nous à faire davantage</h2>
            <p style="color:rgba(255,255,255,0.85);max-width:580px;margin:0 auto 2rem;">
                Chaque don, chaque heure de bénévolat, chaque partage amplifie notre impact. Ensemble, nous pouvons toucher encore plus de familles.
            </p>
            <div style="display:flex;gap:1rem;justify-content:center;flex-wrap:wrap;">
                <a href="{{ route('don') }}" class="btn btn-orange btn-lg">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:18px;height:18px"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
                    Faire un Don
                </a>
                <a href="{{ route('about.demarche') }}" class="btn" style="background:rgba(255,255,255,0.15);color:#fff;border:2px solid rgba(255,255,255,0.5);font-size:1rem;padding:1rem 2.5rem;">
                    Notre Démarche
                </a>
            </div>
        </div>
    </div>
</section>

@endsection
