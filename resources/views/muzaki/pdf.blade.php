<!DOCTYPE html>
<html>
<head>
    <title>Cetak Data Muzaki</title>
    <style>
        @page { size: a4 landscape; margin: 15px; }
        body { font-family: sans-serif; font-size: 11px; }
        
        /* Gaya untuk Header Logo dan Judul */
        .header-table { width: 100%; border-collapse: collapse; border: none; margin-bottom: 20px; }
        .header-table td { border: none; padding: 0; vertical-align: middle; }
        .logo-container { width: 10%; text-align: left; }
        .title-container { width: 90%; text-align: center; padding-right: 10%; } 
        .logo-img { height: 60px; width: auto; } 
        .title-text { font-size: 16px; font-weight: bold; margin: 0; text-transform: uppercase; letter-spacing: 0.5px; }
        
        /* Gaya untuk Tabel Data Utama */
        .data-table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        .data-table th, .data-table td { border: 1px solid #000; padding: 5px; text-align: left; }
        .data-table th { background-color: #f2f2f2; font-weight: bold; text-transform: uppercase; font-size: 10px; }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
    </style>
</head>
<body>

    <!-- Bagian Header -->
    <table class="header-table">
        <tr>
            <td class="logo-container">
                @php
                    $path = public_path('templateAdmin/dist/assets/images/logo2.jpg');
                    if (file_exists($path)) {
                        $data = file_get_contents($path);
                        $base64 = 'data:image/jpeg;base64,' . base64_encode($data);
                    } else {
                        $base64 = '';
                    }
                @endphp
                
                @if($base64 != '')
                    <img src="{{ $base64 }}" class="logo-img" alt="Logo">
                @else
                    <span style="font-size: 9px; color: red;">Logo Tidak Ditemukan</span>
                @endif
            </td>

            <td class="title-container">
                <h1 class="title-text">Data Muzaki Masjid Jami' Baitul Makmur</h1>
                <div style="font-size: 11px; margin-top: 3px; color: #555;">Aplikasi Manajemen BaitulApp</div>
                <div style="font-size: 9px; color: #888; margin-top: 2px;">Tanggal Cetak: {{ date('d M Y H:i') }} WIB</div>
            </td>
        </tr>
    </table>

    <!-- Tabel Data Utama -->
    <table class="data-table">
        <thead>
            <tr>
                <th class="text-center" width="4%">No</th>
                <th>Nama Muzaki</th>
                <th>Umur</th>
                <th>Jenis Kelamin</th>
                <th>Bagian Rt</th>
                <th>Alamat Lainnya</th>
                <th>Alamat (Sekarang)</th>
                <th>Kriteria Amal</th>
                <th class="text-right">Nominal</th>
            </tr>
        </thead>
        <tbody>
            @php $totalNominal = 0; @endphp
            @forelse ($muzakis as $index => $item)
                @php $totalNominal += ($item->nominal ?? 0); @endphp
                <tr>
                    <td class="text-center"> {{ $index + 1 }} </td>
                    <td> {{ $item->nama_muzaki }} </td>
                    <td> {{ $item->umur }} Thn </td>
                    <td> {{ $item->jenis_kelamin }} </td>
                    <td> {{ $item->bagian?->nama_bagian ?? '-' }} </td>
                    <td> {{ $item->alamat_lainnya ?? '-' }} </td>
                    <!-- ✨ PERBAIKAN: Menggunakan properti database asli yang benar -->
                    <td> {{ $item->alamat ?? '-' }} </td>
                    <td> {{ $item->jenis_amal?->nama_amal ?? '-' }} </td>
                    <td class="text-right"> 
                        Rp {{ $item->nominal ? number_format($item->nominal, 0, ',', '.') : '0' }} 
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center">Data Muzaki masih kosong.</td>
                </tr>
            @endforelse
            
            @if($muzakis->count() > 0)
                <tr style="font-weight: bold; background-color: #f2f2f2;">
                    <td colspan="8" style="text-align: right; padding: 6px;">TOTAL PENERIMAAN:</td>
                    <td class="text-right">Rp {{ number_format($totalNominal, 0, ',', '.') }}</td>
                </tr>
            @endif
        </tbody>
    </table>

</body>
</html>
