<?php

namespace App\Services;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;
use RuntimeException;

/**
 * Client de l'API FeexPay v2, utilisé par les dons et la boutique :
 * le préfixe de callback_info (« don:… », « cmd:… ») indique à quoi correspond un paiement.
 */
class FeexPay
{
    /** pattern : numéro complet attendu par FeexPay ; length : chiffres du numéro local. */
    public const COUNTRIES = [
        'BJ' => ['flag' => '🇧🇯', 'name' => 'Bénin', 'dial' => '229', 'length' => 10, 'pattern' => '/^22901\d{8}$/', 'example' => '01 97 00 00 00'],
        'TG' => ['flag' => '🇹🇬', 'name' => 'Togo', 'dial' => '228', 'length' => 8, 'pattern' => '/^228\d{8}$/', 'example' => '90 00 00 00'],
        'CI' => ['flag' => '🇨🇮', 'name' => 'Côte d\'Ivoire', 'dial' => '225', 'length' => 10, 'pattern' => '/^225\d{10}$/', 'example' => '05 07 70 00 00'],
        'SN' => ['flag' => '🇸🇳', 'name' => 'Sénégal', 'dial' => '221', 'length' => 9, 'pattern' => '/^221\d{9}$/', 'example' => '77 000 00 00'],
        'BF' => ['flag' => '🇧🇫', 'name' => 'Burkina Faso', 'dial' => '226', 'length' => 8, 'pattern' => '/^226\d{8}$/', 'example' => '70 00 00 00'],
        'CG' => ['flag' => '🇨🇬', 'name' => 'Congo-Brazzaville', 'dial' => '242', 'length' => 9, 'pattern' => '/^242\d{9}$/', 'example' => '06 100 0000'],
    ];

    /**
     * Réseaux à validation simple. redirect : le client paie sur la page de l'opérateur.
     * Coris Bénin et Orange Burkina, qui exigent un code à saisir, ne sont pas proposés.
     */
    public const NETWORKS = [
        'mtn'        => ['label' => 'MTN Mobile Money', 'country' => 'BJ', 'logo' => 'mtn'],
        'moov'       => ['label' => 'Moov Money', 'country' => 'BJ', 'logo' => 'moov'],
        'celtiis_bj' => ['label' => 'Celtiis Cash', 'country' => 'BJ', 'logo' => 'celtiis'],
        'togocom_tg' => ['label' => 'T-Money', 'country' => 'TG', 'logo' => 'togocom'],
        'moov_tg'    => ['label' => 'Flooz', 'country' => 'TG', 'logo' => 'flooz'],
        'mtn_ci'     => ['label' => 'MTN Mobile Money', 'country' => 'CI', 'logo' => 'mtn'],
        'moov_ci'    => ['label' => 'Moov Money', 'country' => 'CI', 'logo' => 'moov', 'redirect' => true],
        'wave_ci'    => ['label' => 'Wave', 'country' => 'CI', 'logo' => 'wave', 'redirect' => true],
        'orange_ci'  => ['label' => 'Orange Money', 'country' => 'CI', 'logo' => 'orange', 'redirect' => true],
        'orange_sn'  => ['label' => 'Orange Money', 'country' => 'SN', 'logo' => 'orange', 'redirect' => true],
        'wave_sn'    => ['label' => 'Wave', 'country' => 'SN', 'logo' => 'wave', 'redirect' => true],
        'free_sn'    => ['label' => 'Free Money', 'country' => 'SN', 'logo' => 'mixx'],
        'moov_bf'    => ['label' => 'Moov Money', 'country' => 'BF', 'logo' => 'moov'],
        'wave_bf'    => ['label' => 'Wave', 'country' => 'BF', 'logo' => 'wave', 'redirect' => true],
        'mtn_cg'     => ['label' => 'MTN Mobile Money', 'country' => 'CG', 'logo' => 'mtn'],
    ];

    public const MIN_AMOUNT = 100;

    public const MAX_AMOUNT = 2000000;

    public static function isConfigured(): bool
    {
        return filled(config('services.feexpay.shop_id')) && filled(config('services.feexpay.api_key'));
    }

    /** Réseaux proposés, sans ceux désactivés dans FEEXPAY_DISABLED_NETWORKS. */
    public static function availableNetworks(): array
    {
        return array_diff_key(self::NETWORKS, array_flip(config('services.feexpay.disabled_networks', [])));
    }

    /** Numéro au format attendu par FeexPay (indicatif + numéro), ou null s'il ne correspond pas au pays. */
    public static function normalizePhone(string $phone, string $country): ?string
    {
        $rules  = self::COUNTRIES[$country];
        $digits = preg_replace('/\D/', '', $phone);

        if (str_starts_with($digits, '00')) {
            $digits = substr($digits, 2);
        }
        if (strlen($digits) === $rules['length']) {
            $digits = $rules['dial'].$digits;
        }

        return preg_match($rules['pattern'], $digits) ? $digits : null;
    }

    /**
     * Vérifie que le moyen de paiement correspond au pays et renvoie le numéro normalisé.
     * Pour la carte, le numéro est facultatif : null s'il ne correspond pas au pays.
     */
    public static function validateChoice(string $method, string $country, string $phone): ?string
    {
        $normalized = self::normalizePhone($phone, $country);

        if ($method === 'card') {
            return $normalized;
        }

        if (self::NETWORKS[$method]['country'] !== $country) {
            throw ValidationException::withMessages(['payment_method' => 'Ce moyen de paiement n\'est pas disponible dans ce pays.']);
        }

        if (! $normalized) {
            throw ValidationException::withMessages([
                'telephone' => 'Numéro invalide pour ce pays. Exemple : '.self::COUNTRIES[$country]['example'],
            ]);
        }

        return $normalized;
    }

    public function startPayment(string $method, string $phone, int $amount, array $customer, string $callbackInfo, string $returnUrl): array
    {
        return $method === 'card'
            ? $this->requestCardPayment($phone, $amount, $customer, $callbackInfo)
            : $this->requestMobilePayment($method, $phone, $amount, $customer, $callbackInfo, $returnUrl);
    }

    /** Envoie la demande de paiement sur le téléphone du client. */
    public function requestMobilePayment(string $network, string $phone, int $amount, array $customer, string $callbackInfo, ?string $returnUrl = null): array
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
            ...(self::NETWORKS[$network]['redirect'] ?? false ? ['return_url' => $returnUrl, 'cancel_url' => $returnUrl] : []),
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
