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
    header("Location: /SEMESTER 4 PROJECT/Templates/UserloginFinal.php");
    exit();
}

$username = $_SESSION['username'];
$userId = $_SESSION['userid'];

$activeCartQuery = "SELECT * FROM cart WHERE user_id = '$userId' AND status = 'active'";
$activeCartResult = $conn->query($activeCartQuery);

if ($activeCartResult->num_rows > 0) {
    $activeCartRow = $activeCartResult->fetch_assoc();
    $cartcode = $activeCartRow['cart_code'];
    $cartId = $activeCartRow['cart_id'];
    $sharedCartCode = $activeCartRow['shared_cart'];

    $_SESSION['cart_id'] = $cartId;
} else {
    $createCartQuery = "INSERT INTO cart (user_id, status, created_at) VALUES ('$userId', 'active', NOW())";
    if ($conn->query($createCartQuery) === TRUE) {
        $cartId = $conn->insert_id;
        $_SESSION['cart_id'] = $cartId;
    } else {
        echo "Error creating cart: " . $conn->error;
        exit();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['removeProductId'])) {
    $removeProductId = $_POST['removeProductId'];

    $removeProductQuery = "DELETE FROM cartitems WHERE cart_id = '$cartId' AND item_id = '$removeProductId'";
    if ($conn->query($removeProductQuery) !== TRUE) {
        echo "Error removing product from cart: " . $conn->error;
    }

    $updateTotalQuery = "UPDATE cart SET cart_total = (
        SELECT SUM(product_price * quantity) FROM product
        JOIN cartitems ON product.product_id = cartitems.item_id
        WHERE cartitems.cart_id = '$cartId'
    ) WHERE cart_id = '$cartId'";
    if ($conn->query($updateTotalQuery) !== TRUE) {
        echo "Error updating cart total: " . $conn->error;
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['selected_address']) && isset($_SESSION['cart_id'])) {
    $addressId = $_POST['selected_address'];
    $cartId = $_SESSION['cart_id'];

    $updateQuery = "UPDATE cart SET address_id = '$addressId' WHERE cart_id = '$cartId'";
    if ($conn->query($updateQuery) !== TRUE) {
        echo "Error updating cart with selected address: " . $conn->error;
    }
}

