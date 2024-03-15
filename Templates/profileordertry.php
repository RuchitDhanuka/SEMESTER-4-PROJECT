<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "ruchit19";
$database = "homehive";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!isset($_SESSION['user_id'])) {
    header("Location: /SEMESTER 4 PROJECT/Templates/home_before_login.php");
    exit();
}

$userId = $_SESSION['userid'];

$inactiveCartQuery = "SELECT * FROM cart WHERE user_id = '$userId' AND status = 'inactive'";
$inactiveCartResult = $conn->query($inactiveCartQuery);

?>

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
        <h1>Your Orders</h1>
        <?php
        if ($inactiveCartResult->num_rows > 0) {
            while ($inactiveCartRow = $inactiveCartResult->fetch_assoc()) {
                $cartId = $inactiveCartRow['cart_id'];
                $_SESSION['cart_id'] = $cartId;

                echo "<h2>Cart ID: $cartId</h2>";

                // Fetch products in this cart
                $productQuery = "SELECT ci.quantity, p.* FROM cartitems ci JOIN product p ON ci.item_id = p.product_id WHERE ci.cart_id = '$cartId'";
                $productResult = $conn->query($productQuery);

                if ($productResult->num_rows > 0) {
                    while ($productRow = $productResult->fetch_assoc()) {
                        echo "<div class='product-card'>";
                        echo "<img src='" . $productRow['product_image_url'] . "' alt='Product Image'>";
                        echo "<div class='product-details'>";
                        echo "<h3>" . $productRow['product_name'] . "</h3>";
                        echo "<br>";
                        echo "<p class='price'>$" . $productRow['product_price'] . "</p>";
                        echo "<br>";
                        echo "<p>Qty: " . $productRow['quantity'] . "</p>";
                        echo "</div>";
                        echo "<form method='POST' action=''>";
                        echo "<input type='hidden' name='removeProductId' value='" . $productRow['product_id'] . "'>";
                        echo "<button type='submit' class='remove-item-btn'>Return Item</button>";
                        echo "</form>";
                        echo "</div>";
                    }
                } else {
                    echo "No products found in this cart.";
                }
            }
        } else {
            echo "No inactive carts found.";
        }
        ?>
    </div>

</body>

</html>

<?php
$conn->close();
?>
