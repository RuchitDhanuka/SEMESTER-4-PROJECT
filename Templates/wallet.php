<?php
session_start();
$user = $_SESSION['username'];

$servername = "localhost";
$username = "root";
$password = "ruchit19"; 
$database = "homehive";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_id = $_SESSION['userid'];
$sql = "SELECT balance FROM userwallet WHERE user_id = $user_id";
$result = $conn->query($sql);

$balance = 0; 
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $balance = $row['balance'];
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wallet Balance</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="/SEMESTER 4 PROJECT/Style/navbar3css.css">
    <link rel="stylesheet" href="/SEMESTER 4 PROJECT/Style/walletcss.css">
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
                <button class="dropdown-btn"><?php echo ucfirst($user); ?></button>
                <div class="dropdown-content">
                    <a href="/SEMESTER 4 PROJECT/Templates/Profile.php"><img src="/SEMESTER 4 PROJECT/Assets/Icons/profile.png" alt="Profile Icon"> Hello, <?php echo ucfirst($user); ?></a>
                    <a href="/SEMESTER 4 PROJECT/Templates/Cart.php"><img src="/SEMESTER 4 PROJECT/Assets/Icons/cart.png" alt="Cart Icon"> Cart</a>
                    <a href="/SEMESTER 4 PROJECT/Templates/home_before_login.php"><img src="/SEMESTER 4 PROJECT/Assets/Icons/logout.png" alt="Logout Icon"> Logout</a>
                </div>
            </div>
        </nav>
    </header>
    <div class="container">
        <h1>Wallet Balance</h1>
        <div class="wallet">
            <img class="wallet-icon" src="/SEMESTER 4 PROJECT/Assets/Icons/wallet.png" alt="Wallet">
        </div>
        <div class="wallet-balance">
            <p>Your current balance:</p>
            <p class="balance">$<?php echo number_format($balance, 2); ?></p>
        </div>
    </div>
</body>

</html>
