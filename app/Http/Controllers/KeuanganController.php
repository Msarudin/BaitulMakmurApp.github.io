<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Transaksi;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use RealRashid\SweetAlert\Facades\Alert;

class KeuanganController extends Controller
{
    // public function index(Request $request)
    // {
    //     $kategori = Kategori::all();

    //     // 1. TENTUKAN HARI JUMAT CLOSING SEBAGAI PATOKAN UTAMA
    //     if ($request->has('start_date')) {
    //         // Jika ada navigasi pindah minggu dari URL
    //         $jumatClosing = Carbon::parse($request->input('start_date'))->endOfDay();
    //     } else {
    //         // Default awal: Cari hari Jumat terdekat di minggu berjalan ini
    //         $hariIni = Carbon::now();
    //         if ($hariIni->dayOfWeek >= Carbon::FRIDAY) {
    //             $jumatClosing = $hariIni->copy()->next(Carbon::FRIDAY)->subWeek()->endOfDay();
    //         } else {
    //             $jumatClosing = $hariIni->copy()->previous(Carbon::FRIDAY)->endOfDay();
    //         }
    //     }

    //     // 2. KUNCI RENTANG TANGGAL (Pemasukan vs Pengeluaran sesuai aturan Anda)
    //     // Pemasukan: Jumat lalu s/d Kamis sebelum closing
    //     $pemasukanMulai  = $jumatClosing->copy()->subWeek()->startOfDay(); // Contoh: Jumat, 18 Sep 00:00
    //     $pemasukanSelesai = $jumatClosing->copy()->subDay()->endOfDay();     // Contoh: Kamis, 24 Sep 23:59

    //     // Pengeluaran: Sabtu s/d Jumat Closing
    //     $pengeluaranMulai  = $jumatClosing->copy()->subWeek()->addDay()->startOfDay(); // Contoh: Sabtu, 19 Sep 00:00
    //     $pengeluaranSelesai = $jumatClosing->copy();                                   // Contoh: Jumat, 25 Sep 23:59

    //     // URL Navigasi Pindah Minggu (Maju Mundur 7 Hari dari patokan jumatClosing)
    //     $prevWeekUrl = route('keuangan.index', ['start_date' => $jumatClosing->copy()->subWeek()->format('Y-m-d')]);
    //     $nextWeekUrl = route('keuangan.index', ['start_date' => $jumatClosing->copy()->addWeek()->format('Y-m-d')]);
    //     $currentWeekUrl = route('keuangan.index');

    //     // 3. HITUNG SALDO AWAL (Seluruh sisa saldo MASA LALU sebelum periode minggu ini dimulai)
    //     $saldoAwalPerKategori = [];
    //     foreach ($kategori as $cat) {
    //         // Pemasukan masa lalu: sebelum Jumat, 18 Sep
    //         $masukLalu = Transaksi::where('kategori_id', $cat->id)
    //             ->where('type', 'kes')
    //             ->where('tanggal_transaksi', '<', $pemasukanMulai)
    //             ->sum('amount');

    //         // Pengeluaran masa lalu: sebelum Sabtu, 19 Sep
    //         $keluarLalu = Transaksi::where('kategori_id', $cat->id)
    //             ->where('type', 'transfer')
    //             ->where('tanggal_transaksi', '<', $pengeluaranMulai)
    //             ->sum('amount');

    //         $saldoAwalPerKategori[$cat->id] = $masukLalu - $keluarLalu;
    //     }

    //     // 4. AMBIL DATA TRANSAKSI MINGGU INI (Digabung untuk looping baris tanggal harian)
    //     $transaksiMingguIni = Transaksi::with('kategori')
    //         ->where(function($query) use ($pemasukanMulai, $pemasukanSelesai) {
    //             $query->where('type', 'kes')->whereBetween('tanggal_transaksi', [$pemasukanMulai, $pemasukanSelesai]);
    //         })
    //         ->orWhere(function($query) use ($pengeluaranMulai, $pengeluaranSelesai) {
    //             $query->where('type', 'transfer')->whereBetween('tanggal_transaksi', [$pengeluaranMulai, $pengeluaranSelesai]);
    //         })
    //         ->orderBy('tanggal_transaksi', 'asc')
    //         ->get();

    //     // Kelompokkan data transaksi harian berdasarkan tanggal transaksi asli
    //     $harianGrup = $transaksiMingguIni->groupBy(function ($item) {
    //         return Carbon::parse($item->tanggal_transaksi)->format('Y-m-d');
    //     });

    //     // Masukkan modal saldo awal minggu lalu ke pembukuan berjalan minggu ini
    //     $runningBalances = $saldoAwalPerKategori;
    //     $weeklyReport = []; 

    //     foreach ($harianGrup as $tanggal => $items) {
    //         $tanggalFormat = Carbon::parse($tanggal)->format('d M Y');

    //         $kategoriData = [];
    //         foreach ($kategori as $cat) {
    //             $catItems = $items->where('kategori_id', $cat->id);
                
    //             // Ambil nilai nominal harian murni sesuai tipe transaksinya
    //             $kes = $catItems->where('type', 'kes')->sum('amount');
    //             $transfer = $catItems->where('type', 'transfer')->sum('amount');
                
    //             $listMasuk = $catItems->where('type', 'kes')->map(function($trans) {
    //                 return ['id' => $trans->id, 'keterangan' => $trans->keterangan, 'amount' => $trans->amount];
    //             })->values()->toArray();

    //             $listKeluar = $catItems->where('type', 'transfer')->map(function($trans) {
    //                 return ['id' => $trans->id, 'keterangan' => $trans->keterangan, 'amount' => $trans->amount];
    //             })->values()->toArray();

    //             // Akumulasikan ke Saldo Berjalan secara berurutan harian
    //             $runningBalances[$cat->id] += ($kes - $transfer);

    //             $kategoriData[$cat->id] = [
    //                 'list_masuk'  => $listMasuk,
    //                 'list_keluar' => $listKeluar,
    //                 'saldo'       => $runningBalances[$cat->id]
    //             ];
    //         }

    //         $weeklyReport[] = [
    //             'period' => $tanggalFormat,
    //             'data_per_kategori' => $kategoriData
    //         ];
    //     }

    //     // Tampilkan teks info periode gabungan di layar (Contoh: Periode: 18 Sep - 25 Sep 2026)
    //     $jumatLalu = $pemasukanMulai; 
    //     $jumatMendatang = $pengeluaranSelesai;

    //     // Cari bagian akhir fungsi index(), ganti return view-nya menjadi:
    //     return view('keuangan.kas_masjid', compact(
    //         'weeklyReport', 'kategori', 'prevWeekUrl', 'nextWeekUrl', 
    //         'currentWeekUrl', 'jumatLalu', 'jumatMendatang', 'saldoAwalPerKategori'
    //     ));
    // }

