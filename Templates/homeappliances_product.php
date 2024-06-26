<?php
session_start();
$username=$_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Home Appliance</title>
  <link rel="stylesheet" href="/SEMESTER 4 PROJECT/Style/navbar3css.css">
  <link rel="stylesheet" href="/SEMESTER 4 PROJECT/Style/footer.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="/SEMESTER 4 PROJECT/Style/homeappliances_product_css.css">
  <link rel="stylesheet" href="/SEMESTER 4 PROJECT/Style/sortingcss.css">


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

  <section class="image-slider">
    <div class="image-container">
      <img src="/SEMESTER 4 PROJECT/Assets/Home appliances images/home2.jpg" alt="Furniture Image 1">
      <img src="/SEMESTER 4 PROJECT/Assets/Home appliances images/ha1.jpg" alt="Furniture Image 1">
      <img src="/SEMESTER 4 PROJECT/Assets/Home appliances images/ha3.jpg" alt="Furniture Image 1">
      <img src="/SEMESTER 4 PROJECT/Assets/Home appliances images/ha4.jpg" alt="Furniture Image 1">
      <img src="/SEMESTER 4 PROJECT/Assets/Home appliances images/ha6.jpg" alt="Furniture Image 1">
      <img src="/SEMESTER 4 PROJECT/Assets/Home appliances images/ha9.jpg" alt="Furniture Image 1">
      <img src="/SEMESTER 4 PROJECT/Assets/Home appliances images/ha11.jpg" alt="Furniture Image 1">
    </div>
  </section>
  <br>
  <h1 class="section-heading">Home Appliances</h1>
  <div class="search-container">
    <input type="text" id="searchInput" class="search-input" placeholder="Search for products...">
    <button onclick="searchProducts()" class="search-btn"><i class="fas fa-search"></i></button>
  </div>
  <div class="sorting-container">
    <select id="sorting" onchange="sortProducts(this)">
      <option value="">Sort By Price</option>
      <option value="asc">Price Low to High</option>
      <option value="desc">Price High to Low</option>
    </select>
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

    $sortOrder = isset($_GET['sort']) ? $_GET['sort'] : '';

    $sortSql = '';
    if ($sortOrder === 'asc') {
      $sortSql = 'ORDER BY product_price ASC';
    } elseif ($sortOrder === 'desc') {
      $sortSql = 'ORDER BY product_price DESC';
    }

    $sql = "SELECT * FROM product WHERE category_id=2 $sortSql";
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
            <p class="price">$<?php echo $row['product_price']; ?></p>
            <br>
            <a href="product_details.php?id=<?php echo $row['product_id']; ?>" class="button">View Details</a>
          </div>
        </div>
    <?php
      }
    } else {
      echo "No products found.";
    }
    ?>
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
<script src="/SEMESTER 4 PROJECT/javascript/imagechange.js"></script>
<script src="/SEMESTER 4 PROJECT/javascript/sorting.js"></script>
<script src="/SEMESTER 4 PROJECT/javascript/searchproduct.js"></script>
</body>

</html>