$addressSelected = false;
if (isset($_SESSION['cart_id'])) {
    $cartId = $_SESSION['cart_id'];
    $checkAddressQuery = "SELECT address_id FROM cart WHERE cart_id = '$cartId'";
    $checkAddressResult = $conn->query($checkAddressQuery);
    if ($checkAddressResult->num_rows > 0) {
        $cartRow = $checkAddressResult->fetch_assoc();
        if ($cartRow['address_id'] !== null) {
            $addressSelected = true;
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['clearSharedCart']) && isset($_SESSION['cart_id'])) {
    $cartId = $_SESSION['cart_id'];

    $clearSharedCartQuery = "UPDATE cart SET shared_cart = NULL WHERE cart_id = '$cartId'";
    if ($conn->query($clearSharedCartQuery) === TRUE) {
        $_SESSION['clearSharedCartMessage'] = "Cart unshared";
    } else {
        echo "Error clearing shared cart data: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="/SEMESTER 4 PROJECT/Style/navbar3css.css">
    <link rel="stylesheet" href="/SEMESTER 4 PROJECT/Style/footer.css">
    <link rel="stylesheet" href="/SEMESTER 4 PROJECT/Style/cartcss.css">
    <script>
        function refreshPage() {
            window.location.reload(true); // Reload the page
        }
    </script>
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
    <div class="container">
        <h1>Your Shopping Cart</h1>
        <br>
        <div class="otpcontainer">
            <p class='otp display'><?php echo 'Cart OTP:', $cartcode; ?></p>
            <?php if ($sharedCartCode !== NULL) {

                echo "Shared Cart:", $sharedCartCode;
            }
            ?>
            <br>
        </div>
        <form method="POST" action="" class="otpsubmit">
            <input type="text" name="cartOTP" placeholder="Enter OTP">
            <button type="submit" name="submitOTP">Submit</button>
            <button type="submit" name="clearSharedCart">X</button>
        </form>
        <div class="message-container">
            <?php
            if (isset($_SESSION['clearSharedCartMessage'])) {
                echo $_SESSION['clearSharedCartMessage'];
                unset($_SESSION['clearSharedCartMessage']);
            }
            ?>
        </div>

        <?php
        $activeCartQuery = "SELECT * FROM cart WHERE user_id = '$userId' AND status = 'active'";
        $activeCartResult = $conn->query($activeCartQuery);

        if ($activeCartResult->num_rows > 0) {
            $activeCartRow = $activeCartResult->fetch_assoc();
            $cartcode = $activeCartRow['cart_code'];
            $cartId = $activeCartRow['cart_id'];
            $sharedCartCode = $activeCartRow['shared_cart'];
        }
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submitOTP'])) {
            $submittedOTP = $_POST['cartOTP'];

            $checkOTPQuery = "SELECT * FROM cart WHERE cart_code = '$submittedOTP' and status='active'";
            $checkOTPResult = $conn->query($checkOTPQuery);

            if ($checkOTPResult->num_rows > 0 && $cartcode !== $submittedOTP) {

                echo "Cart is accessed!";
                $updateWrongOTPQuery = "UPDATE cart SET shared_cart = '$submittedOTP' WHERE cart_id = '$cartId'";
                if ($conn->query($updateWrongOTPQuery) !== TRUE) {
                    echo "Error updating cart with wrong OTP: " . $conn->error;
                }
            } else {
                echo "Wrong OTP entered. Please try again.";
            }
        }
        ?>
        <?php
        $sql = "SELECT * FROM cartitems WHERE cart_id = '$cartId'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $productId = $row['item_id'];
                $quantity = $row['quantity'];
                $productSql = "SELECT * FROM product WHERE product_id = $productId";
                $productResult = $conn->query($productSql);

                if ($productResult->num_rows > 0) {
                    $productRow = $productResult->fetch_assoc();
        ?>
                    <div class="product-card">
                        <img src="<?php echo $productRow['product_image_url']; ?>" alt="Product Image">
                        <div class="product-details">
                            <h3><?php echo $productRow['product_name']; ?></h3>
                            <br>
                            <p class="price">$<?php echo $productRow['product_price']; ?></p>
                            <br>
                            <p>Qty: <?php echo $quantity; ?></p>
                        </div>
                        <form method="POST" action="">
                            <input type="hidden" name="removeProductId" value="<?php echo $productId; ?>">
                            <button type="submit" class="remove-item-btn">Remove Item</button>
                        </form>
                    </div>
        <?php
                }
            }
        } else {
            echo "";
        }
        ?>
        <div class="total">
            <?php if ($result->num_rows > 0) : ?>
                <?php
                $totalSql = "SELECT SUM(product_price * quantity) AS total FROM product JOIN cartitems ON product.product_id = cartitems.item_id WHERE cartitems.cart_id = '$cartId'";
                $totalResult = $conn->query($totalSql);

                if ($totalResult->num_rows > 0) {
                    $totalRow = $totalResult->fetch_assoc();
                    echo "<p>Total Amount: $" . $totalRow['total'] . "</p>";
                }
                ?>
            <?php endif; ?>
        </div>

        <?php if ($result->num_rows > 0 && $sharedCartCode === null) : ?>
            <a href="/SEMESTER 4 PROJECT/Templates/AddAddress.php"><button class="payment-btn">Add Address</button></a>
            <a href="/SEMESTER 4 PROJECT/Templates/SelectAddress.php"><button class="payment-btn">Select Address</button></a>
            <?php if ($addressSelected) : ?>
                <a href="/SEMESTER 4 PROJECT/Templates/PaymentGateway.php"><button class="payment-btn">Check Out</button></a>
            <?php endif; ?>
        <?php else : ?>
            <p>Please add items to your cart or check shared cart.</p>
        <?php endif; ?>
    </div>

</body>

</html>