<?php
session_start();
$user=$_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Refund Process</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="/SEMESTER 4 PROJECT/Style/navbar3css.css">
<link rel="stylesheet" href="/SEMESTER 4 PROJECT/Style/refundprocessed.css">
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
    <h1>Processing Refund</h1>
    <div class="icon-container">
        <i class="icon fas fa-check-circle"></i>
        <i class="icon fas fa-truck-moving"></i>
        <i class="icon fas fa-dollar-sign"></i>
    </div>
    <div class="processing-text">Processing your refund...</div>
    <div class="processing-spinner">
        <i class="fas fa-spinner fa-spin"></i>
    </div>
    <div class="processing-animation">
        <div class="spinner-border" role="status">
            <span class="sr-only">Processing...</span>
        </div>
    </div>
    <div class="success-animation">
        <i class="icon fas fa-check-circle"></i>
        <div>Refund Successful!</div>
    </div>

    </div> 
</div>

<script>
    setTimeout(() => {
        document.querySelector('.processing-spinner').style.display = 'none';
        document.querySelector('.processing-animation').style.display = 'block';
        setTimeout(() => {
            document.querySelector('.processing-animation').style.display = 'none';
            document.querySelector('.success-animation').style.display = 'flex';
            document.querySelector('.processing-steps .step').classList.remove('active');
            document.querySelectorAll('.processing-steps .step')[1].classList.add('active');
        }, 3000);
    }, 2000);
</script>
</body>
</html>
