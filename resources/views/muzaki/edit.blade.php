@extends('layouts.indexAdmin')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title">Form Edit Data Muzaki</h4>
            <div>
                <a href="{{ route('muzaki.index') }}" class="btn btn-warning btn-sm">Kembali</a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('muzaki.update', $muzaki->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <!-- 1. Input Nama Muzaki -->
                <div class="form-group my-2">
                    <label for="nama_muzaki">Nama Muzaki</label>
                    <input type="text" name="nama_muzaki" id="nama_muzaki" 
                           class="form-control @error('nama_muzaki') is-invalid @enderror"
                           value="{{ old('nama_muzaki', $muzaki->nama_muzaki) }}" autofocus>
                    @error('nama_muzaki')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- 2. Input Umur -->
                <div class="form-group my-2">
                    <label for="umur">Umur</label>
                    <input type="text" name="umur" id="umur" 
                           class="form-control @error('umur') is-invalid @enderror"
                           value="{{ old('umur', $muzaki->umur) }}">
                    @error('umur')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- 3. Dropdown Jenis Kelamin -->
                <div class="form-group my-2">
                    <label for="jenis_kelamin">Jenis Kelamin</label>
                    <select name="jenis_kelamin" id="jenis_kelamin" class="form-control @error('jenis_kelamin') is-invalid @enderror">
                        <option value="">Pilihan Jenis Kelamin</option>
                        <option value="laki-laki" {{ old('jenis_kelamin', $muzaki->jenis_kelamin) == 'laki-laki' ? 'selected' : '' }}>Laki - Laki</option>
                        <option value="perempuan" {{ old('jenis_kelamin', $muzaki->jenis_kelamin) == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
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
                            <option value="{{ $bagian->id }}" {{ old('bagian_id', $muzaki->bagian_id) == $bagian->id ? 'selected' : '' }}>
                                {{ $bagian->nama_bagian }}
                            </option>
                        @endforeach
                        <option value="lainnya" {{ old('bagian_id', is_null($muzaki->bagian_id) ? 'lainnya' : '') == 'lainnya' ? 'selected' : '' }}>Alamat Lainnya (Ketik Manual)</option>
                    </select>
                    @error('bagian_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                @php 
                    $isLainnya = old('bagian_id', is_null($muzaki->bagian_id) ? 'lainnya' : '') === 'lainnya';
                @endphp

                <!-- 5. Input Teks Alamat Lainnya -->
                <div class="form-group my-2" id="wrapper_alamat_lainnya" @if(!$isLainnya) hidden @endif>
                    <label for="alamat_lainnya">Masukkan Alamat Secara Manual</label>
                    <textarea name="alamat_lainnya" id="alamat_lainnya" cols="10" rows="3" 
                              class="form-control @error('alamat_lainnya') is-invalid @enderror" 
                              placeholder="Tulis alamat lengkap di sini...">{{ old('alamat_lainnya', $muzaki->alamat_lainnya) }}</textarea>
                    @error('alamat_lainnya')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- 6. Input Alamat Sekarang -->
                <div class="form-group my-2" id="wrapper_alamat_sekarang" @if($isLainnya) hidden @endif>
                    <label for="alamat">Alamat Sekarang</label>
                    <textarea name="alamat" id="alamat" cols="10" rows="3" 
                              class="form-control @error('alamat') is-invalid @enderror" 
                              placeholder="Tulis alamat lengkap sekarang di sini...">{{ old('alamat', $muzaki->alamat) }}</textarea>
                    @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- 7. Dropdown Kriteria Amal -->
                <div class="form-group my-2">
                    <label for="amal_id">Kriteria Amal</label>
                    <select name="amal_id" id="amal_id" class="form-control @error('amal_id') is-invalid @enderror">
                        <option value="">Pilih Kriteria</option>
                        @foreach ($jenis_amals as $amal)
                            <option value="{{ $amal->id }}" {{ old('amal_id', $muzaki->amal_id) == $amal->id ? 'selected' : '' }}>
                                {{ $amal->nama_amal }}
                            </option>
                        @endforeach
                    </select>
                    @error('amal_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- 8. Input Nominal dengan Pembatas Otomatis Ribuan -->
                @php 
                    $nominalSekarang = old('nominal', $muzaki->nominal);
                @endphp
                <div class="form-group my-3 position-relative">
                    <label for="nominal_mask" class="form-label">Nominal (Rp)</label>
                    <input type="text" id="nominal_mask" 
                           class="form-control @error('nominal') is-invalid @enderror"
                           value="{{ $nominalSekarang ? number_format($nominalSekarang, 0, ',', '.') : '' }}" 
                           placeholder="Contoh: 5.000.000" oninput="formatRupiah(this)">
                    
                    <input type="hidden" name="nominal" id="nominal_bersih" value="{{ $nominalSekarang }}">
                    @error('nominal')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Tombol Perbarui Aksi -->
                <div class="my-3 d-flex justify-content-end">
                    <button type="submit" class="btn btn-success" style="background-color: #0b7f63 !important; border-color: #0b7f63 !important;">
                        Perbarui Data
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Fungsi 1: Sakelar Tampilan Alamat
        function toggleAlamatInput() {
            var selectBox = document.getElementById("bagian_id");
            var wrapperLainnya = document.getElementById("wrapper_alamat_lainnya");
            var fieldLainnya = document.getElementById("alamat_lainnya");
            
            var wrapperSekarang = document.getElementById("wrapper_alamat_sekarang");
            var fieldSekarang = document.getElementById("alamat");

            if (selectBox.value === "lainnya") {
                wrapperLainnya.hidden = false;
                wrapperSekarang.hidden = true;
                fieldSekarang.value = "";
                fieldLainnya.focus();
            } else {
                wrapperLainnya.hidden = true;
                wrapperSekarang.hidden = false;
                fieldLainnya.value = "";
            }
        }

        // Fungsi 2: Format Masking Rupiah Ribuan
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
@endsection

