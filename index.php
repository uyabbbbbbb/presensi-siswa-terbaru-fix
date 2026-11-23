
<?php
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/navbar.php';
?>

<h2>Dashboard Presensi Siswa</h2>

<p>
    Selamat datang,
    <?= htmlspecialchars($_SESSION['username']) ?>!
</p>

<p>Silakan pilih menu untuk mengelola aplikasi.</p>

<?php
require_once __DIR__ . '/includes/footer.php';
?>
