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
                        <h2 class="fw-bold text-dark h3 mb-4 border-bottom pb-3 text-center font-bs">Program Pemakaman Jama'ah dan Warga Rw 15</h2>
                        
                        <!-- Grid Sistem untuk membagi Kiri (Foto) dan Kanan (Teks) -->
                        <div class="clearfix text-secondary lh-lg fs-6" style="text-align: justify;">
        
                        <!-- Sisi Kiri: Foto Ketua DKM dengan teknik Float -->
                        <div id="carouselMasjid" class="carousel slide rounded shadow" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active" data-bs-interval="3000">
                                    <!-- Mengganti class 'center' dengan 'mx-auto' agar posisi gambar pas di tengah -->
                                    <img src="{{ asset('template/assets/img/nisan.png') }}" class="d-block w-50 mx-auto" style="height: 400px; object-fit: contain;" alt="" />
                                </div>
                            </div>
                        </div>
                        
                        <!-- Konten Teks Sambutan -->                        
                        <p class="mb-0 py-3">
                            <em>"Assalamualaikum Warahmatullahi Wabarakatuh."</em>
                        </p>
                        <p class="mb-3">
                            Puji syukur senantiasa kita panjatkan ke hadirat Allah SWT, karena atas rahmat dan karunia-nya, kita masih diberikan kesehatan dan kesempatan untuk terus berbuat kebaikan bagi sesama. Shalawat serta salam semoga tercurah limpahkan kepada junjungan kita Nabi Besar Muhammad SAW.
                        </p>
                        <p>
                            Kami menyambut baik dan bersyukur atas program Tanah Wakaf ini. Kehadiran platform digital ini merupakan langkah ikhtiar kami untuk memudahkan para dermawan (wakif) menunaikan amanah wakaf secara transparan, mudah, dan amanah.
                        </p>
                        <p>
                            Tanah wakaf bukan sekadar aset fisik, melainkan jembatan kebaikan yang pahalanya terus mengalir (sedekah jariyah) lintas generasi. Melalui pengelolaan yang produktif dan profesional, setiap jengkal tanah yang diwakafkan akan dioptimalkan untuk kepentingan umat—baik di bidang pendidikan, sosial, keagamaan, maupun pemberdayaan ekonomi masyaraka
                        </p>
                        <p>
                            Kami mengajak seluruh lapisan masyarakat, para dermawan, dan mitra dermawan untuk bersama-sama mendukung program percepatan dan pengamanan aset tanah wakaf ini. Mari kita jadikan harta yang dititipkan Allah sebagai investasi akhirat yang abadi.
                        </p>
                        <p>
                            Terima kasih kepada seluruh pihak yang telah mendukung terwujudnya program dan website ini. Semoga Allah SWT membalas setiap kebaikan bapak, ibu, dan saudara sekalian dengan pahala yang berlipat ganda.
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
                    <h2 class="fw-bold text-dark h3 mb-4 border-bottom pb-3 text-center font-bs">Lokasi Tanah Wakaf</h2>
                    <!-- Wadah Utama Leaderboard (Card Melengkung dengan Garis Hijau di Bawah) -->
                    <div class="card shadow border-0 rounded-3 overflow-hidden bg-white" style="border-bottom: 5px solid #6a7ce3 !important;">      
                        <!-- 1. HEADER UTAMA (Latar Belakang Hijau Toska Penuh) -->
                        <!-- 2. BARIS DATA 1 (Domenic - Latar Putih Bersih) -->
                         <!-- Section Utama dengan Latar Belakang Hijau Gelap Islami -->
                        <section class="py-5" style="background-color: #0b4c37;">
                            <div class="container">
                                <div class="row justify-content-center">
                                    <!-- Menyamakan lebar kontainer dengan komponen Anda lainnya -->
                                    <div class="col-12 col-md-10 col-lg-8">
                                        
                                        <!-- 1. Bagian Judul (Peta Lokasi) dengan Garis Bawah Kuning Emas -->
                                        <div class="mb-4">
                                            <h3 class="fw-bold text-white mb-2 d-inline-block">Peta Lokasi</h3>
                                            <!-- Garis bawah kustom berwarna kuning/emas -->
                                            <div style="width: 80px; height: 3px; background-color: #ffc107;"></div>
                                        </div>

                                        <!-- 2. Kotak Putih Utama Wadah Google Maps -->
                                        <div class="card bg-white border-0 rounded-3 shadow-sm overflow-hidden p-2">
                                            
                                            <!-- Pembungkus Peta agar Responsif (Otomatis menyesuaikan ukuran HP & Laptop) -->
                                            <div class="ratio ratio-21x9 rounded-2 overflow-hidden" style="min-height: 250px;">
                                                <!-- Ganti URL src iframe di bawah dengan tautan embed resmi masjid Anda -->
                                                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d247.95561066534376!2d106.50492777116875!3d-6.091612276483293!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sid!2sid!4v1788788472923!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="strict-origin-when-cross-origin">
                                                    style="border:0;" 
                                                    allowfullscreen="" 
                                                    loading="lazy" 
                                                    referrerpolicy="no-referrer-when-downgrade">
                                                </iframe>
                                            </div>

                                        </div> <!-- /card -->

                                    </div>
                                </div>
                            </div>
                        </section>  
                    </div> <!-- /card -->                   
                </div>
            </div>
        </div>

    <x-halaman.footer />

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
