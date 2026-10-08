@extends('layouts.indexAdmin')

@section('content')
<style>
    @media print {
        @page {
            size: A4 landscape;
            margin: 8mm 10mm 8mm 10mm;
        }
        * {
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
            color-adjust: exact !important;
        }
        body { 
            background: white !important; 
            color: #000000 !important; 
            font-size: 12px !important;
        }
        form, .alert, h2.text-center, .card-header, .d-print-none, .btn, .btn-sm, select {
            display: none !important;
        }
        thead tr th:nth-child(3), thead tr th:nth-child(6),
        tbody tr td:nth-child(4), tbody tr td:nth-child(7),
        th[class*="cat-aksi"], td[class*="cat-aksi"], .action-col {
            display: none !important;
        }
        .table { 
            width: 100% !important; 
            max-width: 100% !important;
            border-collapse: collapse !important; 
            margin-top: 15px !important;
        }
        .table th, .table td { 
            border: 1px solid #000000 !important; 
            padding: 5px 4px !important; 
            font-size: 11px !important;
            vertical-align: middle !important;
        }
        .table table {
            width: 100% !important;
            border-collapse: collapse !important;
            background: transparent !important;
        }
        .table table tr, .table table td {
            border: none !important;
            padding: 3px 4px !important;
        }
        .table table tr:not(:last-child) {
            border-bottom: 1px solid #c0c0c0 !important; 
        }
        tr {
            page-break-inside: avoid !important;
        }
    }
</style>

<!-- KOP SURAT RESMI CETAK -->
<div class="d-none d-print-block container mb-3">
    <div class="d-flex align-items-center justify-content-center border-bottom border-4 border-dark pb-2 position-relative">
        <div class="position-absolute start-0 top-0 pt-2">
            <img src="{{ asset('templateAdmin/dist') }}/assets/images/logo2.jpg" alt="Logo" style="width: 90px; height: auto;">
        </div>
        <div class="text-center w-100 ps-5">
            <h4 class="fw-bold mb-0 text-uppercase" style="font-family: 'Times New Roman', Times, serif; letter-spacing: 0.5px;">Dewan Kemakmuran Masjid (DKM)</h4>
            <h1 class="fw-bold mb-0" style="font-family: 'Times New Roman', Times, serif; color: #181b1a; font-size: 28px;">MASJID JAMI' BAITUL MAKMUR</h1>
            <p class="mb-0 fw-bold" style="font-size: 12px; font-family: Arial, sans-serif;">KP. BOJONG RT 03 RW 15 KEL. KUNCIRAN INDAH KEC. PINANG</p>
            <p class="mb-1 fw-bold" style="font-size: 12px; font-family: Arial, sans-serif;">KOTA TANGERANG</p>
            <p class="mb-0 text-muted" style="font-size: 11px;">Email: JBaitulMakmur@gmail.com &nbsp;&bull;&nbsp; FB: Jami Baitul Makmur</p>
        </div>
    </div>
</div>

