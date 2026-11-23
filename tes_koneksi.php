<?php

require_once "config/Database.php";

try {
    $database = new Database();
    $koneksi = $database->connect();

    echo "Koneksi database berhasil!";

} catch (Exception $e) {
    echo "Koneksi database gagal.";
}
