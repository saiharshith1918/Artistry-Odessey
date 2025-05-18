<?php
include("connection.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['about_details'])) {
    $about_details = $_POST['about_details'];  // Sanitization needed
    $user_id = $_SESSION['user_id'];

    try {
        $stmt = $pdo->prepare("INSERT INTO about_details (user_id, about_text) VALUES (?, ?) ON CONFLICT (user_id) DO UPDATE SET about_text = EXCLUDED.about_text, last_updated = CURRENT_TIMESTAMP");
        $stmt->execute([$user_id, $about_details]);
        echo "About details updated successfully.";
    } catch (PDOException $e) {
        echo "Error updating About details: " . $e->getMessage();
    }
} else {
    echo "No data submitted.";
}
?>
