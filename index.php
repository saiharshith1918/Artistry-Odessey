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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Social Media Website  Design</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/styles.css">
    <style>
        .grid-item .caption {
    font-weight: bold; /* Makes the text bold */
    color: black; /* Sets the text color to black */
}

    </style>
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
    <div class="container">

        <!-- -------left-sider-------------- -->
        <div class="left-sidebar">
        <div class="sidebar-profile-box">
        <?php if (!empty($coverImagePath)): ?>
        <img src="<?= htmlspecialchars($coverImagePath) ?>" width="100%" alt="Cover Image" class="background-image">
    <?php endif; ?>
            <!--<img src="images/cover-pic.png" width="100%" alt="">-->
            <div class="sidebar-profile-info">
            <?php if (!empty($profilePicPath)): ?>
        <img src="<?= htmlspecialchars($profilePicPath) ?>" alt="Profile Picture" class="profile-pic">
    <?php endif; ?>
                <!--<img src="images/user-1.png" alt="">-->
                <h1><span><?php echo htmlspecialchars($_SESSION['username']); ?></span></h1>
                <!--<h3>Web Developer at Microsoft</h3>
                <ul>
                    
                    <li>Your profile views <span>52</span></li>
                    <li>Your post views <span>810</span></li>
                    <li>Your connections <span>205</span></li>
                </ul>-->
            </div>
           <!-- <div class="sidebar-profile-link">
                <a href="#"><img src="images/items.png" alt="">My items</a>
                <a href="#"><img src="images/premium.png" alt="">Try Premium </a>
            </div>-->
        </div>
        <div class="sidebar-activity" id="sidebarActivity">
            <!-- Popular Products Grid -->
    <div class="popular-products">
        <h3>Popular Products</h3>
        <div class="product-grid">
            <div class="product-item">
                <img src="images/bulkcard.jpeg" alt="Product 1">
                <div class="details">
                    <p>BulkCard</p>
                    <p>150 rupees only</p>
                    <a href="#">Some brief details here.</a>
                </div> 
            </div>
            <div class="product-item">
                <img src="images/tabala.jpeg" alt="Product 2">
                <div class="details">
                    <p>Tabala</p>
                    <p>3600 rupees only</p>
                    <a href="#">Some brief details here.</a>
                </div>
            </div>
            <div class="product-item">
                <img src="images/Ankle Bells.jpeg" alt="Product 3">
                <div class="details">
                    <p>Kuchipudi Gajjalu</p>
                    <p>1500 rupees only</p>
                    <a href="#">Some brief details here.</a>
                </div>
            </div>
        </div>
    </div>

         
            <div class="discover-more-link">
                <a href="#">Discover more</a>
            </div>
        </div>
        
     <p id="showmorelink" onclick="toggleActivity()" >Show more <b>+</b></p>
        </div>
        <!-- ----------main-content----------- -->
        <div class="main-content">

            <div class="create-post">
                <div class="create-post-input">
                  <!--<img src="images/user-1.png" alt="">-->
                  <?php if (!empty($profilePicPath)): ?>
        <img src="<?= htmlspecialchars($profilePicPath) ?>" alt="">
    <?php endif; ?>
                  <textarea  rows="2" placeholder="Write a post"></textarea>
                </div>
                <div class="create-post-links">
                    <li><img src="images/photos.jepg.png" >Photo</li>
                    <li><img src="images/video.jpeg" alt="">video</li>
                    <li><img src="images/Events.png" alt="">Event</li>
                    <li>Post</li>
                </div>
            </div>
            <div class="sort-by">
                <hr>
                <p>Sort by: <span>top <img src="images/down-arrow.png"></span></p>
            </div>
            <div class="post">
                <div class="post-author">
                    <img src="images/Singing_ar.jpeg" >
                    <div>
                        <h1>A R Rahaman</h1>
                        <small>Indian music composer, record producer, singer, and philanthropist</small>
                        <small>2 hours ago</small>
                    </div>
                </div>
                <p> “Your best success comes after your greatest disapponitment.”</p>
                <img src="images/Singing_ar.jpeg" width="100%">

                <div class="post-stats">
                    <div>
                        <img src="images/thumbsup.png" >
                        <img src="images/love.png" >
                        <img src="images/clap.png" >
                        <span class="liked-users">Abhinav Mishra and 75 others</span>
                    </div>
                    <div>
                        <span>22 comments &middot; 40 shares</span>
                    </div>
                    
                </div>
                <div class="post-activity">
                    <div>
                    <?php if (!empty($profilePicPath)): ?>
        <img src="<?= htmlspecialchars($profilePicPath) ?>" alt="Profile Picture" class="post-activity-user-icon" class="profile-pic">
    <?php endif; ?>
                       <!-- <img src="images/user-1.png" class="post-activity-user-icon">-->
                        <img src="images/down-arrow.png" class="post-activity-arrow-icon">
                    </div>
                    <div class="post-activity-link">
                        <img src="images/like.png" >
                        <span>Like</span>
                    </div>

                    <div class="post-activity-link">
                        <img src="images/comment.png" >
                        <span>comment</span>
                    </div >

                    <div class="post-activity-link">
                        <img src="images/share.png" >
                        <span>Share</span>
                    </div>

                    <div class="post-activity-link">  
                        <img src="images/send.png" >
                        <span>Send</span>
                    </div>
                </div>
              
            </div>

            <div class="post">
                <div class="post-author">
                    <img src="images/sudhamurthy.png" >
                    <div>
                        <h1>Sudha Murthy</h1>
                        <small>Member of Parliament & Chairperson of Infosys Foundation
