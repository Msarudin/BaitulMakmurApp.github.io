<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function index() 
    {
        // Memakai eager loading with('role') agar query database lebih ringan dan cepat
        $users = User::with('role')->get();
        $roles = Role::all();
        
        return view('users.index', compact('users', 'roles'));
    }

    public function updateRole(Request $request)
    {
        // 1. MODIFIKASI VALIDASI: role_id boleh bernilai 'hapus_role' tanpa memicu crash exists
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'role_id' => 'required' // Dilepas exists-nya di sini karena kita akan memvalidasi secara manual di bawah
        ]);

        $userId = $request->user_id;
        $roleInput = $request->role_id;

        $user = User::findOrFail($userId);

        // 2. KONDISIONAL UTAMA: Jika mendeteksi string 'hapus_role', paksa simpan sebagai NULL murni
        if ($roleInput === 'hapus_role') {
            $user->role_id = null;
        } else {
            // Validasi manual tambahan jika input berupa ID angka untuk memastikan keamanannya
            $roleExists = Role::where('id', $roleInput)->exists();
            if (!$roleExists) {
                Alert::error('Gagal', 'Role akses yang Anda tentukan tidak sah atau tidak terdaftar.');
                return redirect()->route('users.index');
            }
            
            $user->role_id = $roleInput;
        }

        $user->save();
	
        Alert::success('Berhasil', 'Hak akses role pengguna berhasil diperbarui.');
        return redirect()->route('users.index');
    }
}
