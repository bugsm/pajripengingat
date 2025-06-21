<?php
if (!isset($_SESSION)) session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}
$user = $_SESSION['user'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>PajriReminder - Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background-color: #f4f7ff;
        }
        .col-status {
            width: 50px;
            text-align: center;
            vertical-align: middle !important;
        }
        .col-status form {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
            margin: 0;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function bukaModalEdit(id) {
            $('#editFormContent').load('edit_tugas.php?id=' + id, function () {
                var modal = new bootstrap.Modal(document.getElementById('modalEditTugas'));
                modal.show();
            });
        }
    </script>
</head>
<body>
    <nav class="navbar navbar-dark bg-primary px-4">
        <a class="navbar-brand text-white" href="dashboard.php"></a>
        <div class="ms-auto">
            <span class="text-white me-3"><?= htmlspecialchars($user['username']) ?></span>
            <a href="logout.php" class="btn btn-outline-light btn-sm">Logout</a>
        </div>
    </nav>
    <div class="container mt-4">
