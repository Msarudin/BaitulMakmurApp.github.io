<nav class="pc-sidebar">
  <div class="navbar-wrapper">
    <div class="m-header text-center" style="background-color: #ffffff !important; display: flex; align-items: center; justify-content: center; min-height: 140px; padding-top: 25px; padding-bottom: 10px; overflow: visible !important;">
      <a href="{{ url('/') }}" class="b-brand d-flex flex-column align-items-center justify-content-center text-decoration-none">
        <img src="{{ asset('template/assets/img/logo2.png') }}" class="img-fluid" alt="logo" style="max-height: 100px; width: auto; object-fit: contain;">
        <span class="mt-2 fw-bold" style="color: #044904;">Baitul Makmur App</span> 
      </a>
    </div>
    
    <div class="navbar-content">
      <ul class="pc-navbar">
        <!-- ==================== MENU BERANDA (Bisa diakses oleh SEMUA USER) ==================== -->
        <x-sidebar.links title="Home" icon="ti ti-home" route="home" />    
        
        @php
          // Mengambil role_id user yang sedang login saat ini
          $userRoleId = Auth::user()->role_id;

          // Deteksi halaman aktif untuk penanda CSS di Data Jamaah dan Laporan Kas
          $isJamaahOpen = request()->routeIs('jamaah.*') || request()->routeIs('jamaah.rt');
          $isKeuanganOpen = request()->routeIs('keuangan.masjid') || request()->routeIs('keuangan.ambulan') || request()->routeIs('keuangan.yatim') || request()->routeIs('keuangan.irma');
        @endphp

        <!-- ==================== 1. DROPDOWN DATA JAMAAH ==================== -->
        <!-- Terbuka untuk: Superadmin (1), Admin (2), Pengelola Warga (3), Pengelola Masjid (4) -->
        <!-- Otomatis TERSEMBUNYI untuk: pengelola_irma (5 / adminirma@) dan jamaah (bila@) -->
        @if(in_array($userRoleId, [1, 2, 3, 4, 5]))
            <li class="pc-item pc-hasmenu {{ $isJamaahOpen ? 'pc-trigger' : '' }}" id="dropdown-jamaah-parent">
                <a href="#" class="pc-link" style="color: #29303e !important; font-weight: 600;">
                    <span class="pc-micon"><i class="ti ti-database" style="color: #29303e !important;"></i></span>
                    <span class="pc-mtext">Data Jamaah</span>
                    <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                </a>
                
                <ul class="pc-submenu" id="submenu-rt-list">
                    @php $isAllActive = request()->routeIs('jamaah.index'); @endphp
                    <li class="pc-item {{ $isAllActive ? 'active' : '' }}">
                        <a href="{{ route('jamaah.index') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-database" style="font-size: 14px;"></i></span>
                            <span class="pc-mtext">Semua Data Jamaah</span>
                        </a>
                    </li>

                    @foreach($daftarRt as $rt)
                        @php 
                            $displayTitle = str_replace('_', ' ', $rt->nama_bagian); 
                            $isRtActive = request()->routeIs('jamaah.rt') && request()->route('parameter') == $rt->id;
                        @endphp
                        <li class="pc-item {{ $isRtActive ? 'active' : '' }}">
                            <a href="{{ route('jamaah.rt', $rt->id) }}" class="pc-link">
                                <span class="pc-micon"><i class="ti ti-database" style="font-size: 14px;"></i></span>
                                <span class="pc-mtext">{{ $displayTitle }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </li>
          @endif
            
            <!-- Menu Administrasi Tambahan Zakat (Hanya terbuka untuk ID 1, 2, 4) -->
            <!-- Otomatis TERSEMBUNYI dari rtrw15@gmail.com (ID: 3) -->
            <!-- @if(in_array($userRoleId, [1, 2, 4])) -->
                <x-sidebar.links title="Data Mustahiq" icon="ti ti-users" route="mustahiq.index" /> 
                <x-sidebar.links title="Data Muzaki" icon="ti ti-users" route="muzaki.index" /> 
            <!-- @endif -->


        <!-- ==================== MENU DATA USERS (DISEMBUNYIKAN TOTAL) ==================== -->
         @if(in_array($userRoleId, [1]))
            <x-sidebar.links title="Data Users" icon="ti ti-users" route="users.index" />  
        @endif
        <!-- ==================== 2. DROPDOWN LAPORAN KAS MASJID ==================== -->
        <!-- Parent Dropdown terbuka untuk pengelola resmi (1, 2, 3, 4, 5) -->
        @if(in_array($userRoleId, [1, 2, 4, 5]))
            <li class="pc-item pc-hasmenu {{ $isKeuanganOpen ? 'pc-trigger' : '' }}" id="dropdown-keuangan-parent">
                <a href="#" class="pc-link" style="color: #29303e !important; font-weight: 600;">
                    <span class="pc-micon"><i class="ti ti-report" style="color: #29303e !important;"></i></span>
                    <span class="pc-mtext">Laporan Kas Masjid</span>
                    <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                </a>
                
                <ul class="pc-submenu" id="submenu-keuangan-list">
                    <!-- A. SUB-MENU KAS MASJID: Terbuka untuk Superadmin (1), Admin (2), Pengelola Warga (3), Pengelola Masjid (4 / adminbaitul@) -->
                    <!-- Otomatis TERSEMBUNYI untuk: Pengelola IRMA (5) -->
                    @if(in_array($userRoleId, [1, 2, 3, 4, 5]))
                        @php $isMasjidActive = request()->routeIs('keuangan.masjid'); @endphp
                        <li class="pc-item {{ $isMasjidActive ? 'active' : '' }}">
                            <a href="{{ route('keuangan.masjid') }}" class="pc-link" @if($isMasjidActive) style="background-color: #0b7f63 !important; border-radius: 4px;" @endif>
                                <span class="pc-micon"><i class="ti ti-report" style="font-size: 14px;"></i></span>
                                <span class="pc-mtext">Kas Masjid</span>
                            </a>
                        </li>
                    @endif

                    <!-- B. SUB-MENU KAS AMBULAN: Terbuka untuk Superadmin (1), Admin (2), Pengelola Warga (3 / rtrw15@) -->
                    <!-- Otomatis TERSEMBUNYI untuk: Pengelola Masjid (4 / adminbaitul@) dan Pengelola IRMA (5) -->
                    @if(in_array($userRoleId, [1, 2, 3, 4, 5]))
                        @php $isAmbulanActive = request()->routeIs('keuangan.ambulan'); @endphp
                        <li class="pc-item {{ $isAmbulanActive ? 'active' : '' }}">
                            <a href="{{ route('keuangan.ambulan') }}" class="pc-link" @if($isAmbulanActive) style="background-color: #0b7f63 !important; border-radius: 4px;" @endif>
                                <span class="pc-micon"><i class="ti ti-report" style="font-size: 14px;"></i></span>
                                <span class="pc-mtext">Kas Ambulan</span>
                            </a>
                        </li>
                    @endif

                    <!-- C. SUB-MENU KAS YATIM: Terbuka untuk Superadmin (1), Admin (2), Pengelola Warga (3), Pengelola Masjid (4 / adminbaitul@) -->
                    <!-- Otomatis TERSEMBUNYI untuk: Pengelola IRMA (5) -->
                    @if(in_array($userRoleId, [1, 2, 3, 4, 5]))
                        @php $isYatimActive = request()->routeIs('keuangan.yatim'); @endphp
                        <li class="pc-item {{ $isYatimActive ? 'active' : '' }}">
                            <a href="{{ route('keuangan.yatim') }}" class="pc-link" @if($isYatimActive) style="background-color: #0b7f63 !important; border-radius: 4px;" @endif>
                                <span class="pc-micon"><i class="ti ti-report" style="font-size: 14px;"></i></span>
                                <span class="pc-mtext">Kas Yatim</span>
                            </a>
                        </li>
                    @endif

                    <!-- D. SUB-MENU KAS IRMA: Terbuka untuk Superadmin (1), Admin (2), Pengelola Warga (3), Pengelola IRMA (5 / adminirma@) -->
                    <!-- Otomatis TERSEMBUNYI untuk: Pengelola Masjid (4 / adminbaitul@) -->
                    @if(in_array($userRoleId, [1, 2, 3, 4, 5]))
                        @php $isIrmaActive = request()->routeIs('keuangan.irma'); @endphp
                        <li class="pc-item {{ $isIrmaActive ? 'active' : '' }}">
                            <a href="{{ route('keuangan.irma') }}" class="pc-link" @if($isIrmaActive) style="background-color: #0b7f63 !important; border-radius: 4px;" @endif>
                                <span class="pc-micon"><i class="ti ti-report" style="font-size: 14px;"></i></span>
                                <span class="pc-mtext">Kas Irma</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif

        <!-- ==================== 3. MENU ADMINISTRASI YAYASAN & WARGA ==================== -->
        <!-- Hak Akses Khusus: Hanya Superadmin (1), Admin (2), dan Pengelola Warga (3 / rtrw15@gmail.com) yang dapat melihat -->
        <!-- Otomatis TERSEMBUNYI untuk: Pengelola Masjid (4 / adminbaitul@), Pengelola IRMA (5), dan Jamaah Biasa (bila@) -->
        @if(in_array($userRoleId, [1, 2, 3]))
            <x-sidebar.links title="Keuangan Yayasan" icon="ti ti-report" route="keuangan-yayasan.index" />
            <x-sidebar.links title="Laporan Iuran Warga" icon="ti ti-report" route="iuran-warga.index" />
        @endif

        <!-- ==================== 4. MENU KONFIGURASI KRITERIA SISTEM ==================== -->
        <!-- Hak Akses: Terbuka untuk pengelola tertentu saja (1, 2, 4) -->
        <!-- Otomatis TERSEMBUNYI untuk: Pengelola Warga (3 / rtrw15@) dan Pengelola IRMA (5 / adminirma@) -->
        @if(in_array($userRoleId, [1, 2, 4]))
            <x-sidebar.links title="Kriteria Mustahiq" icon="ti ti-sitemap" route="ktrmustahiq.index" />
            <x-sidebar.links title="Kriteria Amal" icon="ti ti-sitemap" route="jenis_amal.index" />
        @endif

        <!-- Menu RT di RW 15 dinonaktifkan murni total dari sidebar menu sesuai instruksi aman -->
        @if(in_array($userRoleId, [1, 2, 4]))
            <x-sidebar.links title="RT di RW 15" icon="ti ti-sitemap" route="bagian.index" />
        @endif

      </ul>
    </div>
  </div>
</nav>

