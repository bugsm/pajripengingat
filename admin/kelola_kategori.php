<?php
require_once '../koneksi.php';
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../index.php");
    exit;
}

$stmt = $pdo->query("SELECT * FROM categories ORDER BY name ASC");
$categories = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Admin - Kelola Kategori</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .content-container { margin-top: 77px; }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>

    <div class="container content-container">
        <div class="row align-items-center mb-3">
            <div class="col-md-6">
                <h3 class="mb-0">Kelola Kategori</h3>
            </div>
            <div class="col-md-6 text-md-end text-start mt-2 mt-md-0">
                <a href="tambah_kategori.php" class="btn btn-success">+ Tambah Kategori</a>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col" style="width: 10%;">ID</th>
                            <th scope="col">Nama Kategori</th>
                            <th scope="col" style="width: 20%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($categories as $category): ?>
                            <tr>
                                <td><?= htmlspecialchars($category['id']) ?></td>
                                <td><?= htmlspecialchars($category['name']) ?></td>
                                <td>
                                    <a href="edit_kategori.php?id=<?= $category['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                    <a href="hapus_kategori.php?id=<?= $category['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus kategori ini? Ini bisa mempengaruhi data tugas yang ada.')">Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>
</body>
</html>