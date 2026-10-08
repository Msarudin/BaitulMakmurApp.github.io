@extends('layouts.indexAdmin')

@section('content')
<div class="card">
    <div class="container my-5">
        <div class="card shadow-sm mx-auto" style="max-width: 800px;">
            <div class="card-header text-white text-center fw-bold fs-4" style="background-color: #0b7f63 !important;">
                Input Pembayaran Iuran Warga
            </div>
            <div class="card-body">
                <form action="{{ route('iuran-warga.store') }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        <!-- 1. Kolom Ketik Nama dengan Fitur Saran / Sugesti Otomatis -->
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Nama Warga (Ketik untuk Mencari Nama)</label>
                            <!-- Input teks yang diikat ke datalist 'list_jamaah' -->
                            <input type="text" class="form-control" id="input_nama_jamaah" placeholder="Ketik nama warga di sini..." list="list_jamaah" autocomplete="off" required oninput="pilihRtDatalist(this)">
                            
                            <!-- Input hidden untuk mengirim ID Jamaah murni ke database database -->
                            <input type="hidden" name="jamaah_id" id="jamaah_id_bersih">

                            <!-- Wadah penampung daftar rekomendasi nama dari database -->
                            <datalist id="list_jamaah">
                                @foreach($daftarJamaah as $jamaah)
                                    @php
                                        $namaRt = $jamaah->rt_name ? str_replace('_', ' ', $jamaah->rt_name) : 'Belum Set RT';
                                    @endphp
                                    <!-- value menampilkan nama_jamaah, data-id menyimpan ID, data-rt menyimpan nama RT -->
                                    <option value="{{ $jamaah->nama_jamaah }}" data-id="{{ $jamaah->id }}" data-rt="{{ $namaRt }}"></option>
                                @endforeach
                            </datalist>
                        </div>

                        <!-- 2. Kotak Tampilan RT Otomatis (Terisi sendiri berdasarkan nama yang diklik) -->
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Bagian RT</label>
                            <input type="text" class="form-control bg-light" id="tampilan_rt_otomatis" readonly placeholder="Otomatis terisi...">
                        </div>
                        
                        <!-- 3. Tanggal, Bulan, dan Tahun Periode -->
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Tanggal Pembayaran</label>
                            <input type="date" class="form-control" name="tanggal_bayar" value="{{ date('Y-m-d') }}" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Untuk Bulan</label>
                            <select class="form-select" name="bulan_iuran" required>
                                @foreach(['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'] as $bulan)
                                    <option value="{{ $bulan }}" {{ date('F') == $bulan ? 'selected' : '' }}>{{ $bulan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Tahun</label>
                            <input type="number" class="form-control" name="tahun_iuran" value="{{ date('Y') }}" required>
                        </div>

                        <!-- 4. Nominal Masking Rupiah -->
                        <div class="col-md-12">
                            <label class="form-label fw-bold">Nominal Iuran (Rp)</label>
                            <input type="text" class="form-control" id="nominal_mask_iuran" placeholder="Contoh: 50.000" required>
                            <input type="hidden" name="nominal" id="nominal_bersih_iuran">
                        </div>

                        <!-- 5. Keterangan -->
                        <div class="col-md-12">
                            <label class="form-label fw-bold">Keterangan Tambahan</label>
                            <input type="text" class="form-control" name="keterangan" placeholder="Contoh: Lunas">
                        </div>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="mt-4 text-end">
                        <a href="{{ route('iuran-warga.index') }}" class="btn btn-secondary me-2">Kembali</a>
                        <button type="submit" class="btn btn-success px-4" style="background-color: #0b7f63 !important; border-color: #0b7f63 !important;">Simpan Pembayaran</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- ==================== JAVASCRIPT OPERASIONAL INTERNAL (MURNI & RINGAN) ==================== -->
<script>
    // 1. LOGIKA UTAMA: MEMBACA REKOMENDASI NAMA & MENGISI ID + RT SECARA OTOMATIS
    function pilihRtDatalist(elemen) {
        var nilaiKetik = elemen.value;
        var opsiDatalist = document.querySelectorAll('#list_jamaah option');
        
        var idBersih = '';
        var namaRtHasil = '';

        // Melakukan looping untuk mencocokkan teks ketikan dengan pilihan datalist
        for (var i = 0; i < opsiDatalist.length; i++) {
            if (opsiDatalist[i].value === nilaiKetik) {
                idBersih = opsiDatalist[i].getAttribute('data-id');
                namaRtHasil = opsiDatalist[i].getAttribute('data-rt');
                break;
            }
        }

        // Tembakkan nilai hasil pencarian secara instan ke dalam kolom element masing-masing
        document.getElementById('jamaah_id_bersih').value = idBersih;
        document.getElementById('tampilan_rt_otomatis').value = namaRtHasil;
    }

    // 2. LOGIKA MASKING: MEMAKSA FORMAT TITIK RIBUAN RUPIAH SAAT DIKETIK
    document.getElementById('nominal_mask_iuran').addEventListener('keyup', function(e) {
        // Ambil hanya karakter angka saja, buang huruf atau simbol titik bawaan ketikan
        let nilaiMurni = this.value.replace(/\D/g, '');
        
        // Simpan angka murni ke input hidden agar sukses disimpan ke database MySQL
        document.getElementById('nominal_bersih_iuran').value = nilaiMurni;
        
        // Tampilkan format rupiah dengan pemisah titik ribuan di layar monitor
        if (nilaiMurni) {
            this.value = new Intl.NumberFormat('id-ID').format(nilaiMurni);
        } else {
            this.value = '';
        }
    });
</script>
@endsection
