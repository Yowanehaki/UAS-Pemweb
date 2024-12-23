<?php
    include 'config/connection.php';
    // Mulai session
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['username'])) {
        header('Location: login.php');
        exit();
    }

    // Mendapatkan data mahasiswa
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $result = $conn->query("SELECT * FROM mahasiswa WHERE id = $id");
        $row = $result->fetch_assoc();
    }

    // Memperbarui data
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id = $_POST['id'];
        $nim = $_POST['nim'];
        $nama = $_POST['nama'];
        $email = $_POST['email'];
        $jenis_kelamin = $_POST['jenis_kelamin'];
        $asal = $_POST['asal'];

        // Validasi data
        $sql = "UPDATE mahasiswa SET nim = '$nim', nama = '$nama', email = '$email', jenis_kelamin = '$jenis_kelamin', asal = '$asal' WHERE id = $id";
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Data berhasil diperbarui!'); window.location.href='index.php';</script>";
        } else {
            echo "<script>alert('Terjadi kesalahan saat memperbarui data!');</script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Mahasiswa</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Gaya CSS */
        body {
            background: linear-gradient(120deg, #f0f4ff, #d6eaff);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 15px;
        }
        .container {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            padding: 30px;
            max-width: 500px;
            width: 100%;
        }
        h1 {
            font-size: 1.8rem;
            font-weight: bold;
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }
        .btn-primary {
            background: linear-gradient(45deg, #007bff, #0056b3);
            border: none;
        }
        .btn-primary:hover {
            background: linear-gradient(45deg, #0056b3, #003d80);
        }
        .back-link {
            display: block;
            margin-top: 15px;
            text-align: center;
            font-weight: bold;
            text-decoration: none;
            color: #007bff;
            transition: color 0.3s;
        }
        .back-link:hover {
            color: #0056b3;
        }
    </style>
</head>
<body>
    <!-- Konten halaman -->
    <div class="container">
        <h1>Edit Data Mahasiswa</h1>
        <form id="editForm" method="POST" action="edit.php">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <!-- Form untuk memperbarui data -->
            <div class="mb-3">
                <label for="nim" class="form-label">NIM</label>
                <input type="number" class="form-control" id="nim" name="nim" value="<?php echo $row['nim']; ?>" placeholder="Masukkan NIM (Hanya Angka)" required>
            </div>

            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $row['nama']; ?>" placeholder="Masukkan Nama" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $row['email']; ?>" placeholder="Masukkan Email" required>
            </div>

            <div class="mb-3">
                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                    <option value="Laki-Laki" <?php if ($row['jenis_kelamin'] == 'Laki-Laki') echo 'selected'; ?>>Laki-Laki</option>
                    <option value="Perempuan" <?php if ($row['jenis_kelamin'] == 'Perempuan') echo 'selected'; ?>>Perempuan</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="asal" class="form-label">Asal</label>
                <input type="text" class="form-control" id="asal" name="asal" value="<?php echo $row['asal']; ?>" placeholder="Masukkan Asal" required>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary w-100">Update</button>
            </div>
        </form>
        <a href="index.php" class="back-link">&laquo; Kembali ke Daftar</a>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Konfirmasi sebelum memperbarui data
        const form = document.getElementById('editForm');
        form.addEventListener('submit', function (e) {
            const confirmation = confirm('Apakah Anda yakin ingin memperbarui data ini?');
            if (!confirmation) {
                e.preventDefault();
            }
        });
    </script>
</body>
</html>

