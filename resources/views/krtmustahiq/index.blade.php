@extends('layouts.indexAdmin')

@section('content')
<div class="card">
    <div class="card-header">
        <!-- Mengubah judul agar sesuai dengan konteks Kriteria Mustahiq -->
        <h4 class="card-title">Data Kriteria Mustahiq</h4>
    </div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kriteria</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
                <!-- Mengubah variabel dari $ktrmustahiqs menjadi $mustahiqs agar sesuai dengan Controller -->
                @foreach ($ktrmustahiqs as $index => $ktrmustahiq)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $ktrmustahiq->nama_ktrmustahik }}</td>
                    <td>
                        <!-- Tempat untuk tombol Aksi di kemudian hari (Edit/Delete) -->
                        <span class="badge bg-success">No Action</span>
                    </td>
                </tr>
                 @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
