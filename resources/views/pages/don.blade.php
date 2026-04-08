@extends('layouts.app')

@section('title', 'Faire un Don')
@section('meta_description', 'Soutenez l\'ONG EVA Autisme par un don. Chaque contribution aide les enfants autistes et leurs familles au Bénin.')

@section('content')

<section style="background:linear-gradient(135deg,var(--primary) 0%,#0073e6 100%);padding:5rem 0 4rem;color:#fff;text-align:center;">
    <div class="container">
        <div class="reveal">
            <span style="display:inline-block;background:rgba(255,255,255,0.15);color:#fff;font-size:0.75rem;font-weight:700;letter-spacing:2px;text-transform:uppercase;padding:4px 14px;border-radius:30px;margin-bottom:1rem;">Soutenir EVA Autisme</span>
            <h1 style="color:#fff;margin-bottom:1rem;">Chaque don <span style="color:#ffe066;">compte</span></h1>
            <p style="color:rgba(255,255,255,0.88);font-size:1.1rem;max-width:580px;margin:0 auto;">Votre générosité permet à l'ONG EVA Autisme de poursuivre ses actions pour l'inclusion et l'accompagnement des enfants autistes au Bénin.</p>
        </div>
    </div>
</section>

<!-- Impact des dons -->
<section class="section-sm" style="padding:3rem 0;background:#fff;">
    <div class="container">
        <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:1.5rem;" class="reveal">
            <div style="background:var(--primary-light);border-radius:var(--radius-lg);padding:1.75rem;text-align:center;border:1px solid rgba(0,85,165,0.15);">
                <div style="font-size:1.8rem;font-weight:800;color:var(--primary);margin-bottom:0.4rem;">5 000 F</div>
                <div style="font-size:0.87rem;color:var(--text-mid);">Matériel éducatif pour 1 enfant autiste pendant un mois</div>
            </div>
            <div style="background:#fff0eb;border-radius:var(--radius-lg);padding:1.75rem;text-align:center;border:1px solid rgba(232,80,26,0.15);">
                <div style="font-size:1.8rem;font-weight:800;color:var(--accent);margin-bottom:0.4rem;">15 000 F</div>
                <div style="font-size:0.87rem;color:var(--text-mid);">Financement d'une séance thérapeutique pour un enfant</div>
            </div>
            <div style="background:#e8f5e9;border-radius:var(--radius-lg);padding:1.75rem;text-align:center;border:1px solid rgba(39,174,96,0.15);">
                <div style="font-size:1.8rem;font-weight:800;color:#27ae60;margin-bottom:0.4rem;">50 000 F</div>
                <div style="font-size:0.87rem;color:var(--text-mid);">Accompagnement complet d'une famille pendant 1 mois</div>
            </div>
        </div>
    </div>
</section>

