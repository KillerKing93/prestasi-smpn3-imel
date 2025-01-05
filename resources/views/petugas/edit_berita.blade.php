@extends('layouts_petugas')
@section('title', 'Edit Berita')

@section('content')

<div class="container-fluid">
    <div class="text-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Berita</h1>
    </div>

    <!-- Form Data Berita -->
    <div class="row justify-content-center">
        <div class="col-xl-8 col-lg-8 col-md-9">
            <div class="card mb-4">
                <div class="p-4">
                    <div class="card-body">
                        <form action="/update_berita/{{ $berita->id_berita }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- Input Judul -->
                            <div class="col-12 mb-3">
                                <label class="form-label">Judul</label>
                                <input type="text" name="title" value="{{ $berita->title }}" class="form-control @error('title') is-invalid @enderror" placeholder="Tulis judul">
                                @error('title')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Input Deskripsi -->
                            <div class="col-12 mb-3">
                                <label class="form-label">Deskripsi Berita</label>
                                <input type="text" name="deskripsi" value="{{ $berita->deskripsi }}" class="form-control @error('deskripsi') is-invalid @enderror" placeholder="Tulis deskripsi singkat berita">
                                @error('deskripsi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Input Isi Berita -->
                            <div class="col-12 mb-3">
                                <label class="form-label">Isi Berita</label>
                                <textarea name="body" class="form-control @error('body') is-invalid @enderror" placeholder="Tulis isi berita">{{ $berita->body }}</textarea>
                                @error('body')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Upload Gambar -->
                            <div class="col-lg-12 mb-3">
                                <label for="formFile" class="form-label">Upload File Gambar</label>
                                <input type="file" name="photo" class="form-control @error('photo') is-invalid @enderror" id="formFile">
                                <small id="fileName" class="form-text text-muted">
                                    @if($berita->photo)
                                        {{ basename($berita->photo) }}
                                    @else
                                        No file selected
                                    @endif
                                </small>
                                @error('photo')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Buttons -->
                            <div class="d-flex justify-content-start mt-4">
                                <button type="button" class="btn btn-secondary me-2" onclick="window.location.href='/berita'">
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
