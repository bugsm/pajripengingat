<?php
$pdo = new PDO("mysql:host=localhost;dbname=pajri_reminder", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>