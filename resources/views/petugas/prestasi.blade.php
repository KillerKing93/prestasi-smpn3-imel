@extends('layouts_petugas')
@section('title', 'Manajemen Prestasi')

  @section('content')
      <!-- Card Manajamen Prestasi -->
      <div class="container-fluid">
          <div class="text-center mb-4">
            <h3 class="text-primary">Manajemen Prestasi</h3>
          </div>
          <!-- Tabel Prestasi -->
          <div class="row">
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="table-responsive p-3">
                  <a href="/add_prestasi" type="button" class="btn btn-success mb-3">Tambah
                    <i class="fa-solid fa-trophy"></i>
                  </a>
                  @if ($kejuaraan->count())
                  <a href="{{ route('prestasi.cetak') }}" target="_blank" class="btn btn-primary mb-3">Cetak Prestasi
                    <i class="fa-solid fa-print"></i>
                  </a>
                  @else

                  @endif
                  @if (session('sukses'))
                    <div class="alert alert-success">
                        {{ session('sukses') }}
                    </div>
                  @endif
                  <table class="table table-bordered" id="dataTable">
                    <thead class="table-primary">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">NISN</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Kelas</th>
                        <th scope="col">Prestasi</th>
                        <th scope="col">Nama Lomba</th>
                        <th scope="col">Penyelenggara</th>
                        <th scope="col">Tingkat</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col" class="text-center">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($kejuaraan as $item)
                      <tr>
                        <th scope="row">{{ $loop->index + 1 }}</th>
                        <td>{{ $item->nisn }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->kelas }}</td>
                        <td>{{ $item->juara }}</td>
                        <td>{{ $item->lomba }}</td>
                        <td>{{ $item->penyelenggara }}</td>
                        <td>{{ $item->tingkat }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}</td>
                        <td>
                          <div class="btn-group">
                            <a href="{{ asset('sertifikat/' . $item->sertifikat) }}" target="_blank">
                              <button type="button" class="btn btn-info mx-2">Lihat</button>
                           </a> 
                            <a href="/edit_prestasi/{{ $item->id_prestasi }}"><button type="button" class="btn btn-warning mx-2">Edit</button></a>
                            <a href="prestasi/delete/{{ $item->id_prestasi }}"><button type="button" class="btn btn-danger">Hapus</button></a>
                          </div>
                        </td>
                        @endforeach
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

          </div>
          <!-- End Tabel Prestasi-->                     
      </div>
      <!-- End Card Manajamen Prestasi -->

  @endsection

  <script>
    function myFunction() {
      // onlick agar button tidak menjadi undefined ketika di tekan
      // open().print() membuka view kemudian print
      document.getElementById("pdf").onclick = open('download').print();
    }
  </script>
  
</body>
</html>