<?php
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../models/Siswa.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: index.php");
    exit;
}

$nisn = $_POST['nisn'] ?? '';

if (!preg_match('/^[0-9]{10}$/', $nisn)) {
    $pesan = "NISN tidak valid.";
} else {
    $siswaModel = new Siswa();

    try {
        if (!$siswaModel->getByNisn($nisn)) {
            $pesan = "Siswa tidak ditemukan.";
        } else {
            $siswaModel->hapus($nisn);
            $pesan = "Siswa berhasil dihapus.";
        }
    } catch (PDOException $e) {
        if ($e->getCode() == '23000') {
            $pesan = "Siswa tidak bisa dihapus karena sudah memiliki riwayat presensi.";
        } else {
            $pesan = "Gagal menghapus siswa.";
        }
    }
}

header("Location: index.php?pesan=" . urlencode($pesan));
exit;
