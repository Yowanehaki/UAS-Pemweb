<?php
include '../config/connection.php'; //jalur include

    if (isset($_GET['id'])) {
        $id = intval($_GET['id']); // Pastikan ID adalah integer
        $page = isset($_GET['page']) ? intval($_GET['page']) : 1; // Ambil parameter halaman

        // Lakukan operasi penghapusan data
        if ($conn) {
            $sql = "DELETE FROM mahasiswa WHERE id = $id";
            if ($conn->query($sql) === TRUE) {
                echo "<script>
                    alert('Data berhasil terhapus!');
                    window.location.href = '../index.php?page=$page'; // Redirect ke halaman yang sama
                </script>";
            } else {
                echo "<script>
                    alert('Terjadi kesalahan: " . $conn->error . "');
                    window.location.href = '../index.php?page=$page';
                </script>";
            }
        } else {
            echo "<script>
                alert('Koneksi ke database gagal.');
                window.location.href = '../index.php';
            </script>";
        }
    } else {
        echo "<script>
            alert('ID tidak ditemukan.');
            window.location.href = '../index.php';
        </script>";
    }
?>
