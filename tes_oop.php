<?php

require_once __DIR__ . '/models/Kelas.php';
require_once __DIR__ . '/models/Siswa.php';
require_once __DIR__ . '/models/Presensi.php';

$kelas = new Kelas();
$siswa = new Siswa();
$presensi = new Presensi();

echo "<h2>Data Kelas</h2>";
echo "<pre>";
print_r($kelas->getAll());
echo "</pre>";

echo "<h2>Data Siswa</h2>";
echo "<pre>";
print_r($siswa->getAll());
echo "</pre>";

echo "<h2>Data Presensi</h2>";
echo "<pre>";
print_r($presensi->getAll());
echo "</pre>";
