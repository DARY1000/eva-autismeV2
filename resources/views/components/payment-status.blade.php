@props(['record', 'statusUrl', 'retryUrl'])
{{-- Fenêtre de suivi d'un paiement, partagée par les dons et la boutique : voir public/js/payment-status.js --}}
<div class="pay-modal" id="pay-status" role="dialog" aria-modal="true" aria-labelledby="pay-modal-title" data-status="{{ $record->status }}" data-url="{{ $statusUrl }}">
    <div class="pay-modal-card" aria-live="polite">
        <div data-state="pending" @if($record->status !== 'pending') hidden @endif>
            <span class="pay-spinner" aria-hidden="true"></span>
            <h1 id="pay-modal-title">Paiement en cours</h1>
            <p>{{ $pending }}</p>
            <p class="pay-modal-hint">Gardez cette fenêtre ouverte, elle se met à jour toute seule.</p>
            <button type="button" class="pay-modal-link" data-recheck hidden>Vérifier maintenant</button>
        </div>

        <div data-state="completed" @if($record->status !== 'completed') hidden @endif>
            <span class="pay-result is-success" aria-hidden="true">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
            </span>
            <h1>Paiement réussi</h1>
            <p>{{ $completed }}</p>
            <a href="{{ route('home') }}" class="btn btn-blue">Retour à l'accueil</a>
        </div>

        <div data-state="failed" @if($record->status !== 'failed') hidden @endif>
            <span class="pay-result is-failure" aria-hidden="true">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </span>
            <h1>Paiement non abouti</h1>
            <p data-reason>{{ $record->status === 'failed' ? $record->failure_message : '' }}</p>
            <a href="{{ $retryUrl }}" class="btn btn-blue">Réessayer</a>
        </div>

        <p class="pay-modal-ref">Référence : {{ $record->reference }}</p>
    </div>
</div>
<script src="{{ asset('js/payment-status.js') }}?v={{ filemtime(public_path('js/payment-status.js')) }}" defer></script>
