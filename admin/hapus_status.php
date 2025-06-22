<?php
require_once '../koneksi.php';
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: ../index.php");
    exit;
}

$id = $_GET['id'] ?? null;

if ($id) {

    $sql = "DELETE FROM statuses WHERE id = ?";
    $stmt = $pdo->prepare($sql);

    $stmt->execute([$id]);
}

header("Location: kelola_status.php");
exit(); 