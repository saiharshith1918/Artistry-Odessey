<?php
include("connection.php");
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: home.php');
    exit;
}

try {
    $stmt = $pdo->prepare("SELECT name, email, profile_pic, cover_image, bio FROM sign_up WHERE id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
    exit;
}

if (!$user) {
    echo "User data not found!";
    exit;
}

// Assume $user is fetched as shown in your script
$uploadDir = '/Applications/XAMPP/htdocs/mini project/uploads/';  // Server path
$webDir = 'uploads/';  // Web path

// Profile Picture
$profilePicPath = 'images/camera1.png'; // Default
if (!empty($user['profile_pic']) && file_exists($uploadDir . $user['profile_pic'])) {
    $profilePicPath = $webDir . $user['profile_pic'];
}

// Cover Image
$coverImagePath = 'images/cover_profile.jpeg'; // Default
if (!empty($user['cover_image']) && file_exists($uploadDir . $user['cover_image'])) {
    $coverImagePath = $webDir . $user['cover_image'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $uploadDir = '/Applications/XAMPP/htdocs/mini project/uploads/'; // Ensure there is a trailing slash
  //echo "Upload path: $uploadDir"; // Check if the path is correct

    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $updateData = [];
    foreach (['profile_pic', 'cover_image'] as $field) {
        if (isset($_FILES[$field]) && $_FILES[$field]['error'] == UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES[$field]['tmp_name'];
            $fileName = time() . '_' . basename($_FILES[$field]['name']);
            $targetFilePath = $uploadDir . $fileName;
    
            if (move_uploaded_file($fileTmpPath, $targetFilePath)) {
                $updateData[$field] = $fileName; // Store only the filename or relative path
            }
        }
    }
     
    if (!empty($updateData)) {
        $sqlParts = [];
        $params = [];
        foreach ($updateData as $key => $value) {
            $sqlParts[] = "$key = ?";
            $params[] = $value;
        }
        $params[] = $_SESSION['user_id'];
        $sql = "UPDATE sign_up SET " . implode(', ', $sqlParts) . " WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute($params)) {
           // echo "Profile updated successfully.";
            /*echo "Debug - Full Path Check for Profile Pic: " . $uploadDir . $user['profile_pic'] . "<br>";
echo "Debug - Full Path Check for Cover Image: " . $uploadDir . $user['cover_image'] . "<br>";?*/

        } else {
            echo "Error updating profile.";
        }
    }
}
?>
<?php
// Inside the PHP block at the beginning of your file
try {
    $postsStmt = $pdo->prepare("SELECT * FROM posts WHERE user_id = ? ORDER BY created_at DESC");
    $postsStmt->execute([$_SESSION['user_id']]);
    $posts = $postsStmt->fetchAll(PDO::FETCH_ASSOC);
    $postCount = count($posts);  
} catch (PDOException $e) {
    echo "Error fetching posts: " . $e->getMessage();
    $postCount = 0;
}
?>
<?php
try {
    $reelsStmt = $pdo->prepare("SELECT * FROM posts WHERE user_id = ? AND media_type = 'video' ORDER BY created_at DESC");
    $reelsStmt->execute([$_SESSION['user_id']]);
    $reels = $reelsStmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error fetching reels: " . $e->getMessage();
}
?>
<?php
try {
    $aboutStmt = $pdo->prepare("SELECT about_text FROM about_details WHERE user_id = ?");
    $aboutStmt->execute([$_SESSION['user_id']]);
    $about = $aboutStmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error fetching about details: " . $e->getMessage();
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Social Media Website  Design</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

</head>
<style>
    .profile-tabs button {
    padding: 10px;
    border: none;
    background-color: white;
    cursor: pointer;
    outline: none;
    font-size: 20px;
}

.tab-button {
    padding: 10px 20px;
    cursor: pointer;
    border: none;
    background: none;
    outline: none;
    position: relative;
}

.tab-button.active {
    color: black /* Change the text color to orange for the active tab */
}

.tab-button.active::before {
    content: '';
    position: absolute;
    left: 0;
    right: 0;
    top: 0;
    height: 4px;
    background-color: orange; /* Set the color of the line */
    border-radius: 2px;
}

.tab-content {
    display: none;
    padding: 20px;
    border: 1px solid #ccc;
    border-top: none;
}
.profile-tabs {
    display: flex;
    justify-content: space-evenly;
    margin-bottom: 20px;
}
.social-stats {
    display: flex;
    list-style: none;
    padding: 0;
    justify-content: space-evenly;
    margin-top: 10px;
}

.social-stats li {
    text-align: center;
}



.background-image {
    width: 100%;
    height: 200px; // Or set a specific height
}

.edit-icon {
    position: absolute;
    top: 80px;
    left: 90px; // Position in the top-left corner
    cursor: pointer;
    background-color: rgba(0, 0, 0, 0); // Semi-transparent black
    border-radius: 50%;
    padding: 5px;
}


/* Modal base styles */
.modal {
    display: none; /* Hidden by default */
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0,0,0,0.5);
}

.modal-content {
    position: relative;
    background-color: #fefefe;
    margin: 10% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 50%; /* Adjust as necessary */
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);
}

