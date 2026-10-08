<div>
    <nav id="navmenu" class="navmenu">
    <ul>
        <li><a href="/#hero" class="active" onclick="ubahAktif(this)">Home</a></li>
        <li><a href="/#about" onclick="ubahAktif(this)">About</a></li>
        <li><a href="/#program" onclick="ubahAktif(this)">Program</a></li>
        <li><a href="/#event" onclick="ubahAktif(this)">Event</a></li>
        <li><a href="{{ route('login') }}">Login</a></li>
    </ul>
    <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
</nav>

<script>
    function ubahAktif(elemen) {
        // Gunakan setTimeout agar kode kita dieksekusi SETELAH skrip bawaan templat selesai berjalan
        setTimeout(() => {
            // 1. Hapus class active dan reset warna dari semua link
            document.querySelectorAll('#navmenu ul li a').forEach(link => {
                link.classList.remove('active');
                link.style.color = ''; // Reset warna manual jika ada
                link.style.fontWeight = ''; // Reset ketebalan teks jika ada
            });
            
            // 2. Tambahkan class active ke menu yang diklik
            elemen.classList.add('active');

            // 3. Paksa warna aktif secara langsung via CSS inline (mengantisipasi bentrokan CSS)
            elemen.style.color = '#ffffff'; // Ganti dengan kode warna aktif Anda (misal: #ffffff atau #007bff)
            elemen.style.fontWeight = 'bold';
        }, 50); // Menunda selama 50 milidetik
    }
</script>


</div>