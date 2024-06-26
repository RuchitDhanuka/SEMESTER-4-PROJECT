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

if (!isset($_SESSION['userid'])) {
    header("Location: /SEMESTER 4 PROJECT/Templates/home_before_login.php");
    exit();
}
$user = $_SESSION['username'];
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
<style>
  .remove-item-btn{
    margin-left: 550px;
  }
  .product-returned{
    margin-left: 550px;
  }
</style>
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
                <button class="dropdown-btn"><?php echo ucfirst($user); ?></button>
                <div class="dropdown-content">
                    <a href="/SEMESTER 4 PROJECT/Templates/Profile.php"><img
                            src="/SEMESTER 4 PROJECT/Assets/Icons/profile.png" alt="Profile Icon"> Hello,
                        <?php echo ucfirst($user); ?></a>
                    <a href="/SEMESTER 4 PROJECT/Templates/Cart.php"><img
                            src="/SEMESTER 4 PROJECT/Assets/Icons/cart.png" alt="Cart Icon"> Cart</a>
                    <a href="/SEMESTER 4 PROJECT/Templates/home_before_login.php"><img
                            src="/SEMESTER 4 PROJECT/Assets/Icons/logout.png" alt="Logout Icon"> Logout</a>
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

                $productQuery = "SELECT ci.quantity, ci.status, p.* FROM cartitems ci JOIN product p ON ci.item_id = p.product_id WHERE ci.cart_id = '$cartId'";
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

                        if ($productRow['status'] === null) {
                            echo "<a href='/SEMESTER 4 PROJECT/Templates/refundoptions.php?productId=" . $productRow['product_id'] . "&cartId=" . $cartId . "' class='remove-item-btn' onclick='storeReturnDetails(" . $productRow['product_id'] . ", " . $cartId . ")'>Return Item</a>";
                        } else {
                            echo "<p class='product-returned'>Product Returned</p>";
                        }

                        echo "</div>";
                        echo "</div>";
                    }
                } else {
                    echo "No orders found.";
                }
            }
        } else {
            echo "";
        }
        ?>
    </div>

</body>

</html>
<script>
    function storeReturnDetails(productId, cartId) {
        sessionStorage.setItem('productId', productId);
        sessionStorage.setItem('cartId', cartId);
    }
</script>
<?php
$conn->close();
?>
