<?php
session_start();
$username=$_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Order Placed</title>
  <link rel="stylesheet" href="/SEMESTER 4 PROJECT/Style/orderplaced_css.css">
  <link rel="stylesheet" href="/SEMESTER 4 PROJECT/Style/navbar3css.css">
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
    <img src="/SEMESTER 4 PROJECT/Assets/Icons/order_placed.png" alt="Checkmark Image" class="checkmark animated">
    <div class="message">
      <h1>Congratulations!</h1>
      <p>Your order has been successfully placed.</p>
    </div>
    <br><br>
    <a href="/SEMESTER 4 PROJECT/Templates/home_after_login.php" class="back-btn">Go Back to Home</a>
  </div>
</body>
</html>
