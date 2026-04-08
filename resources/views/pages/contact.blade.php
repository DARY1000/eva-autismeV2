@extends('layouts.app')

@section('title', 'Contactez-nous')
@section('meta_description', 'Contactez l\'ONG EVA Autisme. Soutenez nos projets, devenez partenaire ou bénévole. Abomey-Calavi, Bénin.')

@section('content')

<section class="page-header">
    <div class="container" style="position:relative;z-index:1;">
        <h1 style="color:#fff;">Contactez-nous</h1>
        <p style="color:rgba(255,255,255,0.88);max-width:600px;margin-top:0.75rem;">Une question, un projet de partenariat ou souhaitez-vous rejoindre notre équipe de bénévoles ? Nous sommes à votre écoute.</p>
        <nav class="breadcrumb" aria-label="Fil d'Ariane">
            <a href="{{ route('home') }}" style="color:rgba(255,255,255,0.88);">Accueil</a>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg>
            <span style="color:rgba(255,255,255,0.72);">Contactez-nous</span>
        </nav>
    </div>
</section>

<!-- ====== 3 CARTES D'ACTION ====== -->
<section class="section-sm" style="padding:3rem 0;">
    <div class="container">
        <div class="section-header reveal" style="margin-bottom:2.5rem;">
            <span class="label">Agissons ensemble</span>
            <h2>Comment nous soutenir ?</h2>
            <div class="section-divider"></div>
        </div>
        <div class="contact-cards">

            <div class="contact-card reveal">
                <div class="contact-card-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" style="width:36px;height:36px;">
                        <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
                    </svg>
                </div>
                <h3>Soutenir nos projets</h3>
                <p>Votre don nous permet de financer nos programmes d'accompagnement et de sensibilisation. Chaque contribution, même modeste, change une vie !</p>
                <a href="{{ route('don') }}" class="contact-card-btn">Faire un Don</a>
            </div>

            <div class="contact-card reveal">
                <div class="contact-card-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" style="width:36px;height:36px;">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                        <circle cx="9" cy="7" r="4"/>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                    </svg>
                </div>
                <h3>Devenir Partenaire de l'Association</h3>
                <p>Rejoignez notre réseau de partenaires institutionnels, financiers ou techniques. Ensemble, amplifions notre impact pour les enfants autistes du Bénin.</p>
                <a href="#formulaire-contact" class="contact-card-btn scroll-to-form" data-subject="Devenir partenaire">Devenir Partenaire</a>
            </div>

            <div class="contact-card reveal">
                <div class="contact-card-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" style="width:36px;height:36px;">
                        <circle cx="12" cy="8" r="4"/>
                        <path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/>
                    </svg>
                </div>
                <h3>Devenir Bénévole</h3>
                <p>Engagez-vous avec nous en tant que bénévole. Votre temps, vos compétences et votre énergie sont précieux pour nos actions sur le terrain.</p>
                <a href="#formulaire-contact" class="contact-card-btn scroll-to-form" data-subject="Devenir bénévole">Devenir Bénévole</a>
            </div>

        </div>
    </div>
</section>

<!-- ====== COORDONNÉES ====== -->
<section class="section bg-light">
    <div class="container">
        <div class="grid-2" style="gap:3rem;align-items:start;">
            <div class="reveal">
                <div class="section-header" style="text-align:left;margin-bottom:2rem;">
                    <span class="label">Nos coordonnées</span>
                    <h2>Où nous trouver ?</h2>
                    <div class="section-divider" style="margin-left:0;"></div>
                </div>
                <div style="display:flex;flex-direction:column;gap:1.5rem;">
                    <div style="display:flex;gap:1rem;align-items:flex-start;">
                        <div style="width:44px;height:44px;background:var(--primary-light);border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                            <svg viewBox="0 0 24 24" fill="none" stroke="var(--primary)" stroke-width="2" style="width:20px;height:20px"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        </div>
                        <div><h4 style="font-size:0.95rem;margin-bottom:0.2rem;">Adresse</h4><p style="font-size:0.87rem;">Abomey-Calavi, Département de l'Atlantique<br>République du Bénin</p></div>
                    </div>
                    <div style="display:flex;gap:1rem;align-items:flex-start;">
                        <div style="width:44px;height:44px;background:var(--primary-light);border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                            <svg viewBox="0 0 24 24" fill="none" stroke="var(--primary)" stroke-width="2" style="width:20px;height:20px"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12 19.79 19.79 0 0 1 1.61 3.37 2 2 0 0 1 3.6 1h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 8.6a16 16 0 0 0 6 6l.96-.96a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                        </div>
                        <div><h4 style="font-size:0.95rem;margin-bottom:0.2rem;">Téléphone / WhatsApp</h4><a href="tel:+22901951738038" style="font-size:0.87rem;color:var(--primary);font-weight:600;">+229 01 95 17 38 38</a></div>
                    </div>
                    <div style="display:flex;gap:1rem;align-items:flex-start;">
                        <div style="width:44px;height:44px;background:var(--primary-light);border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                            <svg viewBox="0 0 24 24" fill="none" stroke="var(--primary)" stroke-width="2" style="width:20px;height:20px"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                        </div>
                        <div><h4 style="font-size:0.95rem;margin-bottom:0.2rem;">Email</h4><a href="mailto:infos@eva-autisme.org" style="font-size:0.87rem;color:var(--primary);font-weight:600;">infos@eva-autisme.org</a></div>
                    </div>
                    <div style="display:flex;gap:1rem;align-items:flex-start;">
                        <div style="width:44px;height:44px;background:var(--primary-light);border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                            <svg viewBox="0 0 24 24" fill="none" stroke="var(--primary)" stroke-width="2" style="width:20px;height:20px"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                        </div>
                        <div><h4 style="font-size:0.95rem;margin-bottom:0.2rem;">Horaires</h4><p style="font-size:0.87rem;">Lundi – Vendredi : 8h00 – 17h00<br>Samedi : 9h00 – 13h00</p></div>
                    </div>
                </div>
            </div>
            <div class="reveal">
                <div style="background:#e8edf5;border-radius:var(--radius-lg);height:350px;display:flex;flex-direction:column;align-items:center;justify-content:center;border:1px solid var(--border);">
                    <svg viewBox="0 0 24 24" fill="none" stroke="var(--primary)" stroke-width="1.5" style="width:64px;height:64px;opacity:0.4;"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    <p style="margin-top:1rem;font-weight:600;color:var(--primary);">Abomey-Calavi, Bénin</p>
                    <a href="https://maps.google.com/?q=Abomey-Calavi,Benin" target="_blank" rel="noopener" class="btn btn-blue btn-sm" style="margin-top:1rem;">Ouvrir dans Google Maps</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ====== FORMULAIRE ====== -->
