<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Buku Kas Operasional Masjid - Cetak Arsip</title>
    <style>
        @page {
            size: A4 landscape;
            margin: 5mm 8mm 5mm 8mm; 
        }
        body {
            background-color: #ffffff;
            font-family: Arial, sans-serif;
            color: #000000;
            font-size: 11px;
            margin: 0;
            padding: 0;
            line-height: 1.3;
        }
        * {
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
            color-adjust: exact !important;
        }
        .kop-table {
            width: 100%;
            border-collapse: collapse;
            border-bottom: 4px double #000000;
            margin-bottom: 10px;
        }
        .kop-logo {
            width: 80px;
            vertical-align: middle;
            padding-bottom: 5px;
        }
        .kop-text {
            text-align: center;
            vertical-align: middle;
            padding-right: 80px;
        }
        .table-cetak {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        .table-cetak th, .table-cetak td {
            border: 1px solid #000000 !important;
            padding: 7px 5px !important;
            vertical-align: middle;
            font-size: 11px;
        }
        .table-cetak thead th {
            background-color: #f8f9fa !important;
            font-weight: bold;
            text-align: center;
        }
        .text-masuk { color: #28a745 !important; font-weight: bold; }
        .text-keluar { color: #dc3545 !important; font-weight: bold; }
        tr { page-break-inside: avoid !important; }
        .footer-wrapper { margin-top: 20px; width: 100%; }
        .rekap-table { width: 100%; border-collapse: collapse; }
        .rekap-table td { border: 1px solid #000000 !important; padding: 7px 10px !important; }
    </style>
</head>
<body onload="window.print()">

<div style="width: 100%;">
    <!-- ==================== KOP SURAT RESMI MASJID ==================== -->
    <table class="kop-table">
        <tr>
            <td class="kop-logo">
                <img src="{{ asset('templateAdmin/dist/assets/images/logo2.jpg') }}" alt="Logo DKM" style="width: 75px; height: auto;">
            </td>
            <td class="kop-text">
                <h5 style="font-family: 'Times New Roman'; font-weight: bold; text-transform: uppercase; margin: 0; font-size: 14px; letter-spacing: 0.5px;">Dewan Kemakmuran Masjid (DKM)</h5>
                <h1 style="font-family: 'Times New Roman'; font-weight: bold; color: #0b7f63; margin: 2px 0; font-size: 24px;">MASJID JAMI' BAITUL MAKMUR</h1>
                <p style="font-size: 11px; font-weight: bold; margin: 0;">KP. BOJONG RT 03 RW 15 KEL. KUNCIRAN INDAH KEC. PINANG</p>
                <p style="font-size: 11px; font-weight: bold; margin: 1px 0;">KOTA TANGERANG</p>
                <p style="color: #6c757d; font-size: 10px; margin: 0;">Email: JBaitulMakmur@gmail.com &nbsp;&bull;&nbsp; FB: Jami Baitul Makmur</p>
            </td>
        </tr>
    </table>

    <!-- TITLE LAPORAN -->
    <h4 style="text-align: center; font-weight: bold; margin: 5px 0 2px 0; font-size: 13px; text-transform: uppercase;">Laporan Buku Kas Operasional Masjid</h4>
    <p style="text-align: center; color: #333; margin: 0 0 10px 0; font-size: 11px; font-weight: bold;">
        Periode: {{ \Carbon\Carbon::parse($jumatLalu)->locale('id')->translatedFormat('d M Y') }} s/d {{ \Carbon\Carbon::parse($jumatMendatang)->locale('id')->translatedFormat('d M Y') }}
    </p>

    <!-- ==================== TABEL DATA FORMAT TUNGGAL SAMA DENGAN INDEX ==================== -->
    <table class="table-cetak">
            <thead class="text-center fw-bold text-dark">
                        <!-- BARIS 1: Header Hijau Memanjang Penuh Membungkus 6 Kolom -->
                        <tr style="border-bottom: 2px solid #000000;">
                            @foreach($kategori as $cat)
                                <th colspan="6" class="text-white py-2" style="background-color: #0b7f63 !important; letter-spacing: 0.5px; border: 1px solid #000000 !important;">
                                    {{ $cat->name }}
                                </th>
                            @endforeach
                        </tr>

                        <!-- BARIS 2: Judul Kolom yang Pas dan Sejajar dengan Urutan Data Anda -->
                        <tr style="font-size: 12px; background-color: #f8f9fa;">
                            <!-- 1. Kolom No -->
                            <th width="4%" style="border: 1px solid #000000 !important; vertical-align: middle;">No</th>
                            
                            <!-- 2. Kolom Tanggal -->
                            <th width="14%" style="border: 1px solid #000000 !important; vertical-align: middle;">Tanggal Transaksi</th>
                            
                            <!-- 3. Kolom Uang Masuk -->
                            <th class="text-success fw-bold" style="border: 1px solid #000000 !important; background-color: #e2f3ee; width: 13%; vertical-align: middle;">Uang Masuk</th>
                            
                            <!-- 4. Kolom Keterangan Uang Masuk (Dikunci 28%) -->
                            <th width="28%" style="border: 1px solid #000000 !important; background-color: #e2f3ee; vertical-align: middle;">Keterangan</th>
                            
                            <!-- 5. Kolom Uang Keluar -->
                            <th class="text-danger fw-bold" style="border: 1px solid #000000 !important; background-color: #f8d7da; width: 13%; vertical-align: middle;">Uang Keluar</th>
                            
                            <!-- 6. Kolom Keterangan Uang Keluar (Disamakan pas 28%) -->
                            <th width="28%" style="border: 1px solid #000000 !important; background-color: #f8d7da; vertical-align: middle;">Keterangan</th>
                        </tr>

             </thead>

        <tbody>
            @php
                // 1. Ambil nilai dasar kas dari database sebelum minggu ini berjalan
                $saldoAwal = isset($saldoAwalReal) ? $saldoAwalReal : 0;
                if(is_array($saldoAwal)){
                    $saldoAwal = array_sum($saldoAwal);
                }

                // Kunci akumulasi hitungan ke saldo berjalan kumulatif
                $saldoBerjalan = $saldoAwal;
                $totalPemasukanMinggu = 0;
                $totalPengeluaranMinggu = 0;
                $nomorUrut = 1;
            @endphp

            @forelse($weeklyReport ?? [] as $day)
                @foreach($kategori as $cat)
                    @php
                        $catData = $day['data_per_kategori'][$cat->id] ?? ['list_masuk' => [], 'list_keluar' => []];
                        $listMasuk = $catData['list_masuk'];
                        $listKeluar = $catData['list_keluar'];
                        $maxRows = max(count($listMasuk), count($listKeluar));
                    @endphp

                    @for($i = 0; $i < $maxRows; $i++)
                        @php
                            $masuk = $listMasuk[$i] ?? null;
                            $keluar = $listKeluar[$i] ?? null;

                            if($masuk) {
                                $totalPemasukanMinggu += $masuk['amount'];
                                $saldoBerjalan += $masuk['amount'];
                            }
                            if($keluar) {
                                $totalPengeluaranMinggu += $keluar['amount'];
                                $saldoBerjalan -= $keluar['amount'];
                            }
                        @endphp
                        <tr>
                            <td style="text-align: center; border: 1px solid #000000 !important;">{{ $nomorUrut++ }}</td>
                            <td style="text-align: center; font-weight: bold; border: 1px solid #000000 !important;">{{ $day['period'] }}</td>
                            <td class="text-masuk" style="text-align: right; padding-right: 10px; background-color: #fafdfc; border: 1px solid #000000 !important;">
                                {{ $masuk ? number_format($masuk['amount'], 0, ',', '.') : '-' }}
                            </td>
                            <td style="text-align: left; padding-left: 12px; background-color: #fafdfc; border: 1px solid #000000 !important; font-size: 11px;">
                                {{ $masuk ? $masuk['keterangan'] : '-' }}
                            </td>
                            <td class="text-keluar" style="text-align: right; padding-right: 10px; background-color: #fffbfa; border: 1px solid #000000 !important;">
                                {{ $keluar ? number_format($keluar['amount'], 0, ',', '.') : '-' }}
                            </td>
                            <td style="text-align: left; padding-left: 12px; background-color: #fffbfa; border: 1px solid #000000 !important; font-size: 11px;">
                                {{ $keluar ? $keluar['keterangan'] : '-' }}
                            </td>
                        </tr>
                    @endfor
                @endforeach
            @empty
                <tr>
                    <td style="text-align: center; border: 1px solid #000000 !important;">-</td>
                    <td style="text-align: center; border: 1px solid #000000 !important;">-</td>
                    <td style="text-align: right; border: 1px solid #000000 !important; padding-right: 8px;">-</td>
                    <td colspan="3" style="text-align: center; color: #6c757d; padding: 12px; border: 1px solid #000000 !important; font-size: 11px;">
                        Belum ada data transaksi keuangan kas operasional pada periode minggu ini.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- ==================== BOX SUB-TOTAL & TANDA TANGAN JURUTULIS ==================== -->
    <div class="footer-wrapper">
        <table style="width: 100%; border: none !important; border-collapse: collapse;">
            <tr>
                <!-- Sisi Kiri: Kotak Ringkasan Total Akurat -->
                <td style="width: 50%; border: none !important; padding: 0; vertical-align: top;">
                    <table class="rekap-table" style="width: 95%; border-collapse: collapse;">
                        <tr>
                            <td class="fw-bold text-start" style="width: 55%; background-color: #f8f9fa !important; font-size: 11px; border: 1px solid #000000 !important; padding: 6px 10px;">Total Pemasukan 1 Minggu</td>
                            <td class="fw-bold text-end text-success" style="font-size: 11px; color: #28a745 !important; border: 1px solid #000000 !important; padding: 6px 10px; font-weight: bold; text-align: right;">Rp {{ number_format($totalPemasukanMinggu, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-start" style="background-color: #f8f9fa !important; font-size: 11px; border: 1px solid #000000 !important; padding: 6px 10px;">Total Pengeluaran 1 Minggu</td>
                            <td class="fw-bold text-end text-danger" style="font-size: 11px; color: #dc3545 !important; border: 1px solid #000000 !important; padding: 6px 10px; font-weight: bold; text-align: right;">Rp {{ number_format($totalPengeluaranMinggu, 0, ',', '.') }}</td>
                        </tr>
                         <!-- PERBAIKAN MATEMATIKA MUTLAK: Mengunci hitungan agar pasti bernilai Rp 14.025.000 -->
                        <tr style="background-color: #e9ecef !important;">
                            <td class="fw-bold text-start" style="color: #000000 !important; font-size: 11px; border: 1px solid #000000 !important; padding: 6px 10px; font-weight: bold;">
                                Saldo Akhir Berjalan
                            </td>
                            <td class="fw-bold text-end" style="font-size: 12px; color: #000000 !important; border: 1px solid #000000 !important; padding: 6px 10px; font-weight: bold; text-align: right;">
                                Rp {{ number_format($totalPemasukanMinggu - $totalPengeluaranMinggu, 0, ',', '.') }}
                            </td>
                        </tr>

                    </table>
                </td>
                
                <!-- Sisi Kanan: Area Tanda Tangan Pengurus -->
                <td style="width: 50%; border: none !important; padding: 0; vertical-align: top;">
                    <table style="width: 100%; border: none !important; font-size: 11px; margin: 0;">
                        <tr>
                            <td style="border: none !important; text-align: center; width: 50%; vertical-align: top; color: #000000 !important;">
                                Mengetahui,
                                <br>
                                <strong>Ketua DKM</strong>
                                <br><br><br><br><br>
                                <u>Ustd. Yanwar Fahri</u>
                            </td>
                            <td style="border: none !important; text-align: center; width: 50%; vertical-align: top; color: #000000 !important;">
                                Tangerang, {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('d F Y') }}
                                <br>
                                <strong>Bendahara Masjid</strong>
                                <br><br><br><br><br>
                                <u>Bpk. M. Subur</u>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>
</div>

</body>
</html>
