<?php
include("connection.php");
session_start();  // Start the session at the beginning of the script

if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if the user is not logged in
    header('Location: home.php');
    exit;
}
try {
  $stmt = $pdo->prepare("SELECT name, email, profile_pic, cover_image FROM sign_up WHERE id = ?");
  $stmt->execute([$_SESSION['user_id']]);
  $user = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  echo "Database error: " . $e->getMessage();
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
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="css/trending1.css" />
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>

  <nav class="navbar">
        <div class="navbar-left">
            <a href="index.php" class="logo"><img src="images/1.png" alt=""></a>

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
                <li><a href="#"><img src="images/reels.png" alt=""><span>reels</span></a></li>
                <li><a href="products.php"><img src="images/jobs.png" alt=""><span>Product</span></a></li>
            </ul>
        </div>
        <div class="navbar-right">
            <div class="online">
            <?php if (!empty($profilePicPath)): ?>
        <img src="<?= htmlspecialchars($profilePicPath) ?>" alt="Profile Picture" class="nav-profile-img" onclick="toggleMenu()">
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
                <!--<img src="images/user-1.png" >-->
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


    <div class="stories-container">
      <div class="content">
        <div class="previous-btn">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke-width="1.5"
            stroke="currentColor"
            class="w-6 h-6"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              d="M15.75 19.5L8.25 12l7.5-7.5"
            />
          </svg>
        </div>

        <div class="stories"></div>

        <div class="next-btn active">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke-width="1.5"
            stroke="currentColor"
            class="w-6 h-6"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              d="M8.25 4.5l7.5 7.5-7.5 7.5"
            />
          </svg>
        </div>
      </div>
    </div>

    <div class="stories-full-view">
      <div class="close-btn">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 24 24"
          stroke-width="1.5"
          stroke="currentColor"
          class="w-6 h-6"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M6 18L18 6M6 6l12 12"
          />
        </svg>
      </div>

      <div class="content">
        <div class="previous-btn">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke-width="1.5"
            stroke="currentColor"
            class="w-6 h-6"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              d="M15.75 19.5L8.25 12l7.5-7.5"
            />
          </svg>
        </div>

        <div class="story">
          <img src="1.jpg" alt="" />
          <div class="author">Author</div>
        </div>

        <div class="next-btn">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke-width="1.5"
            stroke="currentColor"
            class="w-6 h-6"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              d="M8.25 4.5l7.5 7.5-7.5 7.5"
            />
          </svg>
        </div>
      </div>
    </div>


    <div class="trending-today">
    <h2>Trending Today</h2>
    <div id="date-time-display"></div>
    <ul class="trending-topics">
        <li>Climate Change and Renewable Energy</li>
        <li>Advances in Artificial Intelligence</li>
        <li>Global Economic Trends</li>
        <li>Health Innovations Post-Pandemic</li>
        <li>Space Exploration: Mars Missions</li>
    </ul>
</div>
<div class="social-media-post">
    <div class="post-header">
        <img src="images/1.jpg" alt="Profile Picture" class="profile-pic">
        <div class="user-details">
            <strong>Username</strong>
            <span>Posted on July 1, 2024</span>
        </div>
    </div>
    <div class="post-content">
        <img src="images/2.jpg" alt="Post Content Image" class="content-image">
        <p>This is an example of a social media post. Users can like, dislike, comment, and share this post.</p>
    </div>
    <div class="post-actions">
        <button class="like-button"><img src="images/like.png" alt="Like Icon" class="action-icon"> Like</button>
        <button class="dislike-button"><img src="dislike_icon.svg" alt="Dislike Icon" class="action-icon"> Dislike</button>
        <button class="comment-button"><img src="comment_icon.svg" alt="Comment Icon" class="action-icon"> Comment</button>
        <button class="share-button"><img src="share_icon.svg" alt="Share Icon" class="action-icon"> Share</button>
    </div>
    <div class="post-comments">
        <input type="text" placeholder="Add a comment..." class="comment-input">
    </div>
</div>


    <script>
      function toggleMenu() {
    var menu = document.getElementById('profileMenu');
    if (menu.style.display === 'block') {
        menu.style.display = 'none';
    } else {
        menu.style.display = 'block';
    }
}
document.querySelector('.like-button').addEventListener('click', function() {
    this.classList.toggle('liked');
    if (this.classList.contains('liked')) {
        this.textContent = 'Liked';
    } else {
        this.textContent = 'Like';
    }
});


    </script>
<script>

let profileMenu = document.getElementById("profileMenu");

function toggleMenu(){
    profileMenu.classList.toggle("open-menu");
}
</script>

    <script src="script/main1.js"></script>
  </body>
</html>
