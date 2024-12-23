<?php
// Mulai session
session_start();

// Fungsi untuk menyimpan informasi pengguna ke dalam session
function setUserSession($userId, $userName, $userEmail) {
    $_SESSION['user'] = [
        'id' => $userId,
        'name' => $userName,
        'email' => $userEmail,
    ];
}

// Fungsi untuk mendapatkan informasi pengguna dari session
function getUserSession() {
    return isset($_SESSION['user']) ? $_SESSION['user'] : null;
}

// Fungsi untuk menghapus session pengguna
function destroyUserSession() {
    if (isset($_SESSION['user'])) {
        unset($_SESSION['user']);
    }
}
?>
