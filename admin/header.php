<?php
if (!isset($_SESSION)) session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel - Pajri Reminder</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f7ff;
            font-family: 'Segoe UI', sans-serif;
        }
        .navbar-brand {
            font-weight: bold;
            font-size: 1.1rem;
        }
        .nav-link {
            color: white !important;
            margin-right: 10px;
        }
        .nav-link.active {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand navbar-dark bg-primary px-4">
    <div class="ms-auto d-flex align-items-center">
        <span class="text-white me-3"><?= $_SESSION['admin']['username']; ?></span>
        <a href="../logout.php" class="btn btn-outline-light btn-sm">Logout</a>
    </div>
</nav>

<div class="container mt-4">
