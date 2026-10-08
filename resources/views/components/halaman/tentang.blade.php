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
            <!-- Membatasi lebar artikel agar nyaman dibaca di layar lebar -->
            <div class="col-12 col-lg-9">
                
                <!-- Card Utama Artikel -->
                <div class="card shadow-sm border rounded-3 p-4 p-md-5 bg-white">
                    
                    <!-- 1. Bagian Judul Utama -->
                    <h2 class="fw-bold text-dark h3 mb-4 border-bottom pb-3 text-center font-bs">Tentang Masjid Jami' Baitul Makmur</h1>
                    
                    <!-- 2. Bagian Meta Data (Penulis, Kategori, Tanggal) -->
                    <div class="d-flex flex-wrap justify-content-between align-items-center border-bottom pb-3 mb-4 text-muted small"></div>

                    <!-- 3. Bagian Gambar Utama (Logo / Foto) -->
                    <div class="col-lg-12 p-0 mb-3 overflow-hidden"> 
                        <!-- INDUK CAROUSEL UTAMA -->
                        <div id="carouselMasjid" class="carousel slide rounded shadow" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active" data-bs-interval="3000">
                            <img src="{{ asset('template/assets/img/logo2.png') }}" class="d-block w-100" style="height: 550px; object-fit: contain;" alt="Masjid Jami Baitul Makmur" />
                            </div>
                            <div class="carousel-item" data-bs-interval="3000">
                            <img src="{{ asset('template/assets/img/masjid2.jpg') }}" class="d-block w-100" style="height: 550px; object-fit: contain;" alt="Masjid Jami Baitul Makmur" />
                            </div>
                            <div class="carousel-item" data-bs-interval="3000">
                            <img src="{{ asset('template/assets/img/halaman1.jpeg') }}" class="d-block w-100" style="height: 550px; object-fit: contain;" alt="Masjid Jami Baitul Makmur" />
                            </div>
                            <div class="carousel-item" data-bs-interval="3000">
                            <img src="{{ asset('template/assets/img/halaman2.jpeg') }}" class="d-block w-100" style="height: 550px; object-fit: contain;" alt="Masjid Jami Baitul Makmur" />
                            </div>
                            <div class="carousel-item" data-bs-interval="3000">
                            <img src="{{ asset('template/assets/img/halaman.jpeg') }}" class="d-block w-100" style="height: 550px; object-fit: contain;" alt="Masjid Jami Baitul Makmur" />
                            </div>
                        </div>

                        <!-- PERBAIKAN: Tombol Navigasi dipindahkan ke SINI (Sebelum penutup #carouselMasjid) -->
                        <!-- Tombol Navigasi Manual Kiri -->
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselMasjid" data-bs-slide="prev" style="opacity: 0.7;">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>

                        <!-- Tombol Navigasi Manual Kanan -->
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselMasjid" data-bs-slide="next" style="opacity: 0.7;">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                        
                        </div> <!-- Penutup #carouselMasjid -->
                    </div> <!-- Penutup Kolom Gambar -->

                    <!-- 5. Bagian Isi Teks Artikel -->
                    <div class="article-content text-secondary lh-lg fs-6" style="text-align: justify;">
                        <p class="mb-3">
                            <span class="fw-bold text-dark">Masjid Jami' Baitul Makmur</span> Adalah Masjid yang terletak di Kp. Bojong Jl. KH. Mas Mansyur Rt 03 Rw 15 Kelurahan Kunciran Indah, Kecamatan Pinang, Kota Tangerang, Banten. Berfungsi sebagai pusat ibadah salat lima waktu dan salat Jumat bagi warga sekitar Kp. Bojong dan sekitarnya menjadi pusat kegiatan keagamaan, sosial, dan kemasyarakatan lokal di wilayah Pinang, Kota Tangerang.
                            Masjid Jami' Baitul Makmur telah menjadi bagian penting dari kehidupan religius dan sosial masyarakat setempat selama puluhan tahun. Masjid ini berdiri di atas tanah wakaf seluas 1.500 m² dengan luas bangunan sekitar 1.000 m², sehingga mampu menampung jamaah dalam jumlah besar untuk berbagai aktivitas ibadah dan keagamaan.
                            Selain digunakan untuk salat lima waktu dan salat Jumat, Masjid Jami' Baitul Makmur juga berperan sebagai pusat aktivitas ibadah dan keagamaan lainnya yang mendukung penguatan nilai-nilai keislaman di lingkungan sekitar. Seperti pengajian Bapak-bapak setiap selasa malam, rutinitas pengajian IRMA jum'at malam dan Ibu-ibu pada Jum'at siang dan pengajian bulanan.
                            masjid ini memiliki kondisi bangunan yang bersih serta area halaman atau fasilitas parkir yang dinilai cukup memadai dan lumayan luas untuk kegiatan warga sekitar.
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
                    <h2 class="fw-bold text-dark h3 mb-4 border-bottom pb-3 text-center font-bs">Lokasi Masjid Jami' Baitul Makmur</h2>
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
                                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126919.71349621458!2d106.61598215099349!3d-6.231921305823302!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69fa2c4ac4585b%3A0xadcfef8c5779a291!2sMasjid%20Jami'%20Baitul%20Makmur!5e0!3m2!1sid!2sid!4v1789754416793!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="strict-origin-when-cross-origin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="strict-origin-when-cross-origin">
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