Children's writer</small>
                        <small>5 hours ago</small>
                    </div>
                </div>
                <p> Member of Parliament & Chairperson of Infosys Foundation
Children's writer</p>
                <img src="images/sudhamurthy.png" width="100%">

                <div class="post-stats">
                    <div>
                        <img src="images/thumbsup.png" >
                        <img src="images/love.png" >
                        <img src="images/clap.png" >
                        <span class="liked-users">kethan and 75 others</span>
                    </div>
                    <div>
                        <span>22 comments &middot; 40 shares</span>
                    </div>
                    
                </div>
                <div class="post-activity">
                    <div>
                        <img src="images/user-1.png" class="post-activity-user-icon">
                        <img src="images/down-arrow.png" class="post-activity-arrow-icon">
                    </div>
                    <div class="post-activity-link">
                        <img src="images/like.png" >
                        <span>Like</span>
                    </div>

                    <div class="post-activity-link">
                        <img src="images/comment.png" >
                        <span>comment</span>
                    </div >

                    <div class="post-activity-link">
                        <img src="images/share.png" >
                        <span>Share</span>
                    </div>

                    <div class="post-activity-link">  
                        <img src="images/send.png" >
                        <span>Send</span>
                    </div>
                </div>
              
            </div>

            <div class="post">
                <div class="post-author">
                    <img src="images/user-5.png" >
                    <div>
                        <h1>Benjamin Leo</h1>
                        <small>Founder and CEO at Gellelio Group | Angel Investor</small>
                        <small>2 hours ago</small>
                    </div>
                </div>
                <p> The success of every websites depends on search engine optimisation and digital marketing strategy. If you are on first page of all major search engines then you are ahead amoung your competitors.</p>
                <img src="images/pottery.jpg" width="100%">

                <div class="post-stats">
                    <div>
                        <img src="images/thumbsup.png" >
                        <img src="images/love.png" >
                        <img src="images/clap.png" >
                        <span class="liked-users">Abhinav Mishra and 75 others</span>
                    </div>
                    <div>
                        <span>22 comments &middot; 40 shares</span>
                    </div>
                    
                </div>
                <div class="post-activity">
                    <div>
                        <img src="images/user-1.png" class="post-activity-user-icon">
                        <img src="images/down-arrow.png" class="post-activity-arrow-icon">
                    </div>
                    <div class="post-activity-link">
                        <img src="images/like.png" >
                        <span>Like</span>
                    </div>

                    <div class="post-activity-link">
                        <img src="images/comment.png" >
                        <span>comment</span>
                    </div >

                    <div class="post-activity-link">
                        <img src="images/share.png" >
                        <span>Share</span>
                    </div>

                    <div class="post-activity-link">  
                        <img src="images/send.png" >
                        <span>Send</span>
                    </div>
                </div>
              
            </div>

            <div class="post">
                <div class="post-author">
                    <img src="images/user-1.png" >
                    <div>
                        <h1>Benjamin Leo</h1>
                        <small>Founder and CEO at Gellelio Group | Angel Investor</small>
                        <small>2 hours ago</small>
                    </div>
                </div>
                <p> The success of every websites depends on search engine optimisation and digital marketing strategy. If you are on first page of all major search engines then you are ahead amoung your competitors.</p>
                <img src="images/post_Ab.jpeg" width="100%">

                <div class="post-stats">
                    <div>
                        <img src="images/thumbsup.png" >
                        <img src="images/love.png" >
                        <img src="images/clap.png" >
                        <span class="liked-users">Abhinav Mishra and 75 others</span>
                    </div>
                    <div>
                        <span>22 comments &middot; 40 shares</span>
                    </div>
                    
                </div>
                <div class="post-activity">
                    <div>
                        <img src="images/user-1.png" class="post-activity-user-icon">
                        <img src="images/down-arrow.png" class="post-activity-arrow-icon">
                    </div>
                    <div class="post-activity-link">
                        <img src="images/like.png" >
                        <span>Like</span>
                    </div>

                    <div class="post-activity-link">
                        <img src="images/comment.png" >
                        <span>comment</span>
                    </div >

                    <div class="post-activity-link">
                        <img src="images/share.png" >
                        <span>Share</span>
                    </div>

                    <div class="post-activity-link">  
                        <img src="images/send.png" >
                        <span>Send</span>
                    </div>
                </div>
              
            </div>

        </div>
        
        <!-- ------------right-sider------------- -->
        <div class="right-sidebar">
            <div class="sidebar-news">
                <center><h3 class="sidebar-title">Art Forms</h3></center>
         <div class="grid-container">
            <!-- Repeat for each image/art form you have -->
            <div class="grid-item" onclick="itemClicked(this)">
                <a href="gallery 2/music.php"><img src="images/images2/musicalinstruments.webp" alt="Art Image 1"></a>
                <div class="caption"> <b>Vadya vidya</b></div>
        
            </div>
            <div class="grid-item" onclick="itemClicked(this)">
                <a href="gallery 2/singing.html"><img src="images/images2/singing.avif" alt="Art Image 2"></a>
                 <div class="caption">Geet vidya</div>
        
            </div>
        
            <div class="grid-item" onclick="itemClicked(this)">
                <a href="gallery 2/dance.html"><img src="images/images2/calsicaldance.jpeg" alt="Art Image 1"></a>
                <div class="caption">Nritya vidya</div>
            </div>
            <div class="grid-item" onclick="itemClicked(this)">
                <a href="gallery 2/drama.html"><img src="images/images2/drama.jpeg" alt="Art Image 2"></a> 
                <div class="caption">Natya vidya</div>
        
            </div>
        
            <div class="grid-item" onclick="itemClicked(this)">
                <a href="gallery 2/painting.html"><img src="images/images2/painting.jpeg" alt="Art Image 1"></a>
                <div class="caption">Alekhya vidya</div>
            </div>
            <div class="grid-item" onclick="itemClicked(this)">
                <a href="gallery 2/pottery.html"><img src="images/images2/pottery.jpeg" alt="Art Image 2"></a>
                <div class="caption">Pottery</div>
            </div>
        
            <div class="grid-item" onclick="itemClicked(this)">
                <a href="gallery 2/sculpture.html"><img src="images/images2/sculptureartist.webp" alt="Art Image 1"></a>
                <div class="caption">shilpakāraḥ</div>
            </div>
            <div class="grid-item" onclick="itemClicked(this)">
                <a href="gallery 2/poet.html"><img src="images/images2/poet.webp" alt="Art Image 2"></a>
                <div class="caption">Poetry</div>
            </div>
            <div class="grid-item" onclick="itemClicked(this)">
               <a href="gallery 2/saree.html"> <img src="images/images2/sareemaker.webp" alt="Art Image 1"></a>
                <div class="caption">Handloons</div>
            </div>
            <div class="grid-item" onclick="itemClicked(this)">
                <a href="gallery 2/wooden.html"><img src="images/images2/woodentoys.webp" alt="Art Image 2"></a>
                <div class="caption">Wooden toys</div>
            </div>
            <div class="grid-item" onclick="itemClicked(this)">
                <a href="gallery 2/jewellery.html"><img src="images/images2/jewellarymaker.webp" alt="Art Image 1"></a>
                <div class="caption">ratna-kalpana</div>
            </div>
            <div class="grid-item" onclick="itemClicked(this)">
                <a href="gallery 2/basket.php"><img src="images/images2/basketmaker.webp" alt="Art Image 2"></a>
                <div class="caption">Basket Weaving</div>
            </div>
                
            <!-- Add more items as needed -->
        </div>
</div>
</div>
    </div>
<script>

    let profileMenu = document.getElementById("profileMenu");

    function toggleMenu(){
        profileMenu.classList.toggle("open-menu");
    }
</script>

<script>
    let sidebarActivity = document.getElementById("sidebarActivity");
    let moreLink = document.getElementById("showmorelink");

    function toggleActivity(){
        sidebarActivity.classList.toggle("open-activity");

        if(sidebarActivity.classList.contains("open-activity")){
            moreLink.innerHTML = "show less <b>- </b>";
        }
        else{
            moreLink.innerHTML = "show less <b>-</b>";
        }
    }

</script>
<link rel="stylesheet" href="script/script.js">
</body>
</html>