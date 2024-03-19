<?php
session_start();
$username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About Us</title>
  <link rel="stylesheet" href="/SEMESTER 4 PROJECT/Style/Aboutus_css.css">
  <link rel="stylesheet" href="/SEMESTER 4 PROJECT/Style/navbar3css.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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
  <div class="container">
    <div class="company-section">
      <div class="company-info">
        <div class="company-image">
          <img src="/SEMESTER 4 PROJECT/Assets/Icons/Logo (2).png" alt="Company Image">
        </div>
        <br><br>
        <div class="company-details">
          <h1>Our Company</h1>
          <p>HomeHive is your ultimate destination for contemporary living essentials, specializing in smart home and kitchen appliances, sustainable furniture, and stylish home decor. We pride ourselves on offering a carefully curated selection of products that combine functionality, innovation, and eco-consciousness.Our smart home appliances are designed to streamline your daily tasks, enhance convenience, and elevate your living experience. From smart lighting systems to energy-efficient appliances, we bring cutting-edge technology into your home, making it more efficient, secure, and comfortable. In the realm of furniture, HomeHive champions sustainability without compromising on style. Our furniture collection features timeless designs crafted from ethically sourced materials, promoting durability, aesthetics, and environmental responsibility. Each piece is chosen to complement modern living spaces while reducing our ecological footprint.Complementing our smart solutions and sustainable furniture is our exquisite home decor range. Discover unique and stylish decor items that add personality, charm, and sophistication to your home.At HomeHive, we are committed to providing high-quality products, innovative solutions, and exceptional customer service. Join us in creating spaces that blend modern living with sustainability, where every piece tells a story of style, functionality, and conscious living.</p>
        </div>
      </div>
    </div>
    <div class="contact-info">
      <h2>Contact Information</h2>
      <p><i class="fas fa-phone"></i> Phone: 91 6000924957</p>
      <p><i class="far fa-envelope"></i> Email: <a href="mailto:homehive63@gmail.com">homehive63@gmail.com</a></p>
      <p><i class="fas fa-map-marker-alt"></i> Sg Palya , Bangalore </p>
    </div>
    <h2 class="team-heading">Our Team Members</h2>
    <div class="team-members">
      <div class="team-member">
        <img src="/SEMESTER 4 PROJECT/Assets/Team/WhatsApp Image 2024-02-04 at 13.44.51_5884cf38.jpg" alt="Team Member 1">
        <div class="social-icons">
          <a href="mailto:ruchitdhanuka6@gmail.com"><i class="fab fa-google"></i></a>
          <a href="https://x.com/ruchit_dhanuka?t=UTTWBrvPlx9H9yF7Hsj7iw&s=08"><i class="fab fa-twitter"></i></a>
          <a href="https://www.instagram.com/ruchit_2003?igsh=Njd3d3FkcmNpdzB4"><i class="fab fa-instagram"></i></a>
          <a href="https://www.linkedin.com/in/ruchit-dhanuka-106150252"><i class="fab fa-linkedin"></i></a>
        </div>
      </div>
      <div class="team-member">
        <img src="/SEMESTER 4 PROJECT/Assets/Team/IMG_20231204_153228_710~2.jpg" alt="Team Member 2">
        <div class="social-icons">
          <a href="#"><i class="fab fa-google"></i></a>
          <a href="#"><i class="fab fa-twitter"></i></a>
          <a href="#"><i class="fab fa-instagram"></i></a>
          <a href="#"><i class="fab fa-linkedin"></i></a>
        </div>
      </div>
      <div class="team-member">
        <img src="/SEMESTER 4 PROJECT/Assets/Team/Screenshot_20240220-144237.png" alt="Team Member 3">
        <div class="social-icons">
          <a href="#"><i class="fab fa-google"></i></a>
          <a href="#"><i class="fab fa-twitter"></i></a>
          <a href="#"><i class="fab fa-instagram"></i></a>
          <a href="#"><i class="fab fa-linkedin"></i></a>
        </div>
      </div>
    </div>
    <div class="contact-button">
      <a href="/SEMESTER 4 PROJECT/Templates/contactus.php"><button>Contact Us</button></a>
    </div>
  </div>
</body>

</html>
