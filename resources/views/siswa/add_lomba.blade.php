@extends('layouts_siswa')
@section('title', 'Daftarkan Perlombaan')

@section('content')
<div class="container-fluid" id="container-wrapper">
    <div class="text-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Daftarkan Perlombaan</h1>
    </div>

    <div class="row justify-content-center">
        <div class="col-xl-8 col-lg-8 col-md-9">
            <div class="card mb-4">
                <div class="p-4">
                    <div class="card-body">
                        <form class="row g-4" action="{{ route('siswa.lomba.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <!-- Input Nama Lomba -->
                            <div class="col-12">
                                <label class="form-label">Nama Lomba</label>
                                <input type="text" name="lomba" class="form-control @error('lomba') is-invalid @enderror" value="{{ old('lomba') }}">
                                @error('lomba')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Select Kelas -->
                            <div class="col-md-12">
                                <label class="form-label">Kelas</label>
                                <select name="kelas" class="form-control @error('kelas') is-invalid @enderror">
                                    <option value="">Pilih Kelas</option>
                                    <option value="Kelas 7" @if(old('kelas') == 'Kelas 7') selected @endif>Kelas 7</option>
                                    <option value="Kelas 8" @if(old('kelas') == 'Kelas 8') selected @endif>Kelas 8</option>
                                    <option value="Kelas 9" @if(old('kelas') == 'Kelas 9') selected @endif>Kelas 9</option>
                                </select>
                                @error('kelas')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Input Penyelenggara -->
                            <div class="col-md-12">
                                <label class="form-label">Penyelenggara</label>
                                <input type="text" name="penyelenggara" class="form-control @error('penyelenggara') is-invalid @enderror" value="{{ old('penyelenggara') }}">
                                @error('penyelenggara')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Select Tingkatan -->
                            <div class="col-md-12">
                                <label class="form-label">Tingkatan</label>
                                <select class="form-control @error('tingkat') is-invalid @enderror" name="tingkat">
                                    <option value="">Pilih Tingkatan</option>
                                    <option value="Desa" @if(old('tingkat') == 'Desa') selected @endif>Desa/Lurah</option>
                                    <option value="Kecamatan" @if(old('tingkat') == 'Kecamatan') selected @endif>Kecamatan</option>
                                    <option value="Kota/Kabupaten" @if(old('tingkat') == 'Kota/Kabupaten') selected @endif>Kota/Kabupaten</option>
                                    <option value="Provinsi" @if(old('tingkat') == 'Provinsi') selected @endif>Provinsi</option>
                                    <option value="Nasional" @if(old('tingkat') == 'Nasional') selected @endif>Nasional</option>
                                    <option value="Internasional" @if(old('tingkat') == 'Internasional') selected @endif>Internasional</option>
                                </select>
                                @error('tingkat')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Input Tanggal -->
                            <div class="col-md-6">
                                <label class="form-label">Tanggal</label>
                                <input type="date" name="date" value="{{ old('date') }}" class="form-control @error('date') is-invalid @enderror">
                                @error('date')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Upload Sertifikat -->
                            <div class="col-md-12">
                                <label class="form-label">Upload Sertifikat</label>
                                <input type="file" name="sertifikat" class="form-control @error('sertifikat') is-invalid @enderror">
                                @error('sertifikat')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Buttons -->
                            <div class="d-flex justify-content-start mt-4">
                                <button type="button" class="btn btn-secondary me-2" onclick="window.location.href='/siswa/lomba'">
                                    Kembali
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
