<?php

namespace App\Services;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use RuntimeException;

/**
 * Client de l'API FeexPay v2. Utilisé par les dons et, plus tard, par la boutique :
 * le préfixe de callback_info (« don:… ») indique à quoi correspond un paiement.
 */
class FeexPay
{
    public const NETWORKS = [
        'mtn'        => 'MTN Mobile Money',
        'moov'       => 'Moov Money',
        'celtiis_bj' => 'Celtiis Cash',
    ];

    public const MIN_AMOUNT = 100;

    public const MAX_AMOUNT = 2000000;

    public static function isConfigured(): bool
    {
        return filled(config('services.feexpay.shop_id')) && filled(config('services.feexpay.api_key'));
    }

    /** Numéro béninois au format attendu par FeexPay (22901XXXXXXXX), ou null s'il est invalide. */
    public static function normalizeBeninPhone(string $phone): ?string
    {
        $digits = preg_replace('/\D/', '', $phone);

        if (str_starts_with($digits, '00229')) {
            $digits = substr($digits, 2);
        }
        if (strlen($digits) === 13 && str_starts_with($digits, '22901')) {
            return $digits;
        }
        if (strlen($digits) === 10 && str_starts_with($digits, '01')) {
            return '229'.$digits;
        }

        return null;
    }

    /** Envoie la demande de paiement sur le téléphone du client. */
    public function requestMobilePayment(string $network, string $phone, int $amount, array $customer, string $callbackInfo): array
    {
        if (! array_key_exists($network, self::NETWORKS)) {
            throw new RuntimeException("Réseau inconnu : {$network}");
        }

        return $this->post("/api/transactions/public/requesttopay/{$network}", [
            'phoneNumber'   => $phone,
            'amount'        => $amount,
            'shop'          => config('services.feexpay.shop_id'),
            'first_name'    => $customer['first_name'],
            'last_name'     => $customer['last_name'],
            'description'   => $customer['description'],
            'callback_info' => $callbackInfo,
        ]);
    }

    /** Crée un paiement par carte ; le client est redirigé vers le payment_url renvoyé. */
    public function requestCardPayment(string $phone, int $amount, array $customer, string $callbackInfo): array
    {
        return $this->post('/api/transactions/public/requesttopay/init', [
            'shop'          => config('services.feexpay.shop_id'),
            'amount'        => (string) $amount,
            'currency'      => 'XOF',
            'first_name'    => $customer['first_name'],
            'last_name'     => $customer['last_name'],
            'email'         => $customer['email'],
            'phoneNumber'   => $phone,
            'city'          => $customer['city'],
            'zip'           => $customer['zip'],
            'country'       => $customer['country'],
            'description'   => $customer['description'],
            'callback_info' => $callbackInfo,
        ]);
    }

    /** @return array{status: string, amount: int, reason: ?string, callback_info: mixed} */
    public function status(string $reference): array
    {
        try {
            $data = $this->client()
                ->get('/api/transactions/public/single/status/'.rawurlencode($reference))
                ->throw()
                ->json();
        } catch (ConnectionException|RequestException $e) {
            throw new RuntimeException('FeexPay injoignable : '.$e->getMessage(), previous: $e);
        }

        return [
            'status'        => str_contains((string) ($data['status'] ?? ''), 'PENDING') ? 'PENDING' : (string) ($data['status'] ?? ''),
            'amount'        => (int) ($data['amount'] ?? 0),
            'reason'        => ($data['reason'] ?? '') ?: null,
            'callback_info' => $data['callback_info'] ?? null,
        ];
    }

    private function post(string $path, array $payload): array
    {
        try {
            return $this->client()->post($path, $payload)->throw()->json();
        } catch (ConnectionException|RequestException $e) {
            throw new RuntimeException('Paiement refusé par FeexPay : '.$e->getMessage(), previous: $e);
        }
    }

    private function client()
    {
        $baseUrl = config('services.feexpay.mode') === 'live'
            ? 'https://api-v2.feexpay.me'
            : 'https://sandbox-api.feexpay.me';

        return Http::baseUrl($baseUrl)
            ->withToken(config('services.feexpay.api_key'))
            ->acceptJson()
            ->timeout(30);
    }
}
