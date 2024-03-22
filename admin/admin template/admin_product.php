<?php
$servername = "localhost";
$username = "root";
$password = "ruchit19";
$dbname = "homehive";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$selectedCategory = $_GET['category'] ?? 'all';
$sql = "SELECT p.product_name, pc.category_name, p.product_price, pi.product_quantity, p.product_features, p.product_image_url 
        FROM product AS p 
        INNER JOIN productinventory AS pi ON p.product_id = pi.product_id 
        INNER JOIN productcategory AS pc ON p.category_id = pc.category_id";

if ($selectedCategory !== 'all') {
    $sql .= " WHERE pc.category_name = '$selectedCategory'";
}

$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="/SEMESTER 4 PROJECT/admin/admin style/admin_product_css.css">
    <link rel="stylesheet" href="/SEMESTER 4 PROJECT/Style/navbar1css.css">
</head>
    <style>

    </style>
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

    <div class="container">
        <h1>Product Details</h1>
        <div class="search-container">
            <input type="text" id="searchInput" class="search-input" placeholder="Search for products...">
            <button onclick="searchProducts()" class="search-button">Search</button>
        </div>

        <div class="dropdown-container">
            <select id="category-select">
                <option value="all">All Categories</option>
                <option value="Furniture">Furniture</option>
                <option value="Home Appliance">Home Appliance</option>
                <option value="Kitchen Appliance">Kitchen Appliance</option>
            </select>
        </div>

        <table class="product-table">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Features</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . $row['product_name'] . '</td>';
                        echo '<td>' . $row['category_name'] . '</td>';
                        echo '<td>' . $row['product_price'] . '</td>';
                        echo '<td>' . $row['product_quantity'] . '</td>';
                        echo '<td>' . $row['product_features'] . '</td>';
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="5">No products found.</td></tr>';
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>

</body>
<script src="/SEMESTER 4 PROJECT/admin/admin javascript/admin_productlisting.js"></script>
</html>
