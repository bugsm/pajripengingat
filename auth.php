<?php
session_start();
include 'koneksi.php';
$username = $_POST['username'];
$password = $_POST['password'];

$stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
$stmt->execute([$username]);
$user = $stmt->fetch();

if ($user && password_verify($password, $user['password'])) {
    if ($user['role'] === 'admin') {
        $_SESSION['admin'] = $user;
        header("Location: admin/index.php");
    } elseif ($user['role'] === 'user') {
        $_SESSION['user'] = $user;
        header("Location: dashboard.php");
    } else {
        echo "<script>alert('Role tidak valid');window.location='index.php';</script>";
    }
} else {
    echo "<script>alert('Login gagal');window.location='index.php';</script>";
}
?>