    public function store(Request $request)
    {
        if ($request->has('amount')) {
            $cleanAmount = str_replace('.', '', $request->input('amount'));
            $request->merge(['amount' => $cleanAmount]);
        }

        $validated = $request->validate([
            'kategori_id'       => 'required|exists:kategoris,id', 
            'tanggal_transaksi' => 'required|date',               
            'keterangan'        => 'required|string|max:255',
            'type'              => 'required|in:kes,transfer',    
            'amount'            => 'required|numeric|min:0',
        ]);

        // 1. Tampung hasil pembuatan data ke dalam variabel $transaksiBaru
        $transaksiBaru = Transaksi::create($validated);

        // 2. Ubah pesan alert menjadi "Data berhasil ditambahkan"
        Alert::success('Berhasil', 'Data berhasil ditambahkan');

        // 3. Alihkan halaman secara dinamis menggunakan kategori_id dari data yang baru dibuat
        switch ($transaksiBaru->kategori_id) {
            case 1:
                return redirect('/keuangan/kas-operasional');
            case 2:
                return redirect('/keuangan/kas-yatim');
            case 3:
                return redirect('/keuangan/kas-ambulan');
            case 4:
                return redirect('/keuangan/kas-irma');
            default:
                return redirect('/keuangan/kas-operasional');
        }
    }

    public function edit($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $kategori = Kategori::all();
        return view('keuangan.edit', compact('transaksi', 'kategori'));
    }

    public function update(Request $request, $id)
    {
        if ($request->has('amount')) {
            $cleanAmount = str_replace('.', '', $request->input('amount'));
            $request->merge(['amount' => $cleanAmount]);
        }

        $validated = $request->validate([
            'kategori_id'       => 'required|exists:kategoris,id', 
            'tanggal_transaksi' => 'required|date',               
            'keterangan'        => 'required|string|max:255',
            'type'              => 'required|in:kes,transfer',    
            'amount'            => 'required|numeric|min:0',
        ]);

        $transaksi = Transaksi::findOrFail($id);
        $transaksi->update($validated);
        Alert::success('Berhasil', 'Data berhasil diedit');
        // ==================== 🛠️ PERBAIKAN: REDIRECT DINAMIS SETELAH EDIT ====================
        switch ($transaksi->kategori_id) {
            case 1:
                return redirect('/keuangan/kas-operasional');
            case 2:
                return redirect('/keuangan/kas-yatim');
            case 3:
                return redirect('/keuangan/kas-ambulan');
            case 4:
                return redirect('/keuangan/kas-irma');
            default:
                return redirect('/keuangan/kas-operasional');
        }
    }

    public function destroy($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        
        // 1. Catat ID kategori kas sebelum datanya dihapus
        $kategoriId = $transaksi->kategori_id;
        
        // 2. Jalankan proses hapus data
        $transaksi->delete();
        Alert::success('Berhasil', 'Data berhasil dihapus');
        // 3. Alihkan halaman secara dinamis berdasarkan ID kategori kasnya
        switch ($kategoriId) {
            case 1:
                return redirect('/keuangan/kas-operasional');
            case 2:
                return redirect('/keuangan/kas-yatim');
            case 3:
                return redirect('/keuangan/kas-ambulan');
            case 4:
                return redirect('/keuangan/kas-irma');
            default:
                return redirect('/keuangan/kas-operasional');
        }
    }

