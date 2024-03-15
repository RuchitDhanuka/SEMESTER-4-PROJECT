<!DOCTYPE html>
<html lang="en">
<!--divinectorweb.com-->
<head>
    <meta charset="UTF-8">
    <title>Responsive Shopping Cart design</title>
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="css.css" rel="stylesheet">
    <link rel="stylesheet" href="/SEMESTER 4 PROJECT/Style/chandy_cart_css.css">
</head>
<body>
    <div class="wrapper">
		<div>
            <header class="gradient-bg">
                <nav>
                  <div class="logo">
                    <a href="/SEMESTER 4 PROJECT/Templates/home_after_login.php">HomeHive</a>
                  </div>
                  <ul class="nav-links">
                    <li><a href="/SEMESTER 4 PROJECT/Templates/home_after_login.php">Home</a></li>
                    <li><a href="/SEMESTER 4 PROJECT/Templates/Categories.php">Categories</a></li>
                    <li><a href="#">Profile</a></li>
                  </ul>
                  <div class="profile">
                    <p>Hello, <span>Profile</span></p>
                    <div class="cart">
                      <a href="/SEMESTER 4 PROJECT/Templates/Cart.php" class="cart-icon">
                        <img src="/SEMESTER 4 PROJECT/Assets/Icons/cart.png" alt="Cart Icon">
                      </a>
                    </div>
                  </div>
                  <div class="auth-links">
                    <a href="/SEMESTER 4 PROJECT/Templates/home_before_login.php" class="logout-btn">Logout</a>
                  </div>
                </nav>
              </header>
			</div>
		<h1 class="white">Shopping Cart</h1>
		<div class="project">
			<div class="shop">
				<div class="box">
					<img src="/SEMESTER 4 PROJECT/Assets/Furniture images/carousol1.jpg">
					<div class="content">
						<h3 class="white">Wooden Chair</h3>
						<h4 class="white">Price: Rs5400</h4>
						<p class="unit">Quantity: <input name="" value="2"></p>
						<p class="btn-area"><i aria-hidden="true" class="fa fa-trash"></i> <span class="btn2">Remove</span></p>
					</div>
				</div>
				<div class="box">
					<img src="/SEMESTER 4 PROJECT/Assets/Furniture images/carousol1.jpg">
					<div class="content">
						<h3 class="white">Steel Table</h3>
						<h4 class="white">Price: Rs10500</h4>
						<p class="unit">Quantity: <input name="" value="1"></p>
						<p class="btn-area"><i aria-hidden="true" class="fa fa-trash"></i> <span class="btn2">Remove</span></p>
					</div>
				</div>
				<div class="box">
					<img src="/SEMESTER 4 PROJECT/Assets/Furniture images/carousol1.jpg">
					<div class="content">
						<h3 class="white">Bajaj Mixer</h3>
						<h4 class="white">Price: Rs3000</h4>
						<p class="unit">Quantity: <input name="" value="0"></p>
						<p class="btn-area"><i aria-hidden="true" class="fa fa-trash"></i> <span class="btn2">Remove</span></p>
					</div>
				</div>
			</div>
			<div class="right-bar">
				<div class="container">
					<h1>Random Code Generator</h1>
					<p id="generatedCode"></p>
					<button onclick="generateCode()">Generate Code</button>
				</div>
				<script src="/SEMESTER 4 PROJECT/javascript/chandy_cart_js.js"></script>
				<p><span>Subtotal</span> <span>Rs18900</span></p>
				<hr>
				<p><span>Tax (16%)</span> <span>Rs3024</span></p>
				<hr>
				<p><span>Shipping</span> <span>Rs150</span></p>
				<hr>
				<p><span>Total</span> <span>Rs22074</span></p><a href="#"><i class="fa fa-shopping-cart"></i>Checkout</a>
			</div>
		</div>
	</div>
</body>
</html>