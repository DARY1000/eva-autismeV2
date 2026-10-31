<?php

namespace App\Models;

use App\Models\Concerns\PaidWithFeexPay;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Donation extends Model
{
    use HasFactory, PaidWithFeexPay;

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

    public function paymentAmount(): int
    {
        return (int) $this->montant;
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
