<?php
include("connection.php");
session_start();  // Start the session at the beginning of the script

if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if the user is not logged in
    header('Location: home.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Basket art Gallery</title>
    <link rel="stylesheet" href="painting.css">
</head>
<body>
    <nav class="navbar">
                <div class="navbar-left">
                    <a href="index.html" class="logo"><img src="images/logo.jpeg" alt=""></a>
        
                    <div class="search-box">
                        <img src="images/search.png" alt="">
                        <input type="text" placeholder="Search">
                    </div>
        
                </div>
                <div class="navbar-center">
                    <ul>
                        <li><a href="#" class="active-link"><img src="images/home.png" alt=""><span>Home</span></a></li>
                        <li><a href="#"><img src="images/trending.svg" alt=""><span>Treading</span></a></li>
                        <li><a href="Drawing App JavaScript/index.html"><img src="images/create.png" alt=""><span>create Art</span></a></li>
                        <li><a href="#"><img src="images/reels.png" alt=""><span>reels</span></a></li>
                        <li><a href="#"><img src="images/notification.png" alt=""><span>Notifications</span></a></li>
                    </ul>
                </div>
                <div class="navbar-right">
                    <div class="online">
                        <img src="images/user-1.png" class="nav-profile-img" onclick="toggleMenu()">
                    </div>
                </div>            
    </nav>
    <div class="content-wrapper">
        <section id="artists">
            <h2>Popular Regions</h2>
            <div class="artist-grid">
                <!-- Dynamically loaded artist profiles will go here -->
            </div>
        </section>
        <div class="theme-image">
            <img src="baskets.png" alt="Artistic Representation">
        </div>
    </div>

    <div class="post">
        <div class="post-author">
            <img src="users/basket1.jpg" >
            <div>
                <h1>Chanakyaa English</h1>
                <small>Chanakyaa brings News and Entertainment Videos from the Eminent and Most Popular Journalist / Writer / Anchor Mr. Rangaraj Pandey</small>
                <small>2 hours ago</small>
            </div>
        </div>
        <p> Onion export boost revives bamboo basket industry

            #OnionExports #BambooBaskets #EconomicRevival #CentralGovernment #AgriculturalTrade #ExportPermission #OnionCultivation #TradeRevival #IndianEconomy #OnionPrices  #FarmersMarket #ExportIndustry #TradeBoost  #AgriculturalSector.</p>
        <img src="posts/basket1.jpeg" width="100%">

        <div class="post-stats">
            <div>
                <img src="images/thumbsup.png" >
                <img src="images/love.png" >
                <img src="images/clap.png" >
                <span class="liked-users">Akshay and 71 others</span>
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
            <img src="users/basket2.jpg" >
            <div>
                <h1>Amrit Kalash</h1>
                <small>Amrit Kalash Network is a startup e-commerce platform, Our goal is to provide a reliable e-commerce services to SHGs, NGOs, small businesses and individuals.</small>
                <small>2 hours ago</small>
            </div>
        </div>
        <p> Introducing the Decorative Bamboo Puja Basket – a harmonious blend of elegance and tradition

            Buy Now :https://tinyurl.com/3ewunvpc
            
            #AmritKalashShop #AmritKalash #PujaEssentials #BambooCraft #SpiritualDecor #SacredSpace #DivineRituals  #result2024 #LOCKDOWN #Followme #BuyNow</p>
        <img src="posts/basket2.png" width="100%">

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


    <section id="reels">
        <h2><img src="images/reels.png"width="27" height="27" alt=""><span>Reels</span></h2>
        <div class="reels-container">
            <!-- Dynamically loaded reels will go here -->
        </div>
    </section>
    
    <div class="post">
        <div class="post-author">
            <img src="images/network.png" >
            <div>
                <h1></h1>
                <small></small>
                <small>Jul 13</small>
            </div>
        </div>
        <p>This Is A Handmade eco-friendly natural Pure Bamboo laundry bin. This Bin Have Every piece Are hand finished. It's easy to carry And light weight to use. #ecofriendly #plasticfree #saveearth #bamboo #plasticfreeproducts #handmade #bamboobin</p>
        <img src="posts/basket3.jpeg" width="100%">

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
            <img src="users/basket4.jpg" >
            <div>
                <h1>𝔸𝕊𝕊𝔸𝕄Kℝ𝔸𝔽𝕋 (AssamKraft)</h1>
                <small>Indian music composer, record producer, singer, and philanthropist</small>
                <small>July 13</small>
            </div>
        </div>
        <p> This Is A Handmade eco-friendly natural Pure Bamboo laundry bin. This Bin Have Every piece Are hand finished. It's easy to carry And light weight to use. #ecofriendly #plasticfree #saveearth #bamboo #plasticfreeproducts #handmade #bamboobin</p>
        <img src="posts/basket4.jpeg" width="100%">

        <div class="post-stats">
            <div>
                <img src="images/thumbsup.png" >
                <img src="images/love.png" >
                <img src="images/clap.png" >
                <span class="liked-users">A.Mishra and 5 others</span>
            </div>
            <div>
                <span>2 comments &middot; 4 shares</span>
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
            <img src="users/basket5.jpg" >
            <div>
                <h1>Pankaj Kumar Singh</h1>
                <small></small>
                <small>Nov 22</small>
            </div>
        </div>
        <p> Moonj is a type of wild grass, grown near the banks of the river in Prayagraj. Women peel, color and weave this grass into eco- friendly baskets, bags, bookshelves etc. As a tradition, it is also gifted to newlywed women.</p>
        <img src="posts/basket5.jpeg" width="100%">

        <div class="post-stats">
            <div>
                <img src="images/thumbsup.png" >
                <img src="images/love.png" >
                <img src="images/clap.png" >
                <span class="liked-users">Abhi and 5 others</span>
            </div>
            <div>
                <span>10 comments &middot; 54 shares</span>
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

    <footer>
        <p>Copyright © 2024 Artistry Odyssey Gallery</p>
    </footer>

    <script src="basket.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            loadReels();
        });
    </script>   

</body>
</html>
