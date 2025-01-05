@extends('layouts_siswa')
@section('title', 'Manajemen Lomba')

@section('content')
<div class="container-fluid">
    <div class="text-center mb-4">
        <h1 class="h3 mb-0 text-primary">Manajemen Perlombaan</h1>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="table-responsive p-3">
                    <a href="{{ route('siswa.lomba.daftarkan') }}" class="btn btn-success mb-3">
                        Tambah <i class="fa-solid fa-medal"></i>
                    </a>

                    @if (session('sukses'))
                        <div class="alert alert-success">
                            {{ session('sukses') }}
                        </div>
                    @endif

                    <!-- Tabel Lomba -->
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

                                <td class="text-center">
                                    <div class="btn-group">
                                        <a href="{{ asset('sertifikat/' . $item->sertifikat) }}" target="_blank">
                                            <button type="button" class="btn btn-info mx-2">Lihat</button>
                                        </a>     
                                        <a href="{{ route('siswa.lomba.edit', $item->id_lomba) }}" class="btn btn-warning mx-2">Edit</a>
                                        <form action="{{ route('siswa.lomba.delete', $item->id_lomba) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                        </form>
                                    </div>
                                </td>                                
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- End Tabel Lomba -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
