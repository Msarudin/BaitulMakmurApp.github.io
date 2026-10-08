<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User; // Pastikan Model User di-import di sini
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class PasswordController extends Controller
{
    public function edit() {
        return view('admin.change-password'); 
    }

    public function update(Request $request) {
        // dd([
        // 'input_user' => $request->all(),
        //     'password_di_database_saat_ini' => Auth::user()->password
        // ]);
        // 1. Validasi Input
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|min:8|confirmed', 
        ]);

        // 2. Cocokkan password lama dengan database
        if (!Hash::check($request->old_password, Auth::user()->password)) {
            Alert::error('Gagal', 'Password lama Anda salah.');
            return back();
        }

        // 3. Ambil data user dengan findOrFail (sama seperti di UserController Anda)
        $user = User::findOrFail(Auth::id());
        
        // 4. Ubah property password dan simpan menggunakan save()
        $user->password = Hash::make($request->password);
        $user->save(); 

        Alert::success('Berhasil', 'Password berhasil dirubah');
        return redirect()->route('password.edit');
    }
}
