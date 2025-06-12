<?php
include 'koneksi.php';
$stmt = $pdo->prepare("INSERT INTO tasks(title, description, category_id, priority_id, status_id, due_date, user_id)
VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->execute([
    $_POST['title'], $_POST['description'], $_POST['category_id'], $_POST['priority_id'],
    $_POST['status_id'], $_POST['due_date'], $_POST['user_id']
]);
header("Location: dashboard.php");
?>