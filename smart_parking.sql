-- Buat database
CREATE DATABASE IF NOT EXISTS smart_parking;
USE smart_parking;

-- Tabel user/admin
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'user') DEFAULT 'user'
);

-- Insert admin default (username: admin, password: admin123)
INSERT INTO users (username, password, role)
VALUES ('admin', SHA1('admin123'), 'admin');

-- Tabel slot parkir
CREATE TABLE IF NOT EXISTS slot_parkir (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_slot VARCHAR(10) NOT NULL UNIQUE,
    status ENUM('kosong', 'terisi') DEFAULT 'kosong'
);

-- Contoh slot awal
INSERT INTO slot_parkir (nama_slot, status) VALUES
('A1', 'kosong'),
('A2', 'kosong'),
('A3', 'kosong'),
('A4', 'kosong');

-- Tabel parkir masuk
CREATE TABLE IF NOT EXISTS parkir_masuk (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_kartu VARCHAR(50) NOT NULL,
    plat_nomor VARCHAR(20) NOT NULL,
    waktu_masuk DATETIME DEFAULT CURRENT_TIMESTAMP,
    slot VARCHAR(10)
);

-- Tabel parkir keluar
CREATE TABLE IF NOT EXISTS parkir_keluar (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_kartu VARCHAR(50) NOT NULL,
    plat_nomor VARCHAR(20) NOT NULL,
    waktu_keluar DATETIME DEFAULT CURRENT_TIMESTAMP,
    slot VARCHAR(10)
);
