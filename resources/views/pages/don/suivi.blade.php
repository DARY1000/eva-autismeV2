@extends('layouts.app')

@section('title', 'Suivi de votre don')

@section('content')
<section class="section">
    <div class="container-sm" style="max-width:560px;text-align:center;" id="don-suivi" data-status="{{ $donation->status }}" data-url="{{ route('don.status', $donation->reference) }}">
        <div data-state="pending" @if($donation->status !== 'pending') hidden @endif>
            <h1 style="font-size:1.8rem;">Validez votre paiement</h1>
            <p>Votre don de <strong>{{ number_format($donation->montant, 0, ',', ' ') }} FCFA</strong> attend votre confirmation sur votre téléphone ou sur la page de votre opérateur.</p>
            <p style="color:var(--text-muted);font-size:0.9rem;" role="status">Cette page se met à jour automatiquement.</p>
        </div>
        <div data-state="completed" @if($donation->status !== 'completed') hidden @endif>
            <h1 style="font-size:1.8rem;">Merci pour votre don !</h1>
            <p>Votre don de <strong>{{ number_format($donation->montant, 0, ',', ' ') }} FCFA</strong> a bien été reçu. Il aide directement les enfants autistes et leurs familles au Bénin.</p>
            <a href="{{ route('home') }}" class="btn btn-blue">Retour à l'accueil</a>
        </div>
        <div data-state="failed" @if($donation->status !== 'failed') hidden @endif>
            <h1 style="font-size:1.8rem;">Le paiement n'a pas abouti</h1>
            <p>Aucune somme n'a été débitée. Vérifiez votre solde ou votre numéro, puis réessayez.</p>
            <a href="{{ route('don') }}" class="btn btn-blue">Réessayer</a>
        </div>
        <p style="color:var(--text-muted);font-size:0.8rem;margin-top:2rem;">Référence : {{ $donation->reference }}</p>
    </div>
</section>
@endsection

@section('scripts')
<script>
(function () {
    const box = document.getElementById('don-suivi');
    if (box.dataset.status !== 'pending') return;

    const show = status => box.querySelectorAll('[data-state]').forEach(el => {
        el.hidden = el.dataset.state !== status;
    });

    let tries = 0;
    const timer = setInterval(async () => {
        if (++tries > 100) return clearInterval(timer);
        try {
            const { status } = await (await fetch(box.dataset.url, { headers: { Accept: 'application/json' } })).json();
            if (status !== 'pending') { clearInterval(timer); show(status); }
        } catch (e) { /* nouvel essai au prochain passage */ }
    }, 3000);
})();
</script>
@endsection
