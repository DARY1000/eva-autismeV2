@extends('layouts.app')

@section('title', 'Finaliser ma commande')

@section('content')

<section class="section bg-light">
    <div class="container-sm">
        <h1 class="shop-title">Finaliser ma commande</h1>

        <div class="shop-checkout">
            @if($errors->any())
                <div class="alert alert-error" style="margin-bottom:1.5rem;">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/></svg>
                    <div>@foreach($errors->all() as $e)<div>{{ $e }}</div>@endforeach</div>
                </div>
            @endif

            <div class="shop-recap">
                @foreach($lines as $line)
                    <div><span>{{ $line->quantity }} × {{ $line->product->name }}</span><span>{{ number_format($line->subtotal, 0, ',', ' ') }} F</span></div>
                @endforeach
                <div class="shop-total"><span>Total</span><strong>{{ number_format($total, 0, ',', ' ') }} F CFA</strong></div>
            </div>

            <form action="{{ route('boutique.commande.store') }}" method="POST">
                @csrf
                <x-form-guard />

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="prenom">Prénom <span>*</span></label>
                        <input type="text" class="form-control" name="prenom" id="prenom" autocomplete="given-name" value="{{ old('prenom') }}" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="nom">Nom <span>*</span></label>
                        <input type="text" class="form-control" name="nom" id="nom" autocomplete="family-name" value="{{ old('nom') }}" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label" for="email">Email <span>*</span></label>
                    <input type="email" class="form-control" name="email" id="email" autocomplete="email" value="{{ old('email') }}" required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="delivery_mode">Remise de la commande <span>*</span></label>
                    <select class="form-control" name="delivery_mode" id="delivery_mode" required>
                        @foreach(\App\Models\Order::DELIVERY_MODES as $mode => $label)
                            <option value="{{ $mode }}" @selected(old('delivery_mode') === $mode)>{{ $label }}</option>
                        @endforeach
                    </select>
                    <small class="shop-hint">Nous vous contactons après le paiement pour organiser la remise. Les frais de livraison éventuels ne sont pas inclus dans le total : nous vous les indiquerons avant l'envoi.</small>
                </div>
                <div class="form-group">
                    <label class="form-label" for="ville">Ville <span>*</span></label>
                    <input type="text" class="form-control" name="ville" id="ville" autocomplete="address-level2" value="{{ old('ville') }}" required>
                </div>
                <div class="form-group" id="adresse-group">
                    <label class="form-label" for="adresse">Adresse de livraison <span>*</span></label>
                    <input type="text" class="form-control" name="adresse" id="adresse" autocomplete="street-address" value="{{ old('adresse') }}">
                </div>

                <x-payment-fields />

                <div class="form-group">
                    <label class="form-label" for="note">Précisions (optionnel)</label>
                    <textarea class="form-control" name="note" id="note">{{ old('note') }}</textarea>
                </div>

                <button type="submit" class="btn btn-lg" style="width:100%;justify-content:center;background:var(--primary);color:#fff;border-radius:30px;">Payer {{ number_format($total, 0, ',', ' ') }} F CFA</button>
                <p style="font-size:0.8rem;color:var(--text-muted);text-align:center;margin:0.85rem 0 0;"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" style="width:15px;height:15px;vertical-align:-3px;margin-right:3px;color:#16a34a;"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><polyline points="9 12 11 14 15 10"/></svg>Paiement sécurisé. Vous validez le montant sur votre téléphone ou sur la page de votre opérateur.</p>
            </form>
        </div>
    </div>
</section>

@endsection

@section('scripts')
<script>
(function () {
    const mode = document.getElementById('delivery_mode');
    const group = document.getElementById('adresse-group');
    const address = document.getElementById('adresse');
    const refresh = () => {
        const delivered = mode.value === 'livraison';
        group.hidden = !delivered;
        address.required = delivered;
    };
    mode.addEventListener('change', refresh);
    refresh();
})();
</script>
@endsection
