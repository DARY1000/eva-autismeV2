<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Services\FeexPay;
use App\Support\Cart;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use RuntimeException;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $category = array_key_exists((string) $request->query('categorie'), Product::CATEGORIES)
            ? $request->query('categorie')
            : null;

        return view('pages.boutique.index', [
            'products'   => Product::published()
                ->when($category, fn ($query) => $query->where('category', $category))
                ->orderBy('order')->orderBy('name')->get(),
            'categories' => Product::CATEGORIES,
            'category'   => $category,
        ]);
    }

    public function show(Product $product)
    {
        abort_unless(Product::published()->whereKey($product->id)->exists(), 404);

        return view('pages.boutique.show', compact('product'));
    }

    public function cart(Cart $cart)
    {
        return view('pages.boutique.panier', ['lines' => $cart->lines(), 'total' => $cart->total()]);
    }

    public function add(Request $request, Product $product, Cart $cart)
    {
        abort_unless(Product::published()->whereKey($product->id)->exists(), 404);

        $quantity = $request->validate(['quantity' => 'required|integer|min:1|max:99'])['quantity'];

        if (! $product->is_available) {
            return back()->with('error', 'Ce produit n\'est plus disponible.');
        }

        $cart->add($product, $quantity);

        return redirect()->route('boutique.panier')->with('success', $product->name.' a été ajouté à votre panier.');
    }

    public function update(Request $request, Product $product, Cart $cart)
    {
        $cart->set($product, $request->validate(['quantity' => 'required|integer|min:0|max:99'])['quantity']);

        return redirect()->route('boutique.panier');
    }

    public function checkout(Cart $cart)
    {
        $lines = $cart->lines();

        if ($lines->isEmpty()) {
            return redirect()->route('boutique.index');
        }

        return view('pages.boutique.commande', ['lines' => $lines, 'total' => $cart->total()]);
    }

    public function placeOrder(Request $request, Cart $cart, FeexPay $feexPay)
    {
        $validated = $request->validate([
            'prenom'         => 'required|string|max:100',
            'nom'            => 'required|string|max:100',
            'email'          => 'required|email|max:255',
            'telephone'      => 'required|string|max:20',
            'pays'           => ['required', Rule::in(array_keys(FeexPay::COUNTRIES))],
            'ville'          => 'required|string|max:100',
            'delivery_mode'  => ['required', Rule::in(array_keys(Order::DELIVERY_MODES))],
            'adresse'        => 'required_if:delivery_mode,livraison|nullable|string|max:255',
            'note'           => 'nullable|string|max:1000',
            'payment_method' => ['required', Rule::in([...array_keys(FeexPay::availableNetworks()), 'card'])],
        ], ['adresse.required_if' => 'Indiquez votre adresse de livraison.', 'payment_method.required' => 'Choisissez votre moyen de paiement.']);

        $lines = $cart->lines();
        if ($lines->isEmpty()) {
            return redirect()->route('boutique.index');
        }

        if (! FeexPay::isConfigured()) {
            throw ValidationException::withMessages(['payment_method' => 'Le paiement en ligne est momentanément indisponible.']);
        }

        $country = $validated['pays'];
        $method  = $validated['payment_method'];
        $phone   = FeexPay::validateChoice($method, $country, $validated['telephone']);

        if ($cart->total() > FeexPay::MAX_AMOUNT) {
            throw ValidationException::withMessages(['payment_method' => 'Le montant dépasse le plafond du paiement en ligne. Contactez-nous pour cette commande.']);
        }

        $order = DB::transaction(function () use ($validated, $lines, $country, $method) {
            $order = Order::create([
                ...collect($validated)->except('pays')->all(),
                'pays'      => FeexPay::COUNTRIES[$country]['name'],
                'reference' => 'CMD-'.strtoupper(Str::random(16)),
                'total'     => $lines->sum('subtotal'),
                'payment_method' => $method,
            ]);

            foreach ($lines as $line) {
                $this->reserve($line->product, $line->quantity);

                $order->items()->create([
                    'product_id' => $line->product->id,
                    'name'       => $line->product->name,
                    'unit_price' => $line->product->price,
                    'quantity'   => $line->quantity,
                ]);
            }

            return $order;
        });

        $customer = [
            'first_name'  => $order->prenom,
            'last_name'   => $order->nom,
            'email'       => $order->email,
            'description' => 'Commande EVA Autisme',
            'city'        => $order->ville,
            'zip'         => '00229',
            'country'     => $country,
        ];

        try {
            $payment = $feexPay->startPayment($method, $phone ?? preg_replace('/\D/', '', $order->telephone), $order->total, $customer, 'cmd:'.$order->reference, route('boutique.suivi', $order->reference));
        } catch (RuntimeException $e) {
            Log::error('Paiement FeexPay refusé', ['commande' => $order->reference, 'error' => $e->getMessage()]);
            $order->markPaymentFailed('Demande refusée par FeexPay');

            return back()->withInput()->withErrors(['payment_method' => 'Le paiement n\'a pas pu démarrer. Vérifiez votre numéro ou réessayez dans quelques minutes.']);
        }

        $order->update(['payment_reference' => $payment['reference'] ?? null]);
        $cart->clear();

        if (filled($payment['payment_url'] ?? null)) {
            return redirect()->away($payment['payment_url']);
        }

        return redirect()->route('boutique.suivi', $order->reference);
    }

    public function track(string $reference, FeexPay $feexPay)
    {
        $order = Order::where('reference', $reference)->firstOrFail();
        $this->sync($order, $feexPay);

        return view('pages.boutique.suivi', compact('order'));
    }

    public function status(string $reference, FeexPay $feexPay): JsonResponse
    {
        $order = Order::where('reference', $reference)->firstOrFail();
        $this->sync($order, $feexPay);

        return response()->json([
            'status' => $order->status,
            'reason' => $order->status === 'failed' ? $order->failure_message : null,
        ]);
    }

    /** Deux clients ne peuvent pas acheter le dernier article : la ligne reste verrouillée jusqu'à la fin de la commande. */
    private function reserve(Product $product, int $quantity): void
    {
        $stock = Product::whereKey($product->id)->lockForUpdate()->value('stock');

        if ($stock === null) {
            return;
        }

        if ($stock < $quantity) {
            throw ValidationException::withMessages(['payment_method' => 'Il ne reste que '.$stock.' exemplaire(s) de « '.$product->name.' ». Modifiez votre panier.']);
        }

        Product::whereKey($product->id)->decrement('stock', $quantity);
    }

    private function sync(Order $order, FeexPay $feexPay): void
    {
        try {
            $order->syncPayment($feexPay);
        } catch (RuntimeException $e) {
            Log::warning('Statut FeexPay indisponible', ['commande' => $order->reference, 'error' => $e->getMessage()]);
        }
    }
}