/* Close button */
.close-btn {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close-btn:hover,
.close-btn:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}
.submit-btn {
    background-color: #4CAF50; /* Green background */
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    transition: background-color 0.3s;
}

.submit-btn:hover {
    background-color: #367c39; /* Darker shade of green on hover */
}
.submit-btn:focus {
    outline: none;
    box-shadow: 0 0 0 3px rgba(70, 158, 85, 0.4); /* Add a focus ring */
}
.add-post-container {
    position: relative; /* Ensure positioning context for the icon */
    width: 100%; /* Example width, adjust as needed */
    height: 50px; /* Example height, adjust as needed */
}

.edit-post-icon {
    cursor: pointer;
    position: absolute;
    right: 10px; /* Adjust based on layout, 10px from the right */
    top: 50%; /* Center vertically */
    transform: translateY(-50%); /* Align center vertically */
    font-size: 24px; /* Icon size */
    color: #4CAF50; /* Icon color, adjust as needed */
}

.edit-about-icon {
    cursor: pointer;
    position: absolute;
    right: 10px; /* Adjust based on layout, 10px from the right */
    top: 50%; /* Center vertically */
    transform: translateY(-50%); /* Align center vertically */
    font-size: 24px; /* Icon size */
    color: #4CAF50; /* Icon color, adjust as needed */
}

.edit-bio-icon {
    cursor: pointer;
    position: absolute;
    right: 10px; /* Adjust based on layout, 10px from the right */
    top: 50%; /* Center vertically */
    transform: translateY(-50%); /* Align center vertically */
    font-size: 24px; /* Icon size */
    color: #4CAF50; /* Icon color, adjust as needed */
}

textarea {
    width: 100%;
    height: 100px;
    padding: 10px;
    margin-top: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

input[type="file"] {
    margin-top: 10px;
}

.posts-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr); /* Creates three columns */
    gap: 16px; /* Space between grid items */
    padding: 20px; /* Padding around the grid */
}

.post-item {
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 10px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

.reels-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr); // Three columns
    gap: 16px; // Space between grid items
    padding: 20px; // Padding around the grid
}

.reel-item {
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 10px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    position: relative; // For potential overlays or icons
    overflow: hidden; // In case of overflow issues
}

    </style>
