<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Le site est servi derrière le CDN de Hostinger : sans cela, tous les
        // visiteurs partagent la même IP et les limites par IP les bloqueraient ensemble.
        $middleware->trustProxies(at: '*');

        $middleware->append(\App\Http\Middleware\SecurityHeaders::class);

        $middleware->alias(['form.guard' => \App\Http\Middleware\BlockFormBots::class]);

        // FeexPay ne peut pas envoyer de jeton CSRF ; chaque webhook est revérifié auprès de son API.
        $middleware->validateCsrfTokens(except: ['webhooks/feexpay']);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
