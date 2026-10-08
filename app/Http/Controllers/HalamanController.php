<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Jamaah;
use Illuminate\Support\Facades\DB;

class HalamanController extends Controller
{
        public function index(Request $request)
    {
        // ====================================================================================
        // 🟢 FIX: AMBIL ANGKA KETIKAN ADMIN LANGSUNG DARI DATABASE SERVER (SUDAH DISAMAKAN)
        // ====================================================================================
        $saldoMasjidText = \Illuminate\Support\Facades\Cache::get('saldo_manual_masjid', 'Rp 0');


        // ====================================================================================
        // ⚪ HITUNG KAS LAINNYA & DATA JAMAAH
        // ====================================================================================
        $saldoAmbulan = \App\Models\Transaksi::where('kategori_id', 3)->where('type', 'kes')->sum('amount') 
                        - \App\Models\Transaksi::where('kategori_id', 3)->where('type', 'transfer')->sum('amount');

        $saldoYatim = \App\Models\Transaksi::where('kategori_id', 2)->where('type', 'kes')->sum('amount') 
                      - \App\Models\Transaksi::where('kategori_id', 2)->where('type', 'transfer')->sum('amount');

        $totalJamaah = \App\Models\Jamaah::count();

        // Mengirimkan variabel yang sudah benar menggunakan huruf 'j' ($saldoMasjidText)
        return view('layouts.index', [
            'saldoMasjidText' => $saldoMasjidText,
            'saldoAmbulan'    => $saldoAmbulan,
            'saldoYatim'      => $saldoYatim,
            'totalJamaah'     => $totalJamaah
        ]);
    }

    public function sambutan()
    {
        return view('components.halaman.sambutan');
    }

    public function qurban()
    {
        return view('components.halaman.qurban');
    }

    public function ngaji()
    {
        return view('components.halaman.ngaji');
    }

    public function nisan()
    {
        return view('components.halaman.nisan');
    }

    public function kegiatan()
    {
        return view('components.halaman.kegiatan');
    }

    public function konsul()
    {
        return view('components.halaman.konsul');
    }

    public function ldk()
    {
        return view('components.halaman.ldk');
    }

    public function tentang()
    {
        return view('components.halaman.tentang');
    }
}
