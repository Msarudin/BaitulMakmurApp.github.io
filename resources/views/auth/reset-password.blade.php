<!DOCTYPE html>
<html lang="en">
<!-- [Head] start -->

<head>
  <title>Reset Password | Baitul Makmur_APP</title>
  <!-- [Meta] -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="Mantis is made using Bootstrap 5 design framework. Download the free admin template & use it for your project.">
  <meta name="keywords" content="Mantis, Dashboard UI Kit, Bootstrap 5, Admin Template, Admin Dashboard, CRM, CMS, Bootstrap Admin Template">
  <meta name="author" content="CodedThemes">

  <!-- [Favicon] icon -->
  <link rel="icon" href="{{ asset('templateAdmin/dist/assets/images/logo-masjid.png?v=999') }}" type="image/png">
  <link rel="stylesheet" href="https://googleapis.com" id="main-font-link">
  <!-- [Tabler Icons] https://tablericons.com -->
  <link rel="stylesheet" href="{{ asset('templateAdmin/dist') }}/assets/fonts/tabler-icons.min.css" >
  <!-- [Feather Icons] https://feathericons.com -->
  <link rel="stylesheet" href="{{ asset('templateAdmin/dist') }}/assets/fonts/feather.css" >
  <!-- [Font Awesome Icons] https://fontawesome.com -->
  <link rel="stylesheet" href="{{ asset('templateAdmin/dist') }}/assets/fonts/fontawesome.css" >
  <!-- [Material Icons] https://google.com -->
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
              <h3 class="mb-0"><b>Reset Password</b></h3>
              <a href="{{ route('login') }}" style="color: #0b7f63 !important; text-decoration: none;">Kembali Ke Login?</a>
            </div>

            <form action="{{ route('password.update') }}" method="post">
                @csrf

                <!-- Token Reset Password Tersembunyi (Wajib di Laravel) -->
                <input type="hidden" name="token" value="{{ request()->route('token') }}">

                <!-- Input Email -->
                <div class="form-group mb-3">
                    <label class="form-label">Alamat Email</label>
                    <input type="email" name="email" value="{{ old('email', request()->email) }}"
                        class="form-control @error('email') is-invalid @enderror"
                        placeholder="Email Address" autocomplete="off" required readonly>
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Input Password Baru -->
                <div class="form-group mb-3">
                    <label class="form-label">Password Baru</label>
                    <input type="password" name="password" 
                        class="form-control @error('password') is-invalid @enderror"
                        placeholder="Masukan password baru" required autofocus>
                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Input Konfirmasi Password -->
                <div class="form-group mb-3">
                    <label class="form-label">Konfirmasi Password Baru</label>
                    <input type="password" name="password_confirmation" 
                        class="form-control @error('password_confirmation') is-invalid @enderror"
                        placeholder="Konfirmasi password baru" required>
                    @error('password_confirmation')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="d-grid mt-4">
                  <button type="submit" class="btn text-white w-100" style="background-color: #0b7f63; border-color: #0b7f63;">
                      Ubah Password
                  </button>
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
                    <i class="ti ti-home" style="font-size: 18px;"></i> <span>Ke Home Awal</span>
                </a>
            </div>
        </div>
      </div>
    </div>
  </div>
  <!-- [ Main Content ] end -->
  <!-- Required Js -->
  <!-- Required Js -->
  <script src="{{ asset('templateAdmin/dist/assets/js/plugins/popper.min.js') }}"></script>
  <script src="{{ asset('templateAdmin/dist/assets/js/plugins/simplebar.min.js') }}"></script>
  <script src="{{ asset('templateAdmin/dist/assets/js/plugins/bootstrap.min.js') }}"></script>
  <script src="{{ asset('templateAdmin/dist/assets/js/fonts/custom-font.js') }}"></script>
  <script src="{{ asset('templateAdmin/dist/assets/js/fonts/custom-ant-icon.js') }}"></script>
  <script src="{{ asset('templateAdmin/dist/assets/js/pcoded.js') }}"></script>
  <script src="{{ asset('templateAdmin/dist/assets/js/plugins/feather.min.js') }}"></script>
   
  <script>
    layout_change('light');
    change_box_container('false');
    layout_rtl_change('false');
    preset_change('preset-1');
    font_change('Public-Sans');
  </script>
</body>
<!-- [Body] end -->
</html>
