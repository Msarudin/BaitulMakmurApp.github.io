@extends('layouts.indexAdmin')

@section('content')
<div class="container-fluid px-3">
    
    <!-- BANNER UTAMA (JUMBOTRON HIJAU) -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="p-5 text-white rounded-3 position-relative overflow-hidden shadow-sm" style="background-color: #0b7f63;">
                <div class="row align-items-center z-1 position-relative">
                    <!-- SISI KIRI: Selamat Datang -->
                    <div class="col-md-7 mb-3 mb-md-0">
                        <span class="badge bg-white text-success fw-bold mb-2 px-3 py-2 rounded-2" style="font-size: 11px;">Aplikasi Baitul Makmur</span>
                        <h2 class="fw-bold text-white mb-2" style="letter-spacing: -0.5px;">Selamat datang!</h2>
                        <p class="mb-0 text-white-50" style="font-size: 14px; max-width: 500px;">
                            Kelola data jamaah, pembukuan keuangan kas masjid, kas ambulan, kas yatim, serta laporan iuran bulanan warga secara mudah dan transparan.
                        </p>
                    </div>
                    
                    <!-- SISI KANAN: Pertanyaan & Tombol Daftar -->
                    <div class="col-md-5 text-md-end text-start">
                        <p class="mb-2 text-white fw-medium" style="font-size: 14px; line-height: 1.4;">
                            Apakah anda sudah terdaftar sebagai Jamaah Masjid Jami' Baitul Makmur or Warga RW 15?
                        </p>
                        <a href="{{ route('jamaah.create') }}" class="btn btn-sm btn-outline-white text-white fw-bold px-3 py-2 rounded-2 border-2" style="border-color: rgba(255,255,255,0.6); font-size: 12px; transition: all 0.3s;">
                            Jika Belum Silahkan Daftar diri anda di sini
                        </a>
                    </div>
                </div>
                <div class="position-absolute end-0 top-50 translate-middle-y opacity-10 d-none d-md-block" style="width: 200px; height: 200px; background: rgba(255,255,255,0.2); border-radius: 50%; margin-right: -50px;"></div>
            </div>
        </div>
    </div>

    <!-- 🛠️ TAMPILAN DASHBOARD GRID CARD -->
    <div class="row g-4 mb-4">

        <!-- CARD 1: KAS MASJID -->
        <div class="col-12 col-md-6 col-xl-4">
            <div class="card border-0 shadow-sm rounded-3 h-100 bg-white">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <span class="fw-bold text-muted" style="font-size: 12px; letter-spacing: 0.5px;">TOTAL SALDO KAS MASJID</span>
                        <div class="rounded-2 p-2" style="background-color: #e2f3ee !important; color: #0b7f63 !important;">
                            <i class="ti ti-building-home fs-4"></i>
                        </div>
                    </div>
                    <!-- 🟢 KEMBALI NORMAL: ID Menggunakan saldo-kas-masjid untuk Halaman Admin -->
                    <h3 class="fw-bold mb-1" id="saldo-kas-masjid" style="color: #29303e; font-size: 22px;">
                        Rp {{ number_format($saldoMasjid ?? 0, 0, ',', '.') }}
                    </h3>
                    <small class="text-muted" style="font-size: 11px;"><i class="ti ti-circle-check text-success me-1"></i>Saldo Real-time</small>
                </div>
            </div>
        </div>

        <!-- CARD 2: KAS AMBULAN -->
        <div class="col-12 col-md-6 col-xl-4">
            <div class="card border-0 shadow-sm rounded-3 h-100 bg-white">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <span class="fw-bold text-muted" style="font-size: 12px; letter-spacing: 0.5px;">TOTAL SALDO KAS AMBULAN</span>
                        <div class="rounded-2 p-2" style="background-color: #e3f2fd !important; color: #1e88e5 !important;">
                            <i class="ti ti-ambulance fs-4"></i>
                        </div>
                    </div>
                    <h3 class="fw-bold mb-1" style="color: #29303e; font-size: 22px;">
                        Rp {{ number_format($saldoAmbulan ?? 0, 0, ',', '.') }}
                    </h3>
                    <small class="text-muted" style="font-size: 11px;"><i class="ti ti-circle-check text-success me-1"></i>Kesiapan Operasional</small>
                </div>
            </div>
        </div>

        <!-- CARD 3: KAS YATIM -->
        <div class="col-12 col-md-6 col-xl-4">
            <div class="card border-0 shadow-sm rounded-3 h-100 bg-white">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <span class="fw-bold text-muted" style="font-size: 12px; letter-spacing: 0.5px;">TOTAL SALDO KAS YATIM</span>
                        <div class="rounded-2 p-2" style="background-color: #fff8e1 !important; color: #ffb300 !important;">
                            <i class="ti ti-heart fs-4"></i>
                        </div>
                    </div>
                    <h3 class="fw-bold mb-1" style="color: #29303e; font-size: 22px;">
                        Rp {{ number_format($saldoYatim ?? 0, 0, ',', '.') }}
                    </h3>
                    <small class="text-muted" style="font-size: 11px;"><i class="ti ti-circle-check text-success me-1"></i>Dana Sosial Warga</small>
                </div>
            </div>
        </div>

        <!-- CARD 4: KAS IRMA -->
        <div class="col-12 col-md-6 col-xl-4">
            <div class="card border-0 shadow-sm rounded-3 h-100 bg-white">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <span class="fw-bold text-muted" style="font-size: 12px; letter-spacing: 0.5px;">TOTAL SALDO KAS IRMA</span>
                        <div class="rounded-2 p-2" style="background-color: #e8eaf6 !important; color: #3f51b5 !important;">
                            <i class="ti ti-users fs-4"></i>
                        </div>
                    </div>
                    <h3 class="fw-bold mb-1" style="color: #29303e; font-size: 22px;">
                        Rp {{ number_format($saldoIrma ?? 0, 0, ',', '.') }}
                    </h3>
                    <small class="text-muted" style="font-size: 11px;"><i class="ti ti-circle-check text-success me-1"></i>Remaja Masjid</small>
                </div>
            </div>
        </div>

        <!-- CARD 5: TOTAL IURAN WARGA -->
        <div class="col-12 col-md-6 col-xl-4">
            <div class="card border-0 shadow-sm rounded-3 h-100 bg-white">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <span class="fw-bold text-muted" style="font-size: 12px; letter-spacing: 0.5px;">TOTAL IURAN WARGA</span>
                        <div class="rounded-2 p-2" style="background-color: #f3e5f5 !important; color: #8e24aa !important;">
                            <i class="ti ti-wallet fs-4"></i>
                        </div>
                    </div>
                    <h3 class="fw-bold mb-1" style="color: #29303e; font-size: 22px;">
                        Rp {{ number_format($totalIuranWarga ?? 0, 0, ',', '.') }}
                    </h3>
                    <small class="text-muted" style="font-size: 11px;"><i class="ti ti-circle-check text-success me-1"></i>Akumulasi Iuran Bulanan</small>
                </div>
            </div>
        </div>

        <!-- CARD 6: TOTAL DATA JAMAAH -->
        <div class="col-12 col-md-6 col-xl-4">
            <div class="card border-0 shadow-sm rounded-3 h-100 bg-white">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <span class="fw-bold text-muted" style="font-size: 12px; letter-spacing: 0.5px;">TOTAL DATA JAMAAH</span>
                        <div class="rounded-2 p-2" style="background-color: #efebe9 !important; color: #5d4037 !important;">
                            <i class="ti ti-id fs-4"></i>
                        </div>
                    </div>
                    <h3 class="fw-bold mb-1" style="color: #29303e; font-size: 22px;">
                        {{ $totalJamaah ?? 0 }} Orang
                    </h3>
                    <small class="text-muted" style="font-size: 11px;"><i class="ti ti-user-check text-success me-1"></i>Jiwa Terdata Terdaftar</small>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var saldoTerakhirPeriode = localStorage.getItem('saldo_masjid_terakhir');
        if (saldoTerakhirPeriode && saldoTerakhirPeriode !== 'Rp 0') {
            var elemenSaldoHome = document.getElementById('saldo-kas-masjid');
            if (elemenSaldoHome) {
                elemenSaldoHome.innerText = saldoTerakhirPeriode;
            }
        }
    });
</script>
@endsection
