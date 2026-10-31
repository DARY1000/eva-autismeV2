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
            'montant'        => ['required', 'integer', 'min:500', 'max:'.FeexPay::MAX_AMOUNT],
            'frequence'      => 'required|in:ponctuel,mensuel',
            'prenom'         => 'required|string|max:100',
            'nom'            => 'required|string|max:100',
            'email'          => 'required|email|max:255',
            'telephone'      => 'required|string|max:20',
            'pays'           => 'nullable|string|max:100',
            'ville'          => 'nullable|string|max:100',
            'message'        => 'nullable|string|max:1000',
            'payment_method' => ['nullable', Rule::in([...array_keys(FeexPay::NETWORKS), 'card'])],
            'devise'         => 'nullable|in:XOF,EUR,USD,GBP',
        ]);

        $method = FeexPay::isConfigured() ? ($validated['payment_method'] ?? 'mtn') : null;
        $phone  = FeexPay::normalizeBeninPhone($validated['telephone']);

        // FeexPay encaisse en FCFA : un montant en devise serait débité tel quel.
        if ($method && ($validated['devise'] ?? 'XOF') !== 'XOF') {
            throw ValidationException::withMessages(['montant' => 'Le paiement en ligne se fait en francs CFA.']);
        }

        if ($method && $method !== 'card' && ! $phone) {
            throw ValidationException::withMessages([
                'telephone' => 'Saisissez un numéro béninois à 10 chiffres commençant par 01.',
            ]);
        }

        $donation = Donation::create([
            'prenom'         => $validated['prenom'],
            'nom'            => $validated['nom'],
            'email'          => $validated['email'],
            'telephone'      => $validated['telephone'],
            'pays'           => $validated['pays'] ?? 'Bénin',
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
            'country'     => 'BJ',
        ];

        try {
            $payment = $method === 'card'
                ? $feexPay->requestCardPayment($phone ?? preg_replace('/\D/', '', $donation->telephone), (int) $donation->montant, $customer, 'don:'.$donation->reference)
                : $feexPay->requestMobilePayment($method, $phone, (int) $donation->montant, $customer, 'don:'.$donation->reference);
        } catch (RuntimeException $e) {
            Log::error('Paiement FeexPay refusé', ['don' => $donation->reference, 'error' => $e->getMessage()]);
            $donation->update(['status' => 'failed', 'payment_failure_reason' => 'Demande refusée par FeexPay']);

            return back()->withInput()->withErrors(['montant' => 'Le paiement n\'a pas pu démarrer. Vérifiez votre numéro ou réessayez dans quelques minutes.']);
        }

        $donation->update(['payment_reference' => $payment['reference'] ?? null]);

        if ($method === 'card' && filled($payment['payment_url'] ?? null)) {
            return redirect()->away($payment['payment_url']);
        }

        return redirect()->route('don.track', $donation->reference);
    }

    public function track(string $reference)
    {
        return view('pages.don.suivi', [
            'donation' => Donation::where('reference', $reference)->firstOrFail(),
        ]);
    }

    public function status(string $reference, FeexPay $feexPay): JsonResponse
    {
        $donation = Donation::where('reference', $reference)->firstOrFail();

        try {
            $donation->syncPayment($feexPay);
        } catch (RuntimeException) {
            // Coupure passagère : la page continue d'interroger, le webhook prendra le relais.
        }

        return response()->json(['status' => $donation->status]);
    }
}
