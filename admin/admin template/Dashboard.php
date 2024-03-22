<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Premium Admin Dashboard</title>
    <link rel="stylesheet" href="/SEMESTER 4 PROJECT/Style/navbar1css.css">
    <link rel="stylesheet" href="/SEMESTER 4 PROJECT/admin/admin style/Dashboard.css">
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
    <br><br>
    <div class="container">
        <div class="kpi-container">
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "ruchit19";
        $dbname = "homehive";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql_orders = "SELECT COUNT(*) AS total_orders FROM orders";
        $sql_returns = "SELECT COUNT(*) AS total_returns FROM returnproduct";
        $sql_products = "SELECT COUNT(*) AS total_products FROM product";
        $sql_categories = "SELECT COUNT(*) AS total_categories FROM productcategory";

        $result_orders = $conn->query($sql_orders);
        $result_returns = $conn->query($sql_returns);
        $result_products = $conn->query($sql_products);
        $result_categories = $conn->query($sql_categories);

        if ($result_orders && $result_returns && $result_products && $result_categories) {
            $row_orders = $result_orders->fetch_assoc();
            $row_returns = $result_returns->fetch_assoc();
            $row_products = $result_products->fetch_assoc();
            $row_categories = $result_categories->fetch_assoc();

            // Display KPIs
            echo '<div class="kpi">
                      <h3>Total Orders</h3>
                      <p>' . $row_orders["total_orders"] . '</p>
                  </div>';

            echo '<div class="kpi">
                      <h3>Total Returns</h3>
                      <p>' . $row_returns["total_returns"] . '</p>
                  </div>';

            echo '<div class="kpi">
                      <h3>Total Products</h3>
                      <p>' . $row_products["total_products"] . '</p>
                  </div>';

            echo '<div class="kpi">
                      <h3>Total Categories</h3>
                      <p>' . $row_categories["total_categories"] . '</p>
                  </div>';
        } else {
            echo "Error fetching data: " . $conn->error;
        }

        $conn->close();
        ?>
        </div>

        <div class="button-container">
            <a href="/SEMESTER 4 PROJECT/admin/admin template/admin_addproduct.php" class="premium-button" id='add'>Add Product</a>
            <a href="/SEMESTER 4 PROJECT/admin/admin template/admin_deleteproduct.php" class="premium-button" id='delete'>Delete Product</a>
            <a href="/SEMESTER 4 PROJECT/admin/admin template/admin_product.php" class="premium-button" id='product'>Products Inventory</a>
            <a href="/SEMESTER 4 PROJECT/admin/admin template/Orders.php" class="premium-button" id='order'>Orders</a>
            <a href="/SEMESTER 4 PROJECT/admin/admin template/return.php" class="premium-button" id='return'>Return Orders</a>
        </div>
    </div>
</body>

</html>