<!-- Formulaire de don -->
<section class="section bg-light">
    <div class="container-sm">
        <div class="section-header reveal">
            <span class="label">Votre Don</span>
            <h2>Faire un Don</h2>
            <div class="section-divider"></div>
        </div>
        <div style="background:#fff;border-radius:var(--radius-lg);padding:2.5rem;border:1px solid var(--border);box-shadow:var(--shadow-sm);margin-top:2.5rem;" class="reveal">

            @if($errors->any())
            <div class="alert alert-error" style="margin-bottom:1.5rem;">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/></svg>
                <div>@foreach($errors->all() as $e)<div>{{ $e }}</div>@endforeach</div>
            </div>
            @endif

            <!-- Sélecteur de devise -->
            <div class="form-group">
                <label class="form-label">Devise</label>
                <div style="display:flex;gap:0.5rem;flex-wrap:wrap;margin-bottom:1.25rem;" id="currency-btns">
                    <button type="button" class="currency-btn active" data-currency="XOF" data-symbol="F CFA" data-amounts="5000,10000,15000,25000,50000,100000" data-placeholder="Ex: 5000" data-min="500">
                        🇧🇯 FCFA
                    </button>
                    <button type="button" class="currency-btn" data-currency="EUR" data-symbol="€" data-amounts="5,10,20,50,100,200" data-placeholder="Ex: 20" data-min="1">
                        🇪🇺 Euro (€)
                    </button>
                    <button type="button" class="currency-btn" data-currency="USD" data-symbol="$" data-amounts="5,10,20,50,100,200" data-placeholder="Ex: 20" data-min="1">
                        🇺🇸 Dollar ($)
                    </button>
                    <button type="button" class="currency-btn" data-currency="GBP" data-symbol="£" data-amounts="5,10,20,50,100" data-placeholder="Ex: 20" data-min="1">
                        🇬🇧 Livre (£)
                    </button>
                </div>
            </div>

            <!-- Montants suggérés -->
            <div class="form-group">
                <label class="form-label" id="amounts-label">Choisissez un montant</label>
                <div style="display:flex;gap:0.75rem;flex-wrap:wrap;margin-bottom:1rem;" id="amount-btns">
                    <button type="button" class="btn btn-white-light amount-btn" data-amount="5000">5 000 F CFA</button>
                    <button type="button" class="btn btn-white-light amount-btn" data-amount="10000">10 000 F CFA</button>
                    <button type="button" class="btn btn-white-light amount-btn" data-amount="15000">15 000 F CFA</button>
                    <button type="button" class="btn btn-white-light amount-btn" data-amount="25000">25 000 F CFA</button>
                    <button type="button" class="btn btn-white-light amount-btn" data-amount="50000">50 000 F CFA</button>
                    <button type="button" class="btn btn-white-light amount-btn" data-amount="100000">100 000 F CFA</button>
                </div>
            </div>

            <form action="{{ route('don.process') }}" method="POST" id="don-form">
                @csrf

                <!-- Montant + devise -->
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="montant">Montant <span>*</span> <span id="devise-label" style="color:var(--primary);font-weight:700;">(F CFA)</span></label>
                        <input type="number" class="form-control" name="montant" id="montant" placeholder="Ex: 5000" min="500" value="{{ old('montant') }}" required>
                        <input type="hidden" name="devise" id="devise-input" value="XOF">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="frequence">Fréquence <span>*</span></label>
                        <select class="form-control" name="frequence" id="frequence" required>
                            <option value="ponctuel" {{ old('frequence','ponctuel')=='ponctuel'?'selected':'' }}>Don ponctuel</option>
                            <option value="mensuel"  {{ old('frequence')=='mensuel'?'selected':'' }}>Don mensuel (récurrent)</option>
                        </select>
                    </div>
                </div>

                <!-- Mode de paiement -->
                <div class="form-group">
                    <label class="form-label">Mode de paiement <span>*</span></label>
                    <div class="form-row" style="margin-top:0.5rem;" id="payment-methods">
                        <label class="payment-option" for="pay-mobile">
                            <input type="radio" name="payment_method" id="pay-mobile" value="mobile_money" checked>
                            <span class="payment-option-inner">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:24px;height:24px"><rect x="5" y="2" width="14" height="20" rx="2" ry="2"/><line x1="12" y1="18" x2="12.01" y2="18"/></svg>
                                <span>
                                    <strong>Mobile Money</strong>
                                    <small>MTN, Moov, Orange</small>
                                </span>
                            </span>
                        </label>
                        <label class="payment-option" for="pay-card">
                            <input type="radio" name="payment_method" id="pay-card" value="carte_bancaire">
                            <span class="payment-option-inner">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:24px;height:24px"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg>
                                <span>
                                    <strong>Carte bancaire</strong>
                                    <small>Visa, Mastercard</small>
                                </span>
                            </span>
                        </label>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="don_prenom">Prénom <span>*</span></label>
                        <input type="text" class="form-control" name="prenom" id="don_prenom" placeholder="Votre prénom" value="{{ old('prenom') }}" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="don_nom">Nom <span>*</span></label>
                        <input type="text" class="form-control" name="nom" id="don_nom" placeholder="Votre nom" value="{{ old('nom') }}" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="don_email">Email <span>*</span></label>
                        <input type="email" class="form-control" name="email" id="don_email" placeholder="votre@email.com" value="{{ old('email') }}" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="don_tel">Téléphone <span>*</span></label>
                        <input type="tel" class="form-control" name="telephone" id="don_tel" placeholder="+229 XX XX XX XX" value="{{ old('telephone') }}" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label" for="don_pays">Pays</label>
                    <input type="text" class="form-control" name="pays" id="don_pays" placeholder="Bénin" value="{{ old('pays', 'Bénin') }}">
                </div>
                <div class="form-group">
                    <label class="form-label" for="don_msg">Message (optionnel)</label>
                    <textarea class="form-control" name="message" id="don_msg" placeholder="Un message d'encouragement ?">{{ old('message') }}</textarea>
                </div>

                <div style="background:var(--primary-light);border-radius:var(--radius);padding:1.25rem;margin-bottom:1.5rem;border-left:4px solid var(--primary);">
                    <p style="font-size:0.85rem;color:var(--text-mid);margin:0;">
                        <strong style="color:var(--primary);">Paiement sécurisé via FedaPay :</strong> Après validation, vous serez redirigé vers notre interface de paiement sécurisée. Nous acceptons Mobile Money (MTN, Moov, Orange), cartes Visa et Mastercard.
                    </p>
                </div>

                <button type="submit" class="btn btn-lg" style="width:100%;justify-content:center;background:var(--primary);color:#fff;border-radius:30px;font-size:1rem;">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:18px;height:18px"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
                    Procéder au paiement
                </button>
            </form>
        </div>
    </div>