    public function printLaporan(Request $request)
    {
        $kategori = \App\Models\Kategori::all();

        // ==================== 🛠️ MASUKKAN KODE BARU DI SINI (Baris 6 s/d 16) ====================
        if ($request->has('start_date') && $request->input('start_date') != '') {
            // Menangkap tanggal pindah minggu yang dikirimkan oleh tombol Cetak secara akurat
            $jumatClosing = \Carbon\Carbon::parse($request->input('start_date'))->endOfDay();
        } else {
            // Default awal jika tidak ada parameter tanggal di URL
            $hariIni = \Carbon\Carbon::now();
            if ($hariIni->dayOfWeek >= \Carbon\Carbon::FRIDAY) {
                $jumatClosing = $hariIni->copy()->next(\Carbon\Carbon::FRIDAY)->subWeek()->endOfDay();
            } else {
                $jumatClosing = $hariIni->copy()->previous(\Carbon\Carbon::FRIDAY)->endOfDay();
            }
        }

        // 2. KUNCI RENTANG TANGGAL (Pemasukan vs Pengeluaran sesuai aturan index Anda)
        $pemasukanMulai  = $jumatClosing->copy()->subWeek()->startOfDay(); 
        $pemasukanSelesai = $jumatClosing->copy()->subDay()->endOfDay();     

        $pengeluaranMulai  = $jumatClosing->copy()->subWeek()->addDay()->startOfDay(); 
        $pengeluaranSelesai = $jumatClosing->copy();                                   

        // Tangkap dropdown kustom filter kas dari halaman utama index
        $kasDipilih = $request->input('tampilkan_kas') ?? 'Kas Operasional';

        // Jika teks berisi spasi atau tanda tambah (+), kita normalkan agar terbaca pas dengan database
        $kasDipilih = str_replace('+', ' ', $kasDipilih);

        if ($kasDipilih && $kasDipilih !== 'semua') {
            $kategoriFilter = \App\Models\Kategori::where('name', 'LIKE', '%' . $kasDipilih . '%')->get();
        } else {
            $kategoriFilter = $kategori; 
        }

        // 3. HITUNG SALDO AWAL (Menyalin rumus modal sisa masa lalu dari fungsi index Anda)
        $saldoAwalPerKategori = [];
        foreach ($kategoriFilter as $cat) {
            $masukLalu = \App\Models\Transaksi::where('kategori_id', $cat->id)
                ->where('type', 'kes')
                ->where('tanggal_transaksi', '<', $pemasukanMulai)
                ->sum('amount');

            $keluarLalu = \App\Models\Transaksi::where('kategori_id', $cat->id)
                ->where('type', 'transfer')
                ->where('tanggal_transaksi', '<', $pengeluaranMulai)
                ->sum('amount');

            $saldoAwalPerKategori[$cat->id] = $masukLalu - $keluarLalu;
        }

        // 4. AMBIL DATA TRANSAKSI MINGGU INI (Menggunakan orWhere bergeser sesuai aturan index Anda)
        if ($kasDipilih && $kasDipilih !== 'semua') {
            $selectedCatIds = $kategoriFilter->pluck('id')->toArray();
            $transaksiMingguIni = \App\Models\Transaksi::whereIn('kategori_id', $selectedCatIds)
                ->where(function($query) use ($pemasukanMulai, $pemasukanSelesai, $pengeluaranMulai, $pengeluaranSelesai) {
                    $query->where(function($q) use ($pemasukanMulai, $pemasukanSelesai) {
                        $q->where('type', 'kes')->whereBetween('tanggal_transaksi', [$pemasukanMulai, $pemasukanSelesai]);
                    })
                    ->orWhere(function($q) use ($pengeluaranMulai, $pengeluaranSelesai) {
                        $q->where('type', 'transfer')->whereBetween('tanggal_transaksi', [$pengeluaranMulai, $pengeluaranSelesai]);
                    });
                })
                ->orderBy('tanggal_transaksi', 'asc')
                ->get();
        } else {
            $transaksiMingguIni = \App\Models\Transaksi::where(function($query) use ($pemasukanMulai, $pemasukanSelesai) {
                    $query->where('type', 'kes')->whereBetween('tanggal_transaksi', [$pemasukanMulai, $pemasukanSelesai]);
                })
                ->orWhere(function($query) use ($pengeluaranMulai, $pengeluaranSelesai) {
                    $query->where('type', 'transfer')->whereBetween('tanggal_transaksi', [$pengeluaranMulai, $pengeluaranSelesai]);
                })
                ->orderBy('tanggal_transaksi', 'asc')
                ->get();
        }

        // Kelompokkan data transaksi harian berdasarkan tanggal transaksi asli
        $harianGrup = $transaksiMingguIni->groupBy(function ($item) {
            return \Carbon\Carbon::parse($item->tanggal_transaksi)->format('Y-m-d');
        });

        $runningBalances = $saldoAwalPerKategori;
        $weeklyReport = []; 

        foreach ($harianGrup as $tanggal => $items) {
            $tanggalFormat = \Carbon\Carbon::parse($tanggal)->format('d M Y');

            $kategoriData = [];
            foreach ($kategoriFilter as $cat) {
                $catItems = $items->where('kategori_id', $cat->id);
                
                $kes = $catItems->where('type', 'kes')->sum('amount');
                $transfer = $catItems->where('type', 'transfer')->sum('amount');
                
                $listMasuk = $catItems->where('type', 'kes')->map(function($trans) {
                    return ['keterangan' => $trans->keterangan, 'amount' => $trans->amount];
                })->values()->toArray();

                $listKeluar = $catItems->where('type', 'transfer')->map(function($trans) {
                    return ['keterangan' => $trans->keterangan, 'amount' => $trans->amount];
                })->values()->toArray();

                // Akumulasikan ke Saldo Berjalan secara berurutan harian
                $runningBalances[$cat->id] += ($kes - $transfer);

                $kategoriData[$cat->id] = [
                    'list_masuk'  => $listMasuk,
                    'list_keluar' => $listKeluar,
                    'saldo'       => $runningBalances[$cat->id]
                ];
            }

            $weeklyReport[] = [
                'period' => $tanggalFormat,
                'data_per_kategori' => $kategoriData
            ];
        }

        $jumatLalu = $pemasukanMulai; 
        $jumatMendatang = $pengeluaranSelesai;
        
        // Buat dummy saldo awal real gabungan untuk inisialisasi awal baris pertama di file blade cetak
        $saldoAwalReal = $kategoriFilter->count() === 1 ? ($saldoAwalPerKategori[$kategoriFilter->first()->id] ?? 0) : array_sum($saldoAwalPerKategori);
        
        // Kita ubah variabel kategoriFilter menjadi variabel bernama $kategori agar cocok dengan loop di cetak.blade.php
        $kategori = $kategoriFilter;

        // PERBAIKAN: Fungsi compact() sekarang diisi dengan string nama variabel secara benar
        return view('keuangan.cetak', compact('weeklyReport', 'kategori', 'jumatLalu', 'jumatMendatang', 'saldoAwalReal'));
    }

     // ==================== 🖨️ CETAK KHUSUS KAS IRMA (Untuk kas_irma.blade.php) ====================
    public function printLaporanIrma(Request $request)
    {
        // 1. TENTUKAN HARI JUMAT CLOSING SEBAGAI PATOKAN UTAMA
        if ($request->has('start_date') && $request->input('start_date') != '') {
            $jumatClosing = \Carbon\Carbon::parse($request->input('start_date'))->endOfDay();
        } else {
            $hariIni = \Carbon\Carbon::now();
            if ($hariIni->dayOfWeek >= \Carbon\Carbon::FRIDAY) {
                $jumatClosing = $hariIni->copy()->next(\Carbon\Carbon::FRIDAY)->subWeek()->endOfDay();
            } else {
                $jumatClosing = $hariIni->copy()->previous(\Carbon\Carbon::FRIDAY)->endOfDay();
            }
        }

        // 2. KUNCI RENTANG TANGGAL (Pemasukan vs Pengeluaran)
        $pemasukanMulai  = $jumatClosing->copy()->subWeek()->startOfDay(); 
        $pemasukanSelesai = $jumatClosing->copy()->subDay()->endOfDay();     
        $pengeluaranMulai  = $jumatClosing->copy()->subWeek()->addDay()->startOfDay(); 
        $pengeluaranSelesai = $jumatClosing->copy();                                   

        $kategori = \App\Models\Kategori::where('id', 4)->first();

        // 3. HITUNG SALDO AWAL (Masa lalu sebelum minggu ini berjalan)
        $masukLalu = \App\Models\Transaksi::where('kategori_id', 4)->where('type', 'kes')->where('tanggal_transaksi', '<', $pemasukanMulai)->sum('amount');
        $keluarLalu = \App\Models\Transaksi::where('kategori_id', 4)->where('type', 'transfer')->where('tanggal_transaksi', '<', $pengeluaranMulai)->sum('amount');
        $saldoAwalReal = $masukLalu - $keluarLalu;

        // 4. AMBIL DATA TRANSAKSI MINGGU INI (Hanya hari bertransaksi)
        $transaksiMingguIni = \App\Models\Transaksi::where('kategori_id', 4)
            ->where(function($query) use ($pemasukanMulai, $pemasukanSelesai, $pengeluaranMulai, $pengeluaranSelesai) {
                $query->where(function($q) use ($pemasukanMulai, $pemasukanSelesai) {
                    $q->where('type', 'kes')->whereBetween('tanggal_transaksi', [$pemasukanMulai, $pemasukanSelesai]);
                })->orWhere(function($q) use ($pengeluaranMulai, $pengeluaranSelesai) {
                    $q->where('type', 'transfer')->whereBetween('tanggal_transaksi', [$pengeluaranMulai, $pengeluaranSelesai]);
                });
            })->orderBy('tanggal_transaksi', 'asc')->get();

        // Kelompokkan harian berdasarkan data transaksi asli yang ada
        $harianGrup = $transaksiMingguIni->groupBy(function ($item) {
            return \Carbon\Carbon::parse($item->tanggal_transaksi)->format('Y-m-d');
        });

        $runningBalance = $saldoAwalReal;
        $weeklyReport = []; 

        foreach ($harianGrup as $tanggal => $items) {
            $tanggalFormat = \Carbon\Carbon::parse($tanggal)->locale('id')->translatedFormat('d M Y');
            $kes = $items->where('type', 'kes')->sum('amount');
            $transfer = $items->where('type', 'transfer')->sum('amount');

            $listMasuk = $items->where('type', 'kes')->map(function($trans) {
                return ['keterangan' => $trans->keterangan, 'amount' => $trans->amount];
            })->values()->toArray();

            $listKeluar = $items->where('type', 'transfer')->map(function($trans) {
                return ['keterangan' => $trans->keterangan, 'amount' => $trans->amount];
            })->values()->toArray();

            // Akumulasi saldo berjalan harian merambat ke samping kanan
            $runningBalance += ($kes - $transfer);
            
            $weeklyReport[] = [
                'period' => $tanggalFormat, 
                'list_masuk' => $listMasuk, 
                'list_keluar' => $listKeluar, 
                'saldo_akhir' => $runningBalance
            ];
        }

        $jumatLalu = $pemasukanMulai; 
        $jumatMendatang = $pengeluaranSelesai;

        return view('keuangan.cetak_irma', compact('weeklyReport', 'kategori', 'jumatLalu', 'jumatMendatang', 'saldoAwalReal'));
    }

