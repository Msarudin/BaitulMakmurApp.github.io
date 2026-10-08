@extends('layouts.indexAdmin')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">Form Data Mustahiq</h4>
                <div>
                    <a href="{{ route('mustahiq.index') }}">Kembali</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('mustahiq.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group my-2">
                        <label for="nama_mustahiq">Nama Mustahiq</label>
                        <input type="text" name="nama_mustahiq" id="nama_mustahiq" 
                        class="form-control @error('nama_mustahiq')
                            is-invalid 
                        @enderror"
                        value="{{ old('nama_mustahiq') }}" autofocus>
                        @error('nama_mustahiq')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group my-2">
                        <label for="umur">Umur</label>
                        <input type="text" name="umur" id="umur" class="form-control @error('umur') is-invalid
                        @enderror"
                        value="{{ old('umur') }}">
                        @error('umur')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div>
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <select name="jenis_kelamin" id="jenis_kelamin" class="form-control @error('jenis_kelamin') is-invalid
                        @enderror">
                            <option value="">Pilihan Jenis Kelamin</option>
                            <option value="laki-laki" {{ old('jenis_kelamin') == 'laki-laki' ? 'selected' : '' }}>Laki - Laki</option>
                            <option value="perempuan"{{ old('jenis_kelamin') == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>
                    <!-- 1. Dropdown Utama (Gabungan RT dan Alamat Lainnya) -->
                    <div class="form-group my-2">
                        <label for="bagian_id">Pilih RT / Wilayah</label>
                        <select name="bagian_id" id="bagian_id" class="form-control @error('bagian_id') is-invalid @enderror" onchange="toggleAlamatInput()">
                            <option value="">Pilih RT</option>
                            
                            <!-- Melakukan looping data RT dari tabel bagian -->
                            @foreach ($bagians as $bagian)
                                <option value="{{ $bagian->id }}" {{ old('bagian_id') == $bagian->id ? 'selected' : '' }}>
                                    {{ $bagian->nama_bagian }}
                                </option>
                            @endforeach

                            <!-- Opsi Tambahan Statis di dalam Dropdown yang Sama -->
                            <option value="lainnya" {{ old('bagian_id') == 'lainnya' ? 'selected' : '' }}>Alamat Lainnya</option>
                        </select>
                        @error('bagian_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <!-- 2. Input Teks Alamat Lainnya (Awalnya Tersembunyi via style="display: none;") -->
                    <div class="form-group my-2" id="wrapper_alamat_lainnya" @if(old('bagian_id') != 'lainnya') hidden @endif>
                        <label for="alamat_lainnya">Masukkan Alamat Lainnya</label>
                        <textarea name="alamat_lainnya" id="alamat_lainnya" cols="10" rows="3" class="form-control @error('alamat_lainnya') is-invalid @enderror" placeholder="Tulis alamat lengkap di sini...">{{ old('alamat_lainnya') }}</textarea>
                        @error('alamat_lainnya')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <!-- 3. Skrip JavaScript untuk Memunculkan/Menyembunyikan Input Teks -->
                    <script>
                        function toggleAlamatInput() {
                            var selectBox = document.getElementById("bagian_id");
                            var inputWrapper = document.getElementById("wrapper_alamat_lainnya");
                            var inputField = document.getElementById("alamat_lainnya");

                            if (selectBox.value === "lainnya") {
                                inputWrapper.hidden = false; // Memunculkan input
                                inputField.focus();
                            } else {
                                inputWrapper.hidden = true;  // Menyembunyikan input
                                inputField.value = "";
                            }
                        }
                    </script>
                    <div class="form-group my-2">
                        <label for="alamat_sekarang">Alamat Sekarang</label>
                        <textarea name="alamat_sekarang" id="alamat_sekarang" cols="10" rows="3" 
                                class="form-control @error('alamat_sekarang') is-invalid @enderror" 
                                placeholder="Tulis alamat lengkap sekarang di sini...">{{ old('alamat_sekarang') }}</textarea>
                        @error('alamat_sekarang')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group my-2">
                        <label for="ktrmustahiq_id">Kriteria Mustahiq</label>
                        <select name="ktrmustahiq_id" id="ktrmustahiq_id" class="form-control @error('ktrmustahiq_id') is-invalid @enderror">
                            <option value="">Pilih Kriteria</option>
                            @foreach ($ktrmustahiqs as $kriteria)
                                <option value="{{ $kriteria->id }}" {{ old('ktrmustahiq_id') == $kriteria->id ? 'selected' : '' }}>
                                    {{ $kriteria->nama_ktrmustahik }}
                                </option>
                            @endforeach
                        </select>
                        @error('ktrmustahiq_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="my-2 d-flex justify-content-end">
                    <button class="btn btn-success" 
                            style="background-color: #0b7f63 !important; border-color: #0b7f63 !important;"
                            onmouseover="this.style.backgroundColor='#09664f'; this.style.borderColor='#09664f';"
                            onmouseout="this.style.backgroundColor='#037f63'; this.style.borderColor='#037f63';">
                        Simpan Data
                    </button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection