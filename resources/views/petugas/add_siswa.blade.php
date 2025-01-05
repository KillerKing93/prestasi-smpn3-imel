@extends('layouts_petugas')
@section('title', 'Tambah Siswa')

@section('content')

<div class="container-fluid">
  <div class="text-center mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tambah Siswa</h1>
  </div>

  <!-- Card Tambah Siswa --> 
  <div class="row justify-content-center">
    <div class=" col-xl-8 col-lg-8 col-md-9">
      <div class="card mb-4">
        <div class="table-responsive p-3">
          <div class="card-body">
            @if (session('sukses'))
              <div class="alert alert-success">
                  {{ session('sukses') }}
              </div>
            @endif

            <form action="{{ route('daftarkan_siswa') }}" method="POST">
              {{ csrf_field() }}
              <!-- NISN Field -->
              <div class="form-group">
                <label>NISN</label>
                <input type="text" name="nisn" class="form-control @error('nisn') is-invalid @enderror" 
                value="{{ old('nisn') }}" placeholder="Nomor Induk Siswa Nasional (NISN)">
                @error('nisn')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
            
              <!-- Nama Field -->
              <div class="form-group">
                <label>Nama</label>
                <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                value="{{ old('nama') }}" placeholder="Nama Lengkap">
                @error('nama')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
            
              <!-- Kelas Field -->
              <div class="form-group">
                <label>Kelas</label>
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
            
              <!-- Select Gender -->
              <div class="input-group col-12 mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text">Jenis Kelamin</label>
                </div>
                <select name="gender" class="form-control @error('gender') is-invalid @enderror">
                  <option value="{{ old('gender', $lomba->gender ?? '') }}">{{ old('gender', $lomba->gender ?? 'Pilih Jenis Kelamin') }}</option>
                  <option value="Laki-Laki" @if(old('gender') == 'Laki-Laki') selected @endif>Laki-Laki</option>
                  <option value="Perempuan" @if(old('gender') == 'Perempuan') selected @endif>Perempuan</option>
              </select>              
                @error('gender')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
              </div>
            
              <!-- Email Field -->
              <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                value="{{ old('email') }}" placeholder="Email">
                @error('email')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
            
              <!-- Username Field -->
              <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" 
                value="{{ old('username') }}" placeholder="Username">
                @error('username')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
            
              <!-- Password Field -->
              <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" 
                placeholder="Password">
                @error('password')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
            
              <div class="d-flex justify-content-start mb-2">
                <button type="button" class="btn btn-secondary me-2" onclick="window.location.href='/petugas/siswa'">
                    Kembali
                </button>
                <button type="submit" class="btn btn-primary">
                    Tambah
                </button>
            </div>
            </form>            
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End Card Tambah Siswa --> 

@endsection
