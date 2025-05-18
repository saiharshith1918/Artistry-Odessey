<?php
session_start();
include("connection.php");

if (!isset($_SESSION['user_id'])) {
    header('Location: home.php');
    exit;
}

if (isset($_POST['update_profile'])) {
    // Handle the profile picture upload
    if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] == UPLOAD_ERR_OK) {
        $profilePic = $_FILES['profile_pic'];
        $profilePicPath = 'uploads/' . $profilePic['name'];
        move_uploaded_file($profilePic['tmp_name'], $profilePicPath);
        
        // Update the profile picture path in the database
        $stmt = $pdo->prepare("UPDATE sign_up SET profile_pic = ? WHERE id = ?");
        $stmt->execute([$profilePicPath, $_SESSION['user_id']]);
    }

    // Handle the background image upload
    if (isset($_FILES['background_pic']) && $_FILES['background_pic']['error'] == UPLOAD_ERR_OK) {
        $backgroundPic = $_FILES['background_pic'];
        $backgroundPicPath = 'uploads/' . $backgroundPic['name'];
        move_uploaded_file($backgroundPic['tmp_name'], $backgroundPicPath);
        
        // Update the background image path in the database
        $stmt = $pdo->prepare("UPDATE sign_up SET background_pic = ? WHERE id = ?");
        $stmt->execute([$backgroundPicPath, $_SESSION['user_id']]);
    }

    header('Location: profile.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tooplate's Little Fashion - Extended Products</title>
    </head>
<body>
<form method="post" action="profile_update.php" enctype="multipart/form-data">
    <h3>Edit Profile</h3>
    <label>Change profile picture:</label>
    <input type="file" name="profile_pic" accept="image/*">
    <br>
    <label>Change background image:</label>
    <input type="file" name="background_pic" accept="image/*">
    <br>
    <button type="submit" name="update_profile">Update Profile</button>
</form>

</body>
    </html>
