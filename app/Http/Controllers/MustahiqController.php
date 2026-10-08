<?php

namespace App\Http\Controllers;

use App\Models\Bagian;
use App\Models\Kategori;
use App\Models\Ktrmustahiq;
use App\Models\Mustahiq;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use RealRashid\SweetAlert\Facades\Alert;

class MustahiqController extends Controller
{
    public function index(Request $request)
    {
        $query = Mustahiq::query();

        // Cek jika user sedang memilih filter RT tertentu
        if ($request->has('rt_id') && $request->rt_id != '') {
            if ($request->rt_id === 'lainnya') {
                $query->whereNull('bagian_id'); // Memfilter data alamat manual (bagian_id kosong)
            } else {
                $query->where('bagian_id', $request->rt_id); // Memfilter berdasarkan ID RT
            }
        }

        $mustahiqs = $query->with(['bagian', 'ktrmustahiqs'])->get();
        
        return view('mustahiq.index', compact('mustahiqs'));
    }

    public function create()
    {
        $bagians = Bagian::all();
        $ktrmustahiqs = Ktrmustahiq::all();
        return view('mustahiq.create', compact('bagians', 'ktrmustahiqs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_mustahiq'  => 'required|string|max:255',
            'umur'           => 'required|numeric',
            'jenis_kelamin'  => 'required|in:laki-laki,perempuan',
            'bagian_id'      => 'required',
            'alamat_sekarang'=> 'required|string', 
            'alamat_lainnya' => 'required_if:bagian_id,lainnya|nullable|string', 
            'ktrmustahiq_id' => 'required|exists:ktrmustahiqs,id',
        ], [
            'nama_mustahiq.required'  => 'Nama Mustahiq harus diisi.',
            'umur.required'           => 'Umur harus diisi.',
            'umur.numeric'            => 'Umur harus berupa angka.',
            'jenis_kelamin.required'  => 'Jenis kelamin harus diisi.',
            'bagian_id.required'      => 'Pilih RT atau Alamat Lainnya wajib ditentukan.',
            'alamat_sekarang.required'=> 'Alamat Sekarang harus diisi.', 
            'alamat_lainnya.required_if' => 'Alamat manual wajib ditulis jika Anda memilih Alamat Lainnya.',
            'ktrmustahiq_id.required' => 'Kriteria Mustahiq wajib dipilih.',
        ]);

        // 2. Ambil semua data inputan
        $data = $request->all();

        // 3. Logika pemisahan RT dan Alamat Lainnya (Mengatasi Error SQLState 23000)
        if ($request->bagian_id === 'lainnya') {
            $data['bagian_id'] = null; 
        } else {
            $data['bagian_id'] = $request->bagian_id;
            $data['alamat_lainnya'] = ''; 
        }

        // 4. Simpan ke database
        Mustahiq::create($data);

        // PERBAIKAN: Menggunakan Alert::success yang benar agar centang hijau muncul
        Alert::success('Berhasil', 'Data berhasil di Tambahkan');

        // Kembalikan ke halaman utama
        return redirect()->route('mustahiq.index');
    }

    // 1. TUGAS EDIT: Hanya memunculkan halaman form dan melempar data lama
    public function edit(String $id)
    {
        // Ambil data mustahiq berdasarkan ID yang diklik
        $mustahiq = Mustahiq::findOrFail($id);
        
        // Ambil data RT dan Kriteria untuk pilihan dropdown di form edit
        $bagians = Bagian::all();
        $ktrmustahiqs = Ktrmustahiq::all();

        // Oper semua variabel ke file view mustahiq/edit.blade.php
        return view('mustahiq.edit', compact('mustahiq', 'bagians', 'ktrmustahiqs'));
    }

