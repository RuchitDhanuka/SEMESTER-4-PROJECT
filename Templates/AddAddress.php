<?php
session_start();

if (!isset($_SESSION['userid'])) {
    header("Location: /SEMESTER 4 PROJECT/Templates/UserLoginFinal.php");
    exit();
}

require '/xampp/htdocs/PHPMailer/Exception.php';
require '/xampp/htdocs/PHPMailer/PHPMailer.php';
require '/xampp/htdocs/PHPMailer/SMTP.php';

$user=$_SESSION['username'];
$errorMsg = "";
$successMsg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['addressline1']) && isset($_POST['addressline2']) && isset($_POST['city']) && isset($_POST['state']) && isset($_POST['zip']) && isset($_POST['country'])) {
        $addressline1 = $_POST['addressline1'];
        $addressline2 = $_POST['addressline2'];
        $city = $_POST['city'];
        $state = $_POST['state'];
        $zip = $_POST['zip'];
        $country = $_POST['country'];

        $userid = $_SESSION['userid'];

        $servername = "localhost";
        $username = "root";
        $password = "ruchit19";
        $database = "homehive";

        $conn = new mysqli($servername, $username, $password, $database);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "INSERT INTO useraddress (user_id, address_line1, address_line2, city, state, postal_code, country) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("issssds", $userid, $addressline1, $addressline2, $city, $state, $zip, $country);

        if ($stmt->execute()) {
            $successMsg = "Address added successfully!";
        } else {
            $errorMsg = "Error adding address: " . $conn->error;
        }

        $stmt->close();
        $conn->close();
    } else {
        $errorMsg = "All fields are required!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Address</title>
    <link rel="stylesheet" href="/SEMESTER 4 PROJECT/Style/navbar3css.css">
    <link rel="stylesheet" href="/SEMESTER 4 PROJECT/Style/AddAddress_css.css">
</head>

<body>
<header class="gradient-bg">
    <nav>
      <div class="logo">
        <a href="/Templates/home_after_login.php">HomeHive</a>
      </div>
      <ul class="nav-links">
        <li><a href="/SEMESTER 4 PROJECT/Templates/home_after_login.php">Home</a></li>
        <li><a href="/SEMESTER 4 PROJECT/Templates/Categories.php">Categories</a></li>
        <li><a href="/SEMESTER 4 PROJECT/Templates/Aboutus.php">About Us</a></li>
      </ul>
      <div class="dropdown-container">
        <button class="dropdown-btn"><?php echo ucfirst($user); ?></button>
        <div class="dropdown-content">
          <a href="/SEMESTER 4 PROJECT/Templates/Profile.php"><img src="/SEMESTER 4 PROJECT/Assets/Icons/profile.png" alt="Profile Icon"> Hello, <?php echo ucfirst($user); ?></a>
          <a href="/SEMESTER 4 PROJECT/Templates/Cart.php"><img src="/SEMESTER 4 PROJECT/Assets/Icons/cart.png" alt="Cart Icon"> Cart</a>
          <a href="/SEMESTER 4 PROJECT/Templates/home_before_login.php"><img src="/SEMESTER 4 PROJECT/Assets/Icons/logout.png" alt="Logout Icon"> Logout</a>
        </div>
      </div>
    </nav>
  </header>
    <div class="address-form-container">
        <h2>Enter Your Address</h2>
        <?php if (!empty($successMsg)) { ?>
            <div class="success-message"><?php echo $successMsg; ?></div>
        <?php } ?>
        <?php if (!empty($errorMsg)) { ?>
            <div class="error-message"><?php echo $errorMsg; ?></div>
        <?php } ?>
        <form id="addressForm" method="POST">
            <div class="form-group">
                <input type="text" id="addressline1" name="addressline1" placeholder="Enter Flat No, Building Name"
                    required>
            </div>
            <div class="form-group">
                <input type="text" id="addressline2" name="addressline2" placeholder="Enter Street Name,Locality Name"
                    required>
            </div>

            <div class="form-group">
                <input type="text" id="city" name="city" placeholder="Enter City" required>
            </div>

            <div class="form-group">
                <input type="text" id="state" name="state" placeholder="Enter State" required>
            </div>

            <div class="form-group">
                <input type="text" id="zip" name="zip" placeholder="Enter Postal Code" required>
            </div>
            <div class="form-group">
                <input type="text" id="country" name="country" placeholder="Enter Country" required>
            </div>

            <button type="submit" class="submit-btn">Submit</button>
        </form>
    </div>

</body>
<script src="/SEMESTER 4 PROJECT/javascript/AddAddress.js"></script>

</html>
