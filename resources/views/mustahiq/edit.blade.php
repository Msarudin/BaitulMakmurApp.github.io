@extends('layouts.indexAdmin')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">Form Edit Data Mustahiq</h4>
                <div>
                    <a href="{{ route('mustahiq.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('mustahiq.update', $mustahiq->id) }}" method="POST">
                    @csrf
                    @method('PUT') <!-- PERBAIKAN: Memperbaiki penutup kurung dan kutip -->

                    <!-- Input Nama Mustahiq -->
                    <div class="form-group my-2">
                        <label for="nama_mustahiq">Nama Mustahiq</label>
                        <input type="text" name="nama_mustahiq" id="nama_mustahiq" 
                               class="form-control @error('nama_mustahiq') is-invalid @enderror" 
                               value="{{ old('nama_mustahiq', $mustahiq->nama_mustahiq) }}" autofocus>
                        @error('nama_mustahiq')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Input Umur -->
                    <div class="form-group my-2">
                        <label for="umur">Umur</label>
                        <input type="text" name="umur" id="umur" class="form-control @error('umur') is-invalid @enderror"
                               value="{{ old('umur', $mustahiq->umur) }}">
                        @error('umur')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Dropdown Jenis Kelamin -->
                    <div class="form-group my-2">
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <select name="jenis_kelamin" id="jenis_kelamin" class="form-control @error('jenis_kelamin') is-invalid @enderror">
                            <option value="">Pilihan Jenis Kelamin</option>
                            <option value="laki-laki" {{ old('jenis_kelamin', $mustahiq->jenis_kelamin) == 'laki-laki' ? 'selected' : '' }}>Laki - Laki</option>
                            <option value="perempuan" {{ old('jenis_kelamin', $mustahiq->jenis_kelamin) == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        @error('jenis_kelamin')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Dropdown Utama (Gabungan RT dan Alamat Lainnya) -->
                    <div class="form-group my-2">
                        <label for="bagian_id">Pilih RT / Wilayah</label>
                        <select name="bagian_id" id="bagian_id" class="form-control @error('bagian_id') is-invalid @enderror" onchange="toggleAlamatInput()">
                            <option value="">Pilih RT</option>
                            
                            <!-- PERBAIKAN: Menggunakan bagian_id untuk mencocokkan data relational -->
                            @foreach ($bagians as $bagian)
                                <option value="{{ $bagian->id }}" {{ old('bagian_id', $mustahiq->bagian_id) == $bagian->id ? 'selected' : '' }}>
                                    {{ $bagian->nama_bagian }}
                                </option>
                            @endforeach

                            <!-- PERBAIKAN: Menentukan status terpilih jika data lama memilih alamat manual -->
                            <option value="lainnya" {{ (old('bagian_id', $mustahiq->bagian_id) === null && $mustahiq->alamat_lainnya != '') ? 'selected' : '' }}>Alamat Lainnya (Ketik Manual)</option>
                        </select>
                        @error('bagian_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Input Teks Alamat Lainnya -->
                    <!-- PERBAIKAN: Logika hidden disesuaikan agar mendeteksi data manual lama -->
                    <div class="form-group my-2" id="wrapper_alamat_lainnya" @if(old('bagian_id', $mustahiq->bagian_id) !== null || $mustahiq->alamat_lainnya == '') hidden @endif>
                        <label for="alamat_lainnya">Masukkan Alamat Secara Manual</label>
                        <textarea name="alamat_lainnya" id="alamat_lainnya" cols="10" rows="3" class="form-control @error('alamat_lainnya') is-invalid @enderror" placeholder="Tulis alamat lengkap di sini...">{{ old('alamat_lainnya', $mustahiq->alamat_lainnya) }}</textarea>
                        @error('alamat_lainnya')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Input Alamat Sekarang -->
                    <div class="form-group my-2">
                        <label for="alamat_sekarang">Alamat Sekarang</label>
                        <textarea name="alamat_sekarang" id="alamat_sekarang" cols="10" rows="3" 
                                class="form-control @error('alamat_sekarang') is-invalid @enderror" 
                                placeholder="Tulis alamat lengkap sekarang di sini...">{{ old('alamat_sekarang', $mustahiq->alamat_sekarang) }}</textarea>
                        @error('alamat_sekarang')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Dropdown Kriteria Mustahiq -->
                    <div class="form-group my-2">
                        <label for="ktrmustahiq_id">Kriteria Mustahiq</label>
                        <select name="ktrmustahiq_id" id="ktrmustahiq_id" class="form-control @error('ktrmustahiq_id') is-invalid @enderror">
                            <option value="">Pilih Kriteria</option>
                            @foreach ($ktrmustahiqs as $kriteria)
                                <option value="{{ $kriteria->id }}" {{ old('ktrmustahiq_id', $mustahiq->ktrmustahiq_id) == $kriteria->id ? 'selected' : '' }}>
                                    {{ $kriteria->nama_ktrmustahik }}
                                </option>
                            @endforeach
                        </select>
                        @error('ktrmustahiq_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Tombol Aksi Simpan -->
                    <div class="my-2 d-flex justify-content-end">
                        <button type="submit" class="btn btn-success" 
                                style="background-color: #0b7f63 !important; border-color: #0b7f63 !important;"
                                onmouseover="this.style.backgroundColor='#09664f'; this.style.borderColor='#09664f';"
                                onmouseout="this.style.backgroundColor='#0b7f63'; this.style.borderColor='#0b7f63';">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Skrip JavaScript (Dipindah ke paling bawah agar terpisah rapi dari form) -->
    <script>
        function toggleAlamatInput() {
            var selectBox = document.getElementById("bagian_id");
            var inputWrapper = document.getElementById("wrapper_alamat_lainnya");
            var inputField = document.getElementById("alamat_lainnya");

            if (selectBox.value === "lainnya") {
                inputWrapper.hidden = false;
                inputField.focus();
            } else {
                inputWrapper.hidden = true;
                inputField.value = "";
            }
        }
    </script>
@endsection
