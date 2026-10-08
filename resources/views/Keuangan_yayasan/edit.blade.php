@extends('layouts.indexAdmin')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header text-white text-center fw-bold fs-4" style="background-color: #0b7f63 !important;">
                    Edit Transaksi Kas Yayasan
                </div>
                <div class="card-body">
                    <!-- Form Mengarah ke Method Update dengan Route Strip Sesuai routes/web.php -->
                    <form action="{{ route('keuangan-yayasan.update', $transaksi->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">Tanggal Transaksi</label>
                            <input type="date" class="form-control @error('tanggal') is-invalid @enderror" 
                                   name="tanggal" value="{{ old('tanggal', $transaksi->tanggal) }}" required>
                            @error('tanggal') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Jenis Transaksi</label>
                            <select class="form-select @error('jenis') is-invalid @enderror" name="jenis" required>
                                <option value="masuk" {{ old('jenis', $transaksi->jenis) == 'masuk' ? 'selected' : '' }}>Uang Masuk (Pemasukan)</option>
                                <option value="keluar" {{ old('jenis', $transaksi->jenis) == 'keluar' ? 'selected' : '' }}>Uang Keluar (Pengeluaran)</option>
                            </select>
                            @error('jenis') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nominal (Rp)</label>
                            <!-- Input Masking Text Bayangan Titik Ribuan -->
                            <input type="text" class="form-control @error('nominal') is-invalid @enderror" 
                                   id="nominal_mask" value="{{ number_format(old('nominal', $transaksi->nominal), 0, ',', '.') }}" 
                                   placeholder="Contoh: 500.000" required onkeyup="formatRupiah(this)">
                            
                            <!-- Input Hidden untuk Mengirim Angka Bersih Ke Controller -->
                            <input type="hidden" name="nominal" id="nominal_bersih" value="{{ old('nominal', $transaksi->nominal) }}">
                            @error('nominal') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Keterangan / Uraian Transaksi</label>
                            <input type="text" class="form-control @error('keterangan') is-invalid @enderror" 
                                   name="keterangan" value="{{ old('keterangan', $transaksi->keterangan) }}" placeholder="Contoh: Pembelian ATK Kantor" required>
                            @error('keterangan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mt-4 text-end">
                            <a href="{{ route('keuangan-yayasan.index') }}" class="btn btn-secondary me-2">Batal</a>
                            <button type="submit" class="btn btn-success px-4" style="background-color: #0b7f63 !important; border-color: #0b7f63 !important;">
                                Perbarui Transaksi
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Script Pembatas Titik Otomatis -->
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
