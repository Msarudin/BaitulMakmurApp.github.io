<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KeuanganYayasan; // Memanggil Model KeuanganYayasan
use RealRashid\SweetAlert\Facades\Alert; // Memanggil library SweetAlert
use Carbon\Carbon;
use App\Models\Keuangan; // Sesuaikan nama model kas masjid Anda

class KeuanganYayasanController extends Controller
{
   
    public function index(Request $request)
    {
        // 1. Tangkap status periode dari URL (default: minggu_ini)
        $periode = $request->get('periode', 'minggu_ini');
        $hariIni = Carbon::now();

        // 2. Tentukan rentang tanggal filter berdasarkan tombol klik
        if ($periode === 'minggu_lalu') {
            $start = $hariIni->copy()->subWeek()->startOfWeek(Carbon::MONDAY);
            $end = $hariIni->copy()->subWeek()->endOfWeek(Carbon::SUNDAY);
        } elseif ($periode === 'minggu_depan') {
            $start = $hariIni->copy()->addWeek()->startOfWeek(Carbon::MONDAY);
            $end = $hariIni->copy()->addWeek()->endOfWeek(Carbon::SUNDAY);
        } else {
            $start = $hariIni->copy()->startOfWeek(Carbon::MONDAY);
            $end = $hariIni->copy()->endOfWeek(Carbon::SUNDAY);
        }

        // 3. Ambil data transaksi yang HANYA ada di rentang tanggal tersebut dari tabel keuangan_yayasans
        $keuanganYayasan = KeuanganYayasan::whereBetween('tanggal', [$start->format('Y-m-d'), $end->format('Y-m-d')])
                                         ->orderBy('tanggal', 'asc')
                                         ->get();

        // 4. Kirim variabel tanggal dan periode ke view Keuangan_yayasan
        return view('Keuangan_yayasan.index', compact('keuanganYayasan', 'start', 'end', 'periode'));
    }


    /**
     * Memproses penyimpanan transaksi kas baru dari formulir ke database
     */
    public function store(Request $request)
    {
        // 1. Validasi Data Inputan
        $request->validate([
            'tanggal'    => 'required|date',
            'jenis'      => 'required|in:masuk,keluar',
            'nominal'    => 'required|numeric|min:1',
            'keterangan' => 'required|string|max:255',
        ], [
            'tanggal.required'    => 'Tanggal transaksi wajib diisi.',
            'jenis.required'      => 'Jenis transaksi harus dipilih.',
            'nominal.required'    => 'Nominal uang wajib diisi.',
            'nominal.numeric'     => 'Nominal harus berupa angka bersih tanpa titik saat diproses.',
            'keterangan.required' => 'Keterangan transaksi wajib diisi.',
        ]);

        // 2. Simpan data transaksi baru ke database
        KeuanganYayasan::create([
            'tanggal'    => $request->tanggal,
            'jenis'      => $request->jenis,
            'nominal'    => $request->nominal, 
            'keterangan' => $request->keterangan,
        ]);

        // 3. Tampilkan Notifikasi Sukses SweetAlert
        Alert::success('Berhasil', 'Transaksi kas yayasan berhasil disimpan');

        // PERBAIKAN: Mengubah tanda strip (-) menjadi underscore (_) 👇
        return redirect()->route('keuangan-yayasan.index');
    }

    /**
     * Menampilkan halaman Form Edit Transaksi Kas
     */
    public function edit($id)
    {
        $transaksi = KeuanganYayasan::findOrFail($id);
        // SINKRONISASI: Sesuaikan nama foldernya 👇
        return view('Keuangan_yayasan.edit', compact('transaksi'));
    }

    /**
     * Memproses pembaruan data transaksi yang diedit
     */
    public function update(Request $request, $id)
    {
        $transaksi = KeuanganYayasan::findOrFail($id);

        // 1. Validasi Data Update
        $request->validate([
            'tanggal'    => 'required|date',
            'jenis'      => 'required|in:masuk,keluar',
            'nominal'    => 'required|numeric|min:1',
            'keterangan' => 'required|string|max:255',
        ], [
            'tanggal.required'    => 'Tanggal transaksi wajib diisi.',
            'jenis.required'      => 'Jenis transaksi harus dipilih.',
            'nominal.required'    => 'Nominal uang wajib diisi.',
            'keterangan.required' => 'Keterangan transaksi wajib diisi.',
        ]);

        // 2. Eksekusi pembaruan data ke database
        $transaksi->update([
            'tanggal'    => $request->tanggal,
            'jenis'      => $request->jenis,
            'nominal'    => $request->nominal,
            'keterangan' => $request->keterangan,
        ]);

        Alert::success('Berhasil', 'Data transaksi kas berhasil diperbarui');

        // PERBAIKAN: Mengubah tanda strip (-) menjadi underscore (_) 👇
        return redirect()->route('keuangan-yayasan.index');
    }

    /**
     * Menghapus data transaksi kas dari database
     */
    public function destroy($id)
    {
        $transaksi = KeuanganYayasan::findOrFail($id);
        $transaksi->delete();

        Alert::success('Berhasil', 'Transaksi kas berhasil dihapus');

        // PERBAIKAN: Mengubah tanda strip (-) menjadi underscore (_) 👇
        return redirect()->route('keuangan-yayasan.index');
    }

    // Tambahkan fungsi ini ke dalam Controller Anda
    public function printLaporan(Request $request)
    {
        // Ambil SEMUA data transaksi dari awal sampai akhir tanpa filter whereBetween
        $keuanganYayasan = \App\Models\KeuanganYayasan::orderBy('tanggal', 'asc')->get();

        // Kirimkan data ke halaman blade cetak
        return view('Keuangan_yayasan.print', compact('keuanganYayasan'));
    }


}
