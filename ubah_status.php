<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['user']) || !isset($_POST['id'], $_POST['status_id'])) {
    header("Location: dashboard.php");
    exit;
}

$id = $_POST['id'];
$status_id = $_POST['status_id'];

$stmt = $pdo->prepare("UPDATE tasks SET status_id = ? WHERE id = ? AND user_id = ?");
$stmt->execute([$status_id, $id, $_SESSION['user']['id']]);

header("Location: dashboard.php");
