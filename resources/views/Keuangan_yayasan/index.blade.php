@extends('layouts.indexAdmin')

@section('content')
<div class="card">
    <div class="container my-5">
        <h2 class="text-center mb-4 fw-bold">Sistem Informasi Keuangan Yayasan</h2>

        @if ($errors->any())
            <div class="alert alert-danger shadow-sm mb-4">
                <h5 class="fw-bold mb-2">Gagal Menyimpan Transaksi:</h5>
                <ul class="mb-0">
                    @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
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
        <div class="card shadow-sm mb-5">
            <div class="card-header text-white text-center fw-bold fs-4" style="background-color: #0b7f63 !important;">
                Tambah Transaksi Kas Baru - Kas Operasional Yayasan
            </div>
            <div class="card-body">
                <form action="{{ route('keuangan-yayasan.store') }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label">Tanggal Transaksi</label>
                            <input type="date" class="form-control" name="tanggal" value="{{ date('Y-m-d') }}" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Jenis Transaksi</label>
                            <select class="form-select" name="jenis" required>
                                <option value="">-- Pilih Jenis Kas --</option>
                                <option value="masuk">Uang Masuk (Pemasukan)</option>
                                <option value="keluar">Uang Keluar (Pengeluaran)</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Nominal (Rp)</label>
                            <input type="text" class="form-control" id="nominal_mask" placeholder="Contoh: 500.000" required onkeyup="formatRupiah(this)">
                            <input type="hidden" name="nominal" id="nominal_bersih">
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Keterangan / Uraian Transaksi</label>
                            <input type="text" class="form-control" name="keterangan" placeholder="Contoh: Sumbangan hamba Allah untuk operasional" required>
                        </div>
                    </div>
                    <div class="mt-4 text-end">
                        <button type="reset" class="btn btn-secondary me-2">Reset</button>
                        <button type="submit" class="btn btn-success px-4" style="background-color: #0b7f63 !important; border-color: #0b7f63 !important;">Simpan Transaksi</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- TABEL REKAPITULASI KAS YAYASAN -->
        <div class="card shadow-sm">
            <div class="card-header text-white text-center fw-bold fs-4" style="background-color: #0b7f63 !important;">
                Laporan Buku Kas Operasional Yayasan
            </div>
            <div class="card-body" style="overflow-x: auto;">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <!-- Menampilkan rentang tanggal aktif secara dinamis -->
                    <div>
                        <span class="fw-bold">Periode:</span> 
                        {{ \Carbon\Carbon::parse($start)->translatedFormat('d M') }} - {{ \Carbon\Carbon::parse($end)->translatedFormat('d M Y') }}
                    </div>

                    <!-- Tombol Navigasi Penyaringan Minggu Kas Yayasan -->
                    <div class="btn-group" role="group">
                        <a href="{{ route('keuangan-yayasan.index', ['periode' => 'minggu_lalu']) }}" 
                        class="btn btn-outline-secondary {{ $periode === 'minggu_lalu' ? 'active' : '' }}">
                            « Minggu Lalu
                        </a>
                        <a href="{{ route('keuangan-yayasan.index', ['periode' => 'minggu_ini']) }}" 
                        class="btn btn-outline-secondary {{ $periode === 'minggu_ini' ? 'active' : '' }}">
                            Minggu Ini
                        </a>
                        <a href="{{ route('keuangan-yayasan.index', ['periode' => 'minggu_depan']) }}" 
                        class="btn btn-outline-secondary {{ $periode === 'minggu_depan' ? 'active' : '' }}">
                            Minggu Depan »
                        </a>
                    </div>
                </div>                
                
                <!-- TOMBOL MENUJU HALAMAN CETAK MANDIRI -->
                <div class="mb-4 d-flex flex-wrap align-items-center justify-content-end gap-3">
                    <a href="{{ route('keuangan-yayasan.print', ['periode' => request('periode', 'minggu_ini'), 'start' => $start, 'end' => $end]) }}" target="_blank" class="btn btn-sm btn-primary px-3 fw-bold">
                        <i class="bi bi-printer"></i> Cetak / Download PDF
                    </a>
                </div>

                @php
                    $totalMasuk = 0;
                    $totalKeluar = 0;
                    $saldoBerjalan = 0;
                @endphp

                <table class="table table-bordered align-middle text-center table-hover" style="font-size: 13px;">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 50px;">No</th>
                            <th style="width: 130px;">Tanggal</th>
                            <th>Keterangan / Uraian</th>
                            <th style="width: 150px;">Pemasukan (Rp)</th>
                            <th style="width: 150px;">Pengeluaran (Rp)</th>
                            <th style="width: 160px;">Saldo Akhir (Rp)</th>
                            <th style="width: 120px;">Aksi</th>
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
                                <td class="fw-semibold">{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</td>
                                <td class="text-start">{{ $item->keterangan }}</td>
                                <td class="text-end text-success fw-semibold">
                                    {{ $item->jenis === 'masuk' ? number_format($item->nominal, 0, ',', '.') : '-' }}
                                </td>
                                <td class="text-end text-danger fw-semibold">
                                    {{ $item->jenis === 'keluar' ? number_format($item->nominal, 0, ',', '.') : '-' }}
                                </td>
                                <td class="text-end fw-bold bg-light">
                                    {{ number_format($saldoBerjalan, 0, ',', '.') }}
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center gap-1">
                                        <a href="{{ route('keuangan-yayasan.edit', $item->id) }}" class="btn btn-sm py-0 px-2 btn-outline-warning">Edit</a>
                                        <form action="{{ route('keuangan-yayasan.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus transaksi kas ini?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-sm py-0 px-2 btn-outline-danger" style="font-size: 11px;">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted">
                                    Belum ada data transaksi keuangan kas operasional yayasan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <!-- RINGKASAN KAS REKAP VERSI MONITOR INDEKS -->
                <div class="row mt-4">
                    <div class="col-md-5">
                        <table class="table table-sm table-bordered">
                            <tr>
                                <td class="fw-bold bg-light text-start" style="width: 55%;">Total Pemasukan Kas</td>
                                <td class="fw-bold text-success text-end pe-2">Rp {{ number_format($totalMasuk, 0, ',', '.') }}</td>
                            </tr>
                                <td class="fw-bold bg-light text-start">Total Pengeluaran Kas</td>
                                <td class="fw-bold text-danger text-end pe-2">Rp {{ number_format($totalKeluar, 0, ',', '.') }}</td>
                            </tr>
                            <tr class="table-warning">
                                <td class="fw-bold text-start">Saldo Akhir Operasional</td>
                                <td class="fw-bold text-end pe-2" style="font-size: 14px;">
                                    Rp {{ number_format($saldoBerjalan, 0, ',', '.') }}
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

<script>
function formatRupiah(elemen) {
    let nilai = elemen.value.replace(/\D/g, '');
    document.getElementById('nominal_bersih').value = nilai;
    if (nilai) { 
        elemen.value = new Intl.NumberFormat('id-ID').format(nilai); 
    } else { 
        elemen.value = ''; 
    }
}
</script>
@endsection

