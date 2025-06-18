<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pendaftaran - Rumah Sakit Islam Banjarmasin</title>
    <link rel="stylesheet" href="{{ asset('css/style/style-pendaftaran.css') }}">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        /* CSS Anda tidak perlu diubah, ini hanya untuk kelengkapan */
        .feedback-message { margin-top: 20px; padding: 10px 15px; border-radius: 5px; font-weight: bold; text-align: center; display: none; }
        .feedback-message.success { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .feedback-message.error { background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        .info-message { text-align: center; padding: 20px; font-size: 1.1em; color: #555; }
        .error-message { color: red; font-weight: bold; }
        .aksi img { width: 20px; height: 20px; vertical-align: middle; margin: 0 3px; cursor: pointer; }
        .modal-overlay { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); display: none; justify-content: center; align-items: center; z-index: 1000; }
        .modal-overlay.show { display: flex; }
        .modal-box { background-color: white; padding: 30px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); max-width: 500px; width: 90%; position: relative; }
        .modal-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; border-bottom: 1px solid #eee; padding-bottom: 10px; }
        .modal-header h3 { margin: 0; color: #333; }
        .close-btn { font-size: 24px; cursor: pointer; color: #aaa; }
        .close-btn:hover { color: #333; }
        .modal-body .form-group { margin-bottom: 15px; }
        .modal-body label { display: block; margin-bottom: 5px; font-weight: bold; color: #555; }
        .modal-body input[type="text"] { width: calc(100% - 20px); padding: 10px; border: 1px solid #ccc; border-radius: 5px; background-color: #f9f9f9; font-size: 1em; color: #333; }
        .modal-footer { display: flex; justify-content: flex-end; gap: 15px; margin-top: 20px; border-top: 1px solid #eee; padding-top: 15px; }
        .btn-cancel { background-color: #ccc; color: #333; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; font-size: 1em; }
        .btn-cancel:hover { background-color: #bbb; }
        .status-selesai { color: #28a745; font-weight: bold; }
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
            </div></div>
    </section>

    <main>
        <div class="main-content">
            <h3>Riwayat Pendaftaran</h3>
            <a href="index-pendaftaran_tambah.html" class="add-btn">Tambah <i class="bx bxs-plus-circle"></i></a>
        </div>
        <div class="card">
            <div id="loadingMessage" class="info-message">Memuat riwayat pendaftaran...</div>
            <div id="errorMessage" class="info-message error-message" style="display: none;"></div>
            <div class="top-bar">
                <div class="search-group">
                    <input type="text" placeholder="Cari berdasarkan Nama Pasien atau No. RM" id="searchInput" />
                    <button class="search-btn" id="searchButton"><i class="bx bx-search"></i></button>
                </div>
            </div>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No. Regis</th>
                            <th>Nama Pasien</th>
                            <th>Poli</th>
                            <th>Dokter</th>
                            <th>No. Antrian</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="pendaftaranTableBody"></tbody>
                </table>
            </div>
            <div id="noDataMessage" class="info-message" style="display: none;">Tidak ada riwayat pendaftaran yang selesai.</div>
        </div>
    </main>

    <div class="modal-overlay" id="modalDetail"> </div>

    <script>
        const BASE_API_URL = 'https://nazarfadil.me/api';

        // --- Elemen HTML ---
        const pendaftaranTableBody = document.getElementById('pendaftaranTableBody');
        const loadingMessage = document.getElementById('loadingMessage');
        const errorMessage = document.getElementById('errorMessage');
        const noDataMessage = document.getElementById('noDataMessage');
        const searchInput = document.getElementById('searchInput');
        const searchButton = document.getElementById('searchButton');
        const modalDetail = document.getElementById('modalDetail');

        let riwayatPendaftaran = []; // Variabel untuk menyimpan data riwayat

        // --- Otentikasi & Inisialisasi Halaman ---
        const authToken = localStorage.getItem('auth_token');
        if (!authToken) {
            alert('Anda harus login terlebih dahulu.');
            window.location.href = '{{ route('index') }}';
        }
        document.addEventListener('DOMContentLoaded', () => {
            document.getElementById('userNameDisplay').textContent = localStorage.getItem('user_name') || 'User';
            document.getElementById('userRoleDisplay').textContent = localStorage.getItem('user_role') || 'N/A';
            loadHistoryData();
        });

        // --- Fungsi Logout ---
        document.getElementById('logoutButton').addEventListener('click', async (event) => { /* ... (Tidak berubah) ... */ });

        // --- Fungsi Utama ---
        async function loadHistoryData() {
            loadingMessage.style.display = 'block';
            errorMessage.style.display = 'none';
            noDataMessage.style.display = 'none';
            pendaftaranTableBody.innerHTML = '';

            // Opsi 1: Ambil semua data lalu filter (seperti ini)
            // Opsi 2 (Lebih Baik): Tambahkan parameter ke API: `${BASE_API_URL}/pendaftarans?status=Selesai`
            const fetchOptions = { headers: { 'Accept': 'application/json', 'Authorization': `Bearer ${authToken}` } };

            try {
                // Mengambil semua data yang dibutuhkan secara paralel
                const [pendaftaranRes, pasienRes, poliRes, dokterRes] = await Promise.all([
                    fetch(`${BASE_API_URL}/pendaftarans`, fetchOptions),
                    fetch(`${BASE_API_URL}/pasiens`, fetchOptions),
                    fetch(`${BASE_API_URL}/polis`, fetchOptions),
                    fetch(`${BASE_API_URL}/dokters`, fetchOptions)
                ]);

                if (!pendaftaranRes.ok || !pasienRes.ok || !poliRes.ok || !dokterRes.ok) {
                    throw new Error('Gagal mengambil salah satu data penting.');
                }

                const pendaftarans = (await pendaftaranRes.json()).data || [];
                const pasiens = (await pasienRes.json()).data || [];
                const polis = (await poliRes.json()).data || [];
                const dokters = (await dokterRes.json()).data || [];

                // Buat "Kamus" (Map) untuk pencocokan data yang cepat
                const pasienMap = new Map(pasiens.map(p => [p.rm, p]));
                const poliMap = new Map(polis.map(p => [p.id, p]));
                const dokterMap = new Map(dokters.map(d => [d.id, d]));

                // Gabungkan (agregasi) semua data, LALU FILTER
                riwayatPendaftaran = pendaftarans
                    .map(p => { // Pertama, gabungkan datanya
                        const pasien = pasienMap.get(p.rm) || {};
                        const poli = poliMap.get(p.id_poli) || {};
                        const dokter = dokterMap.get(poli.id_dokter) || {};
                        return { ...p, ...pasien, ...poli, nama_dokter: dokter.nama_dokter };
                    })
                    .filter(p => String(p.status).toLowerCase() === 'selesai'); // KEDUA, FILTER HANYA YANG "SELESAI"

                displayHistory(riwayatPendaftaran);

            } catch (error) {
                loadingMessage.style.display = 'none';
                errorMessage.textContent = 'Gagal memuat data: ' + error.message;
                errorMessage.style.display = 'block';
                console.error(error);
            }
        }

        function displayHistory(data) {
            loadingMessage.style.display = 'none';
            pendaftaranTableBody.innerHTML = '';

            if (data.length === 0) {
                noDataMessage.style.display = 'block';
                return;
            }

            noDataMessage.style.display = 'none';

            data.forEach((p, index) => {
                const statusClass = `status-selesai`; // Status pasti selesai
                const row = pendaftaranTableBody.insertRow();
                row.innerHTML = `
                    <td>${index + 1}</td>
                    <td>${p.id}</td>
                    <td>${p.nama_pasien || 'N/A'}</td>
                    <td>${p.nama_poli || 'N/A'}</td>
                    <td>${p.nama_dokter || 'N/A'}</td>
                    <td>${p.no_antrian}</td>
                    <td class="${statusClass}">${p.status}</td>
                    <td class="aksi">
                        <img src="{{ asset('image/logo.svg') }}" alt="Logo RS"><span class="logo_name"><h5>RUMAH SAKIT ISLAM<br>BANJARMASIN</h5></span></div>eye.svg" alt="Detail" title="Lihat Detail" onclick="openDetailModal(${p.id})">
                    </td>
                `;
            });
        }

        // Fungsionalitas Modal & Search tidak berubah, hanya sumber datanya yang berbeda
        function openDetailModal(id) {
            const p = riwayatPendaftaran.find(item => item.id === id); // Cari di riwayatPendaftaran
            if (!p) return;
            // ... (sisa kode modal sama persis) ...
            modalDetail.classList.add('show');
        }

        function closeDetailModal() { /* ... (Tidak berubah) ... */ }

        function handleSearch() {
            const query = searchInput.value.trim().toLowerCase();
            const filteredData = riwayatPendaftaran.filter(p => { // Cari di riwayatPendaftaran
                const nama = String(p.nama_pasien || '').toLowerCase();
                const rm = String(p.rm || '').toLowerCase();
                return nama.includes(query) || rm.includes(query);
            });
            displayHistory(filteredData);
        }

        searchButton.addEventListener('click', handleSearch);
        searchInput.addEventListener('input', handleSearch);

        // Kode sidebar dan popup profil tidak diubah
        // ...
    </script>
</body>

</html>