<body>
<nav class="navbar">
        <div class="navbar-left">
            <a href="index.php" class="logo"><img src="images/logo.jpeg" alt=""></a>

            <div class="search-box">
                <img src="images/search.png" alt="">
                <input type="text" placeholder="Search">
            </div>
        </div>
        <div class="navbar-center">
            <ul>
                <li><a href="index.php" class="active-link"><img src="images/home.png" alt=""><span>Home</span></a></li>
                <li><a href="trending.php"><img src="images/trending.svg" alt=""><span>Treading</span></a></li>
                <li><a href="art.php"><img src="images/create.png" alt=""><span>create Art</span></a></li>
                <li><a href="#"><img src="images/reels.png" alt=""><span>Reels</span></a></li>
                <li><a href="products.php"><img src="images/jobs.png" alt=""><span>Product</span></a></li>
            </ul>
        </div>
        <div class="navbar-right">
            <div class="online">
            <?php if (!empty($profilePicPath)): ?>
        <img src="<?= htmlspecialchars($profilePicPath) ?>" alt="Profile Picture"  class="nav-profile-img" onclick="toggleMenu()">
    <?php endif; ?>
                <!--<img src="images/user-1.png" class="nav-profile-img" onclick="toggleMenu()">-->
                <span><?php echo htmlspecialchars($_SESSION['username']); ?></span>
            </div>
        </div>
     <!-- -------------------- profile -drop-down-menu----------------------- -->
     <div class="profile-menu-wrap" id="profileMenu">
        <div class="profile-menu">
            <div class="user-info">
            <?php if (!empty($profilePicPath)): ?>
        <img src="<?= htmlspecialchars($profilePicPath) ?>" alt="Profile Picture" class="profile-pic">
    <?php endif; ?>
                <div>
                    <h3><span><?php echo htmlspecialchars($_SESSION['username']); ?></span></h3>
                    <a href="profile.php"> See your profile</a>
                </div>
            </div>
            <hr>
            <a href="#" class="profile-menu-link">
                <img src="images/feedback.png">
                <p>Give Feedback</p>
                <span>></span>
            </a>

            <a href="#" class="profile-menu-link">
                <img src="images/setting.png">
                <p>Settings & Privacy</p>
                <span>></span>
            </a>

            <a href="#" class="profile-menu-link">
                <img src="images/help.png">
                <p>Help & Support</p>
                <span>></span>
            </a>
            <a href="#" class="profile-menu-link">
                <img src="images/display.png">
                <p>Display & Accessiblity</p>
                <span>></span>
            </a>

            <a href="#" class="profile-menu-link">
                <img src="images/logout.png">
                <p>Logout</p>
                <span>></span>
            </a>
        </div>
     </div>
    </nav>
    <!-- ------------ navbar close --------------- -->
   
<div class="container">
    <div class="profile-main">
    <div class="profile-container">
        <div class="background-image-container">
        <?php if (!empty($coverImagePath)): ?>
        <img src="<?= htmlspecialchars($coverImagePath) ?>" alt="Cover Image" class="background-image">
    <?php endif; ?>
            <div class="edit-icon" onclick="openModal();">
             <img src="images/camera.webp" alt="Edit Icon" style="width: 32px; height: 32px; border-radius: 50%;">
            </div>
        </div>
        <div id="myModal" class="modal">
            <div class="modal-content">
                <span class="close-btn" onclick="closeModal();">&times;</span>
                <div class="form-content">
                    <h2>Profile Images</h2>
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
                        <label for="cover_image">Cover Image</label>
                       <!--<input type="hidden" name="cover_image" value="1">-->
                        <div class="input-field">
                            <input type="file" name="cover_image" required>
                        </div>
                        <br>
                        <label for="profile_pic">Profile Picture</label>
                        <div class="input-field">
                            <input type="file" name="profile_pic" required>
                        </div><br>
                        <button type="submit" class="submit-btn">Submit</button>
                    </form>
                </div>
            </div> 
        </div>


        <div class="profile-container-inner">
        <?php if (!empty($profilePicPath)): ?>
        <img src="<?= htmlspecialchars($profilePicPath) ?>" alt="Profile Picture" class="profile-pic">
        <?php endif; ?>
        <div class="add-post-container">
         <i class="fas fa-pencil-alt edit-bio-icon" onclick="openBioEditModal();" title="Create Post"></i>
        </div>
        <!-- Bio Edit Modal -->
<div id="bioEditModal" class="modal">
    <div class="modal-content">
        <span class="close-btn" onclick="closeBioEditModal();">&times;</span>
        <h2>Edit Bio</h2>
        <form method="post" action="update_bio.php">
            <textarea name="bio_details" required placeholder="Enter your bio here..."></textarea>
            <button type="submit" class="submit-btn">Save Bio</button>
        </form>
    </div>
