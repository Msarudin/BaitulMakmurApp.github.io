@extends('layouts.indexAdmin')

@section('content')

    <div class="">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center ">
    <!-- Judul Halaman Dinamis -->
    <h4 class="card-title">
        Data Jamaah {{ isset($detailRt) ? '- ' . $detailRt->nama_bagian : '' }}
    </h4>
    
            <div class="d-flex gap-2 align-items-center">
                @php
                    // Mendeteksi ID RT secara cerdas baik dari link sidebar (segment 3) maupun dropdown kueri
                    $activeRt = request()->segment(3) ?? request('rt_id');
                @endphp

                <!-- Tombol Export Excel (Membawa parameter rt_id secara aman) -->
                <a href="{{ route('jamaah.excel', ['rt_id' => $activeRt]) }}" class="btn btn-success btn-sm">
                    <i class="fa fa-file-excel"></i> Export Excel
                </a>
                
                <!-- Tombol Export PDF (Membawa parameter rt_id secara aman) -->
                <a href="{{ route('jamaah.pdf', ['rt_id' => $activeRt]) }}" class="btn btn-danger btn-sm">
                    <i class="fa fa-file-pdf"></i> Export PDF
                </a>

                <!-- Tombol Tambah Data Jamaah -->
                <a href="{{ route('jamaah.create') }}" class="btn btn-success btn-sm" style="background-color: #0b7f63 !important; border-color: #0b7f63 !important;">
                    Tambah Data
                </a>
            </div>
        </div>

            <div class="card-body">
                <div class="table-responsive">
                <table class="table table-bordered" id="myTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Jamaah</th>
                            <th>Email</th>
                            <th>NIK</th>
                            <th>No Kartu Keluarga</th>
                            <th>No Tlp</th>
                            <th>Umur</th>
                            <th>Tempat, Tanggal Lahir</th>
                            <th>Jenis Kelamin</th>
                            <th>Bagian Rt</th>
                            <th>Alamat Sekarang</th>
                            <th>Alamat Asal</th>
                            <th>KTP Jamaah</th>
                            <th class="text-center">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jamaah as $index => $item)
                        <tr>
                            <td> {{ $index + 1 }} </td>
                            <td> {{ $item->nama_jamaah }} </td>
                            <td> {{ $item->email }}</td>
                            <td> {{ $item->nik }} </td>
                            <td> {{ $item->no_kk }} </td>
                            <td> {{ $item->no_tlp }} </td>
                            <td> {{ $item->umur }} </td>
                            <td> {{ $item->jenis_kelamin }} </td>
                            <td> {{ $item->tempat_lahir }}, {{ \Carbon\Carbon::parse($item->tanggal_lahir)->locale('id')->translatedFormat('d F Y') }} </td>
                            <td> {{ $item->bagian?->nama_bagian }}</td>
                            <td> {{ $item->alamat_sekarang }} </td>
                            <td> {{ $item->alamat_asal }} </td>
                            <td>
                                <button type="button" class="btn text-white" data-bs-toggle="modal" data-bs-target="#modalFoto{{ $item->id }}" style="background-color: #0b7f63 !important;">
                                    Lihat Foto
                                </button>
                            </td>
                            <td>
                                <div class="dropdown">
                                <a class="btn dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Aksi
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('jamaah.edit', $item->id) }}">Edit</a></li>
                                    <li>
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn text-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal{{ $item->id }}">
                                            Hapus Data
                                        </button>
                                    </li>
                                </ul>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
    @foreach ($jamaah as $item)
    <!-- Modal -->
    <div class="modal fade" id="confirmDeleteModal{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Lanjutkan penghapusan data ?</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <p>Data akan terhapus secara permanen, Klik <b>Lanjutkan</b>untuk menghapusa data</p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <form action="{{ route('jamaah.destroy', $item->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Lanjutkan</button>
            </form>
        </div>
        </div>
    </div>
    </div>
    @endforeach

    @foreach ($jamaah as $item)
    <!-- Modal -->
    <div class="modal fade" id="modalFoto{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Foto Jamaah</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img src="{{ asset('storage/foto_pegawai/'.$item->foto) }}" class="img-fluid">
            </div>
            </div>
        </div>
    </div>
    @endforeach

@endsection