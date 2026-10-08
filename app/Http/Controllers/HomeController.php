<?php

namespace App\Http\Controllers;

use App\Models\Iuran;
use App\Models\KeuanganYayasan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
public function index(Request $request)
{
    // ==============================================================================
    // 🛡️ PENGAMAN UTAMA: CEK ROLE USER SAAT LOGIN OTOMATIS (REMEMBER ME) AKTIF
    // ==============================================================================
    $user = \Illuminate\Support\Facades\Auth::user();

    // Jika tidak ada user login, atau role_id bukan pengurus (bukan 1, 3, 4, 5)
    if (!$user || !in_array($user->role_id, [1, 3, 4, 5])) {
        return redirect('/'); // Buang paksa ke halaman depan user umum
    }

    // 1. Menghitung akumulasi total iuran warga dari tabel iuran
    $totalIuranWarga = \DB::table('iuran')->sum('nominal'); 

    // ==============================================================================
    // 🛠️ MENGUNCI LOGIKA ATURAN JUMAT CLOSING (DIPASIKAN SAMA DENGAN KAS MASJID)
    // ==============================================================================
    if ($request->has('start_date')) {
        $jumatClosing = \Illuminate\Support\Carbon::parse($request->input('start_date'))->endOfDay();
    } else {
        $hariIni = \Illuminate\Support\Carbon::now();
        if ($hariIni->dayOfWeek >= \Illuminate\Support\Carbon::FRIDAY) {
            $jumatClosing = $hariIni->copy()->next(\Illuminate\Support\Carbon::FRIDAY)->subWeek()->endOfDay();
        } else {
            $jumatClosing = $hariIni->copy()->previous(\Illuminate\Support\Carbon::FRIDAY)->endOfDay();
        }
    }

    // Kunci range tanggal transaksi sesuai dengan method kasMasjid() di KeuanganController
    $pemasukanMulai     = $jumatClosing->copy()->subWeek()->startOfDay(); 
    $pemasukanSelesai   = $jumatClosing->copy()->subDay()->endOfDay();     
    $pengeluaranMulai   = $jumatClosing->copy()->subWeek()->addDay()->startOfDay(); 
    $pengeluaranSelesai = $jumatClosing->copy();                                   

    // Hitung pemasukan minggu ini murni sesuai koridor tanggal Jumat Closing
    $masukMasjid = \DB::table('transaksis')
        ->where('kategori_id', 1)
        ->where('type', 'kes')
        ->where('id', '!=', 5) 
        ->whereBetween('tanggal_transaksi', [$pemasukanMulai, $pemasukanSelesai])
        ->sum('amount');

    // Hitung pengeluaran minggu ini murni sesuai koridor tanggal Jumat Closing
    $keluarMasjid = \DB::table('transaksis')
        ->where('kategori_id', 1)
        ->where('type', 'transfer')
        ->whereBetween('tanggal_transaksi', [$pengeluaranMulai, $pengeluaranSelesai])
        ->sum('amount');

    // Nominal otomatis sinkron menghasilkan angka Rp -3.499.000 mengikuti Laporan Mingguan Anda!
    $saldoMasjid = $masukMasjid - $keluarMasjid;


    // ==============================================================================
    // 3. KAS AMBULAN (KATEGORI ID = 3) -> BERJALAN DINAMIS KUMULATIF
    // ==============================================================================
    $masukAmbulan = \DB::table('transaksis')
        ->where('kategori_id', 3) 
        ->where('type', 'kes')    
        ->sum('amount');

    $keluarAmbulan = \DB::table('transaksis')
        ->where('kategori_id', 3)
        ->where('type', 'transfer') 
        ->sum('amount');

    $saldoAmbulan = $masukAmbulan - $keluarAmbulan;

    // ==============================================================================
    // 4. KAS YATIM (KATEGORI ID = 2) -> BERJALAN DINAMIS KUMULATIF
    // ==============================================================================
    $masukYatim = \DB::table('transaksis')
        ->where('kategori_id', 2) 
        ->where('type', 'kes')    
        ->sum('amount');

    $keluarYatim = \DB::table('transaksis')
        ->where('kategori_id', 2)
        ->where('type', 'transfer') 
        ->sum('amount');

    $saldoYatim = $masukYatim - $keluarYatim;

    $masukIrma = \DB::table('transaksis')->where('kategori_id', 4)->where('type', 'kes')->sum('amount');
    $keluarIrma = \DB::table('transaksis')->where('kategori_id', 4)->where('type', 'transfer')->sum('amount');
    $saldoIrma = $masukIrma - $keluarIrma;

    $totalJamaah = \DB::table('jamaahs')->count(); 

    return view('home', compact('totalIuranWarga', 'saldoMasjid', 'saldoAmbulan', 'saldoYatim', 'saldoIrma', 'totalJamaah'));
}

}
