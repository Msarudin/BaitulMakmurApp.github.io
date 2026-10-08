<?php

use App\Http\Controllers\BagianController;
use App\Http\Controllers\HalamanController;
use App\Http\Controllers\IuranController;
use App\Http\Controllers\JamaahController;
use App\Http\Controllers\JenisAmalController;
use App\Http\Controllers\KeuanganController;
use App\Http\Controllers\KeuanganYayasanController;
use App\Http\Controllers\KtrmustahiqController;
use App\Http\Controllers\MustahiqController;
use App\Http\Controllers\MuzakiController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

// ========================================================
// 🔓 ROUTE UNTUK PENGUNJUNG UMUM (BELUM LOGIN / GUEST)
// ========================================================
Route::middleware('guest')->group(function () {
    // Route::get('/', function () {
    //     return view('layouts.index');
    // });
    Route::get('/', [HalamanController::class, 'index'])->name('landing');
    // 1. Halaman input email (Saat tombol "Forgot Password?" diklik)
    Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    // 2. Proses pengiriman link ke email
    Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

    // 3. Halaman buat password baru (Saat user klik link dari kotak masuk email mereka)
    Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    // 4. Proses update password baru ke database
    Route::post('reset-password', [ResetPasswordController::class, 'resetPassword'])->name('password.update');
});

Auth::routes();

Route::fallback(function() {
    return view('404');
});

// ========================================================
// 🔐 GRUP UTAMA: WAJIB LOGIN (MENGGUNAKAN MIDDLEWARE AUTH)
// ========================================================
Route::middleware('auth')->group(function () {
    
    // 🏠 DASHBOARD UTAMA & DETAIL KAS (Bisa diakses oleh SEMUA user termasuk Jamaah biasa)
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home'); 
    Route::get('/keuangan/kas-operasional', [KeuanganController::class, 'kasMasjid'])->name('keuangan.masjid');
    Route::get('/keuangan/kas-ambulan', [KeuanganController::class, 'kasAmbulan'])->name('keuangan.ambulan');
    Route::get('/keuangan/kas-yatim', [KeuanganController::class, 'kasYatim'])->name('keuangan.yatim');
    Route::get('/keuangan/kas-irma', [KeuanganController::class, 'kasIrma'])->name('keuangan.irma');

    // 🟢 AMAN UTK UMUM: Rute Buka Form & Proses Simpan Data Jamaah dipindah ke area bebas auth murni
    // Penempatan ini menjamin akun tanpa role ID (seperti bila@bila.com) BISA SUBMIT form tanpa diblokir!
    Route::get('/jamaah/create', [JamaahController::class, 'create'])->name('jamaah.create');
    Route::post('/jamaah/store', [JamaahController::class, 'store'])->name('jamaah.store');

    // Ubah bagian ujung ->name() menjadi seperti ini
    Route::get('/admin/change-password', [PasswordController::class, 'edit'])->name('password.edit');
    Route::post('/admin/change-password', [PasswordController::class, 'update'])->name('admin.password.update');

    // --------------------------------------------------------
    // 🔒 1. KELOMPOK ROUTE: PENGELOLA WARGA (rtrw15@gmail.com - Role ID 3)
    // --------------------------------------------------------
    Route::middleware(['pengelola_warga'])->group(function () {
        // Data Jamaah & Export khusus wilayah warga
        Route::get('/jamaah/export-excel', [JamaahController::class, 'exportExcel'])->name('jamaah.excel');
        Route::get('/jamaah/export-pdf', [JamaahController::class, 'exportPdf'])->name('jamaah.pdf');
        Route::get('/jamaah/rt/{rt}', [JamaahController::class, 'indexByRt'])->name('jamaah.rt');
        
        // Iuran Warga & Export
        Route::get('/iuran-warga/export-excel', [IuranController::class, 'exportExcel'])->name('iuran-warga.export-excel');
        Route::get('/iuran-warga/export-pdf', [IuranController::class, 'exportPdf'])->name('iuran-warga.export-pdf');
        Route::resource('iuran-warga', IuranController::class);
        
        // Wilayah RT RW 15
        Route::resource('bagian', BagianController::class);

        // Rute Cetak Kas Ambulan dikunci khusus milik pengelola warga
        Route::get('/keuangan/cetak-ambulan', [KeuanganController::class, 'printLaporanAmbulan'])->name('keuangan.cetak_ambulan');
    });
    // --------------------------------------------------------
    // 🔒 2. KELOMPOK ROUTE: PENGELOLA MASJID & KEUANGAN (adminbaitul@gmail.com - Role ID 4)
    // --------------------------------------------------------
    Route::middleware(['pengelola_masjid'])->group(function () {
        // Pembukuan Keuangan Inti & Fitur Cetak Terpisah
        Route::get('/muzaki/excel', [App\Http\Controllers\MuzakiController::class, 'exportExcel'])->name('muzaki.excel');
        Route::get('/muzaki/pdf', [App\Http\Controllers\MuzakiController::class, 'exportPdf'])->name('muzaki.pdf');
        Route::get('/keuangan/cetak-operasional', [KeuanganController::class, 'printLaporan'])->name('keuangan.cetak_operasional');
        Route::get('/keuangan/cetak-yatim', [KeuanganController::class, 'printLaporanYatim'])->name('keuangan.cetak_yatim');
        Route::get('/keuangan/cetak', [KeuanganController::class, 'printLaporan'])->name('keuangan.cetak');
        
        // Manipulasi Transaksi Kas
        Route::post('/keuangan/store', [KeuanganController::class, 'store'])->name('keuangan.store');
        Route::get('/keuangan/{id}/edit', [KeuanganController::class, 'edit'])->name('keuangan.edit');
        Route::put('/keuangan/{id}', [KeuanganController::class, 'update'])->name('keuangan.update');
        Route::delete('/keuangan/{id}', [KeuanganController::class, 'destroy'])->name('keuangan.destroy');
        Route::get('/keuangan-masjid/print', [KeuanganController::class, 'printLaporan'])->name('keuangan.print');
        
        // Resource Kriteria Amal & Mustahiq
        Route::resource('ktrmustahiq', KtrmustahiqController::class);
        Route::resource('jenis_amal', JenisAmalController::class);
        
        // 🟢 SINKRONISASI UTAMA: Mengecualikan create & store agar versi umum di atas yang berjalan!
        // Fitur melihat list index, mengedit, dan menghapus data jamaah tetap terkunci aman untuk pengurus
        Route::resource('jamaah', JamaahController::class)->except(['create', 'store']);

        // Keuangan Yayasan & Zakat
        Route::get('/keuangan-yayasan/print', [KeuanganYayasanController::class, 'printLaporan'])->name('keuangan-yayasan.print');
        Route::resource('keuangan-yayasan', KeuanganYayasanController::class);
        Route::resource('mustahiq', MustahiqController::class);
        Route::resource('muzaki', MuzakiController::class);
    });

    // --------------------------------------------------------
    // 🔒 3. KELOMPOK ROUTE: PENGELOLA IRMA / REMAJA MASJID (adminirma@gmail.com - Role ID 5)
    // --------------------------------------------------------
    Route::middleware(['pengelola_irma'])->group(function () {
        // Fitur Cetak Laporan Kas Khusus IRMA
        Route::get('/keuangan/cetak-irma', [KeuanganController::class, 'printLaporanIrma'])->name('keuangan.cetak_irma');
    });

    // --------------------------------------------------------
    // 👑 4. KELOMPOK ROUTE: SUPERADMIN / SUPERVISOR (efendimse@gmail.com - Role ID 1)
    // --------------------------------------------------------
    Route::middleware(['isSupervisor'])->group(function () {
        // Management Akun Pengguna & Update Role
        Route::resource('users', UserController::class);
        Route::post('user-update-role', [UserController::class, 'updateRole'])->name('users.update-role');
        
        // Fitur Ekspor Data Zakat
        Route::get('/export-mustahiq-excel', [MustahiqController::class, 'exportExcel'])->name('mustahiq.excel');
        Route::get('/export-mustahiq-pdf', [MustahiqController::class, 'exportPdf'])->name('mustahiq.pdf');
        Route::get('/export-muzaki-excel', [MuzakiController::class, 'exportExcel'])->name('muzaki.export-excel');
        Route::get('/export-muzaki-pdf', [MuzakiController::class, 'exportPdf'])->name('muzaki.export-pdf');
    });

}); // 🔐 PENUTUP MUTLAK GRUP UTAMA MIDDLEWARE AUTH