    // ==================== 🖨️ CETAK KHUSUS KAS AMBULAN (Untuk kas_ambulan.blade.php) ====================
    public function printLaporanAmbulan(Request $request)
    {
        // 1. TENTUKAN HARI JUMAT CLOSING SEBAGAI PATOKAN UTAMA
        if ($request->has('start_date') && $request->input('start_date') != '') {
            $jumatClosing = \Carbon\Carbon::parse($request->input('start_date'))->endOfDay();
        } else {
            $hariIni = \Carbon\Carbon::now();
            if ($hariIni->dayOfWeek >= \Carbon\Carbon::FRIDAY) {
                $jumatClosing = $hariIni->copy()->next(\Carbon\Carbon::FRIDAY)->subWeek()->endOfDay();
            } else {
                $jumatClosing = $hariIni->copy()->previous(\Carbon\Carbon::FRIDAY)->endOfDay();
            }
        }

        // 2. KUNCI RENTANG TANGGAL (Pemasukan vs Pengeluaran)
        $pemasukanMulai  = $jumatClosing->copy()->subWeek()->startOfDay(); 
        $pemasukanSelesai = $jumatClosing->copy()->subDay()->endOfDay();     
        $pengeluaranMulai  = $jumatClosing->copy()->subWeek()->addDay()->startOfDay(); 
        $pengeluaranSelesai = $jumatClosing->copy();                                   

        $kategori = \App\Models\Kategori::where('id', 3)->first();

        // 3. HITUNG SALDO AWAL (Masa lalu sebelum minggu ini berjalan)
        $masukLalu = \App\Models\Transaksi::where('kategori_id', 3)->where('type', 'kes')->where('tanggal_transaksi', '<', $pemasukanMulai)->sum('amount');
        $keluarLalu = \App\Models\Transaksi::where('kategori_id', 3)->where('type', 'transfer')->where('tanggal_transaksi', '<', $pengeluaranMulai)->sum('amount');
        $saldoAwalReal = $masukLalu - $keluarLalu;

        // 4. AMBIL DATA TRANSAKSI MINGGU INI (Hanya hari bertransaksi)
        $transaksiMingguIni = \App\Models\Transaksi::where('kategori_id', 3)
            ->where(function($query) use ($pemasukanMulai, $pemasukanSelesai, $pengeluaranMulai, $pengeluaranSelesai) {
                $query->where(function($q) use ($pemasukanMulai, $pemasukanSelesai) {
                    $q->where('type', 'kes')->whereBetween('tanggal_transaksi', [$pemasukanMulai, $pemasukanSelesai]);
                })->orWhere(function($q) use ($pengeluaranMulai, $pengeluaranSelesai) {
                    $q->where('type', 'transfer')->whereBetween('tanggal_transaksi', [$pengeluaranMulai, $pengeluaranSelesai]);
                });
            })->orderBy('tanggal_transaksi', 'asc')->get();

        // Kelompokkan harian berdasarkan data transaksi asli yang ada
        $harianGrup = $transaksiMingguIni->groupBy(function ($item) {
            return \Carbon\Carbon::parse($item->tanggal_transaksi)->format('Y-m-d');
        });

        $runningBalance = $saldoAwalReal;
        $weeklyReport = []; 

        foreach ($harianGrup as $tanggal => $items) {
            $tanggalFormat = \Carbon\Carbon::parse($tanggal)->locale('id')->translatedFormat('d M Y');
            $kes = $items->where('type', 'kes')->sum('amount');
            $transfer = $items->where('type', 'transfer')->sum('amount');

            $listMasuk = $items->where('type', 'kes')->map(function($trans) {
                return ['keterangan' => $trans->keterangan, 'amount' => $trans->amount];
            })->values()->toArray();

            $listKeluar = $items->where('type', 'transfer')->map(function($trans) {
                return ['keterangan' => $trans->keterangan, 'amount' => $trans->amount];
            })->values()->toArray();

            // Akumulasi saldo berjalan harian merambat ke samping kanan
            $runningBalance += ($kes - $transfer);
            
            $weeklyReport[] = [
                'period' => $tanggalFormat, 
                'list_masuk' => $listMasuk, 
                'list_keluar' => $listKeluar, 
                'saldo_akhir' => $runningBalance
            ];
        }

        $jumatLalu = $pemasukanMulai; 
        $jumatMendatang = $pengeluaranSelesai;

        return view('keuangan.cetak_ambulan', compact('weeklyReport', 'kategori', 'jumatLalu', 'jumatMendatang', 'saldoAwalReal'));
    }

