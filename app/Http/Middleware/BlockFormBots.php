<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

/**
 * Écarte les robots sur les formulaires publics : champ piège rempli,
 * jeton de date absent, ou formulaire envoyé en moins de 3 secondes.
 * Le robot reçoit une réponse normale pour ne pas apprendre à contourner.
 */
class BlockFormBots
{
    private const MIN_SECONDS = 3;

    public function handle(Request $request, Closure $next): Response
    {
        if ($this->isBot($request)) {
            Log::info('Formulaire bloqué', ['path' => $request->path(), 'ip' => $request->ip()]);

            return redirect()->back()->with('success', 'Merci, votre demande a bien été reçue.');
        }

        return $next($request);
    }

    private function isBot(Request $request): bool
    {
        if (filled($request->input('website'))) {
            return true;
        }

        try {
            $renderedAt = (int) Crypt::decryptString((string) $request->input('_form_ts'));
        } catch (DecryptException) {
            return true;
        }

        return time() - $renderedAt < self::MIN_SECONDS;
    }
}
