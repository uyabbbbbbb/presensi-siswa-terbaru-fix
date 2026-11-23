
<?php

require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../models/Presensi.php';
require_once __DIR__ . '/../models/Kelas.php';

$presensiModel = new Presensi();
$kelasModel = new Kelas();

$keyword = trim($_GET['cari'] ?? '');
$tanggal = $_GET['tanggal'] ?? '';
$id_kelas = $_GET['id_kelas'] ?? '';

if ($tanggal !== '') {
    $date = DateTime::createFromFormat('!Y-m-d', $tanggal);

    if (!$date || $date->format('Y-m-d') !== $tanggal) {
        $tanggal = '';
    }
}

if ($id_kelas !== '' && !ctype_digit((string)$id_kelas)) {
    $id_kelas = '';
}

$dataPresensi = $presensiModel->cariPresensi(
    $keyword,
    $tanggal,
    $id_kelas
);

$dataKelas = $kelasModel->getAll();

require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/navbar.php';

?>

<h2>Rekap Presensi Siswa</h2>

<p>Daftar riwayat kehadiran siswa.</p>

<a href="tap.php">+ Tap Kartu RFID</a>

<br><br>

<?php if (isset($_GET['pesan'])): ?>

    <?php if ($_GET['pesan'] === 'berhasil'): ?>
        <p>Riwayat presensi berhasil dihapus.</p>
    <?php elseif ($_GET['pesan'] === 'gagal'): ?>
        <p>Riwayat presensi gagal dihapus.</p>
    <?php endif; ?>

<?php endif; ?>

<form method="GET">

    <label>Cari Nama / NISN:</label>
    <input
        type="text"
        name="cari"
        placeholder="Masukkan nama atau NISN"
        value="<?= htmlspecialchars($keyword) ?>"
    >

    <br><br>

    <label>Tanggal:</label>
    <input
        type="date"
        name="tanggal"
        value="<?= htmlspecialchars($tanggal) ?>"
    >

    <br><br>

    <label>Kelas:</label>
    <select name="id_kelas">

        <option value="">Semua Kelas</option>

        <?php foreach ($dataKelas as $kelas): ?>

            <option
                value="<?= (int)$kelas['id_kelas'] ?>"
                <?= (string)$id_kelas === (string)$kelas['id_kelas']
                    ? 'selected' : '' ?>
            >
                <?= htmlspecialchars($kelas['nama_kelas']) ?>
            </option>

        <?php endforeach; ?>

    </select>

    <br><br>

    <button type="submit">Cari / Filter</button>
    <a href="index.php">Reset</a>

</form>

<br>

<table border="1" cellpadding="8" cellspacing="0">

    <thead>
        <tr>
            <th>No</th>
            <th>NISN</th>
            <th>Nama Siswa</th>
            <th>Kelas</th>
            <th>Tanggal</th>
            <th>Waktu</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>

        <?php if (empty($dataPresensi)): ?>

            <tr>
                <td colspan="7">
                    Data presensi tidak ditemukan.
                </td>
            </tr>

        <?php else: ?>

            <?php $no = 1; ?>

            <?php foreach ($dataPresensi as $data): ?>

                <tr>
                    <td><?= $no++ ?></td>

                    <td>
                        <?= htmlspecialchars($data['nisn']) ?>
                    </td>

                    <td>
                        <?= htmlspecialchars($data['nama']) ?>
                    </td>

                    <td>
                        <?= htmlspecialchars($data['nama_kelas']) ?>
                    </td>

                    <td>
                        <?= date(
                            'd-m-Y',
                            strtotime($data['tanggal_waktu'])
                        ) ?>
                    </td>

                    <td>
                        <?= date(
                            'H:i:s',
                            strtotime($data['tanggal_waktu'])
                        ) ?>
                    </td>

                    <td>
                        <form
                            method="POST"
                            action="hapus.php"
                            onsubmit="return confirm('Yakin ingin menghapus presensi ini?')"
                        >
                            <input
                                type="hidden"
                                name="id"
                                value="<?= (int)$data['id'] ?>"
                            >

                            <button type="submit">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>

            <?php endforeach; ?>

        <?php endif; ?>

    </tbody>

</table>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
