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
    ->withMiddleware(function (Middleware $middleware): void {
        //
        $middleware->alias([
            'guest' => \App\Http\Middleware\Guest::class,
            'auth'  => \App\Http\Middleware\Auth::class,
            'isSupervisor' => \App\Http\Middleware\VerifyIsSupervisor::class,
            'pengelola_warga'  => \App\Http\Middleware\VerifyIsPengelolaWarga::class,
            'pengelola_masjid' => \App\Http\Middleware\VerifyIsPengelolaMasjid::class,
            'pengelola_irma'   => \App\Http\Middleware\VerifyIsPengelolaIrma::class,
        ]);
        $middleware->redirectUsersTo(function () {
            // Ambil data user yang berhasil login via Cookie Remember Me
            $user = \Illuminate\Support\Facades\Auth::user();

            if ($user) {
                // Jika user adalah pengurus (Role Admin 1, Warga 3, Masjid 4, Irma 5)
                if (in_array($user->role_id, [1, 2, 3, 4, 5])) { 
                    return '/home'; // Tahan secara paksa di halaman admin
                }
            }

            // Jika user biasa atau tidak punya role, arahkan ke landing page umum
            return '/';
        });
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
