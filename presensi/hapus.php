<?php

require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../models/Presensi.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$id = filter_input(
    INPUT_POST,
    'id',
    FILTER_VALIDATE_INT,
    ['options' => ['min_range' => 1]]
);

if (!$id) {
    header('Location: index.php?pesan=gagal');
    exit;
}

$presensiModel = new Presensi();

try {

    $berhasil = $presensiModel->hapusPresensi($id);

    if ($berhasil) {
        header('Location: index.php?pesan=berhasil');
    } else {
        header('Location: index.php?pesan=gagal');
    }

} catch (PDOException $e) {
    header('Location: index.php?pesan=gagal');
}

exit;
