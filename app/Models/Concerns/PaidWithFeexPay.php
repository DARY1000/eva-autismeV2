<?php

namespace App\Models\Concerns;

use App\Services\FeexPay;

/** Suivi d'un paiement FeexPay, commun aux dons et aux commandes. */
trait PaidWithFeexPay
{
    abstract public function paymentAmount(): int;

    /** Appelé une seule fois, lorsque le paiement échoue. */
    protected function paymentFailed(): void
    {
    }

    /**
     * Met à jour le statut d'après la réponse lue directement chez FeexPay.
     * Un paiement ne se confirme que si le montant encaissé couvre le montant attendu,
     * et un paiement confirmé ne change plus.
     */
    public function syncPayment(FeexPay $feexPay): void
    {
        if ($this->status !== 'pending' || blank($this->payment_reference)) {
            return;
        }

        $transaction = $feexPay->status($this->payment_reference);

        if ($transaction['status'] === 'SUCCESSFUL' && $transaction['amount'] >= $this->paymentAmount()) {
            $this->closePayment(['status' => 'completed', 'paid_at' => now()]);
        } elseif ($transaction['status'] === 'SUCCESSFUL') {
            $this->markPaymentFailed('Montant encaissé insuffisant : '.$transaction['amount']);
        } elseif ($transaction['status'] === 'FAILED') {
            $this->markPaymentFailed((string) $transaction['reason']);
        }
    }

    public function markPaymentFailed(string $reason): void
    {
        if ($this->closePayment(['status' => 'failed', 'payment_failure_reason' => $reason])) {
            $this->paymentFailed();
        }
    }

    /** Le webhook et la page de suivi peuvent arriver ensemble : un seul des deux clôt le paiement. */
    private function closePayment(array $attributes): bool
    {
        $closed = static::whereKey($this->getKey())->where('status', 'pending')->update($attributes) === 1;
        $this->refresh();

        return $closed;
    }

    /** Motif d'échec compréhensible par le client. */
    public function getFailureMessageAttribute(): string
    {
        $reason = strtoupper((string) $this->payment_failure_reason);

        return match (true) {
            str_contains($reason, 'LOW_BALANCE'), str_contains($reason, 'NOT_ENOUGH') => 'Votre solde est insuffisant ou votre plafond est atteint.',
            str_contains($reason, 'PAYER_NOT_FOUND'), str_contains($reason, 'PAYEE_NOT_FOUND') => 'Ce numéro n\'a pas de compte Mobile Money actif sur ce réseau.',
            str_contains($reason, 'REJECT'), str_contains($reason, 'DECLINED'), str_contains($reason, 'CANCEL') => 'Le paiement a été refusé ou annulé sur votre téléphone.',
            str_contains($reason, 'EXPIRED'), str_contains($reason, 'TIMEOUT') => 'Le délai de validation a expiré.',
            str_contains($reason, 'MONTANT') => 'Le montant encaissé ne correspond pas au montant attendu.',
            default => 'Le paiement n\'a pas pu être validé par votre opérateur.',
        };
    }
}
