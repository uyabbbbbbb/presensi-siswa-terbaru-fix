<?php

require_once __DIR__ . '/config/Database.php';

$username = "adamidun";
$password = password_hash("giwirgiwir", PASSWORD_DEFAULT);

try {
    $db = new Database();
    $pdo = $db->connect();

    $sql = "INSERT INTO users (username, password)
            VALUES (:username, :password)";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        'username' => $username,
        'password' => $password
    ]);

    echo "Akun anda berhasil dibuat!";

} catch (PDOException $e) {
    echo "Akun gagal dibuat: " . $e->getMessage();
}