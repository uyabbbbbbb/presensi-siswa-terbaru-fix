<?php
session_start();

require_once __DIR__ . '/config/Database.php';

if (isset($_SESSION['id_user'])) {
    header("Location: index.php");
    exit;
}

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    $db = new Database();
    $pdo = $db->connect();

    $stmt = $pdo->prepare(
        "SELECT * FROM users WHERE username = ?"
    );
    $stmt->execute([$username]);

    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        session_regenerate_id(true);

        $_SESSION['id_user'] = $user['id_user'];
        $_SESSION['username'] = $user['username'];

        header("Location: index.php");
        exit;
    } else {
        $error = "Username atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Presensi Siswa</title>
    <link rel="stylesheet" href="/presensi-siswa-main/assets/css/style.css?v=30">
</head>
<body>
    <h2>Login Administrator</h2>

    <?php if ($error): ?>
        <p style="color:red;">
            <?= htmlspecialchars($error) ?>
        </p>
    <?php endif; ?>

    <form method="POST">
        <label>Username:</label>
        <input type="text" name="username" required>

        <br><br>

        <label>Password:</label>
        <input type="password" name="password" required>

        <br><br>

        <button type="submit">Login</button>
    </form>
</body>
</html>
