<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Poli - Rumah Sakit Islam Banjarmasin</title>
    <link rel="stylesheet" href="{{ asset('css/style/style-layanan.css') }}">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <style>
        /* Gaya CSS Anda (tidak diubah, dibiarkan seperti aslinya) */
        .feedback-message { margin-top: 20px; padding: 10px 15px; border-radius: 5px; font-weight: bold; text-align: center; display: none; }
        .feedback-message.success { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .feedback-message.error { background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        .info-message { text-align: center; padding: 20px; font-size: 1.1em; color: #555; }
        .error-message { color: red; font-weight: bold; }
        .aksi { width: 20px; height: 20px; vertical-align: middle; margin: 0 3px; }
        td .aksi { cursor: pointer; }
        .popup { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); display: flex; justify-content: center; align-items: center; z-index: 1000; }
        .popup-confirm { background-color: white; padding: 30px; border-radius: 8px; text-align: center; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); max-width: 400px; width: 90%; }
        .popup-confirm h3 { margin-top: 0; color: #333; }
        .popup-confirm p { margin-bottom: 20px; color: #666; }
        .popup-buttons { display: flex; justify-content: center; gap: 15px; }
        .btn-cancel, .btn-delete { padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; font-size: 1em; transition: background-color 0.3s ease; }
        .btn-cancel { background-color: #ccc; color: #333; }
        .btn-cancel:hover { background-color: #bbb; }
        .btn-delete { background-color: #dc3545; color: white; }
        .btn-delete:hover { background-color: #c82333; }
        .loading-message { text-align: center; padding: 20px; font-size: 1.1em; color: #555; }
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
            <li><a href="{{ route('dashboard') }}"><img src="{{ asset('image/logo.svg') }}" alt="Logo RS">/beranda.svg" alt="Beranda"><span class="link_name">Beranda</span></a><ul class="sub-menu blank"><li><a href="{{ route('dashboard') }}" class="link_name">Beranda</a></li></ul></li>
            <li><div class="icon-link"><a href="{{ route('pendaftaran') }}"><img src="{{ asset('image/logo.svg') }}" alt="Logo RS">image/kunjungan.svg" alt="Kunjungan"><span class="link_name">Pendaftaran</span></a><i class="bx bx-chevron-down arrow"></i></div><ul class="sub-menu"><li><a href="#" class="link_name">Pendaftaran</a></li><li><a href="{{ route('pendaftaran') }}">Pendaftaran Hari Ini</a></li><li><a href="{{ route('pendaftaran.riwayat') }}">Riwayat Pendaftaran</a></li></ul></li>
            <li><a href="{{ route('pasien') }}"><img src="{{ asset('image/logo.svg') }}" alt="Logo RS">image/pasien.svg" alt="Pasien"><span class="link_name">Pasien</span></a><ul class="sub-menu blank"><li><a href="{{ route('pasien') }}" class="link_name">Pasien</a></li></ul></li>
            <li><div class="icon-link active"><a href="{{ route('poli') }}"><img src="{{ asset('image/logo.svg') }}" alt="Logo RS">mage/kunjungan.svg" alt="Layanan"><span class="link_name">Layanan</span></a><i class="bx bx-chevron-down arrow"></i></div><ul class="sub-menu"><li><a href="#" class="link_name">Layanan</a></li><li><a href="{{ route('poli') }}">Poli</a></li><li><a href="{{ route('dokter') }}">Dokter</a></li><li><a href="{{ route('perawat') }}">Perawat</a></li></ul></li>
            <li class="logout"><a href="#" id="logoutButton" class="keluar"><img src="{{ asset('image/logo.svg') }}" alt="Logo RS">image/keluar.svg" alt="Keluar"><span class="link_name">Keluar</span></a><ul class="sub-menu blank"><li><a href="#" class="link_name">Keluar</a></li></ul></li>
        </ul>
    </div>

    <section class="home-section">
        <div class="home-content">
            <i class="bx bx-menu"></i>
            <div class="profile-trigger" onclick="toggleProfilePopup()">
                <img src="{{ asset('image/logo.svg') }}" alt="Logo RS">admin.svg" alt="User" class="profile-icon">
            </div>
            <div id="profile-popup" class="profile-popup hidden">
                <div class="popup-content">
                    <img src="{{ asset('image/logo.svg') }}" alt="Logo RS">admin.svg" alt="User" class="popup-icon">
                    <div>
                        <div class="popup-name" id="userNameDisplay">Memuat...</div>
                        <div class="popup-role" id="userRoleDisplay">Memuat...</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <main>
        <div class="main-content"></div>
        <div class="card">
            <div class="content-header">
                <h3><a href="{{ route('poli') }}" class="sub-link" style="color: #000; text-decoration: none;">Data Poli</a></h3>
            </div>
            <div id="loadingMessage" class="loading-message">Memuat data poli...</div>
            <div id="errorMessage" class="info-message error-message" style="display: none;"></div>
            <div id="feedbackMessage" class="feedback-message" style="display: none;"></div>

            <div class="top-bar">
                <div class="left-group">
                    <div class="search-group">
                        <input type="text" placeholder="Cari berdasarkan Nama Poli" id="searchInput" />
                        <button class="search-btn" id="searchButton"><i class="bx bx-search"></i></button>
                    </div>
                </div>
                <button class="filter-btn" style="display: none;"><img src="{{ asset('image/logo.svg') }}" alt="Logo RS">image/Input.svg" alt=""></button>
            </div>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID Poli</th>
                            <th>Nama Poli</th>
                            <th>Nama Dokter</th>
                            <th>Nama Perawat</th>
                        </tr>
                    </thead>
                    <tbody id="poliTableBody"></tbody>
                </table>
            </div>
            <div id="noDataMessage" class="info-message" style="display: none;">Tidak ada data poli.</div>
            <div class="pagination-wrapper" style="display: none;">
                <div class="pagination-center">Halaman 1/1</div>
                <a href="#" class="pagination-next"><img src="{{ asset('image/logo.svg') }}" alt="Logo RS">image/hal-lanjut.svg" alt=""></a>
            </div>
        </div>
    </main>

    <script>
        const BASE_API_URL = 'https://nazarfadil.me/api';

        // --- Elemen HTML ---
        const poliTableBody = document.getElementById('poliTableBody');
        const loadingMessage = document.getElementById('loadingMessage');
        const errorMessage = document.getElementById('errorMessage');
        const noDataMessage = document.getElementById('noDataMessage');
        const searchInput = document.getElementById('searchInput');
        const searchButton = document.getElementById('searchButton');
        const userNameDisplay = document.getElementById('userNameDisplay');
        const userRoleDisplay = document.getElementById('userRoleDisplay');
        const logoutButton = document.getElementById('logoutButton');

        // --- Proteksi Halaman & Data User ---
        const authToken = localStorage.getItem('auth_token');
        const userRole = localStorage.getItem('user_role');
        const userName = localStorage.getItem('user_name');

        if (!authToken) {
            alert('Anda harus login terlebih dahulu.');
            window.location.href = '{{ route('index') }}';
        }

        userNameDisplay.textContent = userName || 'User';
        userRoleDisplay.textContent = userRole || 'N/A';

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

        // --- Variabel Global untuk menyimpan data ---
        let allPolis = [];
        let dokterMap = new Map();
        let perawatMap = new Map();

        // --- Fungsi untuk memuat semua data yang diperlukan ---
        async function loadData() {
            loadingMessage.style.display = 'block';
            errorMessage.style.display = 'none';
            noDataMessage.style.display = 'none';
            poliTableBody.innerHTML = '';

            const fetchOptions = {
                method: 'GET',
                headers: { 'Accept': 'application/json', 'Authorization': `Bearer ${authToken}` }
            };

            try {
                // Gunakan Promise.all untuk mengambil semua data secara paralel
                const [poliRes, dokterRes, perawatRes] = await Promise.all([
                    fetch(`${BASE_API_URL}/polis`, fetchOptions),
                    fetch(`${BASE_API_URL}/dokters`, fetchOptions),
                    fetch(`${BASE_API_URL}/perawats`, fetchOptions)
                ]);

                if (!poliRes.ok || !dokterRes.ok || !perawatRes.ok) {
                     if (poliRes.status === 401 || dokterRes.status === 401 || perawatRes.status === 401) {
                         throw new Error('Unauthenticated');
                    }
                    throw new Error('Gagal mengambil salah satu data penting.');
                }

                const polisData = await poliRes.json();
                const doktersData = await dokterRes.json();
                const perawatsData = await perawatRes.json();

                // Simpan data poli ke variabel global
                allPolis = polisData.data || [];

                // Buat Peta (Map) untuk pencarian nama yang efisien
                // Asumsi: API dokter mengembalikan `id` dan `nama_dokter`
                // Asumsi: API perawat mengembalikan `id` dan `nama_perawat`
                dokterMap = new Map((doktersData.data || []).map(d => [d.id, d.nama_dokter]));
                perawatMap = new Map((perawatsData.data || []).map(p => [p.id, p.nama_perawat]));

                // Tampilkan semua data poli yang sudah digabungkan
                displayPolis(allPolis);

            } catch (error) {
                loadingMessage.style.display = 'none';
                if (error.message.includes('Unauthenticated')) {
                    alert('Sesi Anda telah berakhir. Silakan login kembali.');
                    localStorage.clear();
                    window.location.href = '{{ route('index') }}';
                } else {
                    errorMessage.textContent = 'Gagal memuat data: ' + error.message;
                    errorMessage.style.display = 'block';
                }
            }
        }

        // --- Fungsi untuk menampilkan data poli ke tabel ---
        function displayPolis(polis) {
            loadingMessage.style.display = 'none';
            poliTableBody.innerHTML = ''; // Selalu kosongkan tabel sebelum mengisi

            if (polis.length === 0) {
                noDataMessage.style.display = 'block';
                return;
            }

            noDataMessage.style.display = 'none';

            polis.forEach((poli, index) => {
                const row = document.createElement('tr');

                // Ambil nama dari Map, berikan '-' jika tidak ditemukan
                const namaDokter = dokterMap.get(poli.id_dokter) || '-';
                const namaPerawat = perawatMap.get(poli.id_perawat) || '-';

                row.innerHTML = `
                    <td>${index + 1}</td>
                    <td>${poli.id}</td>
                    <td>${poli.nama_poli}</td>
                    <td>${namaDokter}</td>
                    <td>${namaPerawat}</td>
                `;
                poliTableBody.appendChild(row);
            });
        }

        // --- Fungsionalitas Pencarian ---
        function handleSearch() {
            const query = searchInput.value.trim().toLowerCase();
            if (!query) {
                displayPolis(allPolis); // Tampilkan semua jika input kosong
                return;
            }

            const filteredPolis = allPolis.filter(poli =>
                poli.nama_poli.toLowerCase().includes(query)
            );

            displayPolis(filteredPolis);
        }

        searchButton.addEventListener('click', handleSearch);
        searchInput.addEventListener('keypress', (event) => {
            if (event.key === 'Enter') {
                handleSearch();
            }
        });
        searchInput.addEventListener('input', handleSearch); // Pencarian real-time saat mengetik


        // Panggil fungsi untuk memuat data saat halaman dimuat
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
