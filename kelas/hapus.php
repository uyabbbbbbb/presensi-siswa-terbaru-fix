<?php
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../models/Kelas.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: index.php");
    exit;
}

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

if (!$id) {
    $pesan = "ID kelas tidak valid.";
} else {
    $kelasModel = new Kelas();

    try {
        $kelas = $kelasModel->getById($id);

        if (!$kelas) {
            $pesan = "Kelas tidak ditemukan.";
        } else {
            $kelasModel->hapus($id);
            $pesan = "Kelas berhasil dihapus.";
        }
    } catch (PDOException $e) {
        if ($e->getCode() == '23000') {
            $pesan = "Kelas tidak bisa dihapus karena masih memiliki siswa.";
        } else {
            $pesan = "Gagal menghapus kelas.";
        }
    }
}

header("Location: index.php?pesan=" . urlencode($pesan));
exit;
