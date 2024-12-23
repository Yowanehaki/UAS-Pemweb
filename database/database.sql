-- Membuat database
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
