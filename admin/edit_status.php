<?php
require_once '../koneksi.php';
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../index.php");
    exit;
}

$id = $_GET['id'] ?? null;
if (!$id) {
    // Jika tidak ada ID, redirect ke halaman utama untuk menghindari error
    header("Location: kelola_status.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sesuaikan dengan kolom 'name' pada tabel statuses
    $name = $_POST['name'];
    $id = $_POST['id'];
    $sql = "UPDATE statuses SET name = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$name, $id]);
    header("Location: kelola_status.php");
    exit;
}

// Mengambil data dari tabel statuses
$stmt = $pdo->prepare("SELECT * FROM statuses WHERE id = ?");
$stmt->execute([$id]);
$status = $stmt->fetch();

// Jika data dengan ID tersebut tidak ditemukan, redirect
if (!$status) {
    header("Location: kelola_status.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Status</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .content-container {
            margin-top: 80px;
        }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>
    
    <div class="container content-container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <h4 class="mb-0">Edit Status</h4>
                    </div>
                    <div class="card-body">
                        <form method="post">
                            <input type="hidden" name="id" value="<?= $status['id'] ?>">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama Status</label>
                                <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($status['name']) ?>" required>
                            </div>
                            <div class="d-flex justify-content-end">
                                <a href="kelola_status.php" class="btn btn-secondary me-2">Batal</a>
                                <button type="submit" class="btn btn-success">Update</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>