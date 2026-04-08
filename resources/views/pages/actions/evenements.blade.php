@extends('layouts.app')

@section('title', 'Nos Événements')
@section('meta_description', 'Participez aux événements de l\'ONG EVA Autisme au Bénin : conférences, journées de sensibilisation, ateliers parents et formations sur l\'autisme.')

@section('styles')
<style>
/* ---- Tabs ---- */
.tabs-wrapper { margin-top: 2rem; }
.tabs-nav {
    display: flex;
    gap: 0.5rem;
    border-bottom: 2px solid var(--border);
    margin-bottom: 2rem;
    flex-wrap: wrap;
}
.tab-btn {
    background: none;
    border: none;
    padding: 0.75rem 1.75rem;
    font-size: 0.95rem;
    font-weight: 600;
    color: var(--text-muted);
    cursor: pointer;
    border-bottom: 3px solid transparent;
    margin-bottom: -2px;
    transition: color 0.2s, border-color 0.2s;
    border-radius: 6px 6px 0 0;
}
.tab-btn:hover { color: var(--primary); }
.tab-btn.active {
    color: var(--primary);
    border-bottom-color: var(--primary);
    background: var(--primary-light);
}
.tab-content { display: none; }
.tab-content.active { display: block; }

/* ---- Event card ---- */
.event-card {
    display: flex;
    gap: 1.5rem;
    background: #fff;
    border-radius: var(--radius-lg);
    padding: 1.5rem;
    box-shadow: var(--shadow-sm);
    margin-bottom: 1.25rem;
    align-items: flex-start;
    border-left: 4px solid var(--primary);
    transition: box-shadow 0.2s;
}
.event-card:hover { box-shadow: var(--shadow-md); }
.event-date-block {
    background: var(--primary);
    color: #fff;
    border-radius: var(--radius);
    padding: 0.75rem 1rem;
    text-align: center;
    min-width: 68px;
    flex-shrink: 0;
}
.event-date-block .day { font-size: 1.8rem; font-weight: 800; line-height: 1; }
.event-date-block .month { font-size: 0.78rem; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; margin-top: 2px; }
.event-info { flex: 1; }
.event-info h4 { font-size: 1.05rem; margin-bottom: 0.5rem; }
.event-meta { display: flex; gap: 1.25rem; flex-wrap: wrap; font-size: 0.82rem; color: var(--text-muted); margin-bottom: 0.75rem; }
.event-meta span { display: flex; align-items: center; gap: 5px; }
.event-meta svg { width: 14px; height: 14px; flex-shrink: 0; }
.event-badge {
    display: inline-block;
    font-size: 0.72rem;
    font-weight: 700;
    padding: 2px 10px;
    border-radius: 20px;
    margin-bottom: 0.4rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}