    // ==================== 🖨️ CETAK KHUSUS KAS YATIM (Untuk kas_yatim.blade.php) ====================
    public function printLaporanYatim(Request $request)
    {
        // 1. TENTUKAN HARI JUMAT CLOSING SEBAGAI PATOKAN UTAMA
        if ($request->has('start_date') && $request->input('start_date') != '') {
            $jumatClosing = \Carbon\Carbon::parse($request->input('start_date'))->endOfDay();
        } else {
            $hariIni = \Carbon\Carbon::now();
            if ($hariIni->dayOfWeek >= \Carbon\Carbon::FRIDAY) {
                $jumatClosing = $hariIni->copy()->next(\Carbon\Carbon::FRIDAY)->subWeek()->endOfDay();
            } else {
                $jumatClosing = $hariIni->copy()->previous(\Carbon\Carbon::FRIDAY)->endOfDay();
            }
        }

        // 2. KUNCI RENTANG TANGGAL
        $pemasukanMulai  = $jumatClosing->copy()->subWeek()->startOfDay(); 
        $pemasukanSelesai = $jumatClosing->copy()->subDay()->endOfDay();     
        $pengeluaranMulai  = $jumatClosing->copy()->subWeek()->addDay()->startOfDay(); 
        $pengeluaranSelesai = $jumatClosing->copy();                                   

        $kategori = \App\Models\Kategori::where('id', 2)->first();

        // 3. HITUNG SALDO AWAL (Gunakan logika yang sama seperti index utama Anda)
        $masukLalu = \App\Models\Transaksi::where('kategori_id', 2)
            ->where('type', 'kes')
            ->where('tanggal_transaksi', '<', $pemasukanMulai)
            ->sum('amount');

        $keluarLalu = \App\Models\Transaksi::where('kategori_id', 2)
            ->where('type', 'transfer')
            ->where('tanggal_transaksi', '<', $pengeluaranMulai)
            ->sum('amount');

        $saldoAwalReal = $masukLalu - $keluarLalu;

        // 4. AMBIL DATA TRANSAKSI MINGGU INI
        $transaksiMingguIni = \App\Models\Transaksi::where('kategori_id', 2)
            ->where(function($query) use ($pemasukanMulai, $pemasukanSelesai, $pengeluaranMulai, $pengeluaranSelesai) {
                $query->where(function($q) use ($pemasukanMulai, $pemasukanSelesai) {
                    $q->where('type', 'kes')->whereBetween('tanggal_transaksi', [$pemasukanMulai, $pemasukanSelesai]);
                })->orWhere(function($q) use ($pengeluaranMulai, $pengeluaranSelesai) {
                    $q->where('type', 'transfer')->whereBetween('tanggal_transaksi', [$pengeluaranMulai, $pengeluaranSelesai]);
                });
            })->orderBy('tanggal_transaksi', 'asc')->get();

        $harianGrup = $transaksiMingguIni->groupBy(function ($item) {
            return \Carbon\Carbon::parse($item->tanggal_transaksi)->format('Y-m-d');
        });

        // Set running balance awal dari $saldoAwalReal agar akumulasi baris ke baris sinkron
        $runningBalance = $saldoAwalReal;
        $weeklyReport = []; 

        foreach ($harianGrup as $tanggal => $items) {
            $tanggalFormat = \Carbon\Carbon::parse($tanggal)->locale('id')->translatedFormat('d M Y');
            $kes = $items->where('type', 'kes')->sum('amount');
            $transfer = $items->where('type', 'transfer')->sum('amount');

            $listMasuk = $items->where('type', 'kes')->map(function($trans) {
                return ['keterangan' => $trans->keterangan, 'amount' => $trans->amount];
            })->values()->toArray();

            $listKeluar = $items->where('type', 'transfer')->map(function($trans) {
                return ['keterangan' => $trans->keterangan, 'amount' => $trans->amount];
            })->values()->toArray();

            $runningBalance += ($kes - $transfer);
            
            $weeklyReport[] = [
                'period' => $tanggalFormat, 
                'list_masuk' => $listMasuk, 
                'list_keluar' => $listKeluar, 
                'saldo_akhir' => $runningBalance
            ];
        }

        $jumatLalu = $pemasukanMulai; 
        $jumatMendatang = $pengeluaranSelesai;

        return view('keuangan.cetak_yatim', compact('weeklyReport', 'kategori', 'jumatLalu', 'jumatMendatang', 'saldoAwalReal'));
    }
    // ==================== 🛠️ TAMBAHAN FUNGSI FILE TERPISAH KAS MASJID ====================
    public function kasMasjid(Request $request) 
    {

        if ($request->has('saldo_input_manual')) {
            \Illuminate\Support\Facades\Cache::forever('saldo_manual_masjid', $request->input('saldo_input_manual'));
            
            Alert::success('Berhasil', 'Saldo halaman user berhasil diperbarui!');
            return redirect()->to($request->url());
        }
            $kategori = \App\Models\Kategori::where('id', 1)->get(); // Mengunci kategori hanya untuk Kas Masjid

            // 1. TENTUKAN HARI JUMAT CLOSING SEBAGAI PATOKAN UTAMA
            if ($request->has('start_date')) {
                $jumatClosing = \Carbon\Carbon::parse($request->input('start_date'))->endOfDay();
            } else {
                $hariIni = \Carbon\Carbon::now();
                if ($hariIni->dayOfWeek >= \Carbon\Carbon::FRIDAY) {
                    $jumatClosing = $hariIni->copy()->next(\Carbon\Carbon::FRIDAY)->subWeek()->endOfDay();
                } else {
                    $jumatClosing = $hariIni->copy()->previous(\Carbon\Carbon::FRIDAY)->endOfDay();
                }
            }

        // 🟢 GANTI KODE INI: Simpan tanggal periode aktif menggunakan Laravel Cache (Bebas Error Database)
        \Illuminate\Support\Facades\Cache::forever('tanggal_periode_aktif_masjid', $jumatClosing->format('Y-m-d'));


            // 2. KUNCI RENTANG TANGGAL (Pemasukan vs Pengeluaran)
            $pemasukanMulai  = $jumatClosing->copy()->subWeek()->startOfDay(); 
            $pemasukanSelesai = $jumatClosing->copy()->subDay()->endOfDay();     

            $pengeluaranMulai  = $jumatClosing->copy()->subWeek()->addDay()->startOfDay(); 
            $pengeluaranSelesai = $jumatClosing->copy();                                   

            //URL Navigasi Pindah Minggu menggunakan URL Direct (Solusi Bebas Eror Route)
            $prevWeekUrl = url('/keuangan/kas-operasional?start_date=' . $jumatClosing->copy()->subWeek()->format('Y-m-d'));
            $nextWeekUrl = url('/keuangan/kas-operasional?start_date=' . $jumatClosing->copy()->addWeek()->format('Y-m-d'));
            $currentWeekUrl = url('/keuangan/kas-operasional');


            // 3. HITUNG SALDO AWAL (Masa lalu sebelum minggu ini berjalan)
            $saldoAwalPerKategori = [];
            foreach ($kategori as $cat) {
                $masukLalu = \App\Models\Transaksi::where('kategori_id', $cat->id)
                    ->where('type', 'kes')
                    ->where('tanggal_transaksi', '<', $pemasukanMulai)
                    ->sum('amount');

                $keluarLalu = \App\Models\Transaksi::where('kategori_id', $cat->id)
                    ->where('type', 'transfer')
                    ->where('tanggal_transaksi', '<', $pengeluaranMulai)
                    ->sum('amount');

                $saldoAwalPerKategori[$cat->id] = $masukLalu - $keluarLalu;
            }

            // 4. AMBIL DATA TRANSAKSI MINGGU INI
            $transaksiMingguIni = \App\Models\Transaksi::with('kategori')
                ->where('kategori_id', 1)
                ->where(function($query) use ($pemasukanMulai, $pemasukanSelesai, $pengeluaranMulai, $pengeluaranSelesai) {
                    $query->where(function($q) use ($pemasukanMulai, $pemasukanSelesai) {
                        $q->where('type', 'kes')->whereBetween('tanggal_transaksi', [$pemasukanMulai, $pemasukanSelesai]);
                    })->orWhere(function($q) use ($pengeluaranMulai, $pengeluaranSelesai) {
                        $q->where('type', 'transfer')->whereBetween('tanggal_transaksi', [$pengeluaranMulai, $pengeluaranSelesai]);
                    });
                })
                ->orderBy('tanggal_transaksi', 'asc')
                ->get();

            // Kelompokkan harian
            $harianGrup = $transaksiMingguIni->groupBy(function ($item) {
                return \Carbon\Carbon::parse($item->tanggal_transaksi)->format('Y-m-d');
            });

            $runningBalances = $saldoAwalPerKategori;
            $weeklyReport = []; 

            foreach ($harianGrup as $tanggal => $items) {
                $tanggalFormat = \Carbon\Carbon::parse($tanggal)->locale('id')->translatedFormat('d M Y');

                $kategoriData = [];
                foreach ($kategori as $cat) {
                    $catItems = $items->where('kategori_id', $cat->id);
                    
                    $kes = $catItems->where('type', 'kes')->sum('amount');
                    $transfer = $catItems->where('type', 'transfer')->sum('amount');
                    
                    $listMasuk = $catItems->where('type', 'kes')->map(function($trans) {
                        return ['id' => $trans->id, 'keterangan' => $trans->keterangan, 'amount' => $trans->amount];
                    })->values()->toArray();

                    $listKeluar = $catItems->where('type', 'transfer')->map(function($trans) {
                        return ['id' => $trans->id, 'keterangan' => $trans->keterangan, 'amount' => $trans->amount];
                    })->values()->toArray();

                    $runningBalances[$cat->id] += ($kes - $transfer);

                    $kategoriData[$cat->id] = [
                        'list_masuk'  => $listMasuk,
                        'list_keluar' => $listKeluar,
                        'saldo'       => $runningBalances[$cat->id]
                    ];
                }

                $weeklyReport[] = [
                    'period' => $tanggalFormat,
                    'data_per_kategori' => $kategoriData
                ];
            }

            $jumatLalu = $pemasukanMulai; 
            $jumatMendatang = $pengeluaranSelesai;

            return view('keuangan.kas_masjid', compact(
                'weeklyReport', 'kategori', 'prevWeekUrl', 'nextWeekUrl', 
                'currentWeekUrl', 'jumatLalu', 'jumatMendatang', 'saldoAwalPerKategori'
            ));
    }

