<!DOCTYPE html>
<html lang="en">
<!-- [Head] start -->

<head>
  <title>Register</title>
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
              <h3 class="mb-0"><b>Sign up</b></h3>
              <a href="{{ route('login') }}" style="color: #0b7f63 !important; text-decoration: none;">Already have an account?</a>
            </div>
            <form action="{{ route('register') }}" method="post">
                @csrf

            <div class="row">
              <div class="form-group mb-3">
                  <label class="form-label">Full Name*</label>
                  <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                        placeholder="Full Name">
                    @error('name')
                        <small class="text-danger">{{ $message}}</small>
                    @enderror    
                </div>
            </div>
            <div class="form-group mb-3">
              <label class="form-label">Email Address*</label>
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
            <div class="form-group mb-3">
              <label class="form-label">Password Confirmation</label>
              <input type="password" name="password_confirmation" class="form-control" placeholder="Password">
            </div>
            <p class="mt-4 text-sm text-muted">By Signing up, you agree to our <a href="#" style="color: #0b7f63 !important; text-decoration: none;"> Terms of Service </a> and <a href="#" style="color: #0b7f63 !important; text-decoration: none;"> Privacy Policy</a></p>
            <div class="d-grid mt-3">
              <button type="submit" class="btn text-white w-100" style="background-color: #0b7f63; border-color: #0b7f63;">Login</button>
            </div>
            </form>
          </div>
        </div>
        <div class="auth-footer row align-items-center py-3 px-4 text-white" style="background-color: #0b7f63; border-radius: 4px;">
          <!-- <div class=""> -->
            <div class="col-12 my-1">
                <p class="m-0 text-white-50 text-center">
                    Copyright © <a href="{{ url('/') }}" class="text-white-50 text-decoration-none">Masjid Jami' Baitul Makmur</a>
                </p>
            </div>
          <!-- </div> -->
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
  
 
</body>
<!-- [Body] end -->

</html>