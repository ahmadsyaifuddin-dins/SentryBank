<?php

use App\Http\Middleware\RedirectByUserRole;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    
    ->withMiddleware(function ($middleware) {
        $middleware->alias([
            'redirect.by.role' => RedirectByUserRole::class,
        ]);
    })

    ->withMiddleware(function ($middleware) {
        $middleware->web(append: [
            RedirectByUserRole::class,
        ]);
    })

    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
