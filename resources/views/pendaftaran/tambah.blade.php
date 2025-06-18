<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pendaftaran - Rumah Sakit Islam Banjarmasin</title>
    <link rel="stylesheet" href="{{ asset('css/style/style-pendaftaran_tambah.css') }}">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <style>
        /* CSS Anda tidak diubah, hanya memastikan semua style yang relevan ada */
        .feedback-message, .message-container { margin-top: 20px; padding: 10px 15px; border-radius: 5px; font-weight: bold; text-align: center; display: none; }
        .feedback-message.success, .message-container.success { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .feedback-message.error, .message-container.error { background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        .form-group input[disabled], .form-group select[disabled] { background-color: #f0f0f0; cursor: not-allowed; }
        #submitButton:disabled { background-color: #ccc; cursor: not-allowed; }
        .popup { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.6); display: none; justify-content: center; align-items: center; z-index: 2000; }
        .popup.show { display: flex; }
        .popup-tambah { background: white; padding: 25px 30px; border-radius: 10px; text-align: center; box-shadow: 0 5px 15px rgba(0,0,0,0.2); }
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
                <img src="{{ asset('image/admin.svg') }}" alt="User" class="profile-icon">
            </div>

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
        <div class="card">
            <h3 style="margin-bottom: 16px;">Form Pendaftaran Kunjungan</h3>
            <div id="responseMessage" class="message-container"></div>
            <form id="kunjunganForm">
                <div class="form-grid">
                    <div class="form-group"><label for="rm_input">Rekam Medis</label><input type="text" id="rm_input" name="rm" placeholder="Masukkan RM & tekan Enter/Tab" required></div>
                    <div class="form-group"><label for="poli_select">Poli Tujuan</label><select id="poli_select" name="id_poli" required disabled><option value="">Memuat Poli...</option></select></div>
                    <div class="form-group"><label for="nama_pasien_input">Nama Pasien</label><input type="text" id="nama_pasien_input" disabled></div>
                    <div class="form-group"><label for="dokter_select">Dokter</label><select id="dokter_select" required disabled><option value="">Pilih Poli terlebih dahulu</option></select></div>
                    <div class="form-group"><label for="nik_input">NIK</label><input type="text" id="nik_input" disabled></div>
                    <div class="form-group"><label for="tanggal_input">Tanggal Kunjungan</label><input type="date" id="tanggal_input" name="tgl_kunjungan" required></div>
                    <div class="form-group"><label for="no_antrian_input">Nomor Antrian</label><input type="number" id="no_antrian_input" name="no_antrian" required min="1" disabled></div>
                </div>
                <div class="form-actions full-width">
                    <button type="reset" class="btn btn-secondary">Reset</button>
                    <button type="submit" class="btn btn-primary" id="submitButton">Tambah Pendaftaran</button>
                </div>
            </form>
        </div>

        <div id="popupSuccess" class="popup">
            <div class="popup-tambah">
                <div class="checkmark"><img src="{{ asset('image/logo.svg') }}" alt="Logo RS"><span class="logo_name"><h5>RUMAH SAKIT ISLAM<br>BANJARMASIN</h5></span></div>centang.svg" alt=""></div>
                <h3>Sukses!</h3>
                <p>Pendaftaran berhasil ditambahkan.</p>
            </div>
        </div>
    </main>

    <script>
        const BASE_API_URL = 'https://nazarfadil.me/api';

        // --- Elemen HTML ---
        const kunjunganForm = document.getElementById('kunjunganForm');
        const submitButton = document.getElementById('submitButton');
        const responseMessage = document.getElementById('responseMessage');
        const popupSuccess = document.getElementById('popupSuccess');
        const rmInput = document.getElementById('rm_input');
        const namaPasienInput = document.getElementById('nama_pasien_input');
        const nikInput = document.getElementById('nik_input');
        const poliSelect = document.getElementById('poli_select');
        const dokterSelect = document.getElementById('dokter_select');
        const tanggalInput = document.getElementById('tanggal_input');
        const noAntrianInput = document.getElementById('no_antrian_input');

        // --- Variabel Global untuk menyimpan data dinamis ---
        let allPolis = [];
        let allDokters = [];

        // --- Otentikasi & Inisialisasi Halaman ---
        const authToken = localStorage.getItem('auth_token');
        if (!authToken) {
            alert('Anda harus login terlebih dahulu.');
            window.location.href = '{{ route('index') }}';
        }
        document.addEventListener('DOMContentLoaded', () => {
            // Setup Info User
            document.getElementById('userNameDisplay').textContent = localStorage.getItem('user_name') || 'User';
            document.getElementById('userRoleDisplay').textContent = localStorage.getItem('user_role') || 'N/A';

            // Set tanggal hari ini sebagai default
            tanggalInput.value = new Date().toISOString().slice(0, 10);

            // Ambil data dinamis untuk dropdown
            loadPoliAndDokter();
        });

        // --- Fungsi Logout ---
        document.getElementById('logoutButton').addEventListener('click', async (event) => { /* ... (Tidak berubah) ... */ });

        // --- Fungsi Bantuan ---
        function showFeedback(message, type) {
            responseMessage.innerHTML = message;
            responseMessage.className = `message-container ${type}`;
            responseMessage.style.display = 'block';
            setTimeout(() => { responseMessage.style.display = 'none'; }, 5000);
        }

        // --- Logika Inti Halaman ---

        // 1. Ambil data untuk dropdown Poli dan Dokter
        async function loadPoliAndDokter() {
            const fetchOptions = { headers: { 'Accept': 'application/json', 'Authorization': `Bearer ${authToken}` } };
            try {
                const [poliRes, dokterRes] = await Promise.all([
                    fetch(`${BASE_API_URL}/polis`, fetchOptions),
                    fetch(`${BASE_API_URL}/dokters`, fetchOptions)
                ]);

                if (!poliRes.ok || !dokterRes.ok) throw new Error('Gagal memuat data poli atau dokter.');

                allPolis = (await poliRes.json()).data || [];
                allDokters = (await dokterRes.json()).data || [];

                // Isi dropdown poli
                poliSelect.innerHTML = '<option value="">-- Pilih Poli --</option>';
                allPolis.forEach(poli => {
                    const option = new Option(poli.nama_poli, poli.id);
                    poliSelect.add(option);
                });
                poliSelect.disabled = false;

            } catch (error) {
                showFeedback(`Gagal memuat data dropdown: ${error.message}`, 'error');
                console.error(error);
            }
        }

        // 2. Saat RM diisi, cari data pasien
        rmInput.addEventListener('blur', async () => {
            const rm = rmInput.value.trim();
            namaPasienInput.value = 'Mencari...';
            nikInput.value = '';
            if (!rm) {
                namaPasienInput.value = '';
                return;
            }
            try {
                const response = await fetch(`${BASE_API_URL}/pasiens/${rm}`, { headers: { 'Accept': 'application/json', 'Authorization': `Bearer ${authToken}` } });
                if (response.status === 404) throw new Error(`Pasien dengan RM ${rm} tidak ditemukan.`);
                if (!response.ok) throw new Error('Gagal mencari data pasien.');

                const result = await response.json();
                const pasien = result.data;
                namaPasienInput.value = pasien.nama_pasien || '';
                nikInput.value = pasien.nik || '';
            } catch (error) {
                showFeedback(error.message, 'error');
                namaPasienInput.value = '';
            }
        });

        // 3. Saat Poli dipilih, filter daftar Dokter
        poliSelect.addEventListener('change', () => {
            const selectedPoliId = poliSelect.value;
            dokterSelect.innerHTML = '<option value="">-- Pilih Dokter --</option>';
            dokterSelect.disabled = true;
            if (!selectedPoliId) return;

            const poli = allPolis.find(p => p.id == selectedPoliId);
            if (!poli) return;

            // Cari dokter yang berelasi dengan poli ini
            const dokter = allDokters.find(d => d.id === poli.id_dokter);
            if(dokter) {
                const option = new Option(dokter.nama_dokter, dokter.id);
                dokterSelect.add(option);
                dokterSelect.disabled = false;
            } else {
                 dokterSelect.innerHTML = '<option value="">Dokter tidak ditemukan</option>';
            }

            // Setelah poli dipilih, coba ambil nomor antrian
            fetchNextNoAntrian();
        });

        // 4. Ambil nomor antrian otomatis
        tanggalInput.addEventListener('change', fetchNextNoAntrian);
        async function fetchNextNoAntrian() {
            const id_poli = poliSelect.value;
            const tgl_kunjungan = tanggalInput.value;
            noAntrianInput.value = '';
            noAntrianInput.disabled = true;

            if (!id_poli || !tgl_kunjungan) return;

            noAntrianInput.placeholder = "Memuat...";
            try {
                // Asumsi ada endpoint untuk ini
                const response = await fetch(`${BASE_API_URL}/pendaftarans/max-antrian?id_poli=${id_poli}&tgl_kunjungan=${tgl_kunjungan}`, { headers: { 'Accept': 'application/json', 'Authorization': `Bearer ${authToken}` } });
                if (!response.ok) throw new Error('Gagal mengambil nomor antrian.');

                const result = await response.json();
                const nextNo = (result.max_no_antrian || 0) + 1;
                noAntrianInput.value = nextNo;
                noAntrianInput.disabled = false;
            } catch (error) {
                showFeedback(error.message, 'error');
                noAntrianInput.value = 1; // Fallback ke 1 jika gagal
                noAntrianInput.disabled = false;
                noAntrianInput.placeholder = "";
            }
        }

        // 5. Submit Form Pendaftaran
        kunjunganForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            submitButton.disabled = true;
            submitButton.textContent = 'Menyimpan...';

            // Kumpulkan data dari form
            const pendaftaranData = {
                rm: rmInput.value,
                id_poli: poliSelect.value,
                tgl_kunjungan: tanggalInput.value,
                no_antrian: noAntrianInput.value,
                status: "Menunggu" // Status default saat pendaftaran baru
            };

            // Validasi sederhana
            if (!pendaftaranData.rm || !pendaftaranData.id_poli || !namaPasienInput.value) {
                showFeedback('Pastikan RM pasien valid dan Poli Tujuan telah dipilih.', 'error');
                submitButton.disabled = false;
                submitButton.textContent = 'Tambah Pendaftaran';
                return;
            }

            try {
                const response = await fetch(`${BASE_API_URL}/pendaftarans`, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'Authorization': `Bearer ${authToken}` },
                    body: JSON.stringify(pendaftaranData)
                });

                const result = await response.json();
                if (!response.ok) throw result; // Lemparkan error jika tidak ok

                popupSuccess.classList.add('show');
                setTimeout(() => { window.location.href = '{{ route('pendaftaran') }}'; }, 2000);

            } catch (error) {
                let errorMessageText = error.message || 'Gagal menambahkan pendaftaran.';
                if (error.errors) {
                    errorMessageText += '<br><ul style="text-align: left; padding-left: 20px;">';
                    for (const key in error.errors) {
                        errorMessageText += `<li>${error.errors[key].join(', ')}</li>`;
                    }
                    errorMessageText += '</ul>';
                }
                showFeedback(errorMessageText, 'error');
                submitButton.disabled = false;
                submitButton.textContent = 'Tambah Pendaftaran';
            }
        });

        // Kode sidebar dan popup profil tidak diubah
        // ...
    </script>
</body>

</html>
