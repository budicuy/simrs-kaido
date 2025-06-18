<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pasien - Rumah Sakit Islam Banjarmasin</title>
    <link rel="stylesheet" href="{{ asset('css/style/style-pasien_tambah.css') }}">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <style>
        /* CSS Anda (tidak diubah, kecuali popup) */
        .message-container { margin-top: 20px; padding: 10px 15px; border-radius: 5px; display: none; font-weight: bold; text-align: center; }
        .message-container.success { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .message-container.error { background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        .info-message { text-align: center; padding: 20px; font-size: 1.1em; color: #555; }
        .error-message { color: red; font-weight: bold; }
        .form-actions { display: flex; gap: 10px; justify-content: flex-end; margin-top: 20px; }
        .popup { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.6); display: none; justify-content: center; align-items: center; z-index: 2000; }
        .popup.show { display: flex; }
        .popup-tambah { background: white; padding: 25px 30px; border-radius: 10px; text-align: center; box-shadow: 0 5px 15px rgba(0,0,0,0.2); }
        .popup-tambah h3 { margin-top: 10px; margin-bottom: 5px; }
        .popup-tambah p { margin-top: 0; color: #666; }
        #submitButton:disabled { background-color: #ccc; cursor: not-allowed; }
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
            <i class="sub-1 bx bx-chevron-right"></i>
            <a href="#" id="detailLink" class="sub">Detail</a>
            <i class="bx bx-chevron-right"></i>
            <a href="#" class="sub-link">Edit</a>
        </div>
        <div class="card">
            <h3>Edit Pasien</h3>
            <div id="loadingMessage" class="info-message">Memuat data pasien...</div>
            <div id="errorMessage" class="info-message error-message" style="display: none;"></div>

            <form id="editPasienForm" style="display: none;">
                <div class="form-grid">
                    <div class="form-group"><label for="rm">Rekam Medis (RM)</label><input type="text" id="rm" name="rm" disabled></div>
                    <div class="form-group"><label for="nama_pasien">Nama Pasien</label><input type="text" id="nama_pasien" name="nama_pasien" required></div>
                    <div class="form-group"><label for="nik">NIK</label><input type="text" id="nik" name="nik" required pattern="[0-9]{16}" title="NIK harus 16 digit angka" maxlength="16"></div>
                    <div class="form-group"><label>Jenis Kelamin</label><div class="radio-group"><label><input type="radio" name="jns_kelamin" value="Laki-Laki" required> Laki-laki</label><label><input type="radio" name="jns_kelamin" value="Perempuan"> Perempuan</label></div></div>
                    <div class="form-group"><label for="kabupaten">Kabupaten</label><select id="kabupaten" name="kabupaten" required><option value="">-- Pilih Kabupaten --</option><option value="Banjar">Banjar</option><option value="Barito Kuala">Barito Kuala</option><option value="Tapin">Tapin</option><option value="Hulu Sungai Selatan">Hulu Sungai Selatan</option><option value="Hulu Sungai Tengah">Hulu Sungai Tengah</option><option value="Hulu Sungai Utara">Hulu Sungai Utara</option><option value="Tabalong">Tabalong</option><option value="Tanah Laut">Tanah Laut</option><option value="Tanah Bumbu">Tanah Bumbu</option><option value="Balangan">Balangan</option><option value="Kotabaru">Kotabaru</option><option value="Banjarmasin">Banjarmasin</option><option value="Banjarbaru">Banjarbaru</option></select></div>
                    <div class="form-group"><label for="agama">Agama</label><select id="agama" name="agama" required><option value="">-- Pilih --</option><option value="Islam">Islam</option><option value="Kristen">Kristen</option><option value="Katolik">Katolik</option><option value="Hindu">Hindu</option><option value="Buddha">Buddha</option><option value="Konghucu">Konghucu</option><option value="Lainnya">Lainnya</option></select></div>
                    <div class="form-group"><label for="pekerjaan">Pekerjaan</label><input type="text" id="pekerjaan" name="pekerjaan" required></div>
                    <div class="form-group"><label for="gol_darah">Golongan Darah</label><select id="gol_darah" name="gol_darah" required><option value="">-- Pilih --</option><option value="A">A</option><option value="B">B</option><option value="AB">AB</option><option value="O">O</option><option value="Tidak Tahu">Tidak Tahu</option></select></div>
                    <div class="form-group"><label for="tgl_lahir">Tanggal Lahir</label><input type="date" id="tgl_lahir" name="tgl_lahir" required></div>
                    <div class="form-group"><label for="no_hp_pasien">Nomor Hp</label><input type="tel" id="no_hp_pasien" name="no_hp_pasien" required pattern="[0-9]{9,13}" maxlength="13"></div>
                    <div class="form-group"><label for="email_pasien">Email</label><input type="email" id="email_pasien" name="email_pasien" required></div>
                    <div class="form-group full-width"><label for="alamat">Alamat</label><textarea id="alamat" name="alamat" rows="2" required></textarea></div>
                    <div class="form-actions full-width"><a href="#" id="kembaliButton" class="btn-1 btn-secondary">Kembali</a><button type="submit" class="btn btn-primary" id="submitButton">Simpan Perubahan</button></div>
                </div>
            </form>
            <div id="responseMessage" class="message-container"></div>
        </div>

        <div id="popupSuccess" class="popup">
            <div class="popup-tambah">
                <div class="checkmark"><img src="{{ asset('image/logo.svg') }}" alt="Logo RS"><span class="logo_name"><h5>RUMAH SAKIT ISLAM<br>BANJARMASIN</h5></span></div>centang.svg" alt=""></div>
                <h3>Sukses</h3>
                <p>Data pasien berhasil diupdate.</p>
            </div>
        </div>
    </main>

    <script>
        const BASE_API_URL = 'https://nazarfadil.me/api';

        // --- Elemen HTML ---
        const editPasienForm = document.getElementById('editPasienForm');
        const submitButton = document.getElementById('submitButton');
        const loadingMessage = document.getElementById('loadingMessage');
        const errorMessage = document.getElementById('errorMessage');
        const responseMessage = document.getElementById('responseMessage');
        const popupSuccess = document.getElementById('popupSuccess');
        const userNameDisplay = document.getElementById('userNameDisplay');
        const userRoleDisplay = document.getElementById('userRoleDisplay');
        const logoutButton = document.getElementById('logoutButton');
        const detailLink = document.getElementById('detailLink');
        const kembaliButton = document.getElementById('kembaliButton');

        let currentRm = null; // Menyimpan RM pasien yang sedang diedit

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

        // --- Fungsi untuk mengisi form dengan data ---
        function populateForm(pasien) {
            document.getElementById('rm').value = pasien.rm;
            document.getElementById('nik').value = pasien.nik;
            document.getElementById('nama_pasien').value = pasien.nama_pasien;
            document.getElementById('tgl_lahir').value = pasien.tgl_lahir; // Asumsi format YYYY-MM-DD
            document.getElementById('agama').value = pasien.agama;
            document.getElementById('kabupaten').value = pasien.kabupaten;
            document.getElementById('pekerjaan').value = pasien.pekerjaan;
            document.getElementById('alamat').value = pasien.alamat;
            document.getElementById('no_hp_pasien').value = pasien.no_hp_pasien;
            document.getElementById('email_pasien').value = pasien.email_pasien;
            document.getElementById('gol_darah').value = pasien.gol_darah;

            // Menangani radio button jenis kelamin
            if (pasien.jns_kelamin && pasien.jns_kelamin.toLowerCase().includes('laki')) {
                document.querySelector('input[name="jns_kelamin"][value="Laki-Laki"]').checked = true;
            } else if (pasien.jns_kelamin && pasien.jns_kelamin.toLowerCase().includes('perempuan')) {
                document.querySelector('input[name="jns_kelamin"][value="Perempuan"]').checked = true;
            }
        }

        // --- LANGKAH 1: Ambil data pasien saat halaman dimuat ---
        async function loadPasienData() {
            currentRm = getUrlParameter('rm');
            if (!currentRm) {
                loadingMessage.style.display = 'none';
                errorMessage.textContent = 'Gagal: Nomor Rekam Medis (RM) tidak ditemukan di URL.';
                errorMessage.style.display = 'block';
                return;
            }

            // Update link breadcrumb dan tombol kembali
            const detailPageUrl = `index-pasien_detail.html?rm=${currentRm}`;
            detailLink.href = detailPageUrl;
            kembaliButton.href = detailPageUrl;

            try {
                const response = await fetch(`${BASE_API_URL}/pasiens/${currentRm}`, {
                    method: 'GET',
                    headers: { 'Accept': 'application/json', 'Authorization': `Bearer ${authToken}` }
                });

                if (!response.ok) {
                    throw new Error(response.status === 404 ? `Pasien dengan RM ${currentRm} tidak ditemukan.` : 'Gagal memuat data pasien.');
                }

                const result = await response.json();
                populateForm(result.data);

                // Tampilkan form setelah data berhasil dimuat
                loadingMessage.style.display = 'none';
                editPasienForm.style.display = 'grid';

            } catch (error) {
                loadingMessage.style.display = 'none';
                errorMessage.textContent = error.message;
                errorMessage.style.display = 'block';
                console.error('Error memuat data pasien:', error);
            }
        }

        // --- LANGKAH 2: Kirim data update saat form disubmit ---
        editPasienForm.addEventListener('submit', async (event) => {
            event.preventDefault();

            submitButton.disabled = true;
            submitButton.textContent = 'Menyimpan...';
            responseMessage.style.display = 'none';

            const formData = new FormData(editPasienForm);
            const data = {};
            formData.forEach((value, key) => {
                data[key] = value;
            });
            // RM tidak perlu dikirim di body, tapi NIK perlu
            data.nik = parseInt(data.nik, 10);


            try {
                const response = await fetch(`${BASE_API_URL}/pasiens/${currentRm}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'Authorization': `Bearer ${authToken}`
                    },
                    body: JSON.stringify(data)
                });

                if (response.ok) {
                    popupSuccess.classList.add('show');
                    setTimeout(() => {
                        window.location.href = `index-pasien_detail.html?rm=${currentRm}`;
                    }, 2000);
                } else {
                    const errorDetails = await response.json();
                    let errorMessageText = errorDetails.message || 'Gagal menyimpan perubahan.';
                    if (errorDetails.errors) {
                        errorMessageText += '<br><ul style="text-align: left; padding-left: 20px;">';
                        for (const key in errorDetails.errors) {
                            errorMessageText += `<li>${errorDetails.errors[key].join(', ')}</li>`;
                        }
                        errorMessageText += '</ul>';
                    }
                    responseMessage.innerHTML = errorMessageText;
                    responseMessage.className = 'message-container error';
                    responseMessage.style.display = 'block';
                }

            } catch (error) {
                responseMessage.textContent = 'Terjadi kesalahan jaringan. Mohon coba lagi.';
                responseMessage.className = 'message-container error';
                responseMessage.style.display = 'block';
                console.error('Error saat update:', error);
            } finally {
                // Jangan re-enable tombol jika sukses karena akan redirect
                if (!popupSuccess.classList.contains('show')) {
                    submitButton.disabled = false;
                    submitButton.textContent = 'Simpan Perubahan';
                }
            }
        });

        // --- Inisialisasi saat halaman dimuat ---
        document.addEventListener('DOMContentLoaded', loadPasienData);

        // --- Sidebar & Profile Popup Logic (tidak diubah) ---
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
