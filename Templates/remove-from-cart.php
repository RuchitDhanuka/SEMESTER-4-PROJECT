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

    $deleteQuery = "DELETE FROM cartitems WHERE cart_id = '$cartId' AND item_id = '$productId'";
    if ($conn->query($deleteQuery) === TRUE) {
        echo "success"; 
    } else {
        echo "Error removing item from cart: " . $conn->error;
    }

    $conn->close();
}
?>
