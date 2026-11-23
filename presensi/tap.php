
<?php

require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../models/Presensi.php';

$presensiModel = new Presensi();

$pesan = "";
$status = false;
$nisn = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nisn = trim($_POST['nisn'] ?? '');

    // Memeriksa NISN harus 10 digit angka
    if (!preg_match('/^[0-9]{10}$/', $nisn)) {

        $pesan = "NISN harus terdiri dari 10 digit angka.";

    } else {

        try {

            // Memproses presensi siswa
            $hasil = $presensiModel->tapKartu($nisn);

            // Mengambil hasil dari model Presensi
            if (is_array($hasil)) {

                $status = (bool) ($hasil['status'] ?? false);
                $pesan = $hasil['pesan'] ?? "Presensi diproses.";

                // Mengosongkan input jika berhasil
                if ($status) {
                    $nisn = "";
                }

            } else {

                $pesan = "Hasil presensi tidak sesuai. Periksa model Presensi.";

            }

        } catch (PDOException $e) {

            $status = false;
            $pesan = "Gagal mencatat presensi.";

        }

    }
}

require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/navbar.php';

?>

<h2>Simulasi Tap Kartu RFID</h2>

<p>Masukkan NISN siswa untuk mencatat kehadiran.</p>

<?php if ($pesan !== ""): ?>

    <p style="color: <?= $status ? 'green' : 'red' ?>;">
        <?= htmlspecialchars($pesan) ?>
    </p>

<?php endif; ?>

<form method="POST" novalidate>

    <label for="nisn">NISN Siswa</label>
    <br>

    <input
        type="text"
        id="nisn"
        name="nisn"
        maxlength="10"
        inputmode="numeric"
        placeholder="Masukkan 10 digit NISN"
        value="<?= htmlspecialchars($nisn) ?>"
        autofocus
    >

    <br><br>

    <button type="submit">Tap Kartu</button>

</form>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
