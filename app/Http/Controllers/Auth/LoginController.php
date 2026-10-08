<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = '/home'; (ini yang lama)

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    protected function authenticated(Request $request, $user) // <-- Diperbaiki dari \Illuminate\Http\Request menjadi Request saja
    {
        // Jika user adalah Admin / Supervisor (role_id = 1)
        if ($user->role_id == 1) {
            return redirect('/home'); 
        }

        // Jika user adalah pengelola warga (Role 3), pengelola masjid (Role 4), pengelola irma (Role 5)
        if (in_array($user->role_id, [3, 4, 5])) {
            return redirect('/home');
        }

        // Jika user tidak memiliki role (NULL) atau user biasa, arahkan ke landing page umum
        return redirect('/');
    }

    protected function attemptLogin(Request $request)
    {
        return $this->guard()->attempt(
            $this->credentials($request), 
            //$request->filled('remember')
            $request->has('remember')
        );
    }
}
