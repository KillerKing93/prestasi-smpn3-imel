@extends('layouts_petugas')
@section('title', 'Edit Lomba')

@section('content')

    <div class="container-fluid">
        <div class="text-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">Edit Lomba</h1>
        </div>

        <!-- Custom CSS -->
        <style>
            .form-container {
                display: grid;
                grid-template-columns: repeat(2, 1fr); /* Dua kolom */
                gap: 15px; /* Jarak antar elemen */
            }

            .form-container .full-width {
                grid-column: span 2; /* Elemen tertentu melebar penuh */
            }

            .form-container .form-control,
            .form-container select {
                height: calc(2.5rem + 2px); /* Konsistensi tinggi input */
            }

            .form-actions {
                margin-top: 20px;
                display: flex;
                gap: 10px;
            }
        </style>

        <!-- Form Edit Lomba -->
        <div class="row justify-content-center">
            <div class="col-xl-8 col-lg-8 col-md-9">
                <div class="card mb-4">
                    <div class="p-3">
                        <div class="card-body">
                            <form class="form-container" action="{{ route('petugas_update_lomba', ['id_lomba' => $lomba->id_lomba]) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <!-- Input Hidden untuk id_petugas -->
                                <input type="hidden" name="id_petugas" value="{{ auth()->user()->id }}">

                                <!-- Nama -->
                                <div>
                                    <label class="form-label">Nama</label>
                                    <input type="text" name="nama" value="{{ old('nama', $lomba->nama) }}" class="form-control @error('nama') is-invalid @enderror">
                                    @error('nama')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <!-- NISN -->
                                <div>
                                    <label class="form-label">NISN</label>
                                    <input type="text" name="nisn" value="{{ old('nisn', $lomba->nisn) }}" class="form-control @error('nisn') is-invalid @enderror">
                                    @error('nisn')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <!-- Kelas -->
                                <div class="full-width">
                                    <label class="form-label">Kelas</label>
                                    <select name="kelas" class="form-control @error('kelas') is-invalid @enderror">
                                        <option value="{{ old('kelas', $lomba->kelas) }}">{{ old('kelas', $lomba->kelas) }}</option>
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

                                <!-- Nama Lomba -->
                                <div class="full-width">
                                    <label for="namelomba" class="form-label">Nama Lomba</label>
                                    <input type="text" name="lomba" value="{{ old('lomba', $lomba->lomba) }}" class="form-control @error('lomba') is-invalid @enderror">
                                    @error('lomba')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <!-- Penyelenggara -->
                                <div class="full-width">
                                    <label for="penyelenggara" class="form-label">Penyelenggara</label>
                                    <input type="text" name="penyelenggara" value="{{ old('penyelenggara', $lomba->penyelenggara) }}" class="form-control @error('penyelenggara') is-invalid @enderror">
                                    @error('penyelenggara')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <!-- Tingkatan -->
                                <div class="full-width">
                                    <label class="form-label">Tingkatan</label>
                                    <select class="form-control @error('tingkat') is-invalid @enderror" name="tingkat">
                                        <option value="{{ old('tingkat', $lomba->tingkat) }}">{{ old('tingkat', $lomba->tingkat) }}</option>
                                        <option value="Desa/Lurah" @if(old('tingkat') == 'Desa/Lurah') selected @endif>Desa/Lurah</option>
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

                                <!-- Tanggal -->
                                <div class="full-width">
                                    <label for="date">Tanggal</label>
                                    <input type="date" name="date" value="{{ old('date', $lomba->tanggal) }}" id="date" class="form-control @error('date') is-invalid @enderror">
                                    @error('date')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <!-- Upload Sertifikat -->
                                <div class="full-width">
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

                                <!-- Buttons -->
                                <div class="form-actions full-width">
                                    <button type="button" class="btn btn-secondary" onclick="window.location.href='/lomba'">
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
        <!-- End Form Edit Lomba -->
    </div>

@endsection
