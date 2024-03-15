<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="/SEMESTER 4 PROJECT/Style/navbar3css.css">
  <link rel="stylesheet" href="/SEMESTER 4 PROJECT/Style/footer.css">
    <link rel="stylesheet" href="/SEMESTER 4 PROJECT/Style/cartcss.css">
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
        <button class="dropdown-btn">Hello</button>
        <div class="dropdown-content">
          <a href="/SEMESTER 4 PROJECT/Templates/Profile.php"><img src="/SEMESTER 4 PROJECT/Assets/Icons/profile.png" alt="Profile Icon"> Hello, Profile</a>
          <a href="/SEMESTER 4 PROJECT/Templates/Cart.php"><img src="/SEMESTER 4 PROJECT/Assets/Icons/cart.png" alt="Cart Icon"> Cart</a>
          <a href="/SEMESTER 4 PROJECT/Templates/home_before_login.php"><img src="/SEMESTER 4 PROJECT/Assets/Icons/logout.png" alt="Logout Icon"> Logout</a>
        </div>
      </div>
    </nav>
  </header>

    <div class="container">
        <h1>Your Shopping Cart</h1>

        <?php

        // Database connection parameters
        $servername = "localhost";
        $username = "root";
        $password = "ruchit19";
        $database = "homehive";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $database);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }


        // Fetch cart items from the database
        $sql = "SELECT * FROM cartitems";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Fetch product details based on item_id
                $productId = $row['item_id'];
                $productSql = "SELECT * FROM product WHERE product_id = $productId";
                $productResult = $conn->query($productSql);

                if ($productResult->num_rows > 0) {
                    $productRow = $productResult->fetch_assoc();
        ?>
                    <div class="product-card">
                        <img src="<?php echo $productRow['product_image_url']; ?>" alt="Product Image">
                        <div class="product-details">
                            <h3><?php echo $productRow['product_name']; ?></h3>
                            <p class="price">$<?php echo $productRow['product_price']; ?></p>
                            <p class="quantity-controls">
                                <button onclick="decrementQuantity(this)">-</button>
                                <span class="quantity"><?php echo $row['quantity']; ?></span>
                                <button onclick="incrementQuantity(this)">+</button>
                            </p>
                        </div>
                        <button class="remove-item-btn" onclick="removeItem(this)">Remove Item</button>
                    </div>
        <?php
                }
            }
        } else {
            echo "Your cart is empty.";
        }
        ?>
        <div class="total">
            <!-- Calculate total amount dynamically from cartitems table -->
            <?php
            // Fetch total amount from the database
            $totalSql = "SELECT SUM(product_price * quantity) AS total FROM product JOIN cartitems ON product.product_id = cartitems.item_id";
            $totalResult = $conn->query($totalSql);

            if ($totalResult->num_rows > 0) {
                $totalRow = $totalResult->fetch_assoc();
                echo "<p>Total Amount: $" . $totalRow['total'] . "</p>";
            }
            ?>
        </div>

        <!-- Add Address, Select Address, and Checkout buttons -->
        <a href="/SEMESTER 4 PROJECT/Templates/AddAddress.php"><button class="payment-btn">Add Address</button></a>
        <a href="/SEMESTER 4 PROJECT/Templates/SelectAddress.php"><button class="payment-btn">Select Address</button></a>
        <a href="/SEMESTER 4 PROJECT/Templates/PaymentGateway.php"><button class="payment-btn">Check Out</button></a>
    </div>
    <footer class="footer">
        <div class="footer-section">
            <h3>Contact Us</h3>
            <p>Email: <a href="mailto:HomeHive@gmail.com">HomeHive@gmail.com</a></p>
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
            <p>Terms of Service</p>
            <p>Privacy Policy</p>
        </div>
    </footer>
</body>
<script src="scripts.js"></script>

</html>