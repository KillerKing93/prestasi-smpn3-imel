@extends('layouts_petugas')
@section('title', 'Manajemen Lomba')

@section('content')

<!-- Card Manajemen Lomba -->
<div class="container-fluid">
  <div class="text-center mb-4">
    <h3 class="text-primary">Manajemen Lomba</h3>
  </div>
  <!-- Tabel Lomba -->
  <div class="row">
    <div class="col-lg-12">
      <div class="card mb-4">
        <div class="table-responsive p-3">
          <a href="/add_lomba" button type="button" class="btn btn-success mb-3">Tambah</button>
            <i class="fa-solid fa-medal"></i>
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
                <th scope="col">Nama</th>
                <th scope="col">NISN</th>
                <th scope="col">Kelas</th>
                <th scope="col">Nama Lomba</th>
                <th scope="col">Penyelenggara</th>
                <th scope="col">Tingkat</th>
                <th scope="col">Tanggal</th>
                <th scope="col">Status</th>
                <th scope="col" class="text-center">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($lomba as $item)
                <tr>
                  <th scope="row">{{ $loop->index + 1 }}</th>
                  <td>{{ $item->nama }}</td>
                  <td>{{ $item->nisn }}</td>
                  <td>{{ $item->kelas }}</td>
                  <td>{{ $item->lomba }}</td>
                  <td>{{ $item->penyelenggara }}</td>
                  <td>{{ $item->tingkat }}</td>
                  <td>{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}</td>
                 
                  <td id="status{{ $item->id_lomba }}">
                    @if($item->status == 0)
                      <button type="button" class="btn btn-success mr-2" data-bs-toggle="modal" data-bs-target="#konfirmasiModal{{ $item->id_lomba }}">
                        <i class="fas fa-check"></i>
                      </button>
                    @else
                      <p>Disetujui✅</p>
                    @endif
                  </td>                  

                  <td>
                    <div class="btn-group">
                      <a href="{{ asset('sertifikat/' . $item->sertifikat) }}" target="_blank">
                        <button type="button" class="btn btn-info mx-2">Lihat</button>
                    </a>                                                                        
                      <a href="/edit_lomba/{{ $item->id_lomba }}">
                          <button type="button" class="btn btn-warning mx-2">Edit</button>
                      </a>
                      <a href="lomba/delete/{{ $item->id_lomba }}">
                          <button type="button" class="btn btn-danger">Hapus</button>
                      </a>
                    </div>
                  </td>
                </tr>

                <!-- Modal untuk konfirmasi -->
                <div class="modal fade" id="konfirmasiModal{{ $item->id_lomba }}" tabindex="-1" aria-labelledby="konfirmasiModalLabel{{ $item->id_lomba }}" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="konfirmasiModalLabel{{ $item->id_lomba }}">Apakah Anda yakin ingin mengkonfirmasi lomba berikut sebagai prestasi?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <form class="row g-3" action="{{ route('konfirmasi_lomba', ['id_lomba' => $item->id_lomba]) }}" method="POST" enctype="multipart/form-data">
                          @csrf
                          @method('PUT')
                          <!-- Input Perolehan Prestasi -->
                          <div class="col-12 mb-3">
                            <label for="namelomba" class="form-label">Perolehan Prestasi</label>
                            <input type="text" name="juara" class="form-control" placeholder="Masukkan Perolehan Prestasi" required>
                          </div>
                          <p class="text-warning">Tindakan ini tidak dapat dibatalkan.</p>
                          
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit"  class="btn btn-success">Konfirmasi</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>           
</div>
<!-- End Card Manajemen Lomba -->
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    // Menangani pengiriman form secara AJAX
    $('form').on('submit', function(e) {
      e.preventDefault();  

      var form = $(this);
      var actionUrl = form.attr('action');  // Ambil URL aksi dari form
      var formData = new FormData(this);  // Ambil data form

      $.ajax({
        url: actionUrl,
        type: form.attr('method'),  
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          // Jika berhasil, sembunyikan modal dan perbarui status lomba
          if (response.status === 'success') {
            $('#konfirmasiModal' + response.id_lomba).modal('hide');
            $('#status' + response.id_lomba).html('<p>Disetujui✅</p>');
            alert('Perolehan prestasi berhasil diperbarui!');
          } else {
            alert('Terjadi kesalahan saat mengkonfirmasi lomba.');
          }
        },
        error: function() {
          alert('Terjadi kesalahan saat mengirim permintaan.');
        }
      });
    });
  });
</script>
@endsection
