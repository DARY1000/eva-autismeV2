{{-- Choix du moyen de paiement, partagé par les dons et la boutique : voir public/js/payment-fields.js --}}
@php
    $countries = \App\Services\FeexPay::COUNTRIES;
    $networks  = \App\Services\FeexPay::availableNetworks();
    $cardReady = config('services.feexpay.card_enabled');
@endphp

<div class="pay" data-pay-fields data-country="{{ old('pays') }}">
    <div class="pay-tabs" role="tablist" aria-label="Type de paiement">
        <button type="button" role="tab" class="pay-tab" data-pay-tab="mobile" aria-selected="true">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><rect x="6" y="2" width="12" height="20" rx="2"/><line x1="11" y1="18" x2="13" y2="18"/></svg>
            Mobile Money
        </button>
        <button type="button" role="tab" class="pay-tab" data-pay-tab="card" aria-selected="false" @disabled(! $cardReady)>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><rect x="2" y="5" width="20" height="14" rx="2"/><line x1="2" y1="10" x2="22" y2="10"/></svg>
            Carte bancaire @unless($cardReady)<small>(bientôt)</small>@endunless
        </button>
    </div>

    <div class="pay-step">
        <label class="pay-step-title" for="pay-country">Votre pays</label>
        <select class="form-control" name="pays" id="pay-country" required>
            @foreach($countries as $code => $country)
                <option value="{{ $code }}" data-dial="{{ $country['dial'] }}" data-example="{{ $country['example'] }}" @selected(old('pays', 'BJ') === $code)>{{ $country['flag'] }} {{ $country['name'] }}</option>
            @endforeach
        </select>
    </div>

    <fieldset class="pay-step" data-pay-operators>
        <legend class="pay-step-title">Opérateur Mobile Money</legend>
        <div class="pay-operators">
            @foreach($networks as $network => $option)
                <label class="pay-operator" data-country="{{ $option['country'] }}" @if($option['redirect'] ?? false) data-redirect="1" @endif>
                    <input type="radio" name="payment_method" value="{{ $network }}" @checked(old('payment_method') === $network)>
                    <span class="pay-operator-tile">
                        <img src="{{ asset('images/payment/'.$option['logo'].'.png') }}?v={{ filemtime(public_path('images/payment/'.$option['logo'].'.png')) }}" alt="" width="58" height="58" loading="lazy">
                        <span>{{ $option['label'] }}</span>
                    </span>
                </label>
            @endforeach
        </div>
        <small class="pay-redirect-note" data-pay-redirect-note hidden>Vous serez dirigé vers la page de votre opérateur pour payer.</small>
    </fieldset>

    @if($cardReady)
        <input type="radio" name="payment_method" value="card" data-pay-card hidden @checked(old('payment_method') === 'card')>
    @endif

    <div class="pay-step">
        <label class="pay-step-title" for="pay-phone">Votre numéro</label>
        <div class="pay-phone">
            <span data-pay-dial>+229</span>
            <input type="tel" class="form-control" name="telephone" id="pay-phone" inputmode="tel" autocomplete="tel-national" value="{{ old('telephone') }}" placeholder="01 97 00 00 00" required>
        </div>
    </div>
</div>
<script src="{{ asset('js/payment-fields.js') }}?v={{ filemtime(public_path('js/payment-fields.js')) }}" defer></script>
