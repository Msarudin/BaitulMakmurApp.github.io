<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Guest
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    // public function handle(Request $request, Closure $next): Response
    // {
    //     if(Auth::check()){
    //         return redirect()->route('home');
    //     }
    //     return $next($request);
    // }
    // Yang Lama
    public function handle(Request $request, Closure $next): Response
    {
        // Jika terdeteksi user sudah masuk lewat Remember Me / Sesi aktif
        if (Auth::check()) {
            $user = Auth::user();

            // Jika user adalah pengurus/admin (Role 1, 3, 4, 5), kunci di halaman dashboard admin
            if ($user && in_array($user->role_id, [1, 2, 3, 4, 5])) {
                return redirect()->route('home');
            }

            // Jika user biasa (Role NULL atau lainnya), biarkan di halaman utama (jangan dilempar ke /home)
            return redirect('/');
        }

        return $next($request);
    }

}
