<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include '../koneksi.php';

if (!isset($_SESSION['user'])) {
    exit;
}

// Pastikan data ID tugas dikirim
if (isset($_POST['id']) && !empty($_POST['id'])) {
    $stmt = $pdo->prepare("UPDATE tasks SET 
        title = ?, 
        description = ?, 
        category_id = ?, 
        priority_id = ?,  
        due_date = ?, 
        user_id = ?,
        status_id = 1
        WHERE id = ?");
        
    $stmt->execute([
        $_POST['title'],
        $_POST['description'],
        $_POST['category_id'],
        $_POST['priority_id'],
        $_POST['due_date'],
        $_POST['user_id'],
        $_POST['id']
    ]);
}

header("Location: dashboard.php");
exit;
?>
