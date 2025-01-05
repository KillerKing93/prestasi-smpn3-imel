@extends('layouts_siswa')
@section('title', 'Perolehan Prestasi')

  @section('content')
  
        <div class="container-fluid">
          <div class="text-center mb-4">
            <h1 class="h3 mb-0 text-primary">Perolehan Prestasi</h1>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="table-responsive p-3">
                  @if ($kejuaraan->count())
                  <a href="{{ route('prestasi.cetak') }}" target="_blank" class="btn btn-primary mb-3">Cetak Prestasi
                    <i class="fa-solid fa-print"></i>
                  </a>
                  @else
                @endif
              <!-- Tabel Prestasi -->
              <div class="table-responsive">
              <table class="table table-bordered" id="dataTable">
                    <thead class="table-primary">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">NISN</th>
                        <th scope="col">Kelas</th>
                        <th scope="col">Prestasi</th>
                        <th scope="col">Nama Lomba</th>
                        <th scope="col">Penyelenggara</th>
                        <th scope="col">Tingkat</th>
                        <th scope="col">Tanggal</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($kejuaraan as $item)
                      <tr>
                        <th scope="row">{{ $loop->index + 1 }}</th>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->nisn }}</td>
                        <td>{{ $item->kelas }}</td>
                        <td>{{ $item->juara }}</td>
                        <td>{{ $item->lomba }}</td>
                        <td>{{ $item->penyelenggara }}</td>
                        <td>{{ $item->tingkat }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}</td>
                        @endforeach
                      </tr>
                    </tbody>
                  </table>
                  
              </div>
              <!-- End -->

            </div>
          </div>
        </div>

        <script>
          function myFunction() {
            // onlick agar button tidak menjadi undefined ketika di tekan
            // open().print() membuka view kemudian print
            document.getElementById("pdf").onclick = open('download').print();
          }
        </script>

  @endsection