    // 2. TUGAS UPDATE: Menerima hasil ketikan baru dari form edit lalu menyimpannya
    public function update(Request $request, String $id)
    {
        // Cari data lama di database
        $mustahiq = Mustahiq::findOrFail($id);

        // Jalankan validasi data
        $request->validate([
            'nama_mustahiq'  => 'required|string|max:255',
            'umur'           => 'required|numeric',
            'jenis_kelamin'  => 'required|in:laki-laki,perempuan',
            'bagian_id'      => 'required',
            'alamat_sekarang'=> 'required|string', 
            'alamat_lainnya' => 'required_if:bagian_id,lainnya|nullable|string', 
            'ktrmustahiq_id' => 'required|exists:ktrmustahiqs,id',
        ], [
            'nama_mustahiq.required'  => 'Nama Mustahiq harus diisi.',
            'umur.required'           => 'Umur harus diisi.',
            'umur.numeric'            => 'Umur harus berupa angka.',
            'jenis_kelamin.required'  => 'Jenis kelamin harus diisi.',
            'bagian_id.required'      => 'Pilih RT atau Alamat Lainnya wajib ditentukan.',
            'alamat_sekarang.required'=> 'Alamat Sekarang harus diisi.', 
            'alamat_lainnya.required_if' => 'Alamat manual wajib ditulis jika Anda memilih Alamat Lainnya.',
            'ktrmustahiq_id.required' => 'Kriteria Mustahiq wajib dipilih.',
        ]);

        $data = $request->all();

        // Logika pemisahan wilayah RT dan Alamat Lainnya
        if ($request->bagian_id === 'lainnya') {
            $data['bagian_id'] = null; 
        } else {
            $data['bagian_id'] = $request->bagian_id;
            $data['alamat_lainnya'] = ''; 
        }

        // Perbarui data lama dengan data yang baru diinput
        $mustahiq->update($data);

        // PERBAIKAN: Menggunakan Alert::success yang benar agar centang hijau muncul
        Alert::success('Berhasil', 'Data berhasil di update');

        // Kembalikan ke halaman utama
        return redirect()->route('mustahiq.index');
    }

    public function destroy(String $id)
    {
        // 1. Cari data mustahiq berdasarkan ID
        $mustahiq = Mustahiq::find($id);

        // 2. Lakukan pengecekan apakah data ditemukan
        if ($mustahiq) {
            // 3. Eksekusi penghapusan data dari database
            $mustahiq->delete();

            // 4. Tampilkan SweetAlert sukses
            Alert::success('Berhasil', 'Data berhasil dihapus');
        } else {
            // 5. Tampilkan SweetAlert gagal jika ID tidak ada
            Alert::error('Gagal', 'Data tidak ditemukan');
        }

        // 6. Alihkan halaman kembali ke index mustahiq
        return redirect()->route('mustahiq.index');
    }

    // 1. Fungsi Mengunduh File Excel Mustahiq (Format CSV Semikolon sesuai style Anda)
    public function exportExcel(Request $request)
    {
        $headers = [
            "Content-type"        => "text/csv; charset=UTF-8",
            "Content-Disposition" => "attachment; filename=data_mustahiq_rt_" . ($request->rt_id ?? 'semua') . "_" . date('Y-m-d') . ".csv",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $query = Mustahiq::query();

        // Eksekusi filter saat download Excel
        if ($request->has('rt_id') && $request->rt_id != '') {
            if ($request->rt_id === 'lainnya') {
                $query->whereNull('bagian_id');
            } else {
                $query->where('bagian_id', $request->rt_id);
            }
        }

        $mustahiqs = $query->with(['bagian', 'ktrmustahiqs'])->get();

        $callback = function() use($mustahiqs) {
            $file = fopen('php://output', 'w');
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));

            fputcsv($file, ['No', 'Nama Mustahiq', 'Umur', 'Jenis Kelamin', 'Bagian RT', 'Alamat Lainnya', 'Alamat Sekarang', 'Kriteria'], ";"); 

            $no = 1;
            foreach ($mustahiqs as $item) {
                fputcsv($file, [
                    $no++,
                    $item->nama_mustahiq,
                    $item->umur,
                    $item->jenis_kelamin,
                    $item->bagian?->nama_bagian ?? '-',
                    $item->alamat_lainnya ?? '-',
                    $item->alamat_sekarang,
                    $item->ktrmustahiqs?->nama_ktrmustahik ?? '-',
                ], ";"); 
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }


    // 2. Fungsi Mengunduh File PDF Mustahiq
    public function exportPdf(Request $request)
    {
        $query = Mustahiq::query();

        // Eksekusi filter saat download PDF
        if ($request->has('rt_id') && $request->rt_id != '') {
            if ($request->rt_id === 'lainnya') {
                $query->whereNull('bagian_id');
            } else {
                $query->where('bagian_id', $request->rt_id);
            }
        }

        $mustahiqs = $query->with(['bagian', 'ktrmustahiqs'])->get();
        
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('mustahiq.pdf', compact('mustahiqs'))->setPaper('a4', 'landscape');
        
        return $pdf->download('data_mustahiq_rt_' . ($request->rt_id ?? 'semua') . '_' . date('Y-m-d') . '.pdf');
    }




}
