<?php

declare(strict_types=1);

use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull;
use Illuminate\Foundation\Http\Middleware\PreventRequestsDuringMaintenance;
use Illuminate\Foundation\Http\Middleware\TrimStrings;
use Illuminate\Http\Middleware\FrameGuard;
use Illuminate\Http\Middleware\HandleCors;
use Illuminate\Http\Middleware\TrustHosts;
use Illuminate\Http\Middleware\TrustProxies;
use Illuminate\Http\Middleware\ValidatePostSize;
use Lightit\Application;
use Lightit\Security\App\Middlewares\SecurityHeaders;
use Lightit\Shared\App\Exceptions\ExceptionHandler;
use Lightit\Shared\App\Http\Middleware\ForceJsonResponse;

$exceptionManager = new ExceptionHandler();

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withEvents(discover: [
        __DIR__.'/../src/Shared/App/Listeners',
    ])
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->use([
            \Illuminate\Foundation\Http\Middleware\InvokeDeferredCallbacks::class,
            // Uncomment the following line if you are running your server from behind an HTTP proxy, such as a load balancer.
            // TrustProxies::class,

            TrustHosts::class, // Default: allSubdomainsOfApplicationUrl
            FrameGuard::class,
            HandleCors::class,
            PreventRequestsDuringMaintenance::class,
            ValidatePostSize::class,
            TrimStrings::class,
            ConvertEmptyStringsToNull::class,

            // SecurityHeaders::class,
        ]);

        // Use the following to modify web and api middlewares
        // https://laravel.com/docs/11.x/middleware#laravels-default-middleware-groups

        // $middleware->web(append: [
        //     EnsureUserIsSubscribed::class,
        // ]);

        $middleware->api(prepend: [
            // ForceJsonResponse::class,
        ]);
    })
    ->withExceptions(using: $exceptionManager->getClosure())
    ->create();
