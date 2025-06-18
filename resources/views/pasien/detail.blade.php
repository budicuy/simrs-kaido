<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pasien - Rumah Sakit Islam Banjarmasin</title>
    <link rel="stylesheet" href="{{ asset('css/style/style-pasien_tambah.css') }}">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <style>
        .info-message { text-align: center; padding: 20px; font-size: 1.1em; color: #555; }
        .error-message { color: red; font-weight: bold; }
        /* Pastikan input disabled terlihat jelas dan tidak bisa diinteraksi */
        .form-group input[disabled],
        .form-group textarea[disabled] {
            background-color: #e9ecef;
            opacity: 1;
            cursor: default;
            color: #495057;
        }
        .form-actions { display: flex; gap: 10px; justify-content: flex-end; margin-top: 20px; }
    </style>
</head>

<body>
    <div class="sidebar">
        <div class="logo-details">
            <img src="{{ asset('image/logo.svg') }}" alt="Logo RS">
            <span class="logo_name">
                <h5>RUMAH SAKIT ISLAM<br>BANJARMASIN</h5>
            </span>
        </div>
        <ul class="nav-links">
            <li>
                <a href="{{ route('dashboard') }}">
                    <img src="{{ asset('image/beranda.svg') }}" alt="Beranda">
                    <span class="link_name">Beranda</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a href="{{ route('dashboard') }}" class="link_name">Beranda</a></li>
                </ul>
            </li>
            <li>
                <div class="icon-link">
                    <a href="{{ route('pendaftaran') }}">
                        <img src="{{ asset('image/kunjungan.svg') }}" alt="Kunjungan">
                        <span class="link_name">Pendaftaran</span>
                    </a>
                    <i class="bx bx-chevron-down arrow"></i>
                </div>
                <ul class="sub-menu">
                    <li><a href="#" class="link_name">Pendaftaran</a></li>
                    <li><a href="{{ route('pendaftaran') }}">Pendaftaran Hari Ini</a></li>
                    <li><a href="{{ route('pendaftaran.riwayat') }}">Riwayat Pendaftaran</a></li>
                </ul>
            </li>
            <li>
                <a href="{{ route('pasien') }}">
                    <img src="{{ asset('image/pasien.svg') }}" alt="Pasien">
                    <span class="link_name">Pasien</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a href="{{ route('pasien') }}" class="link_name">Pasien</a></li>
                </ul>
            </li>
            <li>
                <div class="icon-link active">
                    <a href="{{ route('poli') }}">
                        <img src="{{ asset('image/kunjungan.svg') }}" alt="Layanan">
                        <span class="link_name">Layanan</span>
                    </a>
                    <i class="bx bx-chevron-down arrow"></i>
                </div>
                <ul class="sub-menu">
                    <li><a href="#" class="link_name">Layanan</a></li>
                    <li><a href="{{ route('poli') }}">Poli</a></li>
                    <li><a href="{{ route('dokter') }}">Dokter</a></li>
                    <li><a href="{{ route('perawat') }}">Perawat</a></li>
                </ul>
            </li>
            <li class="logout">
                <a href="#" id="logoutButton" class="keluar">
                    <img src="{{ asset('image/keluar.svg') }}" alt="Keluar">
                    <span class="link_name">Keluar</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a href="#" class="link_name">Keluar</a></li>
                </ul>
            </li>
        </ul>
    </div>
    <section class="home-section">
        <div class="home-content">
            <i class="bx bx-menu"></i>
            <div class="profile-trigger" onclick="toggleProfilePopup()">
                <img src="image/admin.svg" alt="User" class="profile-icon">
            </div>

            <div id="profile-popup" class="profile-popup hidden">
                <div class="popup-content">
                    <img src="image/admin.svg" alt="User" class="popup-icon">
                    <div>
                        <div class="popup-name" id="userNameDisplay">Memuat...</div>
                        <div class="popup-role" id="userRoleDisplay">Memuat...</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <main>
        <div class="main-content">
            <a href="{{ route('pasien') }}" class="sub">Data Pasien</a>
            <i class="bx bx-chevron-right"></i>
            <a href="#" class="sub-link">Detail Pasien</a>
        </div>
        <div class="card">
            <h3>Detail Pasien</h3>
            <div id="loadingMessage" class="info-message">Memuat detail pasien...</div>
            <div id="errorMessage" class="info-message error-message" style="display: none;"></div>

            <div id="detailPasienContainer" style="display: none;">
                <div class="form-grid">
                    <div class="form-group"><label>Rekam Medis (RM)</label><p id="rm" class="detail-text">-</p></div>
                    <div class="form-group"><label>NIK</label><p id="nik" class="detail-text">-</p></div>
                    <div class="form-group"><label>Nama Pasien</label><p id="nama_pasien" class="detail-text">-</p></div>
                    <div class="form-group"><label>Jenis Kelamin</label><p id="jns_kelamin" class="detail-text">-</p></div>
                    <div class="form-group"><label>Tanggal Lahir</label><p id="tgl_lahir" class="detail-text">-</p></div>
                    <div class="form-group"><label>Kabupaten</label><p id="kabupaten" class="detail-text">-</p></div>
                    <div class="form-group"><label>Agama</label><p id="agama" class="detail-text">-</p></div>
                    <div class="form-group"><label>Pekerjaan</label><p id="pekerjaan" class="detail-text">-</p></div>
                    <div class="form-group"><label>Nomor Hp</label><p id="no_hp_pasien" class="detail-text">-</p></div>
                    <div class="form-group"><label>Email</label><p id="email_pasien" class="detail-text">-</p></div>
                    <div class="form-group"><label>Golongan Darah</label><p id="gol_darah" class="detail-text">-</p></div>
                    <div class="form-group full-width"><label>Alamat</label><p id="alamat" class="detail-text" style="white-space: pre-wrap;">-</p></div>
                </div>
                <div class="form-actions full-width">
                    <a href="{{ route('pasien') }}" class="btn-1 btn-secondary">Kembali</a>
                    <a href="#" id="editButton" class="btn-2 btn-primary">Edit Data</a>
                </div>
            </div>
        </div>
    </main>

    <script>
        const BASE_API_URL = 'https://nazarfadil.me/api';

        // --- Elemen HTML ---
        const loadingMessage = document.getElementById('loadingMessage');
        const errorMessage = document.getElementById('errorMessage');
        const detailContainer = document.getElementById('detailPasienContainer');
        const editButton = document.getElementById('editButton');
        const userNameDisplay = document.getElementById('userNameDisplay');
        const userRoleDisplay = document.getElementById('userRoleDisplay');
        const logoutButton = document.getElementById('logoutButton');

        // --- Otentikasi & Data User ---
        const authToken = localStorage.getItem('auth_token');
        if (!authToken) {
            alert('Anda harus login terlebih dahulu.');
            window.location.href = '{{ route('index') }}';
        }
        userNameDisplay.textContent = localStorage.getItem('user_name') || 'User';
        userRoleDisplay.textContent = localStorage.getItem('user_role') || 'N/A';

        // --- Fungsi Logout ---
        logoutButton.addEventListener('click', async (event) => {
            event.preventDefault();
            if (!confirm('Apakah Anda yakin ingin keluar?')) return;
            try { await fetch(`${BASE_API_URL}/logout`, { method: 'POST', headers: { 'Accept': 'application/json', 'Authorization': `Bearer ${authToken}` }}); }
            catch (error) { console.error('Error saat logout:', error); }
            finally { localStorage.clear(); window.location.href = '{{ route('index') }}'; }
        });

        // --- Fungsi bantuan untuk mendapatkan parameter dari URL ---
        function getUrlParameter(name) {
            const params = new URLSearchParams(window.location.search);
            return params.get(name);
        }

        // --- Fungsi bantuan untuk memformat tanggal ---
        function formatTanggal(tanggalStr) {
            if (!tanggalStr) return '-';
            const options = { year: 'numeric', month: 'long', day: 'numeric' };
            return new Date(tanggalStr).toLocaleDateString('id-ID', options);
        }

        // --- Fungsi Utama: Mengambil dan Menampilkan Detail Pasien ---
        async function fetchPatientDetail() {
            const rm = getUrlParameter('rm');

            if (!rm) {
                loadingMessage.style.display = 'none';
                errorMessage.textContent = 'Gagal: Nomor Rekam Medis (RM) tidak ditemukan di URL.';
                errorMessage.style.display = 'block';
                return;
            }

            try {
                const response = await fetch(`${BASE_API_URL}/pasiens/${rm}`, {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': `Bearer ${authToken}`
                    }
                });

                if (!response.ok) {
                    throw new Error(response.status === 404 ? `Pasien dengan RM ${rm} tidak ditemukan.` : 'Gagal mengambil detail pasien.');
                }

                const result = await response.json();
                const pasien = result.data;

                // Mengisi elemen <p> dengan data pasien
                document.getElementById('rm').textContent = pasien.rm || '-';
                document.getElementById('nik').textContent = pasien.nik || '-';
                document.getElementById('nama_pasien').textContent = pasien.nama_pasien || '-';
                document.getElementById('jns_kelamin').textContent = pasien.jns_kelamin || '-';
                document.getElementById('tgl_lahir').textContent = formatTanggal(pasien.tgl_lahir);
                document.getElementById('kabupaten').textContent = pasien.kabupaten || '-';
                document.getElementById('agama').textContent = pasien.agama || '-';
                document.getElementById('pekerjaan').textContent = pasien.pekerjaan || '-';
                document.getElementById('no_hp_pasien').textContent = pasien.no_hp_pasien || '-';
                document.getElementById('email_pasien').textContent = pasien.email_pasien || '-';
                document.getElementById('gol_darah').textContent = pasien.gol_darah || '-';
                document.getElementById('alamat').textContent = pasien.alamat || '-';

                // Atur link tombol Edit secara dinamis
                editButton.href = `/pasien/${encodeURIComponent(pasien.rm)}/edit`;

                // Tampilkan container detail setelah data dimuat
                loadingMessage.style.display = 'none';
                detailContainer.style.display = 'block';

            } catch (error) {
                loadingMessage.style.display = 'none';
                errorMessage.textContent = error.message;
                errorMessage.style.display = 'block';
                console.error('Error fetching patient detail:', error);
            }
        }

        // Panggil fungsi untuk mengambil data saat halaman dimuat
        document.addEventListener('DOMContentLoaded', fetchPatientDetail);

        // --- Kode untuk sidebar dan popup profil yang sudah ada ---
        let arrow = document.querySelectorAll(".arrow");
        for (var i = 0; i < arrow.length; i++) { arrow[i].addEventListener("click", (e) => { e.target.parentElement.parentElement.classList.toggle("showMenu"); }); }
        let sidebar = document.querySelector(".sidebar");
        let sidebarBtn = document.querySelector(".bx-menu");
        sidebarBtn.addEventListener("click", () => { sidebar.classList.toggle("close"); });
        function toggleProfilePopup() { document.getElementById("profile-popup").classList.toggle("hidden"); }
        document.addEventListener("click", function (e) {
            const trigger = document.querySelector(".profile-trigger");
            const popup = document.getElementById("profile-popup");
            if (trigger && popup && !trigger.contains(e.target) && !popup.contains(e.target)) { popup.classList.add("hidden"); }
        });
    </script>
</body>

</html>