</section>

<!-- Autres façons de soutenir -->
<section class="section">
    <div class="container">
        <div class="section-header reveal">
            <span class="label">Autres formes de soutien</span>
            <h2>D'autres façons de nous aider</h2>
            <div class="section-divider"></div>
        </div>
        <div class="grid-3" style="margin-top:2.5rem;">
            <div class="feature-card reveal">
                <div class="feature-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><line x1="23" y1="11" x2="17" y2="11"/><line x1="20" y1="8" x2="20" y2="14"/></svg></div>
                <h3>Parrainage d'enfant</h3>
                <p>Parrainezun enfant autiste pour financer son accompagnement thérapeutique et éducatif sur toute une année.</p>
                <a href="{{ route('contact') }}" class="btn btn-blue btn-sm" style="margin-top:1rem;">En savoir plus</a>
            </div>
            <div class="feature-card reveal">
                <div class="feature-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg></div>
                <h3>Mécénat d'entreprise</h3>
                <p>Intégrez l'ONG EVA Autisme dans votre politique RSE et soutenez des projets d'inclusion sociale mesurables.</p>
                <a href="{{ route('contact') }}" class="btn btn-blue btn-sm" style="margin-top:1rem;">Nous contacter</a>
            </div>
            <div class="feature-card reveal">
                <div class="feature-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 7H4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg></div>
                <h3>Don en nature</h3>
                <p>Matériel éducatif, équipements informatiques, fournitures de bureau ou logistique : tout don en nature est le bienvenu.</p>
                <a href="{{ route('contact') }}" class="btn btn-blue btn-sm" style="margin-top:1rem;">Nous contacter</a>
            </div>
        </div>
    </div>
</section>

