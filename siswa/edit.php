
<?php

require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../models/Siswa.php';
require_once __DIR__ . '/../models/Kelas.php';

$siswaModel = new Siswa();
$kelasModel = new Kelas();

// Mengambil NISN dari URL
$nisn = $_GET['nisn'] ?? '';

// Memeriksa NISN
if (!preg_match('/^[0-9]{10}$/', $nisn)) {
    header("Location: index.php?pesan=" . urlencode("NISN tidak valid"));
    exit;
}

// Mengambil data siswa
$siswa = $siswaModel->getByNisn($nisn);

if (!$siswa) {
    header("Location: index.php?pesan=" . urlencode("Siswa tidak ditemukan"));
    exit;
}

// Mengambil daftar kelas
$dataKelas = $kelasModel->getAll();

// Mengisi form dengan data sebelumnya
$nama = $siswa['nama'];
$alamat = $siswa['alamat'] ?? '';
$id_kelas = $siswa['id_kelas'];

$errors = [];

// Proses ketika tombol Simpan ditekan
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nama = trim($_POST['nama'] ?? '');
    $alamat = trim($_POST['alamat'] ?? '');
    $id_kelas = $_POST['id_kelas'] ?? '';

    // Validasi nama
    if ($nama === '') {
        $errors['nama'] = "Nama siswa wajib diisi.";
    } elseif (mb_strlen($nama) > 100) {
        $errors['nama'] = "Nama maksimal 100 karakter.";
    }

    // Validasi alamat
    if (mb_strlen($alamat) > 255) {
        $errors['alamat'] = "Alamat maksimal 255 karakter.";
    }

    // Validasi kelas
    if (
        !ctype_digit((string)$id_kelas) ||
        !$kelasModel->getById((int)$id_kelas)
    ) {
        $errors['id_kelas'] = "Pilih kelas yang terdaftar.";
    }

    // Simpan jika tidak ada error
    if (empty($errors)) {

        try {

            $siswaModel->edit(
                $nisn,
                $nama,
                $alamat,
                (int)$id_kelas
            );

            header(
                "Location: index.php?pesan=" .
                urlencode("Data siswa berhasil diubah")
            );
            exit;

        } catch (PDOException $e) {

            $errors['umum'] = "Gagal mengubah data siswa.";

        }
    }
}

require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/navbar.php';

?>

<h2>Edit Siswa</h2>

<?php if (isset($errors['umum'])): ?>
    <p style="color:red;">
        <?= htmlspecialchars($errors['umum']) ?>
    </p>
<?php endif; ?>

<form method="POST">

    <!-- NISN -->
    <label for="nisn">NISN</label>
    <br>

    <input
        type="text"
        id="nisn"
        value="<?= htmlspecialchars($nisn) ?>"
        readonly
    >

    <br><br>

    <!-- Nama -->
    <label for="nama">Nama Siswa</label>
    <br>

    <input
        type="text"
        id="nama"
        name="nama"
        maxlength="100"
        value="<?= htmlspecialchars($nama) ?>"
        required
    >

    <?php if (isset($errors['nama'])): ?>
        <p style="color:red;">
            <?= htmlspecialchars($errors['nama']) ?>
        </p>
    <?php endif; ?>

    <br>

    <!-- Alamat -->
    <label for="alamat">Alamat</label>
    <br>

    <textarea
        id="alamat"
        name="alamat"
        maxlength="255"
    ><?= htmlspecialchars($alamat) ?></textarea>

    <?php if (isset($errors['alamat'])): ?>
        <p style="color:red;">
            <?= htmlspecialchars($errors['alamat']) ?>
        </p>
    <?php endif; ?>

    <br><br>

    <!-- Kelas -->
    <label for="id_kelas">Kelas</label>
    <br>

    <select id="id_kelas" name="id_kelas" required>

        <option value="">-- Pilih Kelas --</option>

        <?php foreach ($dataKelas as $kelas): ?>

            <option
                value="<?= htmlspecialchars((string)$kelas['id_kelas']) ?>"
                <?= (string)$id_kelas === (string)$kelas['id_kelas']
                    ? 'selected' : '' ?>
            >
                <?= htmlspecialchars($kelas['nama_kelas']) ?>
            </option>

        <?php endforeach; ?>

    </select>

    <?php if (isset($errors['id_kelas'])): ?>
        <p style="color:red;">
            <?= htmlspecialchars($errors['id_kelas']) ?>
        </p>
    <?php endif; ?>

    <br><br>

    <button type="submit">Simpan Perubahan</button>

    <a href="index.php">Batal</a>

</form>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
