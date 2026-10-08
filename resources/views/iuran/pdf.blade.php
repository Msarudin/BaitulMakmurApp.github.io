<!DOCTYPE html>
<html>
<head>
    <title>Laporan Iuran Bulanan Warga</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; color: #333; }
        .header { text-align: center; margin-bottom: 20px; }
        .header h2 { margin: 0; padding: 0; }
        .header p { margin: 5px 0 0 0; color: #666; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #444; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; font-weight: bold; }
        .text-end { text-align: right; }
        .text-center { text-align: center; }
        .fw-bold { font-weight: bold; }
        .text-success { color: #0b7f63; }
        .footer-summary { background-color: #f9f9f9; font-weight: bold; }
    </style>
</head>
<body>

    <div class="header">
        <h2>Laporan Iuran Bulanan Warga</h2>
        <p>Bagian: <strong>{{ $rt ?? 'Semua RT' }}</strong></p>
    </div>

    <table>
        <thead>
            <tr>
                <th width="5%" class="text-center">No</th>
                <th>Tanggal Bayar</th>
                <th>Nama Warga (Jamaah)</th>
                <th>Bagian Rt</th>
                <th>Periode Iuran</th>
                <th class="text-end">Nominal</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($iuranWarga as $index => $item)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ \Carbon\Carbon::parse($item->tanggal_bayar)->locale('id')->translatedFormat('d F Y') }}</td>
                <td class="fw-bold">{{ $item->jamaah?->nama_jamaah ?? 'Data Jamaah Kosong' }}</td>
                <td>{{ $item->jamaah?->bagian?->nama_bagian ? str_replace('_', ' ', $item->jamaah->bagian->nama_bagian) : '-' }}</td>
                <td>{{ $item->bulan_iuran }} {{ $item->tahun_iuran }}</td>
                <td class="text-end fw-bold text-success">Rp {{ number_format($item->nominal, 0, ',', '.') }}</td>
                <td>{{ $item->keterangan ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr class="footer-summary">
                <td colspan="3" class="text-end">Ringkasan Terfilter:</td>
                <td colspan="2">{{ $totalWarga }} Orang</td>
                <td class="text-end text-success">Rp {{ number_format($totalNominal, 0, ',', '.') }}</td>
                <td></td>
            </tr>
        </tfoot>
    </table>

</body>
</html>
