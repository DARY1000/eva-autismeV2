// Fenêtre de suivi : interroge le statut du paiement jusqu'à la réponse de l'opérateur.
(function () {
    const box = document.getElementById('pay-status');
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
