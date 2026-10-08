<!doctype html>
<html lang="en">

<head>
  <title>mjbmakmur_APP</title>
  <x-halaman.meta />
</head>

    <body class="index-page" style="padding-top: 100px !important;">
    <x-halaman.header />

    <!-- Qurban -->
    <div class="container my-5">    
        <div class="row justify-content-center">
            <!-- Menyamakan lebar kontainer dengan kartu artikel di atas (col-lg-9) -->
            <div class="col-12 col-lg-9">
                    <!-- Card Utama Sambutan -->
                    <div class="card shadow-sm border rounded-3 p-4 p-md-5 bg-white">
                        
                        <!-- Judul Sambutan -->
                        <h2 class="fw-bold text-dark h3 mb-4 border-bottom pb-3 text-center font-bs">Program Tabungan Qurban </h2>
                        
                        <!-- Grid Sistem untuk membagi Kiri (Foto) dan Kanan (Teks) -->
                        <div class="clearfix text-secondary lh-lg fs-6" style="text-align: justify;">
        
                            <div class="float-md-start me-md-4 mb-4 mb-md-2 text-center text-md-start w-100 col-md-5 overflow-hidden rounded-3 border">
                                <img src="{{ asset('template/assets/img/qurban.jpeg') }}" class="w-100 h-auto d-block" style="object-fit: cover;" alt="Brosur Qurban">
                            </div>
                            <p class="mb-0 py-3">
                            <em>"Assalamualaikum Warahmatullahi Wabarakatuh."</em>
                            </p>
                            <p class="mb-3">
                                Rencanakan ibadah qurban Anda dengan lebih mudah dan berkah. Masjid Jami' Baitul Makmur menghadirkan program Tabungan Qurban untuk memfasilitasi niat suci Bapak/Ibu dalam berderma. Pembayaran dapat dilakukan secara berkala setiap bulan disesuaikan dengan kemampuan. Mari wujudkan kepedulian bagi sesama sejak dini. Informasi & pendaftaran silakan hubungi panitia.
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
                    <h2 class="fw-bold text-dark h3 mb-4 border-bottom pb-3 text-center font-bs">Kontak Panitia Qurban</h2>  
                    <!-- Wadah Utama Leaderboard (Card Melengkung dengan Garis Hijau di Bawah) -->
                    <div class="card shadow border-0 rounded-3 overflow-hidden bg-white" style="border-bottom: 5px solid #6a7ce3 !important;">      
                        <!-- 1. HEADER UTAMA (Latar Belakang Hijau Toska Penuh) -->
                        <div class="row py-3 text-center fw-bold text-white m-0" style="background-color: #6a7ce3; font-size: 0.95rem;">
                            <div class="col-3">No</div>
                            <div class="col-3">Nama</div>
                            <div class="col-3">Jabatan</div>
                            <div class="col-3">No Tlp</div>
                        </div>
                        <!-- 2. BARIS DATA 1 (Domenic - Latar Putih Bersih) -->
                        <div class="row py-3 text-center align-items-center border-bottom border-light-subtle m-0 fw-bold" style="font-size: 0.9rem; background-color: #f3f3f3; color: #009879;">
                            <div class="col-3">1</div>
                            <div class="col-3">Ustdz Yanwar Fahri</div>
                            <div class="col-3">Ketua DKM</div>
                            <div class="col-3">0856 9491 6754</div>
                        </div>                        
                        <!-- 3. BARIS DATA 2 (Sally - Highlight Latar Abu-abu & Teks Hijau) -->
                        <!-- Menggunakan background #f3f3f3 dan teks warna #009879 -->
                        <div class="row py-3 text-center align-items-center border-bottom border-light-subtle m-0 fw-bold" style="font-size: 0.9rem; background-color: #f3f3f3; color: #009879;">
                            <div class="col-3">2</div>
                            <div class="col-3">Ustdz M. Subur</div>
                            <div class="col-3">Bendahara 1</div>
                            <div class="col-3">0812 9027 7892</div>
                        </div>
                        <!-- 4. BARIS DATA 3 (Nick - Latar Putih Bersih) -->
                        <div class="row py-3 text-center align-items-center border-bottom border-light-subtle m-0 fw-bold" style="font-size: 0.9rem; background-color: #f3f3f3; color: #009879;">
                            <div class="col-3">3</div>
                            <div class="col-3">Bapak Rw Dian Wijaya</div>
                            <div class="col-3">Bendahara 2</div>
                            <div class="col-3">0838 7502 3253</div>
                        </div>
                    </div> <!-- /card -->                   
                </div>
            </div>
        </div>
    <!-- Qurban -->

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
