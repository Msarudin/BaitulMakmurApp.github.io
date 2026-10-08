@extends('layouts.indexAdmin')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">Form Data Jamaah</h4>
                <div>
                    <a href="{{ route('jamaah.index') }}">Kembali</a>
                </div>
            </div>
            <div class="card-body">
                <!-- FORM UTAMA -->
                <form id="formJamaah" action="{{ route('jamaah.store') }}" method="POST" enctype="multipart/form-data" data-role-null="{{ is_null(Auth::user()->role_id) ? 'true' : 'false' }}">
                    @csrf
                    <div class="form-group my-2">
                        <label for="nama_jamaah">Nama Jamaah</label>
                        <input type="text" name="nama_jamaah" id="nama_jamaah" 
                        class="form-control @error('nama_jamaah') is-invalid @enderror"
                        value="{{ old('nama_jamaah') }}" autofocus>
                        @error('nama_jamaah')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group my-2">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" 
                        class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email') }}" autoComplete="off">
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group my-2">
                        <label for="nik">NIK</label>
                        <input type="text" name="nik" id="nik" class="form-control @error('nik') is-invalid @enderror"
                        value="{{ old('nik') }}"
                        oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                        maxlength="16"
                        placeholder="Masukkan 16 digit NIK">
                        @error('nik')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group my-2">
                        <label for="no_kk">No Kartu Keluarga</label>
                        <input type="text" name="no_kk" id="no_kk" class="form-control @error('no_kk') is-invalid @enderror"
                        value="{{ old('no_kk') }}"
                        oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                        maxlength="16"
                        placeholder="Masukkan 16 digit No KK">
                        @error('no_kk')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group my-2">
                        <label for="no_tlp">No Tlp</label>
                        <input type="text" name="no_tlp" id="no_tlp" class="form-control @error('no_tlp') is-invalid @enderror"
                        value="{{ old('no_tlp') }}">
                        @error('no_tlp')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group my-2">
                        <label for="umur">Umur</label>
                        <input type="text" name="umur" id="umur" class="form-control @error('umur') is-invalid @enderror"
                        value="{{ old('umur') }}">
                        @error('umur')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div>
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <select name="jenis_kelamin" id="jenis_kelamin" class="form-control @error('jenis_kelamin') is-invalid @enderror">
                            <option value="">Pilihan Jenis Kelamin</option>
                            <option value="laki-laki" {{ old('jenis_kelamin') == 'laki-laki' ? 'selected' : '' }}>Laki - Laki</option>
                            <option value="perempuan"{{ old('jenis_kelamin') == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group my-2">
                        <label for="tanggal_lahir">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control @error('tanggal_lahir') is-invalid @enderror"
                        value="{{ old('tanggal_lahir') }}">
                        @error('tanggal_lahir')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group my-2">
                        <label for="tempat_lahir">Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control @error('tempat_lahir') is-invalid @enderror"
                        value="{{ old('tempat_lahir') }}">
                        @error('tempat_lahir')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group my-2">
                        <label for="foto">KTP Jamaah</label>
                        <input type="file" name="foto" id="foto" class="form-control @error('foto') is-invalid @enderror">
                        @error('foto')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group my-2">
                        <label for="bagian_id">Pilih RT</label>
                        <select name="bagian_id" id="bagian_id" class="form-control @error('bagian_id') is-invalid @enderror">
                            <option value="">Pilih RT</option>
                            @foreach ($bagians as $bagian)
                                <option value="{{ $bagian->id }}" {{ old('bagian_id') == $bagian->id ? 'selected' : '' }}>
                                    {{ $bagian->nama_bagian }}</option>
                            @endforeach
                        </select>
                        @error('bagian_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div>
                        <label for="alamat_sekarang">Alamat Saat Ini</label>
                        <textarea name="alamat_sekarang" id="alamat_sekarang" cols="10" rows="3" class="form-control @error('alamat_sekarang') is-invalid @enderror">{{ old('alamat_sekarang') }}</textarea>
                        @error('alamat_sekarang')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="alamat_asal">Alamat Asal</label>
                        <textarea name="alamat_asal" id="alamat_asal" cols="10" rows="3" class="form-control @error('alamat_asal') is-invalid @enderror">{{ old('alamat_asal') }}</textarea>
                        @error('alamat_asal')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="my-2 d-flex justify-content-end">
                        <button type="button" onclick="siapkanDataReview()" class="btn btn-success" 
                                style="background-color: #0b7f63 !important; border-color: #0b7f63 !important;"
                                onmouseover="this.style.backgroundColor='#09664f'; this.style.borderColor='#09664f';"
                                onmouseout="this.style.backgroundColor='#0b7f63'; this.style.borderColor='#0b7f63';">
                            Simpan Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- JENDELA POPUP MODAL LOKAL (Tombol Kontrol Ditangani JavaScript Langsung Mencegah Macet) -->
    <div class="modal fade" id="modalReviewData" tabindex="-1" role="dialog" aria-labelledby="modalReviewDataLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalReviewDataLabel">Periksa Kembali Data Anda</h5>
                    <!-- Perbaikan tombol X: Menggunakan onclick untuk menutup modal secara terprogram -->
                    <button type="button" class="close" onclick="tutupModalManual()" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-left" style="line-height: 1.6; text-align: left !important; max-height: 380px; overflow-y: auto;">
                    <p><strong>Nama Jamaah:</strong> <span id="rev_nama">-</span></p>
                    <p><strong>Email:</strong> <span id="rev_email">-</span></p>
                    <p><strong>NIK:</strong> <span id="rev_nik">-</span></p>
                    <p><strong>No Kartu Keluarga:</strong> <span id="rev_nokk">-</span></p>
                    <p><strong>No Tlp:</strong> <span id="rev_tlp">-</span></p>
                    <p><strong>Umur:</strong> <span id="rev_umur">-</span></p>
                    <p><strong>Jenis Kelamin:</strong> <span id="rev_gender">-</span></p>
                    <p><strong>Tempat Lahir:</strong> <span id="rev_tempat">-</span></p>
                    <p><strong>Tanggal Lahir:</strong> <span id="rev_tanggal">-</span></p>
                    <p><strong>KTP Jamaah:</strong> <span id="rev_foto">-</span></p>
                    <p><strong>Pilihan RT:</strong> <span id="rev_rt">-</span></p>
                    <p><strong>Alamat Saat Ini:</strong> <span id="rev_alamat_sekarang">-</span></p>
                    <p><strong>Alamat Asal:</strong> <span id="rev_alamat_asal">-</span></p>
                    <br>
                    <p class="text-center font-weight-bold" style="margin-bottom:0;">Apakah data di atas sudah benar?</p>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <!-- Perbaikan tombol Kembali: Menggunakan onclick untuk menutup modal secara terprogram -->
                    <button type="button" class="btn btn-secondary" onclick="tutupModalManual()">Kembali Edit</button>
                    <button type="button" onclick="eksekusiSimpanFinal()" class="btn btn-success" style="background-color: #0b7f63; border-color: #0b7f63;">Ya, Sudah Benar!</button>
                </div>
            </div>
        </div>
    </div>

    <!-- JAVASCRIPT KONTROL UTAMA -->
    <script>
    function siapkanDataReview() {
        var formElement = document.getElementById('formJamaah');
        if (!formElement) return;

        var isRoleNull = formElement.getAttribute('data-role-null') === 'true';

        // JIKA USER BUKAN ID NULL -> LANGSUNG SIMPAN KE DATABASE (NORMAL)
        if (!isRoleNull) {
            formElement.submit();
            return;
        }

        // Kumpulkan data teks dari inputan form
        var nama = document.getElementById('nama_jamaah') ? document.getElementById('nama_jamaah').value.trim() : '';
        var email = document.getElementById('email') ? document.getElementById('email').value.trim() : '';
        var nik = document.getElementById('nik') ? document.getElementById('nik').value.trim() : '';
        var nokk = document.getElementById('no_kk') ? document.getElementById('no_kk').value.trim() : '';
        var tlp = document.getElementById('no_tlp') ? document.getElementById('no_tlp').value.trim() : '';
        var umur = document.getElementById('umur') ? document.getElementById('umur').value.trim() : '';
        
        var elGender = document.getElementById('jenis_kelamin');
        var gender = elGender && elGender.options[elGender.selectedIndex] ? elGender.options[elGender.selectedIndex].text : '';
        
        var tanggal = document.getElementById('tanggal_lahir') ? document.getElementById('tanggal_lahir').value : '';
        var tempat = document.getElementById('tempat_lahir') ? document.getElementById('tempat_lahir').value.trim() : '';
        
        var elRt = document.getElementById('bagian_id');
        var rt = elRt && elRt.options[elRt.selectedIndex] ? elRt.options[elRt.selectedIndex].text : '';
        
        var alamatSekarang = document.getElementById('alamat_sekarang') ? document.getElementById('alamat_sekarang').value.trim() : '';
        var alamatAsal = document.getElementById('alamat_asal') ? document.getElementById('alamat_asal').value.trim() : '';
        
        // Perbaikan pembacaan nama file KTP
        var elFoto = document.getElementById('foto');
        var fotoName = elFoto && elFoto.files && elFoto.files.length > 0 ? elFoto.files[0].name : '';

        // Suntikkan teks ke dalam wadah tampilan Modal Review
        document.getElementById('rev_nama').innerText = nama || '-';
        document.getElementById('rev_email').innerText = email || '-';
        document.getElementById('rev_nik').innerText = nik || '-';
        document.getElementById('rev_nokk').innerText = nokk || '-';
        document.getElementById('rev_tlp').innerText = tlp || '-';
        document.getElementById('rev_umur').innerText = umur || '-';
        document.getElementById('rev_gender').innerText = gender === 'Pilihan Jenis Kelamin' ? '-' : gender;
        document.getElementById('rev_tempat').innerText = tempat || '-';
        document.getElementById('rev_tanggal').innerText = tanggal || '-';
        document.getElementById('rev_foto').innerText = fotoName || 'Belum memilih file KTP';
        document.getElementById('rev_rt').innerText = rt === 'Pilih RT' ? '-' : rt;
        document.getElementById('rev_alamat_sekarang').innerText = alamatSekarang || '-';
        document.getElementById('rev_alamat_asal').innerText = alamatAsal || '-';

        // Tampilkan Modal menggunakan perintah kelas Bootstrap manual agar stabil
        var modalEl = document.getElementById('modalReviewData');
        if (modalEl) {
            modalEl.classList.add('show');
            modalEl.style.display = 'block';
            modalEl.style.background = 'rgba(0,0,0,0.5)';
            document.body.classList.add('modal-open');
        }
    }

    // Fungsi perbaikan untuk menutup modal peninjau
    function tutupModalManual() {
        var modalEl = document.getElementById('modalReviewData');
        if (modalEl) {
            modalEl.classList.remove('show');
            modalEl.style.display = 'none';
            document.body.classList.remove('modal-open');
        }
    }

    // Fungsi untuk mengirimkan form asli ke backend database
    function eksekusiSimpanFinal() {
        var formElement = document.getElementById('formJamaah');
        if (formElement) {
            formElement.submit();
        }
    }
    </script>
@endsection