    // ==================== 🚑 FUNGSI DINAMIS UNTUK KAS AMBULAN ====================
    public function kasAmbulan(Request $request) 
    {
        $kategori = \App\Models\Kategori::where('id', 3)->get(); // Mengunci kategori hanya untuk Kas Ambulan

        // 1. TENTUKAN HARI JUMAT CLOSING SEBAGAI PATOKAN UTAMA
        if ($request->has('start_date')) {
            $jumatClosing = \Carbon\Carbon::parse($request->input('start_date'))->endOfDay();
        } else {
            $hariIni = \Carbon\Carbon::now();
            if ($hariIni->dayOfWeek >= \Carbon\Carbon::FRIDAY) {
                $jumatClosing = $hariIni->copy()->next(\Carbon\Carbon::FRIDAY)->subWeek()->endOfDay();
            } else {
                $jumatClosing = $hariIni->copy()->previous(\Carbon\Carbon::FRIDAY)->endOfDay();
            }
        }

        // 2. KUNCI RENTANG TANGGAL (Pemasukan vs Pengeluaran)
        $pemasukanMulai  = $jumatClosing->copy()->subWeek()->startOfDay(); 
        $pemasukanSelesai = $jumatClosing->copy()->subDay()->endOfDay();     

        $pengeluaranMulai  = $jumatClosing->copy()->subWeek()->addDay()->startOfDay(); 
        $pengeluaranSelesai = $jumatClosing->copy();                                   

        // URL Navigasi Pindah Minggu menggunakan URL Direct (Solusi Bebas Eror Route)
        $prevWeekUrl = url('/keuangan/kas-ambulan?start_date=' . $jumatClosing->copy()->subWeek()->format('Y-m-d'));
        $nextWeekUrl = url('/keuangan/kas-ambulan?start_date=' . $jumatClosing->copy()->addWeek()->format('Y-m-d'));
        $currentWeekUrl = url('/keuangan/kas-ambulan');


        // 3. HITUNG SALDO AWAL (Masa lalu sebelum minggu ini berjalan)
        $saldoAwalPerKategori = [];
        foreach ($kategori as $cat) {
            $masukLalu = \App\Models\Transaksi::where('kategori_id', $cat->id)
                ->where('type', 'kes')
                ->where('tanggal_transaksi', '<', $pemasukanMulai)
                ->sum('amount');

            $keluarLalu = \App\Models\Transaksi::where('kategori_id', $cat->id)
                ->where('type', 'transfer')
                ->where('tanggal_transaksi', '<', $pengeluaranMulai)
                ->sum('amount');

            $saldoAwalPerKategori[$cat->id] = $masukLalu - $keluarLalu;
        }

        // 4. AMBIL DATA TRANSAKSI MINGGU INI
        $transaksiMingguIni = \App\Models\Transaksi::with('kategori')
            ->where('kategori_id', 3)
            ->where(function($query) use ($pemasukanMulai, $pemasukanSelesai, $pengeluaranMulai, $pengeluaranSelesai) {
                $query->where(function($q) use ($pemasukanMulai, $pemasukanSelesai) {
                    $q->where('type', 'kes')->whereBetween('tanggal_transaksi', [$pemasukanMulai, $pemasukanSelesai]);
                })->orWhere(function($q) use ($pengeluaranMulai, $pengeluaranSelesai) {
                    $q->where('type', 'transfer')->whereBetween('tanggal_transaksi', [$pengeluaranMulai, $pengeluaranSelesai]);
                });
            })
            ->orderBy('tanggal_transaksi', 'asc')
            ->get();

        // Kelompokkan harian
        $harianGrup = $transaksiMingguIni->groupBy(function ($item) {
            return \Carbon\Carbon::parse($item->tanggal_transaksi)->format('Y-m-d');
        });

        $runningBalances = $saldoAwalPerKategori;
        $weeklyReport = []; 

        foreach ($harianGrup as $tanggal => $items) {
            $tanggalFormat = \Carbon\Carbon::parse($tanggal)->locale('id')->translatedFormat('d M Y');

            $kategoriData = [];
            foreach ($kategori as $cat) {
                $catItems = $items->where('kategori_id', $cat->id);
                
                $kes = $catItems->where('type', 'kes')->sum('amount');
                $transfer = $catItems->where('type', 'transfer')->sum('amount');
                
                $listMasuk = $catItems->where('type', 'kes')->map(function($trans) {
                    return ['id' => $trans->id, 'keterangan' => $trans->keterangan, 'amount' => $trans->amount];
                })->values()->toArray();

                $listKeluar = $catItems->where('type', 'transfer')->map(function($trans) {
                    return ['id' => $trans->id, 'keterangan' => $trans->keterangan, 'amount' => $trans->amount];
                })->values()->toArray();

                $runningBalances[$cat->id] += ($kes - $transfer);

                $kategoriData[$cat->id] = [
                    'list_masuk'  => $listMasuk,
                    'list_keluar' => $listKeluar,
                    'saldo'       => $runningBalances[$cat->id]
                ];
            }

            $weeklyReport[] = [
                'period' => $tanggalFormat,
                'data_per_kategori' => $kategoriData
            ];
        }

        $jumatLalu = $pemasukanMulai; 
        $jumatMendatang = $pengeluaranSelesai;

        return view('keuangan.kas_ambulan', compact(
            'weeklyReport', 'kategori', 'prevWeekUrl', 'nextWeekUrl', 
            'currentWeekUrl', 'jumatLalu', 'jumatMendatang', 'saldoAwalPerKategori'
        ));
    }

    // ==================== 🛠️ TAMBAHAN FUNGSI FILE TERPISAH KAS YATIM ====================
    public function kasYatim(Request $request) 
    {
        $kategori = \App\Models\Kategori::where('id', 2)->get(); // Mengunci kategori hanya untuk Kas Yatim

        // 1. TENTUKAN HARI JUMAT CLOSING SEBAGAI PATOKAN UTAMA
        if ($request->has('start_date') && $request->input('start_date') != '') {
            $jumatClosing = \Carbon\Carbon::parse($request->input('start_date'))->endOfDay();
        } else {
            $hariIni = \Carbon\Carbon::now();
            if ($hariIni->dayOfWeek >= \Carbon\Carbon::FRIDAY) {
                $jumatClosing = $hariIni->copy()->next(\Carbon\Carbon::FRIDAY)->subWeek()->endOfDay();
            } else {
                $jumatClosing = $hariIni->copy()->previous(\Carbon\Carbon::FRIDAY)->endOfDay();
            }
        }

        // 2. KUNCI RENTANG TANGGAL (Pemasukan vs Pengeluaran)
        $pemasukanMulai  = $jumatClosing->copy()->subWeek()->startOfDay(); 
        $pemasukanSelesai = $jumatClosing->copy()->subDay()->endOfDay();     

        $pengeluaranMulai  = $jumatClosing->copy()->subWeek()->addDay()->startOfDay(); 
        $pengeluaranSelesai = $jumatClosing->copy();                                   

        // URL Navigasi Pindah Minggu menggunakan URL Direct (Solusi Bebas Eror Route)
        $prevWeekUrl = url('/keuangan/kas-yatim?start_date=' . $jumatClosing->copy()->subWeek()->format('Y-m-d'));
        $nextWeekUrl = url('/keuangan/kas-yatim?start_date=' . $jumatClosing->copy()->addWeek()->format('Y-m-d'));
        $currentWeekUrl = url('/keuangan/kas-yatim');


        // 3. HITUNG SALDO AWAL (Masa lalu sebelum minggu ini berjalan)
        $saldoAwalPerKategori = [];
        foreach ($kategori as $cat) {
            $masukLalu = \App\Models\Transaksi::where('kategori_id', $cat->id)
                ->where('type', 'kes')
                ->where('tanggal_transaksi', '<', $pemasukanMulai)
                ->sum('amount');

            $keluarLalu = \App\Models\Transaksi::where('kategori_id', $cat->id)
                ->where('type', 'transfer')
                ->where('tanggal_transaksi', '<', $pengeluaranMulai)
                ->sum('amount');

            $saldoAwalPerKategori[$cat->id] = $masukLalu - $keluarLalu;
        }

        // 4. AMBIL DATA TRANSAKSI MINGGU INI
        $transaksiMingguIni = \App\Models\Transaksi::with('kategori')
            ->where('kategori_id', 2)
            ->where(function($query) use ($pemasukanMulai, $pemasukanSelesai, $pengeluaranMulai, $pengeluaranSelesai) {
                $query->where(function($q) use ($pemasukanMulai, $pemasukanSelesai) {
                    $q->where('type', 'kes')->whereBetween('tanggal_transaksi', [$pemasukanMulai, $pemasukanSelesai]);
                })->orWhere(function($q) use ($pengeluaranMulai, $pengeluaranSelesai) {
                    $q->where('type', 'transfer')->whereBetween('tanggal_transaksi', [$pengeluaranMulai, $pengeluaranSelesai]);
                });
            })
            ->orderBy('tanggal_transaksi', 'asc')
            ->get();

        // Kelompokkan harian
        $harianGrup = $transaksiMingguIni->groupBy(function ($item) {
            return \Carbon\Carbon::parse($item->tanggal_transaksi)->format('Y-m-d');
        });

        $runningBalances = $saldoAwalPerKategori;
        $weeklyReport = []; 

        foreach ($harianGrup as $tanggal => $items) {
            $tanggalFormat = \Carbon\Carbon::parse($tanggal)->locale('id')->translatedFormat('d M Y');

            $kategoriData = [];
            foreach ($kategori as $cat) {
                $catItems = $items->where('kategori_id', $cat->id);
                
                $kes = $catItems->where('type', 'kes')->sum('amount');
                $transfer = $catItems->where('type', 'transfer')->sum('amount');
                
                $listMasuk = $catItems->where('type', 'kes')->map(function($trans) {
                    return ['id' => $trans->id, 'keterangan' => $trans->keterangan, 'amount' => $trans->amount];
                })->values()->toArray();

                $listKeluar = $catItems->where('type', 'transfer')->map(function($trans) {
                    return ['id' => $trans->id, 'keterangan' => $trans->keterangan, 'amount' => $trans->amount];
                })->values()->toArray();

                $runningBalances[$cat->id] += ($kes - $transfer);

                $kategoriData[$cat->id] = [
                    'list_masuk'  => $listMasuk,
                    'list_keluar' => $listKeluar,
                    'saldo'       => $runningBalances[$cat->id]
                ];
            }

            $weeklyReport[] = [
                'period' => $tanggalFormat,
                'data_per_kategori' => $kategoriData
            ];
        }

        $jumatLalu = $pemasukanMulai; 
        $jumatMendatang = $pengeluaranSelesai;

        return view('keuangan.kas_yatim', compact(
            'weeklyReport', 'kategori', 'prevWeekUrl', 'nextWeekUrl', 
            'currentWeekUrl', 'jumatLalu', 'jumatMendatang', 'saldoAwalPerKategori'
        ));
    }

