<?php
// Menghubungkan ke database
include 'config/connection_oop.php'; // Menghubungkan ke file connection_oop.php';
include 'process/detect.php'; // Untuk fungsi getBrowser() dan getUserIp()

// Memeriksa metode permintaan
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $connObj = new Connection();
    $conn = $connObj->getConnection();

    // Parsing dan membersihkan data dari $_POST
    $nim = trim($_POST['nim']);
    $nama = trim($_POST['nama']);
    $email = trim($_POST['email']);
    $jenis_kelamin = trim($_POST['jenis_kelamin']);
    $asal = trim($_POST['asal']);
    $browser = getBrowser($_SERVER['HTTP_USER_AGENT']); // Dapatkan browser
    $ip_address = getUserIp(); // Dapatkan IP address

    // Validasi data
    if (!preg_match('/^[0-9]+$/', $nim)) {
        die("NIM harus berupa angka.");
    }
    if (!preg_match('/^[a-zA-Z\s]+$/', $nama)) {
        die("Nama harus berupa huruf dan spasi.");
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Email tidak valid.");
    }
    if (!in_array($jenis_kelamin, ['Laki-Laki', 'Perempuan'])) {
        die("Jenis kelamin tidak valid.");
    }
    $asal = htmlspecialchars($asal);

    // Escape data sebelum dimasukkan ke query
    $stmt = $conn->prepare("INSERT INTO mahasiswa (nim, nama, email, jenis_kelamin, asal, browser, ip_address) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("issssss", $nim, $nama, $email, $jenis_kelamin, $asal, $browser, $ip_address);

    if ($stmt->execute()) {
        echo "<script>alert('Data berhasil ditambahkan!'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan: " . $stmt->error . "');</script>";
    }

    $stmt->close();
    $connObj->closeConnection();
}
?>
