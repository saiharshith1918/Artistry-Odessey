
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
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="description" content="">
        <meta name="author" content="">

        <title>Artistry Odyssey</title>

        <!-- CSS FILES -->
        <link rel="preconnect" href="https://fonts.googleapis.com">

        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;300;400;700;900&display=swap" rel="stylesheet">

        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/bootstrap-icons.css" rel="stylesheet">

        <link rel="stylesheet" href="css/slick.css"/>

        <link href="css/tooplate-little-fashion.css" rel="stylesheet">
        <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/styles.css">
    <style>
        .navbar a, .navbar span {
    color: gray; /* Sets the text color to gray */
}
    </style>
<!--

Tooplate 2127 Little Fashion

https://www.tooplate.com/view/2127-little-fashion

-->
    </head>
    
    <body>

        <section class="preloader">
            <div class="spinner">
                <span class="sk-inner-circle"></span>
            </div>
        </section>
    
        <main>

            
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

           

            <section class="product-detail section-padding">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-6 col-12">
                            <div class="product-thumb">
                                <img src="images/Product_images/product/saree.webp" class="img-fluid product-image" alt="">
                            </div>
                        </div>

                        <div class="col-lg-6 col-12">
                            <div class="product-info d-flex">
                                <div>
                                    <h2 class="product-title mb-0">Pochampally saree</h2>

                                    <p class="product-p">Original package design from house</p>
                                </div>

                                <small class="product-price text-muted ms-auto mt-auto mb-5">2500 rupees</small>
                            </div>

                            <div class="product-description">

                                <strong class="d-block mt-4 mb-2">Description</strong>

                                <p class="lead mb-5">One of the oldest dyed prints in the state, it is also known as the Pochampally Ikat, because of its resemblance to the Ikat style of dyeing the cloth. The patterns on a Pochampally saree are largely geometric.</p>
                            </div>

                            <div class="product-cart-thumb row">
                                <div class="col-lg-6 col-12">
                                    
                                    <select class="form-select cart-form-select" id="inputGroupSelect01">
                                        <option selected>Quantity</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                </div>

                                <div class="col-lg-6 col-12 mt-4 mt-lg-0">
                                    <button type="submit" class="btn custom-btn cart-btn" data-bs-toggle="modal" data-bs-target="#cart-modal">Add to Cart</button>
                                </div>

                                <p>
                                    <a href="#" class="product-additional-link">Details</a>

                                    <a href="#" class="product-additional-link">Delivery and Payment</a>
                                </p>
                            </div>

                        </div>

                    </div>
                </div>
            </section>

            <section class="related-product section-padding border-top">
                <div class="container">
                    <div class="row">

                        <div class="col-12">
                            <h3 class="mb-5">You might also like</h3>
                        </div>

                        <div class="col-lg-4 col-12 mb-3">
                            <div class="product-thumb">
                                <a href="product-detail.html">
                                    <img src="images/Product_images/product/evan-mcdougall-qnh1odlqOmk-unsplash.jpeg" class="img-fluid product-image" alt="">
                                </a>

                                <div class="product-top d-flex">
                                    <span class="product-alert me-auto">New arrival</span>

                                    <a href="#" class="bi-heart-fill product-icon"></a>
                                </div>

                                <div class="product-info d-flex">
                                    <div>
                                        <h5 class="product-title mb-0">
                                            <a href="product-detail.html" class="product-title-link">farmer toy</a>
                                        </h5>

                                        <p class="product-p">Original package design from house</p>
                                    </div>

                                    <small class="product-price text-muted ms-auto mt-auto mb-5">2500 rupees</small>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-12 mb-3">
                            <div class="product-thumb">
                                <a href="product-detail.php">
                                    <img src="images/Product_images/product/farmer_toy.jpeg " class="img-fluid product-image" alt="">
                                </a>

                                <div class="product-top d-flex">
                                    <span class="product-alert">Low Price</span>

                                    <a href="#" class="bi-heart-fill product-icon ms-auto"></a>
                                </div>

                                <div class="product-info d-flex">
                                    <div>
                                        <h5 class="product-title mb-0">
                                            <a href="product-detail.php" class="product-title-link">Fashion set</a>
                                        </h5>

                                        <p class="product-p">Costume package</p>
                                    </div>

                                    <small class="product-price text-muted ms-auto mt-auto mb-5">35</small>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-12">
                            <div class="product-thumb">
                                <a href="product-detail.php">
                                    <img src="images/Product_images/product/nature-zen-3Dn1BZZv3m8-unsplash.jpeg" class="img-fluid product-image" alt="">
                                </a>

                                <div class="product-top d-flex">
                                    <a href="#" class="bi-heart-fill product-icon ms-auto"></a>
                                </div>

                                <div class="product-info d-flex">
                                    <div>
                                        <h5 class="product-title mb-0">
                                            <a href="product-detail.php" class="product-title-link">Juice Drinks</a>
                                        </h5>

                                        <p class="product-p">Nature made another world</p>
                                    </div>

                                    <small class="product-price text-muted ms-auto mt-auto mb-5">45</small>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>

        </main>

       <!-- <footer class="site-footer">
            <div class="container">
                <div class="row">

                    <div class="col-lg-3 col-10 me-auto mb-4">
                        <h4 class="text-white mb-3"><a href="index.html">Little</a> Fashion</h4>
                        <p class="copyright-text text-muted mt-lg-5 mb-4 mb-lg-0">Copyright © 2022 <strong>Little Fashion</strong></p>
                        <br>
                        <p class="copyright-text">Designed by <a href="https://www.tooplate.com/" target="_blank">Tooplate</a></p>
                    </div>

                    <div class="col-lg-5 col-8">
                        <h5 class="text-white mb-3">Sitemap</h5>

                        <ul class="footer-menu d-flex flex-wrap">
                            <li class="footer-menu-item"><a href="about.html" class="footer-menu-link">Story</a></li>

                            <li class="footer-menu-item"><a href="#" class="footer-menu-link">Products</a></li>

                            <li class="footer-menu-item"><a href="#" class="footer-menu-link">Privacy policy</a></li>

                            <li class="footer-menu-item"><a href="#" class="footer-menu-link">FAQs</a></li>

                            <li class="footer-menu-item"><a href="#" class="footer-menu-link">Contact</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-3 col-4">
                        <h5 class="text-white mb-3">Social</h5>

                        <ul class="social-icon">

                            <li><a href="#" class="social-icon-link bi-youtube"></a></li>

                            <li><a href="#" class="social-icon-link bi-whatsapp"></a></li>

                            <li><a href="#" class="social-icon-link bi-instagram"></a></li>

                            <li><a href="#" class="social-icon-link bi-skype"></a></li>
                        </ul>
                    </div>

                </div>
            </div>
        </footer>-->

        <!-- Smaller Footer -->
    <footer class="site-footer" style="padding: 10px; font-size: smaller;">
        <div class="container">
            <p>Copyright © 2024 Artisry Odassay</p>
        </div>
    </footer>
        <!-- CART MODAL -->
        <div class="modal fade" id="cart-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content border-0">
                    <div class="modal-header flex-column">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6 col-12 mt-4 mt-lg-0">
                                <img src="images/Product_images/product/saree.webp" class="img-fluid product-image" alt="">
                            </div>

                            <div class="col-lg-6 col-12 mt-3 mt-lg-0">
                                <h3 class="modal-title" id="exampleModalLabel">Pochampally saree</h3>

                                <p class="product-price text-muted mt-3">2500</p>

                                <p class="product-p">Quatity: <span class="ms-1">4</span></p>

                                <p class="product-p">Colour: <span class="ms-1">pink</span></p>

                                <p class="product-p pb-3">Size: <span class="ms-1">S/S</span></p>

                                <div class="border-top mt-4 pt-3">
                                    <p class="product-p"><strong>Total: <span class="ms-1">3000</span></strong></p>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <div class="row w-50">
                            <button type="button" class="btn custom-btn cart-btn ms-lg-4">Checkout</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- JAVASCRIPT FILES -->
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/Headroom.js"></script>
        <script src="js/jQuery.headroom.js"></script>
        <script src="js/slick.min.js"></script>
        <script src="js/custom.js"></script>

    </body>
</html>