    // ==================== 🛠️ TAMBAHAN FUNGSI FILE TERPISAH KAS IRMA ====================
    public function kasIrma(Request $request) 
    {
        $kategori = \App\Models\Kategori::where('id', 4)->get(); // Mengunci kategori hanya untuk Kas Irma

        // 1. TENTUKAN HARI JUMAT CLOSING SEBAGAI PATOKAN UTAMA
        if ($request->has('start_date') && $request->input('start_date') != '') {
            $jumatClosing = \Carbon\Carbon::parse($request->input('start_date'))->endOfDay();
        } else {
            $hariIni = \Carbon\Carbon::now();
            if ($hariIni->dayOfWeek >= \Carbon\Carbon::FRIDAY) {
                $jumatClosing = $hariIni->copy()->next(\Carbon\Carbon::FRIDAY)->subWeek()->endOfDay();
            } else {
                $jumatClosing = $hariIni->copy()->previous(\Carbon\Carbon::FRIDAY)->endOfDay();
            }
        }

        // 2. KUNCI RENTANG TANGGAL (Pemasukan vs Pengeluaran)
        $pemasukanMulai  = $jumatClosing->copy()->subWeek()->startOfDay(); 
        $pemasukanSelesai = $jumatClosing->copy()->subDay()->endOfDay();     

        $pengeluaranMulai  = $jumatClosing->copy()->subWeek()->addDay()->startOfDay(); 
        $pengeluaranSelesai = $jumatClosing->copy();                                   

        // URL Navigasi Pindah Minggu menggunakan URL Direct (Solusi Bebas Eror Route)
        $prevWeekUrl = url('/keuangan/kas-irma?start_date=' . $jumatClosing->copy()->subWeek()->format('Y-m-d'));
        $nextWeekUrl = url('/keuangan/kas-irma?start_date=' . $jumatClosing->copy()->addWeek()->format('Y-m-d'));
        $currentWeekUrl = url('/keuangan/kas-irma');


        // 3. HITUNG SALDO AWAL (Masa lalu sebelum minggu ini berjalan)
        $saldoAwalPerKategori = [];
        foreach ($kategori as $cat) {
            $masukLalu = \App\Models\Transaksi::where('kategori_id', $cat->id)
                ->where('type', 'kes')
                ->where('tanggal_transaksi', '<', $pemasukanMulai)
                ->sum('amount');

            $keluarLalu = \App\Models\Transaksi::where('kategori_id', $cat->id)
                ->where('type', 'transfer')
                ->where('tanggal_transaksi', '<', $pengeluaranMulai)
                ->sum('amount');

            $saldoAwalPerKategori[$cat->id] = $masukLalu - $keluarLalu;
        }

        // 4. AMBIL DATA TRANSAKSI MINGGU INI
        $transaksiMingguIni = \App\Models\Transaksi::with('kategori')
            ->where('kategori_id', 4)
            ->where(function($query) use ($pemasukanMulai, $pemasukanSelesai, $pengeluaranMulai, $pengeluaranSelesai) {
                $query->where(function($q) use ($pemasukanMulai, $pemasukanSelesai) {
                    $q->where('type', 'kes')->whereBetween('tanggal_transaksi', [$pemasukanMulai, $pemasukanSelesai]);
                })->orWhere(function($q) use ($pengeluaranMulai, $pengeluaranSelesai) {
                    $q->where('type', 'transfer')->whereBetween('tanggal_transaksi', [$pengeluaranMulai, $pengeluaranSelesai]);
                });
            })
            ->orderBy('tanggal_transaksi', 'asc')
            ->get();

        // Kelompokkan harian
        $harianGrup = $transaksiMingguIni->groupBy(function ($item) {
            return \Carbon\Carbon::parse($item->tanggal_transaksi)->format('Y-m-d');
        });

        $runningBalances = $saldoAwalPerKategori;
        $weeklyReport = []; 

        foreach ($harianGrup as $tanggal => $items) {
            $tanggalFormat = \Carbon\Carbon::parse($tanggal)->locale('id')->translatedFormat('d M Y');

            $kategoriData = [];
            foreach ($kategori as $cat) {
                $catItems = $items->where('kategori_id', $cat->id);
                
                $kes = $catItems->where('type', 'kes')->sum('amount');
                $transfer = $catItems->where('type', 'transfer')->sum('amount');
                
                $listMasuk = $catItems->where('type', 'kes')->map(function($trans) {
                    return ['id' => $trans->id, 'keterangan' => $trans->keterangan, 'amount' => $trans->amount];
                })->values()->toArray();

                $listKeluar = $catItems->where('type', 'transfer')->map(function($trans) {
                    return ['id' => $trans->id, 'keterangan' => $trans->keterangan, 'amount' => $trans->amount];
                })->values()->toArray();

                $runningBalances[$cat->id] += ($kes - $transfer);

                $kategoriData[$cat->id] = [
                    'list_masuk'  => $listMasuk,
                    'list_keluar' => $listKeluar,
                    'saldo'       => $runningBalances[$cat->id]
                ];
            }

            $weeklyReport[] = [
                'period' => $tanggalFormat,
                'data_per_kategori' => $kategoriData
            ];
        }

        $jumatLalu = $pemasukanMulai; 
        $jumatMendatang = $pengeluaranSelesai;

        return view('keuangan.kas_irma', compact(
            'weeklyReport', 'kategori', 'prevWeekUrl', 'nextWeekUrl', 
            'currentWeekUrl', 'jumatLalu', 'jumatMendatang', 'saldoAwalPerKategori'
        ));
    }

}
