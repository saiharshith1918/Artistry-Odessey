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
    <title>Artist Oddassy - Extended Products</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">

        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;300;400;700;900&display=swap" rel="stylesheet">

        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/bootstrap-icons.css" rel="stylesheet">

        <link rel="stylesheet" href="css/slick.css"/>

        <link href="css/tooplate-little-fashion.css" rel="stylesheet">
        <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/styles.css">

</head>
<style>

.navbar a, .navbar span {
    color: gray; /* Sets the text color to gray */
}
 .product-thumb {
    display: flex;
    flex-direction: column;
    border: 1px solid #ccc;
    padding: 10px;
    background-color: #f9f9f9;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

.image-wrapper {
    width: 100%; /* Ensures the container fills the width of .product-thumb */
    height: 250px; /* Fixed height for all images */
    overflow: hidden; /* Hides parts of the image that might overflow */
    display: flex;
    align-items: center; /* Centers the image vertically */
    justify-content: center; /* Centers the image horizontally */
}

.product-image {
    width: 100%; /* Ensures image fills the container */
    height: 100%; /* Ensures image fills the fixed height */
    object-fit: cover; /* Covers the area, clipping excess without distortion */
}

.products .row .col-lg-4,
.products .row .col-md-6,
.products .row .col-12 {
    display: flex;
    justify-content: center;
}

@media (max-width: 992px) {
    .products .row .col-lg-4 {
        flex: 0 0 50%;
        max-width: 50%;
    }
}

@media (max-width: 576px) {
    .products .row .col-lg-4 {
        flex: 0 0 100%;
        max-width: 100%;
    }
}


    
    </style>
<body>
    <!-- Navigation Bar from index.html -->
    <!--<nav class="navbar">
        <div class="navbar-left">
            <a href="index.html" class="logo"><img src="images/logo.jpeg" alt="Logo"></a>
            <div class="search-box">
                <img src="images/search.png" alt="Search Icon">
                <input type="text" placeholder="Search">
            </div>
        </div>
        <div class="navbar-center">
            <ul>
                <li><a href="index.html" class="active-link"><img src="images/home.png" alt=""><span>Home</span></a></li>
                <li><a href="#"><img src="images/trending.svg" alt=""><span>Trending</span></a></li>
                <li><a href="Drawing App JavaScript/index.html"><img src="images/create.png" alt=""><span>Create Art</span></a></li>
                <li><a href="#"><img src="images/reels.png" alt=""><span>Reels</span></a></li>
                <li><a href="products.html"><img src="images/jobs.png" alt=""><span>Product</span></a></li>
            </ul>
        </div>
        <div class="navbar-right">
            <div class="online">
                <img src="images/user-1.png" class="nav-profile-img" onclick="toggleMenu()">
            </div>
        </div>
    </nav>-->
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
                <li><a href="index.php"><img src="images/home.png" alt=""><span>Home</span></a></li>
                <li><a href="trending.php"><img src="images/trending.svg" alt=""><span>Treading</span></a></li>
                <li><a href="art.php"><img src="images/create.png" alt=""><span>create Art</span></a></li>
                <li><a href="#"><img src="images/reels.png" alt=""><span>reels</span></a></li>
                <li><a href="products.php" class="active-link"><img src="images/jobs.png" alt=""><span>Product</span></a></li>
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
   <!-- <section class="preloader">
        <div class="spinner">
            <span class="sk-inner-circle"></span>
        </div>
    </section>-->

    <main>
        <!--<header class="site-header section-padding d-flex justify-content-center align-items-center">
            <div class="container">
                <div class="row">

                    <div class="col-lg-10 col-12">
                        <h1>
                            <span class="d-block text-primary">Choose your</span>
                            <span class="d-block text-dark">favorite stuffs</span>
                        </h1>
                    </div>
                </div>
            </div>
        </header>-->
        <!-- Products Section -->
        <section class="products section-padding">
            <div class="container">
                <div class="row">
                    
                    <div class="col-12">
                        <h2 class="mb-5">New Arrivals</h2>
                    </div>

    <div class="col-lg-4 col-md-6 col-12 mb-3">
    <div class="product-thumb">
        <div class="image-wrapper">
            <a href="product-detail.php">
                <img src="images/Product_images/product/vena.jpeg" class="product-image" alt="">
            </a>
        </div>
        <div class="product-info">
            <h5 class="product-title mb-0">
                <a href="product-detail.php" class="product-title-link">Product Name</a>
            </h5>
            <p class="product-p">Description here</p>
            <small class="product-price text-muted ms-auto">$Price</small>
        </div>
    </div>
</div>


    <div class="col-lg-4 col-md-6 col-12 mb-3">
    <div class="product-thumb">
        <div class="image-wrapper">
            <a href="product-detail.php">
                <img src="images/Product_images/product/saree.webp" class="product-image" alt="">
            </a>
        </div>
        <div class="product-info">
            <h5 class="product-title mb-0">
                <a href="product-detail.php" class="product-title-link">Product Name</a>
            </h5>
            <p class="product-p">Description here</p>
            <small class="product-price text-muted ms-auto">$Price</small>
        </div>
    </div>
</div>


<div class="col-lg-4 col-md-6 col-12 mb-3">
    <div class="product-thumb">
        <div class="image-wrapper">
            <a href="product-detail.php">
                <img src="images/Product_images/product/pots.jpg" class="product-image" alt="">
            </a>
        </div>
        <div class="product-info">
            <h5 class="product-title mb-0">
                <a href="product-detail.php" class="product-title-link">Product Name</a>
            </h5>
            <p class="product-p">Description here</p>
            <small class="product-price text-muted ms-auto">$Price</small>
        </div>
    </div>
</div>


                    

<div class="col-lg-4 col-md-6 col-12 mb-3">
    <div class="product-thumb">
        <div class="image-wrapper">
            <a href="product-detail.php">
                <img src="images/Product_images/product/weaing_bag.webp" class="product-image" alt="">
            </a>
        </div>
        <div class="product-info">
            <h5 class="product-title mb-0">
                <a href="product-detail.php" class="product-title-link">Product Name</a>
            </h5>
            <p class="product-p">Description here</p>
            <small class="product-price text-muted ms-auto">$Price</small>
        </div>
    </div>
</div>


<div class="col-lg-4 col-md-6 col-12 mb-3">
    <div class="product-thumb">
        <div class="image-wrapper">
            <a href="product-detail.php">
                <img src="images/Product_images/product/farmer_toy.jpeg" class="product-image" alt="">
            </a>
        </div>
        <div class="product-info">
            <h5 class="product-title mb-0">
                <a href="product-detail.php" class="product-title-link">Product Name</a>
            </h5>
            <p class="product-p">Description here</p>
            <small class="product-price text-muted ms-auto">$Price</small>
        </div>
    </div>
</div>

<div class="col-lg-4 col-md-6 col-12 mb-3">
    <div class="product-thumb">
        <div class="image-wrapper">
            <a href="product-detail.php">
                <img src="images/Product_images/product/ganesh_painting.webp" class="product-image" alt="">
            </a>
        </div>
        <div class="product-info">
            <h5 class="product-title mb-0">
                <a href="product-detail.php" class="product-title-link">Product Name</a>
            </h5>
            <p class="product-p">Description here</p>
            <small class="product-price text-muted ms-auto">$Price</small>
        </div>
    </div>
</div>


                </div>
                <div class="row">
                    
                    <div class="col-12">
                    <h2 class="mb-5">Popular</h2>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12 mb-3">
    <div class="product-thumb">
        <div class="image-wrapper">
            <a href="product-detail.php">
                <img src="images/Product_images/product/vena.jpeg" class="product-image" alt="">
            </a>
        </div>
        <div class="product-info">
            <h5 class="product-title mb-0">
                <a href="product-detail.php" class="product-title-link">Product Name</a>
            </h5>
            <p class="product-p">Description here</p>
            <small class="product-price text-muted ms-auto">$Price</small>
        </div>
    </div>
</div>


<div class="col-lg-4 col-md-6 col-12 mb-3">
    <div class="product-thumb">
        <div class="image-wrapper">
            <a href="product-detail.php">
                <img src="images/Product_images/product/pots.jpg" class="product-image" alt="">
            </a>
        </div>
        <div class="product-info">
            <h5 class="product-title mb-0">
                <a href="product-detail.php" class="product-title-link">Product Name</a>
            </h5>
            <p class="product-p">Description here</p>
            <small class="product-price text-muted ms-auto">$Price</small>
        </div>
    </div>
</div>


<div class="col-lg-4 col-md-6 col-12 mb-3">
    <div class="product-thumb">
        <div class="image-wrapper">
            <a href="product-detail.php">
                <img src="images/Product_images/product/weaing_bag.webp" class="product-image" alt="">
            </a>
        </div>
        <div class="product-info">
            <h5 class="product-title mb-0">
                <a href="product-detail.php" class="product-title-link">Product Name</a>
            </h5>
            <p class="product-p">Description here</p>
            <small class="product-price text-muted ms-auto">$Price</small>
        </div>
    </div>
</div>


                    

<div class="col-lg-4 col-md-6 col-12 mb-3">
    <div class="product-thumb">
        <div class="image-wrapper">
            <a href="product-detail.php">
                <img src="images/Product_images/product/horse_toy.webp" class="product-image" alt="">
            </a>
        </div>
        <div class="product-info">
            <h5 class="product-title mb-0">
                <a href="product-detail.php" class="product-title-link">Product Name</a>
            </h5>
            <p class="product-p">Description here</p>
            <small class="product-price text-muted ms-auto">$Price</small>
        </div>
    </div>
</div>

<div class="col-lg-4 col-md-6 col-12 mb-3">
    <div class="product-thumb">
        <div class="image-wrapper">
            <a href="product-detail.php">
                <img src="images/Product_images/product/saree.webp" class="product-image" alt="">
            </a>
        </div>
        <div class="product-info">
            <h5 class="product-title mb-0">
                <a href="product-detail.php" class="product-title-link">Product Name</a>
            </h5>
            <p class="product-p">Description here</p>
            <small class="product-price text-muted ms-auto">$Price</small>
        </div>
    </div>
</div>


<div class="col-lg-4 col-md-6 col-12 mb-3">
    <div class="product-thumb">
        <div class="image-wrapper">
            <a href="product-detail.php">
                <img src="images/Product_images/product/farmer_toy.jpeg" class="product-image" alt="">
            </a>
        </div>
        <div class="product-info">
            <h5 class="product-title mb-0">
                <a href="product-detail.php" class="product-title-link">Product Name</a>
            </h5>
            <p class="product-p">Description here</p>
            <small class="product-price text-muted ms-auto">$Price</small>
        </div>
    </div>
</div>


                </div>
            </div>
        </section>
    </main>

    <!-- Smaller Footer -->
    <footer class="site-footer" style="padding: 10px; font-size: smaller;">
        <div class="container">
            <p>Copyright © 2024. Artisy Odassay</p>
        </div>
    </footer>

    <!-- Scripts -->
    <!-- JAVASCRIPT FILES -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/Headroom.js"></script>
    <script src="js/jQuery.headroom.js"></script>
    <script src="js/slick.min.js"></script>
    <script src="js/custom.js"></script>
</body>
</html>
