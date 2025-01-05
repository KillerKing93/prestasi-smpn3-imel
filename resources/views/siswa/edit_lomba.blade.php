@extends('layouts_siswa')
@section('title', 'Edit Lomba')

@section('content')
<div class="container-fluid" id="container-wrapper">
    <div class="text-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Perlombaan</h1>
    </div>

    <div class="row justify-content-center">
        <div class="col-xl-8 col-lg-8 col-md-9">
            <div class="card mb-4">
                <div class="p-4">
                    <div class="card-body">
                        <form class="row g-4" action="{{ route('siswa.lomba.update', ['id_lomba' => $lomba->id_lomba]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- Nama Lomba -->
                            <div class="col-12">
                                <label for="namelomba" class="form-label">Nama Lomba</label>
                                <input type="text" name="lomba" value="{{ $lomba->lomba }}" class="form-control">
                            </div>

                            <!-- Kelas -->
                            <div class="col-12">
                                <label for="kelas" class="form-label">Kelas</label>
                                <select class="form-control" name="kelas">
                                    <option selected>{{ $lomba->kelas }}</option>
                                    <option value="Kelas 7">Kelas 7</option>
                                    <option value="Kelas 8">Kelas 8</option>
                                    <option value="Kelas 9">Kelas 9</option>
                                </select>
                            </div>

                            <!-- Penyelenggara -->
                            <div class="col-12">
                                <label for="penyelenggara" class="form-label">Penyelenggara</label>
                                <input type="text" name="penyelenggara" value="{{ $lomba->penyelenggara }}" class="form-control">
                            </div>

                            <!-- Tingkatan -->
                            <div class="col-12">
                                <label for="tingkat" class="form-label">Tingkatan</label>
                                <select class="form-control" name="tingkat">
                                    <option selected>{{ $lomba->tingkat }}</option>
                                    <option value="Desa">Desa/Lurah</option>
                                    <option value="Kecamatan">Kecamatan</option>
                                    <option value="Kota/Kabupaten">Kota/Kabupaten</option>
                                    <option value="Provinsi">Provinsi</option>
                                    <option value="Nasional">Nasional</option>
                                    <option value="Internasional">Internasional</option>
                                </select>
                            </div>

                            <!-- Tanggal -->
                            <div class="col-lg-6">
                                <label for="date" class="form-label">Tanggal</label>
                                <input type="date" name="date" value="{{ $lomba->tanggal }}" id="date" class="form-control">
                            </div>

                            <!-- Upload Sertifikat -->
                            <div class="col-12">
                                <label for="formFile" class="form-label">Upload Sertifikat</label>
                                <input type="file" name="sertifikat" class="form-control @error('sertifikat') is-invalid @enderror" id="sertifikatFile">
                                <small id="fileName" class="form-text text-muted">
                                    @if($lomba->sertifikat)
                                        {{ basename($lomba->sertifikat) }}
                                    @else
                                        No file selected
                                    @endif
                                </small>
                                @error('sertifikat')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Tombol Kembali dan Simpan -->
                            <div class="d-flex justify-content-start mt-4">
                                <button type="button" class="btn btn-secondary me-2" onclick="window.location.href='/siswa/lomba'">Kembali</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// JavaScript to display the file name after selecting the file
document.getElementById('sertifikatFile').addEventListener('change', function(event) {
    var fileName = event.target.files.length > 0 ? event.target.files[0].name : 'No file selected';
    document.getElementById('fileName').textContent = fileName;
});
</script>

@endsection
