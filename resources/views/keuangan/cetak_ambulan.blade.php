<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Buku Kas Ambulan - Cetak Arsip</title>
    <style>
        @page {
            size: A4 landscape;
            margin: 6mm 8mm 6mm 8mm;
        }
        body {
            background-color: #ffffff;
            font-family: Arial, sans-serif;
            color: #000000;
            font-size: 10.5px;
            margin: 0;
            padding: 0;
            line-height: 1.2;
        }
        * {
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
            color-adjust: exact !important;
            box-sizing: border-box;
        }
        .container-cetak {
            width: 100%;
            max-width: 100%;
            margin: 0 auto;
        }
        .kop-table {
            width: 100%;
            border-collapse: collapse;
            border-bottom: 4px double #000000;
            margin-bottom: 8px;
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
            margin-top: 5px;
            table-layout: fixed;
        }
        .table-cetak th, .table-cetak td {
            border: 1px solid #000000 !important;
            padding: 6px 5px !important;
            vertical-align: middle;
            font-size: 10.5px;
            word-wrap: break-word;
        }
        .table-cetak thead th {
            font-weight: bold;
            text-align: center;
        }
        .text-masuk { color: #28a745 !important; font-weight: bold; }
        .text-keluar { color: #dc3545 !important; font-weight: bold; }
        
        tr { page-break-inside: avoid !important; } 
        
        .footer-wrapper { 
            margin-top: 15px; 
            width: 100%; 
            page-break-inside: avoid !important;
        }
        .rekap-table { width: 100%; border-collapse: collapse; }
        .rekap-table td { border: 1px solid #000000 !important; padding: 6px 8px !important; }
    </style>
</head>
<body onload="window.print()">

<div class="container-cetak">
    <!-- ==================== KOP SURAT RESMI MASJID ==================== -->
    <table class="kop-table">
        <tr>
            <td class="kop-logo">
                <img src="{{ asset('templateAdmin/dist/assets/images/logo2.jpg') }}" alt="Logo DKM" style="width: 70px; height: auto;">
            </td>
            <td class="kop-text">
                <h5 style="font-family: 'Times New Roman'; font-weight: bold; text-transform: uppercase; margin: 0; font-size: 13px; letter-spacing: 0.5px;">Dewan Kemakmuran Masjid (DKM)</h5>
                <h1 style="font-family: 'Times New Roman'; font-weight: bold; color: #0b7f63; margin: 1px 0; font-size: 22px;">MASJID JAMI' BAITUL MAKMUR</h1>
                <p style="font-size: 10.5px; font-weight: bold; margin: 0;">KP. BOJONG RT 03 RW 15 KEL. KUNCIRAN INDAH KEC. PINANG</p>
                <p style="font-size: 10.5px; font-weight: bold; margin: 1px 0;">KOTA TANGERANG</p>
                <p style="color: #6c757d; font-size: 9.5px; margin: 0;">Email: JBaitulMakmur@gmail.com &nbsp;&bull;&nbsp; FB: Jami Baitul Makmur</p>
            </td>
        </tr>
    </table>

    <!-- TITLE LAPORAN -->
    <h4 style="text-align: center; font-weight: bold; margin: 4px 0 2px 0; font-size: 12px; text-transform: uppercase;">
        Laporan Buku Kas Ambulan
    </h4>
    <p style="text-align: center; color: #333; margin: 0 0 8px 0; font-size: 10.5px; font-weight: bold;">
        Periode: {{ \Carbon\Carbon::parse($jumatLalu)->locale('id')->translatedFormat('d M Y') }} s/d {{ \Carbon\Carbon::parse($jumatMendatang)->locale('id')->translatedFormat('d M Y') }}
    </p>

    <!-- ==================== TABEL DATA ==================== -->
    <table class="table-cetak">
        <thead class="text-center fw-bold text-dark">
            <tr style="border-bottom: 2px solid #000000;">
                <th colspan="6" class="text-white py-1.5" style="background-color: #0b7f63 !important; border: 1px solid #000000 !important; text-transform: uppercase; font-size: 11px;">KAS AMBULAN</th>
            </tr>
            <tr style="font-size: 11px; background-color: #f8f9fa;">
                <th width="4%">No</th>
                <th width="14%">Tanggal Transaksi</th>
                <th class="text-success fw-bold" style="background-color: #e2f3ee; width: 13%;">Uang Masuk</th>
                <th width="28%" style="background-color: #e2f3ee;">Keterangan</th>
                <th class="text-danger fw-bold" style="background-color: #f8d7da; width: 13%;">Uang Keluar</th>
                <th width="28%" style="background-color: #f8d7da;">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @php
                $saldoAwalNominal = $saldoAwalReal ?? 0;
                $totalPemasukanMinggu = 0;
                $totalPengeluaranMinggu = 0;
                $nomorUrut = 1;
                $adaTransaksi = false;
            @endphp
                        @foreach($weeklyReport ?? [] as $day)
                @php
                    $listMasuk = $day['list_masuk'] ?? [];
                    $listKeluar = $day['list_keluar'] ?? [];
                    $maxRows = max(count($listMasuk), count($listKeluar));
                @endphp

                @if($maxRows > 0)
                    @php $adaTransaksi = true; @endphp
                    @for($i = 0; $i < $maxRows; $i++)
                        @php
                            $masuk = $listMasuk[$i] ?? null;
                            $keluar = $listKeluar[$i] ?? null;

                            if($masuk) { $totalPemasukanMinggu += $masuk['amount']; }
                            if($keluar) { $totalPengeluaranMinggu += $keluar['amount']; }
                        @endphp
                        <tr>
                            <!-- 1. Nomor Urut Sekuensial -->
                            <td style="text-align: center;">{{ $nomorUrut++ }}</td>

                            <!-- 2. Kolom Tanggal -->
                            <td style="text-align: center; font-weight: bold;">
                                {{ $i == 0 ? $day['period'] : '' }}
                            </td>
                            
                            <!-- 3. Uang Masuk -->
                            <td class="text-masuk" style="text-align: right; background-color: #fafdfc;">
                                {{ $masuk ? number_format($masuk['amount'], 0, ',', '.') : '-' }}
                            </td>
                            
                            <!-- 4. Keterangan Masuk -->
                            <td style="text-align: left; background-color: #fafdfc;">
                                {{ $masuk ? $masuk['keterangan'] : '-' }}
                            </td>
                            
                            <!-- 5. Uang Keluar -->
                            <td class="text-keluar" style="text-align: right; background-color: #fffbfa;">
                                {{ $keluar ? number_format($keluar['amount'], 0, ',', '.') : '-' }}
                            </td>
                            
                            <!-- 6. Keterangan Keluar -->
                            <td style="text-align: left; background-color: #fffbfa;">
                                {{ $keluar ? $keluar['keterangan'] : '-' }}
                            </td>
                        </tr>
                    @endfor
                @endif
            @endforeach

            @if(!$adaTransaksi)
                <tr>
                    <td style="text-align: center;">-</td>
                    <td style="text-align: center;">-</td>
                    <td style="text-align: right;">-</td>
                    <td colspan="3" style="text-align: center; color: #6c757d; padding: 10px;">Belum ada mutasi transaksi pada periode minggu ini.</td>
                </tr>
            @endif
        </tbody>
    </table>

    <!-- ==================== BOX SUMMARY FOOTER & TANDA TANGAN (KEMBAR IDENTIK DENGAN OPERASIONAL) ==================== -->
    <div class="footer-wrapper">
        <table style="width: 100%; border: none !important; border-collapse: collapse;">
            <tr>
                <!-- Sisi Kiri: Rekap Total Tanpa Baris Saldo Awal, Rumus Akurat Sesuai Kas Operasional -->
                <td style="width: 45%; border: none !important; padding: 0; vertical-align: top;">
                    <table class="rekap-table" style="width: 100%; border-collapse: collapse;">
                        <tr>
                            <td class="fw-bold text-start" style="width: 55%; background-color: #f8f9fa !important;">Total Pemasukan 1 Minggu</td>
                            <td class="fw-bold text-end text-success" style="color: #28a745 !important; text-align: right;">Rp {{ number_format($totalPemasukanMinggu, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-start" style="background-color: #f8f9fa !important;">Total Pengeluaran 1 Minggu</td>
                            <td class="fw-bold text-end text-danger" style="color: #dc3545 !important; text-align: right;">Rp {{ number_format($totalPengeluaranMinggu, 0, ',', '.') }}</td>
                        </tr>
                        <tr style="background-color: #e9ecef !important;">
                            <td class="fw-bold text-start" style="color: #000000 !important; font-weight: bold;">Saldo Akhir Berjalan</td>
                            <td class="fw-bold text-end" style="color: #000000 !important; font-weight: bold; text-align: right;">
                                Rp {{ number_format($saldoAwalNominal + $totalPemasukanMinggu - $totalPengeluaranMinggu, 0, ',', '.') }}
                            </td>
                        </tr>
                    </table>
                </td>
                
                <!-- Spacer Tengah -->
                <td style="width: 5%; border: none !important;"></td>
                
                <!-- Sisi Kanan: Tanda Tangan Pengurus -->
                <td style="width: 50%; border: none !important; padding: 0; vertical-align: top;">
                    <table style="width: 100%; border: none !important; margin: 0;">
                        <tr>
                            <td style="border: none !important; text-align: center; width: 50%; vertical-align: top; padding-top: 5px;">
                                Mengetahui,<br>
                                <strong>Ketua DKM Masjid</strong><br><br><br><br>
                                <u>Ustd. Yanwar Fahri</u>
                            </td>
                            <td style="border: none !important; text-align: center; width: 50%; vertical-align: top;">
                                Tangerang, {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('d F Y') }}<br>
                                <strong>Bendahara</strong><br><br><br><br>
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

