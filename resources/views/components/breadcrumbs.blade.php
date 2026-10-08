<div>
    <div class="page-header">
        <div class="page-block">
          <div class="row align-items-center">
            <div class="col-md-12">
              <ul class="breadcrumb">
                
                <!-- Menu Utama Home selalu muncul di awal -->
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}" style="color: #6c757d; text-decoration: none;">Home</a>
                </li>
                
                <!-- Jika sedang berada di Halaman Jamaah -->
                @if(request()->routeIs('jamaah.*'))
                    <li class="breadcrumb-item active" style="color: #0b7f63 !important; font-weight: 600;">Data Jamaah</li>
                @endif
                
                <!-- Jika sedang berada di Halaman Bagian -->
                @if(request()->routeIs('mustahiq.*'))
                    <li class="breadcrumb-item active" style="color: #0b7f63 !important; font-weight: 600;">Data Mustahiq</li>
                @endif

                 @if(request()->routeIs('muzaki.*'))
                    <li class="breadcrumb-item active" style="color: #0b7f63 !important; font-weight: 600;">Data Muzaki</li>
                @endif
                
                <!-- Jika sedang berada di Halaman User -->
                @if(request()->routeIs('users.*'))
                    <li class="breadcrumb-item active" style="color: #0b7f63 !important; font-weight: 600;">Data User</li>
                @endif

                <!-- Jika sedang berada di Halaman User -->
                @if(request()->routeIs('keuangan.*'))
                    <li class="breadcrumb-item active" style="color: #0b7f63 !important; font-weight: 600;">Laporan</li>
                @endif

                @if(request()->routeIs('keuangan-yayasan.*'))
                    <li class="breadcrumb-item active" style="color: #0b7f63 !important; font-weight: 600;">Laporan Keuangan Yayasan</li>
                @endif

                @if(request()->routeIs('iuran-warga.*'))
                    <li class="breadcrumb-item active" style="color: #0b7f63 !important; font-weight: 600;">Laporan Keuangan Iuran Warga</li>
                @endif
                
                @if(request()->routeIs('ktrmustahiq.*'))
                    <li class="breadcrumb-item active" style="color: #0b7f63 !important; font-weight: 600;">Kriteria Mustahiq</li>
                @endif
         
                @if(request()->routeIs('jenis_amal.*'))
                    <li class="breadcrumb-item active" style="color: #0b7f63 !important; font-weight: 600;">Kriteria Amal</li>
                @endif
                
                @if(request()->routeIs('bagian.*'))
                    <li class="breadcrumb-item active" style="color: #0b7f63 !important; font-weight: 600;">Rt di Rw 15</li>
                @endif
              </ul>
            </div>
          </div>
        </div>
      </div>
</div>
