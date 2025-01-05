@extends('layouts_siswa')
@section('title', 'Profil')

  @section('content')
        <div class="container-fluid">
          <div class="text-center mb-4">
            <h1 class="h3 mb-0 text-primary">Profil</h1>
          </div>

          <div class="row justify-content-center">
            <div class=" col-xl-8 col-lg-8 col-md-9">
              <div class="card mb-4">
                  @if (session('sukses'))
                    <div class="alert alert-success">
                        {{ session('sukses') }}
                    </div>
                  @endif
                  @if(Auth::guard('siswa')->check() && Auth::guard('siswa')->user()->profil != 0)
                  <div class="d-flex justify-content-center">
                      <image x="0" y="0" height="100%" preserveAspectRatio="xMidYMid slice" width="100%" src="{{ asset(Auth::guard('siswa')->user()->profil) }}" style="height: 168px; width: 168px;"></image>
                  </div>
                  @else
                  <div class="d-flex justify-content-center">
                      <image x="0" y="0" height="100%" preserveAspectRatio="xMidYMid slice" width="100%" src="{{ asset('img/icon.png') }}" style="height: 168px; width: 168px;"></image>
                  </div>
                  @endif                  
                    
                  <form action="{{ route('siswa.update_profil', ['nisn' => $data->nisn]) }}" method="POST" enctype="multipart/form-data">
                  @csrf
                    <div class="text-center">
                      <label for="formFile" class="form-label">Ganti Foto Profil</label>
                    </div>
                  
                    <div class="d-flex justify-content-center mb-4" style="margin-left: 215px;">
                      <input class="form" name="profil" type="file" id="formFile">
                    </div>
                    

                    <div class="container">
                      <div class="row g-3">
                        <div class="col-md-12 mb-3">
                          <div class="ms-3 me-3">
                            <label  class="form-label">Nama</label>
                            <input type="text" name="nama" class="form-control mb-3" value="{{ $data->nama}}">
                          </div>
                            

                            <div class="form-group ms-3 me-3">
                              <label>Email</label>
                              <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                              value="{{ $data->email }}">
                                @error('email')
                                <div class="invalid-feedback">
                                  {{ $message }}
                                </div>
                                @enderror    
                            </div>

                            <div class="form-group ms-3 me-3">
                              <label>Jenis Kelamin</label>
                                  <select name="gender" class="form-control">
                                    <option>{{ $data->gender }}</option>
                                    <option value="Laki-Laki" @if(old('gender') == 'Laki-Laki') selected @endif>Laki-Laki</option>
                                    <option value="Perempuan" @if(old('gender') == 'Perempuan') selected @endif>Perempuan</option>
                                  </select>
                                  @error('gender')
                                  <div class="invalid-feedback">
                                    {{ $message }}
                                  </div>
                                  @enderror                              
                            </div>

                            <div class="form-group ms-3 me-3">
                              <label>Username</label>
                              <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" 
                              value="{{ $data->username }}">
                                @error('email')
                                <div class="invalid-feedback">
                                  {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group ms-3 me-3">
                              <label>Password</label>
                              <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" 
                              value="">
                                @error('email')
                                <div class="invalid-feedback">
                                  {{ $message }}
                                </div>
                                @enderror
                            </div>
                            
                            <div class="d-flex justify-content-start mb-2">
                              <button type="button" class="btn btn-secondary me-2" onclick="window.location.href='/siswa/dashboard'">
                                  Kembali
                              </button>
                              <button class="btn btn-primary">Simpan</button>
                              </button>
                            </div>
                        </div>
                      </div>  
                    </div>
                </form>

              </div>
            </div>
          </div>                                
                                                 
  @endsection