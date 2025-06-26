<?php

use App\Http\Middleware\CheckManager;
use App\Http\Middleware\CheckRoles;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // ... existing middleware registrations

        $middleware->alias([
            'role' => CheckRoles::class,
           'staff' => CheckManager::class,
            // other route middleware...
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })
    ->create();
