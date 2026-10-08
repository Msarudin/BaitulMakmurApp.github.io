<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Symfony\Component\HttpFoundation\Response;

class VerifyIsPengelolaWarga
{
    public function handle(Request $request, Closure $next): Response
    {
        $role_id = $request->user()->role_id;

        // Boleh diakses oleh Superadmin (1), Admin (2) atau Pengelola Warga (3)
        if ($role_id == 1 || $role_id == 2 || $role_id == 3 || $role_id == 4 || $role_id == 5){
            return $next($request);
        }

        Alert::error('Gagal', 'Anda tidak memiliki hak akses ke halaman Pengelola Warga.');
        return redirect()->route('home');
    }
}
