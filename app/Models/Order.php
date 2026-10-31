<?php

namespace App\Models;

use App\Models\Concerns\PaidWithFeexPay;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use PaidWithFeexPay;

    public const DELIVERY_MODES = [
        'retrait'   => 'Retrait à Abomey-Calavi',
        'livraison' => 'Livraison',
    ];

    public const FULFILLMENT = [
        'to_prepare' => 'À préparer',
        'ready'      => 'Prête',
        'shipped'    => 'Expédiée',
        'delivered'  => 'Remise au client',
        'cancelled'  => 'Annulée',
    ];

    protected $fillable = [
        'reference', 'prenom', 'nom', 'email', 'telephone', 'pays', 'ville', 'adresse', 'delivery_mode',
        'note', 'total', 'status', 'fulfillment_status', 'payment_method', 'payment_reference',
        'payment_failure_reason', 'paid_at',
    ];

    protected function casts(): array
    {
        return ['paid_at' => 'datetime'];
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function paymentAmount(): int
    {
        return $this->total;
    }

    /** Le stock réservé à la commande redevient disponible. */
    protected function paymentFailed(): void
    {
        foreach ($this->items as $item) {
            Product::whereKey($item->product_id)->whereNotNull('stock')->increment('stock', $item->quantity);
        }
    }
}
