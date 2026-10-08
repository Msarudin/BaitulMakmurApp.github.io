@extends('layouts.indexAdmin')

@section('content')
<div class="card">
    <div class="container my-5">
        <div class="card shadow-sm mx-auto" style="max-width: 800px;">
            <div class="card-header text-white text-center fw-bold fs-4" style="background-color: #0b7f63 !important;">
                Edit Pembayaran Iuran Warga
            </div>
            <div class="card-body">
                <form action="{{ route('iuran-warga.update', $iuran->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row g-3">
                        <!-- 1. Dropdown Nama Warga -->
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Nama Warga (Diambil dari Data Jamaah)</label>
                            <select class="form-select" name="jamaah_id" id="select_jamaah_iuran" required onchange="pilihRtOtomatis(this)">
                                <option value="">-- Pilih Nama Warga --</option>
                                @foreach($daftarJamaah as $jamaah)
                                    @php
                                        $namaRt = $jamaah->rt_name ? str_replace('_', ' ', $jamaah->rt_name) : 'Belum Set RT';
                                    @endphp
                                    <option value="{{ $jamaah->id }}" data-rt="{{ $namaRt }}" {{ $iuran->jamaah_id == $jamaah->id ? 'selected' : '' }}>
                                        {{ $jamaah->nama_jamaah }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- 2. Kotak Tampilan RT Otomatis -->
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Bagian RT</label>
                            <input type="text" class="form-control bg-light" id="tampilan_rt_otomatis" readonly placeholder="Otomatis terisi...">
                        </div>
                        
                        <!-- 3. Tanggal, Bulan, dan Tahun Periode -->
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Tanggal Pembayaran</label>
                            <input type="date" class="form-control" name="tanggal_bayar" value="{{ $iuran->tanggal_bayar }}" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Untuk Bulan</label>
                            <select class="form-select" name="bulan_iuran" required>
                                @foreach(['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'] as $bulan)
                                    <option value="{{ $bulan }}" {{ $iuran->bulan_iuran == $bulan ? 'selected' : '' }}>{{ $bulan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Tahun</label>
                            <input type="number" class="form-control" name="tahun_iuran" value="{{ $iuran->tahun_iuran }}" required>
                        </div>

                        <!-- 4. Nominal Masking Rupiah -->
                        <div class="col-md-12">
                            <label class="form-label fw-bold">Nominal Iuran (Rp)</label>
                            <input type="text" class="form-control" id="nominal_mask_iuran" placeholder="Contoh: 50.000" required>
                            <input type="hidden" name="nominal" id="nominal_bersih_iuran" value="{{ $iuran->nominal }}">
                        </div>

                        <!-- 5. Keterangan -->
                        <div class="col-md-12">
                            <label class="form-label fw-bold">Keterangan Tambahan</label>
                            <input type="text" class="form-control" name="keterangan" value="{{ $iuran->keterangan }}" placeholder="Contoh: Lunas">
                        </div>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="mt-4 text-end">
                        <a href="{{ route('iuran-warga.index') }}" class="btn btn-secondary me-2">Kembali</a>
                        <button type="submit" class="btn btn-success px-4" style="background-color: #0b7f63 !important; border-color: #0b7f63 !important;">Perbarui Pembayaran</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- JAVASCRIPT OPERASIONAL FORM EDIT -->
<script>
    // Jalankan fungsi otomatis saat halaman pertama kali dibuka untuk memunculkan data lama
    window.addEventListener('DOMContentLoaded', (event) => {
        var selectElement = document.getElementById('select_jamaah_iuran');
        pilihRtOtomatis(selectElement);

        // Load data nominal lama ke dalam format rupiah masking
        var nominalBersih = document.getElementById('nominal_bersih_iuran').value;
        if (nominalBersih) {
            document.getElementById('nominal_mask_iuran').value = new Intl.NumberFormat('id-ID').format(nominalBersih);
        }
    });

    // 1. DETEKSI RT OTOMATIS
    function pilihRtOtomatis(elemen) {
        var opsiTerpilih = elemen.options[elemen.selectedIndex];
        var namaRtHasil = opsiTerpilih ? opsiTerpilih.getAttribute('data-rt') : '';
        
        if (namaRtHasil) {
            document.getElementById('tampilan_rt_otomatis').value = namaRtHasil;
        } else {
            document.getElementById('tampilan_rt_otomatis').value = '';
        }
    }

    // 2. FORMAT TITIK RIBUAN RUPIAH SAAT DIKETIK
    document.getElementById('nominal_mask_iuran').addEventListener('keyup', function(e) {
        let nilaiMurni = this.value.replace(/\D/g, '');
        document.getElementById('nominal_bersih_iuran').value = nilaiMurni;
        
        if (nilaiMurni) {
            this.value = new Intl.NumberFormat('id-ID').format(nilaiMurni);
        } else {
            this.value = '';
        }
    });
</script>
@endsection
