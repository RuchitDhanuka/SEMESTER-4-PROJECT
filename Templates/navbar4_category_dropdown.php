<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>E-commerce Navigation</title>
  <link rel="stylesheet" href="/Style/navbar4css.css">
</head>

<body>
  <header class="gradient-bg">
    <nav>
      <div class="logo">
        <a href="/Templates/home_after_login.php">HomeHive</a>
      </div>
      <ul class="nav-links">
        <li><a href="/Templates/home_after_login.php">Home</a></li>
        <li class="dropdown-categories">
          <a href="#">Categories ▼</a>
          <ul class="dropdown-content">
            <li><a href="/Templates/homeappliances_product.php"><span class="icon">▶</span> Home Appliances</a></li>
            <li><a href="/Templates/furniture_product.php"><span class="icon">▶</span> Furniture</a></li>
            <li><a href="/Templates/kitchenappliances_product.php"><span class="icon">▶</span> Kitchen Appliances</a></li>
          </ul>
        </li>
        <li><a href="#">Profile</a></li>
      </ul>
      <div class="profile">
        <p>Hello, <span>Profile</span></p>
        <div class="cart">
          <a href="/Templates/Cart.php" class="cart-icon">
            <img src="/Assets/Icons/cart.png" alt="Cart Icon">
          </a>
        </div>
      </div>
      <div class="auth-links">
        <a href="/Templates/home_before_login.php" class="logout-btn">Logout</a>
      </div>
    </nav>
  </header>
</body>

</html>
