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

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }
}
