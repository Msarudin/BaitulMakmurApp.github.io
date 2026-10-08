<div>
      <section id="program" >
        <div class="container pt-4 pb-5">
          <div class="text-center mb-5">
            <h1 class="display-6 fw-bold lh-2 font-bs" style="color: #1b4d3e;">Program Masjid Jami' Baitul Makmur</h1>
          </div>

          <div class="row">
            
            <!-- PROGRAM 1 -->
            <div class="col-md-4 col-6 mb-4">
              <a href="{{ route('qurban') }}" class="text-decoration-none">
                <!-- PERBAIKAN: Menggunakan background hijau muda lembut kustom & efek hover tipis -->
                <div class="card border-0 rounded-4 shadow-sm" style="background-color: #008374; transition: transform 0.2s;">
                  <div class="card-body text-center py-4">
                    <img src="{{ asset('template/assets/img/qurban.png') }}" height="100" width="100" class="mb-3" alt="Tabungan Qurban" />
                    <!-- PERBAIKAN: Mewarnai teks menjadi hijau tua agar kontras -->
                    <div class="fw-bold" style="color: #f0f4f3;">Tabungan Qurban</div>
                  </div>
                </div>
              </a>
            </div>

            <!-- PROGRAM 2 -->
            <div class="col-md-4 col-6 mb-4">
              <a href="{{ route('ngaji') }}" class="text-decoration-none">
                <div class="card border-0 rounded-4 shadow-sm" style="background-color: #008374; transition: transform 0.2s;">
                  <div class="card-body text-center py-4">
                    <img src="{{ asset('template/assets/img/quran.png') }}" height="100" width="100" class="mb-3" alt="Pembelajaran Tahsin" />
                    <div class="fw-bold" style="color: #f0f4f3;">Pembelajaran Tahsin</div>
                  </div>
                </div>
              </a>
            </div>

            <!-- PROGRAM 3 -->
            <div class="col-md-4 col-6 mb-4">
              <a href="{{ route('nisan') }}" class="text-decoration-none">
                <div class="card border-0 rounded-4 shadow-sm" style="background-color: #008374; transition: transform 0.2s;">
                  <div class="card-body text-center py-4">
                    <img src="{{ asset('template/assets/img/nisan.png') }}" height="100" width="100" class="mb-3" alt="Pemakaman" />
                    <div class="fw-bold" style="color: #f0f4f3;">Pemakaman</div>
                  </div>
                </div>
              </a>
            </div>

            <!-- PROGRAM 4 -->
            <div class="col-md-4 col-6 mb-4">
              <a href="{{ route('kegiatan') }}" class="text-decoration-none">
                <!-- PERBAIKAN: Menggunakan background hijau muda lembut kustom & efek hover tipis -->
                <div class="card border-0 rounded-4 shadow-sm" style="background-color: #008374; transition: transform 0.2s;">
                  <div class="card-body text-center py-4">
                    <img src="{{ asset('template/assets/img/ic-event.png') }}" height="100" width="100" class="mb-3" alt="Tabungan Qurban" />
                    <!-- PERBAIKAN: Mewarnai teks menjadi hijau tua agar kontras -->
                    <div class="fw-bold" style="color: #f0f4f3;">Event Kegiatan PHBI</div>
                  </div>
                </div>
              </a>
            </div>

            <!-- PROGRAM 5 -->
            <div class="col-md-4 col-6 mb-4">
              <a href="{{ route('konsul') }}" class="text-decoration-none">
                <div class="card border-0 rounded-4 shadow-sm" style="background-color: #008374; transition: transform 0.2s;">
                  <div class="card-body text-center py-4">
                    <img src="{{ asset('template/assets/img/ic-konsultasi.png') }}" height="100" width="100" class="mb-3" alt="Pembelajaran Tahsin" />
                    <div class="fw-bold" style="color: #f0f4f3;">Konsultasi</div>
                  </div>
                </div>
              </a>
            </div>

            <!-- PROGRAM 6 -->
            <div class="col-md-4 col-6 mb-4">
              <a href="{{ route('ldk') }}" class="text-decoration-none">
                <div class="card border-0 rounded-4 shadow-sm" style="background-color: #008374; transition: transform 0.2s;">
                  <div class="card-body text-center py-4">
                    <img src="{{ asset('template/assets/img/irma.png') }}" height="100" width="100" class="mb-3" alt="Pemakaman" />
                    <div class="fw-bold" style="color: #f0f4f3;">LDK & Taddabur Alam</div>
                  </div>
                </div>
              </a>
            </div>
          </div>
        </div>
      </section>
</div>