<section class="section" id="formulaire-contact">
    <div class="container-sm">
        <div class="section-header reveal">
            <span class="label">Envoyez-nous un message</span>
            <h2>Formulaire de Contact</h2>
            <div class="section-divider"></div>
        </div>
        <div style="background:#fff;border-radius:var(--radius-lg);padding:2.5rem;border:1px solid var(--border);box-shadow:var(--shadow-sm);margin-top:2.5rem;" class="reveal">
            @if($errors->any())
            <div class="alert alert-error" style="margin-bottom:1.5rem;">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                <div>@foreach($errors->all() as $e)<div>{{ $e }}</div>@endforeach</div>
            </div>
            @endif
            <form action="{{ route('contact.send') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label class="form-label" for="sujet">Objet de votre message <span>*</span></label>
                    <select class="form-control" name="subject" id="sujet" required>
                        <option value="">-- Sélectionnez un objet --</option>
                        <option value="Renseignements généraux"  {{ old('subject')=='Renseignements généraux'?'selected':'' }}>Renseignements généraux</option>
                        <option value="Devenir partenaire"       {{ old('subject')=='Devenir partenaire'?'selected':'' }}>Devenir partenaire</option>
                        <option value="Devenir bénévole"         {{ old('subject')=='Devenir bénévole'?'selected':'' }}>Devenir bénévole</option>
                        <option value="Faire un don"             {{ old('subject')=='Faire un don'?'selected':'' }}>Faire un don</option>
                        <option value="Formation"                {{ old('subject')=='Formation'?'selected':'' }}>Formation</option>
                        <option value="Événements"               {{ old('subject')=='Événements'?'selected':'' }}>Événements</option>
                        <option value="Autre"                    {{ old('subject')=='Autre'?'selected':'' }}>Autre</option>
                    </select>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="prenom">Prénom <span>*</span></label>
                        <input type="text" class="form-control" name="prenom" id="prenom" placeholder="Votre prénom" value="{{ old('prenom') }}" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="nom">Nom <span>*</span></label>
                        <input type="text" class="form-control" name="nom" id="nom" placeholder="Votre nom" value="{{ old('nom') }}" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="email_c">Email <span>*</span></label>
                        <input type="email" class="form-control" name="email" id="email_c" placeholder="votre@email.com" value="{{ old('email') }}" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="tel_c">Téléphone</label>
                        <input type="tel" class="form-control" name="telephone" id="tel_c" placeholder="+229 XX XX XX XX" value="{{ old('telephone') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label" for="org">Organisation / Entreprise (optionnel)</label>
                    <input type="text" class="form-control" name="organization" id="org" placeholder="Nom de votre organisation" value="{{ old('organization') }}">
                </div>
                <div class="form-group">
                    <label class="form-label" for="msg">Message <span>*</span></label>
                    <textarea class="form-control" name="message" id="msg" placeholder="Décrivez votre demande..." required>{{ old('message') }}</textarea>
                </div>
                <div style="display:flex;align-items:center;gap:0.75rem;margin-top:0.5rem;">
                    <button type="submit" class="btn btn-blue btn-lg">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:18px;height:18px"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
                        Envoyer le message
                    </button>
                    <span style="font-size:0.8rem;color:var(--text-light);">Réponse sous 48h.</span>
                </div>
            </form>
        </div>
    </div>
</section>

@endsection

@section('scripts')
<script>
document.querySelectorAll('.scroll-to-form').forEach(btn => {
    btn.addEventListener('click', e => {
        e.preventDefault();
        const subject = btn.dataset.subject;
        const sel = document.getElementById('sujet');
        if (sel && subject) {
            for (let opt of sel.options) {
                if (opt.value === subject) { opt.selected = true; break; }
            }
        }
        document.getElementById('formulaire-contact').scrollIntoView({ behavior: 'smooth' });
    });
});
</script>
@endsection
