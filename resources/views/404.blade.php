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
            <div class="col-12 col-lg-9">
                <div class="card shadow-sm border rounded-3 p-4 p-md-5 bg-white">
                <h2 class="fw-bold text-dark h3 mb-4 border-bottom pb-3 text-center font-bs">Halaman tidak ditemukan, silahkan akses halaman ini dengan benar.</h2>
                    <div class="clearfix text-secondary lh-lg fs-6" style="text-align: justify;">
                        <div class="mx-auto mb-4 text-center" style="max-width: 350px;">
                            <img src="{{ asset('template/assets/img/404.png') }}" class="w-100 h-auto d-block" style="object-fit: cover;" alt="Brosur Qurban">
                        </div> 
                        <div class="mx-auto mb-4 text-center" style="max-width: 350px;">
                        <a href="{{ route('home') }}" class="btn btn-success">
                            Silahkan kembali ke Home.
                        </a>
                        </div> 
                    </div>
                </div>
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
