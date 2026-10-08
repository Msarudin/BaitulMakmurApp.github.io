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
                        <h2 class="fw-bold text-dark h3 mb-4 border-bottom pb-3 text-center font-bs">Kegiatan Latihan Dasar Kepemimpinan dan Taddabur Alam Irma Masjid' Jami Baitul Makmur</h2>
                        
                        <!-- Grid Sistem untuk membagi Kiri (Foto) dan Kanan (Teks) -->
                        <div class="clearfix text-secondary lh-lg fs-6" style="text-align: justify;">
        
                        <!-- Sisi Kiri: Foto Ketua DKM dengan teknik Float -->
                        <div id="carouselMasjid" class="carousel slide rounded shadow" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active" data-bs-interval="3000">
                                    <img src="{{ asset('template/assets/img/tadabur.jpg') }}" class="d-block w-100" style="height: 400px; object-fit: cover;" alt="Masjid Jami Baitul Makmur" />
                                </div>
                                <div class="carousel-item" data-bs-interval="3000">
                                    <img src="{{ asset('template/assets/img/tadabur1.jpg') }}" class="d-block w-100" style="height: 400px; object-fit: cover;" alt="Masjid Jami Baitul Makmur" />
                                </div>
                                <div class="carousel-item" data-bs-interval="3000">
                                    <img src="{{ asset('template/assets/img/tadabur2.jpg') }}" class="d-block w-100" style="height: 400px; object-fit: cover;" alt="Masjid Jami Baitul Makmur" />
                                </div>
                                <div class="carousel-item" data-bs-interval="3000">
                                    <img src="{{ asset('template/assets/img/tadabur3.jpg') }}" class="d-block w-100" style="height: 400px; object-fit: cover;" alt="Masjid Jami Baitul Makmur" />
                                </div>
                                <div class="carousel-item" data-bs-interval="3000">
                                    <img src="{{ asset('template/assets/img/tadabur4.jpg') }}" class="d-block w-100" style="height: 400px; object-fit: cover;" alt="Masjid Jami Baitul Makmur" />
                                </div>
                                <div class="carousel-item" data-bs-interval="3000">
                                    <img src="{{ asset('template/assets/img/tadabur5.jpg') }}" class="d-block w-100" style="height: 400px; object-fit: cover;" alt="Masjid Jami Baitul Makmur" />
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
                            Puji syukur marilah kita panjatkan ke hadirat Allah SWT, karena atas rahmat dan karunia-Nya, kegiatan Latihan Dasar Kepemimpinan (LDK) IRMA ini dapat terlaksana dengan baik. Shalawat serta salam semoga senantiasa tercurah limpahkan kepada junjungan kita Nabi Muhammad SAW
                        </p>
                        <p>
                            Kami mengucapkan selamat datang kepada seluruh peserta LDK IRMA di platform digital/website resmi kami. Kegiatan ini dirancang khusus untuk membekali para pengurus dan anggota remaja masjid dengan nilai-nilai kepemimpinan yang berlandaskan Islam, berintegritas, disiplin, serta bertanggung jawab.
                        </p>
                        <p>
                            Menjadi pemimpin muda di lingkungan masjid bukan hanya tentang mengelola sebuah organisasi. Ini adalah amanah mulia untuk menebar kebaikan, memakmurkan masjid, dan menginspirasi generasi muda Islam agar senantiasa produktif serta berakhlakul karimah.
                        </p>
                        <p>
                            Melalui kegiatan LDK ini, kami berharap para peserta dapat: Memahami dasar-dasar kepemimpinan yang amanah dan visioner. Membangun solidaritas serta kerja sama tim yang kuat antar-anggota. Mengembangkan potensi diri untuk menghadapi tantangan dakwah di era modern.
                        </p>
                        <p>
                            Terima kasih kami ucapkan kepada panitia, pembina, serta seluruh pihak yang telah mendukung terselenggaranya acara dan publikasi melalui website ini. Semoga langkah kecil kita dalam membina generasi pemimpin muda diberkahi oleh Allah SWT.
                        </p>
                        <p>
                            Selamat mengikuti pelatihan. Semoga sukses dan membawa manfaat besar bagi kemajuan IRMA ke depannya.
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
