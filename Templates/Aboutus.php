<?php
session_start();
$username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About Us</title>
  <link rel="stylesheet" href="/SEMESTER 4 PROJECT/Style/Aboutus_css.css">
  <link rel="stylesheet" href="/SEMESTER 4 PROJECT/Style/navbar3css.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>
<header class="gradient-bg">
    <nav>
      <div class="logo">
        <a href="/Templates/home_after_login.php">HomeHive</a>
      </div>
      <ul class="nav-links">
        <li><a href="/SEMESTER 4 PROJECT/Templates/home_after_login.php">Home</a></li>
        <li><a href="/SEMESTER 4 PROJECT/Templates/Categories.php">Categories</a></li>
        <li><a href="/SEMESTER 4 PROJECT/Templates/Aboutus.php">About Us</a></li>
      </ul>
      <div class="dropdown-container">
        <button class="dropdown-btn"><?php echo ucfirst($username); ?></button>
        <div class="dropdown-content">
          <a href="/SEMESTER 4 PROJECT/Templates/Profile.php"><img src="/SEMESTER 4 PROJECT/Assets/Icons/profile.png" alt="Profile Icon"> Hello, <?php echo ucfirst($username); ?></a>
          <a href="/SEMESTER 4 PROJECT/Templates/Cart.php"><img src="/SEMESTER 4 PROJECT/Assets/Icons/cart.png" alt="Cart Icon"> Cart</a>
          <a href="/SEMESTER 4 PROJECT/Templates/home_before_login.php"><img src="/SEMESTER 4 PROJECT/Assets/Icons/logout.png" alt="Logout Icon"> Logout</a>
        </div>
      </div>
    </nav>
  </header>
  <div class="container">
    <div class="company-section">
      <div class="company-info">
        <div class="company-image">
          <img src="/SEMESTER 4 PROJECT/Assets/Icons/Logo (2).png" alt="Company Image">
        </div>
        <br><br>
        <div class="company-details">
          <h1>Our Company</h1>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Non aliquam quisquam temporibus expedita nemo maiores dolores perferendis eveniet, repellendus sapiente Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste, atque. Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus cum rerum inventore atque optio, iste, vitae consequatur nam quas, excepturi voluptatum earum suscipit laudantium mollitia. Atque perferendis, voluptatem eum officiis ad quisquam, iure tempora saepe quidem cum harum nobis tempore reiciendis laborum veniam minima a. Beatae omnis earum deserunt unde.</p>
        </div>
      </div>
    </div>
    <div class="contact-info">
      <h2>Contact Information</h2>
      <p><i class="fas fa-phone"></i> Phone: 91 6000924957</p>
      <p><i class="far fa-envelope"></i> Email: <a href="mailto:homehive63@gmail.com">homehive63@gmail.com</a></p>
      <p><i class="fas fa-map-marker-alt"></i>  Sg Palya , Bangalore </p>
    </div>
    <h2 class="team-heading">Our Team Members</h2>
    <div class="team-members">
      <div class="team-member">
        <img src="/SEMESTER 4 PROJECT/Assets/Team/WhatsApp Image 2024-02-04 at 13.44.51_5884cf38.jpg" alt="Team Member 1">
        <div class="social-icons">
          <a href="#"><i class="fab fa-google"></i></a>
          <a href="#"><i class="fab fa-twitter"></i></a>
          <a href="#"><i class="fab fa-instagram"></i></a>
          <a href="#"><i class="fab fa-linkedin"></i></a>
        </div>
      </div>
      <div class="team-member">
        <img src="/SEMESTER 4 PROJECT/Assets/Team/IMG_20231204_153228_710~2.jpg" alt="Team Member 2">
        <div class="social-icons">
          <a href="#"><i class="fab fa-google"></i></a>
          <a href="#"><i class="fab fa-twitter"></i></a>
          <a href="#"><i class="fab fa-instagram"></i></a>
          <a href="#"><i class="fab fa-linkedin"></i></a>
        </div>
      </div>
      <div class="team-member">
        <img src="/SEMESTER 4 PROJECT/Assets/Team/Screenshot_20240220-144237.png" alt="Team Member 3">
        <div class="social-icons">
          <a href="#"><i class="fab fa-google"></i></a>
          <a href="#"><i class="fab fa-twitter"></i></a>
          <a href="#"><i class="fab fa-instagram"></i></a>
          <a href="#"><i class="fab fa-linkedin"></i></a>
        </div>
      </div>
    </div>
    <div class="contact-button">
      <a href="/SEMESTER 4 PROJECT/Templates/contactus.php"><button>Contact Us</button></a>
    </div>
  </div>
</body>

</html>
