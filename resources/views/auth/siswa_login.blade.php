@extends('auth.layouts')

@section('title', 'Halaman Login Siswa')

@push('style')
<style>
    .text-wrap {
    background: linear-gradient(135deg, rgb(67, 94, 190) 0%, rgb(50, 72, 139) 100%);
    padding: 20px;
    border-radius: 8px;
    color: white;
    }

    .btn.btn-primary {
    background: rgb(67, 94, 190); 
    border: 1px solid rgb(67, 94, 190); 
    color: #fff; 
    }

    .btn.btn-primary:hover {
    background: rgb(50, 72, 139); 
    border: 1px solid rgb(50, 72, 139); 
    }
</style>
@endpush

@section('content')
<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-10">
                <div class="wrap d-md-flex">
                    <div class="text-wrap p-4 p-lg-5 text-center d-flex align-items-center order-md-last">
                        <div class="text w-100">
                            <a href="/">
                                <h2>Manajemen Prestasi</h2>
                            </a>
                            <p>Belum punya akun?</p>
                            <!-- Tombol Register mengarah ke route register siswa -->
                            <a href="{{ route('siswa.register') }}">
                                <button type="button" class="btn btn-light ms-3">Register</button>
                            </a>                            
                        </div>
                    </div>
                    <div class="login-wrap p-4 p-lg-5">
                            {{-- Menampilkan pesan sukses atau error --}}
                            @if (session('sukses'))
                            <div class="alert alert-success">
                                {{ session('sukses') }}
                            </div>
                            @endif

                            @if (session('eror'))
                            <div class="alert alert-danger">
                                {{ session('eror') }}
                            </div>
                            @endif
                        <div class="d-flex">
                            <div class="w-100">
                                <h3 class="mb-4">Login</h3>
                            </div>
                        </div>
                        <form action="{{ route('siswa.login') }}" method="POST">
                            @csrf
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            @if (session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif
                            <div class="form-group mb-3">
                                <label class="label" for="username">Username</label>
                                <input type="text" name="username" value="{{ old('username') }}"
                                    class="form-control @error('username') is-invalid @enderror" placeholder="Username" required>
                                @error('username')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label class="label" for="password">Password</label>
                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" required>
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button type="submit" class="form-control btn btn-primary submit px-3">Login</button>
                            </div>
                            <div class="form-group d-md-flex">
                                <div class="text-left">
                                    <!-- Tautan forgot password yang akan memunculkan modal -->
                                    <a href="#" id="forgotPasswordLink" data-bs-toggle="modal" data-bs-target="#forgotPasswordModal">Lupa Password?</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal untuk Forgot Password -->
<div class="modal fade" id="forgotPasswordModal" tabindex="-1" aria-labelledby="forgotPasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header"> </div>
            <div class="modal-body">
                <p>Hubungi petugas untuk bantuan reset password melalui:</p>
                <ul>
                    <li>Email: <a href="mailto:petugas_SMPN03@gmail.com">petugas_smpn03@gmail.com</a></li>
                    <li>WhatsApp: <a href="https://wa.me/082185216796" target="_blank">082185216796</a></li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('head_scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
@endpush

@push('scripts')


@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@endpush
