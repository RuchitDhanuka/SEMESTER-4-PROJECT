<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['cart_id'])) {
    $productId = $_POST['productId'];
    $cartId = $_SESSION['cart_id'];

    $servername = "localhost";
    $username = "root";
    $password = "ruchit19";
    $database = "homehive";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $checkQuery = "SELECT * FROM cartitems WHERE cart_id = '$cartId' AND item_id = '$productId'";
    $checkResult = $conn->query($checkQuery);

    if ($checkResult->num_rows > 0) {
        $updateQuery = "UPDATE cartitems SET quantity = quantity + 1 WHERE cart_id = '$cartId' AND item_id = '$productId'";
        if ($conn->query($updateQuery) === TRUE) {
            updateCartTotal($conn, $cartId); 
            updateLastModified($conn, $cartId);
            header("Location: /SEMESTER 4 PROJECT/Templates/Categories.php");
            exit();
        } else {
            echo "Error updating cart: " . $conn->error;
        }
    } else {
        $insertQuery = "INSERT INTO cartitems (cart_id, item_id, quantity, created_at) VALUES ('$cartId', '$productId', 1, NOW())";
        if ($conn->query($insertQuery) === TRUE) {
            updateCartTotal($conn, $cartId);
            updateLastModified($conn, $cartId);
            header("Location: /SEMESTER 4 PROJECT/Templates/Categories.php");
            exit();
        } else {
            echo "Error adding product to cart: " . $conn->error;
        }
    }
}

function updateCartTotal($conn, $cartId) {
    $totalQuery = "SELECT SUM(product.product_price * cartitems.quantity) AS total FROM product JOIN cartitems ON product.product_id = cartitems.item_id WHERE cartitems.cart_id = '$cartId'";
    $totalResult = $conn->query($totalQuery);
    
    if ($totalResult->num_rows > 0) {
        $totalRow = $totalResult->fetch_assoc();
        $totalPrice = $totalRow['total'];

        $updateCartQuery = "UPDATE cart SET cart_total = '$totalPrice' WHERE cart_id = '$cartId'";
        if ($conn->query($updateCartQuery) !== TRUE) {
            echo "Error updating cart total: " . $conn->error;
        }
    }
}

function updateLastModified($conn, $cartId) {
    $updateQuery = "UPDATE cart SET last_modified = NOW() WHERE cart_id = '$cartId'";
    if ($conn->query($updateQuery) !== TRUE) {
        echo "Error updating last modified timestamp: " . $conn->error;
    }
}
?>
