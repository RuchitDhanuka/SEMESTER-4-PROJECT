<?php
$error = "";
$success_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost"; 
    $username = "root"; 
    $password = "ruchit19";  
    $database = "homehive"; 
    
    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if (isset($_POST['productId']) && isset($_POST['category']) && isset($_POST['productName']) && isset($_POST['productPrice']) && isset($_POST['productQuantity']) && isset($_POST['productFeatures']) && isset($_POST['productDescription']) && isset($_POST['productImage'])) {
        $productId = $_POST['productId'];
        $categoryName = $_POST['category'];
        $productName = $_POST['productName'];
        $productPrice = $_POST['productPrice'];
        $productQuantity = $_POST['productQuantity'];
        $productFeatures = $_POST['productFeatures'];
        $productDescription = $_POST['productDescription'];
        $productImage = $_POST['productImage'];

        $categorySql = "SELECT category_id FROM productcategory WHERE category_name='$categoryName'";
        $categoryResult = $conn->query($categorySql);
        if ($categoryResult && $categoryResult->num_rows > 0) {
            $row = $categoryResult->fetch_assoc();
            $categoryId = $row['category_id'];

            $productSql = "INSERT INTO product (product_id, category_id, product_name, product_price, product_description, product_features, product_image_url) VALUES ('$productId', '$categoryId', '$productName', '$productPrice', '$productDescription', '$productFeatures', '$productImage')";
            if ($conn->query($productSql) === TRUE) {
                $inventorySql = "INSERT INTO productinventory (product_id, product_quantity, last_modified) VALUES ('$productId', '$productQuantity', NOW())";
                if ($conn->query($inventorySql) === TRUE) {
                    $success_message = "Product added successfully";
                } else {
                    $error = "Error inserting into productinventory table: " . $conn->error;
                }
            } else {
                $error = "Error inserting into product table: " . $conn->error;
            }
        } else {
            $error = "Invalid category name";
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
    <link rel="stylesheet" href="/SEMESTER 4 PROJECT/admin/admin style/admin_addproduct.css">
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
    <section id="addProduct">
      <h2>Add Product</h2>
      <?php if ($success_message): ?>
      <div class="success"><?php echo $success_message; ?></div>
      <?php endif; ?>
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" id="addProductForm" onsubmit="return validateAddForm()" method="POST">
          <input type="text" id="productId" name="productId" required placeholder="Product ID">

          <input type="text" id="category" name="category" required placeholder="Category (Furniture/Home Appliance/Kitchen Appliance)">

          <input type="text" id="productName" name="productName" required placeholder="Product Name:">

          <input type="number" id="productPrice" name="productPrice" placeholder="Product Price:" required>

          <input type="number" id="productQuantity" name="productQuantity" placeholder="Product Quantity:" required>

          <input type="text" id="productFeatures" name="productFeatures" required placeholder="Product Features (comma-separated):">

          <textarea id="productDescription" name="productDescription" required placeholder="Product Description:"></textarea>

          <input type="text" id="productImage" name="productImage" placeholder="Enter image URL">

          <button type="submit">Add Product</button>
      </form>
      <div class="error"><?php echo $error; ?></div>
  </section>
  <script src="/SEMESTER 4 PROJECT/admin/admin javascript/admin_product_js.js"></script>
    
</body>
</html>
