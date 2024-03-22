<?php
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "ruchit19";
    $database = "homehive";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if (isset($_POST['deleteProductId'])) {
        $productId = $_POST['deleteProductId'];

        $deleteInventorySql = "DELETE FROM productinventory WHERE product_id = '$productId'";
        if ($conn->query($deleteInventorySql) === TRUE) {
            $deleteProductSql = "DELETE FROM product WHERE product_id = '$productId'";
            if ($conn->query($deleteProductSql) === TRUE) {
                if ($conn->affected_rows == 0) {
                    $error = "Product with ID $productId does not exist.";
                } else {
                    $error = "Product deleted successfully";
                }
            } else {
                $error = "Error deleting from product table: " . $conn->error;
            }
        } else {
            $error = "Error deleting from productinventory table: " . $conn->error;
        }
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/SEMESTER 4 PROJECT/Style/navbar1css.css">
    <link rel="stylesheet" href="/SEMESTER 4 PROJECT/admin/admin style/admin_deleteproduct.css">
</head>

<body>
    <header class="gradient-bg">
        <nav>
            <div class="logo">
                <a href="#">HomeHive</a>
            </div>
            <ul class="nav-links">
            <li><a href="/SEMESTER 4 PROJECT/admin/admin template/Dashboard.php">DASHBOARD</a></li>

            </ul>
            <div class="auth-links">
                <a href="/SEMESTER 4 PROJECT/admin/admin template/AdminLoginFinal.php" class="login-btn">LogOut</a>
            </div>
        </nav>
    </header>
    <section id="deleteProduct">
        <h2>Delete Product</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" id="deleteProductForm" onsubmit="return validateDeleteForm()" method="POST">
            <input type="text" id="deleteProductId" name="deleteProductId" placeholder="Product ID:" required>
            <button type="submit">Delete Product</button>
        </form>
        <div class="error"><?php echo $error; ?></div>
    </section>
    <script src="/SEMESTER 4 PROJECT/admin/admin javascript/admin_product_js.js"></script>
</body>

</html>