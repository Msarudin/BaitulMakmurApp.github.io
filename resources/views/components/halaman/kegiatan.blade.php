<!doctype html>
<html lang="en">

<head>
  <title>mjbmakmur_APP</title>
  <x-halaman.meta />
</head>

    <body class="index-page" style="padding-top: 100px !important;">
    <x-halaman.header />

        <div class="container my-5">
        <div class="row justify-content-center">
            <!-- Menyamakan lebar kontainer dengan kartu artikel di atas (col-lg-9) -->
            <div class="col-12 col-lg-9">
                    <!-- Card Utama Sambutan -->
                    <div class="card shadow-sm border rounded-3 p-4 p-md-5 bg-white">
                        
                        <!-- Judul Sambutan -->
                        <h2 class="fw-bold text-dark h3 mb-4 border-bottom pb-3 text-center font-bs">Kegiatan PHBI Masjid Jami' Baitul Makmur</h2>
                        
                        <!-- Grid Sistem untuk membagi Kiri (Foto) dan Kanan (Teks) -->
                        <div class="clearfix text-secondary lh-lg fs-6" style="text-align: justify;">
        
                        <!-- Sisi Kiri: Foto Ketua DKM dengan teknik Float -->
                        <div id="carouselMasjid" class="carousel slide rounded shadow" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active" data-bs-interval="3000">
                                    <img src="{{ asset('template/assets/img/event1.jpg') }}" class="d-block w-100" style="height: 400px; object-fit: cover;" alt="Masjid Jami Baitul Makmur" />
                                </div>
                                <div class="carousel-item" data-bs-interval="3000">
                                    <img src="{{ asset('template/assets/img/event2.jpg') }}"  class="d-block w-100" style="height: 400px; object-fit: cover;" alt="Masjid Jami Baitul Makmur" />
                                </div>
                                <div class="carousel-item" data-bs-interval="3000">
                                    <img src="{{ asset('template/assets/img/event3.jpg') }}" class="d-block w-100" style="height: 400px; object-fit: cover;" alt="Masjid Jami Baitul Makmur" />
                                </div>
                            </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselMasjid" data-bs-slide="prev" style="opacity: 0.7;">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>

                        <button class="carousel-control-next" type="button" data-bs-target="#carouselMasjid" data-bs-slide="next" style="opacity: 0.7;">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                        </div>
                        
                        <!-- Konten Teks Sambutan -->                        
                        <p class="mb-0 py-3">
                            <em>"Assalamualaikum Warahmatullahi Wabarakatuh."</em>
                        </p>
                        <p class="mb-3">
                            Puji syukur kita panjatkan ke hadirat Allah SWT karena atas rahmat-Nya kita dapat menyambut Peringatan Hari Besar Islam (PHBI) tahun ini dengan penuh rasa syukur. Shalawat serta salam semoga senantiasa tercurah kepada junjungan kita, Nabi Besar Muhammad SAW.
                        </p>
                        <p>
                            Kami, atas nama panitia, mengucapkan selamat datang di website resmi kegiatan PHBI. Melalui sarana digital ini, kami mengajak seluruh kaum muslimin dan muslimat untuk berpartisipasi aktif memeriahkan berbagai rangkaian acara yang telah kami siapkan.
                        </p>
                        <p>
                            Mari jadikan momentum hari besar Islam ini untuk mempererat tali silaturahmi, meningkatkan iman dan takwa, serta meneladani akhlak mulia Rasulullah SAW dalam kehidupan sehari-hari.
                        </p>
                        <p>
                            Silakan jelajahi informasi jadwal, ketentuan, dan pendaftaran kegiatan pada menu di website ini. Kehadiran dan partisipasi Anda adalah kebahagiaan serta dukungan besar bagi suksesnya acara ini.
                        </p>
                        <p class="mb-0">
                            <em>
                                Wabillahi taufiq wal hidayah,<br>
                                Wassalamu’alaikum Warahmatullahi Wabarakatuh.
                            </em>
                        </p>
                    </div>
                </div>                      
            </div>
        </div>
    </div>
    <div class="container my-3 py-5">
        <div class="row justify-content-center">
                <!-- Membatasi lebar leaderboard agar pas di tengah -->
                <div class="col-12 col-md-10 col-lg-8">  
                    <h2 class="fw-bold text-dark h3 mb-4 border-bottom pb-3 text-center font-bs">Jadwal Kegiatan PHBI Masjid Jami' Baitul Makmur</h2>
                    <!-- Wadah Utama Leaderboard (Card Melengkung dengan Garis Hijau di Bawah) -->
                    <div class="card shadow border-0 rounded-3 overflow-hidden bg-white" style="border-bottom: 5px solid #6a7ce3 !important;">      
                        <!-- 1. HEADER UTAMA (Latar Belakang Hijau Toska Penuh) -->
                        <div class="row py-3 text-center fw-bold text-white m-0" style="background-color: #6a7ce3; font-size: 0.95rem;">
                            <div class="col-2">No</div>
                            <div class="col-4">Acara PHBI</div>
                            <div class="col-3">Waktu</div>
                            <div class="col-3">Jam</div>
                        </div>
                        <!-- 2. BARIS DATA 1 (Domenic - Latar Putih Bersih) -->
                        <div class="row py-3 text-center align-items-center border-bottom border-light-subtle m-0 fw-bold" style="font-size: 0.9rem; background-color: #f3f3f3; color: #009879;">
                            <div class="col-2">1</div>
                            <div class="col-4">Maulid Nabi Muhammad SAW</div>
                            <div class="col-3">Tentatif</div>
                            <div class="col-3">Tentatif</div>
                        </div>                        
                        <!-- 3. BARIS DATA 2 (Sally - Highlight Latar Abu-abu & Teks Hijau) -->
                        <!-- Menggunakan background #f3f3f3 dan teks warna #009879 -->
                        <div class="row py-3 text-center align-items-center border-bottom border-light-subtle m-0 fw-bold" style="font-size: 0.9rem; background-color: #f3f3f3; color: #009879;">
                            <div class="col-2">2</div>
                            <div class="col-4">Peringatan Isra Mi'raj</div>
                            <div class="col-3">Tentatif</div>
                            <div class="col-3">Tentatif</div>
                        </div>
                        <div class="row py-3 text-center align-items-center border-bottom border-light-subtle m-0 fw-bold" style="font-size: 0.9rem; background-color: #f3f3f3; color: #009879;">
                            <div class="col-2">3</div>
                            <div class="col-4">Peringatan 1 Muharam</div>
                            <div class="col-3">Tentatif</div>
                            <div class="col-3">Tentatif</div>
                        </div>
                        <!-- 4. BARIS DATA 3 (Nick - Latar Putih Bersih) -->
                        <div class="row py-3 text-center align-items-center border-bottom border-light-subtle m-0 fw-bold" style="font-size: 0.9rem; background-color: #f3f3f3; color: #009879;">
                            <div class="col-2">4</div>
                            <div class="col-4">Pawai Obor</div>
                            <div class="col-3">Tentatif</div>
                            <div class="col-3">Tentatif</div>
                        </div>
                    </div> <!-- /card -->                   
                </div>
            </div>
    </div>

    <!-- Footer -->
    <x-halaman.footer />
    <!-- Footer -->

   <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="{{ asset('template/assets') }}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('template/assets') }}/vendor/php-email-form/validate.js"></script>
  <script src="{{ asset('template/assets') }}/vendor/aos/aos.js"></script>
  <script src="{{ asset('template/assets') }}/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="{{ asset('template/assets') }}/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="{{ asset('template/assets') }}/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="{{ asset('template/assets') }}/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script src="{{ asset('template/assets') }}/vendor/isotope-layout/isotope.pkgd.min.js"></script>

  <!-- Main JS File -->
  <script src="{{ asset('template/assets') }}/js/main.js"></script>
  </body>
</html>
