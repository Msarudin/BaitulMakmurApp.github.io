<div>
    <section class="pb-3 py-2 mb-0" style="background-color: #008374;">
      <div class="container my-5">
          <div class="row justify-content-center">
              <!-- Membatasi lebar agar mirip dengan contoh gambar -->
              <div class="col-12 col-lg-10">
                  
                  <!-- Card Utama Sambutan TETAP berwarna putih (bg-white) -->
                  <div class="card shadow-sm border border-light rounded-3 p-4 bg-white">
                      <div class="row align-items-center g-4">
                          
                          <!-- Sisi Kiri: Foto Melingkar -->
                          <div class="col-12 col-md-3 text-center">
                              <div class="position-relative d-inline-block p-1 bg-white border border-warning rounded-circle shadow-sm" style="width: 140px; height: 140px;">
                                  <!-- Ganti 'ketua.png' dengan nama file aset foto Anda -->
                                  <img src="{{ asset('template/assets/img/yanwar.png') }}"
                                      class="img-fluid rounded-circle w-100 h-100" 
                                      style="object-fit: cover;" 
                                      alt="Priyono, S.Pd.">
                              </div>
                          </div>
                          
                          <!-- Sisi Kanan: Konten Teks -->
                          <div class="col-12 col-md-9">
                              <div class="lh-base">
                                  <!-- Judul Sambutan -->
                                  <h3 class="fw-bold text-dark h5 mb-1 font-bs">Sambutan Ketua DKM</h3>
                                  
                                  <!-- Nama dan Gelar (Warna Hijau) -->
                                  <p class="text-success fw-semibold mb-2" style="font-size: 0.95rem;">Ustdz Yanwar Fahri, S.Pd.I</p>
                                  
                                  <!-- Isi Teks Sambutan (Miring / Italic) -->
                                  <p class="text-secondary fst-italic mb-3" style="text-align: justify; font-size: 0.9rem;">
                                      "Assalamualaikum Warahmatullahi Wabarakatuh."Puji syukur senantiasa kita panjatkan ke hadirat Allah SWT, karena atas limpahan rahmat, taufik, dan hidayah-Nya, kita masih diberikan nikmat iman, Islam, serta kesehatan sehingga dapat terus memakmurkan rumah Allah ini. Salawat serta salam semoga tercurah limpahkan kepada junjungan kita Nabi Besar Muhammad SAW, keluarganya, sahabatnya, serta pengikutnya hingga akhir zaman."
                                  </p>
                                  
                                  <!-- Tombol Baca Selengkapnya (Warna Hijau dengan Panah) -->
                                  <div class="text-start">
                                      <a href="{{ route('sambutan') }}" class="text-success text-decoration-none fw-bold small d-inline-flex align-items-center">
                                          Baca Selengkapnya 
                                          <span class="ms-1">&rarr;</span>
                                      </a>
                                  </div>
                              </div>
                          </div>

                      </div> <!-- /row -->
                  </div> <!-- /card -->
              </div>
          </div>
      </div>
    </section>
</div>