<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Return Orders</title>
    <link rel="stylesheet" href="/SEMESTER 4 PROJECT/admin/admin style/return.css">
    <link rel="stylesheet" href="/SEMESTER 4 PROJECT/Style/navbar1css.css">
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
        <h1>Return Orders</h1>
        <table>
            <thead>
                <tr>
                    <th>Return ID</th>
                    <th>User Name</th>
                    <th>Product Name</th>
                    <th>Amount</th>
                    <th>Refund Mode</th>
                    <th>Return Date</th>
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

                $sql = "SELECT rp.return_id, p.product_name, rp.amount, rp.refund_mode, rp.return_date, u.user_name
                        FROM returnproduct rp
                        INNER JOIN cartitems ci ON rp.cart_id = ci.cart_id
                        INNER JOIN product p ON ci.item_id = p.product_id
                        INNER JOIN userlogin u ON rp.user_id = u.user_id
                        WHERE ci.status = 'return'";

                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["return_id"] . "</td>";
                        echo "<td>" . $row["user_name"] . "</td>"; 
                        echo "<td>" . $row["product_name"] . "</td>";
                        echo "<td>$" . $row["amount"] . "</td>";
                        echo "<td>" . $row["refund_mode"] . "</td>";
                        echo "<td>" . $row["return_date"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No return orders found</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>
