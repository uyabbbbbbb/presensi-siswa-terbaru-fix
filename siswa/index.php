
<?php
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../models/Siswa.php';

$siswaModel = new Siswa();

$keyword = trim($_GET['cari'] ?? '');

if ($keyword !== '') {
    $dataSiswa = $siswaModel->cari($keyword);
} else {
    $dataSiswa = $siswaModel->getAll();
}

require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/navbar.php';
?>

<h2>Data Siswa</h2>

<a href="tambah.php">+ Tambah Siswa</a>

<br><br>

<form method="GET" action="index.php">
    <input
        type="text"
        name="cari"
        placeholder="Cari nama atau NISN"
        value="<?= htmlspecialchars($keyword) ?>"
    >

    <button type="submit">Cari</button>
    <a href="index.php">Reset</a>
</form>

<br>

<?php if (isset($_GET['pesan'])): ?>
    <p><?= htmlspecialchars($_GET['pesan']) ?></p>
<?php endif; ?>

<table border="1" cellpadding="8">
    <tr>
        <th>No</th>
        <th>NISN</th>
        <th>Nama Siswa</th>
        <th>Alamat</th>
        <th>Kelas</th>
        <th>Aksi</th>
    </tr>

    <?php if (empty($dataSiswa)): ?>
        <tr>
            <td colspan="6">Tidak ada data siswa.</td>
        </tr>
    <?php else: ?>

        <?php foreach ($dataSiswa as $no => $siswa): ?>
            <tr>
                <td><?= $no + 1 ?></td>
                <td><?= htmlspecialchars($siswa['nisn']) ?></td>
                <td><?= htmlspecialchars($siswa['nama']) ?></td>
                <td><?= htmlspecialchars($siswa['alamat'] ?? '') ?></td>
                <td><?= htmlspecialchars($siswa['nama_kelas']) ?></td>
                <td>
                    <a href="edit.php?nisn=<?= urlencode($siswa['nisn']) ?>">
                        Edit
                    </a>

                    <form method="POST"
                          action="hapus.php"
                          style="display:inline">

                        <input
                            type="hidden"
                            name="nisn"
                            value="<?= htmlspecialchars($siswa['nisn']) ?>"
                        >

                        <button
                            type="submit"
                            onclick="return confirm('Yakin ingin menghapus siswa ini?')"
                        >
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>

    <?php endif; ?>
</table>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
