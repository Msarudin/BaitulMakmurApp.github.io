<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Muzaki;      // Memanggil Model Muzaki
use App\Models\Bagian;      // Memanggil Model Bagian (Data RT)
use App\Models\Jenis_amal;  // Memanggil Model Jenis_amal (Kriteria Amal)
use RealRashid\SweetAlert\Facades\Alert; // Memanggil library SweetAlert

class MuzakiController extends Controller
{
    /**
     * Menampilkan halaman utama (Tabel Daftar Muzaki)
     */
    public function index(Request $request)
    {
        // 1. Inisialisasi query dari model Muzaki
        $query = Muzaki::query();

        // 2. Logika Filter RT (Disamakan dengan milik mustahiq)
        if ($request->has('rt_id') && $request->rt_id != '') {
            if ($request->rt_id === 'lainnya') {
                $query->whereNull('bagian_id'); // Memfilter data alamat manual (bagian_id kosong)
            } else {
                $query->where('bagian_id', $request->rt_id); // Memfilter berdasarkan ID RT
            }
        }

        // 3. Ambil data muzaki beserta relasinya, dan ambil data RT untuk isi dropdown select box
        $muzakis = $query->with(['bagian', 'jenis_amal'])->get();
        $bagians = Bagian::all(); // Wajib ditarik agar dropdown RT di Blade tidak kosong/error

        // 4. Kirim semua variabel ke view muzaki.index
        return view('muzaki.index', compact('muzakis', 'bagians'));
    }

    /**
     * Menampilkan halaman Formulir Tambah Data Muzaki
     */
    public function create()
    {
        // Mengambil semua data RT untuk isi pilihan select option
        $bagians = Bagian::all();
        
        // Mengambil semua data kriteria amal dari tabel jenis_amals
        $jenis_amals = Jenis_amal::all(); 

        // Mengirimkan kedua variabel ke file views/muzaki/create.blade.php
        return view('muzaki.create', compact('bagians', 'jenis_amals'));
    }

    /**
     * Memproses penyimpanan data baru dari Formulir ke Database
     */
    public function store(Request $request)
    {
        // 1. Validasi Data 
        $request->validate([
            'nama_muzaki'    => 'required|string|max:255',
            'umur'           => 'required|numeric',
            'jenis_kelamin'  => 'required|in:laki-laki,perempuan',
            'bagian_id'      => 'required',
            'alamat'         => 'required_unless:bagian_id,lainnya|nullable|string', 
            'alamat_lainnya' => 'required_if:bagian_id,lainnya|nullable|string', 
            'amal_id'        => 'required|exists:jenis_amals,id',
            'nominal'        => 'required|numeric|min:0',   
        ], [
            'nama_muzaki.required'       => 'Nama muzaki wajib diisi.',
            'umur.required'              => 'Umur wajib diisi.',
            'jenis_kelamin.required'     => 'Jenis kelamin wajib dipilih.',
            'bagian_id.required'         => 'Wilayah RT wajib dipilih.',
            'alamat.required_unless'     => 'Alamat sekarang wajib diisi.',
            'alamat_lainnya.required_if' => 'Alamat manual wajib diisi jika memilih opsi Alamat Lainnya.',
            'amal_id.required'           => 'Kriteria amal wajib dipilih.',
            'nominal.required'           => 'Nominal amal wajib diisi.',
        ]);

        // 2. Ambil semua data inputan dari Form
        $data = $request->all();

        // 3. Logika Pemisahan RT dan Alamat Lainnya (Sudah diperbaiki)
        if ($request->bagian_id === 'lainnya') {
            $data['bagian_id'] = null; 
            $data['alamat_lainnya'] = $request->alamat_lainnya; 
            $data['alamat'] = $request->alamat_lainnya; // Mengisi kolom alamat dengan alamat manual
        } else {
            $data['bagian_id'] = $request->bagian_id;
            $data['alamat_lainnya'] = ''; 
            $data['alamat'] = $request->alamat; // 🟢 PERBAIKAN: Menggunakan $request->alamat (sesuai Blade)
        }

        // 4. Simpan ke database menggunakan Model Muzaki
        Muzaki::create($data);

        // 5. Memunculkan Pop-up Centang Hijau SweetAlert
        Alert::success('Berhasil', 'Data berhasil ditambahkan');

        // 6. Alihkan Kembali ke Halaman Utama Daftar Muzaki
        return redirect()->route('muzaki.index');
    }

    /**
     * Menampilkan halaman Formulir Edit Data Muzaki
     */
    public function edit(string $id)
    {
        // 1. Ambil data muzaki berdasarkan ID yang diklik
        $muzaki = Muzaki::findOrFail($id);
        
        // 2. Ambil data RT dan Kriteria Amal untuk pilihan dropdown di form edit
        $bagians = Bagian::all();
        $jenis_amals = Jenis_amal::all();

        // 3. Oper semua variabel ke file view muzaki/edit.blade.php
        return view('muzaki.edit', compact('muzaki', 'bagians', 'jenis_amals'));
    }

