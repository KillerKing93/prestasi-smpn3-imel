@extends('auth.layouts')

@section('title', 'Halaman Register')

@push('style')
<style>
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
            <div class="col-md-12 col-lg-6">
                <div class="wrap">
                    <div class="d-flex ml-2">
                        <div class="w-100 text-center">
                            <h3 class="mb-4 ml-2">Register</h3>
                        </div>
                    </div>

                    {{-- Form Registrasi --}}
                    <form action="{{ route('proses_register') }}" class="signin-form ml-3 mr-3" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- NISN --}}
                        <div class="form-group">
                            <label class="label" for="nisn">NISN</label>
                            <input type="text" name="nisn"
                                class="form-control @error('nisn') is-invalid @enderror"
                                value="{{ old('nisn') }}" placeholder="NISN" required>
                            @error('nisn')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Nama --}}
                        <div class="form-group">
                            <label class="label" for="nama">Nama</label>
                            <input type="text" name="nama"
                                class="form-control @error('nama') is-invalid @enderror"
                                value="{{ old('nama') }}" placeholder="Nama Lengkap" required>
                            @error('nama')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Kelas --}}
                        <div class="form-group">
                            <label class="label" for="kelas">Kelas</label>
                            <select name="kelas"
                                class="form-control @error('kelas') is-invalid @enderror" required>
                                <option value="">Pilih Kelas</option>
                                <option value="Kelas 7"
                                    @if (old('kelas') == 'Kelas 7') selected @endif>Kelas 7</option>
                                <option value="Kelas 8"
                                    @if (old('kelas') == 'Kelas 8') selected @endif>Kelas 8</option>
                                <option value="Kelas 9"
                                    @if (old('kelas') == 'Kelas 9') selected @endif>Kelas 9</option>
                            </select>
                            @error('kelas')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Gender --}}
                        <div class="form-group">
                            <label class="label" for="gender">Jenis Kelamin</label>
                            <select name="gender"
                                class="form-control @error('gender') is-invalid @enderror" required>
                                <option value="">Pilih</option>
                                <option value="Laki-Laki"
                                    @if (old('gender') == 'Laki-Laki') selected @endif>Laki-Laki</option>
                                <option value="Perempuan"
                                    @if (old('gender') == 'Perempuan') selected @endif>Perempuan</option>
                            </select>
                            @error('gender')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Username --}}
                        <div class="form-group">
                            <label class="label" for="username">Username</label>
                            <input type="text" name="username"
                                class="form-control @error('username') is-invalid @enderror"
                                value="{{ old('username') }}" placeholder="Username" required>
                            @error('username')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div class="form-group">
                            <label class="label" for="email">Email</label>
                            <input type="email" name="email"
                                class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email') }}" placeholder="Email" required>
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Password --}}
                        <div class="form-group">
                            <label class="label" for="password">Password</label>
                            <input type="password" name="password"
                                class="form-control @error('password') is-invalid @enderror"
                                placeholder="Password" required>
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        {{-- Submit --}}
                        <div class="form-group">
                            <button type="submit" class="form-control btn btn-primary submit px-3">Daftar</button>
                        </div>
                        
                        {{-- Link to Login --}}
                        <div class="form-group">
                            <a href="/siswa/login"><button type="button"
                                    class="form-control btn btn-primary submit px-3 mb-3">Sudah punya akun? Masuk</button></a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
