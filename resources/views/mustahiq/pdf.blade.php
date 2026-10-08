<!DOCTYPE html>
<html>
<head>
    <title>Cetak Data Mustahiq</title>
    <style>
        @page { size: a4 landscape; margin: 15px; }
        body { font-family: sans-serif; font-size: 11px; }
        
        /* Gaya untuk Header Logo dan Judul */
        .header-table { width: 100%; border-collapse: collapse; border: none; margin-bottom: 20px; }
        .header-table td { border: none; padding: 0; vertical-align: middle; }
        .logo-container { width: 10%; text-align: left; }
        .title-container { width: 90%; text-align: center; padding-right: 10%; } /* padding kanan agar teks judul benar-benar di tengah */
        .logo-img { height: 60px; width: auto; } 
        .title-text { font-size: 16px; font-weight: bold; margin: 0; text-transform: uppercase; letter-spacing: 0.5px; }
        
        /* Gaya untuk Tabel Data Utama */
        .data-table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        .data-table th, .data-table td { border: 1px solid #000; padding: 5px; text-align: left; }
        .data-table th { background-color: #f2f2f2; font-weight: bold; text-transform: uppercase; font-size: 10px; }
        .text-center { text-align: center; }
    </style>
</head>
<body>

    <!-- Bagian Header (Logo di Kiri Atas, Judul di Tengah) -->
    <table class="header-table">
        <tr>
            <td class="logo-container">
                @php
                    // Ambil path gambar logo jepg Anda
                    $path = public_path('templateAdmin/dist/assets/images/logo2.jpg');
                    
                    // Cek proteksi jika file fisik ada, ubah ke base64 agar 100% tembus sensor DOMPDF
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
                    <!-- Fallback teks jika path gambar salah ketik -->
                    <span style="font-size: 9px; color: red;">Logo Tidak Ditemukan</span>
                @endif
            </td>

            <td class="title-container">
                <!-- Disesuaikan judul teksnya menjadi Data Mustahiq -->
                <h1 class="title-text">Data Mustahiq Masjid Jami' Baitul Makmur</h1>
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
                <th>Nama Mustahiq</th>
                <th>Umur</th>
                <th>Jenis Kelamin</th>
                <th>Bagian Rt</th>
                <th>Alamat Lainnya</th>
                <th>Alamat Sekarang</th>
                <th>Kriteria</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($mustahiqs as $index => $item)
                <tr>
                    <td class="text-center"> {{ $index + 1 }} </td>
                    <td> {{ $item->nama_mustahiq }} </td>
                    <td> {{ $item->umur }} Thn </td>
                    <td> {{ $item->jenis_kelamin }} </td>
                    <td> {{ $item->bagian?->nama_bagian ?? '-' }} </td>
                    <td> {{ $item->alamat_lainnya ?? '-' }} </td>
                    <td> {{ $item->alamat_sekarang }} </td>
                    <td> {{ $item->ktrmustahiqs?->nama_ktrmustahik ?? '-' }} </td>
                </tr> <!-- PERBAIKAN: Menambahkan tag penutup baris yang hilang -->
            @empty
                <tr>
                    <td colspan="8" class="text-center">Data Mustahiq masih kosong.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>
