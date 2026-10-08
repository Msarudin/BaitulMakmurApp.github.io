@extends('layouts.indexAdmin')

@section('content')
    <div class="">
        <div class="card">
            <!-- PERBAIKAN: Menyatukan seluruh tombol ke dalam satu wadah pembungkus (d-flex gap-2) -->
            <div class="card-header d-flex justify-content-between align-items-center ">
                <h4 class="card-title">Data Muzaki</h4>
                <div class="d-flex gap-2 align-items-center">
                    <a href="{{ route('muzaki.excel', ['rt_id' => request('rt_id')]) }}" class="btn btn-success btn-sm">
                        <i class="fa fa-file-excel"></i> Export Excel
                    </a>

                    <!-- Tombol Export PDF (Perbaikan: Ganti mustahiq.pdf menjadi muzaki.pdf) -->
                    <a href="{{ route('muzaki.pdf', ['rt_id' => request('rt_id')]) }}" class="btn btn-danger btn-sm">
                        <i class="fa fa-file-pdf"></i> Export PDF
                    </a>

                    <!-- Tombol Tambah Data -->
                    <a href="{{ route('muzaki.create') }}" class="btn btn-success btn-sm" style="background-color: #0b7f63 !important; border-color: #0b7f63 !important;">
                        Tambah Data
                    </a>
                </div>

            </div>
            <div class="card-body">
                    <!-- ==================== FORM FILTER RT BARU ==================== -->
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="filter_rt" class="form-label fw-bold">Pilih RT / Wilayah:</label>
                            <select id="filter_rt" class="form-control" onchange="filterPerRt()">
                                <option value="">-- Semua RT --</option>
                                @foreach (\App\Models\Bagian::all() as $rt)
                                    <option value="{{ $rt->id }}" {{ request('rt_id') == $rt->id ? 'selected' : '' }}>
                                        {{ $rt->nama_bagian }}
                                    </option>
                                @endforeach
                                <option value="lainnya" {{ request('rt_id') == 'lainnya' ? 'selected' : '' }}>Alamat Lainnya</option>
                            </select>
                        </div>
                    </div>
                    <!-- ============================================================== -->
                <!-- Notifikasi Pesan Sukses -->
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="table-responsive">
                <table class="table table-bordered" id="myTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Muzaki</th>
                        <th>Umur</th>
                        <th>Jenis Kelamin</th>
                        <th>Bagian Rt</th>
                        <th>Alamat Lainnya</th>
                        <th>Alamat</th>
                        <th>Nominal</th>
                        <th>Jenis Amal</th>
                        <th class="text-center">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($muzakis as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->nama_muzaki }}</td>
                            <td>{{ $item->umur }}</td>
                            <td>{{ $item->jenis_kelamin }}</td>
                            <td>{{ $item->bagian?->nama_bagian ?? '-' }}</td>
                             <td> {{ $item->alamat_lainnya }} </td>
                            <td>{{ $item->alamat }}</td>
                            <td>Rp {{ number_format($item->nominal, 0, ',', '.') }}</td>
                            <td>{{ $item->jenis_amal?->nama_amal ?? '-' }}</td>
                            <td>
                                <div class="dropdown">
                                <a class="btn dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Aksi
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('muzaki.edit', $item->id) }}">Edit</a></li>
                                    <li>
                                        <!-- Perbaikan class menjadi dropdown-item agar layout menu rapi -->
                                        <button type="button" class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal{{ $item->id }}">
                                            Hapus Data
                                        </button>
                                    </li>
                                </ul>
                                </div>
                            </td>
                        </tr>

                        <!-- MODAL DIMASUKKAN KE SINI (Lebih efisien & aman dari error undefined variable) -->
                        <div class="modal fade" id="confirmDeleteModal{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Lanjutkan penghapusan data?</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-start">
                                    <p>Data muzaki atas nama <strong>{{ $item->nama_muzaki }}</strong> akan terhapus secara permanen. Klik <b>Lanjutkan</b> untuk menghapus data.</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <form action="{{ route('muzaki.destroy', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Lanjutkan</button>
                                    </form>
                                </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
<script>
    function filterPerRt() {
        var rtId = document.getElementById('filter_rt').value;
        
        // Jika memilih "Semua RT", kembalikan ke URL utama tanpa parameter
        if(rtId === "") {
            window.location.href = "{{ route('muzaki.index') }}";
        } else {
            // Otomatis reload halaman dengan membawa parameter ?rt_id=
            window.location.href = "{{ route('muzaki.index') }}?rt_id=" + rtId;
        }
    }
</script>

@endsection
