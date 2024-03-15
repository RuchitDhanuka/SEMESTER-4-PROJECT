<?php
session_start();

if (!isset($_SESSION['username'])) {
  header("Location: /SEMESTER 4 PROJECT/Templates/home_before_login.php");
  exit();
}
$servername = "localhost";
$username = "root";
$password = "ruchit19";
$database = "homehive";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$currentUsername = $_SESSION['username'];
$currentUserEmail = $_SESSION['email'];

$username=$_SESSION['username'];

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile</title>
  <link rel="stylesheet" href="/SEMESTER 4 PROJECT/Style/footer.css">
  <link rel="stylesheet" href="/SEMESTER 4 PROJECT/Style/Profilecss.css">
  <link rel="stylesheet" href="/SEMESTER 4 PROJECT/Style/navbar3css.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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
        <button class="dropdown-btn"><?php echo ucfirst($username); ?></button>
        <div class="dropdown-content">
          <a href="/SEMESTER 4 PROJECT/Templates/Profile.php"><img src="/SEMESTER 4 PROJECT/Assets/Icons/profile.png" alt="Profile Icon"> Hello, <?php echo ucfirst($username); ?></a>
          <a href="/SEMESTER 4 PROJECT/Templates/Cart.php"><img src="/SEMESTER 4 PROJECT/Assets/Icons/cart.png" alt="Cart Icon"> Cart</a>
          <a href="/SEMESTER 4 PROJECT/Templates/home_before_login.php"><img src="/SEMESTER 4 PROJECT/Assets/Icons/logout.png" alt="Logout Icon"> Logout</a>
        </div>
      </div>
    </nav>
  </header>

  <div class="profile-container">
    <div class="user-info">
      <img src="/SEMESTER 4 PROJECT/Assets/HomePageImages/HomeIcon.jpg" alt="User Avatar">
      <h2><?php echo strtoupper($currentUsername) ; ?></h2>
      <p>Email: <?php echo $currentUserEmail; ?></p>
    </div>

    <div class="options">
      <div class="profile-option" id="orders">
        <a href="/SEMESTER 4 PROJECT/Templates/profile_order.php"><img src="/SEMESTER 4 PROJECT/Assets/Icons/orders.png" alt=""></a>
        <a href="/SEMESTER 4 PROJECT/Templates/profile_order.php"><p>Recent Orders</p></a>
      </div>
      <div class="profile-option" id="orders">
        <a href="/SEMESTER 4 PROJECT/Templates/wallet.php"><img src="/SEMESTER 4 PROJECT/Assets/Icons/wallet.png" alt=""></a>
        <a href="/SEMESTER 4 PROJECT/Templates/wallet.php"><p>Wallet</p></a>
      </div>
      <div class="profile-option" id="contact">
        <a href="/SEMESTER 4 PROJECT/Templates/profile_contact.php"><img src="/SEMESTER 4 PROJECT/Assets/Icons/user.png" alt=""></a>
        <a href="/SEMESTER 4 PROJECT/Templates/profile_contact.php"><p>User Info</p></a>
      </div>
      <div class="profile-option" id="contact">
        <a href="/SEMESTER 4 PROJECT/Templates/Aboutus.php"><img src="/SEMESTER 4 PROJECT/Assets/Icons/aboutus.png" alt=""></a>
        <a href="/SEMESTER 4 PROJECT/Templates/Aboutus.php"><p>About Us</p></a>
      </div>


    </div>
  </div>
  <br><br><br>
  <div class="Terms">
    <h2>Terms and Conditions</h2>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit Lorem ipsum, dolor sit amet consectetur adipisicing elit.
      Ullam quibusdam cumque animi molestias obcaecati odit quo quam, nemo amet dolores, dolore adipisci a illo
      architecto fugit, saepe odio. Alias, architecto iste. Deleniti obcaecati maxime aperiam deserunt eligendi eveniet
      aliquam laboriosam eum excepturi repellat, commodi delectus illum temporibus assumenda quisquam nobis! Explicabo
      quibusdam et, beatae aut facere laboriosam officia cumque quaerat voluptatibus, incidunt eligendi! Temporibus a
      mollitia quis suscipit reprehenderit vel id dolores architecto, repellat quibusdam quas dicta cum sed voluptatum
      minus voluptate quia dolore, provident eligendi quidem consequatur perspiciatis iusto magnam facilis? Ipsam,
      fugit! Quibusdam, sapiente! Tenetur magnam iure distinctio?</p>

    <br><br>
    <h2>About HomeHive</h2>
    <p>HomeHive is your one-stop destination for high-quality household items Lorem ipsum dolor sit amet consectetur
      adipisicing elit. Delectus mollitia facere fugit laudantium iusto consequuntur, eum explicabo possimus! Saepe
      repudiandae voluptate eum! Dolores explicabo a, aspernatur excepturi eaque ratione magni, consequatur qui odit
      obcaecati inventore amet alias provident reprehenderit eos? Harum aperiam molestiae ipsa dolorem itaque?
      Voluptatem culpa autem deleniti, dicta facilis fuga numquam laboriosam iste nihil dolor, esse quidem ex neque
      earum possimus, provident obcaecati quam excepturi iusto ullam quia itaque eligendi? Non provident beatae voluptas
      asperiores at possimus temporibus rerum autem reprehenderit consequatur? Veniam cupiditate quidem temporibus eius
      magni libero vero fuga saepe ipsam, veritatis velit iste id!</p>
    <!-- Add more content as needed -->
  </div>
  <br><br>
  <footer class="footer">
    <div class="footer-section">
      <h3>Contact Us</h3>
      <p>Email: <a href="mailto:homehive63@gmail.com">homehive63@gmail.com</a></p>
      <p>Phone: +91 6000924957</p>
    </div>
    <div class="footer-section">
      <h3>Address</h3>
      <a href="https://maps.app.goo.gl/PkYb64D4FGqjMQUU9">
        <p>SG Palya,</p>
      </a>
      <a href="https://maps.app.goo.gl/PkYb64D4FGqjMQUU9">
        <p>Bangalore, Karnataka</p>
      </a>
    </div>
    <div class="footer-section">
      <h3>Follow Us</h3>
      <div class="social-icons">
        <a href="https://www.facebook.com/" class="social-icon"><i class="fab fa-facebook"></i></a>
        <a href="https://twitter.com/" class="social-icon"><i class="fab fa-twitter"></i></a>
        <a href="https://www.instagram.com/" class="social-icon"><i class="fab fa-instagram"></i></a>
      </div>
    </div>
    <div class="footer-section">
      <h3>Explore</h3>
      <p><a href="/SEMESTER 4 PROJECT/Templates/terms.php">Terms of Services</a></p>
      <p><a href="/SEMESTER 4 PROJECT/Templates/contactus.php">Contact Us</a></p>
    </div>
  </footer>
</body>

</html>