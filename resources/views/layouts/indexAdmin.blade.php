<!DOCTYPE html>
<html lang="en">
<!-- [Head] start -->

<head>
  <title>Baitul Makmur App</title>
  <x-meta />
<style>
    /* 1. Hilangkan efek background biru muda bawaan template saat sub-menu aktif */
    .pc-sidebar .pc-navbar .pc-submenu .pc-item.active {
        background-color: transparent !important;
        background: transparent !important;
    }

    /* 2. PAKSA warna hijau pekat HANYA pada sub-menu mana saja yang sedang aktif diakses */
    .pc-sidebar .pc-navbar .pc-submenu .pc-item.active > a {
        background-color: #0b7f63 !important;
        background: #0b7f63 !important;
        border-radius: 4px !important;
        display: block !important;
    }

    /* 3. Pastikan teks dan ikon di dalam sub-menu aktif dipaksa berwarna putih murni */
    .pc-sidebar .pc-navbar .pc-submenu .pc-item.active > a *,
    .pc-sidebar .pc-navbar .pc-submenu .pc-item.active > a .pc-mtext,
    .pc-sidebar .pc-navbar .pc-submenu .pc-item.active > a i {
        color: #ffffff !important;
    }

    /* 4. FIX UTAMA: Ubah warna sorotan mouse (HOVER) dari biru muda menjadi hijau muda transparan yang lembut */
    .pc-sidebar .pc-navbar .pc-submenu .pc-item a:hover,
    .pc-sidebar .pc-navbar .pc-submenu .pc-item:hover > a,
    .pc-sidebar .pc-navbar .pc-submenu .pc-item a:focus {
        background-color: #e2f3ee !important; /* Warna dasar hijau muda lembut */
        background: #e2f3ee !important;
        color: #0b7f63 !important; /* Teks berubah hijau pekat saat disorot */
        border-radius: 4px !important;
    }

    /* 5. Pastikan teks dan ikon di dalam menu yang DISOROT (HOVER) ikut berubah menjadi hijau */
    .pc-sidebar .pc-navbar .pc-submenu .pc-item a:hover *,
    .pc-sidebar .pc-navbar .pc-submenu .pc-item a:hover i,
    .pc-sidebar .pc-navbar .pc-submenu .pc-item a:hover .pc-mtext {
        color: #0b7f63 !important;
    }

    /* 6. Jika menu yang DISOROT tersebut statusnya sedang AKTIF, kunci agar tetap putih murni (tidak ikut menghijau) */
    .pc-sidebar .pc-navbar .pc-submenu .pc-item.active a:hover,
    .pc-sidebar .pc-navbar .pc-submenu .pc-item.active a:hover *,
    .pc-sidebar .pc-navbar .pc-submenu .pc-item.active a:hover i {
        background-color: #0b7f63 !important;
        background: #0b7f63 !important;
        color: #ffffff !important;
    }

    /* 7. Amankan kedua menu induk agar tidak ikut menyala hijau ganda */
    #dropdown-jamaah-parent > a,
    #dropdown-keuangan-parent > a {
        background-color: transparent !important;
        background: transparent !important;
        color: #29303e !important;
    }
</style>


</head>
<!-- [Head] end -->
<!-- [Body] Start -->

<body data-pc-preset="preset-1" data-pc-direction="ltr" data-pc-theme="light">
  <!-- [ Pre-loader ] start -->
<div class="loader-bg">
  <div class="loader-track">
    <div class="loader-fill"></div>
  </div>
</div>
<!-- [ Pre-loader ] End -->
 <!-- [ Sidebar Menu ] start -->
<x-sidebar />
<!-- [ Sidebar Menu ] end --> <!-- [ Header Topbar ] start -->
<x-header />
<!-- [ Header ] end -->

<!-- [ Main Content ] start -->
  <div class="pc-container">
    <div class="pc-content">
      <!-- [ breadcrumb ] start -->
      <x-breadcrumbs />
      <!-- [ breadcrumb ] end -->
      <!-- [ Main Content ] start -->
       <div class="row">
        @if (session('success'))
        <div class="container">
            <div class="alert alert-success" id="success-alert" role="alert">
                {{ session('success') }}
            </div>
        </div>
        @endif
        @yield('content')
       </div>

    </div>
  </div>
  <!-- [ Main Content ] end -->
  <x-footer />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js" integrity="sha512-+k1pnlgt4F1H8L7t3z95o3/KO+o78INEcXTbnoJQ/F2VqDVhWoaiVml/OEHv9HsVgxUaVW+IbiZPUJQfF/YxZw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.datatables.net/v/dt/dt-3.0.3/datatables.min.js" ></script>
    
    <script>
        $(document).ready(function() {
            let table = new DataTable('#myTable');
            $("#success-alert").fadeTo(3000, 500).slideUp(500, function(){
            $("#success-alert").slideUp(500);
            });
        });
        
    </script>

  <!-- [Page Specific JS] start -->
  <script src="{{ asset('templateAdmin/dist') }}/assets/js/plugins/apexcharts.min.js"></script>
  <script src="{{ asset('templateAdmin/dist') }}/assets/js/pages/dashboard-default.js"></script>
  <!-- [Page Specific JS] end -->
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
  
  @include('sweetalert::alert')
</body>
<!-- [Body] end -->

</html>