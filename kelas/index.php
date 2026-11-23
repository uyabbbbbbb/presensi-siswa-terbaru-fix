<?php
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../models/Kelas.php';

$kelasModel = new Kelas();
$dataKelas = $kelasModel->getAll();

require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/navbar.php';
?>

<h2>Data Kelas</h2>

<a href="tambah.php">+ Tambah Kelas</a>

<br><br>

<?php if (isset($_GET['pesan'])): ?>
    <p><?= htmlspecialchars($_GET['pesan']) ?></p>
<?php endif; ?>

<table border="1" cellpadding="8">
    <tr>
        <th>No</th>
        <th>Nama Kelas</th>
        <th>Jurusan</th>
        <th>Aksi</th>
    </tr>

    <?php foreach ($dataKelas as $no => $kelas): ?>
        <tr>
            <td><?= $no + 1 ?></td>
            <td><?= htmlspecialchars($kelas['nama_kelas']) ?></td>
            <td><?= htmlspecialchars($kelas['jurusan']) ?></td>
            <td>
                <a href="edit.php?id=<?= $kelas['id_kelas'] ?>">
                    Edit
                </a>

                <form action="hapus.php" method="POST"
                      style="display:inline">
                    <input type="hidden" name="id"
                           value="<?= $kelas['id_kelas'] ?>">
                    <button type="submit"
                            onclick="return confirm('Hapus kelas ini?')">
                        Hapus
                    </button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