.badge-upcoming { background: #e6f0ff; color: var(--primary); }
.badge-past { background: #f0f0f0; color: #666; }

/* ---- Modal ---- */
.modal-overlay {
    position: fixed;
    inset: 0;
    background: rgba(0, 0, 0, 0.55);
    z-index: 9998;
    display: none;
    align-items: center;
    justify-content: center;
    padding: 1rem;
}
.modal-overlay.open { display: flex; }
.modal-box {
    background: #fff;
    border-radius: var(--radius-lg);
    padding: 2rem 2.5rem;
    max-width: 560px;
    width: 100%;
    position: relative;
    max-height: 90vh;
    overflow-y: auto;
    box-shadow: 0 20px 60px rgba(0,0,0,0.25);
}
.modal-close {
    position: absolute;
    top: 1rem;
    right: 1rem;
    background: #f5f5f5;
    border: none;
    width: 34px;
    height: 34px;
    border-radius: 50%;
    cursor: pointer;
    font-size: 1.1rem;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #555;
    transition: background 0.2s;
}
.modal-close:hover { background: #e0e0e0; }
</style>
@endsection

@section('content')

<!-- ===================== PAGE HEADER ===================== -->
<div class="page-header">
    <div class="container">
        <h1>Nos Événements</h1>
        <p>Conférences, ateliers, journées de sensibilisation – rejoignez-nous pour agir ensemble</p>
        <nav class="breadcrumb">
            <a href="{{ route('home') }}">Accueil</a>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="width:14px;height:14px"><polyline points="9 18 15 12 9 6"/></svg>
            <span>Nos Événements</span>
        </nav>
    </div>
</div>

<!-- ===================== ÉVÉNEMENTS AVEC TABS ===================== -->
<section class="section">
    <div class="container">

        @php
        /* ---- Upcoming placeholders ---- */
        $defaultUpcoming = [
            [
                'id'          => 1,
                'titre'       => 'Journée de Sensibilisation à l\'Autisme – Abomey-Calavi',
                'lieu'        => 'Abomey-Calavi, Place Publique',
                'heure'       => '09h00 – 17h00',
                'jour'        => '18',
                'mois'        => 'Avr',
                'annee'       => '2026',
                'description' => 'Grande journée de sensibilisation ouverte à tous avec conférences, expositions, activités pour enfants et témoignages de familles. Entrée libre et gratuite.',
                'accent'      => false,
            ],
            [
                'id'          => 2,
                'titre'       => 'Atelier Parents – Mieux comprendre et accompagner mon enfant',
                'lieu'        => 'Cotonou, Siège EVA Autisme',
                'heure'       => '10h00 – 16h00',
                'jour'        => '02',
                'mois'        => 'Mai',
                'annee'       => '2026',
                'description' => 'Atelier pratique d\'une journée pour les parents d\'enfants autistes. Stratégies de communication, gestion du quotidien, partage d\'expériences entre familles. Places limitées à 25 participants.',
                'accent'      => true,
            ],
            [
                'id'          => 3,
                'titre'       => 'Conférence TSA Bénin – Autisme et Société : construire ensemble l\'inclusion',
                'lieu'        => 'Cotonou, Hôtel du Lac',
                'heure'       => '08h30 – 13h00',
                'jour'        => '15',
                'mois'        => 'Juin',
                'annee'       => '2026',
                'description' => 'Conférence nationale réunissant professionnels de santé, acteurs éducatifs, familles et décideurs pour échanger sur l\'état de l\'autisme au Bénin et les pistes d\'amélioration.',
                'accent'      => false,
            ],
        ];
        /* ---- Past placeholders ---- */
        $defaultPast = [
            [
                'id'          => 10,
                'titre'       => 'Journée Mondiale de l\'Autisme – Édition 2025',
                'lieu'        => 'Abomey-Calavi',
                'heure'       => 'Journée entière',
                'jour'        => '02',
                'mois'        => 'Avr',
                'annee'       => '2025',
                'description' => 'Troisième édition de la Journée Mondiale de l\'Autisme organisée par EVA Autisme. Plus de 500 participants, caravane de sensibilisation dans 5 quartiers et concert caritatif.',
                'accent'      => false,
            ],
            [
                'id'          => 11,
                'titre'       => 'Formation Enseignants – Inclusion scolaire et TSA',
                'lieu'        => 'Abomey-Calavi, Centre Communautaire',
                'heure'       => '08h00 – 17h00',
                'jour'        => '22',
                'mois'        => 'Nov',
                'annee'       => '2024',
                'description' => 'Formation de deux jours pour 38 enseignants des communes de l\'Atlantique sur l\'accueil et l\'accompagnement des élèves autistes en classe ordinaire.',
                'accent'      => false,
            ],
        ];
        $upcomingEvents = $upcomingEvents ?? $defaultUpcoming;
        $pastEvents     = $pastEvents     ?? $defaultPast;
        @endphp

        <div class="tabs-wrapper">
            <div class="tabs-nav" role="tablist">
                <button class="tab-btn active" data-tab="upcoming" role="tab" aria-selected="true" aria-controls="upcoming">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:16px;height:16px;display:inline;vertical-align:middle;margin-right:6px"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                    Événements à venir
                    <span style="display:inline-block;background:var(--primary);color:#fff;font-size:0.7rem;font-weight:700;padding:1px 7px;border-radius:10px;margin-left:6px;">{{ count($upcomingEvents) }}</span>
                </button>
                <button class="tab-btn" data-tab="past" role="tab" aria-selected="false" aria-controls="past">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:16px;height:16px;display:inline;vertical-align:middle;margin-right:6px"><polyline points="9 11 12 14 22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
                    Événements passés
                    <span style="display:inline-block;background:#aaa;color:#fff;font-size:0.7rem;font-weight:700;padding:1px 7px;border-radius:10px;margin-left:6px;">{{ count($pastEvents) }}</span>
                </button>
            </div>

            <!-- ONGLET : À VENIR -->
            <div class="tab-content active" id="upcoming" role="tabpanel">
                @forelse($upcomingEvents as $event)
                @php
                    $eid         = is_array($event) ? $event['id']          : $event->id;
                    $etitle      = is_array($event) ? $event['titre']        : $event->titre;
                    $elieu       = is_array($event) ? $event['lieu']         : $event->lieu;
                    $eheure      = is_array($event) ? $event['heure']        : $event->heure;
                    $ejour       = is_array($event) ? $event['jour']         : \Carbon\Carbon::parse($event->date)->format('d');
                    $emois       = is_array($event) ? $event['mois']         : \Carbon\Carbon::parse($event->date)->translatedFormat('M');
                    $eannee      = is_array($event) ? $event['annee']        : \Carbon\Carbon::parse($event->date)->format('Y');
                    $edesc       = is_array($event) ? $event['description']  : $event->description;
                    $eaccent     = is_array($event) ? ($event['accent'] ?? false) : false;
                    $blockBg     = $eaccent ? 'background:var(--accent);' : 'background:var(--primary);';
                    $cardBorder  = $eaccent ? 'border-color:var(--accent);' : '';
                @endphp
                <div class="event-card reveal" id="event-{{ $eid }}" style="{{ $cardBorder }}">
                    <div class="event-date-block" style="{{ $blockBg }}">
                        <div class="day">{{ $ejour }}</div>
                        <div class="month">{{ $emois }}</div>
                        <div style="font-size:0.7rem;opacity:0.8;margin-top:2px;">{{ $eannee }}</div>
                    </div>
                    <div class="event-info">
                        <span class="event-badge badge-upcoming">À venir</span>
                        <h4>{{ $etitle }}</h4>
                        <div class="event-meta">
                            <span>
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                                {{ $eheure }}
                            </span>
                            <span>
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                                {{ $elieu }}
                            </span>
                        </div>
                        <p style="font-size:0.875rem;color:var(--text-muted);line-height:1.6;margin-bottom:1rem;">{{ $edesc }}</p>
                        <button type="button" class="btn btn-blue btn-sm" onclick="openModal('modal-event-{{ $eid }}')">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:14px;height:14px"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
                            S'inscrire
                        </button>
                    </div>
                </div>

                <!-- Modal inscription pour cet événement -->
                <div class="modal-overlay" id="modal-event-{{ $eid }}" role="dialog" aria-modal="true" aria-labelledby="modal-title-{{ $eid }}">
                    <div class="modal-box">
                        <button class="modal-close" onclick="closeModal('modal-event-{{ $eid }}')" aria-label="Fermer">✕</button>
                        <h3 id="modal-title-{{ $eid }}" style="font-size:1.1rem;margin-bottom:0.25rem;padding-right:2rem;">S'inscrire à l'événement</h3>
                        <p style="font-size:0.83rem;color:var(--text-muted);margin-bottom:1.5rem;">{{ $etitle }}</p>

                        @if($errors->any() && old('event_id') == $eid)
                        <div style="background:#fff3f3;border-left:4px solid #dc3545;color:#721c24;padding:0.85rem 1rem;border-radius:var(--radius);margin-bottom:1rem;font-size:0.85rem;">
                            <strong>Erreurs :</strong>
                            <ul style="margin:0.4rem 0 0 1rem;">
                                @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                            </ul>
                        </div>
                        @endif

                        <form action="{{ route('event.register', $eid) }}" method="POST" novalidate>
                            @csrf
                            <input type="hidden" name="event_id" value="{{ $eid }}">

                            <div class="form-row" style="gap:1rem;">
                                <div class="form-group">
                                    <label class="form-label" for="name_{{ $eid }}">Nom complet <span style="color:var(--accent);">*</span></label>
                                    <input type="text" id="name_{{ $eid }}" name="name" class="form-control"
                                           value="{{ old('name') }}" placeholder="Votre nom et prénom" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="email_{{ $eid }}">Email <span style="color:var(--accent);">*</span></label>
                                    <input type="email" id="email_{{ $eid }}" name="email" class="form-control"
                                           value="{{ old('email') }}" placeholder="votre@email.com" required>
                                </div>
                            </div>

                            <div class="form-row" style="gap:1rem;">
                                <div class="form-group">
                                    <label class="form-label" for="phone_{{ $eid }}">Téléphone <span style="color:var(--accent);">*</span></label>
                                    <input type="tel" id="phone_{{ $eid }}" name="phone" class="form-control"
                                           value="{{ old('phone') }}" placeholder="+229 XX XX XX XX" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="nombre_participants_{{ $eid }}">Nombre de participants</label>
                                    <input type="number" id="nombre_participants_{{ $eid }}" name="nombre_participants" class="form-control"
                                           value="{{ old('nombre_participants', 1) }}" min="1" max="20">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="participation_{{ $eid }}">Mode de participation <span style="color:var(--accent);">*</span></label>
                                <select id="participation_{{ $eid }}" name="type_participation" class="form-control" required>
                                    <option value="" disabled {{ old('type_participation') ? '' : 'selected' }}>Choisissez...</option>
                                    <option value="presentiel" {{ old('type_participation') === 'presentiel' ? 'selected' : '' }}>En présentiel</option>
                                    <option value="en_ligne" {{ old('type_participation') === 'en_ligne' ? 'selected' : '' }}>En ligne</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="message_event_{{ $eid }}">Message ou question (optionnel)</label>
                                <textarea id="message_event_{{ $eid }}" name="message" class="form-control" rows="3"
                                          placeholder="Questions, besoins particuliers, informations complémentaires...">{{ old('message') }}</textarea>
                            </div>

                            <div style="margin-top:1.25rem;display:flex;gap:1rem;align-items:center;flex-wrap:wrap;">
                                <button type="submit" class="btn btn-blue" style="padding:0.7rem 1.75rem;">
                                    Confirmer mon inscription
                                </button>
                                <button type="button" onclick="closeModal('modal-event-{{ $eid }}')"
                                        style="background:none;border:none;color:var(--text-muted);cursor:pointer;font-size:0.9rem;">Annuler</button>
                            </div>
                        </form>
                    </div>
                </div>
                @empty
                <div style="text-align:center;padding:3rem;color:var(--text-muted);">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="width:56px;height:56px;opacity:0.3;margin-bottom:1rem;">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/>
                    </svg>
                    <p>Aucun événement à venir pour le moment. Revenez bientôt !</p>
                </div>
                @endforelse
            </div>

            <!-- ONGLET : PASSÉS -->
            <div class="tab-content" id="past" role="tabpanel">
                @forelse($pastEvents as $event)
                @php
                    $eid    = is_array($event) ? $event['id']         : $event->id;
                    $etitle = is_array($event) ? $event['titre']       : $event->titre;
                    $elieu  = is_array($event) ? $event['lieu']        : $event->lieu;
                    $eheure = is_array($event) ? $event['heure']       : $event->heure;
                    $ejour  = is_array($event) ? $event['jour']        : \Carbon\Carbon::parse($event->date)->format('d');
                    $emois  = is_array($event) ? $event['mois']        : \Carbon\Carbon::parse($event->date)->translatedFormat('M');
                    $eannee = is_array($event) ? $event['annee']       : \Carbon\Carbon::parse($event->date)->format('Y');
                    $edesc  = is_array($event) ? $event['description'] : $event->description;
                @endphp
                <div class="event-card reveal" style="border-color:#ccc;opacity:0.9;">
                    <div class="event-date-block" style="background:#999;">
                        <div class="day">{{ $ejour }}</div>
                        <div class="month">{{ $emois }}</div>
                        <div style="font-size:0.7rem;opacity:0.8;margin-top:2px;">{{ $eannee }}</div>
                    </div>
                    <div class="event-info">
                        <span class="event-badge badge-past">Passé</span>
                        <h4>{{ $etitle }}</h4>
                        <div class="event-meta">
                            <span>
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                                {{ $eheure }}
                            </span>
                            <span>
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                                {{ $elieu }}
                            </span>
                        </div>
                        <p style="font-size:0.875rem;color:var(--text-muted);line-height:1.6;margin-bottom:0.5rem;">{{ $edesc }}</p>
                    </div>
                </div>
                @empty
                <div style="text-align:center;padding:3rem;color:var(--text-muted);">
                    <p>Aucun événement passé enregistré.</p>
                </div>
                @endforelse
            </div>
        </div>

    </div>
</section>

<!-- ===================== CTA ===================== -->
<section style="background:linear-gradient(135deg,var(--primary) 0%,#0073e6 100%);padding:70px 0;color:#fff;">
    <div class="container" style="text-align:center;">
        <div class="reveal">
            <h2 style="color:#fff;margin-bottom:1rem;">Restez informé de nos prochains événements</h2>
            <p style="color:rgba(255,255,255,0.85);max-width:540px;margin:0 auto 2rem;">
                Inscrivez-vous à notre newsletter pour ne manquer aucune actualité, formation ou événement d'EVA Autisme.
            </p>
            <div style="display:flex;gap:1rem;justify-content:center;flex-wrap:wrap;">
                <a href="{{ route('contact') }}" class="btn btn-orange" style="font-size:1rem;padding:0.85rem 2rem;">Nous Contacter</a>
                <a href="{{ route('actions.projets') }}" class="btn btn-white" style="font-size:1rem;padding:0.85rem 2rem;">Nos Projets</a>
            </div>
        </div>
    </div>
</section>

@endsection

@section('scripts')
<script>
/* ---- Tabs ---- */
document.querySelectorAll('.tab-btn').forEach(function(btn) {
    btn.addEventListener('click', function() {
        var target = this.getAttribute('data-tab');
        document.querySelectorAll('.tab-btn').forEach(function(b) {
            b.classList.remove('active');
            b.setAttribute('aria-selected', 'false');
        });
        document.querySelectorAll('.tab-content').forEach(function(c) {
            c.classList.remove('active');
        });
        this.classList.add('active');
        this.setAttribute('aria-selected', 'true');
        var panel = document.getElementById(target);
        if (panel) panel.classList.add('active');
    });
});

/* ---- Modal ---- */
function openModal(id) {
    var modal = document.getElementById(id);
    if (modal) {
        modal.classList.add('open');
        document.body.style.overflow = 'hidden';
    }
}
function closeModal(id) {
    var modal = document.getElementById(id);
    if (modal) {
        modal.classList.remove('open');
        document.body.style.overflow = '';
    }
}
/* Fermer modal en cliquant sur l'overlay */
document.querySelectorAll('.modal-overlay').forEach(function(overlay) {
    overlay.addEventListener('click', function(e) {
        if (e.target === this) closeModal(this.id);
    });
});
/* Fermer modal avec Escape */
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        document.querySelectorAll('.modal-overlay.open').forEach(function(m) {
            closeModal(m.id);
        });
    }
});

/* Ré-ouvrir le modal si erreurs de validation */
@if($errors->any() && old('event_id'))
(function() {
    var eid = '{{ old("event_id") }}';
    if (eid) openModal('modal-event-' + eid);
})();
@endif

/* Ré-ouvrir l'onglet "passés" si hash #past */
if (window.location.hash === '#past') {
    document.querySelector('[data-tab="past"]')?.click();
}
</script>
@endsection
