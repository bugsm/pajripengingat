<?php
require_once '../koneksi.php';
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../index.php");
    exit;
}

$stmt = $pdo->query("SELECT * FROM priorities ORDER BY id");
$priorities = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Admin - Kelola Prioritas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .content-container {
            margin-top: 77px;
        }
    </style>
</head>

<body>
    <?php include 'header.php'; ?>

    <div class="container content-container">
        <div class="row align-items-center mb-3">
            <div class="col-md-6">
                <h3 class="mb-0">Kelola Prioritas</h3>
            </div>
            <div class="col-md-6 text-md-end"><a href="tambah_prioritas.php" class="btn btn-success">+ Tambah
                    Prioritas</a></div>
        </div>

        <div class="card">
            <div class="card-body">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col" style="width: 10%;">ID</th>
                            <th scope="col">Level Prioritas</th>
                            <th scope="col" style="width: 20%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($priorities as $priority): ?>
                            <tr>
                                <td><?= htmlspecialchars($priority['id']) ?></td>
                                <td><?= htmlspecialchars($priority['level']) ?></td>
                                <td>
                                    <a href="edit_prioritas.php?id=<?= $priority['id'] ?>"
                                        class="btn btn-warning btn-sm">Edit</a>
                                    <a href="hapus_prioritas.php?id=<?= $priority['id'] ?>" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Hapus prioritas ini?')">Hapus</a>
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