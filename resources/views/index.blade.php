<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Rumah Sakit Islam Banjarmasin</title>
    <link rel="stylesheet" href="{{ asset('css/style/login.css') }}">
    <link rel="icon" href="{{ asset('image/logo_rs.png') }}" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>

    </style>
</head>

<body>
    <header>
        <div class="header-container">
            <img src="{{ asset('image/logo_rs.png') }}" alt="Logo Rumah Sakit" class="logo">
            <h1>RUMAH SAKIT ISLAM BANJARMASIN</h1>
        </div>
    </header>

    <main>
        <div class="login-card">
            <h2>Selamat Datang!</h2>
            <form id="loginForm">
                <label for="email">Email</label>
                <div class="input-group">
                    <img src="{{ asset('image/profile.png') }}" alt="icon Profile" class="icon">
                    <input type="email" id="email" placeholder="Masukkan Email Anda" required>
                </div>

                <label for="password">Kata Sandi</label>
                <div class="input-group">
                    <img src="{{ asset('image/key.png') }}" alt="Icon Sandi" class="icon">
                    <input type="password" id="password" placeholder="Masukkan Kata Sandi Anda" required>
                </div>

                <div class="forgot-password">
                    <a href="#">Lupa kata sandi?</a>
                </div>

                <button type="submit">Masuk</button>
            </form>

            <div id="messageArea" class="message" style="display: none;"></div>

            <!-- <p class="register-text">Belum punya akun? <a href="daftar_akun.html">Daftar disini</a></p> -->
        </div>
    </main>

    <script>
        const BASE_API_URL = 'https://nazarfadil.me/api';

        const loginForm = document.getElementById('loginForm');
        const emailInput = document.getElementById('email');
        const passwordInput = document.getElementById('password');
        const messageArea = document.getElementById('messageArea');

        function showMessage(message, type) {
            messageArea.innerHTML = message; // Gunakan innerHTML untuk mendukung <br>
            messageArea.className = `message ${type}`;
            messageArea.style.display = 'block';
        }

        function hideMessage() {
            messageArea.style.display = 'none';
        }

        loginForm.addEventListener('submit', async (event) => {
            event.preventDefault();
            hideMessage();

            const email = emailInput.value;
            const password = passwordInput.value;

            try {
                const response = await fetch(`${BASE_API_URL}/login`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'Authorization': `Bearer 123`
                    },
                    body: JSON.stringify({
                        email,
                        password
                    })
                });

                const data = await response.json();

                if (response.ok) {
                    // Login berhasil!
                    const token = data.access_token;
                    const userRole = data.user.roles; // Ambil role dari respons
                    const userName = data.user.name;

                    showMessage(`Login berhasil! Selamat datang, ${userName} (${userRole}).`, 'success');
                    console.log('Login Sukses:', data);
                    console.log('Token:', token);
                    console.log('Role Pengguna:', userRole);

                    // Simpan token dan role di localStorage
                    localStorage.setItem('auth_token', token);
                    localStorage.setItem('user_role', userRole);
                    localStorage.setItem('user_name', userName); // Opsional: simpan nama user

                    // === PENTING: Arahkan pengguna berdasarkan role ===
                    // Anda bisa menambahkan logika pengalihan di sini
                    // Pastikan userRole bertipe string untuk perbandingan yang konsisten
                    const roleStr = String(userRole);
                    if (roleStr === 'admin') {
                        window.location.href = '/dashboard'; // Admin
                    } else if (roleStr === 'super_admin' || roleStr === '1') {
                        window.location.href = '/login'; // Admin pendaftaran
                    } else if (roleStr === 'Dokter') {
                        window.location.href = 'https://ti054a02.agussbn.my.id'; // Dokter
                    } else if (roleStr === 'Perawat') {
                        window.location.href = 'https://ti054a02.agussbn.my.id'; // Perawat
                    } else if (roleStr === 'kasir' || roleStr === '5') {
                        window.location.href = 'https://ti054a03.agussbn.my.id'; // Petugas Kasir
                    } else if (roleStr === 'Admin Kasir' || roleStr === '3') {
                        window.location.href = 'https://ti054a03.agussbn.my.id'; // Admin Kasir
                    } else if (roleStr === 'Petugas Apotik') {
                        window.location.href = 'https://ti054a04.agussbn.my.id'; // Petugas Apotik
                    } else if (roleStr === 'Admin Apotik') {
                        window.location.href = 'https://ti054a04.agussbn.my.id'; // Admin Apotik
                    } else {
                        showMessage('Role pengguna tidak dikenali. Silakan hubungi admin.', 'error');
                    }

                } else {
                    let errorMessage = 'Terjadi kesalahan tidak dikenal.';
                    if (response.status === 422 && data.errors) {
                        errorMessage = Object.values(data.errors).flat().join('<br>');
                        showMessage(`Error validasi: <br>${errorMessage}`, 'error');
                    } else if (response.status === 401 && data.message) {
                        errorMessage = data.message;
                        showMessage(`Gagal Login: ${errorMessage}`, 'error');
                    } else if (data.message) {
                        errorMessage = data.message;
                        showMessage(`Gagal Login: ${errorMessage}`, 'error');
                    } else {
                        showMessage(`Gagal Login: ${response.status} ${response.statusText}`, 'error');
                    }
                    console.error('Login Gagal:', data);
                }

            } catch (error) {
                console.error('Error jaringan atau server:', error);
                showMessage(`Tidak dapat terhubung ke server.`, 'error');
            }
        });
    </script>
</body>

</html>