</div>

                <h1><?php echo htmlspecialchars($user['name']); ?></h1>
                    <p>Email: <?php echo htmlspecialchars($user['email']); ?></p>
                <!--<b>Web Developer at MicroSoft | Former Developer at DataStack and  Intern at Oracle</b>
                <p>San Francisco, United states.</p>-->
                <p><?= htmlspecialchars($user['bio']); ?></p> 
                <ul class="social-stats">
                    <li><strong><?php echo $postCount; ?></strong> Posts</li>
                    <li><strong>1.2K</strong> Following</li>
                    <li><strong>3.5K</strong> Followers</li>
                </ul>
                <!--<div class="mutual-connection">
                    img src="images/user-2.png" >
                    <span>1 mutual connection: Orlando Diggs</span>
                    <span> Post </span>
                    <span>Following</span>
                    <span>Followers</span>
                </div>-->
                <div class="profile-btn">
                    <a href="#" class="primary-btn"><img src="images/connect.png"> Follow</a>
                    <a href="#"><img src="images/chat.png"> Message</a>
                </div>
            </div>
     </div>
    <div class="profile-description">
        <div class="add-post-container">
         <i class="fas fa-pencil-alt edit-about-icon" onclick="openAboutEditModal();" title="Create Post"></i>
        </div>

        <div id="aboutEditModal" class="modal">
    <div class="modal-content">
        <span class="close-btn" onclick="closeAboutEditModal();">&times;</span>
        <h2>Edit About</h2>
        <form action="update_about.php" method="post">
            <textarea name="about_details" id="aboutEditor">The success of every website depends on...</textarea>
            <button type="submit" class="submit-btn">Save Changes</button>
        </form>
    </div>
</div>

            <h2>About</h2>
            
            <div id="aboutContent">
    <?php echo $about['about_text']; ?>
</div>
            <!--<p>The success of every websites depends on search engine optimisation and digital marketing strategy. If you are on first page of all major search engines then you 
                are ahead among your competitors on first page of all major search engines then you are ahead among your competitors
            </p>
            <a href="#" class="see-more-link">See more...</a>-->
    </div>
        <div class="profile-description">
        <!-- Add Post Button with Font Awesome Icon -->
        <div class="add-post-container">
        <i class="fas fa-pencil-alt edit-post-icon" onclick="openPostModal();" title="Create Post"></i>
        </div>

        <!-- Post Modal -->
<div id="postModal" class="modal">
    <div class="modal-content">
        <span class="close-btn" onclick="closePostModal();">&times;</span>
        <h2>Create Post</h2>
        <form method="post" action="submit_post.php" enctype="multipart/form-data">
            <label for="post_description">Description</label>
            <textarea name="post_description" required></textarea>

            <label for="post_media">Upload Media (Images, Videos, Audio)</label>
            <input type="file" name="post_media" accept="image/*,video/*,audio/*" multiple>

            <button type="submit" class="submit-btn">Submit Post</button>
        </form>
    </div>
</div>

            <div class="profile-tabs">
                <button class="tab-button" onclick="openTab(event, 'Posts')">Posts</button>
                <button class="tab-button" onclick="openTab(event, 'Reels')">Reels</button>
                <button class="tab-button" onclick="openTab(event, 'Buy')">Buy</button>
            </div>
            <div id="Posts" class="tab-content" style="display:none">
    <h2>Posts</h2>
    <div class="posts-grid">
        <?php foreach ($posts as $post): ?>
        <div class="post-item">
            <p><?= htmlspecialchars($post['description']) ?></p>
            <?php if (!empty($post['media_path'])): ?>
                <?php if ($post['media_type'] === 'image'): ?>
                    <img src="<?= 'uploads/' . htmlspecialchars($post['media_path']) ?>" alt="Post Image" style="width:100%;">
                <?php elseif ($post['media_type'] === 'video'): ?>
                    <video width="100%" controls>
                        <source src="<?= 'uploads/' . htmlspecialchars($post['media_path']) ?>" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                <?php endif; ?>
            <?php endif; ?>
        </div>
        <?php endforeach; ?>
    </div>
</div>


            <!-- Inside the Reels tab-content -->
  <div id="Reels" class="tab-content" style="display:none">
    <h2>Reels</h2>
    <div class="reels-grid">
        <?php foreach ($reels as $reel): ?>
        <div class="reel-item">
            <video controls width="100%">
                <source src="<?= 'uploads/' . htmlspecialchars($reel['media_path']) ?>" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
        <?php endforeach; ?>
    </div>
