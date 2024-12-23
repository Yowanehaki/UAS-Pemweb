# Dokumentasi Project UAS Web Programming

Project Data Mahasiswa -   Sistem Pendaftaran dan CRUD

Oleh : Mulfi Hazwi Artaf - 122140186 - Pemrograman Web RA

## Daftar Isi

1. [Client-side Programming](#1-client-side-programming-30)
2. [Server-side Programming](#2-server-side-programming-30)
3. [Database Management](#3-database-management-20)
4. [State Management](#4-state-management-20)
5. [Bonus: Hosting Aplikasi Web](#bonus-hosting-aplikasi-web-20)

## 1. Client-side Programming (30%)

### 1.1 Manipulasi DOM dengan JavaScript (15%)

Implementasi form pendaftaran peserta lomba dengan 4 elemen input berbeda:

```html
<!-- Form untuk menambahkan data -->
        <h2 class="text-center mb-3">Pemrograman Web</h2>
        <div>
        <form id="formEdit" method="POST" action="add.php" class="mb-4">
            <div class="row mb-3">
                <label for="nim" class="col-sm-2 col-form-label text-end">NIM</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="nim" name="nim" placeholder="Masukkan NIM (Hanya Angka)">
                </div>
            </div>
            <div class="row mb-3">
                <label for="nama" class="col-sm-2 col-form-label text-end">Nama</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama">
                </div>
            </div>
            <div class="row mb-3">
                <label for="email" class="col-sm-2 col-form-label text-end">Email</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan Email">
                </div>
            </div>
            <div class="row mb-3">
                <label for="jenis_kelamin" class="col-sm-2 col-form-label text-end">Jenis Kelamin</label>
                <div class="col-sm-10">
                    <select class="form-select" id="jenis_kelamin" name="jenis_kelamin">
                        <option value="" disabled selected>Pilih Jenis Kelamin</option>
                        <option value="Laki-Laki">Laki-Laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <label for="asal" class="col-sm-2 col-form-label text-end">Asal</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="asal" name="asal" placeholder="Masukkan Asal">
                </div>
            </div>
            <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" id="confirm" name="confirm" disabled>
            <label class="form-check-label" for="confirm">Apakah data sudah benar?</label>
        </div>
```

### 1.2 Event Handling (15%)

Implementasi 3 event berbeda untuk form:

```javascript
// Validasi form untuk memastikan semua field diisi sebelum submit
        const form = document.getElementById('formEdit');
        form.addEventListener('submit', function (e) {
        const nim = document.getElementById('nim');
        const nama = document.getElementById('nama');
        const email = document.getElementById('email');
        const jenisKelamin = document.getElementById('jenis_kelamin');
        const asal = document.getElementById('asal');
        const confirmBox = document.getElementById('confirm');

        // Hapus pesan error sebelumnya
        document.querySelectorAll('.error-message').forEach(error => error.remove());

        let isValid = true;

        // Fungsi untuk menampilkan pesan error
        function showError(input, message) {
            const error = document.createElement('span');
            error.className = 'error-message';
            error.style.color = 'red';
            error.style.fontSize = '0.9rem';
            error.innerText = message;
            input.parentElement.appendChild(error);
        }

        // Validasi NIM
        if (nim.value.trim() === '') {
            isValid = false;
            showError(nim, 'NIM harus diisi.');
        }

        // Validasi Nama
        if (nama.value.trim() === '') {
            isValid = false;
            showError(nama, 'Nama harus diisi.');
        }

        // Validasi Email
        if (email.value.trim() === '') {
            isValid = false;
            showError(email, 'Email harus diisi.');
        } else if (!/^\S+@\S+\.\S+$/.test(email.value.trim())) {
            isValid = false;
            showError(email, 'Format email tidak valid.');
        }

        // Validasi Jenis Kelamin
        if (jenisKelamin.value.trim() === '') {
            isValid = false;
            showError(jenisKelamin, 'Jenis kelamin harus dipilih.');
        }

        // Validasi Asal
        if (asal.value.trim() === '') {
            isValid = false;
            showError(asal, 'Asal harus diisi.');
        }

        // Validasi Checkbox
        if (!confirmBox.checked) {
            isValid = false;
            const confirmError = document.createElement('span');
            confirmError.className = 'error-message';
            confirmError.style.color = 'red';
            confirmError.style.fontSize = '0.9rem';
            confirmError.innerText = 'Anda harus mencentang "Apakah data sudah benar?".';
            confirmBox.parentElement.appendChild(confirmError);
        }

        // Jika tidak valid, cegah pengiriman form
        if (!isValid) {
            e.preventDefault();
        }
    });

    // Validasi input saat halaman dimuat
        document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('formEdit');
        const nim = document.getElementById('nim');
        const nama = document.getElementById('nama');
        const email = document.getElementById('email');
        const jenisKelamin = document.getElementById('jenis_kelamin');
        const asal = document.getElementById('asal');
        const confirmBox = document.getElementById('confirm');

        // Fungsi untuk memvalidasi input
        function validateInputs() {
        const isNimValid = nim.value.trim() !== '';
        const isNamaValid = nama.value.trim() !== '';
        const isEmailValid = email.value.trim() !== '';
        const isJenisKelaminValid = jenisKelamin.value.trim() !== '';
        const isAsalValid = asal.value.trim() !== '';

        // Aktifkan checkbox jika semua input valid
        if (isNimValid && isNamaValid && isEmailValid && isJenisKelaminValid && isAsalValid) {
            confirmBox.disabled = false; // Aktifkan checkbox
        } else {
            confirmBox.disabled = true; // Tetap nonaktif jika ada input yang kosong
        }
        }

        // Tambahkan event listener untuk setiap input
        [nim, nama, email, jenisKelamin, asal].forEach(input => {
        input.addEventListener('input', validateInputs);
        input.addEventListener('change', validateInputs);
        });
        });
```

## 2. Server-side Programming (30%)

### 2.1 Pengelolaan Data dengan PHP (20%)

```php deteksi IP dan Browser
<?php
    // Fungsi untuk mendeteksi browser
    function getBrowser($userAgent) {
        $browsers = [
            'Edg' => 'Microsoft Edge',
            'Edge' => 'Microsoft Edge',
            'Chrome' => 'Google Chrome',
            'Firefox' => 'Mozilla Firefox',
            'Safari' => 'Safari',
        ];

        // Memeriksa apakah browser terdeteksi
        foreach ($browsers as $key => $browserName) {
            if (strpos($userAgent, $key) !== false) {
                return $browserName;
            }
        }

        return 'Browser Tidak Dikenali'; // Default jika tidak ditemukan
    }

    // Fungsi untuk mendapatkan IP Address
    function getUserIp() {
        $ipAddress = '';

        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ipAddress = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ipArray = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
            $ipAddress = trim($ipArray[0]);
        } else {
            $ipAddress = $_SERVER['REMOTE_ADDR'];
        }

        // Cek apakah IP adalah ::1 (IPv6 loopback)
        if ($ipAddress === '::1') {
            $ipAddress = '127.0.0.1'; // Konversi ke IPv4 loopback
        }

        return filter_var($ipAddress, FILTER_VALIDATE_IP) ? $ipAddress : 'IP Tidak Dikenali';
    }

    // Mendapatkan data browser dan IP
    $userAgent = $_SERVER['HTTP_USER_AGENT'];
    $browser = getBrowser($userAgent);
    $ipAddress = getUserIp();

    // Mendapatkan data mahasiswa dari database
    include 'config/connection.php';
    $result = $conn->query("SELECT * FROM mahasiswa");
    $mahasiswaData = [];
    while ($row = $result->fetch_assoc()) {
        $mahasiswaData[] = $row;
    }
?>

```

### 2.2 Objek PHP Berbasis OOP (10%)

```php
<?php
// config/connection_oop.php
class Connection {
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "sample_db";
    private $conn;

    // Constructor
    public function __construct() {
        $this->conn = new mysqli(
            $this->host,
            $this->username,
            $this->password,
            $this->database
        );

        // Check connection
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }
// Mengembalikan koneksi
    public function getConnection() {
        return $this->conn;
    }
// Menutup koneksi
    public function closeConnection() {
        if ($this->conn) {
            $this->conn->close();
        }
    }
}
?>

```

## 3. Database Management (20%)

### 3.1 Pembuatan Tabel Database (5%)

```sql
/-- Membuat database
CREATE DATABASE sample_db;

-- Gunakan database yang baru dibuat
USE sample_db;

-- Membuat tabel users (untuk login)
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL, -- Simpan password yang telah di-hash
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Membuat tabel mahasiswa (data mahasiswa)
CREATE TABLE mahasiswa (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nim VARCHAR(15) NOT NULL UNIQUE,
    nama VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    jenis_kelamin ENUM('Laki-Laki', 'Perempuan') NOT NULL,
    asal VARCHAR(100) NOT NULL,
    browser VARCHAR(100) DEFAULT NULL,
    ip_address VARCHAR(45) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

```

### 3.2 Konfigurasi Koneksi Database (5%)

```php
<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "sample_db";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

```

### 3.3 Manipulasi Data pada Database (10%)

Implementasi di class Connection dengan metode construct(), getConnection(), dan closeConnection().

## 4. State Management (20%)

### 4.1 State Management dengan Session (10%)

```php
<?php 
    include 'process/detect.php';
    include 'session/session.php';

        // Mulai session
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION['username'])) {
            header('Location: login.php');
            exit();
        }
```

### 4.2 Pengelolaan State dengan Cookie (10%)

```php
 // Fungsi untuk menyetel cookie
        function setCookie(name, value, days) {
            const date = new Date();
            date.setTime(date.getTime() + days * 24 * 60 * 60 * 1000);
            document.cookie = `${name}=${encodeURIComponent(value)};expires=${date.toUTCString()};path=/`;
            alert(`Cookie "${name}" berhasil disimpan!`);
            updateDisplayedCookie(name);
        }

        // Fungsi untuk mendapatkan cookie tertentu
        function getCookie(name) {
            const cookies = document.cookie.split('; ').reduce((acc, cookie) => {
                const [key, val] = cookie.split('=');
                acc[key] = decodeURIComponent(val);
                return acc;
            }, {});
            return cookies[name] || null;
        }

        // Fungsi untuk memperbarui tampilan nilai cookie
        function updateDisplayedCookie(name) {
            const value = getCookie(name);
            cookieDisplay.textContent = value ? `${value}` : 'Belum ada nilai';
        }

        // Event listener untuk Set Cookie
        setCookieBtn.addEventListener('click', function () {
            const cookieName = cookieNameInput.value.trim();
            const value = stateInput.value.trim();

            if (!cookieName || !value) {
                alert('Masukkan nama cookie dan nilainya terlebih dahulu!');
                return;
            }
            setCookie(cookieName, value, 7);
        });

        // Event listener untuk Get Cookie
        getCookieBtn.addEventListener('click', function () {
            const cookieName = getCookieInput.value.trim();
            if (!cookieName) {
                alert('Masukkan nama cookie untuk dicari!');
                return;
            }
            const result = getCookie(cookieName);
            if (result) {
                cookieResult.textContent = `Nilai Cookie: ${result}`;
                cookieResult.classList.remove('text-danger');
                cookieResult.classList.add('text-success');
            } else {
                cookieResult.textContent = 'Cookie tidak ditemukan.';
                cookieResult.classList.remove('text-success');
                cookieResult.classList.add('text-danger');
                alert('Cookie tidak ditemukan. Pastikan nama cookie benar!');
            }
        });
      });
```

## Bonus: Hosting Aplikasi Web (20%)

### Langkah-langkah Hosting di InfinityFree

1. **Registrasi Akun**:

   - Buat akun di InfinityFree (infinityfree.com)
   - Pilih paket hosting gratis

2. **Persiapan File**:

   - Compress semua file project ke dalam ZIP
   - Pastikan struktur folder sudah benar

3. **Upload dan Konfigurasi**:

   - Login ke control panel InfinityFree
   - Upload file ZIP melalui File Manager
   - Extract file di public_html
   - Buat database MySQL dan import struktur tabel

4. **Konfigurasi Database**:

   - Update file database.php dengan kredensial yang diberikan InfinityFree:

   ```php
   $host = 'SQL.infinityfree.com';
   $dbname = '[nama_database]';
   $username = '[username_database]';
   $password = '[password_database]';
   ```

5. **Keamanan**:

   - Gunakan HTTPS
   - Implementasi validasi input
   - Gunakan prepared statements
   - Enkripsi data sensitif
   - Regular backup database

6. **Testing**:
   - Cek semua fitur berfungsi
   - Pastikan form dapat menyimpan data
   - Verifikasi session dan cookie berjalan
   - Test performa website
