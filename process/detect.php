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
