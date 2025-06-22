<?php
require_once '../koneksi.php';
session_start();

$id = $_GET['id'] ?? null;
if ($id) {
    $sql = "DELETE FROM priorities WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
}

header("Location: kelola_prioritas.php");
exit;