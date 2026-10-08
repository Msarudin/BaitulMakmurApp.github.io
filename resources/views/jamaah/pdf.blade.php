<!DOCTYPE html>
<html>
<head>
    <title>Cetak Data Jamaah</title>
    <style>
        @page { size: a4 landscape; margin: 15px; }
        body { font-family: sans-serif; font-size: 11px; }
        
        /* Gaya untuk Header Logo dan Judul */
        .header-table { width: 100%; border-collapse: collapse; border: none; margin-bottom: 20px; }
        .header-table td { border: none; padding: 0; vertical-align: middle; }
        .logo-container { width: 10%; text-align: left; }
        .title-container { width: 90%; text-align: center; }
        .logo-img { height: 60px; width: auto; } /* Atur tinggi logo di sini */
        .title-text { font-size: 16px; font-weight: bold; margin: 0; text-transform: uppercase; letter-spacing: 0.5px; }
        
        /* Gaya untuk Tabel Data Utama */
        .data-table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        .data-table th, .data-table td { border: 1px solid #000; padding: 5px; text-align: left; }
        .data-table th { background-color: #f2f2f2; font-weight: bold; }
    </style>
</head>
<body>

    <!-- Bagian Header (Logo di Kiri Atas, Judul di Tengah) -->
    <table class="header-table">
        <tr>
            <td class="logo-container">
                <!-- Menggunakan format JPG untuk menghindari pembatasan library GD DomPDF -->
                <img src="{{ public_path('templateAdmin/dist/assets/images/logo2.jpg') }}" class="logo-img" alt="Logo">
            </td>

            <td class="title-container">
                <h1 class="title-text">Data Jamaah Masjid Jami' Baitul Makmur</h1>
                <div style="font-size: 11px; margin-top: 3px; color: #555;">Aplikasi Manajemen BaitulApp</div>
            </td>
        </tr>
    </table>

    <!-- Tabel Data Utama -->
    <table class="data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Jamaah</th>
                <th>Email</th>
                <th>NIK</th>
                <th>No KK</th>
                <th>No Tlp</th>
                <th>Umur</th>
                <th>Tempat, Tanggal Lahir</th>
                <th>Jenis Kelamin</th>
                <th>Alamat Sekarang</th>
                <th>Alamat Asal</th>
                <th>RT</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jamaah as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->nama_jamaah }}</td>
                <td>{{ $item->email }}</td>
                <td>{{ $item->nik }}</td>
                <td>{{ $item->no_kk }}</td>
                <td>{{ $item->no_tlp }}</td>
                <td>{{ $item->umur }}</td>
                <td>{{ $item->tempat_lahir }}, {{ $item->tanggal_lahir }}</td>
                <td>{{ $item->jenis_kelamin }}</td>
                <td>{{ $item->alamat_sekarang }}</td>
                <td>{{ $item->alamat_asal }}</td>
                <td>{{ $item->bagian->nama_bagian  ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
