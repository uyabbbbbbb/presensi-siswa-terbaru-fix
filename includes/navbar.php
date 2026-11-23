<?php
$baseUrl = '/presensi-siswa-main/';

$menu = [
    ['Dashboard', 'index.php'],
    ['Data Kelas', 'kelas/index.php'],
    ['Data Siswa', 'siswa/index.php'],
    ['Tap Kartu', 'presensi/tap.php'],
    ['Rekap Presensi', 'presensi/index.php'],
    ['Logout', 'logout.php']
];
?>

<nav class="navbar">
    <?php foreach ($menu as $index => $item): ?>
        <?php if ($index > 0): ?>
            <span class="nav-separator" aria-hidden="true">|</span>
        <?php endif; ?>

        <a href="<?= htmlspecialchars(
            $baseUrl . $item[1],
            ENT_QUOTES,
            'UTF-8'
        ) ?>">
            <?= htmlspecialchars(
                $item[0],
                ENT_QUOTES,
                'UTF-8'
            ) ?>
        </a>
    <?php endforeach; ?>
</nav>
