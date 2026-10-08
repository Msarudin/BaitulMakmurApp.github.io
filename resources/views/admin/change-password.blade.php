@extends('layouts.indexAdmin')

@section('content')
<div class="container-fluid">
    <div class="card p-4">
        <h4 class="mb-4">Ganti Password</h4>

        @if(session('success'))
            <div class="alert alert-success mb-3">
                {{ session('success') }}
            </div>
        @endif

        <form id="formGantiSandiMurni" action="{{ route('admin.password.update') }}" method="POST">
            @csrf
            
            <!-- Input Password Lama -->
            <div class="form-group mb-3">
                <label class="form-label">Password Lama</label>
                <input type="password" name="old_password" class="form-control" required>
                @error('old_password') 
                    <small class="text-danger d-block mt-1">{{ $message }}</small> 
                @enderror
            </div>

            <!-- Input Password Baru -->
            <div class="form-group mb-3">
                <label class="form-label">Password Baru</label>
                <input type="password" name="password" class="form-control" required>
                @error('password') 
                    <small class="text-danger d-block mt-1">{{ $message }}</small> 
                @enderror
            </div>

            <!-- Input Konfirmasi Password -->
            <div class="form-group mb-4">
                <label class="form-label">Konfirmasi Password Baru</label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>

            <button type="button" onclick="window.HTMLFormElement.prototype.submit.call(document.getElementById('formGantiSandiMurni'));" class="btn text-white" style="background-color: #0b7f63; border-radius: 4px; min-width: 150px;">
                Perbarui Password
            </button>
        </form>
    </div>
</div>

@include('sweetalert::alert')
@endsection
