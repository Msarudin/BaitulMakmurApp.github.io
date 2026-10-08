<!-- [Meta] -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Mantis is made using Bootstrap 5 design framework. Download the free admin templateAdmin & use it for your project.">
<meta name="keywords" content="Mantis, Dashboard UI Kit, Bootstrap 5, Admin Template, Admin Dashboard, CRM, CMS, Bootstrap Admin Template">
<meta name="author" content="CodedThemes">

<!-- 🟢 PERBAIKAN FINAL: Jalur disesuaikan ke folder templateAdmin/dist/assets/images -->
<link rel="icon" href="{{ asset('templateAdmin/dist/assets/images/logo-masjid.png?v=999') }}" type="image/png">

<!-- [Google Font] Family -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap" id="main-font-link">

<!-- [Tabler Icons] -->
<link rel="stylesheet" href="{{ asset('templateAdmin/dist/assets/fonts/tabler-icons.min.css') }}" >
<!-- [Feather Icons] -->
<link rel="stylesheet" href="{{ asset('templateAdmin/dist/assets/fonts/feather.css') }}" >
<!-- [Font Awesome Icons] -->
<link rel="stylesheet" href="{{ asset('templateAdmin/dist/assets/fonts/fontawesome.css') }}" >
<!-- [Material Icons] -->
<link rel="stylesheet" href="{{ asset('templateAdmin/dist/assets/fonts/material.css') }}" >

<!-- [Template CSS Files] -->
<link rel="stylesheet" href="{{ asset('templateAdmin/dist/assets/css/style.css') }}" id="main-style-link" >
<!-- 🟢 PERBAIKAN 1: Menghapus double kata 'Admin' pada folder agar style-preset termuat -->
<link rel="stylesheet" href="{{ asset('templateAdmin/dist/assets/css/style-preset.css') }}" >

<!-- Plugin Tambahan -->
<link rel="stylesheet" href="https://cdn.datatables.net/v/dt/dt-3.0.1/datatables.min.css">
<!-- 🟢 PERBAIKAN 2: Menghapus link jsdelivr kosong yang merusak koneksi pengunduhan berkas -->

@vite(['resources/js/app.js'])

