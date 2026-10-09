
@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Profil Petugas</h2>

    {{-- Informasi user --}}
    <div class="card mb-4">
        <div class="card-body">
            <p>
                <strong>Nama:</strong>
                {{ auth()->user()->name }}
            </p>

            <p>
                <strong>Email:</strong>
                {{ auth()->user()->email }}
            </p>

            <p>
                <strong>Role:</strong>
                {{ auth()->user()->role }}
            </p>
        </div>
    </div>

    {{-- Pesan berhasil --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Pesan error --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form ganti password --}}
    <div class="card">
        <div class="card-body">
            <h4>Ganti Password</h4>

            <form action="{{ route('profil.password') }}"
                  method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="password_lama">
                        Password Lama
                    </label>
                    <input
                        type="password"
                        name="password_lama"
                        id="password_lama"
                        class="form-control"
                        required
                    >
                </div>

                <div class="mb-3">
                    <label for="password_baru">
                        Password Baru
                    </label>
                    <input
                        type="password"
                        name="password_baru"
                        id="password_baru"
                        class="form-control"
                        minlength="8"
                        required
                    >
                </div>

                <div class="mb-3">
                    <label for="password_baru_confirmation">
                        Konfirmasi Password Baru
                    </label>
                    <input
                        type="password"
                        name="password_baru_confirmation"
                        id="password_baru_confirmation"
                        class="form-control"
                        minlength="8"
                        required
                    >
                </div>

                <button type="submit" class="btn btn-primary">
                    Simpan Password Baru
                </button>
            </form>
        </div>
    </div>
</div>
@endsection