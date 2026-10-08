<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Symfony\Component\HttpFoundation\Response;

class VerifyIsPengelolaIrma
{
    public function handle(Request $request, Closure $next): Response
    {
        $role_id = $request->user()->role_id;

        // Boleh diakses oleh Superadmin (1) Admin (2) atau Pengelola IRMA (5)
        if ($role_id == 1 || $role_id == 2 || $role_id == 5) {
            return $next($request);
        }

        Alert::error('Gagal', 'Anda tidak memiliki hak akses ke halaman Remaja Masjid (IRMA).');
        return redirect()->route('home');
    }
}
