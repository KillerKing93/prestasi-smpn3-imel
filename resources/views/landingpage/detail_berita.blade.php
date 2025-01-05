<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Manajemen Prestasi</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset('landing/assets/img/favicon.png') }}" rel="icon">
  <link href="{{ asset('landing/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Poppins:300,400,500,700" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('landing/assets/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('landing/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('landing/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('landing/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('landing/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('landing/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset('landing/assets/css/style.css') }}" rel="stylesheet">

  <style>
    .mobile-nav-toggle {
      color: #fff;
      font-size: 28px;
      cursor: pointer;
      display: none;
      line-height: 0;
      transition: 0.5s;
    }

    @media (max-width: 991px) {
      .mobile-nav-toggle {
        display: block;
      }

      .navbar ul {
        display: none;
      }

      .navbar ul.active {
        display: block;
      }
    }
  </style>
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center header-transparent">
    <div class="container d-flex justify-content-between align-items-center">
      <a href="/" style="text-align:left; color: #fff;">Manajemen Prestasi</a>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto" href="/#hero">Beranda</a></li>
          <li><a class="nav-link scrollto" href="/#about">Visi & Misi</a></li>
          <li><a class="nav-link scrollto" href="/#goal">Tujuan</a></li>
          <li><a class="nav-link scrollto active" href="/#services">Berita</a></li>
          <li><a class="nav-link scrollto" href="/#portfolio">Prestasi</a></li>
          <li><a class="nav-link scrollto" href="/#contact">Alamat</a></li>
        </ul>

        <!-- Menambahkan tombol hamburger -->
        <i class="bi bi-list mobile-nav-toggle"></i>
        <!-- Navbar -->
        <nav class="navbar">
          @auth('siswa')
              <a href="{{ url('keluar') }}"><button type="button" class="btn btn-light ms-3">Logout</button></a>
              <a href="/siswa/dashboard">
                  <button type="button" class="btn btn-light"><i class="bi bi-house-door-fill fs-5"></i></button>
              </a>
          @elseauth('petugas')
              <a href="{{ url('keluar') }}"><button type="button" class="btn btn-light ms-3">Logout</button></a>
              <a href="/petugas/dashboard">
                  <button type="button" class="btn btn-light"><i class="bi bi-house-gear-fill fs-5"></i></button>
              </a>
          @else
              <div class="nav-item dropdown ms-3">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Login
                  </a>
                  <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a href="{{ route('siswa.login') }}" class="dropdown-item" style="color: #6c757d; transition: color 0.3s ease;" onmouseover="this.style.color='rgb(67, 94, 190)'" onmouseout="this.style.color='#6c757d'">Siswa</a>
                    <a href="{{ route('petugas.login') }}" class="dropdown-item" style="color: #6c757d; transition: color 0.3s ease;" onmouseover="this.style.color='rgb(67, 94, 190)'" onmouseout="this.style.color='#6c757d'">Petugas</a>
                  </ul>
              </div>
          @endauth
      </nav>
      </nav>
    </div>
  </header>

  <div class="container-fluid bg-dark py-5 bg-header" style="margin-bottom: 90px;">
    <div class="row py-5">
      <div class="col-12 pt-lg-5 mt-lg-5 text-center">
        <h1 class="display-4 text-white animated zoomIn">Berita Prestasi</h1>
        <a href="" class="h5 text-white">SMPN 03</a>
        <a href="" class="h5 text-white">Kota Bengkulu</a>
      </div>
    </div>
  </div>

  <div class="container-fluid py-6">
    <div class="container py-6">
      <div class="row g-5 col-md-6-center">
        <h2 id="berita-title" class="card-title text-center">{{ $berita->title }}</h2>
        <!-- Gambar Berita -->
        <div class="image-container">
          <img src="{{ asset($berita->photo) }}" class="card-img-top img-fluid" alt="...">
        </div>
        <div class="card-body">
          <div>
            <h4 class="card-text">{{ $berita->deskripsi }}</h4>
          </div>
          <p class="card-text text-end"><small class="text-muted">
              @if($berita->created_at)
                {{ $berita->created_at->diffForHumans() }}
              @else
                Tanggal tidak tersedia
              @endif
          </small></p>
          <p></p>
          <p style="text-align: justify;">{{ $berita->body }}</p>
        </div>
      </div>
    </div>
  </div>

  <!-- Vendor JS Files -->
  <script src="{{ asset('landing/assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
  <script src="{{ asset('landing/assets/vendor/aos/aos.js') }}"></script>
  <script src="{{ asset('landing/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('landing/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset('landing/assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
  <script src="{{ asset('landing/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
  <script src="{{ asset('landing/assets/vendor/php-email-form/validate.js') }}"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('landing/assets/js/main.js') }}"></script>

  <!-- JavaScript untuk Toggle Menu Navbar -->
  <script>
    document.querySelector('.mobile-nav-toggle').addEventListener('click', function() {
      const navbar = document.querySelector('.navbar ul');
      navbar.classList.toggle('active'); 
    });
  </script>

</body>

</html>
