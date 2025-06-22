<?php
require_once '../koneksi.php';
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $sql = "INSERT INTO statuses (name) VALUES (?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$name]);
    header("Location: kelola_status.php"); 
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Status Baru</title>
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
                        <h4 class="mb-0">Tambah Status Baru</h4>
                    </div>
                    <div class="card-body">
                        <form method="post">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama Status</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Contoh: Selesai, Belum Selesai" required>
                            </div>
                            <div class="d-flex justify-content-end">
                                <a href="kelola_status.php" class="btn btn-secondary me-2">Batal</a>
                                <button type="submit" class="btn btn-success">Simpan</button>
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