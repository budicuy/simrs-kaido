<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pasien - Rumah Sakit Islam Banjarmasin</title>
    <link rel="stylesheet" href="{{ asset('css/style/style-pasien.css') }}">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <style>
        .loading-message, .no-data-message, .error-message {
            text-align: center;
            padding: 20px;
            font-size: 1.1em;
            color: #555;
        }
        .error-message {
            color: red;
            font-weight: bold;
        }
        .aksi {
            width: 20px;
            height: 20px;
            vertical-align: middle;
            margin: 0 3px;
        }
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
            <div class="profile-trigger" onclick="toggleProfilePopup()"><img src="{{ asset('image/admin.svg') }}" alt="Logo RS"><span class="logo_name"><h5>RUMAH SAKIT ISLAM<br>BANJARMASIN</h5></span></div>
<div id="profile-popup" class="profile-popup hidden">
                <div class="popup-content">
                    <img src="{{ asset('image/admin.svg') }}" alt="User" class="popup-icon">
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
            <h3>Data Pasien</h3>
            <a href="index-pasien_tambah.html" class="add-btn">
                Tambah <i class="bx bxs-plus-circle"></i>
            </a>
        </div>
        <div class="card">
            <div class="top-bar">
                <div class="search-group">
                    <input type="text" id="searchInput" placeholder="Cari berdasarkan Nama, NIK, atau RM" />
                    <button class="search-btn" id="searchButton"><i class="bx bx-search"></i></button>
                </div>
                <button class="filter-btn" style="display: none;"><img src="{{ asset('image/Input.svg') }}" alt="Logo RS"><span class="logo_name"><h5>RUMAH SAKIT ISLAM<br>BANJARMASIN</h5></span></button>
            </div>
            <div id="loadingMessage" class="loading-message">Memuat data pasien...</div>
            <div id="errorMessage" class="error-message" style="display: none;"></div>
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Rekam Medis</th>
                        <th>NIK</th>
                        <th>Nama Pasien</th>
                        <th>Tanggal Lahir</th>
                        <th>Agama</th>
                        <th>Kabupaten</th>
                        <th>Pekerjaan</th>
                        <th>Jenis Kelamin</th>
                        <th>Alamat</th>
                        <th>No Hp</th>
                        <th>Email</th>
                        <th>Gol. Darah</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="pasienTableBody"></tbody>
            </table>
            <div id="noDataMessage" class="no-data-message" style="display: none;">Tidak ada data pasien yang ditemukan.</div>
            <div class="pagination-wrapper">
                <div class="pagination-center" id="paginationInfo">Halaman -/-</div>
            </div>
        </div>
    </main>

    <script>
        const BASE_API_URL = 'https://nazarfadil.me/api';

        // --- Elemen HTML ---
        const pasienTableBody = document.getElementById('pasienTableBody');
        const loadingMessage = document.getElementById('loadingMessage');
        const errorMessage = document.getElementById('errorMessage');
        const noDataMessage = document.getElementById('noDataMessage');
        const paginationInfo = document.getElementById('paginationInfo');
        const searchInput = document.getElementById('searchInput');
        const searchButton = document.getElementById('searchButton');
        const userNameDisplay = document.getElementById('userNameDisplay');
        const userRoleDisplay = document.getElementById('userRoleDisplay');
        const logoutButton = document.getElementById('logoutButton');

        // --- Variabel Global untuk menyimpan data ---
        let allPasiens = [];

        // --- Proteksi Halaman & Data User ---
        const authToken = localStorage.getItem('auth_token');
        if (!authToken) {
            alert('Anda harus login terlebih dahulu.');
            window.location.href = '{{ route('index') }}';
        }
        userNameDisplay.textContent = localStorage.getItem('user_name') || 'User';
        userRoleDisplay.textContent = localStorage.getItem('user_role') || 'N/A';

        // --- Fungsionalitas Logout ---
        logoutButton.addEventListener('click', async (event) => {
            event.preventDefault();
            if (!confirm('Apakah Anda yakin ingin keluar?')) return;
            try {
                await fetch(`${BASE_API_URL}/logout`, {
                    method: 'POST',
                    headers: { 'Accept': 'application/json', 'Authorization': `Bearer ${authToken}` }
                });
            } catch (error) {
                console.error('Error saat logout:', error);
            } finally {
                localStorage.clear();
                window.location.href = '{{ route('index') }}';
            }
        });

        // --- Fungsi untuk memformat tanggal ---
        function formatTanggal(tanggal) {
            if (!tanggal) return '-';
            return new Date(tanggal).toLocaleDateString('id-ID', {
                day: '2-digit', month: 'long', year: 'numeric'
            });
        }

        // --- Fungsi untuk menampilkan data pasien ke tabel ---
        function displayPasiens(pasiens) {
            loadingMessage.style.display = 'none';
            pasienTableBody.innerHTML = '';

            if (pasiens.length === 0) {
                noDataMessage.style.display = 'block';
                paginationInfo.textContent = 'Halaman 0/0';
            } else {
                noDataMessage.style.display = 'none';
                pasiens.forEach((pasien, index) => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${index + 1}</td>
                        <td>${pasien.rm || '-'}</td>
                        <td>${pasien.nik || '-'}</td>
                        <td>${pasien.nama_pasien || '-'}</td>
                        <td>${formatTanggal(pasien.tgl_lahir)}</td>
                        <td>${pasien.agama || '-'}</td>
                        <td>${pasien.kabupaten || '-'}</td>
                        <td>${pasien.pekerjaan || '-'}</td>
                        <td>${pasien.jns_kelamin || '-'}</td>
                        <td>${pasien.alamat || '-'}</td>
                        <td>${pasien.no_hp_pasien || '-'}</td>
                        <td>${pasien.email_pasien || '-'}</td>
                        <td>${pasien.gol_darah || '-'}</td>
                        <td>
                            <a href="index-pasien_detail.html?rm=${pasien.rm}"><img src="{{ asset('image/logo.svg') }}" alt="Logo RS"><span class="logo_name"><h5>RUMAH SAKIT ISLAM<br>BANJARMASIN</h5></span></div>eye.svg" alt="Detail" class="aksi"></a>
                        </td>
                    `;
                    pasienTableBody.appendChild(row);
                });
                // Placeholder untuk pagination
                paginationInfo.textContent = `Halaman 1/1`;
            }
        }

        // --- Fungsi untuk mengambil data dari API ---
        async function loadData() {
            loadingMessage.style.display = 'block';
            errorMessage.style.display = 'none';
            noDataMessage.style.display = 'none';

            try {
                const response = await fetch(`${BASE_API_URL}/pasiens`, {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': `Bearer ${authToken}`
                    }
                });

                if (!response.ok) {
                    if (response.status === 401) throw new Error('Unauthenticated');
                    const errorDetails = await response.json();
                    throw new Error(errorDetails.message || 'Gagal mengambil data.');
                }

                const result = await response.json();
                allPasiens = result.data || [];
                displayPasiens(allPasiens);

            } catch (error) {
                loadingMessage.style.display = 'none';
                if (error.message.includes('Unauthenticated')) {
                    alert('Sesi Anda telah berakhir. Silakan login kembali.');
                    localStorage.clear();
                    window.location.href = '{{ route('index') }}';
                } else {
                    errorMessage.textContent = 'Gagal memuat data pasien: ' + error.message;
                    errorMessage.style.display = 'block';
                }
            }
        }

        // --- Fungsionalitas Pencarian ---
        function handleSearch() {
            const query = searchInput.value.trim().toLowerCase();
            if (!query) {
                displayPasiens(allPasiens); // Tampilkan semua jika input kosong
                return;
            }

            const filteredPasiens = allPasiens.filter(pasien => {
                const nama = String(pasien.nama_pasien || '').toLowerCase();
                const nik = String(pasien.nik || '').toLowerCase();
                const rm = String(pasien.rm || '').toLowerCase();
                return nama.includes(query) || nik.includes(query) || rm.includes(query);
            });

            displayPasiens(filteredPasiens);
        }

        searchButton.addEventListener('click', handleSearch);
        searchInput.addEventListener('keypress', (event) => {
            if (event.key === 'Enter') handleSearch();
        });
        searchInput.addEventListener('input', handleSearch); // Pencarian real-time

        // --- Panggil fungsi utama saat halaman dimuat ---
        document.addEventListener('DOMContentLoaded', loadData);

        // --- Kode untuk sidebar dan popup profil (tidak diubah) ---
        let arrow = document.querySelectorAll(".arrow");
        for (var i = 0; i < arrow.length; i++) {
            arrow[i].addEventListener("click", (e) => {
                let arrowParent = e.target.parentElement.parentElement;
                arrowParent.classList.toggle("showMenu");
            });
        }
        let sidebar = document.querySelector(".sidebar");
        let sidebarBtn = document.querySelector(".bx-menu");
        sidebarBtn.addEventListener("click", () => {
            sidebar.classList.toggle("close");
        });
        function toggleProfilePopup() {
            const popup = document.getElementById("profile-popup");
            popup.classList.toggle("hidden");
        }
        document.addEventListener("click", function (e) {
            const trigger = document.querySelector(".profile-trigger");
            const popup = document.getElementById("profile-popup");
            if (trigger && popup && !trigger.contains(e.target) && !popup.contains(e.target)) {
                popup.classList.add("hidden");
            }
        });
    </script>
</body>

</html>
