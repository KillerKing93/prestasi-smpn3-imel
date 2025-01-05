@extends('layouts_petugas')
@section('title', 'Dashboard')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="text-muted font-semibold">Selamat Datang {{ Auth::guard('petugas')->user()->nama ?? 'Petugas' }}</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('petugas.dashboard') }}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">
          <a href="{{ route('petugas.dashboard') }}">Dashboard</a>
        </li>
      </ol>
    </div>

    <!-- Manajemen Card -->
    <div class="row mb-3">
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col mr-2">
                <div class="h5 mb-0 font-weight-bold">
                  <a href="/petugas/siswa" class="text-muted font-semibold" style="text-decoration: none">Manajemen Siswa</a>
                </div>
              </div>
              <div class="col-auto">
                <i class="bi bi-people-fill fa-2x text-primary"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="h5 mb-0 font-weight-bold text-gray-800">
                  <a href="/lomba" class="text-muted font-semibold" style="text-decoration: none">Manajemen Lomba</a>
                </div>
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
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="h5 mb-0 font-weight-bold text-gray-800">
                  <a href="/prestasi" class="text-muted font-semibold" style="text-decoration: none"> Manajemen Prestasi</a>
                </div>
              </div>
              <div class="col-auto">
                <i class="fa-solid fa-trophy fa-2x text-primary"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="h5 mb-0 font-weight-bold">
                  <a href="/berita" class="text-muted font-semibold" style="text-decoration: none"> Manajemen Berita</a>
                </div>
              </div>
              <div class="col-auto">
                <i class="bi bi-newspaper fa-2x text-primary"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- End Manajemen Card -->
  <!-- Row Grafik -->
  <div class="row">
    <!-- Grafik Pie Chart -->
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          <h6 class="m-0 font-weight-bold text-primary">Jumlah Data Lomba dan Prestasi</h6>
        </div>
        <div class="card-body">
          <div class="chart-container">
            <canvas id="myPieChart"></canvas>
          </div>
        </div>
      </div>
    </div>

    <!-- Grafik Bar Chart -->
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          <h6 class="m-0 font-weight-bold text-primary">Data Lomba dan Prestasi Perbulan</h6>
        </div>
        <div class="card-body">
          <div class="chart-container">
            <canvas id="myBarChart"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End Row Grafik -->

  <!-- Script Grafik -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <!-- Grafik Pie Chart -->
  <script>
    const pieCtx = document.getElementById('myPieChart');
    new Chart(pieCtx, {
      type: 'pie',
      data: {
        labels: ['Lomba', 'Prestasi'],
        datasets: [{
          data: [{{ $data_lomba }}, {{ $data_prestasi }}],
          backgroundColor: [
            'rgba(75, 192, 192, 0.2)',
            'rgba(54, 162, 235, 0.2)'
          ],
          borderColor: [
            'rgb(75, 192, 192)',
            'rgb(54, 162, 235)',
          ],
          borderWidth: 2
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: true,
        aspectRatio: 1, // Rasio 1:1 agar ukuran seragam
        layout: {
          padding: 20
        },
        plugins: {
          legend: {
            position: 'top', // Posisi legenda di atas
          }
        }
      }
    });
  </script>

  <!-- Grafik Bar Chart -->
  <script>
    const barCtx = document.getElementById('myBarChart');
    new Chart(barCtx, {
      type: 'bar',
      data: {
        labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
        datasets: [
          {
            label: 'Lomba',
            data: [{{ $lomba_jan }}, {{ $lomba_feb }}, {{ $lomba_maret }}, {{ $lomba_april }}, {{ $lomba_mei }},
                  {{ $lomba_juni }}, {{ $lomba_juli }}, {{ $lomba_agust }}, {{ $lomba_sep }}, {{ $lomba_okt }},
                  {{ $lomba_nov }}, {{ $lomba_des }}],
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgb(75, 192, 192)',
            borderWidth: 2
          },
          {
            label: 'Prestasi',
            data: [{{ $prestasi_jan }}, {{ $prestasi_feb }}, {{ $prestasi_maret }}, {{ $prestasi_april }}, {{ $prestasi_mei }},
                  {{ $prestasi_juni }}, {{ $prestasi_juli }}, {{ $prestasi_agust }}, {{ $prestasi_sep }}, {{ $prestasi_okt }},
                  {{ $prestasi_nov }}, {{ $prestasi_des }}],
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgb(54, 162, 235)',
            borderWidth: 2
          }
        ]
      },
      options: {
        responsive: true,
        maintainAspectRatio: true,
        aspectRatio: 1, // Rasio 1:1 agar ukuran seragam
        scales: {
          y: {
            beginAtZero: true
          }
        },
        plugins: {
          legend: {
            position: 'top', // Posisi legenda di atas
          }
        }
      }
    });
  </script>

@endsection
