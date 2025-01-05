@extends('auth.layouts')

@section('title', 'Halaman Login Petugas')

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
                        </div>
                    </div>
                    <div class="login-wrap p-4 p-lg-5">
                        <div class="d-flex">
                            <div class="w-100">
                                <h3 class="mb-4">Login</h3>
                            </div>
                        </div>
                        <form action="{{ route('petugas.login') }}" method="POST">
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
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
