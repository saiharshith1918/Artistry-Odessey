<?php
session_start();
include("connection.php");

if (!isset($_SESSION['user_id'])) {
    header('Location: home.php');
    exit();
}

// Fetch user details
$userId = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT * FROM sign_up WHERE id = ?");
$stmt->execute([$userId]);
$user = $stmt->fetch();

if (!$user) {
    echo "<script>alert('User not found.'); window.location.href = 'home.php';</script>";
    exit;
}
?>
