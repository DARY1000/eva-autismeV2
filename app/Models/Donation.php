<?php

namespace App\Models;

use App\Services\FeexPay;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Donation extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'telephone',
        'pays',
        'montant',
        'frequence',
        'message',
        'status',
        'reference',
        'payment_method',
        'payment_reference',
        'payment_failure_reason',
        'paid_at',
    ];

    protected function casts(): array
    {
        return [
            'montant' => 'decimal:2',
            'paid_at' => 'datetime',
        ];
    }

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (Donation $donation) {
            if (empty($donation->reference)) {
                $donation->reference = 'DON-' . strtoupper(Str::random(10));
            }
        });
    }

    public function getFullNameAttribute(): string
    {
        return trim($this->prenom . ' ' . $this->nom);
    }

    /**
     * Met le don à jour d'après le statut lu directement chez FeexPay.
     * Un don ne se confirme que si le montant encaissé couvre le montant promis,
     * et un don confirmé ne change plus.
     */
    public function syncPayment(FeexPay $feexPay): void
    {
        if ($this->status !== 'pending' || blank($this->payment_reference)) {
            return;
        }

        $transaction = $feexPay->status($this->payment_reference);

        if ($transaction['status'] === 'SUCCESSFUL' && $transaction['amount'] >= (int) $this->montant) {
            $this->update(['status' => 'completed', 'paid_at' => now()]);
        } elseif ($transaction['status'] === 'SUCCESSFUL') {
            $this->update(['status' => 'failed', 'payment_failure_reason' => 'Montant encaissé insuffisant : '.$transaction['amount']]);
        } elseif ($transaction['status'] === 'FAILED') {
            $this->update(['status' => 'failed', 'payment_failure_reason' => $transaction['reason']]);
        }
    }

    /** Motif d'échec compréhensible par le donateur. */
    public function getFailureMessageAttribute(): string
    {
        $reason = strtoupper((string) $this->payment_failure_reason);

        return match (true) {
            str_contains($reason, 'LOW_BALANCE'), str_contains($reason, 'NOT_ENOUGH') => 'Votre solde est insuffisant ou votre plafond est atteint.',
            str_contains($reason, 'PAYER_NOT_FOUND'), str_contains($reason, 'PAYEE_NOT_FOUND') => 'Ce numéro n\'a pas de compte Mobile Money actif sur ce réseau.',
            str_contains($reason, 'REJECT'), str_contains($reason, 'DECLINED'), str_contains($reason, 'CANCEL') => 'Le paiement a été refusé ou annulé sur votre téléphone.',
            str_contains($reason, 'EXPIRED'), str_contains($reason, 'TIMEOUT') => 'Le délai de validation a expiré.',
            str_contains($reason, 'MONTANT') => 'Le montant encaissé ne correspond pas à votre don.',
            default => 'Le paiement n\'a pas pu être validé par votre opérateur.',
        };
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }
}
