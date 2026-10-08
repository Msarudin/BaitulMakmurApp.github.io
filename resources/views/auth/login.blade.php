<!DOCTYPE html>
<html lang="en">
<!-- [Head] start -->

<head>
  <title>Baitul Makmur_APP</title>
  <!-- [Meta] -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="Mantis is made using Bootstrap 5 design framework. Download the free admin template & use it for your project.">
  <meta name="keywords" content="Mantis, Dashboard UI Kit, Bootstrap 5, Admin Template, Admin Dashboard, CRM, CMS, Bootstrap Admin Template">
  <meta name="author" content="CodedThemes">

  <!-- [Favicon] icon -->
<link rel="icon" href="{{ asset('templateAdmin/dist/assets/images/logo-masjid.png?v=999') }}" type="image/png">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap" id="main-font-link">
<!-- [Tabler Icons] https://tablericons.com -->
<link rel="stylesheet" href="{{ asset('templateAdmin/dist') }}/assets/fonts/tabler-icons.min.css" >
<!-- [Feather Icons] https://feathericons.com -->
<link rel="stylesheet" href="{{ asset('templateAdmin/dist') }}/assets/fonts/feather.css" >
<!-- [Font Awesome Icons] https://fontawesome.com/icons -->
<link rel="stylesheet" href="{{ asset('templateAdmin/dist') }}/assets/fonts/fontawesome.css" >
<!-- [Material Icons] https://fonts.google.com/icons -->
<link rel="stylesheet" href="{{ asset('templateAdmin/dist') }}/assets/fonts/material.css" >
<!-- [Template CSS Files] -->
<link rel="stylesheet" href="{{ asset('templateAdmin/dist') }}/assets/css/style.css" id="main-style-link" >
<link rel="stylesheet" href="{{ asset('templateAdmin/dist') }}/assets/css/style-preset.css" >
@vite(['resources/js/app.js'])
</head>
<!-- [Head] end -->
<!-- [Body] Start -->

<body>
  <!-- [ Pre-loader ] start -->
  <div class="loader-bg">
    <div class="loader-track">
      <div class="loader-fill"></div>
    </div>
  </div>
  <!-- [ Pre-loader ] End -->

  <div class="auth-main">
    <div class="auth-wrapper v3">
      <div class="auth-form">
        <div class="auth-header">
          <a href="#" class="d-flex align-items-center gap-2 text-decoration-none" style="color: #0b7f63 !important;">
            <img src="{{ asset('templateAdmin/dist') }}/assets/images/logo2.png" alt="Logo" style="height: 80px; width: auto;">
            <span class="fw-bold fs-5">Masjid Jami' Baitul Makmur</span>
          </a>
        </div>
        <div class="card my-5">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-end mb-4">
              <h3 class="mb-0"><b>Login</b></h3>
              <a href="{{ route('register') }}" style="color: #0b7f63 !important; text-decoration: none;">Don't have an account?</a>
            </div>
           <form action="{{ route('login') }}" method="post">
                @csrf
                 <div class="form-group mb-3">
                    <label class="form-label">Email Address</label>
                        <input type="email" name="email" 
                            class="form-control @error('email')
                                is-invalid
                            @enderror "
                                placeholder="Email Address" autocomplete="off">
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                </div>
                <div class="form-group mb-3">
                    <label class="form-label">Password</label>
                        <input type="password" name="password"
                            class="form-control @error('password')
                                is-invalid
                            @enderror "
                                placeholder="Password">
                            @error('password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                </div>
                <div class="d-flex mt-1 justify-content-between">
                    <div class="form-check">
                        <!-- PASTIKAN ADA ATRIBUT name="remember" DI BAWAH INI -->
                        <input class="form-check-input" type="checkbox" name="remember" id="customCheckc1" {{ old('remember') ? 'checked' : '' }} style="background-color: #0b7f63; border-color: #0b7f63;">
                        <label class="form-check-label text-muted" for="customCheckc1" style="cursor: pointer;">Keep me sign in</label>
                    </div>
                    <!-- <h5 class="text-secondary f-w-400" style="color: #0b7f63 !important; text-decoration: none;" >Forgot Password?</h5> -->
                     <a href="{{ route('password.request') }}" style="text-decoration: none;">
                        <h5 class="text-secondary f-w-400" style="color: #0b7f63 !important; margin: 0; pointer-events: none;">Forgot Password?</h5>
                    </a>
                </div>
            <div class="d-grid mt-4">
              <button type="submit" class="btn text-white w-100" style="background-color: #0b7f63; border-color: #0b7f63;">Login</button>
            </div>

           </form>
          </div>
        </div>
        <div class="auth-footer d-flex justify-content-center align-items-center py-3 px-4 text-white position-relative" style="background-color: #0b7f63; border-radius: 4px; min-height: 56px;">
            
            <!-- Bagian Tengah: Copyright -->
            <p class="m-0 text-white-50 text-center">
                Copyright © <a href="{{ url('/') }}" class="text-white-50 text-decoration-none">Masjid Jami' Baitul Makmur</a>
            </p>

            <!-- Bagian Pojok Kanan: Tautan Kembali ke Home Awal -->
            <div class="position-absolute end-0 pe-4">
                <a href="{{ url('/') }}" class="text-white text-decoration-none fw-medium d-flex align-items-center gap-1" style="font-size: 14px;">
                    <i class="ti ti-home" style="font-size: 18px;"></i> <span>Ke Home</span>
                </a>
            </div>
        </div>
      </div>
    </div>
  </div>
  <!-- [ Main Content ] end -->
  <!-- Required Js -->
  <script src="{{ asset('templateAdmin/dist') }}/assets/js/plugins/popper.min.js"></script>
  <script src="{{ asset('templateAdmin/dist') }}/assets/js/plugins/simplebar.min.js"></script>
  <script src="{{ asset('templateAdmin/dist') }}/assets/js/plugins/bootstrap.min.js"></script>
  <script src="{{ asset('templateAdmin/dist') }}/assets/js/fonts/custom-font.js"></script>
  <script src="{{ asset('templateAdmin/dist') }}/assets/js/fonts/custom-ant-icon.js"></script>
  <script src="{{ asset('templateAdmin/dist') }}/assets/js/pcoded.js"></script>
  <script src="{{ asset('templateAdmin/dist') }}/assets/js/plugins/feather.min.js"></script>
   <!-- Buy Now Link  -->
  <script defer src="https://fomo.codedthemes.com/pixel/Oo2pYDncP8R8qhhETpWKGA04b8jPhUjF" ></script>

     
  <script>
    layout_change('light');
  </script>
     
  <script>
    change_box_container('false');
  </script>
    
  <script>
    layout_rtl_change('false');
  </script>
   
  <script>
    preset_change('preset-1');
  </script>
   
  <script>
    font_change('Public-Sans');
  </script>

<script>
  // Deteksi saat form login disubmit
  document.querySelector('form').addEventListener('submit', function() {
    const rememberCheckbox = document.getElementById('customCheckc1');
    if (rememberCheckbox && rememberCheckbox.checked) {
      // Jika dicentang, simpan status di browser
      localStorage.setItem('keep_me_signed_in', 'true');
    } else {
      // Jika tidak dicentang, hapus statusnya
      localStorage.removeItem('keep_me_signed_in');
    }
  });
</script>  
 
</body>
<!-- [Body] end -->

</html>