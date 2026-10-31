<?php

namespace App\Http\Controllers\Webhooks;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Services\FeexPay;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use RuntimeException;

class FeexPayWebhookController extends Controller
{
    public function __invoke(Request $request, FeexPay $feexPay): Response
    {
        $secret = config('services.feexpay.webhook_secret');

        if (filled($secret) && ! hash_equals($secret, (string) $request->bearerToken())) {
            Log::warning('Webhook FeexPay refusé : secret incorrect');

            return response('', 401);
        }

        $reference = (string) $request->input('reference');
        $donation  = $reference !== '' ? Donation::where('payment_reference', $reference)->first() : null;

        // Référence inconnue : FeexPay n'a pas à réessayer.
        if (! $donation) {
            Log::info('Webhook FeexPay ignoré : référence inconnue', ['reference' => $reference]);

            return response('', 200);
        }

        // Le contenu du webhook n'est jamais cru tel quel : syncPayment relit l'API FeexPay.
        try {
            $donation->syncPayment($feexPay);
        } catch (RuntimeException $e) {
            Log::warning('Webhook FeexPay non vérifié', ['reference' => $reference, 'error' => $e->getMessage()]);

            return response('', 503);
        }

        Log::info('Webhook FeexPay traité', ['don' => $donation->reference, 'status' => $donation->status]);

        return response('', 200);
    }
}
