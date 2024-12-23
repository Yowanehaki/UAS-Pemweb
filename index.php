<!-- menghubungkan ke databse -->
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
        
    // Menentukan jumlah data per halaman
    $limit = 10;

    // Mendapatkan halaman saat ini dari parameter URL (default: halaman 1)
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $start = ($page > 1) ? ($page * $limit) - $limit : 0;

    // Menghitung total data di tabel
    $totalResult = $conn->query("SELECT COUNT(*) AS total FROM mahasiswa");
    $totalRow = $totalResult->fetch_assoc();
    $totalData = $totalRow['total'];

    // Menghitung total halaman
    $totalPage = ceil($totalData / $limit);

    // Mengambil data dengan batasan halaman
    $result = $conn->query("SELECT * FROM mahasiswa LIMIT $start, $limit");
    $mahasiswaData = [];
    while ($row = $result->fetch_assoc()) {
        $mahasiswaData[] = $row;
    }
?>

<!---- kode html ---->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UAS</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container mt-5">
        <!-- Theme Toggle -->
        <div class="text-end mb-4">
            <div class="form-switch">
                <label class="form-check-label me-2" for="themeToggleSwitch">Theme</label>
                <br>
                <input class="form-check-input" type="checkbox" id="themeToggleSwitch">
            </div>
        </div>
        <h1 class="text-center mb-4">Data Mahasiswa</h1>

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


            <div class="text-end">
                <button type="submit" class="btn btn-primary">Tambah</button>
        </form>
        <div class="text-end mt-3">
        <button type="button" id="clearFormButton" class="btn btn-warning">Hapus Isi Form</button>
        </div>
        </div>
            <!-- Logout Button -->
            <button id="logoutButton" type="submit" class="btn btn-danger">Logout</button>
            </div>
        <!-- Tabel untuk menampilkan data -->
        <h2 class="text-center mb-3">Daftar Mahasiswa</h2>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Jenis Kelamin</th>
                        <th>Asal</th>
                        <th>Browser</th>
                        <th>IP Address</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Baris data -->
                    <?php foreach ($mahasiswaData as $row): ?>
                    <tr>
                        <td><?php echo $row['nim']; ?></td>
                        <td><?php echo $row['nama']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['jenis_kelamin']; ?></td>
                        <td><?php echo $row['asal']; ?></td>
                        <td><?php echo $row['browser']; ?></td>
                        <td><?php echo $row['ip_address']; ?></td>
                        <td>
                            <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-primary edit">Edit</a>
                            <a href="process/delete.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger delete">Hapus</a>
                        </td>

                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div>
            <!-- View Cookie Button -->
            <button id="viewCookieButton" class="btn btn-primary">Lihat Cookie</button>
            </div>
        </div>

        <!-- Pagination -->
        <nav aria-label="Pagination">
            <ul class="pagination justify-content-center mt-4">
                <?php if ($page > 1): ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?php echo $page - 1; ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                <?php endif; ?>
                
                <?php for ($i = 1; $i <= $totalPage; $i++): ?>
                    <li class="page-item <?php echo ($page == $i) ? 'active' : ''; ?>">
                        <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                    </li>
                <?php endfor; ?>

                <?php if ($page < $totalPage): ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?php echo $page + 1; ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src=script.js></script>
    <script>// Tambahkan event listener ke tombol
    document.getElementById('viewCookieButton').addEventListener('click', function () {
        // Arahkan ke index.html
        window.location.href = 'cookie/cookie.php';
    });
    
    document.getElementById('logoutButton').addEventListener('click', function () {
        // Arahkan ke index.html
        window.location.href = 'logout.php';
    });
     // Theme Toggle Functionality
     const themeToggleSwitch = document.getElementById("themeToggleSwitch");

    // Fungsi untuk menyimpan preferensi tema
    function saveThemePreference(isDark) {
        localStorage.setItem("theme", isDark ? "dark" : "light");
    }

    // Fungsi untuk memuat preferensi tema
    function loadThemePreference() {
        const savedTheme = localStorage.getItem("theme");
        if (savedTheme === "dark") {
            document.body.classList.add("dark-mode");
            themeToggleSwitch.checked = true;
        } else {
            document.body.classList.remove("dark-mode");
            themeToggleSwitch.checked = false;
        }
    }

    // Event listener untuk toggle switch
    themeToggleSwitch.addEventListener("change", function () {
        const isDark = themeToggleSwitch.checked;
        document.body.classList.toggle("dark-mode", isDark);
        saveThemePreference(isDark);
    });

    // Saat halaman dimuat, muat preferensi tema
    document.addEventListener("DOMContentLoaded", function () {
        loadThemePreference();
    });


    // Event listener untuk tombol logout
    document.addEventListener('DOMContentLoaded', function () {
        const logoutButton = document.getElementById('logoutButton');

        // Simpan status login ke sessionStorage saat pengguna login
        sessionStorage.setItem('isLoggedIn', 'true');

        // Event listener untuk tombol logout
        logoutButton.addEventListener('click', function () {
            // Hapus status login dari sessionStorage
            sessionStorage.removeItem('isLoggedIn');

            // Redirect ke halaman login
            alert('Anda telah berhasil logout.');
            window.location.href = 'login.php';
        });

        // Cek status login saat halaman dimuat
        if (!sessionStorage.getItem('isLoggedIn')) {
            // Jika tidak ada data di sessionStorage, redirect ke halaman login
            alert('Sesi telah berakhir. Harap login kembali.');
            window.location.href = 'login.php';
        }
    });

    // Event listener untuk form
    document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('formEdit');
    const confirmBox = document.getElementById('confirm');
    const clearFormButton = document.getElementById('clearFormButton');

    // Fungsi untuk validasi form dan mengontrol checkbox
    const validateForm = () => {
        let allFilled = true; // Asumsi semua input sudah terisi
        [...form.elements].forEach(input => {
            if (input.type !== 'checkbox' && input.type !== 'hidden' && input.required) {
                if (input.value.trim() === '') {
                    allFilled = false; // Jika ada input kosong, validasi gagal
                }
            }
        });
        confirmBox.disabled = !allFilled; // Aktifkan checkbox jika semua input terisi
        localStorage.setItem('confirmBoxDisabled', confirmBox.disabled); // Simpan status checkbox di localStorage
    };

    // Memuat data dari localStorage ke form jika ada
    const loadFormData = () => {
        const savedData = JSON.parse(localStorage.getItem('formData')) || {};
        Object.keys(savedData).forEach(key => {
            const input = document.querySelector(`[name="${key}"]`);
            if (input) {
                if (input.type === 'checkbox') {
                    input.checked = savedData[key] === true; // Nilai boolean untuk checkbox
                } else {
                    input.value = savedData[key];
                }
            }
        });

        // Memuat status checkbox dari localStorage
        const savedConfirmDisabled = localStorage.getItem('confirmBoxDisabled');
        if (savedConfirmDisabled !== null) {
            confirmBox.disabled = savedConfirmDisabled === 'true'; // Set sesuai status sebelumnya
        }
    };

    // Menyimpan data ke localStorage saat pengguna mengetik
    const saveFormData = () => {
        const formData = new FormData(form);
        const data = {};
        formData.forEach((value, key) => {
            const input = document.querySelector(`[name="${key}"]`);
            if (input.type === 'checkbox') {
                data[key] = input.checked;
            } else {
                data[key] = value;
            }
        });
        localStorage.setItem('formData', JSON.stringify(data));
    };

    // Hapus data formulir dari localStorage
    clearFormButton.addEventListener('click', function () {
        localStorage.removeItem('formData'); // Hapus data form dari localStorage
        localStorage.removeItem('confirmBoxDisabled'); // Hapus status checkbox
        form.reset(); // Reset semua input di form
        confirmBox.disabled = true; // Nonaktifkan checkbox
        alert('Data formulir telah dihapus.');
    });

    // Validasi ulang saat input berubah
    form.addEventListener('input', function () {
        saveFormData(); // Simpan data ke localStorage
        validateForm(); // Validasi form
    });

    // Hapus data dari localStorage setelah form disubmit
    form.addEventListener('submit', function () {
        localStorage.removeItem('formData');
        localStorage.removeItem('confirmBoxDisabled');
    });

    // Memuat data dan memvalidasi saat halaman dimuat
    loadFormData();
    validateForm();
});

    </script>
</body>
</html>