@extends('layouts.indexAdmin')

@section('content')
<div class="card">
    <div class="container my-5">
            <h2 class="text-center mb-4 fw-bold">
            @if($transaksi->kategori_id == 1)
                Edit Transaksi Kas Masjid
            @elseif($transaksi->kategori_id == 2)
                Edit Transaksi Kas Yatim
            @elseif($transaksi->kategori_id == 3)
                Edit Transaksi Kas Ambulan
            @elseif($transaksi->kategori_id == 4)
                Edit Transaksi Kas IRMA
            @else
                Edit Transaksi Kas
            @endif
        </h2>

        <!-- Kode Pelacak Error Form Edit -->
        @if ($errors->any())
            <div class="alert alert-danger shadow-sm mb-4 col-md-8 mx-auto">
                <h5 class="fw-bold mb-2">Gagal Memperbarui Transaksi:</h5>
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card shadow-sm col-md-8 mx-auto">
            <div class="card-header text-white text-center fw-bold fs-5" style="background-color: #0b7f63 !important;">
                Form Perubahan Data Transaksi Kas
            </div>
            <div class="card-body">
                <form action="{{ route('keuangan.update', $transaksi->id) }}" method="POST">
                    @csrf
                    @method('PUT') {{-- Wajib menggunakan PUT untuk proses update data di Laravel --}}
                    
                    <!-- 1. Input Tanggal Transaksi -->
                    <div class="mb-3">
                        <label for="tanggal_transaksi" class="form-label fw-semibold">Tanggal Transaksi</label>
                        <input type="date" class="form-control" id="tanggal_transaksi" name="tanggal_transaksi" value="{{ $transaksi->tanggal_transaksi }}" required>
                    </div>

                    <!-- 2. Pilihan Kategori Pos Anggaran -->
                    <div class="mb-3">
                        <label for="kategori_id" class="form-label fw-semibold">Pos Anggaran / Kategori</label>
                        <select class="form-select" id="kategori_id" name="kategori_id" required>
                            @foreach($kategori as $cat)
                                <option value="{{ $cat->id }}" {{ $transaksi->kategori_id == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- 3. Jenis Transaksi -->
                    <div class="mb-3">
                        <label for="type" class="form-label fw-semibold">Jenis Transaksi</label>
                        <select class="form-select" id="type" name="type" required>
                            <option value="kes" {{ $transaksi->type == 'kes' ? 'selected' : '' }}>Uang Masuk</option>
                            <option value="transfer" {{ $transaksi->type == 'transfer' ? 'selected' : '' }}>Uang Keluar</option>
                        </select>
                    </div>

                    <!-- 4. Nominal Uang (Otomatis memuat titik format ribuan dari database) -->
                    <div class="mb-3">
                        <label for="amount" class="form-label fw-semibold">Nominal (Rp)</label>
                        <input type="text" class="form-control" id="amount" name="amount" value="{{ number_format($transaksi->amount, 0, ',', '.') }}" required onkeyup="formatRupiah(this)">
                    </div>

                    <!-- 5. Keterangan / Uraian -->
                    <div class="mb-3">
                        <label for="keterangan" class="form-label fw-semibold">Keterangan / Uraian</label>
                        <input type="text" class="form-control" id="keterangan" name="keterangan" value="{{ $transaksi->keterangan }}" required>
                    </div>

                    <!-- Tombol Navigasi Aksi -->
                    <div class="mt-4 text-end">
                        @if($transaksi->kategori_id == 1)
                            <a href="{{ url('/keuangan/kas-operasional') }}" class="btn btn-secondary me-2">Kembali ke Halaman Kas Masjid</a>
                        @elseif($transaksi->kategori_id == 2)
                            <a href="{{ url('/keuangan/kas-yatim') }}" class="btn btn-secondary me-2">Kembali ke Halaman Kas Yatim</a>
                        @elseif($transaksi->kategori_id == 3)
                            <a href="{{ url('/keuangan/kas-ambulan') }}" class="btn btn-secondary me-2">Kembali ke Halaman Kas Ambulan</a>
                        @elseif($transaksi->kategori_id == 4)
                            <a href="{{ url('/keuangan/kas-irma') }}" class="btn btn-secondary me-2">Kembali ke Halaman Kas IRMA</a>
                        @else
                            <a href="{{ url('/keuangan/kas-operasional') }}" class="btn btn-secondary me-2">Kembali ke Laporan</a>
                        @endif

                        <button type="submit" class="btn btn-success px-4">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
// Fungsi penyeragaman format pemisah ribuan otomatis (Sama dengan halaman index)
function formatRupiah(elemen) {
    let nilai = elemen.value.replace(/\D/g, '');
    if (nilai) {
        elemen.value = new Intl.NumberFormat('id-ID').format(nilai);
    } else {
        elemen.value = '';
    }
}
</script>
@endsection
