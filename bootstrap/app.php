<?php

use App\Http\Middleware\CheckLoggedUser;
use App\Http\Middleware\CheckUserAdmin;
use App\Http\Middleware\CheckUserAdminAttendant;
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
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'check.users.admin.attendant' => CheckUserAdminAttendant::class,
            'check.logged.user' => CheckLoggedUser::class,
            'check.user.admin' => CheckUserAdmin::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
