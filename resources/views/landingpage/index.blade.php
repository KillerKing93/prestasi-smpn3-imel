<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Manajemen Prestasi</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{asset('landing/assets/img/3.png')}}" rel="icon">
  <link href="{{asset('landing/assets/img/smp3.png')}}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Poppins:300,400,500,700" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="  {{ asset('landing/assets/vendor/aos/aos.css') }} " rel="stylesheet">
  <link href="{{ asset('landing/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('landing/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('landing/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('landing/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('landing/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
  

  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <link href="{{ asset('landing/assets/css/style.css')}}" rel="stylesheet">

</head>

<body>
    <header id="header" class="fixed-top d-flex align-items-center" style="background-color: #222;">
      <div class="container d-flex justify-content-between align-items-center">
          <a href="/" style="text-align:left; color: #fff;">Manajemen Prestasi</a>
  
          <nav id="navbar" class="navbar">
              <ul>
                  <li><a class="nav-link scrollto active" href="#hero">Beranda</a></li>
                  <li><a class="nav-link scrollto" href="#about">Visi & Misi</a></li>
                  <li><a class="nav-link scrollto" href="#goal">Tujuan</a></li>
                  <li><a class="nav-link scrollto" href="#services">Berita</a></li>
                  <li><a class="nav-link scrollto" href="#portfolio">Prestasi</a></li>
                  <li><a class="nav-link scrollto" href="#contact">Alamat</a></li>
              </ul>
  
              <!-- Menambahkan tombol hamburger -->
              <i class="bi bi-list mobile-nav-toggle"></i>
  
              <!-- Navbar -->
              <nav class="navbar">
                  @auth('siswa')
                      <!-- Tombol Logout untuk Siswa -->
                      <a href="{{ url('keluar') }}"><button type="button" class="btn btn-light ms-3">Logout</button></a>
                      <!-- Tombol Dashboard untuk Siswa -->
                      <a href="/siswa/dashboard">
                          <button type="button" class="btn btn-light"><i class="bi bi-house-door-fill fs-5"></i></button>
                      </a>
                  @elseauth('petugas')
                      <!-- Tombol Logout untuk Petugas -->
                      <a href="{{ url('keluar') }}"><button type="button" class="btn btn-light ms-3">Logout</button></a>
                      <!-- Tombol Dashboard untuk Petugas -->
                      <a href="/petugas/dashboard">
                          <button type="button" class="btn btn-light"><i class="bi bi-house-gear-fill fs-5"></i></button>
                      </a>
                  @else
                      <!-- Dropdown Login tetap di luar hamburger -->
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
            </div>
  </header><!-- End Header -->
  
    <!-- ======= Hero Section ======= -->
    <section id="hero">
      <div class="hero-container" data-aos="zoom-in" data-aos-delay="100">
        <h1>SELAMAT DATANG</h1>
        <h2>SMP NEGERI 03 KOTA BENGKULU</h2>
        <a href="#about" class="btn-get-started">Tentang Kami</a>
      </div>
    </section><!-- End Hero Section -->
  
    <main id="main">
  
      <!-- ======= About Section ======= -->
      <section id="about">
        <div class="container" data-aos="fade-up">
          <div class="row about-container">
  
              <div class="container-fluid bg-dark py-5 bg-header" style="margin-bottom: 1px;">
                  <div class="row py-5">
                      <div class="col-12 pt-lg-5 mt-lg-5 text-center">
                          <h1 class="display-4 text-white animated zoomIn">Visi dan Misi</h1>
                          <a href="" class="h5 text-white">SMPN 03</a>
                          <a href="" class="h5 text-white">Kota Bengkulu</a>
                      </div>
                  </div>
              </div>
              </div>
              <!-- Navbar End -->
              
              <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
              <div class="container py-5">
                  <div class="row g-5">
                      <div class="col-lg-12">
                          <h1 class="fw-bold text-dark text-uppercase">Visi</h1>
                          <p style="text-align: justify;">Terwujudnya peserta didik Religius, Berbudi Pekerti Luhur, Bermutu dan Berwawasan Global</p>
                          <hr style="border: 5px solid #1F1717">
                          <h1 class="fw-bold text-dark text-uppercase">Misi</h1>
                          <div style="text-align: justify;">
                            <p>1. Menanamkan keimanan dan ketaqwaan melalui pengamalan ajaran agama.</p>
                            <p>2. Meningkatkan karakter religius melalui pembiasaan do' a bersama sebelum memulai dan mengakhiri pembelajaran, Tadarus Pagi, sholat Dhuha dan Sholat Dzuhur berjamaah.</p>
                            <p>3. Membekali Peserta Didik untuk Mahir dalam Berbahasa Inggris.</p>
                            <p>4. Melaksanakan berbagai kegiatan Olahraga dan Seni.</p>
                            <p>5. Mengembangkan kompetensi akademik dan non akademik melalui literasi digital.</p>
                            <p>6. Mengembangkan bidang ilmu pengetahuan dan teknologi berdasarkan minat, bakat, dan potensi peserta didik.</p>
                            <p>7. Meningkatkan kemampuan siswa yang berwawasan global.</p>
                            <p>8. Mewujudkan kesadaran warga sekolah untuk melestarikan lingkungan sekolah.</p>
                            <p>9. Menciptakan peserta didik yang berkarakter dan bertanggung jawab.</p>
                            <p>10. Membina dan Menumbuhkan Budaya disiplin berkarakter.</p>
                            <p>11. Menciptakan manajemen administrasi yang profesional.</p>
                          </div>                   
                      </div>
                  </div>
              </div>
              </div>
              
            <div class="col-lg-6 background order-lg-2 order-1" data-aos="fade-left" data-aos-delay="100"></div>
          </div>
  
        </div>
      </section><!-- End About Section -->
  
      <!-- ======= Goal Section ======= -->
      <section id="goal">
        <div class="container" data-aos="fade-up">
          <div class="row about-container">
  
              <div class="container-fluid bg-dark py-5 bg-header" style="margin-bottom: 1px;">
                  <div class="row py-5">
                      <div class="col-12 pt-lg-5 mt-lg-5 text-center">
                          <h1 class="display-4 text-white animated zoomIn">Tujuan</h1>
                          <a href="" class="h5 text-white">SMPN 03</a>
                          <a href="" class="h5 text-white">Kota Bengkulu</a>
                      </div>
                  </div>
              </div>
              </div>
              <!-- Navbar End -->
              
              <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
              <div class="container py-5">
                  <div class="row g-5">
                      <div class="col-lg-12">
                          <h1 class="fw-bold text-dark text-uppercase">Tujuan</h1>
                          <div style="text-align: justify;">
                            <p>1. Tercapainya budaya sekolah yang religius melalui kegiatan keagamaan.</p>
                            <p>2. Tercapainya berbagai kegiatan dalam proses belajar di kelas berbasis pendidikan karakter bangsa.</p>
                            <p>3. Tercapainya pengembangan inovasi pembelajaran sesuai tuntutan.</p>
                            <p>4. Terwujudnya peserta didik yang mahir berbahasa inggris.</p>
                            <p>5. Tercapainya karakter berpikir Secara Logis, Kritis, Kreatif, Inovatif Dalam Memecahkan Masalah, Serta Berkomunikasi Melalui Berbagai Media khususnya TIK.</p>
                            <p>6. Tercapainya prestasi akademik dan non akdemik siswa sesuai bakat dan minatnya.</p>
                            <p>7. Terbentuknya siswa yang berkualitas yang memiliki wawasan global sesuai dengan tuntunan dunia global.</p>
                            <p>8. Tercapainya peserta didik yang peduli dalam mencegahan pencemaran, mencegahan kerusakan lingkungan dan melestarikan lingkungan hidup.</p>
                            <p>9. Tercapainya sikap yang mampu berkontribusi pada kehidupan bermasyarakat, berbangsa, bemegara dalam peradaban dunia.</p>
                            <p>10. Terbentuknya sikap rasa memiliki untuk bersama membina sekolah.</p>
                            <p>11. Tercapainya pengelolaan pendidikan yang professional.</p>
                          </div>                   
                      </div>
                  </div>
              </div>
              </div>
        
            <div class="col-lg-6 background order-lg-2 order-1" data-aos="fade-left" data-aos-delay="100"></div>
          </div>
  
        </div>
      </section><!-- End Goal Section -->
  
      <!-- ======= Services Section ======= -->
      <section id="services">
        <div class="container" data-aos="fade-up">
          <div class="container-fluid bg-dark py-5 bg-header" style="margin-bottom: 90px;">
              <div class="row py-5">
                  <div class="col-12 pt-lg-5 mt-lg-5 text-center">
                      <h1 class="display-4 text-white animated zoomIn">Berita Prestasi</h1>
                      <a href="" class="h5 text-white">SMPN 03</a>
                      <a href="" class="h5 text-white">Kota Bengkulu</a>
                  </div>
              </div>
          </div>
      </div>
      <!-- Navbar End -->
  
      <div class="container-fluid py-3">
              <div class="row g-5 col-md-6-center">
                @if ($berita->count())
                <div class="col-md-12 mb-3 text-center berita-pertama">
                  <img src="{{ asset($berita[0]->photo) }}" alt="..." class="card-img-top img-fluid">
                  <div class="card-body">
                      <h5 class="card-title">{{ $berita[0]->title }}</h5>
                      <p class="card-text">{{ $berita[0]->deskripsi }}</p>
                      
                          @if ($berita[0]->created_at)
                          <div class="timestamp-container">
                            <small class="text-muted berita-timestamp">{{ $berita[0]->created_at->diffForHumans() }}</small>
                          </div>                      
                          @else
                              <small class="text-muted">Tanggal tidak tersedia</small>
                          @endif                 
                      <a href="berita/{{ $berita[0]->id_berita }}" class="btn btn-primary">Baca Selengkapnya</a>
                      <p class="mb-4"></p>
                    </div>
              <!-- </div>-->
            @else
                <div class="text-center">
                    <p>Tidak Ada Berita Ditemukan</p>
                </div>
            @endif
            <br>
              <div class="container berita-lain">
                <div class="row">
                    @foreach ($berita->skip(1) as $item)
                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                <img src="{{ asset($item->photo ?? 'default-image.jpg') }}" class="card-img-top" alt="{{ $item->title }}">
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title">{{ $item->title }}</h5>
                                    <p class="card-text text-center">
                                      {{ Str::limit(strip_tags($item->deskripsi), 100, '...') }}
                                  </p>
                                    <p class="card-text text-end mt-auto">
                                        <small class="text-muted">
                                            {{ $item->created_at->diffForHumans() }}
                                        </small>
                                    </p>
                                    <a href="{{ url('berita/' . $item->id_berita) }}" class="btn btn-primary">Baca Selengkapnya</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>          
                <div class="d-flex justify-content-center mt-3">
                    {{ $berita->links() }}
                </div>
            </div>
        </div>
      </section><!-- End  Section -->
  
      <!-- ======= Portfolio Section ======= -->
      <section id="portfolio" class="portfolio">
        <div class="container" data-aos="fade-up">
          <div class="container-fluid bg-dark py-5 bg-header" style="margin-bottom: 90px;">
              <div class="row py-5">
                  <div class="col-12 pt-lg-5 mt-lg-5 text-center">
                      <h1 class="display-4 text-white animated zoomIn">Prestasi Siswa</h1>
                      <a href="" class="h5 text-white">SMPN 03</a>
                      <a href="" class="h5 text-white">Kota Bengkulu</a>
                  </div>
              </div>
          </div>
      </div>
      <!-- Navbar End -->
  
       <div class="container-fluid">
          <div class="text-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">Prestasi Siswa SMPN 03 Kota Bengkulu</h1>
          </div>
  
         <div class="row">
           <div class="col-lg-12">
             <div class="card mb-4">
               <div class="table-responsive p-3">
                @if ($kejuaraan->count())
                  <a href="{{ route('prestasi.cetak') }}" target="blank" class="btn btn-primary mb-3">
                    Cetak Prestasi <i class="fa-solid fa-print"></i>
                  </a>              
                @else
                @endif
  
               <table class="table table-bordered dataTable" id="tabel">
                <thead class="table-primary">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">NISN</th>
                    <th scope="col">Kelas</th>
                    <th scope="col">Prestasi</th>
                    <th scope="col">Nama Lomba</th>
                    <th scope="col">Penyelenggara</th>
                    <th scope="col">Tingkat</th>
                    <th scope="col">Tanggal</th>
                    
                  </tr>
                </thead>
                <tbody>
                  @foreach ($kejuaraan as $item)
                  <tr>
                    <th scope="row">{{ $loop->index + 1 }}</th>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->nisn }}</td>
                    <td>{{ $item->kelas }}</td>
                    <td>{{ $item->juara }}</td>
                    <td>{{ $item->lomba }}</td>
                    <td>{{ $item->penyelenggara }}</td>
                    <td>{{ $item->tingkat }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}</td>
                    
                    @endforeach
                  </tr>
                </tbody>
              </table>
              </div>
             </div>
           </div>
            </div>
          </div>
  
  
          </form>
          </div>
        </div>
  
        <script>
          function myFunction() {
            // onlick agar button tidak menjadi undefined ketika di tekan
            //open().print() membuka view kemudian print
            document.getElementById("pdf").onclick = open('cetak').print();
          }
        </script>
  
        </div>
      </section><!-- End Portfolio Section -->
  
      <!-- ======= Contact Section ======= -->
      <section id="contact">
        <div class="container">
          <div class="section-header">
            <h3 class="section-title">Alamat</h3>
            <p class="section-description">JL. Iskandar, No. 474, Tengah Padang, Kec. Tlk. Segara, Kota Bengkulu, Bengkulu 38114</p>
          </div>
        </div>
  
        <div class="text-center">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3981.143019730303!2d102.260819!3d-3.7904346!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e36b0262b5b1e71%3A0xa7aec3721c7533c6!2sSMP%20Negeri%203%20Bengkulu!5e0!3m2!1sid!2sid!4v1697310387700!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
         </div>
  </div>
