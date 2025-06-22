<?php
require_once '../koneksi.php';
session_start();
// ... (logika session dan GET id sama)
if (!isset($_SESSION['admin'])) {
    header("Location: ../index.php");
    exit;
}

$id = $_GET['id'] ?? null;
if (!$id) {
    // Jika tidak ada ID, redirect ke halaman utama untuk menghindari error
    header("Location: kelola_prioritas.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $level = $_POST['level'];
    $id = $_POST['id'];
    $sql = "UPDATE priorities SET level = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$level, $id]);
    header("Location: kelola_prioritas.php");
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM priorities WHERE id = ?");
$stmt->execute([$id]);
$priority = $stmt->fetch();

// Jika data dengan ID tersebut tidak ditemukan, redirect juga
if (!$priority) {
    header("Location: kelola_prioritas.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Prioritas</title>
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
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Edit Prioritas</h4>
                    </div>
                    <div class="card-body">
                        <form method="post">
                            <input type="hidden" name="id" value="<?= $priority['id'] ?>">
                            <div class="mb-3">
                                <label for="level" class="form-label">Level Prioritas</label>
                                <input type="text" class="form-control" id="level" name="level"
                                    value="<?= htmlspecialchars($priority['level']) ?>" required>
                            </div>
                            <div class="d-flex justify-content-end">
                                <a href="kelola_prioritas.php" class="btn btn-secondary me-2">Batal</a>
                                <button type="submit" class="btn btn-primary">Update</button>
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