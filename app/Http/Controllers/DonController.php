<?php
namespace App\Http\Controllers;

use App\Models\Donation;
use App\Services\FeexPay;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use RuntimeException;

class DonController extends Controller
{
    public function index()
    {
        return view('pages.don', ['onlinePayment' => FeexPay::isConfigured()]);
    }

    public function process(Request $request, FeexPay $feexPay)
    {
        $validated = $request->validate([
            'montant'        => ['required', 'integer', 'min:'.FeexPay::MIN_AMOUNT, 'max:'.FeexPay::MAX_AMOUNT],
            'frequence'      => 'required|in:ponctuel,mensuel',
            'prenom'         => 'required|string|max:100',
            'nom'            => 'required|string|max:100',
            'email'          => 'required|email|max:255',
            'telephone'      => 'required|string|max:20',
            'pays'           => ['required', Rule::in(array_keys(FeexPay::COUNTRIES))],
            'ville'          => 'nullable|string|max:100',
            'message'        => 'nullable|string|max:1000',
            'payment_method' => ['nullable', Rule::in([...array_keys(FeexPay::availableNetworks()), 'card'])],
            'devise'         => 'nullable|in:XOF,EUR,USD,GBP',
        ]);

        $country = $validated['pays'];
        $method  = FeexPay::isConfigured() ? ($validated['payment_method'] ?? null) : null;

        if (FeexPay::isConfigured() && ! $method) {
            throw ValidationException::withMessages(['payment_method' => 'Choisissez votre moyen de paiement.']);
        }

        // FeexPay encaisse en FCFA : un montant en devise serait débité tel quel.
        if ($method && ($validated['devise'] ?? 'XOF') !== 'XOF') {
            throw ValidationException::withMessages(['montant' => 'Le paiement en ligne se fait en francs CFA.']);
        }

        $phone = $method ? FeexPay::validateChoice($method, $country, $validated['telephone']) : null;

        $donation = Donation::create([
            'prenom'         => $validated['prenom'],
            'nom'            => $validated['nom'],
            'email'          => $validated['email'],
            'telephone'      => $validated['telephone'],
            'pays'           => FeexPay::COUNTRIES[$country]['name'],
            'montant'        => $validated['montant'],
            'frequence'      => $validated['frequence'],
            'message'        => $validated['message'] ?? null,
            'status'         => 'pending',
            'reference'      => 'DON-'.strtoupper(Str::random(16)),
            'payment_method' => $method,
        ]);

        // Sans clés FeexPay, le don est enregistré et l'équipe recontacte le donateur.
        if (! $method) {
            return redirect()->route('don')
                ->with('success', 'Merci pour votre générosité ! Référence: '.$donation->reference.'. Notre équipe vous contactera pour finaliser le paiement.');
        }

        $customer = [
            'first_name'  => $donation->prenom,
            'last_name'   => $donation->nom,
            'email'       => $donation->email,
            'description' => 'Don EVA Autisme',
            'city'        => $validated['ville'] ?? 'Cotonou',
            'zip'         => '00229',
            'country'     => $country,
        ];

        try {
            $payment = $feexPay->startPayment($method, $phone ?? preg_replace('/\D/', '', $donation->telephone), (int) $donation->montant, $customer, 'don:'.$donation->reference, route('don.track', $donation->reference));
        } catch (RuntimeException $e) {
            Log::error('Paiement FeexPay refusé', ['don' => $donation->reference, 'error' => $e->getMessage()]);
            $donation->markPaymentFailed('Demande refusée par FeexPay');

            return back()->withInput()->withErrors(['montant' => 'Le paiement n\'a pas pu démarrer. Vérifiez votre numéro ou réessayez dans quelques minutes.']);
        }

        $donation->update(['payment_reference' => $payment['reference'] ?? null]);

        if (filled($payment['payment_url'] ?? null)) {
            return redirect()->away($payment['payment_url']);
        }

        return redirect()->route('don.track', $donation->reference);
    }

    public function track(string $reference, FeexPay $feexPay)
    {
        $donation = Donation::where('reference', $reference)->firstOrFail();
        $this->sync($donation, $feexPay);

        return view('pages.don.suivi', compact('donation'));
    }

    public function status(string $reference, FeexPay $feexPay): JsonResponse
    {
        $donation = Donation::where('reference', $reference)->firstOrFail();
        $this->sync($donation, $feexPay);

        return response()->json([
            'status' => $donation->status,
            'reason' => $donation->status === 'failed' ? $donation->failure_message : null,
        ]);
    }

    private function sync(Donation $donation, FeexPay $feexPay): void
    {
        try {
            $donation->syncPayment($feexPay);
        } catch (RuntimeException $e) {
            // Coupure passagère : la page continue d'interroger, le webhook prendra le relais.
            Log::warning('Statut FeexPay indisponible', ['don' => $donation->reference, 'error' => $e->getMessage()]);
        }
    }
}
