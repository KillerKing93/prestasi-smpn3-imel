@extends('layouts_petugas')
@section('title', 'Edit Prestasi')

@section('content')

<div class="container-fluid" id="container-wrapper">
    <div class="text-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Prestasi</h1>
    </div>
    <div class="row mb-3">
        <!-- Form Edit Prestasi -->
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 mb-4">
                    <div class="card">
                        <div class="card-header">
                            <form class="row g-4" action="{{ route('petugas_update_prestasi', ['id_prestasi' => $kejuaraan->id_prestasi]) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-6">
                                    <label class="form-label">NISN</label>
                                    <input type="text" name="nisn" class="form-control @error('nisn') is-invalid @enderror" value="{{ old('nisn',$kejuaraan->nisn) }}">
                                    @error('nisn')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Nama</label>
                                    <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama',$kejuaraan->nama) }}">
                                    @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Kelas</label>
                                    <select name="kelas" class="form-control @error('kelas') is-invalid @enderror">
                                        <option value="{{ old('kelas', $kejuaraan->kelas) }}">{{ old('kelas', $kejuaraan->kelas) }}</option>
                                        <option value="Kelas 7" @if(old('kelas') == 'Kelas 7') selected @endif>Kelas 7</option>
                                        <option value="Kelas 8" @if(old('kelas') == 'Kelas 8') selected @endif>Kelas 8</option>
                                        <option value="Kelas 9" @if(old('kelas') == 'Kelas 9') selected @endif>Kelas 9</option>
                                    </select>
                                    @error('kelas')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Perolehan Prestasi</label>
                                    <input type="text" name="juara" class="form-control @error('juara') is-invalid @enderror" value="{{ old('juara',$kejuaraan->juara) }}">
                                    @error('juara')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Nama Lomba</label>
                                    <input type="text" name="lomba" class="form-control @error('lomba') is-invalid @enderror" value="{{ old('lomba',$kejuaraan->lomba) }}">
                                    @error('lomba')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Penyelenggara</label>
                                    <input type="text" name="penyelenggara" class="form-control @error('penyelenggara') is-invalid @enderror" value="{{ old('penyelenggara', $kejuaraan->penyelenggara) }}">
                                    @error('penyelenggara')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Tingkatan</label>
                                    <select name="tingkat" class="form-control @error('tingkat') is-invalid @enderror">
                                        <option value="{{ old('tingkat', $kejuaraan->tingkat) }}">{{ old('tingkat', $kejuaraan->tingkat) }}</option>
                                        <option value="Desa/Lurah" @if(old('tingkat') == 'Desa/Lurah') selected @endif>Desa/Lurah</option>
                                        <option value="Kecamatan" @if(old('tingkat') == 'Kecamatan') selected @endif>Kecamatan</option>
                                        <option value="Kota/Kabupaten" @if(old('tingkat') == 'Kota/Kabupaten') selected @endif>Kota/Kabupaten</option>
                                        <option value="Provinsi" @if(old('tingkat') == 'Provinsi') selected @endif>Provinsi</option>
                                        <option value="Nasional" @if(old('tingkat') == 'Nasional') selected @endif>Nasional</option>
                                        <option value="Internasional" @if(old('tingkat') == 'Internasional') selected @endif>Internasional</option>
                                    </select>
                                    @error('tingkat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="date">Tanggal</label>
                                    <input type="date" name="date" value="{{ old('date', $kejuaraan->tanggal) }}" id="date" class="form-control @error('date') is-invalid @enderror">
                                    @error('date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label for="formFile" class="form-label">Upload Sertifikat Kejuaraan</label>
                                    <input type="file" name="sertifikat" class="form-control @error('sertifikat') is-invalid @enderror" id="sertifikatFile">
                                    <small id="fileName" class="form-text text-muted">
                                        @if($kejuaraan->sertifikat)
                                            {{ basename($kejuaraan->sertifikat) }}
                                        @else
                                            No file selected
                                        @endif
                                    </small>
                                    @error('sertifikat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="d-flex justify-content-start mb-2">
                                    <button type="button" class="btn btn-secondary me-2" onclick="window.location.href='/prestasi'">Kembali</button>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
