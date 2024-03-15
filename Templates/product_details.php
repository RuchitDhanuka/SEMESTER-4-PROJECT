<?php
session_start();
$username=$_SESSION['username'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productId = $_POST['productId'];

    $servername = "localhost";
    $username = "root";
    $password = "ruchit19";
    $database = "homehive";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if the user has an active cart
    $userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
    $activeCartQuery = "SELECT * FROM cart WHERE user_id = '$userId' AND status = 'active'";
    $activeCartResult = $conn->query($activeCartQuery);

    if ($activeCartResult->num_rows > 0) {
        // If an active cart exists, get its ID
        $cartRow = $activeCartResult->fetch_assoc();
        $cartId = $cartRow['cart_id'];
    } else {
        // If no active cart exists, create a new cart
        $createCartQuery = "INSERT INTO cart (user_id, status, created_at) VALUES ('$userId', 'active', NOW())";
        if ($conn->query($createCartQuery) === TRUE) {
            $cartId = $conn->insert_id;
        } else {
            echo "Error creating cart: " . $conn->error;
            exit();
        }
    }

    // Add the product to the cart
    $sql = "INSERT INTO cartitems (cart_id, item_id, quantity) VALUES ('$cartId', '$productId', 1)";
    if ($conn->query($sql) === TRUE) {
        header("Location: /SEMESTER 4 PROJECT/Templates/Cart.php");
        exit();
    } else {
        $errorMsg = "Error adding product to cart: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <link rel="stylesheet" href="/SEMESTER 4 PROJECT/Style/product_details_css.css">
    <link rel="stylesheet" href="/SEMESTER 4 PROJECT/Style/navbar3css.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
    <?php
    if (isset($_GET['id'])) {
        $product_id = $_GET['id'];

        $servername = "localhost";
        $username = "root";
        $password = "ruchit19";
        $database = "homehive";

        $conn = new mysqli($servername, $username, $password, $database);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM product WHERE product_id = $product_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
    ?>
            <div class="product-details">
                <div class="images">
                    <img src="<?php echo $row['product_image_url']; ?>" alt="Product Image" class="img-fluid">
                </div>
                <div class="info">
                    <h1 class="text-primary"><?php echo $row['product_name']; ?></h1>
                    <p class="lead">$<?php echo $row['product_price']; ?></p>
                    <h2 class="text-info">Features:</h2>
                    <ul class="features-list">
                        <li><?php echo $row['product_features']; ?></li>
                    </ul>
                    <h2 class="text-success">Description:</h2>
                    <p><?php echo $row['product_description']; ?></p>
                    <button class="add-to-cart" onclick="addToCart(<?php echo $_GET['id']; ?>)">Add to Cart</button>
                </div>
            </div>
    <?php
        } else {
            echo "Product not found.";
        }
    } else {
        echo "Invalid product ID.";
    }
    ?>
</div>
</body>
<script>
    function addToCart(productId) {
        $.ajax({
            type: 'POST',
            url: '/SEMESTER 4 PROJECT/Templates/add-to-cart.php',
            data: { productId: productId },
            success: function(response) {
                window.location.href = "/SEMESTER 4 PROJECT/Templates/Cart.php";
            },
            error: function(xhr, status, error) {
                console.error("Error adding product to cart:", error);
            }
        });
    }
</script>
</html>
