<?php
session_start();

if (!isset($_SESSION['userid'])) {
    header("Location: /SEMESTER 4 PROJECT/Templates/UserLoginFinal.php");
    exit();
}
$username=$_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Addresses</title>
    <link rel="stylesheet" href="/SEMESTER 4 PROJECT/Style/navbar3css.css">
    <link rel="stylesheet" href="/SEMESTER 4 PROJECT/Style/SelectAddress_css.css">
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
        <?php
        $userid = $_SESSION['userid'];

        $servername = "localhost";
        $username = "root";
        $password = "ruchit19";
        $database = "homehive";

        $conn = new mysqli($servername, $username, $password, $database);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM useraddress WHERE user_id = $userid";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
        ?>
                <div class="card">
                    <h3>Address</h3>
                    <p><?php echo $row['address_line1']; ?></p>
                    <p><?php echo $row['address_line2']; ?></p>
                    <p><?php echo $row['city'] . ', ' . $row['state'] . ', ' . $row['postal_code']; ?></p>
                    <p><?php echo $row['country']; ?></p>
                    <!-- Form to select the address -->
                    <form action="/SEMESTER 4 PROJECT/Templates/Cart.php" method="POST">
                        <input type="hidden" name="selected_address" value="<?php echo $row['address_id']; ?>">
                        <button type="submit">Select Address</button>
                    </form>
                </div>
        <?php
            }
        } else {
            echo "No addresses found.";
        }

        $conn->close();
        ?>
    </div>
</body>

</html>
