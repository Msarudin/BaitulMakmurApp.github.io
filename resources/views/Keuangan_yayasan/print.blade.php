<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Laporan Rekapitulasi Kas - Yayasan Baitul Makmur</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #000000;
            background-color: #ffffff;
            margin: 0;
            padding: 0;
            font-size: 13px;
        }
        
        /* Pengaturan Halaman Cetak */
        @page {
            size: A4 landscape;
            margin: 15mm 15mm 15mm 15mm;
        }

        .container {
            width: 100%;
            margin: 0 auto;
        }

        /* KOP SURAT */
        .kop-surat {
            display: flex;
            align-items: center;
            justify-content: center;
            border-bottom: 4px solid #000000;
            padding-bottom: 10px;
            margin-bottom: 25px;
            position: relative;
        }
        .kop-logo {
            position: absolute;
            start: 0;
            left: 0;
            top: 5px;
        }
        .kop-logo img {
            width: 85px;
            height: auto;
        }
        .kop-text {
            text-center: center;
            width: 100%;
            text-align: center;
        }
        .kop-text h4 {
            margin: 0;
            text-transform: uppercase;
            font-family: 'Times New Roman', Times, serif;
            font-size: 16px;
            letter-spacing: 0.5px;
            font-weight: bold;
        }
        .kop-text h1 {
            margin: 5px 0;
            font-family: 'Times New Roman', Times, serif;
            font-size: 28px;
            font-weight: bold;
        }
        .kop-text p {
            margin: 2px 0;
            font-weight: bold;
            font-size: 12px;
        }
        .kop-text .email {
            font-weight: normal;
            color: #555555;
            font-size: 11px;
        }

        /* TABEL UTAMA */
        .table-utama {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 25px;
        }
        .table-utama th, .table-utama td {
            border: 1px solid #000000;
            padding: 10px 8px;
            text-align: center;
            vertical-align: middle;
        }
        .table-utama th {
            background-color: #e9ecef;
            font-weight: bold;
        }
        .text-start { text-align: left !important; }
        .text-end { text-align: right !important; }
        .text-success { color: #28a745; font-weight: 600; }
        .text-danger { color: #dc3545; font-weight: 600; }
        .fw-bold { font-weight: bold; }

        /* AREA BAWAH: REKAP & TANDA TANGAN */
        .flex-container {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            width: 100%;
        }

        /* Kotak Rekap Ringkasan Kas */
        .rekap-box {
            width: 43%;
            border-collapse: collapse;
        }
        .rekap-box td {
            border: 1px solid #000000;
            padding: 8px 10px;
        }
        .bg-light {
            background-color: #f8f9fa;
        }
        .bg-total {
            background-color: #e9ecef;
        }

        /* Area Tanda Tangan */
        .ttd-area {
            width: 52%;
        }
        .ttd-table {
            width: 100%;
            border: none;
        }
        .ttd-table td {
            border: none;
            text-align: center;
            vertical-align: top;
        }

        /* Otomatis memicu cetak saat halaman dimuat */
        @media print {
            * {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
        }
    </style>
</head>
<body onload="window.print(); window.onafterprint = function(){ window.close(); }">

<div class="container">
    <!-- KOP SURAT -->
    <div class="kop-surat">
        <div class="kop-logo">
            <img src="{{ asset('templateAdmin/dist/assets/images/logo2.jpg') }}" alt="Logo">
        </div>
        <div class="kop-text">
            <h4>Laporan Rekapitulasi Kas</h4>
            <h1>YAYASAN BAITUL MAKMUR</h1>
            <p>KP. BOJONG RT 03 RW 15 KEL. KUNCIRAN INDAH KEC. PINANG</p>
            <p>KOTA TANGERANG</p>
            <p class="email">Email: YBaitulMakmur@gmail.com</p>
        </div>
    </div>
    @php
        $totalMasuk = 0;
        $totalKeluar = 0;
        $saldoBerjalan = 0;
    @endphp

    <!-- TABEL REKAPITULASI KAS -->
    <table class="table-utama">
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 15%;">Tanggal</th>
                <th>Keterangan / Uraian</th>
                <th style="width: 15%;">Pemasukan (Rp)</th>
                <th style="width: 15%;">Pengeluaran (Rp)</th>
                <th style="width: 18%;">Saldo Akhir (Rp)</th>
            </tr>
        </thead>
        <tbody>
            @forelse($keuanganYayasan as $index => $item)
                @php
                    if ($item->jenis === 'masuk') {
                        $totalMasuk += $item->nominal;
                        $saldoBerjalan += $item->nominal;
                    } else {
                        $totalKeluar += $item->nominal;
                        $saldoBerjalan -= $item->nominal;
                    }
                @endphp
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td class="fw-bold">{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</td>
                    <td class="text-start">{{ $item->keterangan }}</td>
                    <td class="text-end text-success">
                        {{ $item->jenis === 'masuk' ? number_format($item->nominal, 0, ',', '.') : '-' }}
                    </td>
                    <td class="text-end text-danger">
                        {{ $item->jenis === 'keluar' ? number_format($item->nominal, 0, ',', '.') : '-' }}
                    </td>
                    <td class="text-end fw-bold" style="background-color: #f8f9fa;">
                        {{ number_format($saldoBerjalan, 0, ',', '.') }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center; color: #666666; padding: 20px;">
                        Belum ada data transaksi keuangan kas operasional yayasan.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- AREA BAWAH -->
    <div class="flex-container">
        <!-- Kotak Ringkasan Kas -->
        <table class="rekap-box">
            <tr>
                <td class="fw-bold bg-light text-start" style="width: 55%;">Total Pemasukan Kas</td>
                <td class="fw-bold text-end text-success">Rp {{ number_format($totalMasuk, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td class="fw-bold bg-light text-start">Total Pengeluaran Kas</td>
                <td class="fw-bold text-end text-danger">Rp {{ number_format($totalKeluar, 0, ',', '.') }}</td>
            </tr>
            <tr class="bg-total">
                <td class="fw-bold text-start">Saldo Akhir Operasional</td>
                <td class="fw-bold text-end" style="font-size: 14px;">Rp {{ number_format($saldoBerjalan, 0, ',', '.') }}</td>
            </tr>
        </table>

        <!-- Ruang Tanda Tangan -->
        <div class="ttd-area">
            <table class="ttd-table">
                <tr>
                    <td style="width: 50%;"></td>
                    <td style="width: 50%; padding-bottom: 8px; font-weight: 500;">
                        Tangerang, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}
                    </td>
                </tr>
                <tr>
                    <td class="fw-bold">Bendahara Yayasan</td>
                    <td class="fw-bold">Ketua Umum Yayasan</td>
                </tr>
                <tr>
                    <td style="height: 70px;"></td>
                    <td style="height: 70px;"></td>
                </tr>
                <tr>
                    <td class="fw-bold" style="text-decoration: underline;">(....................................)</td>
                    <td class="fw-bold" style="text-decoration: underline;">(....................................)</td>
                </tr>
            </table>
        </div>
    </div>
</div>

</body>
</html>
