@extends('layouts.indexAdmin')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">Form Tambah Data Muzaki</h4>
                <div>
                    <a href="{{ route('muzaki.index') }}" class="btn btn-warning btn-sm">Kembali</a>
                </div>
            </div>
            <div class="card-body">
                <!-- FORM ACTION MENGARAH KE STORE UNTUK MENYIMPAN DATA BARU -->
                <form action="{{ route('muzaki.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- 1. Input Nama Muzaki -->
                    <div class="form-group my-2">
                        <label for="nama_muzaki">Nama Muzaki</label>
                        <input type="text" name="nama_muzaki" id="nama_muzaki" 
                               class="form-control @error('nama_muzaki') is-invalid @enderror"
                               value="{{ old('nama_muzaki') }}" autofocus placeholder="Nama lengkap...">
                        @error('nama_muzaki')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- 2. Input Umur -->
                    <div class="form-group my-2">
                        <label for="umur">Umur</label>
                        <input type="text" name="umur" id="umur" 
                               class="form-control @error('umur') is-invalid @enderror"
                               value="{{ old('umur') }}" placeholder="Contioh: 45">
                        @error('umur')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- 3. Dropdown Jenis Kelamin -->
                    <div class="form-group my-2">
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <select name="jenis_kelamin" id="jenis_kelamin" class="form-control @error('jenis_kelamin') is-invalid @enderror">
                            <option value="">Pilihan Jenis Kelamin</option>
                            <option value="laki-laki" {{ old('jenis_kelamin') == 'laki-laki' ? 'selected' : '' }}>Laki - Laki</option>
                            <option value="perempuan" {{ old('jenis_kelamin') == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        @error('jenis_kelamin')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- 4. Dropdown Pilih RT / Wilayah -->
                    <div class="form-group my-2">
                        <label for="bagian_id">Pilih RT / Wilayah</label>
                        <select name="bagian_id" id="bagian_id" class="form-control @error('bagian_id') is-invalid @enderror" onchange="toggleAlamatInput()">
                            <option value="">Pilih RT</option>
                            @foreach ($bagians as $bagian)
                                <option value="{{ $bagian->id }}" {{ old('bagian_id') == $bagian->id ? 'selected' : '' }}>
                                    {{ $bagian->nama_bagian }}
                                </option>
                            @endforeach
                            <option value="lainnya" {{ old('bagian_id') == 'lainnya' ? 'selected' : '' }}>Alamat Lainnya</option>
                        </select>
                        @error('bagian_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- 5. Input Teks Alamat Lainnya (Hanya muncul jika memilih 'lainnya') -->
                    <div class="form-group my-2" id="wrapper_alamat_lainnya" {{ old('bagian_id') == 'lainnya' ? '' : 'hidden' }}>
                        <label for="alamat_lainnya">Masukkan Alamat Lainnya</label>
                        <textarea name="alamat_lainnya" id="alamat_lainnya" cols="10" rows="3" 
                                class="form-control @error('alamat_lainnya') is-invalid @enderror" 
                                placeholder="Tulis alamat manual lengkap di sini...">{{ old('alamat_lainnya') }}</textarea>
                        @error('alamat_lainnya')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- 6. Input Alamat Sekarang (Disembunyikan jika memilih 'lainnya') -->
                    <div class="form-group my-2" id="wrapper_alamat_sekarang" {{ old('bagian_id') == 'lainnya' ? 'hidden' : '' }}>
                        <label for="alamat">Alamat Sekarang</label>
                        <textarea name="alamat" id="alamat" cols="10" rows="3" 
                                class="form-control @error('alamat') is-invalid @enderror" 
                                placeholder="Tulis detail alamat sekarang di sini...">{{ old('alamat') }}</textarea>
                        @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                <script>
                    function toggleAlamatInput() {
                        var selectBox = document.getElementById("bagian_id");
                        var wrapperLainnya = document.getElementById("wrapper_alamat_lainnya");
                        var fieldLainnya = document.getElementById("alamat_lainnya");
                        
                        var wrapperSekarang = document.getElementById("wrapper_alamat_sekarang");
                        var fieldSekarang = document.getElementById("alamat");

                        if (selectBox.value === "lainnya") {
                            wrapperLainnya.hidden = false;
                            wrapperSekarang.hidden = true; // Sembunyikan alamat bawaan
                            fieldSekarang.value = "";      // Kosongkan nilainya agar tidak dikirim
                            fieldLainnya.focus();
                        } else {
                            wrapperLainnya.hidden = true;
                            wrapperSekarang.hidden = false; // Tampilkan kembali alamat bawaan
                            fieldLainnya.value = "";       // Kosongkan alamat manual
                        }
                    }
                </script>

                    <!-- 7. Dropdown Kriteria Amal -->
                    <div class="form-group my-2">
                        <label for="amal_id">Kriteria Amal</label>
                        <select name="amal_id" id="amal_id" class="form-control @error('amal_id') is-invalid @enderror">
                            <option value="">Pilih Kriteria</option>
                            @foreach ($jenis_amals as $amal)
                                <option value="{{ $amal->id }}" {{ old('amal_id') == $amal->id ? 'selected' : '' }}>
                                    {{ $amal->nama_amal }}
                                </option>
                            @endforeach
                        </select>
                        @error('amal_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- 8. Input Nominal dengan Fitur Masking Pemisah Ribuan -->
                    <div class="form-group my-3">
                        <label for="nominal_mask" class="form-label">Nominal (Rp)</label>
                        <input type="text" id="nominal_mask" class="form-control @error('nominal') is-invalid @enderror"
                               value="{{ old('nominal') ? number_format(old('nominal'), 0, ',', '.') : '' }}" 
                               placeholder="Contoh: 5.000.000" oninput="formatRupiah(this)">
                        
                        <input type="hidden" name="nominal" id="nominal_bersih" value="{{ old('nominal') }}">
                        @error('nominal')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group my-3">
                        <button type="submit" class="btn btn-primary" style="background-color: #0b7f63; border-color: #0b7f63;">Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

<script>
    function formatRupiah(element) {
        let value = element.value.replace(/[^0-9]/g, '');
        document.getElementById('nominal_bersih').value = value;
        if (value === '') {
            element.value = '';
            return;
        }
        let formatted = new Intl.NumberFormat('id-ID').format(value);
        element.value = formatted;
    }
</script>
