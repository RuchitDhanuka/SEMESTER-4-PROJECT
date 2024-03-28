<?php
session_start();
$username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Categories</title>
  <link rel="stylesheet" href="/SEMESTER 4 PROJECT/Style/categorycss.css">
  <link rel="stylesheet" href="/SEMESTER 4 PROJECT/Style/navbar3css.css">
  <link rel="stylesheet" href="/SEMESTER 4 PROJECT/Style/footer.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

</head>

<body>
  <header class="gradient-bg">
    <nav>
      <div class="logo">
      <a href="/SEMESTER 4 PROJECT/Templates/home_before_login.php">HomeHive</a>


      </div>
      <ul class="nav-links">
        <li><a href="/SEMESTER 4 PROJECT/Templates/home_before_login.php">Home</a></li>
        <li><a href="/SEMESTER 4 PROJECT/Templates/category_before_login.php">Categories</a></li>
        <li><a href="/SEMESTER 4 PROJECT/Templates/home_before_login.php">About Us</a></li>
      </ul>
      <div class="dropdown-container">
        <button class="dropdown-btn">Hello</button>
        <div class="dropdown-content">
          <a href="/SEMESTER 4 PROJECT/Templates/home_before_login.php"><img src="/SEMESTER 4 PROJECT/Assets/Icons/profile.png" alt="Profile Icon"> Hello, Profile</a>
          <a href="#"><img src="/SEMESTER 4 PROJECT/Templates/home_before_login.php" alt="Cart Icon"> Cart</a>
          <a href="/SEMESTER 4 PROJECT/Templates/UserloginFinal.php"><img src="/SEMESTER 4 PROJECT/Assets/Icons/logout.png" alt="Logout Icon"> Login</a>
        </div>
      </div>
    </nav>
  </header>
  <br><br><br><br>
  <main class="options-container" ">
    <a href=" /SEMESTER 4 PROJECT/Templates/home_before_login.php" class="option-link furniture">
    <div class="option">
      <h2>Home Appliances</h2>
    </div>
    </a>
    <a href="/SEMESTER 4 PROJECT/Templates/home_before_login.php" class="option-link appliances">
      <div class="option">
        <h2>Furniture</h2>
      </div>
    </a>
    <a href="/SEMESTER 4 PROJECT/Templates/home_before_login.php" class="option-link kitchen">
      <div class="option">
        <h2>Kitchen Appliances</h2>
      </div>
    </a>
  </main>
  <footer class="footer">
    <div class="footer-section">
      <h3>Contact Us</h3>
      <p>Email: <a href="mailto:homehive63@gmail.com">homehive63@gmail.com</a></p>
      <p>Phone: +91 6000924957</p>
    </div>
    <div class="footer-section">
      <h3>Address</h3>
      <a href="https://maps.app.goo.gl/PkYb64D4FGqjMQUU9">
        <p>SG Palya,</p>
      </a>
      <a href="https://maps.app.goo.gl/PkYb64D4FGqjMQUU9">
        <p>Bangalore, Karnataka</p>
      </a>
    </div>
    <div class="footer-section">
      <h3>Follow Us</h3>
      <div class="social-icons">
        <a href="https://www.facebook.com/" class="social-icon"><i class="fab fa-facebook"></i></a>
        <a href="https://twitter.com/" class="social-icon"><i class="fab fa-twitter"></i></a>
        <a href="https://www.instagram.com/" class="social-icon"><i class="fab fa-instagram"></i></a>
      </div>
    </div>
    <div class="footer-section">
      <h3>Explore</h3>
      <p><a href="">Terms of Services</a></p>
      <p><a href="/SEMESTER 4 PROJECT/Templates/contactus.php">Contact Us</a></p>
    </div>
  </footer>
</body>

</html>