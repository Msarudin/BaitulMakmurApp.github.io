@extends('layouts.indexAdmin')

@section('content')
    <div class="">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">Laporan Iuran Bulanan Warga</h4>
                <div class="d-flex gap-2 align-items-center">
                    <a href="{{ route('iuran-warga.export-excel') }}" id="btn_excel_link" class="btn btn-outline-success btn-sm fw-bold">
                        <i class="fas fa-file-excel me-1"></i> Excel
                    </a>
                    
                    <!-- Tombol Link PDF -->
                    <a href="{{ route('iuran-warga.export-pdf') }}" id="btn_pdf_link" class="btn btn-outline-danger btn-sm fw-bold">
                        <i class="fas fa-file-pdf me-1"></i> PDF
                    </a>
                    <a href="{{ route('iuran-warga.create') }}" class="btn btn-success btn-sm" style="background-color: #0b7f63 !important; border-color: #0b7f63 !important;">
                        Tambah Data
                    </a>
                </div>
            </div>

            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <!-- BARIS FILTER UTAMA: Sejajar Rapi Horizontal -->
                <div class="d-flex flex-wrap align-items-center gap-3 mb-4">
                    
                    <!-- Filter Dropdown RT -->
                    <div class="d-flex align-items-center gap-2">
                        <label class="fw-bold mb-0 text-nowrap" style="font-size: 13px; color: #333;">Pilih Bagian RT:</label>
                        <select id="pilih_rt_murni" class="fw-bold px-3" style="border: 2px solid #000; min-width: 50px; background: #fff; font-size: 14px; height: 32px; display: flex; align-items: center; justify-content: center;">
                            <option value="">Semua RT</option>
                            <option value="RT 01">RT 01</option>
                            <option value="RT 02">RT 02</option>
                            <option value="RT 03">RT 03</option>
                            <option value="RT 04">RT 04</option>
                            <option value="RT 05">RT 05</option>
                        </select>
                    </div>

                    <!-- Kotak Jumlah Warga -->
                    <div class="d-flex align-items-center gap-2">
                        <span class="fw-bold text-nowrap" style="font-size: 13px; color: #333;">Jumlah warga per RT:</span>
                        <div id="box_jumlah_warga" class="fw-bold px-3" style="border: 2px solid #000; min-width: 50px; background: #fff; font-size: 14px; height: 32px; display: flex; align-items: center; justify-content: center;">
                            0
                        </div>
                    </div>

                    <!-- Kotak Jumlah Nominal -->
                    <div class="d-flex align-items-center gap-2">
                        <span class="fw-bold text-nowrap" style="font-size: 13px; color: #333;">Jumlah nominal:</span>
                        <div id="box_jumlah_nominal" class="fw-bold px-3" style="border: 2px solid #000; min-width: 120px; background: #fff; font-size: 14px; height: 32px; display: flex; align-items: center; justify-content: center;">
                            Rp 0
                        </div>
                    </div>

                    <!-- Filter Dropdown Bulan -->
                    <div class="d-flex align-items-center gap-2">
                        <label class="fw-bold mb-0 text-nowrap" style="font-size: 13px; color: #333;">Pilih Bulan:</label>
                        <select id="pilih_bulan_murni" class="fw-bold px-3" style="border: 2px solid #000; min-width: 50px; background: #fff; font-size: 14px; height: 32px; display: flex; align-items: center; justify-content: center;">
                            <option value="">Semua Bulan</option>
                            <option value="Januari">Januari</option>
                            <option value="Februari">Februari</option>
                            <option value="Maret">Maret</option>
                            <option value="April">April</option>
                            <option value="Mei">Mei</option>
                            <option value="Juni">Juni</option>
                            <option value="Juli">Juli</option>
                            <option value="Agustus">Agustus</option>
                            <option value="September">September</option>
                            <option value="Oktober">Oktober</option>
                            <option value="November">November</option>
                            <option value="Desember">Desember</option>
                        </select>
                    </div>

                    <!-- TAMBAHAN: Filter Dropdown Tahun -->
                    <div class="d-flex align-items-center gap-2">
                        <label class="fw-bold mb-0 text-nowrap" style="font-size: 13px; color: #333;">Pilih Tahun:</label>
                        <select id="pilih_tahun_murni" class="fw-bold px-3" style="border: 2px solid #000; min-width: 50px; background: #fff; font-size: 14px; height: 32px; display: flex; align-items: center; justify-content: center;">
                            <option value="">Semua</option>
                            <option value="2024">2024</option>
                            <option value="2025">2025</option>
                            <option value="2026">2026</option>
                            <option value="2027">2027</option>
                            <option value="2025">2028</option>
                            <option value="2026">2029</option>
                            <option value="2027">2030</option>
                        </select>
                    </div>

                </div>

                <div class="table-responsive">
                    <table class="table table-bordered" id="myTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal Bayar</th>
                                <th>Nama Warga (Jamaah)</th>
                                <th>Bagian Rt</th>
                                <th>Periode Iuran</th>
                                <th>Nominal (Rp)</th>
                                <th>Keterangan</th>
                                <th class="text-center">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($iuranWarga as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->tanggal_bayar)->locale('id')->translatedFormat('d F Y') }}</td>
                                <td class="fw-bold">{{ $item->jamaah?->nama_jamaah ?? 'Data Jamaah Kosong' }}</td>
                                <td>{{ $item->jamaah?->bagian?->nama_bagian ? str_replace('_', ' ', $item->jamaah->bagian->nama_bagian) : '-' }}</td>
                                <td>{{ $item->bulan_iuran }} {{ $item->tahun_iuran }}</td>
                                <td class="text-end fw-semibold text-success">Rp {{ number_format($item->nominal, 0, ',', '.') }}</td>
                                <td>{{ $item->keterangan ?? '-' }}</td>
                                <td>
                                    <div class="dropdown">
                                        <a class="btn dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            Aksi
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="{{ route('iuran-warga.edit', $item->id) }}">Edit</a></li>
                                            <li>
                                                <button type="button" class="btn dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal{{ $item->id }}">
                                                    Hapus Data
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <!-- TAMBAHKAN TFOOT INI -->
                        <tfoot class="bg-light fw-bold">
                            <tr>
                                <th colspan="3" class="text-end">Ringkasan Terfilter:</th>
                                <th id="foot_jumlah_warga" colspan="2">0 Orang</th>
                                <th id="foot_jumlah_nominal" class="text-end text-success">Rp 0</th>
                                <th colspan="2"></th>
                            </tr>
                        </tfoot>
                    </table>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL CONFIRM DELETE -->
    @foreach ($iuranWarga as $item)
    <div class="modal fade" id="confirmDeleteModal{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Lanjutkan penghapusan data ?</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Data iuran warga akan terhapus secara permanen. Klik <b>Lanjutkan</b> untuk menghapus data.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <form action="{{ route('iuran-warga.destroy', $item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Lanjutkan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    <!-- SCRIPT JAVASCRIPT MURNI UNTUK MENGIKAT FILTER -->
<script>
    window.addEventListener('DOMContentLoaded', (event) => {
        setTimeout(function() {
            var oTable = jQuery('#myTable').DataTable();

            // Elemen dropdown filter
            var dropdownRt = document.getElementById('pilih_rt_murni');
            var dropdownBulan = document.getElementById('pilih_bulan_murni');
            var dropdownTahun = document.getElementById('pilih_tahun_murni');
            
            // Elemen kotak indikator
            var boxWarga = document.getElementById('box_jumlah_warga');
            var boxNominal = document.getElementById('box_jumlah_nominal');
            var footWarga = document.getElementById('foot_jumlah_warga');
            var footNominal = document.getElementById('foot_jumlah_nominal');

            // Elemen tombol link export
            var baseUrlExcel = "{{ route('iuran-warga.export-excel') }}";
            var baseUrlPdf = "{{ route('iuran-warga.export-pdf') }}";
            var btnExcel = document.getElementById('btn_excel_link');
            var btnPdf = document.getElementById('btn_pdf_link');

            // LOGIKA FILTER TRIPLE: Menyaring RT, Bulan, dan Tahun
            jQuery.fn.dataTable.ext.search.push(
                function(settings, data, dataIndex) {
                    var rtDipilih = dropdownRt ? dropdownRt.value : '';
                    var bulanDipilih = dropdownBulan ? dropdownBulan.value : '';
                    var tahunDipilih = dropdownTahun ? dropdownTahun.value : '';
                    
                    // Kolom ke-3 (Bagian Rt), Kolom ke-4 (Periode Iuran: Contoh "September 2026")
                    var textRtTabel = data[3] || '';
                    var textPeriodeTabel = data[4] || '';

                    var cocokRt = (rtDipilih === "" || textRtTabel.toLowerCase().indexOf(rtDipilih.toLowerCase()) !== -1);
                    var cocokBulan = (bulanDipilih === "" || textPeriodeTabel.toLowerCase().indexOf(bulanDipilih.toLowerCase()) !== -1);
                    var cocokTahun = (tahunDipilih === "" || textPeriodeTabel.toLowerCase().indexOf(tahunDipilih.toLowerCase()) !== -1);

                    return cocokRt && cocokBulan && cocokTahun;
                }
            );

            // Fungsi kalkulasi real-time
            function hitungUlangDanTampilkan() {
                oTable.draw(); // Jalankan penyaringan tabel

                var dataAktif = oTable.rows({ filter: 'applied' }).nodes();
                var totalWarga = dataAktif.length;
                var totalUang = 0;

                jQuery(dataAktif).each(function() {
                    // Ambil isi teks kolom Nominal (Rp) pada indeks ke-5
                    var textUang = jQuery(this).find('td').eq(5).text();
                    var angkaMurni = parseInt(textUang.replace(/[^0-9]/g, '')) || 0;
                    totalUang += angkaMurni;
                });

                var formatUang = 'Rp ' + totalUang.toLocaleString('id-ID');

                // Update teks ke kotak atas
                if(boxWarga) boxWarga.innerText = totalWarga;
                if(boxNominal) boxNominal.innerText = formatUang;

                // Update teks ke tfoot tabel
                if(footWarga) footWarga.innerText = totalWarga + " Orang";
                if(footNominal) footNominal.innerText = formatUang;

                // Update URL tombol download dengan menyertakan parameter Tahun
                var vRt = dropdownRt ? dropdownRt.value : '';
                var vBulan = dropdownBulan ? dropdownBulan.value : '';
                var vTahun = dropdownTahun ? dropdownTahun.value : '';
                
                var queryParams = "?rt=" + encodeURIComponent(vRt) + "&bulan=" + encodeURIComponent(vBulan) + "&tahun=" + encodeURIComponent(vTahun);
                if(btnExcel) btnExcel.href = baseUrlExcel + queryParams;
                if(btnPdf) btnPdf.href = baseUrlPdf + queryParams;
            }

            // Jalankan fungsi saat halaman pertama kali dibuka
            hitungUlangDanTampilkan();

            // Pasang pendeteksi perubahan di semua filter
            if (dropdownRt) dropdownRt.addEventListener('change', hitungUlangDanTampilkan);
            if (dropdownBulan) dropdownBulan.addEventListener('change', hitungUlangDanTampilkan);
            if (dropdownTahun) dropdownTahun.addEventListener('change', hitungUlangDanTampilkan);
            
        }, 600);
    });
</script>


@endsection
