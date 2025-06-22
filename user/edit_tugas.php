<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include '../koneksi.php';

if (!isset($_SESSION['user']))
    exit;

$id = $_GET['id'];
$tugas = $pdo->query("SELECT * FROM tasks WHERE id = $id")->fetch();
$categories = $pdo->query("SELECT * FROM categories")->fetchAll();
$priorities = $pdo->query("SELECT * FROM priorities")->fetchAll();
$statuses = $pdo->query("SELECT * FROM statuses")->fetchAll();
?>

<form method="POST" action="update_tugas.php">
    <input type="hidden" name="id" value="<?= $tugas['id'] ?>">
    <input type="hidden" name="user_id" value="<?= $tugas['user_id'] ?>">

    <input type="text" name="title" value="<?= htmlspecialchars($tugas['title']) ?>" class="form-control mb-2"
        placeholder="Judul" required>
    <textarea name="description" class="form-control mb-2"
        placeholder="Deskripsi"><?= htmlspecialchars($tugas['description']) ?></textarea>

    <select name="category_id" class="form-control mb-2">
        <?php foreach ($categories as $c): ?>
            <option value="<?= $c['id'] ?>" <?= $c['id'] == $tugas['category_id'] ? 'selected' : '' ?>><?= $c['name'] ?>
            </option>
        <?php endforeach; ?>
    </select>

    <select name="priority_id" class="form-control mb-2">
        <?php foreach ($priorities as $p): ?>
            <option value="<?= $p['id'] ?>" <?= $p['id'] == $tugas['priority_id'] ? 'selected' : '' ?>><?= $p['level'] ?>
            </option>
        <?php endforeach; ?>
    </select>

    <input type="date" name="due_date" value="<?= $tugas['due_date'] ?>" class="form-control mb-2">

    <button class="btn btn-success">Update</button>
</form>