<div class="card">
    <div class="container my-5">
        <h2 class="text-center mb-4 fw-bold">Sistem Informasi Keuangan IRMA</h2>

        @if ($errors->any())
            <div class="alert alert-danger shadow-sm mb-4">
                <h5 class="fw-bold mb-2">Gagal Menyimpan Transaksi:</h5>
                <ul class="mb-0">
                    @foreach ($errors->all() as $error) 
                        <li>{{ $error }}</li> 
                    @endforeach
                </ul>
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- FORM INPUT TRANSAKSI KAS YAYASAN -->
        <div class="card shadow-sm mb-5 d-print-none">
            <div class="card-header text-white text-center fw-bold fs-4" style="background-color: #0b7f63 !important;">
                Kas Operasional IRMA
            </div>
            <div class="card-body">
                <!-- PERBAIKAN: Pastikan action mengarah ke keuangan.store milik Masjid -->
                    <form action="{{ route('keuangan.store') }}" method="POST">
                        @csrf
                        <!-- 2. WAJIB DISISIPKAN DI SINI: Input tersembunyi ID Kategori 1 untuk Kas Masjid -->
                        <input type="hidden" name="kategori_id" value="4">
                        <div class="row g-3">
                            <!-- Struktur input Tanggal Transaksi, Jenis Transaksi, Nominal, dan Keterangan Anda -->
                            <div class="col-md-3">
                                <label class="form-label fw-semibold text-secondary" style="font-size: 13px;">Tanggal Transaksi</label>
                                <input type="date" class="form-control" name="tanggal_transaksi" value="{{ date('Y-m-d') }}" required>
                            </div>
                        <!-- 2. Kolom Jenis Transaksi (Diperbaiki: name="type" dan value="kes"/"transfer") -->
                        <div class="col-md-3">
                            <label class="form-label fw-semibold text-secondary" style="font-size: 13px;">Jenis Transaksi</label>
                            <select class="form-select" name="type" required>
                                <option value="" selected disabled>-- Pilih Jenis Kas --</option>
                                <option value="kes">Uang Masuk (Pemasukan)</option>
                                <option value="transfer">Uang Keluar (Pengeluaran)</option>
                            </select>
                        </div>
                        
                        <!-- 3. Kolom Nominal (Diperbaiki: name="amount") -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-secondary" style="font-size: 13px;">Nominal (Rp)</label>
                            <input type="text" class="form-control" placeholder="Contoh: 500.000" required onkeyup="formatRupiah(this)" name="amount">
                        </div>
                        
                        <!-- 4. Kolom Keterangan (Sudah Benar: name="keterangan") -->
                        <div class="col-md-12 mt-2">
                            <label class="form-label fw-semibold text-secondary" style="font-size: 13px;">Keterangan / Uraian Transaksi</label>
                            <input type="text" class="form-control" name="keterangan" placeholder="Contoh: Sumbangan hamba Allah untuk Kas IRMA" required>
                        </div>
                    </div>
                    <div class="mt-4 text-end">
                        <button type="reset" class="btn btn-secondary me-2">Reset</button>
                        <button type="submit" class="btn btn-success px-4" style="background-color: #0b7f63 !important; border-color: #0b7f63 !important;">Simpan Transaksi</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- TABEL REKAPITULASI LAPORAN MURNI -->
        <div class="card shadow-sm mt-4">
            <div class="card-header text-white text-center fw-bold fs-5 py-3" style="background-color: #0b7f63 !important;">
                Laporan Buku Kas Operasional IRMA
            </div>
            <div class="card-body" style="overflow-x: auto;">
                
                <div class="mb-4 d-flex flex-wrap align-items-center justify-content-between w-100">
                    
                    <!-- 1. SISI KIRI: Informasi Periode -->
                    <div class="d-flex align-items-center">
                        <span class="text-dark fw-bold px-3 py-2 rounded-2" style="background-color: #e2f3ee; color: #0b7f63; font-size: 13px;">
                            <i class="fas fa-calendar-alt me-1"></i> Periode: 
                            {{ isset($jumatLalu) ? $jumatLalu->locale('id')->translatedFormat('d M') : '-' }} - 
                            {{ isset($jumatMendatang) ? $jumatMendatang->locale('id')->translatedFormat('d M Y') : '-' }}
                        </span>
                    </div>

                    <!-- 2. SISI TENGAH: Tombol Navigasi Minggu Bergeser ke Tengah -->
                    <div class="d-flex gap-2 justify-content-center">
                        <a href="{{ $prevWeekUrl ?? '#' }}" class="btn btn-sm btn-outline-secondary px-3">« Minggu Lalu</a>
                        <a href="{{ $currentWeekUrl ?? '#' }}" class="btn btn-sm btn-secondary px-2">Minggu Ini</a>
                        <a href="{{ $nextWeekUrl ?? '#' }}" class="btn btn-sm btn-outline-secondary px-3">Minggu Depan »</a>
                    </div>

                    <!-- 3. SISI KANAN: Tombol Cetak Tetap Sejajar Kolom Saldo -->
                    <div class="d-print-none">
                        <!-- PERBAIKAN DINAMIS: Menggunakan $jumatLalu->format('Y-m-d') agar tanggal cetak otomatis mengikuti minggu yang sedang dibuka -->
                        <a href="{{ route('keuangan.cetak_irma', ['start_date' => isset($jumatMendatang) ? \Carbon\Carbon::parse($jumatMendatang)->format('Y-m-d') : date('Y-m-d')]) }}" target="_blank" class="btn btn-sm btn-primary fw-bold px-3" style="background-color: #007bff; border-color: #007bff;">
                            <i class="fas fa-file-pdf me-1"></i> Download PDF / Cetak
                        </a>
                    </div>         
                </div>

                @php
                    $grandTotalPemasukanAllKategori = 0;
                    $grandTotalPengeluaranAllKategori = 0;
                @endphp

                <!-- Konstruksi Tabel Multi-Kolom Bersih Khusus Kas Yayasan -->
                <table class="table table-bordered align-middle text-center table-hover" style="font-size: 13px; border: 1px solid #dee2e6;">
                    <thead class="text-center fw-bold text-dark">
                        <!-- BARIS 1: Header Hijau Memanjang Penuh Semuanya -->
                        <tr style="border-bottom: 2px solid #0b7f63;">
                            <!-- Tambahkan +1 pada colspan untuk ikut membungkus kolom tanggal di bawahnya -->
                            @foreach($kategori as $cat)
                                <th colspan="8" class="text-white py-2" style="background-color: #0b7f63 !important; letter-spacing: 0.5px; border: 1px solid #dee2e6;">
                                    {{ $cat->name }}
                                </th>
                            @endforeach
                        </tr>

                        <!-- BARIS 2: Semua Judul Kolom Sejajar Merata di Sini -->
                        <tr style="font-size: 12px; background-color: #f1f3f2;">
                            <!-- Kolom Tanggal Transaksi dipindah ke bawah agar sejajar uang masuk -->
                            <th width="12%" style="border: 1px solid #dee2e6; background-color: #f8f9fa; vertical-align: middle;">Tanggal Transaksi</th>
                            
                            @foreach($kategori as $cat)
                                <th style="border: 1px solid #dee2e6; background-color: #f8f9fa; vertical-align: middle;">Uang Masuk</th>
                                <th style="border: 1px solid #dee2e6; background-color: #f8f9fa; vertical-align: middle;">Keterangan</th>
                                <th style="border: 1px solid #dee2e6; background-color: #f8f9fa; vertical-align: middle;">Aksi</th>
                                <th style="border: 1px solid #dee2e6; background-color: #f8f9fa; vertical-align: middle;">Uang Keluar</th>
                                <th style="border: 1px solid #dee2e6; background-color: #f8f9fa; vertical-align: middle;">Keterangan</th>
                                <th style="border: 1px solid #dee2e6; background-color: #f8f9fa; vertical-align: middle;">Aksi</th>
                                <th style="border: 1px solid #dee2e6; background-color: #f8f9fa; vertical-align: middle;">Saldo</th>
                            @endforeach
                        </tr>
                    </thead>

                <tbody>
                        @forelse($weeklyReport ?? [] as $report)
                        <tr>
                            <td class="fw-bold bg-light">{{ $report['period'] }}</td>
                            @foreach($kategori as $cat)
                                @php 
                                    $catData = $report['data_per_kategori'][$cat->id];
                                    $maxRows = max(count($catData['list_masuk']), count($catData['list_keluar']), 1);
                                @endphp
                                
                                <!-- 1. Sub-Kolom Uang Masuk -->
                                <td class="p-0" style="vertical-align: top; width: 110px;">
                                    <table class="table table-borderless m-0 bg-transparent w-100">
                                        @for($i = 0; $i < $maxRows; $i++)
                                            @php
                                                if(isset($catData['list_masuk'][$i])) {
                                                    $grandTotalPemasukanAllKategori += $catData['list_masuk'][$i]['amount'];
                                                }
                                            @endphp
                                            <tr class="{{ $i < $maxRows - 1 ? 'border-bottom border-light' : '' }}">
                                                <td class="p-2 text-end text-success fw-semibold" style="height: 42px;">
                                                    {{ isset($catData['list_masuk'][$i]) ? number_format($catData['list_masuk'][$i]['amount'], 0, ',', '.') : '-' }}
                                                </td>
                                            </tr>
                                        @endfor
                                    </table>
                                </td>

                                <!-- 2. Sub-Kolom Keterangan Masuk -->
                                <td class="p-0" style="vertical-align: top; min-width: 150px;">
                                    <table class="table table-borderless m-0 bg-transparent w-100">
                                        @for($i = 0; $i < $maxRows; $i++)
                                            <tr class="{{ $i < $maxRows - 1 ? 'border-bottom border-light' : '' }}">
                                                <td class="p-2 text-dark text-start" style="height: 42px; font-size: 11px;">
                                                    {{ isset($catData['list_masuk'][$i]) ? '- ' . $catData['list_masuk'][$i]['keterangan'] : '-' }}
                                                </td>
                                            </tr>
                                        @endfor
                                    </table>
                                </td>

                                <!-- 3. Sub-Kolom Aksi Masuk -->
                                <td class="p-0" style="vertical-align: top; width: 90px;">
                                    <table class="table table-borderless m-0 bg-transparent w-100">
                                        @for($i = 0; $i < $maxRows; $i++)
                                            <tr class="{{ $i < $maxRows - 1 ? 'border-bottom border-light' : '' }}">
                                                <td class="p-1 text-center" style="height: 42px;">
                                                    @if(isset($catData['list_masuk'][$i]))
                                                        <div class="d-flex justify-content-center gap-1">
                                                            <a href="{{ route('keuangan.edit', $catData['list_masuk'][$i]['id']) }}" class="btn btn-sm py-0 px-1 btn-outline-warning" style="font-size: 10px;">Edit</a>
                                                            <form action="{{ route('keuangan.destroy', $catData['list_masuk'][$i]['id']) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin?')">
                                                                @csrf 
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-sm py-0 px-1 btn-outline-danger" style="font-size: 10px;">Hapus</button>
                                                            </form>
                                                        </div>
                                                    @else 
                                                        - 
                                                    @endif
                                                </td>
                                            </tr>
                                        @endfor
                                    </table>
                                </td>

                                <!-- 4. Sub-Kolom Uang Keluar -->
                                <td class="p-0" style="vertical-align: top; width: 110px;">
                                    <table class="table table-borderless m-0 bg-transparent w-100">
                                        @for($i = 0; $i < $maxRows; $i++)
                                            @php
                                                if(isset($catData['list_keluar'][$i])) {
                                                    $grandTotalPengeluaranAllKategori += $catData['list_keluar'][$i]['amount'];
                                                }
                                            @endphp
                                            <tr class="{{ $i < $maxRows - 1 ? 'border-bottom border-light' : '' }}">
                                                <td class="p-2 text-end text-danger fw-semibold" style="height: 42px;">
                                                    {{ isset($catData['list_keluar'][$i]) ? number_format($catData['list_keluar'][$i]['amount'], 0, ',', '.') : '-' }}
                                                </td>
                                            </tr>
                                        @endfor
                                    </table>
                                </td>

                                <!-- 5. Sub-Kolom Keterangan Keluar -->
                                <td class="p-0" style="vertical-align: top; min-width: 150px;">
                                    <table class="table table-borderless m-0 bg-transparent w-100">
                                        @for($i = 0; $i < $maxRows; $i++)
                                            <tr class="{{ $i < $maxRows - 1 ? 'border-bottom border-light' : '' }}">
                                                <td class="p-2 text-dark text-start" style="height: 42px; font-size: 11px;">
                                                    {{ isset($catData['list_keluar'][$i]) ? '- ' . $catData['list_keluar'][$i]['keterangan'] : '-' }}
                                                </td>
                                            </tr>
                                        @endfor
                                    </table>
                                </td>

                                <!-- 6. Sub-Kolom Aksi Keluar -->
                                <td class="p-0" style="vertical-align: top; width: 90px;">
                                    <table class="table table-borderless m-0 bg-transparent w-100">
                                        @for($i = 0; $i < $maxRows; $i++)
                                            <tr class="{{ $i < $maxRows - 1 ? 'border-bottom border-light' : '' }}">
                                                <td class="p-1 text-center" style="height: 42px;">
                                                    @if(isset($catData['list_keluar'][$i]))
                                                        <div class="d-flex justify-content-center gap-1">
                                                            <a href="{{ route('keuangan.edit', $catData['list_keluar'][$i]['id']) }}" class="btn btn-sm py-0 px-1 btn-outline-warning" style="font-size: 10px;">Edit</a>
                                                            <form action="{{ route('keuangan.destroy', $catData['list_keluar'][$i]['id']) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin?')">
                                                                @csrf 
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-sm py-0 px-1 btn-outline-danger" style="font-size: 10px;">Hapus</button>
                                                            </form>
                                                        </div>
                                                    @else 
                                                        - 
                                                    @endif
                                                </td>
                                            </tr>
                                        @endfor
                                    </table>
                                </td>

                                <!-- 7. Kolom Saldo Berjalan Kategori -->
                                <td class="text-end fw-bold bg-light" style="vertical-align: middle; width: 120px;">
                                    Rp {{ number_format($catData['saldo'], 0, ',', '.') }}
                                </td>
                            @endforeach
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-4 text-muted">
                                Belum ada data transaksi kas yayasan di rentang periode ini.
                            </td>
                        </tr>
                     @endforelse
                </tbody>
            </table>

            <!-- TABEL FOOTER REKAPITULASI & TANDA TANGAN -->
            <table style="width: 100%; border: none !important; margin-top: 20px;">
                <tr>
                    <!-- Sisi Kiri: Kotak Ringkasan Saldo -->
                    <td style="width: 45%; text-align: left; border: none !important; padding: 0; vertical-align: top;">
                        <table class="table table-sm table-bordered" style="font-size: 13px; width: 100%; margin: 0; border: 1px solid #000;">
                            <tr>
                                <td class="fw-bold py-1 ps-2 bg-light text-start" style="width: 55%; border: 1px solid #000 !important;">Total Pemasukan 1 Minggu</td>
                                <td class="fw-bold text-success text-end pe-2" style="border: 1px solid #000 !important;">Rp {{ number_format($grandTotalPemasukanAllKategori, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold py-1 ps-2 bg-light text-start" style="border: 1px solid #000 !important;">Total Pengeluaran 1 Minggu</td>
                                <td class="fw-bold text-danger text-end pe-2" style="border: 1px solid #000 !important;">Rp {{ number_format($grandTotalPengeluaranAllKategori, 0, ',', '.') }}</td>
                            </tr>
                            <tr class="table-dark">
                                <td class="fw-bold py-2 ps-2 text-start" style="border: 1px solid #000 !important; background-color: #212529; color: #fff;">Saldo Akhir Berjalan</td>
                                <td class="fw-bold text-end pe-2" style="font-size: 14px; border: 1px solid #000 !important; background-color: #212529; color: #fff;">
                                    Rp {{ number_format($grandTotalPemasukanAllKategori - $grandTotalPengeluaranAllKategori, 0, ',', '.') }}
                                </td>
                            </tr>
                        </table><br>
                        <table class="table table-sm table-bordered" style="font-size: 13px; width: 100%; margin: 0; border: 1px solid #000;">
                            <tr class="table-dark">
                                @php
                                    $saldoAwalNilai = 0;
                                    if (isset($saldoAwalPerKategori)) {
                                        $saldoAwalNilai = is_array($saldoAwalPerKategori) ? array_sum($saldoAwalPerKategori) : $saldoAwalPerKategori;
                                    }
                                    $saldoMingguan = $grandTotalPemasukanAllKategori - $grandTotalPengeluaranAllKategori;
                                    $totalSaldoKeseluruhan = $saldoAwalNilai + $saldoMingguan;
                                @endphp
                                <tr class="table-dark">
                                    <td class="fw-bold py-2 ps-2 text-start" style="border: 1px solid #000 !important; background-color: #212529; color: #fff;">Total Saldo Keseluruhan</td>
                                    <td class="fw-bold text-end pe-2" style="font-size: 14px; border: 1px solid #000 !important; background-color: #212529; color: #fff;">
                                        Rp {{ number_format($totalSaldoKeseluruhan, 0, ',', '.') }}
                                    </td>
                                </tr>
                            </tr>
                        </table>
                    </td>

                    <!-- Pemisah Tengah -->
                    <td style="width: 5%; border: none !important;"></td>

                    <!-- Sisi Kanan: Tanda Tangan Pengurus -->
                    <td style="width: 50%; border: none !important; padding: 0; vertical-align: top;">
                        <table style="width: 100%; border: none !important; font-size: 13px; margin: 0;">
                            <tr>
                                <td style="border: none !important; width: 50%;"></td>
                                <td style="border: none !important; width: 50%; text-align: center; font-weight: 500; padding-bottom: 5px;">
                                    Tangerang, {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('d F Y') }}
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: center; border: none !important; font-weight: bold;">
                                    Bendahara
                                </td>
                                <td style="text-align: center; border: none !important; font-weight: bold;">
                                    Ketua DKM,<br>Masjid Jami' Baitul Makmur
                                </td>
                            </tr>
                            <tr>
                                <td style="height: 55px; border: none !important;"></td>
                                <td style="height: 55px; border: none !important;"></td>
                            </tr>
                            <tr>
                                <td style="text-align: center; border: none !important; font-weight: bold; text-decoration: underline;">
                                    Bpk. M. Subur
                                </td>
                                <td style="text-align: center; border: none !important; font-weight: bold; text-decoration: underline;">
                                    Ustd. Yanwar Fahri
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
    </div>

</div>
</div>

<script>
function formatRupiah(elemen) {
    let nilai = elemen.value.replace(/\D/g, '');
    if (nilai) { 
        elemen.value = new Intl.NumberFormat('id-ID').format(nilai); 
        let bersih = nilai;
        document.getElementById('nominal_bersih').value = bersih;
    } else { 
        elemen.value = ''; 
        document.getElementById('nominal_bersih').value = '';
    }
}
</script>
@endsection