<!-- Transparence & Impact -->
<section class="section" style="background:#fff;padding:4rem 0;">
    <div class="container">
        <div class="section-header reveal">
            <span class="label">Transparence & Impact</span>
            <h2>À quoi servent vos dons ?</h2>
            <div class="section-divider"></div>
        </div>
        <div class="grid-2 reveal" style="gap:3rem;align-items:start;margin-top:2.5rem;">
            <div>
                <ul style="list-style:none;padding:0;display:flex;flex-direction:column;gap:0.9rem;">
                    <li style="display:flex;gap:0.75rem;align-items:flex-start;">
                        <span style="width:22px;height:22px;background:var(--green);border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;margin-top:2px;">
                            <svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="3" style="width:12px;height:12px"><polyline points="20 6 9 17 4 12"/></svg>
                        </span>
                        <span style="font-size:0.93rem;color:var(--text-mid);line-height:1.5;">Sensibiliser à l'autisme le grand public au Bénin</span>
                    </li>
                    <li style="display:flex;gap:0.75rem;align-items:flex-start;">
                        <span style="width:22px;height:22px;background:var(--green);border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;margin-top:2px;">
                            <svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="3" style="width:12px;height:12px"><polyline points="20 6 9 17 4 12"/></svg>
                        </span>
                        <span style="font-size:0.93rem;color:var(--text-mid);line-height:1.5;">Contribuer à assurer aux personnes autistes une vie pleinement humaine et une insertion sociale</span>
                    </li>
                    <li style="display:flex;gap:0.75rem;align-items:flex-start;">
                        <span style="width:22px;height:22px;background:var(--green);border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;margin-top:2px;">
                            <svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="3" style="width:12px;height:12px"><polyline points="20 6 9 17 4 12"/></svg>
                        </span>
                        <span style="font-size:0.93rem;color:var(--text-mid);line-height:1.5;">Former des accompagnateurs spécialisés dans les troubles du spectre de l'autisme</span>
                    </li>
                    <li style="display:flex;gap:0.75rem;align-items:flex-start;">
                        <span style="width:22px;height:22px;background:var(--green);border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;margin-top:2px;">
                            <svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="3" style="width:12px;height:12px"><polyline points="20 6 9 17 4 12"/></svg>
                        </span>
                        <span style="font-size:0.93rem;color:var(--text-mid);line-height:1.5;">Financer le suivi et l'encadrement des accompagnants auprès des familles</span>
                    </li>
                    <li style="display:flex;gap:0.75rem;align-items:flex-start;">
                        <span style="width:22px;height:22px;background:var(--green);border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;margin-top:2px;">
                            <svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="3" style="width:12px;height:12px"><polyline points="20 6 9 17 4 12"/></svg>
                        </span>
                        <span style="font-size:0.93rem;color:var(--text-mid);line-height:1.5;">Aider et soutenir les parents d'enfants ayant un trouble du spectre de l'autisme</span>
                    </li>
                    <li style="display:flex;gap:0.75rem;align-items:flex-start;">
                        <span style="width:22px;height:22px;background:var(--green);border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;margin-top:2px;">
                            <svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="3" style="width:12px;height:12px"><polyline points="20 6 9 17 4 12"/></svg>
                        </span>
                        <span style="font-size:0.93rem;color:var(--text-mid);line-height:1.5;">Promouvoir l'intégration en milieu ordinaire et les techniques éducatives adaptées aux TSA</span>
                    </li>
                    <li style="display:flex;gap:0.75rem;align-items:flex-start;">
                        <span style="width:22px;height:22px;background:var(--primary);border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;margin-top:2px;">
                            <svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="3" style="width:12px;height:12px"><polyline points="20 6 9 17 4 12"/></svg>
                        </span>
                        <span style="font-size:0.93rem;color:var(--text-mid);line-height:1.5;">Mettre en place un centre de jour et logement adapté pour personnes en situation de handicap mental au Bénin</span>
                    </li>
                </ul>
            </div>
            <div style="display:flex;flex-direction:column;gap:1.5rem;">
                <!-- Avantage fiscal Europe -->
                <div style="background:var(--primary-light);border-radius:var(--radius-lg);padding:1.75rem;border:1px solid rgba(0,85,165,0.15);">
                    <div style="display:flex;align-items:center;gap:0.75rem;margin-bottom:1rem;">
                        <span style="font-size:1.5rem;">🇪🇺</span>
                        <h4 style="margin:0;font-size:1rem;color:var(--primary);">Avantage fiscal — Donateurs européens</h4>
                    </div>
                    <p style="font-size:0.88rem;color:var(--text-mid);margin-bottom:0.75rem;line-height:1.6;">
                        Tous les dons d'<strong>au moins 40 €</strong> peuvent être exonérés d'impôts selon votre pays de résidence.
                    </p>
                    <p style="font-size:0.85rem;color:var(--text-mid);line-height:1.6;">
                        <strong style="color:var(--primary);">EVA AUTISME</strong> vous adressera dans le courant du 1<sup>er</sup> trimestre de l'année suivante l'attestation fiscale à joindre à votre déclaration, pour les versements effectués avec la mention <em>"don EVA AUTISME"</em>.
                    </p>
                </div>
                <!-- Avantage fiscal Bénin -->
                <div style="background:#e8f5e9;border-radius:var(--radius-lg);padding:1.75rem;border:1px solid rgba(29,185,106,0.2);">
                    <div style="display:flex;align-items:center;gap:0.75rem;margin-bottom:1rem;">
                        <span style="font-size:1.5rem;">🇧🇯</span>
                        <h4 style="margin:0;font-size:1rem;color:#1a7a45;">Soutien & Transparence — Bénin</h4>
                    </div>
                    <p style="font-size:0.88rem;color:var(--text-mid);line-height:1.6;">
                        Chaque don reçu au Bénin est utilisé directement pour nos programmes. L'ONG EVA Autisme est enregistrée et rend compte annuellement de l'utilisation des fonds à ses membres et partenaires.
                    </p>
                    <p style="font-size:0.85rem;color:var(--text-mid);margin-top:0.5rem;">
                        Pour toute question sur l'utilisation des fonds : <a href="mailto:infos@eva-autisme.org" style="color:var(--green);font-weight:600;">infos@eva-autisme.org</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('scripts')
