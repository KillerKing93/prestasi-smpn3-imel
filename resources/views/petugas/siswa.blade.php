@extends('layouts_petugas')
@section('title', 'Manajemen Siswa')

@section('content')
<div class="container-fluid">
  <div class="text-center mb-4">
    <h3 class="text-primary">Manajemen Siswa</h3>
  </div>

  <!-- Tabel Siswa -->
  <div class="row">
    <div class="col-lg-12">
      <div class="card mb-4">
        <div class="table-responsive p-3">
          <a href="/add_siswa" button type="button" class="btn btn-success mb-3">
            Tambah <i class="fa-solid fa-user-plus"></i>
          </a>
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
                <th scope="col">Email</th>
                <th scope="col">Username</th>
                <th scope="col">Jenis Kelamin</th>
                <th scope="col" class="text-center">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($siswa as $index => $item)
                <tr>
                  <th scope="row">{{ $index + 1 }}</th>
                  <td>{{ $item->nisn }}</td>
                  <td>{{ $item->nama }}</td>
                  <td>{{ $item->kelas }}</td>
                  <td>{{ $item->email }}</td>
                  <td>{{ $item->username }}</td>
                  <td>{{ $item->gender }}</td>
                  <td>
                    <div class="d-flex justify-content-center">
                      <div class="btn-group">
                        <a href="/edit_siswa/{{ $item->nisn }}" class="btn btn-warning mr-2">Edit</a>
                        <button type="button" class="btn btn-danger mx-2" 
                          data-toggle="modal" data-target="#deleteSiswa{{ $item->nisn }}">
                          Hapus
                        </button>
                      </div>
                    </div>                        
                  </td>

                  <!-- Modal Hapus Siswa -->
                  <div class="modal fade" id="deleteSiswa{{ $item->nisn }}" tabindex="-1" role="dialog" aria-labelledby="deleteSiswaLabel{{ $item->nisn }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="deleteSiswaLabel{{ $item->nisn }}">Konfirmasi Hapus</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          Anda yakin ingin menghapus siswa <strong>{{ $item->nama }}</strong> dengan NISN <strong>{{ $item->nisn }}</strong>?
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Batal</button>
                          <a href="{{ route('petugas.delete_siswa', $item->nisn) }}" class="btn btn-danger">Hapus</a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- End Modal Hapus Siswa -->

                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <!-- End Tabel Siswa -->
</div>
@endsection
