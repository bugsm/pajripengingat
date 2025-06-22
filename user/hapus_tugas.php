<?php
include '../koneksi.php';
$pdo->prepare("DELETE FROM tasks WHERE id = ?")->execute([$_GET['id']]);
header("Location: dashboard.php");
?>