<?php

use App\Http\Middleware\AssignBadge;
use App\Http\Middleware\BannedUser;
use App\Http\Middleware\EmailMustVerify;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\TrustProxies;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->prepend(TrustProxies::class);

        $middleware->alias([
           'is_admin' => IsAdmin::class,
           'not_banned' => BannedUser::class,
           'email_verified' => EmailMustVerify::class,
           'assign_badge' => AssignBadge::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
