<?php
session_start();
require('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['user_id'])) {
    $bio_details = $_POST['bio_details'];
    $user_id = $_SESSION['user_id'];

    try {
        $stmt = $pdo->prepare("UPDATE sign_up SET bio = ? WHERE id = ?");
        $stmt->execute([$bio_details, $user_id]);
        echo "Bio updated successfully.";
    } catch (PDOException $e) {
        echo "Database error: " . $e->getMessage();
    }
}
?>
