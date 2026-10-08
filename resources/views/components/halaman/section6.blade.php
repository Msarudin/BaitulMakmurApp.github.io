<div>
    <section id="event" >
      <div class="container py-0">
        <!-- Header Section -->
        <div class="d-flex justify-content-between align-items-center mb-5">
          <div>
            <h2 class="fw-bold text-dark h1 font-bs">Kajian Ahad Pagi Masjid Jami' Baitul Makmur</h2>
          </div>
          <!-- <div>
            <button class="btn btn-outline-success rounded-pill fw-bold border-2" style="border-color: #1ba387; color: #1ba387;">Kajian Lainnya</button>
          </div> -->
        </div>

        <div class="row g-4 align-items-stretch">
          <!-- SISI KIRI: SLIDER SINKRON (FOTO & TEXT USTADZ BERGANTI BERSAMAAN) -->
          <div class="col-12 col-lg-6 mb-3">
            <div class="card bg-white rounded-4 border-0 p-3 shadow-sm h-100">
              
              <!-- PENTING: Wadah Utama Carousel membungkus seluruh Row (Foto + Teks) agar sinkron -->
              <div id="carouselKajian" class="carousel slide h-100 rounded-4 overflow-hidden" data-bs-ride="carousel" style="background-color: #020c0a;">
                
                <div class="carousel-inner h-100">
                  
                  <!-- SLIDE 1: Ust. Edi Junaedi -->
                  <div class="carousel-item active" data-bs-interval="4000">
                    <div class="row g-0 align-items-stretch h-100">
                      <div class="col-5 position-relative">
                        <img src="{{ asset('template/assets/img/edi.png') }}" class="d-block w-100" style="height: 500px; object-fit: cover;" alt="Ust. Edi Junaedi" />
                      </div>
                      <div class="col-7 d-flex align-items-center">
                        <div class="p-3 p-md-4 text-white">
                          <div class="fw-bold fs-5 mb-1 text-wrap">Ust. Edi Junaedi</div>
                          <div class="text-white-50 small text-wrap">Pengajar & Dewan Kemakmuran Masjid</div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- SLIDE 2: Ust. Abdur -->
                  <div class="carousel-item" data-bs-interval="4000">
                    <div class="row g-0 align-items-center">
                      <div class="col-5">
                        <img src="{{ asset('template/assets/img/abdur.jpeg') }}" class="d-block w-100" style="height: 500px; object-fit: cover;" alt="Ust. Abdur" />
                      </div>
                      <div class="col-7">
                        <div class="p-3 p-md-4 text-white">
                          <div class="fw-bold fs-5 mb-1 text-wrap">Ust. Abdurrahman</div>
                          <div class="text-white-50 small text-wrap">Pengajar & Dewan Kemakmuran Masjid</div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- SLIDE 3: Ust. Hasanuddin -->
                  <div class="carousel-item" data-bs-interval="4000">
                    <div class="row g-0 align-items-center">
                      <div class="col-5">
                        <img src="{{ asset('template/assets/img/hasanuddin.jpeg') }}" class="d-block w-100" style="height: 500px; object-fit: cover;" alt="Ust. Hasanuddin" />
                      </div>
                      <div class="col-7">
                        <div class="p-3 p-md-4 text-white">
                          <div class="fw-bold fs-5 mb-1 text-wrap">Ust. H. Hasanuddin</div>
                          <div class="text-white-50 small text-wrap">Pengajar & Dewan Kemakmuran Masjid</div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- SLIDE 4: Ust. Hafsin -->
                  <div class="carousel-item" data-bs-interval="4000">
                    <div class="row g-0 align-items-center">
                      <div class="col-5">
                        <img src="{{ asset('template/assets/img/hafsin.png') }}" class="d-block w-100" style="height: 500px; object-fit: cover;" alt="Ust. Kafsin" />
                      </div>
                      <div class="col-7">
                        <div class="p-3 p-md-4 text-white">
                          <div class="fw-bold fs-5 mb-1 text-wrap">Ust. Adbul Kafsin</div>
                          <div class="text-white-50 small text-wrap">Pengajar & Dewan Kemakmuran Masjid</div>
                        </div>
                      </div>
                    </div>
                  </div>

                </div> <!-- /carousel-inner -->

                <!-- TOMBOL NAVIGASI TOMBOL ARAH (Sekarang Pasti Berfungsi karena Menargetkan #carouselKajian dengan benar) -->
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselKajian" data-bs-slide="prev" style="opacity: 0.7; width: 10%;">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselKajian" data-bs-slide="next" style="opacity: 0.7; width: 10%;">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>

              </div> <!-- /carousel -->
              
            </div>
          </div>
          
          <!-- SISI KANAN: LIST DAFTAR KAJIAN -->
          <div class="col-12 col-lg-6 mb-3">
            <!-- Kartu 1: Highlight Hijau Toska -->
            <div class="card border-0 rounded-4 p-3 mb-3 text-secondary shadow-sm" style="background-color: #008374;">
              <div class="d-flex align-items-center">
                <div class="bg-light rounded-3 p-3 me-3 text-center d-flex flex-column justify-content-center" style="min-width: 110px; min-height: 80px;">
                  <small class="text-muted d-block fw-bold text-uppercase" style="font-size: 0.75rem;">Ahad</small>
                  <div class="fw-extrabold text-dark" style="font-size: 0.95rem;">Ahad Ke 1</div>
                </div>
                <div>
                  <div class="fw-bold fs-5 text-white">Kajian Fiqih</div>
                  <div class="text-white small fw-medium">Ust. Edi Junaedi | 05.00 - 06.00 WIB</div>
                </div>
              </div>
            </div>

            <!-- Kartu 2: List Putih Bersih -->
            <div class="card border-0 rounded-4 p-3 mb-3 text-secondary shadow-sm" style="background-color: #008374;">
              <div class="d-flex align-items-center">
                <div class="bg-light rounded-3 p-3 me-3 text-center d-flex flex-column justify-content-center" style="min-width: 110px; min-height: 80px;">
                  <small class="text-muted d-block fw-bold text-uppercase" style="font-size: 0.75rem;">Ahad</small>
                  <div class="fw-extrabold text-dark" style="font-size: 0.95rem;">Ahad Ke 2</div>
                </div>
                <div>
                  <div class="fw-bold fs-5 text-white">Kajian Tafsir</div>
                  <div class="text-white small fw-medium">Ust. Abdurrahman | 05.00 - 06.00 WIB</div>
                </div>
              </div>
            </div>

            <!-- Kartu 3: List Putih Bersih -->
            <div class="card border-0 rounded-4 p-3 mb-3 text-secondary shadow-sm" style="background-color: #008374;">
              <div class="d-flex align-items-center">
                <div class="bg-light rounded-3 p-3 me-3 text-center d-flex flex-column justify-content-center" style="min-width: 110px; min-height: 80px;">
                  <small class="text-muted d-block fw-bold text-uppercase" style="font-size: 0.75rem;">Ahad</small>
                  <div class="fw-extrabold text-dark" style="font-size: 0.95rem;">Ahad Ke 3</div>
                </div>
                <div>
                  <div class="fw-bold fs-5 text-white">Kajian Hadits</div>
                  <div class="text-white small fw-medium">H. Hasanuddin | 05.00 - 06.00 WIB</div>
                </div>
              </div>
            </div>

            <div class="card border-0 rounded-4 p-3 mb-3 text-secondary shadow-sm" style="background-color: #008374;">
              <div class="d-flex align-items-center">
                <div class="bg-light rounded-3 p-3 me-3 text-center d-flex flex-column justify-content-center" style="min-width: 110px; min-height: 80px;">
                  <small class="text-muted d-block fw-bold text-uppercase" style="font-size: 0.75rem;">Ahad</small>
                  <div class="fw-extrabold text-dark" style="font-size: 0.95rem;">Ahad Ke 4</div>
                </div>
                <div>
                  <div class="fw-bold fs-5 text-white">Kajian Umum</div>
                  <div class="text-white small fw-medium">Ust. Abdul Kafsin | 05.00 - 06.00 WIB</div>
                </div>
              </div>
            </div>
          </div>
        </div> <!-- /row -->
      </div>
    </section>
</div>