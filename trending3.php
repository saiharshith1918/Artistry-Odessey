<?php
include("connection.php");
session_start(); // Start the session at the top of the file

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if the user is not logged in
    header('Location: home.php');
    exit;
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
    <link rel="stylesheet" href="css/trending.css" />
</head>
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
                <li><a href="Drawing App JavaScript/index.php"><img src="images/create.png" alt=""><span>create Art</span></a></li>
                <li><a href="#"><img src="images/reels.png" alt=""><span>reels</span></a></li>
                <li><a href="products.php"><img src="images/jobs.png" alt=""><span>Product</span></a></li>
            </ul>
        </div>
        <div class="navbar-right">
            <div class="online">
                <img src="images/user-1.png" class="nav-profile-img" onclick="toggleMenu()">
                <span><?php echo htmlspecialchars($_SESSION['username']); ?></span>
            </div>
        </div>
     <!-- -------------------- profile -drop-down-menu----------------------- -->
     <div class="profile-menu-wrap" id="profileMenu">
        <div class="profile-menu">
            <div class="user-info">
                <img src="images/user-1.png" >
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
        <!-- ----------main-content----------- -->
      <div class="main-content">
            <div class="sort-by">
                <hr>
                <p>Sort by: <span>top <img src="images/down-arrow.png"></span></p>
            </div>
            <div class="post">
                <div class="post-author">
                    <img src="images/user-4.png" >
                    <div>
                        <h1>A R Rahaman</h1>
                        <small>Indian music composer, record producer, singer, and philanthropist</small>
                        <small>2 hours ago</small>
                    </div>
                </div>
                <p> The success of every websites depends on search engine optimisation and digital marketing strategy. If you are on first page of all major search engines then you are ahead amoung your competitors.</p>
                <img src="images/post-image-2.png" width="100%">

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
                    <img src="images/user-3.png" >
                    <div>
                        <h1>Benjamin Leo</h1>
                        <small>Founder and CEO at Gellelio Group | Angel Investor</small>
                        <small>2 hours ago</small>
                    </div>
                </div>
                <p> The success of every websites depends on search engine optimisation and digital marketing strategy. If you are on first page of all major search engines then you are ahead amoung your competitors.</p>
                <img src="images/post-image-1.png" width="100%">

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
                    <img src="images/user-5.png" >
                    <div>
                        <h1>Benjamin Leo</h1>
                        <small>Founder and CEO at Gellelio Group | Angel Investor</small>
                        <small>2 hours ago</small>
                    </div>
                </div>
                <p> The success of every websites depends on search engine optimisation and digital marketing strategy. If you are on first page of all major search engines then you are ahead amoung your competitors.</p>
                <img src="images/post-image-3.png" width="100%">

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
                <img src="images/post-image-4.png" width="100%">

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
<script>
 function toggleMenu() {
    var menu = document.getElementById('profileMenu');
    if (menu.style.display === 'block') {
        menu.style.display = 'none';
    } else {
        menu.style.display = 'block';
    }
 }
</script>
    <script src="script/main.js"></script>
<link rel="stylesheet" href="script/script.js">
</body>
</html>