@extends('layouts.app')

@section('title', 'Notre Impact')
@section('meta_description', 'Découvrez l\'impact concret d\'EVA Autisme : familles accompagnées, événements organisés, partenaires mobilisés et personnes sensibilisées au Bénin.')

@section('styles')
<style>
.benin-layout { display:grid;grid-template-columns:1fr 1.2fr;gap:3rem;align-items:start;margin-top:2.5rem; }
@media (max-width:900px) { .benin-layout { grid-template-columns:minmax(0,1fr);gap:2rem; } }
.benin-group { margin-bottom:1.4rem; }
.benin-group h4 { display:flex;align-items:center;gap:0.5rem;font-size:0.95rem;margin-bottom:0.4rem; }
.benin-group ul { list-style:none;margin:0;padding:0 0 0 1.35rem; }
.benin-group li, .benin-group p { font-size:0.87rem;color:var(--text-mid);margin:0 0 0.3rem; }
.benin-group p { padding-left:1.35rem; }
.benin-group strong { color:var(--text-dark, #1a1a2e); }
.benin-card { background:var(--primary-light);border-radius:var(--radius-lg);padding:2rem 1.5rem; }
.benin-card h4 { text-align:center;color:var(--primary);margin-bottom:1.25rem; }
.benin-card svg { display:block;width:100%;max-width:370px;margin:0 auto; }
.benin-dept { stroke:#fff;stroke-width:1.4;stroke-linejoin:round;transition:opacity 0.15s; }
.benin-dept:hover { opacity:0.8; }
.benin-dept.is-principal { fill:#0055A5; }
.benin-dept.is-regulier { fill:#E8501A; }
.benin-dept.is-expansion { fill:#F5B041; }
.benin-dept.is-a_venir { fill:#c8d9f0; }
.benin-label { font-size:13px;font-weight:600;text-anchor:middle;dominant-baseline:middle;fill:#23405f;pointer-events:none; }
.benin-label.is-principal, .benin-label.is-regulier { fill:#fff; }
.benin-label.is-callout { fill:#23405f; }
.benin-leader { stroke:#23405f;stroke-width:0.8; }
.benin-hq { fill:#fff;stroke:#0055A5;stroke-width:1.5; }
.benin-legend { display:flex;flex-wrap:wrap;gap:0.5rem 1.1rem;justify-content:center;margin-top:1.1rem;font-size:0.8rem; }
.benin-legend span { display:flex;align-items:center;gap:0.4rem; }
.benin-swatch { display:inline-block;flex:none;width:13px;height:13px;border-radius:3px; }
.benin-swatch.is-principal { background:#0055A5; }
.benin-swatch.is-regulier { background:#E8501A; }
.benin-swatch.is-expansion { background:#F5B041; }
.benin-swatch.is-a_venir { background:#c8d9f0; }
</style>
@endsection

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
            <p>EVA Autisme étend progressivement ses actions dans les départements du Bénin et ambitionne, à terme, de couvrir l'ensemble du territoire national.</p>
        </div>

        @php
            $departments = collect($benin['departments']);
            // Départements du sud trop petits pour porter leur nom : étiquette à l'extérieur.
            $callouts = ['couffo' => [46, 530], 'mono' => [46, 590], 'plateau' => [238, 510], 'oueme' => [238, 570], 'atlantique' => [120, 625], 'littoral' => [185, 625]];
            $groups = collect(\App\Support\BeninDepartments::STATUSES)
                ->map(fn ($label, $status) => ['label' => $label, 'items' => $departments->where('status', $status)->sortBy('name')])
                ->filter(fn ($group) => $group['items']->isNotEmpty());
        @endphp

        <div class="benin-layout">

            <!-- Départements par statut -->
            <div class="reveal">
                <h3 style="margin-bottom:0.4rem;color:var(--primary);">Nos zones d'intervention</h3>
                <p style="font-size:0.9rem;margin-bottom:1.5rem;">Présents dans {{ $departments->where('status', '!=', 'a_venir')->count() }} départements sur 12.</p>

                @foreach($groups as $status => $group)
                    <div class="benin-group">
                        <h4><i class="benin-swatch is-{{ $status }}"></i>{{ $group['label'] }}</h4>
                        @if($status === 'a_venir')
                            <p>{{ $group['items']->pluck('name')->join(', ', ' et ') }}</p>
                        @else
                            <ul>
                                @foreach($group['items'] as $department)
                                    <li><strong>{{ $department['name'] }}</strong>@if($department['description']) – {{ $department['description'] }}@endif</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                @endforeach
            </div>

            <!-- Carte des départements -->
            <div class="reveal">
                <div class="benin-card">
                    <h4>Carte de présence – Bénin</h4>
                    <svg viewBox="-34 -6 368 {{ $benin['height'] + 42 }}" role="img" aria-label="Carte du Bénin et de ses 12 départements, colorés selon la présence d'EVA Autisme">
                        @foreach($benin['departments'] as $department)
                            <path d="{{ $department['path'] }}" class="benin-dept is-{{ $department['status'] }}"><title>{{ $department['name'] }} : {{ $department['status_label'] }}</title></path>
                        @endforeach
                        @foreach($benin['departments'] as $key => $department)
                @continue(isset($callouts[$key]))
                            <text x="{{ $department['x'] }}" y="{{ $department['y'] }}" class="benin-label is-{{ $department['status'] }}">{{ $department['name'] }}</text>
                        @endforeach
                        @foreach($callouts as $key => [$labelX, $labelY])
                            @php($department = $benin['departments'][$key])
                            <line x1="{{ $department['x'] }}" y1="{{ $department['y'] }}" x2="{{ $labelX }}" y2="{{ $labelY }}" class="benin-leader"/>
                            <text x="{{ $labelX + ($labelX > 150 ? 3 : -3) }}" y="{{ $labelY + ($labelY > 610 ? 9 : 0) }}" class="benin-label is-callout" style="text-anchor:{{ $labelY > 610 ? 'middle' : ($labelX > 150 ? 'start' : 'end') }}">{{ $department['name'] }}</text>
                        @endforeach
                        <circle cx="{{ $benin['headquarters']['x'] }}" cy="{{ $benin['headquarters']['y'] }}" r="3.5" class="benin-hq"><title>Siège d'EVA Autisme à Abomey-Calavi</title></circle>
                    </svg>
                    <div class="benin-legend">
                        @foreach(\App\Support\BeninDepartments::STATUSES as $status => $label)
                            <span><i class="benin-swatch is-{{ $status }}"></i>{{ $label }}</span>
                        @endforeach
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
