<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders List</title>
    <link rel="stylesheet" href="/SEMESTER 4 PROJECT/Style/navbar1css.css">
    <link rel="stylesheet" href="/SEMESTER 4 PROJECT/admin/admin style/orders.css">
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
    <div class="container">
        <h1>Orders List</h1>
        <!-- <div class="premium">Orders</div> -->
        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>User Name</th>
                    <th>Amount</th>
                    <th>Placed at</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "ruchit19";
                $database = "homehive";

                $conn = new mysqli($servername, $username, $password, $database);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT orders.order_id, userlogin.user_name, cart.cart_total,orders.placed_at 
                        FROM orders 
                        INNER JOIN cart ON orders.cart_id = cart.cart_id 
                        INNER JOIN userlogin ON orders.user_id = userlogin.user_id";
                $result = $conn->query($sql);

                if ($result === false) {
                    die("Error executing query: " . $conn->error);
                }

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["order_id"] . "</td>";
                        echo "<td>" . $row["user_name"] . "</td>";
                        echo "<td>$" . $row["cart_total"] . "</td>";
                        echo "<td>" . $row["placed_at"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>No orders found</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>
