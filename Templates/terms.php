<?php
session_start();
$user=$_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Terms and Conditions</title>
<link rel="stylesheet" href="/SEMESTER 4 PROJECT/Style/navbar3css.css">
<link rel="stylesheet" href="/SEMESTER 4 PROJECT/Style/termcss.css">
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
              <a href="/SEMESTER 4 PROJECT/Templates/Profile.php"><img src="/SEMESTER 4 PROJECT/Assets/Icons/profile.png" alt="Profile Icon"> Hello,<?php echo ucfirst($user); ?></a>
              <a href="/SEMESTER 4 PROJECT/Templates/Cart.php"><img src="/SEMESTER 4 PROJECT/Assets/Icons/cart.png" alt="Cart Icon"> Cart</a>
              <a href="/SEMESTER 4 PROJECT/Templates/home_before_login.php"><img src="/SEMESTER 4 PROJECT/Assets/Icons/logout.png" alt="Logout Icon"> Logout</a>
            </div>
          </div>
        </nav>
      </header>
<div class="container">
    <h1>Terms and Conditions</h1>

    <p>Please read these terms and conditions carefully before using our website.</p>

    <h2>1. Agreement to Terms</h2>
    <p>By accessing or using our website, you agree to be bound by these terms and conditions. If you disagree with any part of these terms and conditions, you may not access the website.</p>

    <h2>2. Intellectual Property Right</h2>
    <p>All content included on this website, such as text, graphics, logos, button icons, images, audio clips, digital downloads, data compilations, and software, is the property of our company or its content suppliers and protected by international copyright laws.</p>

    <h2>3. Limitation of Liability</h2>
    <p>In no event shall our company, nor its directors, employees, partners, agents, suppliers, or affiliates, be liable for any indirect, incidental, special, consequential, or punitive damages, including without limitation, loss of profits, data, use, goodwill, or other intangible losses, resulting from (i) your access to or use of or inability to access or use the website; (ii) any conduct or content of any third party on the website; (iii) any content obtained from the website; and (iv) unauthorized access, use, or alteration of your transmissions or content, whether based on warranty, contract, tort (including negligence), or any other legal theory, whether or not we have been informed of the possibility of such damage, and even if a remedy set forth herein is found to have failed of its essential purpose.</p>

    <h2>4. Return Policy</h2>
    <p>We have a <span class="bold">30-day return policy</span> for most items purchased through our website. Items must be returned in their original condition and packaging.</p>

    <h2>5. Mode of Payments</h2>
    <p>We accept various modes of payment including credit/debit cards, UPI,Cash on Delivery, Wallet and we also offer Crypto payments. All payments are processed securely through our payment gateway provider.</p>

    <h2>6. Business Query Contact</h2>
    <p>For business queries and partnership opportunities, please contact us at <a class="contact-link" href="mailto:homehive63@gmail.com">homehive63@gmail.com</a>.</p>

    <h2>7. Product Categories</h2>
    <p>Our website offers a wide range of products across various categories including furnitures,home decor and kitchen appliances. Browse our <a class="contact-link" href="/SEMESTER 4 PROJECT/Templates/Categories.php">Product Categories</a> to explore our offerings.</p>

    <h2>8. Changes to Terms</h2>
    <p>We reserve the right, at our sole discretion, to modify or replace these terms and conditions at any time. If a revision is material, we will try to provide at least 30 days' notice prior to any new terms taking effect. What constitutes a material change will be determined at our sole discretion.</p>

    <h2>9. Contact Us</h2>
    <p>If you have any questions about these terms and conditions, please <a class="contact-link" href="/SEMESTER 4 PROJECT/Templates/contactus.php">contact us</a>.</p>
</div>

</body>
</html>
