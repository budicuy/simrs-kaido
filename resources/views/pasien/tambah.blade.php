<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pasien - Rumah Sakit Islam Banjarmasin</title>
    <link rel="stylesheet" href="{{ asset('css/style/style-pasien_tambah.css') }}">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <style>
        .message-container { margin-top: 20px; padding: 10px 15px; border-radius: 5px; display: none; font-weight: bold; text-align: center; }
        .message-container.success { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .message-container.error { background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        .form-actions { display: flex; gap: 10px; justify-content: flex-end; margin-top: 20px; }
        /* Style untuk popup sukses */
        .popup { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.6); display: none; /* diubah dari flex ke none */ justify-content: center; align-items: center; z-index: 2000; }
        .popup.show { display: flex; } /* Class untuk menampilkan popup */
        .popup-tambah { background: white; padding: 25px 30px; border-radius: 10px; text-align: center; box-shadow: 0 5px 15px rgba(0,0,0,0.2); }
        .popup-tambah h3 { margin-top: 10px; margin-bottom: 5px; }
        .popup-tambah p { margin-top: 0; color: #666; }
        /* Style untuk tombol submit saat loading */
        #submitButton:disabled { background-color: #ccc; cursor: not-allowed; }
    </style>
</head>

<body>
    <div class="sidebar">
        <div class="logo-details"><img src="{{ asset('image/logo.svg') }}" alt="Logo RS"><span class="logo_name"><h5>RUMAH SAKIT ISLAM<br>BANJARMASIN</h5></span></div>
        <ul class="nav-links">
            <li><a href="{{ route('dashboard') }}"><img src="{{ asset('image/beranda.svg') }}" alt="Beranda"><span class="link_name">Beranda</span></a><ul class="sub-menu blank"><li><a href="{{ route('dashboard') }}" class="link_name">Beranda</a></li></ul></li>
            <li><div class="icon-link"><a href="{{ route('pendaftaran') }}"><img src="{{ asset('image/kunjungan.svg') }}" alt="Kunjungan"><span class="link_name">Pendaftaran</span></a><i class="bx bx-chevron-down arrow"></i></div><ul class="sub-menu"><li><a href="#" class="link_name">Pendaftaran</a></li><li><a href="{{ route('pendaftaran') }}">Pendaftaran Hari Ini</a></li><li><a href="{{ route('pendaftaran.riwayat') }}">Riwayat Pendaftaran</a></li></ul></li>
            <li><a href="{{ route('pasien') }}"><img src="{{ asset('image/pasien.svg') }}" alt="Pasien"><span class="link_name">Pasien</span></a><ul class="sub-menu blank"><li><a href="{{ route('pasien') }}" class="link_name">Pasien</a></li></ul></li>
            <li><div class="icon-link"><a href="{{ route('poli') }}"><img src="{{ asset('image/kunjungan.svg') }}" alt="Layanan"><span class="link_name">Layanan</span></a><i class="bx bx-chevron-down arrow"></i></div><ul class="sub-menu"><li><a href="#" class="link_name">Layanan</a></li><li><a href="{{ route('poli') }}">Poli</a></li><li><a href="{{ route('dokter') }}">Dokter</a></li><li><a href="{{ route('perawat') }}">Perawat</a></li></ul></li>
            <li class="logout"><a href="#" id="logoutButton" class="keluar"><img src="{{ asset('image/keluar.svg') }}" alt="Keluar"><span class="link_name">Keluar</span></a><ul class="sub-menu blank"><li><a href="#" class="link_name">Keluar</a></li></ul></li>
        </ul>
    </div>
    <section class="home-section">
        <div class="home-content">
            <i class="bx bx-menu"></i>
            <div class="profile-trigger" onclick="toggleProfilePopup()"><img src="{{ asset('image/admin.svg') }}" alt="User" class="profile-icon"></div>
            <div id="profile-popup" class="profile-popup hidden"><div class="popup-content"><img src="{{ asset('image/admin.svg') }}" alt="User" class="popup-icon"><div><div class="popup-name" id="userNameDisplay">Memuat...</div><div class="popup-role" id="userRoleDisplay">Memuat...</div></div></div></div>
        </div>
    </section>

    <main>
        <div class="main-content">
            <a href="{{ route('pasien') }}" class="sub">Data Pasien</a>
            <i class="bx bx-chevron-right"></i>
            <a href="index-pasien_tambah.html" class="sub-link">Tambah Pasien</a>
        </div>
        <div class="card">
            <form id="addPasienForm">
                <div class="form-grid">
                    <div class="form-group"><label for="rm">Rekam Medis (RM)</label><input type="text" id="rm" name="rm" required pattern="[0-9]+" title="Rekam Medis harus angka"></div>
                    <div class="form-group"><label for="nama_pasien">Nama Pasien</label><input type="text" id="nama_pasien" name="nama_pasien" required></div>
                    <div class="form-group"><label for="nik">NIK</label><input type="text" id="nik" name="nik" required pattern="[0-9]{16}" title="NIK harus 16 digit angka" maxlength="16"><div id="nikError" style="color:#d32f2f;font-size:13px;display:none;margin-top:4px;">NIK harus 16 digit angka</div></div>
                    <div class="form-group"><label>Jenis Kelamin</label><div class="radio-group"><label><input type="radio" name="jns_kelamin" value="Laki-Laki" required> Laki-laki</label><label><input type="radio" name="jns_kelamin" value="Perempuan"> Perempuan</label></div></div>
                    <div class="form-group"><label for="kabupaten">Kabupaten</label><select id="kabupaten" name="kabupaten" required><option value="">-- Pilih Kabupaten --</option><option value="Banjar">Banjar</option><option value="Barito Kuala">Barito Kuala</option><option value="Tapin">Tapin</option><option value="Hulu Sungai Selatan">Hulu Sungai Selatan</option><option value="Hulu Sungai Tengah">Hulu Sungai Tengah</option><option value="Hulu Sungai Utara">Hulu Sungai Utara</option><option value="Tabalong">Tabalong</option><option value="Tanah Laut">Tanah Laut</option><option value="Tanah Bumbu">Tanah Bumbu</option><option value="Balangan">Balangan</option><option value="Kotabaru">Kotabaru</option><option value="Banjarmasin">Banjarmasin</option><option value="Banjarbaru">Banjarbaru</option></select></div>
                    <div class="form-group"><label for="agama">Agama</label><select id="agama" name="agama" required><option value="">-- Pilih --</option><option value="Islam">Islam</option><option value="Kristen">Kristen</option><option value="Katolik">Katolik</option><option value="Hindu">Hindu</option><option value="Buddha">Buddha</option><option value="Konghucu">Konghucu</option><option value="Lainnya">Lainnya</option></select></div>
                    <div class="form-group"><label for="pekerjaan">Pekerjaan</label><input type="text" id="pekerjaan" name="pekerjaan" required /></div>
                    <div class="form-group"><label for="gol_darah">Golongan Darah</label><select id="gol_darah" name="gol_darah" required><option value="">-- Pilih --</option><option value="A">A</option><option value="B">B</option><option value="AB">AB</option><option value="O">O</option><option value="Tidak Tahu">Tidak Tahu</option></select></div>
                    <div class="form-group"><label for="tgl_lahir">Tanggal Lahir</label><input type="date" id="tgl_lahir" name="tgl_lahir" required max=""></div>
                    <div class="form-group"><label for="no_hp_pasien">Nomor Hp</label><input type="text" id="no_hp_pasien" name="no_hp_pasien" required pattern="[0-9]{9,13}" title="Nomor HP minimal 9 digit dan maksimal 13 digit angka" maxlength="13"><div id="noHpError" style="color:#d32f2f;font-size:13px;display:none;margin-top:4px;">Nomor HP harus 9-13 digit angka</div></div>
                    <div class="form-group"><label for="email_pasien">Email</label><input type="email" id="email_pasien" name="email_pasien" required><div id="emailError" style="color:#d32f2f;font-size:13px;display:none;margin-top:4px;">Masukkan email dengan benar</div></div>
                    <div class="form-group full-width"><label for="alamat">Alamat</label><textarea id="alamat" name="alamat" rows="2" required></textarea></div>
                    <div class="form-actions full-width"><a href="{{ route('pasien') }}" class="btn-1 btn-secondary">Batal</a><button type="submit" class="btn btn-primary" id="submitButton">Tambah</button></div>
                </div>
            </form>
            <div id="responseMessage" class="message-container"></div>
        </div>

        <div id="popupSuccess" class="popup">
            <div class="popup-tambah">
                <div class="checkmark"><img src="{{ asset('image/centang.svg') }}" alt=""></div>
                <h3>Sukses</h3>
                <p>Data pasien berhasil ditambahkan.</p>
            </div>
        </div>
    </main>


    <script>
        const BASE_API_URL = 'https://nazarfadil.me/api';

        // --- Elemen HTML ---
        const addPasienForm = document.getElementById('addPasienForm');
        const submitButton = document.getElementById('submitButton');
        const responseMessage = document.getElementById('responseMessage');
        const popupSuccess = document.getElementById('popupSuccess');
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

        // --- Fungsionalitas Logout ---
        logoutButton.addEventListener('click', async (event) => {
            event.preventDefault();
            if (!confirm('Apakah Anda yakin ingin keluar?')) return;
            try {
                await fetch(`${BASE_API_URL}/logout`, { method: 'POST', headers: { 'Accept': 'application/json', 'Authorization': `Bearer ${authToken}` }});
            } catch (error) { console.error('Error saat logout:', error); }
            finally { localStorage.clear(); window.location.href = '{{ route('index') }}'; }
        });

        // --- Fungsi untuk menampilkan pesan ---
        function showFeedback(message, type) {
            responseMessage.innerHTML = message;
            responseMessage.className = `message-container ${type}`;
            responseMessage.style.display = 'block';
        }

        // --- Event Listener untuk Form Submission ---
        addPasienForm.addEventListener('submit', async (event) => {
            event.preventDefault(); // Mencegah form reload halaman

            // 1. Beri feedback ke user bahwa proses sedang berjalan
            submitButton.disabled = true;
            submitButton.textContent = 'Menyimpan...';
            responseMessage.style.display = 'none';

            // 2. Kumpulkan data dari form
            const formData = new FormData(addPasienForm);
            const data = {};
            formData.forEach((value, key) => {
                // Konversi field RM dan NIK ke tipe number jika backend memerlukannya
                if (key === 'rm' || key === 'nik') {
                    data[key] = parseInt(value, 10);
                } else {
                    data[key] = value;
                }
            });

            console.log('Data yang akan dikirim:', JSON.stringify(data));

            // 3. Kirim data ke API menggunakan fetch
            try {
                const response = await fetch(`${BASE_API_URL}/pasiens`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'Authorization': `Bearer ${authToken}`
                    },
                    body: JSON.stringify(data)
                });

                // 4. Tangani respons dari API
                if (response.ok) {
                    // Jika SUKSES (status 200-299)
                    const result = await response.json();
                    console.log('Pasien berhasil ditambahkan:', result);

                    // Tampilkan popup sukses
                    popupSuccess.classList.add('show');

                    // Tunggu 2 detik, lalu arahkan ke halaman daftar pasien
                    setTimeout(() => {
                        window.location.href = '{{ route('pasien') }}';
                    }, 2000);

                } else {
                    // Jika GAGAL (status 4xx, 5xx)
                    const errorDetails = await response.json();
                    let errorMessageText = errorDetails.message || 'Gagal menambahkan pasien. Silakan periksa kembali data Anda.';

                    // Jika ada error validasi dari Laravel, tampilkan detailnya
                    if (errorDetails.errors) {
                        errorMessageText += '<br><ul style="text-align: left; padding-left: 20px;">';
                        for (const key in errorDetails.errors) {
                            errorMessageText += `<li>${errorDetails.errors[key].join(', ')}</li>`;
                        }
                        errorMessageText += '</ul>';
                    }

                    showFeedback(errorMessageText, 'error');
                }

            } catch (error) {
                // Jika terjadi error jaringan
                console.error('Error saat mengirim data:', error);
                showFeedback('Terjadi kesalahan jaringan. Mohon coba lagi.', 'error');
            } finally {
                // 5. Kembalikan kondisi tombol, baik sukses maupun gagal
                // (Kecuali jika sukses dan redirect, ini tidak terlalu penting)
                if (!popupSuccess.classList.contains('show')) {
                    submitButton.disabled = false;
                    submitButton.textContent = 'Tambah';
                }
            }
        });

        // --- Skrip validasi inline (dibiarkan seperti aslinya) ---
        // Anda bisa memindahkan ini ke dalam satu event listener DOMContentLoaded jika ingin lebih rapi
        document.addEventListener('DOMContentLoaded', function() {
            // NIK validation
            const nikInput = document.getElementById('nik');
            const nikError = document.getElementById('nikError');
            nikInput.addEventListener('input', function() {
                this.value = this.value.replace(/\D/g, '');
                if (this.value.length > 16) this.value = this.value.slice(0, 16);
                nikError.style.display = (this.value.length > 0 && this.value.length < 16) ? 'block' : 'none';
            });

            // Tanggal Lahir validation
            const tglLahirInput = document.getElementById('tgl_lahir');
            const maxDate = new Date().toISOString().split('T')[0];
            tglLahirInput.setAttribute('max', maxDate);
            tglLahirInput.addEventListener('input', function() { if (this.value > maxDate) this.value = maxDate; });

            // No HP validation
            const noHpInput = document.getElementById('no_hp_pasien');
            const noHpError = document.getElementById('noHpError');
            noHpInput.addEventListener('input', function() {
                this.value = this.value.replace(/\D/g, '');
                if (this.value.length > 13) this.value = this.value.slice(0, 13);
                noHpError.style.display = (this.value.length > 0 && (this.value.length < 9 || this.value.length > 13)) ? 'block' : 'none';
            });

            // Email validation
            const emailInput = document.getElementById('email_pasien');
            const emailError = document.getElementById('emailError');
            emailInput.addEventListener('input', function() {
                const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                emailError.style.display = (this.value.length > 0 && !emailPattern.test(this.value)) ? 'block' : 'none';
            });
        });

        // --- Sidebar & Profile Popup Logic (tidak diubah) ---
        let arrow = document.querySelectorAll(".arrow");
        for (var i = 0; i < arrow.length; i++) {
            arrow[i].addEventListener("click", (e) => {
                e.target.parentElement.parentElement.classList.toggle("showMenu");
            });
        }
        let sidebar = document.querySelector(".sidebar");
        let sidebarBtn = document.querySelector(".bx-menu");
        sidebarBtn.addEventListener("click", () => {
            sidebar.classList.toggle("close");
        });
        function toggleProfilePopup() {
            document.getElementById("profile-popup").classList.toggle("hidden");
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
