@extends('layouts.indexAdmin')
@section('content')
<div class="card">

    <div class="card-header">
        <h4 class="card-title">Data User</h4>
    </div>

    <div class="card-body">
        <table class="table table-sm" id="myTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $index => $user)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if($user->role)
                                {{ $user->role->role_name }}
                            @else
                                <span class="text-danger fw-bold">Tanpa Hak Akses</span>
                            @endif
                        </td>
                        <td>
                            <button type="button" class="btn btn-success btn-sm" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#roleModal{{ $user->id }}"
                                    style="background-color: #0b7f63 !important; border-color: #0b7f63 !important; color: #ffffff !important;"
                                    onmouseover="this.style.backgroundColor='#09664f'; this.style.borderColor='#09664f';"
                                    onmouseout="this.style.backgroundColor='#0b7f63'; this.style.borderColor='#0b7f63';">
                                Ganti Role
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@foreach ($users as $user)
    <!-- Modal -->
    <div class="modal fade" id="roleModal{{ $user->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Ganti Role ({{ $user->name }})</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="my-2 text-center text-secondary">Mengganti Role dapat merubah hak akses dari user, klik Ganti Role untuk melanjutkan perintah ini</p>
                <form action="{{ route('users.update-role') }}" method="POST">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                    <div>
                        <label for="role_id" class="fw-bold mb-1">Tentukan Role Akses</label>
                        <select name="role_id" id="role_id" class="form-control">
                            <!-- 1. OPSI TAMBAHAN UNTUK MENGKOSONGKAN / MENGHAPUS ROLE -->
                            <option value="hapus_role" {{ is_null($user->role_id) ? 'selected' : '' }}>
                                -- Kosongkan Hak Akses / Hapus Role --
                            </option>
                            
                            @foreach ($roles as $role)
                                <!-- 2. ATRIBUT SELECTED AGAR OTOMATIS MENAMPILKAN ROLE SAAT INI -->
                                <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>
                                    {{ $role->role_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-success mt-3 w-100"
                                style="background-color: #0b7f63 !important; border-color: #0b7f63 !important; color: #ffffff !important;"
                                onmouseover="this.style.backgroundColor='#09664f'; this.style.borderColor='#09664f';"
                                onmouseout="this.style.backgroundColor='#0b7f63'; this.style.borderColor='#0b7f63';">
                            Simpan Perubahan Role
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
@endforeach
@endsection
