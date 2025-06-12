<?php
session_start();
if (isset($_SESSION['user'])) header("Location: dashboard.php");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
<div class="container">
    <h3>Login</h3>
    <form method="POST" action="auth.php">
        <input type="text" name="username" class="form-control mb-2" placeholder="Username" required>
        <input type="password" name="password" class="form-control mb-2" placeholder="Password" required>
        <button class="btn btn-primary">Login</button>
        <a href="register.php" class="btn btn-link">Daftar</a>
    </form>
</div>
</body>
</html>