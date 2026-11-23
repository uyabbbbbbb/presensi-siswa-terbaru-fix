CREATE DATABASE IF NOT EXISTS db_presensi;

USE db_presensi;

CREATE TABLE IF NOT EXISTS kelas (
    id_kelas INT AUTO_INCREMENT PRIMARY KEY,
    nama_kelas VARCHAR(20) NOT NULL UNIQUE,
    jurusan VARCHAR(50) NOT NULL
);

CREATE TABLE IF NOT EXISTS siswa (
    nisn CHAR(10) PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    alamat VARCHAR(255),
    id_kelas INT NOT NULL,
    FOREIGN KEY (id_kelas)
        REFERENCES kelas(id_kelas)
);

CREATE TABLE IF NOT EXISTS presensi (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nisn CHAR(10) NOT NULL,
    tanggal_waktu DATETIME NOT NULL
        DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (nisn)
        REFERENCES siswa(nisn)
);

CREATE TABLE IF NOT EXISTS users (
    id_user INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);