</section><!-- End Goal Section -->
      <!-- ======= Footer ======= -->
      <footer id="footer" style="background: #222; color: #fff; text-align: center; padding: 10px 0;">
        <p>&copy; 2024 SMPN 03 Kota Bengkulu. All Rights Reserved.</p>
        <p></p>
      </footer>
      <!-- End Footer -->
  
      <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  
    <!-- Vendor JS Files -->
    <script src="  {{asset('landing/assets/vendor/purecounter/purecounter_vanilla.js')}}"></script>
    <script src="{{asset('landing/assets/vendor/aos/aos.js')}}"></script>
    <script src="{{asset('landing/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('landing/assets/vendor/glightbox/js/glightbox.min.js')}}"></script>
    <script src="{{asset('landing/assets/vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>
    <script src="{{asset('landing/assets/vendor/swiper/swiper-bundle.min.js')}}"></script>
    <script src="{{asset('landing/assets/vendor/php-email-form/validate.js')}}"></script>
  
    <!-- Template Main JS File -->
    <script src=" {{asset('landing/assets/js/main.js')}}"></script>
   <!-- Tambahkan jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  
    <!-- Tambahkan DataTables -->
  
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <script>
      $(document).ready(function() {
          $('#tabel').DataTable({
              "paging": true,      
              "lengthChange": true, 
              "searching": true,  
              "ordering": true,    
              "info": false,       
              "autoWidth": false,   
              "lengthMenu": [5, 10, 20, 30], 
          });
      });
    </script>
  
  </body>
  
</html>