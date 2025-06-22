<?php
session_start();
include '../koneksi.php';
$username = $_POST['username'];
$password = $_POST['password'];

$stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
$stmt->execute([$username]);
$user = $stmt->fetch();

if ($user && password_verify($password, $user['password'])) {
    if ($user['role'] === 'user') {
        $_SESSION['user'] = $user;
        header("Location: dashboard.php");
    } else {
        echo "<script>alert('Akun tidak tersedia');window.location='login.php';</script>";
    }
} else {
    echo "<script>alert('Password dan username tidak valid');window.location='login.php';</script>";
}
