<?php 
session_start();
$username=$_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Home</title>
  <link rel="stylesheet" href="/SEMESTER 4 PROJECT/Style/navbar3css.css">
  <link rel="stylesheet" href="/SEMESTER 4 PROJECT/Style/footer.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="/SEMESTER 4 PROJECT/Style/home_after_login_css.css">

</head>

<body>
  <header class="gradient-bg">
    <nav>
      <div class="logo">
      <a href="/SEMESTER 4 PROJECT/Templates/home_after_login.php">HomeHive</a>
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
  <div class="main-title">
    <div class="left-content">
      <h1>Discover Quality Living with HomeHive</h1>
      <p>Explore a curated selection of premium furniture and home essentials.</p>
    </div>
    <div class="right-content">
      <img src="/SEMESTER 4 PROJECT/Assets/HomePageImages/familyhome.png" alt="Main Title Image">
    </div>
  </div>
  <br><br><br><br><br><br><br>
  <div class="exclusive">
    <h2>Exclusive Products</h2>
  </div>
  <br>
  <div class="product-category">
    <h2>Kitchen Appliances</h2>
  </div>
  <div class="container">
    <?php

    $servername = "localhost";
    $username = "root";
    $password = "ruchit19";
    $database = "homehive";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT p.product_id, p.product_name, p.product_image_url
    FROM product p
    JOIN productcategory pc ON p.category_id = pc.category_id
    WHERE pc.category_id=3
    ORDER BY p.product_price DESC
    LIMIT 3";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
    ?>
        <div class="card">
          <div class="image">
            <img src="<?php echo $row['product_image_url']; ?>" alt="Product Image">
          </div>
          <div class="content">
            <h2><?php echo $row['product_name']; ?></h2>
          </div>
        </div>
    <?php
      }
    } else {
      echo "No products found.";
    }
    ?>
  </div>

  <div class="product-cards" id="kitchen-appliance">
    <div class="product-category">
      <h2>Furniture</h2>
    </div>
    <div class="container">
      <?php

      $servername = "localhost";
      $username = "root";
      $password = "ruchit19";
      $database = "homehive";

      $conn = new mysqli($servername, $username, $password, $database);

      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }

      $sql = "SELECT p.product_id, p.product_name, p.product_image_url
      FROM product p
      JOIN productcategory pc ON p.category_id = pc.category_id
      WHERE pc.category_id=1
      ORDER BY p.product_price DESC
      LIMIT 3";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
      ?>
          <div class="card">
            <div class="image">
              <img src="<?php echo $row['product_image_url']; ?>" alt="Product Image">
            </div>
            <div class="content">
              <h2><?php echo $row['product_name']; ?></h2>
            </div>
          </div>
      <?php
        }
      } else {
        echo "No products found.";
      }
      ?>
    </div>

  </div>
  <div class="product-cards" id="furniture">
    <div class="product-category">
      <h2>Home Appliance</h2>
    </div>
    <div class="container">
      <?php

      $servername = "localhost";
      $username = "root";
      $password = "ruchit19";
      $database = "homehive";

      $conn = new mysqli($servername, $username, $password, $database);

      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }

      $sql = "SELECT p.product_id, p.product_name, p.product_image_url
FROM product p
JOIN productcategory pc ON p.category_id = pc.category_id
WHERE pc.category_id=2
ORDER BY p.product_price DESC
LIMIT 3;
";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
      ?>
          <div class="card">
            <div class="image">
              <img src="<?php echo $row['product_image_url']; ?>" alt="Product Image">
            </div>
            <div class="content">
              <h2><?php echo $row['product_name']; ?></h2>
            </div>
          </div>
      <?php
        }
      } else {
        echo "No products found.";
      }
      ?>
    </div>

  </div>
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
      <p><a href="/SEMESTER 4 PROJECT/Templates/terms.php">Terms of Services</a></p>
      <p><a href="/SEMESTER 4 PROJECT/Templates/contactus.php">Contact Us</a></p>
    </div>
  </footer>

</body>

</html>