<script>
// Amount buttons
document.querySelectorAll('.amount-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        document.querySelectorAll('.amount-btn').forEach(b => {
            b.classList.remove('btn-blue'); b.classList.add('btn-white-light');
        });
        btn.classList.add('btn-blue'); btn.classList.remove('btn-white-light');
        document.getElementById('montant').value = btn.dataset.amount;
    });
});

// Currency selector
document.querySelectorAll('.currency-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        document.querySelectorAll('.currency-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');

        const symbol   = btn.dataset.symbol;
        const amounts  = btn.dataset.amounts.split(',');
        const currency = btn.dataset.currency;
        const placeholder = btn.dataset.placeholder;
        const min = btn.dataset.min;

        // Update hidden currency field
        document.getElementById('devise-input').value = currency;
        document.getElementById('devise-label').textContent = '(' + symbol + ')';
        document.getElementById('montant').placeholder = placeholder;
        document.getElementById('montant').min = min;
        document.getElementById('montant').value = '';

        // Rebuild amount buttons
        const container = document.getElementById('amount-btns');
        container.innerHTML = '';
        amounts.forEach(amt => {
            const b = document.createElement('button');
            b.type = 'button';
            b.className = 'btn btn-white-light amount-btn';
            b.dataset.amount = amt;
            const num = parseFloat(amt);
            b.textContent = num.toLocaleString('fr-FR') + ' ' + symbol;
            b.addEventListener('click', () => {
                container.querySelectorAll('.amount-btn').forEach(x => { x.classList.remove('btn-blue'); x.classList.add('btn-white-light'); });
                b.classList.add('btn-blue'); b.classList.remove('btn-white-light');
                document.getElementById('montant').value = amt;
            });
            container.appendChild(b);
        });
    });
});
</script>
@endsection
