@extends('layouts.app')

@section('title', 'Suivi de votre don')

@section('content')
<section class="section" style="min-height:40vh;"></section>

<div class="pay-modal" id="don-suivi" role="dialog" aria-modal="true" aria-labelledby="pay-modal-title" data-status="{{ $donation->status }}" data-url="{{ route('don.status', $donation->reference) }}">
    <div class="pay-modal-card" aria-live="polite">
        <div data-state="pending" @if($donation->status !== 'pending') hidden @endif>
            <span class="pay-spinner" aria-hidden="true"></span>
            <h1 id="pay-modal-title">Paiement en cours</h1>
            <p>Confirmez votre don de <strong>{{ number_format($donation->montant, 0, ',', ' ') }} F CFA</strong> sur votre téléphone ou sur la page de votre opérateur.</p>
            <p class="pay-modal-hint">Gardez cette fenêtre ouverte, elle se met à jour toute seule.</p>
            <button type="button" class="pay-modal-link" data-recheck hidden>Vérifier maintenant</button>
        </div>

        <div data-state="completed" @if($donation->status !== 'completed') hidden @endif>
            <span class="pay-result is-success" aria-hidden="true">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
            </span>
            <h1>Paiement réussi</h1>
            <p>Merci ! Votre don de <strong>{{ number_format($donation->montant, 0, ',', ' ') }} F CFA</strong> aide directement les enfants autistes et leurs familles au Bénin.</p>
            <a href="{{ route('home') }}" class="btn btn-blue">Retour à l'accueil</a>
        </div>

        <div data-state="failed" @if($donation->status !== 'failed') hidden @endif>
            <span class="pay-result is-failure" aria-hidden="true">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </span>
            <h1>Paiement non abouti</h1>
            <p data-reason>{{ $donation->status === 'failed' ? $donation->failure_message : '' }}</p>
            <a href="{{ route('don') }}" class="btn btn-blue">Réessayer</a>
        </div>

        <p class="pay-modal-ref">Référence : {{ $donation->reference }}</p>
    </div>
</div>
@endsection

@section('scripts')
<script>
(function () {
    const box = document.getElementById('don-suivi');
    if (box.dataset.status !== 'pending') return;

    const FAST_CHECKS = 60;      // 3 min à 3 s d'intervalle
    const SLOW_CHECKS = 72;      // puis 12 min à 10 s
    const recheck = box.querySelector('[data-recheck]');
    let checks = 0;
    let timer;

    const show = (status, reason) => {
        clearTimeout(timer);
        if (reason) box.querySelector('[data-reason]').textContent = reason;
        box.querySelectorAll('[data-state]').forEach(el => { el.hidden = el.dataset.state !== status; });
    };

    const check = async () => {
        try {
            const response = await fetch(box.dataset.url, { headers: { Accept: 'application/json' } });
            if (response.ok) {
                const { status, reason } = await response.json();
                if (status !== 'pending') return show(status, reason);
            }
        } catch (e) { /* nouvel essai au prochain passage */ }

        checks++;
        recheck.hidden = checks < FAST_CHECKS;
        if (checks < FAST_CHECKS + SLOW_CHECKS) {
            timer = setTimeout(check, checks < FAST_CHECKS ? 3000 : 10000);
        }
    };

    recheck.addEventListener('click', () => { clearTimeout(timer); check(); });
    timer = setTimeout(check, 3000);
})();
</script>
@endsection
