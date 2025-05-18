<?php
session_start();
// Include the file containing your database connection
include("connection.php");

// Account creation
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['signup'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    /*try {
        // Prepare the SQL statement
        $stmt = $pdo->prepare("INSERT INTO sign_up (email, password) VALUES (?, ?)");

        // Bind parameters
        $stmt->bindParam(1, $email);
        $stmt->bindParam(2, $password);

        // Execute the statement
        $stmt->execute();

        echo "New record created successfully";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}*/
    try {
    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Prepare the SQL statement
    $stmt = $pdo->prepare("INSERT INTO sign_up (name, email, password) VALUES (?, ?, ?)");

    // Bind parameters
    $stmt->bindParam(1, $name);
    $stmt->bindParam(2, $email);
    $stmt->bindParam(3, $hashedPassword);
    // Execute the statement
    $stmt->execute();
    // Set session variables
    $_SESSION['user_id'] = $pdo->lastInsertId();
    $_SESSION['username'] = $name;
    header("Location: index.php");
   // echo "New record created successfully";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
}


// Login
/*if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    // Retrieve form data
    $email = $_POST['email'];
    $password = $_POST['password'];
    $stmt = $pdo->prepare("SELECT * FROM sign_up WHERE LOWER(email) = LOWER(:email)");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Check if the password is correct
        if ($user['password'] == $password) {
            header("Location: welcome.php");
            exit();
        }else {
            // Invalid password, display an error message
            echo "<script>alert('Incorrect password. Please try again.');</script>";
        }

    } 
}*/
// Login
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    // Retrieve form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        // Prepare the SQL statement to fetch user by email
        $stmt = $pdo->prepare("SELECT * FROM sign_up WHERE LOWER(email) = LOWER(?)");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Check if the password is correct
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['name'];  // Ensure your sign_up table contains a 'name' field
            header("Location: index.php");
                exit();
            } else {
                // Invalid password, display an error message
                echo "<script>alert('Incorrect password. Please try again.');</script>";
            }
        } else {
            // User not found, display an error message
            echo "<script>alert('User not found. Please sign up.');</script>";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>


<!DOCTYPE html>
<!-- Coding By CodingNepal - www.codingnepalweb.com -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Art Bazaar </title>
    <!-- Google Fonts Link For Icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,0,0">
    <link rel="stylesheet" href="style_home.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"
  integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <script src="script/script_home.js" defer></script>
</head>
<style>
/* Add this CSS to your existing style file */

.column-text {
    text-align: justify;
    line-height: 1.6;
    font-size: 17px; /* Adjust based on your design needs */
    padding: 0 15px; /* Adds horizontal padding */
    margin-top: 10px; /* Optional: Adds some space above the text */
    font-family: 'Arial', sans-serif; /* Example font */
}

</style>
<body>
    <header>
        <nav class="navbar">
            <span class="hamburger-btn material-symbols-rounded">menu</span>
            <a href="#" class="logo">
                <img src="images/1.png" alt="logo">
                <h2><span style="color: orange; font-size: 1.5em;">A</span>rtistry<span style="color: orange; font-size: 1.5em;">O</span>dyssey</h2>
            </a>
            <ul class="links">
                <span class="close-btn material-symbols-rounded">close</span>
                <li><a href="#">Home</a></li>
                <li><a href="#testimonial">About us</a></li>
                <li><a href="#contact">Contact us</a></li>
            </ul>
            <button class="login-btn">LOG IN</button>
        </nav>
    </header>

    <section class="hero-section">
        <div class="hero">
          <h2>Welcome to your cultural community </h2>
          <p>
            Exploring the creative realm of art,
            Where Art Meets Imagination.
          </p>
          <div class="buttons">
            <a href="home.php" id="signup-link" class="join">Join Now</a>
            <a href="#" class="learn">Learn More</a>
          </div>
        </div>
        <div class="img">
         <img src="images/nata.png" alt="hero image" />
        </div>
      </section>

    <div class="blur-bg-overlay"></div>
    <div class="form-popup">
        <span class="close-btn material-symbols-rounded">close</span>
        <div class="form-box login">
            <div class="form-details">
                <h2>Welcome Back</h2>
                <p>Please log in using your personal information to stay connected with us.</p>
            </div>
            <div class="form-content">
                <h2>LOGIN</h2>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <input type="hidden" name="login" value="1"> <!-- For distinguishing signup from login -->
                    <div class="input-field">
                        <input type="text"  name="email" required>
                        <label>Email</label>
                    </div>
                    <div class="input-field">
                        <input type="password" name="password" required>
                        <label>Password</label>
                    </div>
                    <a href="#" class="forgot-pass-link">Forgot password?</a>
                    <button type="submit">Log In</button>
                </form>
                <div class="bottom-link">
                    Don't have an account?
                    <a href="#" id="signup-link">Signup</a>
                </div>
            </div>
        </div>
        <div class="form-box signup">
            <div class="form-details">
                <h2>Create Account</h2>
                <p>To become a part of our community, please sign up using your personal information.</p>
            </div>
            <div class="form-content">
                <h2>SIGNUP</h2>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <input type="hidden" name="signup" value="1"> <!-- For distinguishing login from signup -->
                <div class="input-field">
                        <input type="text" name="name" required>
                        <label>Enter your Username</label>
                    </div>
                    <div class="input-field">
                        <input type="text" name="email" required>
                        <label>Enter your email</label>
                    </div>
                    <div class="input-field">
                        <input type="password" name="password" required>
                        <label>Create password</label>
                    </div>
                    <div class="policy-text">
                        <input type="checkbox" id="policy">
                        <label for="policy">
                            I agree the
                            <a href="#" class="option">Terms & Conditions</a>
                        </label>
                    </div>
                    <button type="submit">Sign Up</button>
                </form>
                <div class="bottom-link">
                    Already have an account? 
                    <a href="#" id="login-link">Login</a>
                </div>
            </div>
        </div>
    </div>

   <!-- <section id="features">

    <div class="row g-4 py-5 row-cols-1 row-cols-lg-3">
      <div class="col d-flex align-items-start">
        <div class="icon-square text-body-emphasis bg-body-secondary d-inline-flex align-items-center justify-content-center fs-4 flex-shrink-0 me-3">
          <svg xmlns="http://www.w3.org/2000/svg" height="30" fill="currentColor" class="bi bi-check2-circle" viewBox="0 0 16 16">
<path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z"></path>
<path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z"></path>
</svg>
        </div>
        <div>
          <h3 class="fs-2 text-body-emphasis">Easy to use.</h3>
          <p>So easy to use, even children can use it.</p>
      
        </div>
      </div>
      <div class="col d-flex align-items-start">
        <div class="icon-square text-body-emphasis bg-body-secondary d-inline-flex align-items-center justify-content-center fs-4 flex-shrink-0 me-3">
          <svg xmlns="http://www.w3.org/2000/svg" height="30" fill="currentColor" class="bi bi-mortarboard" viewBox="0 0 16 16">
            <path d="M8.211 2.047a.5.5 0 0 0-.422 0l-7.5 3.5a.5.5 0 0 0 .025.917l7.5 3a.5.5 0 0 0 .372 0L14 7.14V13a1 1 0 0 0-1 1v2h3v-2a1 1 0 0 0-1-1V6.739l.686-.275a.5.5 0 0 0 .025-.917l-7.5-3.5ZM8 8.46 1.758 5.965 8 3.052l6.242 2.913L8 8.46Z"></path>
            <path d="M4.176 9.032a.5.5 0 0 0-.656.327l-.5 1.7a.5.5 0 0 0 .294.605l4.5 1.8a.5.5 0 0 0 .372 0l4.5-1.8a.5.5 0 0 0 .294-.605l-.5-1.7a.5.5 0 0 0-.656-.327L8 10.466 4.176 9.032Zm-.068 1.873.22-.748 3.496 1.311a.5.5 0 0 0 .352 0l3.496-1.311.22.748L8 12.46l-3.892-1.556Z"></path>
            </svg>
        </div>
        <div>
          <h3 class="fs-2 text-body-emphasis">Popular Artist.</h3>
          <p>We have all the Popular, the greatest Artist.</p>
       
        </div>
      </div>
      <div class="col d-flex align-items-start">
        <div class="icon-square text-body-emphasis bg-body-secondary d-inline-flex align-items-center justify-content-center fs-4 flex-shrink-0 me-3">
          <svg xmlns="http://www.w3.org/2000/svg" height="30" fill="currentColor" class="bi bi-arrow-through-heart" viewBox="0 0 16 16">
<path fill-rule="evenodd" d="M2.854 15.854A.5.5 0 0 1 2 15.5V14H.5a.5.5 0 0 1-.354-.854l1.5-1.5A.5.5 0 0 1 2 11.5h1.793l.53-.53c-.771-.802-1.328-1.58-1.704-2.32-.798-1.575-.775-2.996-.213-4.092C3.426 2.565 6.18 1.809 8 3.233c1.25-.98 2.944-.928 4.212-.152L13.292 2 12.147.854A.5.5 0 0 1 12.5 0h3a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-.854.354L14 2.707l-1.006 1.006c.236.248.44.531.6.845.562 1.096.585 2.517-.213 4.092-.793 1.563-2.395 3.288-5.105 5.08L8 13.912l-.276-.182a21.86 21.86 0 0 1-2.685-2.062l-.539.54V14a.5.5 0 0 1-.146.354l-1.5 1.5Zm2.893-4.894A20.419 20.419 0 0 0 8 12.71c2.456-1.666 3.827-3.207 4.489-4.512.679-1.34.607-2.42.215-3.185-.817-1.595-3.087-2.054-4.346-.761L8 4.62l-.358-.368c-1.259-1.293-3.53-.834-4.346.761-.392.766-.464 1.845.215 3.185.323.636.815 1.33 1.519 2.065l1.866-1.867a.5.5 0 1 1 .708.708L5.747 10.96Z"></path>
</svg>
        </div>
        <div>
          <h3 class="fs-2 text-body-emphasis">Guaranteed to work.</h3>
          <p>Find your work ,favorite art  and  earn money .</p>
       
        </div>
      </div>
    </div>

  </section>  -->
<!--
  <section id="testimonial">
    <div class="my-5">
      <div class="p-5 text-center bg-body-tertiary">
        <div class="container py-5">
          <h2 class="text-body-emphasis">""Where creativity journeys beyond borders—Artistry Odyssey, your canvas to the world." </h2>
          <img class="profile-img mt-3" src="./images/homeart_img.jpeg" alt="dog image">
          <p class="col-lg-8 mx-auto lead mt-2">
            Pebbles, New York
          </p>
        </div>

        <div class="container">
          <div class="row">
            <div class="col-lg-3 col-sm-12">
              <img src="./images/homeart2.jpeg" alt="techcrunch" height="30">
            </div>
            <div class="col-lg-3 col-sm-12">
              <img src="./images/mashable.png" alt="mashable" height="30">
            </div>
            <div class="col-lg-3 col-sm-12">
              <img src="./images/bizinsider.png" alt="bizinsider" height="30">
            </div>
            <div class="col-lg-3 col-sm-12">
              <img src="./images/tnw.png" alt="tnw" height="30">
            </div>
          </div>
        </div>
      </div>
    </div>

  </section>
-->
 <!-- <section id="testimonial">
    <div class="my-5">
        <div class="p-5 text-center bg-body-tertiary">
            <div class="container py-5">
                <h2 class="text-body-emphasis">"Where creativity journeys beyond borders—Artistry Odyssey, your canvas to the world."</h2>
                 Decrease the size of this image 
                <img class="profile-img mt-3" src="./images/homeart_img.jpeg" alt="art display image" style="width: 900px;">
                <p class="col-lg-8 mx-auto lead mt-2">
                    Pebbles, New York
                </p>
            </div>

              <div class="container">
                <div class="row">
                     Increase the size of the following images 
                    <div class="col-lg-3 col-sm-12">
                        <img src="./images/homeart2.jpeg" alt="techcrunch" style="height: 200px ">
                    </div>
                    <div class="col-lg-3 col-sm-12">
                        <img src="./images/mugu.jpeg" alt="mashable" style="height: 200px;">
                    </div>
                    <div class="col-lg-3 col-sm-12">
                        <img src="./images/bizinsider.png" alt="bizinsider" style="height: 200px;">
                    </div>
                    <div class="col-lg-3 col-sm-12">
                        <img src="./images/tnw.png" alt="tnw" style="height: 200px;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> -->

<section id="testimonial">
    <div class="my-5">
        <div class="p-5 text-center bg-body-tertiary">
            <div class="container py-5">
                <h2 class="text-body-emphasis">"Where creativity journeys beyond borders—Artistry Odyssey, your canvas to the world."</h2>
                <!-- Decrease the size of this image -->
                <img class="profile-img mt-3" src="./images/homeart_img.jpeg" alt="art display image" style="width: 1000px; border-radius: 15px;">
              
            </div>
            <div class="container">
                <div class="row">
                    <!-- Increase the size of the following images and add rounded corners -->
                    <div class="col-lg-3 col-sm-12 text-center">
                        <img src="./images/robopainting.jpeg" alt="techcrunch" style="height: 200px; border-radius: 10px;">
                        <p>Exploring the impact of technology on art.</p>
                    </div>
                    <div class="col-lg-3 col-sm-12 text-center">
                        <img src="./images/mugu.jpeg" alt="mashable" style="height: 200px; border-radius: 10px ;width:300px;">
                        <p>Celebrating creativity across new platforms.</p>
                    </div>
                    <div class="col-lg-3 col-sm-12 text-center">
                        <img src="./images/businessart.png" alt="bizinsider" style="height: 200px; border-radius: 10px;">
                        <p>Innovative business solutions through art.</p>
                    </div>
                    <div class="col-lg-3 col-sm-12 text-center">
                        <img src="./images/arttech.jpeg" alt="tnw" style="height: 200px; border-radius: 10px;">
                        <p>Art and technology converging for a new tomorrow.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>




<div class="container marketing">

<div class="row">
  <div class="col-lg-4">
    <img class="bd-placeholder-img rounded-circle" width="140" height="140" src="images/homepillar1.webp" alt="Description of Image 1">
    <h2 class="fw-normal">Sculpture</h2>
    <p class="column-text">Ancient Indian sculpture art, deeply rooted in religious traditions, showcases exquisite stone, metal, and terracotta works. From the intricate carvings of temple deities to the serene statues of Buddha, these sculptures reflect India's rich cultural and spiritual heritage.</p>
   
  </div><!-- /.col-lg-4 -->
  <div class="col-lg-4">
    <img class="bd-placeholder-img rounded-circle" width="140" height="140" src="images/homepillar2.jpeg" alt="Description of Image 2">
    <h2 class="fw-normal">Architecture</h2>
    <p class="column-text">Ancient Indian architecture is marked by grand temples, intricate carvings, and monumental stupas. Reflecting diverse cultural influences, structures like the Ajanta Caves and the Temples of Khajuraho exhibit both spiritual significance and architectural brilliance.</p>
    
  </div><!-- /.col-lg-4 -->
  <div class="col-lg-4">
    <img class="bd-placeholder-img rounded-circle" width="140" height="140" src="images/homepillar3.jpeg" alt="Description of Image 3">
    <h2 class="fw-normal">Painting</h2>
    <p class="column-text">Ancient Indian painting art includes vibrant frescoes of Ajanta, detailed miniatures, and folk styles like Madhubani. These paintings often depict mythological narratives, royal life, and nature, showcasing a rich tapestry of color and spirituality.</p>
   
  </div><!-- /.col-lg-4 -->
</div>




<!-- /END THE FEATURETTES -->
<hr class="featurette-divider">
<div class="row featurette">
  <div class="col-md-7 d-flex flex-column justify-content-center">
    <h2 class="featurette-heading fw-normal lh-1">Explore collaborative arts <span class="text-body-secondary">It’ll blow your mind.</span></h2>
    <p class="lead">"Art is the mirror of the soul. Through it, one can see one's own reflection and the divine intertwined." </p>
  </div>
  <div class="col-md-5">
    <img class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" src="images/mugu.jpeg" alt="Art Display">
  </div>
</div>

<hr class="featurette-divider">

<div class="row featurette">
  <div class="col-md-7 order-md-2 d-flex flex-column justify-content-center">
    <h2 class="featurette-heading fw-normal lh-1">Oh yeah, it’s that good. <span class="text-body-secondary">See for yourself.</span></h2>
    <p class="lead">"Be so good they can't ignore you."</p>
  </div>
  <div class="col-md-5">
    <img class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" src="images/homeart3.jpeg" alt="Art Display">
  </div>
</div>

<hr class="featurette-divider">

<div class="row featurette">
  <div class="col-md-7 d-flex flex-column justify-content-center">
    <h2 class="featurette-heading fw-normal lh-1">Let the right people know you’re open to work <span class="text-body-secondary">Checkmate.</span></h2>
    <p class="lead">"Opportunities don't happen, you create them."</p>
  </div>
  <div class="col-md-5">
    <img class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" src="images/mandelaart.jpeg" alt="Art Display">
  </div>
</div>

<hr class="featurette-divider">



<section class="py-3 py-md-5">
  <div class="container">
    <div class="row gy-3 gy-md-4 gy-lg-0 align-items-lg-center">
      <div class="col-12 col-lg-6 col-xl-5">
        <img class="img-fluid rounded" loading="lazy" src="images/login.webp" alt="About 1">
      </div>
      <div class="col-12 col-lg-6 col-xl-7">
        <div class="row justify-content-xl-center">
          <div class="col-12 col-xl-11">
            <h2 class="mb-3">Who Are We?</h2>
            <p class="mb-5"><p class="column-text">Artistry Odyssey is a vibrant platform dedicated to showcasing the creative brilliance of artists from around the globe. Here, artists can display their unique artworks, ranging from paintings and sculptures to digital creations, reaching a wide audience of art enthusiasts. Join us in celebrating creativity and explore an array of stunning visual artistry on Artistry Odyssey, where every piece tells a story.</p></p>
            <div class="row gy-4 gy-md-0 gx-xxl-5X">
              <div class="col-12 col-md-6">
                <div class="d-flex">
                  <div>
                    <h2 class="h4 mb-3">Learn More</h2>
                  </div>
                </div>
              </div>
              <!-- Removed the second column with the fire icon -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>




  </div>
  
    <footer id="contact">
        <div class="social-icons">
            <a href="https://www.facebook.com" target="-blank"><i class="fab fa-facebook "></i></a>

            <a href="https://www.twitter.com" target="-blank"><i class="fab fa-twitter "></i></a>

            <a href="https://www.instagram.com" target="-blank"><i class="fab fa-instagram"></i></a>
        </div>
        <p>&copy;2024 Artistry Odayssey website. All Rights Reserved.</p>
    </footer> 
</body>
</html>