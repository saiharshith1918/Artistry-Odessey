<?php
include("connection.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $description = $_POST['post_description'];
    $file = $_FILES['post_media'];

    if ($file['error'] == 0) {
        $uploadDir = '/Applications/XAMPP/htdocs/mini project/uploads/';
        $fileName = time() . '_' . basename($file['name']);
        $targetFilePath = $uploadDir . $fileName;

        // Determine file type and set the directory accordingly
        $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
        if (in_array($fileType, ['jpg', 'png', 'jpeg', 'gif', 'avif'])) {
            $mediaType = 'image';
        } elseif (in_array($fileType, ['mp4', 'avi', 'mov'])) {
            $mediaType = 'video';
        } elseif (in_array($fileType, ['mp3', 'wav'])) {
            $mediaType = 'audio';
        } else {
            echo "Invalid file type.";
            exit;
        }

        if (move_uploaded_file($file['tmp_name'], $targetFilePath)) {
            // SQL to insert post data into your database
            $stmt = $pdo->prepare("INSERT INTO posts (user_id, description, media_path, media_type) VALUES (?, ?, ?, ?)");
            $stmt->execute([$_SESSION['user_id'], $description, $fileName, $mediaType]);
            echo "Post created successfully!";
        } else {
            echo "Error uploading file.";
        }
    } else {
        echo "Error in file upload.";
    }
}
?>