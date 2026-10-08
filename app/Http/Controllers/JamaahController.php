<?php

namespace App\Http\Controllers;

use App\Exports\JamaahExport;
use App\Models\Bagian;
use App\Models\Jamaah;
use App\Models\Kategori;
use App\Models\Transaksi;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class JamaahController extends Controller
{
        // 1. Fungsi Utama: Untuk melihat SEMUA data jamaah (URL: /jamaah)
    public function index(Request $request)
    {
        $query = Jamaah::query();

        // Dioptimalkan agar pencarian halaman index utama mendukung nama_bagian maupun ID
        if ($request->has('rt') && $request->rt != '') {
            $query->whereHas('bagian', function ($q) use ($request) {
                $q->where('nama_bagian', $request->rt)->orWhere('id', $request->rt);
            });
        }

        $jamaah = $query->with(['bagian'])->get();
        return view('jamaah.index', compact('jamaah'));
    }

    // 2. Fungsi Baru: Untuk memfilter jamaah berdasarkan ID RT dari menu sidebar (URL: /jamaah/rt/{rt})
    public function indexByRt($rt)
    {
        $query = Jamaah::query();
        
        // Mendukung filter berdasarkan ID angka maupun nama teks (misal: 'RT_02' atau ID '2')
        $query->whereHas('bagian', function ($q) use ($rt) {
            $q->where('id', $rt)->orWhere('nama_bagian', $rt);
        });

        $jamaah = $query->with(['bagian'])->get();

        // Mengambil detail data bagian untuk judul halaman dinamis
        $detailRt = \Illuminate\Support\Facades\DB::table('bagians')
            ->where('id', $rt)
            ->orWhere('nama_bagian', $rt)
            ->first();

        return view('jamaah.index', compact('jamaah', 'detailRt'));
    }

    // Fungsi Mengunduh File Excel (Menggunakan Titik Koma sebagai Pemisah Kolom)
    public function exportExcel(Request $request)
    {
        $query = Jamaah::query();

        // 💡 MENANGKAP VARIABEL SECARA FLEKSIBEL DARI SIDEBAR ATAU DROPDOWN
        $filterRt = $request->rt ?? $request->rt_id ?? $request->segment(3);

        if (!empty($filterRt)) {
            $query->whereHas('bagian', function ($q) use ($filterRt) {
                // Mencari kecocokan berdasarkan ID angka ataupun string nama bagian database
                $q->where('id', $filterRt)->orWhere('nama_bagian', $filterRt);
            });
        }

        $jamaah = $query->with(['bagian'])->get();

        // Membuat nama file menjadi dinamis berdasarkan wilayah yang di-download
        $namaFile = 'data_jamaah_rt_' . ($filterRt ?? 'semua') . '_' . date('Y-m-d') . '.csv';

        $headers = [
            "Content-type"        => "text/csv; charset=UTF-8",
            "Content-Disposition" => "attachment; filename=" . $namaFile,
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $callback = function() use($jamaah) {
            $file = fopen('php://output', 'w');
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF)); // UTF-8 BOM agar rapi di Microsoft Excel

            // Judul Kolom (Menggunakan titik koma sebagai pemisah/delimiter)
            fputcsv($file, [
                'Nama Jamaah', 'Email', 'NIK', 'No Kartu Keluarga', 
                'No Tlp', 'Umur', 'Tempat Lahir', 'Tanggal Lahir', 
                'Jenis Kelamin', 'Alamat Sekarang', 'Alamat Asal', 'Bagian RT'
            ], ";"); 

            // Isi baris data satu per satu
            foreach ($jamaah as $item) {
                fputcsv($file, [
                    $item->nama_jamaah,
                    $item->email,
                    $item->nik . "\t",  // Ditambah tab agar angka NIK panjang tidak rusak/berubah format
                    $item->no_kk . "\t", // Ditambah tab agar nomor KK panjang tidak rusak/berubah format
                    $item->no_tlp . "\t",
                    $item->umur . " Tahun",
                    $item->tempat_lahir,
                    $item->tanggal_lahir,
                    ucfirst($item->jenis_kelamin),
                    $item->alamat_sekarang,
                    $item->alamat_asal,
                    $item->bagian->nama_bagian ?? '-',
                ], ";"); 
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    // Fungsi Mengunduh File PDF
    public function exportPdf(Request $request)
    {
        $query = Jamaah::query();

        // 💡 MENANGKAP VARIABEL SECARA FLEKSIBEL DARI SIDEBAR ATAU DROPDOWN
        $filterRt = $request->rt ?? $request->rt_id ?? $request->segment(3);

        if (!empty($filterRt)) {
            $query->whereHas('bagian', function ($q) use ($filterRt) {
                $q->where('id', $filterRt)->orWhere('nama_bagian', $filterRt);
            });
        }

        $jamaah = $query->with(['bagian'])->get();
        
        // Memuat view cetak dan mengatur ukuran kertas ke Landscape A4 agar muat banyak kolom
        $pdf = Pdf::loadView('jamaah.pdf', compact('jamaah'))->setPaper('a4', 'landscape');
        
        $namaFilePdf = 'data_jamaah_rt_' . ($filterRt ?? 'semua') . '_' . date('Y-m-d') . '.pdf';
        return $pdf->download($namaFilePdf);
    }

    public function create()
    {
        $bagians = Bagian::all();
        return view('jamaah.create', compact('bagians'));
    }

    public function store(Request $request)
    {
        //dd($request->all());
        $fotoRules = session()->has('temp_foto') ? 'nullable' : 'required';
        $request->validate([
            'nama_jamaah' => 'required',
            'bagian_id'     => 'required|exists:bagians,id',
            'email'       => 'required|email|unique:jamaahs,email',
            'nik'         => 'required|numeric|digits:16|unique:jamaahs,nik',
            'no_kk'       => 'required|numeric|digits:16',
            'no_tlp'      => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:9|max:14',
            'umur'        => 'required|numeric',
            'alamat_sekarang'      => 'required',
            'alamat_asal'      => 'required',
            'tanggal_lahir' => 'required|date|date_format:Y-m-d|before:today',
            'tempat_lahir'  => 'required',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'foto'        => $fotoRules . '|required|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'nama_jamaah.required' => 'Nama Jamaah Harus Di Isi.',
            'email.required' => 'Email Harus Di Isi.',
            'email.email' => 'Format Email Tidak Valid.',
            'email.unique' => 'Email Sudah Terdaftar.',
            'nik.required' => 'Nik Harus Di Isi.',
            'nik.numeric' => 'Nik Harus Berupa Angka.',
            'nik.unique' => 'Nik Sudah Terdaftar.',
            'no_kk.required' => 'Nomor Kartu Keluarga harus berupa angka.',
            'no_kk.numeric' => 'Nomor Kartu Keluarga harus berjumlah 16 digit.',
            'no_tlp.required' => 'Nomor telepon wajib diisi.',
            'no_tlp.regex'    => 'Format nomor telepon tidak valid.',
            'no_tlp.min'      => 'Nomor telepon minimal 9 digit.',
            'no_tlp.max'      => 'Nomor telepon maksimal 14 digit.',
            'umur.required' => 'Umur Harus di Isi.',
            'umur.numeric' => 'Umur Harus Berupa Angka.',
            'alamat_sekarang.required' => 'Alamat Sekarang Harus Di Isi.',
            'alamat_asal.required' => 'Alamamt Asal Harus Di Isi.',
            'tanggal_lahir.required' => 'Tanggal Lahir Harus Di Isi.',
            'tanggal_lahir.date' => 'Tanggal Lahir Harus Berupa Tanggal.',
            'tempat_lahir.required' => 'Tempat Lahir Harus Di Isi.',
            'jenis_kelamin.required' => 'Jenis Kelamin Harus Di Isi.',
            'jenis_kelamin.in' => 'Jenis Kelamin Harus Laki-Laki Atau Perempuan.',
            'foto.required' => 'Foto jamaah wajib diunggah.',
            'foto.image'    => 'Berkas yang diunggah harus berupa gambar (foto).',
            'foto.mimes'    => 'Format foto harus berupa jpeg, png, jpg, atau webp.',
        ]);

        // Jamaah::create([
        //     'nama_jamaah' => $request->nama_jamaah,
        //     'nik'         => $request->nik,
        //     'alamat'      => $request->alamat,
        //     'umur'        => $request->umur,
        //     'tanggal_lahir' => $request->tanggal_lahir,
        //     'tempat_lahir'  => $request->tempat_lahir,
        //     'jenis_kelamin' => $request->jenis_kelamin,
        // ]);

        $foto = $request->file('foto');
        $fileName = Str::uuid() . '.' . $foto->getClientOriginalExtension();
        //dd($fileName);
        Storage::disk('public')->putFileAs('foto_pegawai', $foto, $fileName);
        //dd("sukses");

        $newRequest = $request->all();
        $newRequest['foto'] = $fileName;
        //Jamaah::create($newRequest); sebelum di tambah email
        $newData = Jamaah::create($newRequest);
        //Jamaah::create($request->all()); sebelum di tambah foto
        // $user = User::create([
        //     'name' => $newData->nama_jamaah,
        //     'email' => $request->email,
        //     'password' => Hash::make('passowrd'),
        //     'jamaah_id' => $newData->id,
        // ]);
        // $newData->user_id = $user->id;
        $newData->save();

        Alert::success('Berhasil', 'Data berhasil ditambahkan');
        if (is_null(Auth::user()->role_id)) {
            return redirect()->route('home');
        }
        return redirect()->route('jamaah.index');
    }

    public function edit(String $id) 
    {
        $jamaah = Jamaah::find($id);
        $bagians = Bagian::all();
        //dd($jamaah); 
        return view('jamaah.edit', compact('jamaah', 'bagians'));      
        //return view('jamaah.edit', compact('jamaah', 'bagians'));
    }

    public function update(Request $request, Jamaah $jamaah)
    {
        //dd($jamaah->toArray());
        $request->validate([
            'nama_jamaah' => 'required',
            'email'       => 'required|email|unique:users,email',
            'nik'         => 'required|numeric|digits:16|unique:jamaahs,nik,' . $jamaah->id,
            'no_kk'       => 'required|numeric|digits:16',
            'no_tlp'      => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:9|max:14',
            'umur'        => 'required|numeric',
            'alamat_sekarang'      => 'required',
            'alamat_asal'      => 'required',
            'tanggal_lahir' => 'required|date',
            'tempat_lahir'  => 'required',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'foto'        => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            //'bagian_id'   => 'required|exists:bagians,id',
        ], [
            'nama_jamaah.required' => 'Nama Jamaah Harus Di Isi.',
            'email.required' => 'Email Harus Di Isi.',
            'email.email' => 'Format Email Tidak Valid.',
            'email.unique' => 'Email Sudah Terdaftar.',
            'nik.required' => 'Nik Harus Di Isi.',
            'nik.numeric' => 'Nik Harus Berupa Angka.',
            'nik.unique' => 'Nik Sudah Terdaftar.',
            'no_kk.required' => 'Nomor Kartu Keluarga harus berupa angka.',
            'no_kk.numeric' => 'Nomor Kartu Keluarga harus berjumlah 16 digit.',
            'no_tlp.required' => 'Nomor telepon wajib diisi.',
            'no_tlp.regex'    => 'Format nomor telepon tidak valid.',
            'no_tlp.min'      => 'Nomor telepon minimal 9 digit.',
            'no_tlp.max'      => 'Nomor telepon maksimal 14 digit.',
            'umur.required' => 'Umur Harus di Isi.',
            'umur.numeric' => 'Umur Harus Berupa Angka.',
            'alamat_sekarang.required' => 'Alamat Sekarang Harus Di Isi.',
            'alamat_asal.required' => 'Alamamt Asal Harus Di Isi.',
            'tanggal_lahir.required' => 'Tanggal Lahir Harus Di Isi.',
            'tanggal_lahir.date' => 'Tanggal Lahir Harus Berupa Tanggal.',
            'tempat_lahir.required' => 'Tempat Lahir Harus Di Isi.',
            'jenis_kelamin.required' => 'Jenis Kelamin Harus Di Isi.',
            'jenis_kelamin.in' => 'Jenis Kelamin Harus Laki-Laki Atau Perempuan.',
            'foto.required' => 'Foto jamaah wajib diunggah.',
            'foto.image'    => 'Berkas yang diunggah harus berupa gambar (foto).',
            'foto.mimes'    => 'Format foto harus berupa jpeg, png, jpg, atau webp.',            
        ]);

        // $jamaah->update([
        //     'nama_jamaah'  => $request->nama_jamaah,
        //     'alamat'        => $request->alamat,
        //     'umur'          => $request->umur,
        //     'tanggal_lahir' => $request->tanggal_lahir,
        //     'tempat_lahir'  => $request->tempat_lahir,
        //     'jenis_kelamin' => $request->jenis_kelamin,
        // ]);

        $fileName = $jamaah->foto;
        $foto = $request->file('foto');

        if($foto) {
            $fileName = Str::uuid() . '.' . $foto->getClientOriginalExtension();
            Storage::disk('public')->putFileAs('foto_pegawai', $foto, $fileName);
        } else {
            $fileName = $jamaah->foto;
        }

        $newRequest = $request->except('nik');
        $newRequest['foto'] = $fileName;

        $jamaah->update($newRequest);
        //Alert::success('Berhasil', 'Data berhasil diupdate');
        toast('Data berhasil di update', 'success');
        //$jamaah->update($request->except('nik')); sebelum tambah foto
        //return redirect()->route('jamaah.index')->with('success', 'Data pegawai berhasil diupdate.'); sebelum menggunakan sweetalert rasid ali
        return redirect()->route('jamaah.index');
    }

    public function destroy(String $id)
    {
        //Jamaah::destroy($id);
        // $jamaah = Jamaah::find($id);
        // if ($jamaah->foto != null) {
        //     Storage::disk('public')->delete('foto_pegawai/' . $jamaah->foto);
        // }
        // $jamaah->delete();
        // Alert::success('Berhasil', 'Data berhasil dihapus');
        // return redirect()->route('jamaah.index');

        $jamaah = Jamaah::find($id);

        if ($jamaah) {
            // Gabungkan langsung ke alamat folder fisik di folder public
            // basename() memastikan kita hanya mengambil nama filenya saja jika di DB terlanjur ada path-nya
            $namaFoto = basename($jamaah->foto);
            $pathFoto = public_path('storage/foto_pegawai/' . $namaFoto);

            // Cek secara fisik apakah filenya benar-benar ada di folder tersebut
            if ($jamaah->foto != null && file_exists($pathFoto)) {
                unlink($pathFoto); // Menghapus file secara paksa dari folder Windows/Server
            }

            $jamaah->delete();
            Alert::success('Berhasil', 'Data berhasil dihapus');
        } else {
            Alert::error('Gagal', 'Data tidak ditemukan');
        }

        return redirect()->route('jamaah.index');
    }

    public function cetakPDF(Request $request)
    {
        $kategori = Kategori::all();

        // 1. TENTUKAN HARI JUMAT CLOSING SEBAGAI PATOKAN UTAMA
        if ($request->has('start_date')) {
            $jumatClosing = Carbon::parse($request->input('start_date'))->endOfDay();
        } else {
            $hariIni = Carbon::now();
            if ($hariIni->dayOfWeek >= Carbon::FRIDAY) {
                $jumatClosing = $hariIni->copy()->next(Carbon::FRIDAY)->subWeek()->endOfDay();
            } else {
                $jumatClosing = $hariIni->copy()->previous(Carbon::FRIDAY)->endOfDay();
            }
        }

        // 2. KUNCI RENTANG TANGGAL
        $pemasukanMulai  = $jumatClosing->copy()->subWeek()->startOfDay();
        $pemasukanSelesai = $jumatClosing->copy()->subDay()->endOfDay();
        $pengeluaranMulai  = $jumatClosing->copy()->subWeek()->addDay()->startOfDay();
        $pengeluaranSelesai = $jumatClosing->copy();

        // ===================================================================
        // PERBAIKAN: MEMBUAT VARIABEL NAVIGASI YANG HILANG (Arahkan ke nama method Anda)
        // ===================================================================
        // PERBAIKAN: Pastikan nama variabelnya bersih tanpa angka 1 di belakang kata Url
        $prevWeekUrl = route('jamaah.cetakPDF', ['start_date' => $jumatClosing->copy()->subWeek()->format('Y-m-d')]);
        $nextWeekUrl = route('jamaah.cetakPDF', ['start_date' => $jumatClosing->copy()->addWeek()->format('Y-m-d')]); // <--- Ubah $nextWeekUrl1 menjadi $nextWeekUrl
        $currentWeekUrl = route('jamaah.cetakPDF');


        $transaksiMingguIni = Transaksi::with('kategori')
            ->where(function($query) use ($pemasukanMulai, $pemasukanSelesai) {
                $query->where('type', 'kes')->whereBetween('tanggal_transaksi', [$pemasukanMulai, $pemasukanSelesai]);
            })
            ->orWhere(function($query) use ($pengeluaranMulai, $pengeluaranSelesai) {
                $query->where('type', 'transfer')->whereBetween('tanggal_transaksi', [$pengeluaranMulai, $pengeluaranSelesai]);
            })
            ->orderBy('tanggal_transaksi', 'asc')
            ->get();

        $harianGrup = $transaksiMingguIni->groupBy(function ($item) {
            return Carbon::parse($item->tanggal_transaksi)->format('Y-m-d');
        });

        // Hitung Saldo Awal Masa Lalu
        $saldoAwalPerKategori = [];
        foreach ($kategori as $cat) {
            $masukLalu = Transaksi::where('kategori_id', $cat->id)->where('type', 'kes')->where('tanggal_transaksi', '<', $pemasukanMulai)->sum('amount');
            $keluarLalu = Transaksi::where('kategori_id', $cat->id)->where('type', 'transfer')->where('tanggal_transaksi', '<', $pengeluaranMulai)->sum('amount');
            $saldoAwalPerKategori[$cat->id] = $masukLalu - $keluarLalu;
        }

        $runningBalances = $saldoAwalPerKategori;
        $weeklyReport = []; 

               foreach ($harianGrup as $tanggal => $items) {
            $tanggalFormat = Carbon::parse($tanggal)->format('d M Y');
            $kategoriData = [];
            foreach ($kategori as $cat) {
                $catItems = $items->where('kategori_id', $cat->id);
                $kes = $catItems->where('type', 'kes')->sum('amount');
                $transfer = $catItems->where('type', 'transfer')->sum('amount');
                
                // PERBAIKAN: Masukkan data 'id' ke dalam return array map
                $listMasuk = $catItems->where('type', 'kes')->map(function($trans) { 
                    return [
                        'id' => $trans->id, // <--- Menambahkan ID Transaksi Masuk
                        'amount' => $trans->amount, 
                        'keterangan' => $trans->keterangan
                    ]; 
                })->values()->toArray();

                $listKeluar = $catItems->where('type', 'transfer')->map(function($trans) { 
                    return [
                        'id' => $trans->id, // <--- Menambahkan ID Transaksi Keluar
                        'amount' => $trans->amount, 
                        'keterangan' => $trans->keterangan
                    ]; 
                })->values()->toArray();

                $runningBalances[$cat->id] += ($kes - $transfer);
                $kategoriData[$cat->id] = [
                    'list_masuk'  => $listMasuk,
                    'list_keluar' => $listKeluar,
                    'saldo'       => $runningBalances[$cat->id]
                ];
            }
            $weeklyReport[] = ['period' => $tanggalFormat, 'data_per_kategori' => $kategoriData];
        }

        $jumatLalu = $pemasukanMulai; 
        $jumatMendatang = $pengeluaranSelesai;

        // Jika tombol unduh PDF diklik (Aksi cetak aktif)
        if ($request->has('aksi') && $request->input('aksi') === 'cetak') {
            return view('keuangan.cetak', compact(
                'weeklyReport', 'kategori', 'jumatLalu', 'jumatMendatang'
            ));
        }

        // Default: Tampilkan halaman dashboard utama operasional admin
        return view('keuangan.index', compact(
            'weeklyReport', 'kategori', 'prevWeekUrl', 'nextWeekUrl', 
            'currentWeekUrl', 'jumatLalu', 'jumatMendatang', 'saldoAwalPerKategori'
        ));
    }

}
