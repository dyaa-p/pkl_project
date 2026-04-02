@extends('layouts.backend')

@section('content')
<div class="container-fluid">

    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body p-4">

            <h4 class="card-title fw-semibold">Edit Akun</h4>
            <p class="text-muted mb-4">
                Untuk mengedit data akun
            </p>

            <form action="{{ route('backend.siswa.update', $users->id)}}" method="POST">
                @csrf
                @method('put')

                {{-- Nama --}}
                <div class="form-floating mb-4">
                    <input type="text"
                        name="name"
                        class="form-control custom-input @error('name') is-invalid @enderror"
                        placeholder="Nama"
                        value="{{$users->name}}">

                    <label>
                        <i class="ti ti-user me-2"></i>Nama
                    </label>

                    @error('name')
                    <span class="invalid-feedback">
                        {{ $message }}
                    </span>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="form-floating mb-4">
                    <input type="email"
                        name="email"
                        class="form-control custom-input @error('email') is-invalid @enderror"
                        placeholder="Email"
                        value="{{$users->email}}">

                    <label>
                        <i class="ti ti-mail me-2"></i>Email
                    </label>

                    @error('email')
                    <span class="invalid-feedback">
                        {{ $message }}
                    </span>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="form-floating mb-4">
                    <input type="password"
                        name="password"
                        class="form-control custom-input @error('password') is-invalid @enderror"
                        placeholder="Password Baru">

                    <label>
                        <i class="ti ti-lock me-2"></i>Password Baru (Opsional)
                    </label>

                    @error('password')
                    <span class="invalid-feedback">
                        {{ $message }}
                    </span>
                    @enderror
                </div>

                {{-- Konfirmasi Password --}}
                <div class="form-floating mb-4">
                    <input type="password"
                        name="password_confirmation"
                        class="form-control custom-input"
                        placeholder="Konfirmasi Password">

                    <label>
                        <i class="ti ti-lock me-2"></i>Konfirmasi Password
                    </label>
                </div>

                {{-- Button --}}
                <div class="text-end">
                    <button type="submit" class="btn btn-primary px-4 py-2 rounded-3">
                        <i class="ti ti-send me-2"></i>
                        Simpan
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>

{{-- STYLE TAMBAHAN --}}
<style>

.custom-input {
    border-radius: 12px;
    border: 1px solid #e5e7eb;
    transition: 0.3s;
}

.custom-input:focus {
    border-color: #4f46e5;
    box-shadow: 0 0 0 3px rgba(79,70,229,0.15);
}

.card {
    transition: 0.3s;
}

.card:hover {
    transform: translateY(-2px);
}

</style>

@endsection