// ========================================================
// 🌐 GRUP ROUTE INFO HALAMAN UTAMA (TAMPILAN DEPAN PROFILE)
// ========================================================
Route::middleware('guest')
    ->prefix('halaman')
    ->group(function () {
        Route::get('/sambutan', [HalamanController::class, 'sambutan'])->name('sambutan');
        Route::get('/qurban', [HalamanController::class, 'qurban'])->name('qurban');
        Route::get('/ngaji', [HalamanController::class, 'ngaji'])->name('ngaji');
        Route::get('/nisan', [HalamanController::class, 'nisan'])->name('nisan');
        Route::get('/kegiatan', [HalamanController::class, 'kegiatan'])->name('kegiatan');
        Route::get('/konsul', [HalamanController::class, 'konsul'])->name('konsul');
        Route::get('/ldk', [HalamanController::class, 'ldk'])->name('ldk');
        Route::get('/tentang', [HalamanController::class, 'tentang'])->name('tentang');

        // Route untuk menyimpan nominal input manual dari halaman admin ke database
        Route::post('/keuangan/simpan-saldo-user', function(Illuminate\Http\Request $request) {
            // Menyimpan angka input ke dalam cache database Laravel agar bisa dibaca di IP mana pun
            \Illuminate\Support\Facades\Cache::forever('saldo_manual_masjid', $request->saldo_input);
            return response()->json(['status' => 'success']);
        })->name('keuangan.simpan_saldo_user');
    });
