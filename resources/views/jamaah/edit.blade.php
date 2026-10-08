@extends('layouts.indexAdmin')

@section('content')
    <div class="">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">Form Data Jamaah Edit</h4>
                <div>
                    <a href="{{ route('jamaah.index') }}">Kembali</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('jamaah.update', $jamaah->id) }}" method="POST" class="" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group my-2">
                        <label for="nama_jamaah">Nama Jamaah</label>
                        <input type="text" name="nama_jamaah" id="nama_jamaah" 
                        class="form-control @error('nama_jamaah')
                            is-invalid 
                        @enderror"
                        value="{{ $jamaah->nama_jamaah }}" autofocus>
                        @error('nama_jamaah')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group my-2">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" 
                        class="form-control @error('email')
                            is-invalid 
                        @enderror"
                        value="{{ $jamaah->email }}" autoComplete="off">
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group my-2">
                        <label for="nik">NIK</label>
                        <input type="text" name="nik" id="nik" class="form-control @error('nik') is-invalid
                        @enderror"
                        value="{{ $jamaah->nik }}" readonly
                        oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                        maxlength="16">
                        @error('nik')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group my-2">
                        <label for="nik">No Kartu Keluarga</label>
                        <input type="text" name="no_kk" id="no_kk" class="form-control @error('no_kk') is-invalid
                        @enderror"
                        value="{{ $jamaah->no_kk }}" readonly
                        oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                        maxlength="16">
                        @error('no_kk')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group my-2">
                        <label for="nik">No Tlp</label>
                        <input type="text" name="no_tlp" id="no_tlp" class="form-control @error('no_tlp') is-invalid
                        @enderror"
                        value="{{ $jamaah->no_tlp }}">
                        @error('no_tlp')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group my-2">
                        <label for="umur">Umur</label>
                        <input type="text" name="umur" id="umur" class="form-control @error('umur') is-invalid
                        @enderror"
                        value="{{ $jamaah->umur }}">
                        @error('umur')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div>
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <select name="jenis_kelamin" id="jenis_kelamin" class="form-control @error('jenis_kelamin') is-invalid
                        @enderror">
                            <option value="">Pilihan Jenis Kelamin</option>
                            <option value="laki-laki" {{ $jamaah->jenis_kelamin == 'laki-laki' ? 'selected' : '' }}>Laki - Laki</option>
                            <option value="perempuan"{{ $jamaah->jenis_kelamin== 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group my-2">
                        <label for="tanggal_lahir">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control @error('tanggal_lahir') is-invalid
                        @enderror"
                        value="{{ $jamaah->tanggal_lahir }}">
                        @error('tanggal_lahir')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group my-2">
                        <label for="tempat_lahir">Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control @error('tempat_lahir') is-invalid
                        @enderror"
                        value="{{ $jamaah->tempat_lahir }}">
                        @error('tempat_lahir')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group my-2">
                        <label for="foto">Foto Pegawai</label>
                        <input type="file" name="foto" id="foto"
                            class="form-control @error('foto')
                                is-invalid
                            @enderror">
                            @error('foto')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                    </div>
                    <div class="form-group my-2">
                        <label for="bagian_id">Pilih RT</label>
                        <select name="bagian_id" id="bagian_id"
                            class="form-control @error('bagian_id')
                                is-invalid
                            @enderror">
                            <option value="">Pilih RT</option>
                            @foreach ($bagians as $bagian)
                                <option value="{{ $bagian->id }}" {{ $jamaah->bagian_id == $bagian->id ? 'selected' : '' }}>
                                    {{ $bagian->nama_bagian }}</option>
                            @endforeach
                        </select>
                        @error('bagian_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div>
                        <label for="alamat_sekarang">Alamat Sekarang</label>
                        <textarea name="alamat_sekarang" id="alamat_sekarang" cols="10" rows="3" class="form-control @error('alamat_sekarang') is-invalid @enderror">{{ $jamaah->alamat_sekarang }}</textarea>
                        @error('alamat_sekarang')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div>
                        <label for="alamat_asal">Alamat Asal</label>
                        <textarea name="alamat_asal" id="alamat_asal" cols="10" rows="3" class="form-control @error('alamat_asal') is-invalid @enderror">{{ $jamaah->alamat_asal }}</textarea>
                        @error('alamat_asal')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="my-2 d-flex justify-content-end">
                        <button class="btn btn-primary">Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection