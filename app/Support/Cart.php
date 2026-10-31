<?php

namespace App\Support;

use App\Models\Product;
use Illuminate\Support\Collection;

/** Panier du visiteur, gardé en session. Les prix sont toujours relus en base. */
class Cart
{
    private const KEY = 'cart';

    public function count(): int
    {
        return array_sum(session(self::KEY, []));
    }

    public function set(Product $product, int $quantity): void
    {
        $cart = session(self::KEY, []);
        $limit = $product->stock ?? 99;
        $quantity = min($quantity, $limit, 99);

        if ($quantity > 0) {
            $cart[$product->id] = $quantity;
        } else {
            unset($cart[$product->id]);
        }

        session([self::KEY => $cart]);
    }

    public function add(Product $product, int $quantity): void
    {
        $this->set($product, (session(self::KEY, [])[$product->id] ?? 0) + $quantity);
    }

    /** @return Collection<int, object{product: Product, quantity: int, subtotal: int}> */
    public function lines(): Collection
    {
        $cart = session(self::KEY, []);

        return Product::published()->whereKey(array_keys($cart))->orderBy('name')->get()
            ->map(fn (Product $product) => (object) [
                'product'  => $product,
                'quantity' => $cart[$product->id],
                'subtotal' => $product->price * $cart[$product->id],
            ]);
    }

    public function total(): int
    {
        return $this->lines()->sum('subtotal');
    }

    public function clear(): void
    {
        session()->forget(self::KEY);
    }
}
