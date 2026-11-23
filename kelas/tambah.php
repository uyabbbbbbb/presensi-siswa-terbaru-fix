<?php
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../models/Kelas.php';

$kelasModel = new Kelas();

$error = "";
$nama = "";
$jurusan = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = trim($_POST['nama_kelas'] ?? '');
    $jurusan = trim($_POST['jurusan'] ?? '');

    if ($nama === '' || $jurusan === '') {
        $error = "Nama kelas dan jurusan wajib diisi.";
    } elseif (strlen($nama) > 20 || strlen($jurusan) > 50) {
        $error = "Nama kelas atau jurusan terlalu panjang.";
    } else {
        try {
            $kelasModel->tambah($nama, $jurusan);
            header("Location: index.php?pesan=" .
                   urlencode("Kelas berhasil ditambahkan"));
            exit;
        } catch (PDOException $e) {
            if ($e->getCode() == '23000') {
                $error = "Nama kelas sudah terdaftar.";
            } else {
                $error = "Gagal menambahkan kelas.";
            }
        }
    }
}

require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/navbar.php';
?>

<h2>Tambah Kelas</h2>

<?php if ($error): ?>
    <p style="color:red;"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form method="POST">
    <label>Nama Kelas</label><br>
    <input type="text" name="nama_kelas" maxlength="20"
           value="<?= htmlspecialchars($nama) ?>" required>

    <br><br>

    <label>Jurusan</label><br>
    <input type="text" name="jurusan" maxlength="50"
           value="<?= htmlspecialchars($jurusan) ?>" required>

    <br><br>

    <button type="submit">Simpan</button>
    <a href="index.php">Batal</a>
</form>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
