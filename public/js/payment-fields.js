// Choix du moyen de paiement : onglets, pays par défaut et opérateurs du pays.
(function () {
    const TIME_ZONES = {
        'Africa/Porto-Novo': 'BJ', 'Africa/Lome': 'TG', 'Africa/Abidjan': 'CI',
        'Africa/Dakar': 'SN', 'Africa/Ouagadougou': 'BF', 'Africa/Brazzaville': 'CG',
    };

    function detectCountry(select) {
        const known = code => [...select.options].some(option => option.value === code);
        const languages = navigator.languages || [navigator.language];

        for (const language of languages) {
            const region = (language.split('-')[1] || '').toUpperCase();
            if (known(region)) return region;
        }

        const zone = TIME_ZONES[Intl.DateTimeFormat().resolvedOptions().timeZone];
        return known(zone) ? zone : null;
    }

    document.querySelectorAll('[data-pay-fields]').forEach(root => {
        const select    = root.querySelector('select[name="pays"]');
        const phone     = root.querySelector('input[name="telephone"]');
        const dial      = root.querySelector('[data-pay-dial]');
        const operators = [...root.querySelectorAll('.pay-operator')];
        const group     = root.querySelector('[data-pay-operators]');
        const card      = root.querySelector('[data-pay-card]');
        const note      = root.querySelector('[data-pay-redirect-note]');
        const tabs      = [...root.querySelectorAll('[data-pay-tab]')];
        let mode        = card && card.checked ? 'card' : 'mobile';

        const refreshNote = () => {
            const checked = root.querySelector('.pay-operator input:checked');
            note.hidden = mode === 'card' || !checked || !checked.closest('.pay-operator').dataset.redirect;
        };

        const refresh = () => {
            const option = select.selectedOptions[0];
            dial.textContent = '+' + option.dataset.dial;
            phone.placeholder = option.dataset.example;

            const visible = operators.filter(operator => {
                const available = operator.dataset.country === select.value;
                operator.hidden = !available;
                if (!available) operator.querySelector('input').checked = false;
                return available;
            });

            if (mode === 'mobile' && visible.length && !visible.some(operator => operator.querySelector('input').checked)) {
                visible[0].querySelector('input').checked = true;
            }

            tabs.forEach(tab => tab.setAttribute('aria-selected', String(tab.dataset.payTab === mode)));
            group.hidden = mode === 'card';
            if (card) card.checked = mode === 'card';
            refreshNote();
        };

        tabs.forEach(tab => tab.addEventListener('click', () => {
            mode = tab.dataset.payTab;
            refresh();
        }));
        select.addEventListener('change', refresh);
        group.addEventListener('change', refreshNote);

        if (!root.dataset.country) {
            select.value = detectCountry(select) || select.value;
        }
        refresh();
    });
})();