</div>

            <div id="Buy" class="tab-content" style="display:none">
                <h2>Buy</h2>
                <p>Explore products and services offered by Rayan Walton.</p>
            </div>
        </div>
    </div>

  <!--- -------------- profile-silder ---------------- -->

     <div class="profile-sidebar">

        
        <div class="sidebar-people">
            <h3>People you may Know</h3>
            <div class="sidebar-people-row">
                <img src="images/user-3.png">
                <div>
                    <h2>Sanjana</h2>
                    <p>Head of Dance culb at Alibaba</p>
                    <a href="#">Follow</a>
                </div>
            </div>

            <div class="sidebar-people-row">
                <img src="images/user-4.png">
                <div>
                    <h2>Sony</h2>
                    <p>Singer at Hyderabad</p>
                    <a href="#">Follow</a>
                </div>
            </div>

            <div class="sidebar-people-row">
                <img src="images/user-2.png">
                <div>
                    <h2>Sujan</h2>
                    <p>Drama Artist at Karimnagar</p>
                    <a href="#">Follow</a>
                </div>
            </div>

            <div class="sidebar-people-row">
                <img src="images/user-1.png">
                <div>
                    <h2>Geetha</h2>
                    <p>Dancer at Suryapet</p>
                    <a href="#">Follow</a>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="profile-footer">

    <div class="sidebar-useful-links">
        <a href="#">About</a>
        <a href="#">Accessiblity</a>
        <a href="#">Help Center</a>
        <a href="#">Privacy Policy</a>
        <a href="#">Advertising</a>
        <a href="#">Get the App</a>
        <a href="#">More</a>

     <div class="copyright-msg">
        <img src="images/logo.jpeg" alt="">
        <p>Sa kala &#169; 2024. All right reserved</p>
     </div>
    </div>

</div>

<script>

    let profileMenu = document.getElementById("profileMenu");

    function toggleMenu(){
        profileMenu.classList.toggle("open-menu");
    }


    function openTab(evt, tabName) {
    var i, tabcontent, tabbuttons;
    tabcontent = document.getElementsByClassName("tab-content");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tabbuttons = document.getElementsByClassName("tab-button");
    for (i = 0; i < tabbuttons.length; i++) {
        tabbuttons[i].className = tabbuttons[i].className.replace(" active", "");
    }
    document.getElementById(tabName).style.display = "block";
    evt.currentTarget.className += " active";
}

</script>

<script>


function uploadBackground(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            document.querySelector('.profile-container').style.backgroundImage = 'url(' + e.target.result + ')';
        };
        reader.readAsDataURL(input.files[0]);
    }
}


function uploadCoverImage(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            document.querySelector('.background-image').src = e.target.result;
        };
        reader.readAsDataURL(input.files[0]);
    }
}

function uploadProfileImage(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            document.querySelector('.profile-pic').src = e.target.result;
        };
        reader.readAsDataURL(input.files[0]);

        // Optionally, submit a form or use AJAX to save the image to the server
        // document.getElementById('profileForm').submit();
    }
}
</script>

<script>
function openModal() {
    document.getElementById("myModal").style.display = "block";
}

function closeModal() {
    document.getElementById("myModal").style.display = "none";
}

// Optional: Close the modal if the user clicks outside of it
window.onclick = function(event) {
    if (event.target == document.getElementById("myModal")) {
        closeModal();
    }
}


function openPostModal() {
    document.getElementById('postModal').style.display = 'block';
}

function closePostModal() {
    document.getElementById('postModal').style.display = 'none';
}

window.onclick = function(event) {
    if (event.target == document.getElementById('postModal')) {
        closePostModal();
    }
}


function openAboutEditModal() {
    document.getElementById('aboutEditModal').style.display = 'block';
    CKEDITOR.replace('aboutEditor');
}

function closeAboutEditModal() {
    document.getElementById('aboutEditModal').style.display = 'none';
    if (CKEDITOR.instances.aboutEditor) {
        CKEDITOR.instances.aboutEditor.destroy();
    }
}


function openBioEditModal() {
    document.getElementById('bioEditModal').style.display = 'block';
}

function closeBioEditModal() {
    document.getElementById('bioEditModal').style.display = 'none';
}

// Optional: Close the modal if the user clicks outside of it
window.onclick = function(event) {
    if (event.target == document.getElementById('bioEditModal')) {
        closeBioEditModal();
    }
}

</script>
<script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>

</body>
</html> 