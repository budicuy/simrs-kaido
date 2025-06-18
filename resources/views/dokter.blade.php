<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Dokter - Rumah Sakit Islam Banjarmasin</title>
    <link rel="stylesheet" href="{{ asset ('css/style/style-layanan.css') }}">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <style>
        /* Gaya tambahan untuk pesan feedback */
        .feedback-message {
            margin-top: 20px;
            padding: 10px 15px;
            border-radius: 5px;
            font-weight: bold;
            text-align: center;
            display: none; /* Default hidden */
        }
        .feedback-message.success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .feedback-message.error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .info-message {
            text-align: center;
            padding: 20px;
            font-size: 1.1em;
            color: #555;
        }
        .error-message {
            color: red;
            font-weight: bold;
        }

        /* Styling for table actions */
        .aksi {
            width: 20px; /* Adjust as needed */
            height: 20px; /* Adjust as needed */
            vertical-align: middle;
            margin: 0 3px;
        }
        td .aksi {
            cursor: pointer;
        }

        /* Styling for modal (popup) */
        .popup {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .popup-confirm {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            width: 90%;
        }

        .popup-confirm h3 {
            margin-top: 0;
            color: #333;
        }

        .popup-confirm p {
            margin-bottom: 20px;
            color: #666;
        }

        .popup-buttons {
            display: flex;
            justify-content: center;
            gap: 15px;
        }

        .btn-cancel, .btn-delete {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
            transition: background-color 0.3s ease;
        }

        .btn-cancel {
            background-color: #ccc;
            color: #333;
        }

        .btn-cancel:hover {
            background-color: #bbb;
        }

        .btn-delete {
            background-color: #dc3545;
            color: white;
        }

        .btn-delete:hover {
            background-color: #c82333;
        }
        /* Tambahkan style untuk pesan loading agar ada tempatnya */
        .loading-message {
            text-align: center;
            padding: 20px;
            font-size: 1.1em;
            color: #555;
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
                    <img src="{{ asset('image/logo.svg') }}" alt="Logo RS">beranda.svg" alt="Beranda">
                    <span class="link_name">Beranda</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a href="{{ route('dashboard') }}" class="link_name">Beranda</a></li>
                </ul>
            </li>
            <li>
                <div class="icon-link">
                    <a href="{{ route('pendaftaran') }}">
                        <img src="{{ asset('image/logo.svg') }}" alt="Logo RS">kunjungan.svg" alt="Kunjungan">
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
                    <img src="{{ asset('image/logo.svg') }}" alt="Logo RS">pasien.svg" alt="Pasien">
                    <span class="link_name">Pasien</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a href="{{ route('pasien') }}" class="link_name">Pasien</a></li>
                </ul>
            </li>
            <li>
                <div class="icon-link active">
                    <a href="{{ route('poli') }}">
                        <img src="{{ asset('image/logo.svg') }}" alt="Logo RS">kunjungan.svg" alt="Layanan">
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
        <div class="main-content">
        </div>
        <div class="card">
            <div class="content-header"><h3>
                    <a href="{{ route('dokter') }}" class="sub-link" style="color: #000; text-decoration: none;">Data Dokter</a>
                </h3>
            </div>
            <div id="loadingMessage" class="loading-message">Memuat data dokter...</div>
            <div id="errorMessage" class="info-message error-message" style="display: none;"></div>
            <div id="feedbackMessage" class="feedback-message" style="display: none;"></div>

            <div class="top-bar">
                <div class="left-group">
                    <div class="search-group">
                        <input type="text" placeholder="Cari berdasarkan Nama Dokter" id="searchInput" />
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
                            <th>ID Dokter</th>
                            <th>Nama Dokter</th>
                            <th>Spesialis</th>
                            <th>No Handphone</th>

                            </tr>
                    </thead>
                    <tbody id="dokterTableBody">
                        </tbody>
                </table>
            </div>
            <div id="noDataMessage" class="info-message" style="display: none;">Tidak ada data dokter.</div>

            <div class="pagination-wrapper" style="display: none;">
                <div class="pagination-center">Halaman 1/1</div>
                <a href="#" class="pagination-next"><img src="{{ asset('image/logo.svg') }}" alt="Logo RS">image/hal-lanjut.svg" alt=""></a>
            </div>
        </div>
    </main>

    <script>
    // Konfigurasi dasar API
    const BASE_API_URL = 'https://nazarfadil.me/api';

    // --- Elemen HTML yang akan dimanipulasi ---
    const dokterTableBody = document.getElementById('dokterTableBody');
    const loadingMessage = document.getElementById('loadingMessage');
    const errorMessage = document.getElementById('errorMessage');
    const noDataMessage = document.getElementById('noDataMessage');
    const feedbackMessage = document.getElementById('feedbackMessage');
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
    } else {
        userNameDisplay.textContent = userName || 'User';
        userRoleDisplay.textContent = userRole || 'N/A';
    }

    // --- Fungsionalitas Logout ---
    logoutButton.addEventListener('click', async (event) => {
        event.preventDefault();
        if (!confirm('Apakah Anda yakin ingin keluar?')) {
            return;
        }
        try {
            await fetch(`${BASE_API_URL}/logout`, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': `Bearer ${authToken}`
                }
            });
        } catch (error) {
            console.error('Error saat proses logout:', error);
        } finally {
            // Selalu hapus data lokal dan redirect, bahkan jika API call gagal
            localStorage.removeItem('auth_token');
            localStorage.removeItem('user_role');
            localStorage.removeItem('user_name');
            window.location.href = '{{ route('index') }}';
        }
    });

    /**
     * [MODIFIKASI] Fungsi utama untuk memuat dan menampilkan data dokter.
     * Fungsi ini sekarang menangani pengambilan data awal dan data hasil pencarian.
     * @param {string} searchQuery - Kata kunci pencarian untuk nama dokter.
     */
    async function loadDokters(searchQuery = '') {
        loadingMessage.style.display = 'block';
        errorMessage.style.display = 'none';
        noDataMessage.style.display = 'none';
        dokterTableBody.innerHTML = '';

        // [MODIFIKASI] Endpoint API yang benar untuk data dokter
        let url = `${BASE_API_URL}/dokters`;

        // Jika ada query pencarian, tambahkan sebagai parameter URL
        // Ini mengasumsikan API Anda mendukung filter pencarian di backend (contoh: /api/dokters?search=nama)
        if (searchQuery) {
            url += `?search=${encodeURIComponent(searchQuery)}`;
        }

        try {
            const response = await fetch(url, {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': `Bearer ${authToken}`
                }
            });

            if (!response.ok) {
                // Jika token tidak valid (401 Unauthorized), redirect ke login
                if (response.status === 401) {
                    alert('Sesi Anda telah berakhir. Silakan login kembali.');
                    localStorage.removeItem('auth_token');
                    localStorage.removeItem('user_role');
                    localStorage.removeItem('user_name');
                    window.location.href = '{{ route('index') }}';
                    return; // Hentikan eksekusi lebih lanjut
                }
                const errorDetails = await response.json().catch(() => null);
                throw new Error(errorDetails?.message || `Gagal memuat data: Status ${response.status}`);
            }

            const result = await response.json();

            // [MODIFIKASI] Mengakses array dokter dari properti 'data'
            const dokters = Array.isArray(result.data) ? result.data : [];

            loadingMessage.style.display = 'none';

            if (dokters.length === 0) {
                noDataMessage.style.display = 'block';
                if (searchQuery) {
                    noDataMessage.textContent = `Data dokter dengan nama "${searchQuery}" tidak ditemukan.`;
                } else {
                    noDataMessage.textContent = 'Tidak ada data dokter yang tersedia.';
                }
                return;
            }

            // [MODIFIKASI] Loop melalui data dokter dan sesuaikan dengan kunci JSON
            dokters.forEach((dokter, index) => {
                const row = document.createElement('tr');
                // Menggunakan kunci dari API: id, nama_dokter, no_hp_dokter
                // Untuk 'Spesialis', kita beri placeholder '-' karena tidak ada di API.
                row.innerHTML = `
                    <td>${index + 1}</td>
                    <td>${dokter.id}</td>
                    <td>${dokter.nama_dokter}</td>
                    <td>-</td>
                    <td>${dokter.no_hp_dokter || '-'}</td>
                `;
                dokterTableBody.appendChild(row);
            });

        } catch (error) {
            loadingMessage.style.display = 'none';
            errorMessage.style.display = 'block';
            errorMessage.textContent = 'Terjadi kesalahan: ' + error.message;
            console.error('Error fetching doctors data:', error);
        }
    }

    // --- Fungsionalitas Pencarian [MODIFIKASI] ---
    // Logika pencarian dibuat lebih sederhana dengan memanggil fungsi loadDokters
    function handleSearch() {
        const query = searchInput.value.trim();
        loadDokters(query);
    }

    searchButton.addEventListener('click', handleSearch);

    searchInput.addEventListener('keypress', (event) => {
        if (event.key === 'Enter') {
            handleSearch();
        }
    });

    // --- Panggilan Awal ---
    // Panggil fungsi untuk memuat semua data saat halaman pertama kali dibuka.
    document.addEventListener('DOMContentLoaded', () => {
        loadDokters();
    });

    // --- Kode untuk sidebar dan popup profil yang sudah ada (tidak perlu diubah) ---
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
        // Inisialisasi Date Range Picker (tetap ada jika suatu saat dibutuhkan)
        $(function () {
            $('#dateRange').daterangepicker({
                opens: 'right',
                locale: {
                    format: 'DD MMMYYYY'
                }
            }, function (start, end) {
                console.log("Dari:", start.format('YYYY-MM-DD'), "Sampai:", end.format('YYYY-MM-DD'));
                // Kamu bisa trigger filter di sini jika diaktifkan
            });
        });
    </script>
</body>

</html>
