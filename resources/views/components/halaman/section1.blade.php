<div>
    <!-- Hero Section -->
    <section id="hero" class="hero section accent-background">
      <!-- Kolom Gambar -->
      <div class="col-lg-12 p-0 mb-3 overflow-hidden"> 
        <!-- INDUK CAROUSEL UTAMA -->
        <div id="carouselMasjid" class="carousel slide rounded shadow" data-bs-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active" data-bs-interval="3000">
              <img src="{{ asset('template/assets/img/masjid2.jpg') }}" class="d-block w-100" style="height: 550px; object-fit: contain; background-color: #008374" alt="Masjid Jami Baitul Makmur" />
            </div>
            <div class="carousel-item" data-bs-interval="3000">
              <img src="{{ asset('template/assets/img/halaman1.jpeg') }}" class="d-block w-100" style="height: 550px; object-fit: contain; background-color: #008374" alt="Masjid Jami Baitul Makmur" />
            </div>
            <div class="carousel-item" data-bs-interval="3000">
              <img src="{{ asset('template/assets/img/halaman2.jpeg') }}" class="d-block w-100" style="height: 550px; object-fit: contain; background-color: #008374" alt="Masjid Jami Baitul Makmur" />
            </div>
            <div class="carousel-item" data-bs-interval="3000">
              <img src="{{ asset('template/assets/img/halaman.jpeg') }}" class="d-block w-100" style="height: 550px; object-fit: contain; background-color: #008374" alt="Masjid Jami Baitul Makmur" />
            </div>
          </div>

          <!-- Tombol Navigasi Manual -->
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselMasjid" data-bs-slide="prev" style="opacity: 0.7;">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselMasjid" data-bs-slide="next" style="opacity: 0.7;">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
          </button>
        </div>
      </div>

      <div class="icon-boxes position-relative" data-aos="fade-up" data-aos-delay="200">
        <div class="container position-relative">
          <div class="row gy-4 mt-5">

              <!-- KAS 1: TOTAL SALDO KAS MASJID (SINKRON PERMANEN) -->
              <div class="col-xl-3 col-md-6">
<!-- Perhatikan baris <h3> berikut ini -->
<div class="icon-box text-white">
  <div class="icon mb-3"><i class="bi bi-wallet2 text-white" style="font-size: 28px;"></i></div>
  <p class="text-uppercase small mb-1" style="color: rgba(255,255,255,0.7); font-weight: 600; letter-spacing: 0.5px;">TOTAL SALDO KAS MASJID</p>
  
  <!-- 🟢 CETAK LANGSUNG STRING TEKS DARI CONTROLLER -->
  <h3 class="fw-bold mb-2 text-white" style="font-size: 22px;">
      {{ str_contains($saldoMasjidText, 'Rp') ? $saldoMasjidText : 'Rp ' . $saldoMasjidText }}
  </h3>
  
  <small style="color: rgba(255,255,255,0.8); font-size: 11px;">
    <i class="bi bi-check-circle-fill me-1"></i> Saldo Real-time
  </small>
</div>

<!-- ⚠️ HAPUS SCRIPT JAVASCRIPT LOCALSTORAGE YANG ADA DI BAGIAN PALING BAWAH FILE USER INI KARENA SUDAH TIDAK DIPERLUKAN LAGI -->


              </div>

              <!-- KAS 2: TOTAL SALDO KAS AMBULAN -->
              <div class="col-xl-3 col-md-6">
                <div class="icon-box text-white">
                  <div class="icon mb-3"><i class="bi bi-truck text-white" style="font-size: 28px;"></i></div>
                  <p class="text-uppercase small mb-1" style="color: rgba(255,255,255,0.7); font-weight: 600; letter-spacing: 0.5px;">TOTAL SALDO KAS AMBULAN</p>
                  <h3 class="fw-bold mb-2 text-white" style="font-size: 22px;">
                    Rp {{ number_format($saldoAmbulan ?? 0, 0, ',', '.') }}
                  </h3>
                  <small style="color: rgba(255,255,255,0.8); font-size: 11px;">
                    <i class="bi bi-check-circle-fill me-1"></i> Kesiapan Operasional
                  </small>
                </div>
              </div>

              <!-- KAS 3: TOTAL SALDO KAS YATIM -->
              <div class="col-xl-3 col-md-6">
                <div class="icon-box text-white">
                  <div class="icon mb-3"><i class="bi bi-heart text-white" style="font-size: 28px;"></i></div>
                  <p class="text-uppercase small mb-1" style="color: rgba(255,255,255,0.7); font-weight: 600; letter-spacing: 0.5px;">TOTAL SALDO KAS YATIM</p>
                  <h3 class="fw-bold mb-2 text-white" style="font-size: 22px;">
                    Rp {{ number_format($saldoYatim ?? 0, 0, ',', '.') }}
                  </h3>
                  <small style="color: rgba(255,255,255,0.8); font-size: 11px;">
                    <i class="bi bi-check-circle-fill me-1"></i> Dana Sosial Warga
                  </small>
                </div>
              </div>

            <!-- CARD 4: TOTAL DATA JAMAAH -->
            <div class="col-xl-3 col-md-6">
              <div class="icon-box text-white">
                <div class="icon mb-3"><i class="bi bi-people text-white" style="font-size: 28px;"></i></div>
                <p class="text-uppercase small mb-1" style="color: rgba(255,255,255,0.7); font-weight: 600; letter-spacing: 0.5px;">TOTAL DATA JAMAAH</p>
                <h3 class="fw-bold mb-2 text-white" style="font-size: 22px;">
                  {{ $totalJamaah ?? 0 }} Orang
                </h3>
                <small style="color: rgba(255,255,255,0.8); font-size: 11px;">
                  <i class="bi bi-person-check-fill me-1"></i> Jiwa Terdata Terdaftar
                </small>
              </div>
            </div>

          </div>
        </div>
      </div>
    </section>
</div>
<!-- 🟢 TEMPELKAN SCRIPT INI DI BARIS PALING BAWAH FILE VIEW USER -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var elemenSaldoUser = document.getElementById('saldo-kas-masjid');
        
        if (elemenSaldoUser) {
            // Membaca teks murni hasil input manual Anda dari admin
            var saldoKetikanAdmin = localStorage.getItem('saldo_manual_untuk_user');
            
            // Jika ada data hasil input dari admin, tampilkan langsung
            if (saldoKetikanAdmin && saldoKetikanAdmin.trim() !== "") {
                elemenSaldoUser.innerText = saldoKetikanAdmin;
            } else {
                // Tampilan default berupa Rp 0 jika form admin dikosongkan/belum diisi
                elemenSaldoUser.innerText = 'Rp 0';
            }
        }
    });
</script>

