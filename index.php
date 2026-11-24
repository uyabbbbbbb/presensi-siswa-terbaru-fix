<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/navbar.php';
?>

<h2>Dashboard Presensi Siswa</h2>

<p>
    Selamat datang,
    <?= htmlspecialchars($_SESSION['username'], ENT_QUOTES, 'UTF-8') ?>!
</p>

<p>Silakan pilih menu untuk mengelola aplikasi.</p>

<?php
require_once __DIR__ . '/includes/footer.php';
?>
