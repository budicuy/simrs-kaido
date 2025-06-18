<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Hari Ini - Rumah Sakit Islam Banjarmasin</title>
    <link rel="stylesheet" href="{{ asset('css/style/style-pendaftaran.css') }}">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        /* CSS Anda tidak perlu diubah, saya salin kembali untuk kelengkapan */
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
        .status-dipanggil { color: #007bff; font-weight: bold; }
        .status-menunggu { color: #ffc107; font-weight: bold; }
        .status-selesai { color: #28a745; font-weight: bold; }
        .status-batal { color: #dc3545; font-weight: bold; }
    </style>
</head>

<body>
    <div class="sidebar">
        <div class="logo-details"><img src="{{ asset('image/logo.svg') }}" alt="Logo RS"><span class="logo_name"><h5>RUMAH SAKIT ISLAM<br>BANJARMASIN</h5></span></div>
        <ul class="nav-links">
            <li><a href="{{ route('dashboard') }}"><img src="{{ asset('image/logo.svg') }}" alt="Logo RS"><span class="logo_name"><h5>RUMAH SAKIT ISLAM<br>BANJARMASIN</h5></span></div>beranda.svg" alt="Beranda"><span class="link_name">Beranda</span></a><ul class="sub-menu blank"><li><a href="{{ route('dashboard') }}" class="link_name">Beranda</a></li></ul></li>
            <li><div class="icon-link active"><a href="{{ route('pendaftaran') }}"><img src="{{ asset('image/logo.svg') }}" alt="Logo RS"><span class="logo_name"><h5>RUMAH SAKIT ISLAM<br>BANJARMASIN</h5></span></div>kunjungan.svg" alt="Kunjungan"><span class="link_name">Pendaftaran</span></a><i class="bx bx-chevron-down arrow"></i></div><ul class="sub-menu"><li><a href="#" class="link_name">Pendaftaran</a></li><li><a href="{{ route('pendaftaran') }}">Pendaftaran Hari Ini</a></li><li><a href="{{ route('pendaftaran.riwayat') }}">Riwayat Pendaftaran</a></li></ul></li>
            <li><a href="{{ route('pasien') }}"><img src="{{ asset('image/logo.svg') }}" alt="Logo RS"><span class="logo_name"><h5>RUMAH SAKIT ISLAM<br>BANJARMASIN</h5></span></div>pasien.svg" alt="Pasien"><span class="link_name">Pasien</span></a><ul class="sub-menu blank"><li><a href="{{ route('pasien') }}" class="link_name">Pasien</a></li></ul></li>
            <li><div class="icon-link"><a href="{{ route('poli') }}"><img src="{{ asset('image/logo.svg') }}" alt="Logo RS"><span class="logo_name"><h5>RUMAH SAKIT ISLAM<br>BANJARMASIN</h5></span></div>kunjungan.svg" alt="Layanan"><span class="link_name">Layanan</span></a><i class="bx bx-chevron-down arrow"></i></div><ul class="sub-menu"><li><a href="#" class="link_name">Layanan</a></li><li><a href="{{ route('poli') }}">Poli</a></li><li><a href="{{ route('dokter') }}">Dokter</a></li><li><a href="{{ route('perawat') }}">Perawat</a></li></ul></li>
            <li class="logout"><a href="#" id="logoutButton" class="keluar"><img src="{{ asset('image/logo.svg') }}" alt="Logo RS"><span class="logo_name"><h5>RUMAH SAKIT ISLAM<br>BANJARMASIN</h5></span></div>keluar.svg" alt="Keluar"><span class="link_name">Keluar</span></a><ul class="sub-menu blank"><li><a href="#" class="link_name">Keluar</a></li></ul></li>
        </ul>
    </div>
    <section class="home-section">
        <div class="home-content">
            <i class="bx bx-menu"></i>
            <div class="profile-trigger" onclick="toggleProfilePopup()"><img src="{{ asset('image/logo.svg') }}" alt="Logo RS"><span class="logo_name"><h5>RUMAH SAKIT ISLAM<br>BANJARMASIN</h5></span></div>admin.svg" alt="User" class="profile-icon"></div>
            <div id="profile-popup" class="profile-popup hidden"><div class="popup-content"><img src="{{ asset('image/logo.svg') }}" alt="Logo RS"><span class="logo_name"><h5>RUMAH SAKIT ISLAM<br>BANJARMASIN</h5></span></div>admin.svg" alt="User" class="popup-icon"><div><div class="popup-name" id="userNameDisplay">Memuat...</div><div class="popup-role" id="userRoleDisplay">Memuat...</div></div></div></div>
        </div>
    </section>

    <main>
        <div class="main-content">
            <h3>Pendaftaran Hari Ini</h3>
            <div id="tanggalHari" style="text-align:right; margin-bottom:10px; font-weight:500; color:#333;"></div>
            <a href="index-pendaftaran_tambah.html" class="add-btn">Tambah <i class="bx bxs-plus-circle"></i></a>
        </div>
        <div class="card">
            <div id="loadingMessage" class="info-message">Memuat data pendaftaran...</div>
            <div id="errorMessage" class="info-message error-message" style="display: none;"></div>
            <div id="feedbackMessage" class="feedback-message"></div>
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
            <div id="noDataMessage" class="info-message" style="display: none;">Tidak ada data pendaftaran hari ini.</div>
        </div>
    </main>

    <div class="modal-overlay" id="modalDetail">
        <div class="modal-box">
            <div class="modal-header">
                <h3>Detail Pendaftaran</h3><span class="close-btn" onclick="closeDetailModal()">&times;</span>
            </div>
            <div class="modal-body">
                <div class="form-group"><label>No. Regis</label><input type="text" id="detail_no_regis" disabled></div>
                <div class="form-group"><label>Rekam Medis</label><input type="text" id="detail_rekam_medis" disabled></div>
                <div class="form-group"><label>Nama Pasien</label><input type="text" id="detail_nama_pasien" disabled></div>
                <div class="form-group"><label>NIK</label><input type="text" id="detail_nik" disabled></div>
                <div class="form-group"><label>Poli Tujuan</label><input type="text" id="detail_poli" disabled></div>
                <div class="form-group"><label>Dokter</label><input type="text" id="detail_dokter" disabled></div>
                <div class="form-group"><label>No. Antrian</label><input type="text" id="detail_no_antrian" disabled></div>
                <div class="form-group"><label>Status</label><input type="text" id="detail_status" disabled></div>
            </div>
            <div class="modal-footer">
                <button class="btn-cancel" onclick="closeDetailModal()">Tutup</button>
            </div>
        </div>
    </div>


    <script>
        const BASE_API_URL = 'https://nazarfadil.me/api';

        // --- Elemen HTML ---
        const pendaftaranTableBody = document.getElementById('pendaftaranTableBody');
        const loadingMessage = document.getElementById('loadingMessage');
        const errorMessage = document.getElementById('errorMessage');
        const noDataMessage = document.getElementById('noDataMessage');
        const searchInput = document.getElementById('searchInput');
        const searchButton = document.getElementById('searchButton');
        const feedbackMessage = document.getElementById('feedbackMessage');
        const modalDetail = document.getElementById('modalDetail');

        let allPendaftarans = []; // Variabel untuk menyimpan data dari API

        // --- Otentikasi & Inisialisasi Halaman ---
        const authToken = localStorage.getItem('auth_token');
        if (!authToken) {
            alert('Anda harus login terlebih dahulu.');
            window.location.href = '{{ route('index') }}';
        }
        document.addEventListener('DOMContentLoaded', () => {
            document.getElementById('userNameDisplay').textContent = localStorage.getItem('user_name') || 'User';
            document.getElementById('userRoleDisplay').textContent = localStorage.getItem('user_role') || 'N/A';
            formatTanggalHariIni();
            loadPendaftarans(); // Fungsi utama dipanggil
        });

        // --- Fungsi Logout ---
        document.getElementById('logoutButton').addEventListener('click', async (event) => {
            event.preventDefault();
            if (!confirm('Apakah Anda yakin ingin keluar?')) return;
            try { await fetch(`${BASE_API_URL}/logout`, { method: 'POST', headers: { 'Accept': 'application/json', 'Authorization': `Bearer ${authToken}` } }); }
            catch (error) { console.error('Error saat logout:', error); }
            finally { localStorage.clear(); window.location.href = '{{ route('index') }}'; }
        });

        // --- Fungsi Bantuan ---
        function showFeedback(message, type) { /* ... (Tidak berubah) ... */ }
        function formatTanggalHariIni() { /* ... (Tidak berubah) ... */ }

        // --- Fungsi Utama yang Telah Disederhanakan ---
        async function loadPendaftarans() {
            loadingMessage.style.display = 'block';
            errorMessage.style.display = 'none';
            noDataMessage.style.display = 'none';

            try {
                // HANYA SATU KALI FETCH!
                const response = await fetch(`${BASE_API_URL}/pendaftarans`, {
                    method: 'GET',
                    headers: { 'Accept': 'application/json', 'Authorization': `Bearer ${authToken}` }
                });

                if (!response.ok) throw new Error('Gagal mengambil data pendaftaran.');

                const result = await response.json();
                const today = new Date().toISOString().slice(0, 10);

                // Simpan data hari ini ke variabel global
                allPendaftarans = (result.data || []).filter(p => p.tgl_kunjungan === today);

                displayPendaftarans(allPendaftarans);

            } catch (error) {
                loadingMessage.style.display = 'none';
                errorMessage.textContent = 'Gagal memuat data: ' + error.message;
                errorMessage.style.display = 'block';
                console.error(error);
            }
        }

        function displayPendaftarans(data) {
            loadingMessage.style.display = 'none';
            pendaftaranTableBody.innerHTML = '';

            if (data.length === 0) {
                noDataMessage.style.display = 'block';
                return;
            }

            noDataMessage.style.display = 'none';

            data.forEach((p, index) => {
                const statusClass = `status-${String(p.status).toLowerCase().replace(/\s/g, '')}`;
                const row = pendaftaranTableBody.insertRow();

                // Menggunakan kunci dari Resource API baru Anda
                row.innerHTML = `
                    <td>${index + 1}</td>
                    <td>${p.id}</td>
                    <td>${p.nama_pasien || 'N/A'}</td>
                    <td>${p.poli || 'N/A'}</td>
                    <td>${p.dokter || 'N/A'}</td> <td>${p.no_antrian}</td>
                    <td class="${statusClass}">${p.status || 'N/A'}</td>
                    <td class="aksi">
                        <img src="{{ asset('image/logo.svg') }}" alt="Logo RS"><span class="logo_name"><h5>RUMAH SAKIT ISLAM<br>BANJARMASIN</h5></span></div>call.png" alt="Panggil" title="Panggil Pasien" onclick="updateStatus(${p.id}, 2)">
                        <img src="{{ asset('image/logo.svg') }}" alt="Logo RS"><span class="logo_name"><h5>RUMAH SAKIT ISLAM<br>BANJARMASIN</h5></span></div>check.png" alt="Selesai" title="Tandai Selesai" onclick="updateStatus(${p.id}, 3)">
                        <img src="{{ asset('image/logo.svg') }}" alt="Logo RS"><span class="logo_name"><h5>RUMAH SAKIT ISLAM<br>BANJARMASIN</h5></span></div>eye.svg" alt="Detail" title="Lihat Detail" onclick="openDetailModal(${p.id})">
                    </td>
                `;
            });
        }

        function openDetailModal(id) {
            const p = allPendaftarans.find(item => item.id === id);
            if (!p) return;

            document.getElementById('detail_no_regis').value = p.id || '';
            document.getElementById('detail_rekam_medis').value = p.rm || '';
            document.getElementById('detail_nama_pasien').value = p.nama_pasien || '';
            document.getElementById('detail_nik').value = p.nik || '';
            document.getElementById('detail_poli').value = p.poli || ''; // Menggunakan kunci 'poli'
            document.getElementById('detail_dokter').value = p.dokter || 'N/A'; // Lihat catatan
            document.getElementById('detail_no_antrian').value = p.no_antrian || '';
            document.getElementById('detail_status').value = p.status || '';

            modalDetail.classList.add('show');
        }

        function closeDetailModal() {
            modalDetail.classList.remove('show');
        }

        async function updateStatus(id, newStatus) {
            // ... (Fungsi ini tidak perlu diubah, sudah benar)
        }

        function handleSearch() {
            const query = searchInput.value.trim().toLowerCase();
            const filteredData = allPendaftarans.filter(p => {
                const nama = String(p.nama_pasien || '').toLowerCase();
                const rm = String(p.rm || '').toLowerCase();
                return nama.includes(query) || rm.includes(query);
            });
            displayPendaftarans(filteredData);
        }

        searchButton.addEventListener('click', handleSearch);
        searchInput.addEventListener('input', handleSearch);

        // Kode sidebar tidak diubah ...
    </script>
</body>

</html>
