@extends('layouts.indexAdmin')

@section('content')
<div class="card">
    <div class="card-header">
        <!-- Mengubah judul agar sesuai dengan konteks Kriteria Mustahiq -->
        <h4 class="card-title">Data Kriteria Amal</h4>
    </div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kriteria Amal</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($jenis_amal as $index => $item)
                    <tr>
                        <!-- 1. Kolom Nomor -->
                        <td>{{ $index + 1 }}</td>
                        
                        <!-- 2. Kolom Nama Kriteria Amal -->
                        <td>{{ str_replace('_', ' ', $item->nama_amal) }}</td> 
                        
                        <!-- 3. Kolom Opsi (PERBAIKAN: Ditambah tag pembuka td agar tombol masuk ke dalam tabel dengan rapi) -->
                        <td>
                            <span class="badge bg-success">No Aksi</span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