    /**
     * Memproses pembaruan data Muzaki yang diedit ke Database
     */
    public function update(Request $request, $id)
    {
        // 1. Cari data muzaki yang mau di-edit
        $muzaki = Muzaki::findOrFail($id);

        // 2. Jalankan Validasi Bersih (Disamakan dengan fungsi store agar konsisten)
        $request->validate([
            'nama_muzaki'    => 'required|string|max:255',
            'umur'           => 'required|numeric',
            'jenis_kelamin'  => 'required|in:laki-laki,perempuan',
            'bagian_id'      => 'required',
            'alamat'         => 'required_unless:bagian_id,lainnya|nullable|string', 
            'alamat_lainnya' => 'required_if:bagian_id,lainnya|nullable|string', 
            'amal_id'        => 'required|exists:jenis_amals,id',
            'nominal'        => 'required|numeric|min:0',
        ], [
            'nama_muzaki.required'       => 'Nama Muzaki harus diisi.',
            'umur.required'              => 'Umur wajib diisi.',
            'jenis_kelamin.required'     => 'Jenis kelamin wajib dipilih.',
            'bagian_id.required'         => 'Wilayah RT wajib dipilih.',
            'alamat.required_unless'     => 'Alamat Sekarang harus diisi.',
            'alamat_lainnya.required_if' => 'Alamat manual wajib diisi jika memilih opsi Alamat Lainnya.',
            'amal_id.required'           => 'Kriteria amal wajib dipilih.',
            'nominal.required'           => 'Nominal amal wajib diisi.',
        ]);

        // 3. Logika Penyelarasan Alamat (Sama dengan logika store)
        if ($request->bagian_id === 'lainnya') {
            $bagianId = null;
            $alamatLainnya = $request->alamat_lainnya;
            $alamatBeres = $request->alamat_lainnya; // Pindahkan isi alamat manual ke kolom alamat utama
        } else {
            $bagianId = $request->bagian_id;
            $alamatLainnya = ''; // Set string kosong atau '-' sesuai keinginan Anda
            $alamatBeres = $request->alamat; // Gunakan alamat sekarang dari textarea
        }

        // 4. Proses Update ke Database
        $muzaki->update([
            'nama_muzaki'    => $request->nama_muzaki,
            'umur'           => $request->umur,
            'jenis_kelamin'  => $request->jenis_kelamin,
            'bagian_id'      => $bagianId,
            'alamat'         => $alamatBeres,
            'alamat_lainnya' => $alamatLainnya,
            'amal_id'        => $request->amal_id,
            'nominal'        => $request->nominal,
        ]);

        // 5. Memunculkan Pop-up Centang Hijau SweetAlert
        Alert::success('Berhasil', 'Data berhasil diupdate');

        // 6. Kembali ke halaman utama dengan notifikasi sukses
        return redirect()->route('muzaki.index');
    }

    /**
     * Menghapus data Muzaki dari database
     */
    public function destroy(string $id)
    {
        // 1. Cari data muzaki berdasarkan ID
        $muzaki = Muzaki::find($id);

        if ($muzaki) {
            // 2. Eksekusi penghapusan data dari database
            $muzaki->delete();

            // 3. Tampilkan SweetAlert sukses
            Alert::success('Berhasil', 'Data berhasil dihapus');
        } else {
            // 4. Tampilkan SweetAlert gagal jika ID tidak ada
            Alert::error('Gagal', 'Data tidak ditemukan');
        }

        // 5. Alihkan halaman kembali ke index muzaki 👇
        return redirect()->route('muzaki.index');
    }

    /**
     * Fungsi Mengunduh File Excel/CSV Muzaki
     */
    public function exportExcel(Request $request)
    {
        $headers = [
            "Content-type"        => "text/csv; charset=UTF-8",
            "Content-Disposition" => "attachment; filename=data_muzaki_rt_" . ($request->rt_id ?? 'semua') . "_" . date('Y-m-d') . ".csv",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $query = Muzaki::query();

        // Eksekusi filter RT saat download Excel
        if ($request->has('rt_id') && $request->rt_id != '') {
            if ($request->rt_id === 'lainnya') {
                $query->whereNull('bagian_id');
            } else {
                $query->where('bagian_id', $request->rt_id);
            }
        }

        $muzakis = $query->with(['bagian', 'jenis_amal'])->get();

        $callback = function() use($muzakis) {
            $file = fopen('php://output', 'w');
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));

            // Judul kolom disesuaikan dengan entitas Muzaki 💡
            fputcsv($file, ['No', 'Nama Muzaki', 'Umur', 'Jenis Kelamin', 'Bagian RT', 'Alamat Lengkap', 'Jenis Amal', 'Nominal'], ";"); 

            $no = 1;
            foreach ($muzakis as $item) {
                fputcsv($file, [
                    $no++,
                    $item->nama_muzaki,
                    $item->umur,
                    $item->jenis_kelamin,
                    $item->bagian?->nama_bagian ?? '-',
                    $item->alamat,
                    $item->jenis_amal?->nama_amal ?? '-',
                    $item->nominal,
                ], ";"); 
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Fungsi Mengunduh File PDF Muzaki
     */
    public function exportPdf(Request $request)
    {
        $query = Muzaki::query();

        // Eksekusi filter RT saat download PDF
        if ($request->has('rt_id') && $request->rt_id != '') {
            if ($request->rt_id === 'lainnya') {
                $query->whereNull('bagian_id');
            } else {
                $query->where('bagian_id', $request->rt_id);
            }
        }

        // 1. Mengambil data dari database (Cukup ditulis SATU kali saja)
        $muzakis = $query->with(['bagian', 'jenis_amal'])->get();
        
        // 2. Memanggil file view cetak khusus muzaki (PERBAIKAN: Mengganti kurung siku ] menjadi kurung biasa ) 👇
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('muzaki.pdf', compact('muzakis'))->setPaper('a4', 'landscape');
        
        // 3. Mengunduh hasil laporan PDF
        return $pdf->download('data_muzaki_rt_' . ($request->rt_id ?? 'semua') . '_' . date('Y-m-d') . '.pdf');
    }

}

        
