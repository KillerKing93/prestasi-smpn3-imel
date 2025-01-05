@extends('layouts_siswa')
@section('title', 'Dashboard')

@section('content')
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="text-muted font-semibold">Selamat Datang {{ Auth::guard('siswa')->user()->nama ?? 'Siswa' }}</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
        </ol>
    </div>

    <div class="row mb-3">
        <!-- Mahasiswa Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="h5 mb-0 font-weight-bold">
                              <a href="{{ route('siswa.lomba') }}" class="text-muted font-semibold" style="text-decoration: none">Manajemen Perlombaan</a>
                            </div>
                            <div class="mt-2 mb-0 text-muted text-xs"></div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-flag-fill fa-2x text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col mr-2">
                            <div class="h5 mb-0 font-weight-bold">
                                <a href="{{ route('siswa.prestasi') }}" class="text-muted font-semibold" style="text-decoration: none">Perolehan Prestasi</a>
                            </div>
                            <div class="mt-2 mb-0 text-muted text-xs"></div>
                        </div>
                        <div class="col-auto">
                            <i class="fa-solid fa-trophy fa-2x text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
