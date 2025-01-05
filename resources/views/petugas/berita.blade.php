@extends('layouts_petugas')
@section('title', 'Manajemen Berita')

  @section('content')

      <!-- Card Manajemen Lomba -->
        <div class="container-fluid">
          <div class="text-center mb-4">
            <h3 class="text-primary">Manajemen Berita</h3>
          </div>
          <!-- Tabel Lomba -->
          <div class="row">
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="table-responsive p-3">
                  <a href="/add_berita"button type="button" class="btn btn-success mb-3">Tambah</button>
                    <i class="fa-solid fa-newspaper"></i>
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
                      <th scope="col">Judul</th>
                      <th scope="col">Deskripsi Berita</th>
                      <th scope="col" class="text-center">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach ($berita as $index => $berita)
                    <tr>
                      <th scope="row">{{ $index + 1 }}</th>
                      <td>{{ $berita->title }}</td>
                      <td>{{ $berita->deskripsi }}</td>
                      <td>
                        <div class="btn-group d-flex justify-content-center">
                          <a>
                            <button type="button" data-toggle="modal" 
                              data-target="#modalDeskripsi_{{ $berita->id_berita }}" class="btn btn-primary mr-2">
                            Lihat
                            </button>
                          </a>
                          <a href="/edit_berita/{{ $berita->id_berita }}"><button type="button" class="btn btn-warning mx-2">Edit</button></a>
                          <a href="berita/delete/{{ $berita->id_berita }}"><button type="button" class="btn btn-danger">Hapus</button></a>
                        </div>
                      </td>

                      <!-- Modal Scrollable -->
                      <div class="modal fade" id="modalDeskripsi_{{ $berita->id_berita }}">
                        <div class="modal-dialog modal-dialog-scrollable">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title">Deskripsi</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <h5 class="font-weight-bold">{{ $berita->title }}</h5>
                              <p class="text-justify">{{ $berita->body }}</p>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- End Modal Scrollable -->

                  @endforeach 
                    </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <!-- End Tabel Lomba -->            
        </div>
      <!-- End Card Manajemen Lomba -->

              

  @endsection
