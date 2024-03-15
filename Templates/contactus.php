<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '/xampp/htdocs/PHPMailer/Exception.php';
require '/xampp/htdocs/PHPMailer/PHPMailer.php';
require '/xampp/htdocs/PHPMailer/SMTP.php';

function send_email_user($name, $email)
{
  $mail = new PHPMailer(true);
  try {
    $mail->SMTPDebug = 0;
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'homehive63@gmail.com';
    $mail->Password   = 'ruod pfkd sgcd oqpp';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port       = 465;
    $mail->setFrom('homehive63@gmail.com', 'HomeHive');
    $mail->addAddress($email);
    $mail->isHTML(true);
    $mail->Subject = 'Support';
    $mail->Body = "Hello $name.<br> This message is in support to your query.<br> Our team will soon connect to you for further assistance. Sorry for the inconvenience.<br> For further query you can reach out to homehive63@gmail.com";
    $mail->send();
    return 'Request Sent';
  } catch (Exception $e) {
    return 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
  }
}
function send_email_admin($name, $usermail, $email, $message)
{
  $mail = new PHPMailer(true);
  try {
    $mail->SMTPDebug = 0;
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'homehive63@gmail.com';
    $mail->Password   = 'ruod pfkd sgcd oqpp';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port       = 465;
    $mail->setFrom('homehive63@gmail.com', 'HomeHive');
    $mail->addAddress($email);
    $mail->isHTML(true);
    $mail->Subject = 'Support';
    $mail->Body = "From : $name. <br>Email: $usermail <br> Message :$message";
    $mail->send();
    return 'Request Sent';
  } catch (Exception $e) {
    return 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
  }
}
$user = $_SESSION['username'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $message = $_POST['message'];

  $servername = "localhost";
  $username = "root";
  $password = "ruchit19";
  $dbname = "homehive";

  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  $stmt = $conn->prepare("INSERT INTO query (name, email_id, message) VALUES (?, ?, ?)");
  $stmt->bind_param("sss", $name, $email, $message);

  if ($stmt->execute()) {
    $result_user = send_email_user($name, $email);
    $result_admin = send_email_admin($name, $email, 'homehive63@gmail.com', $message);

    if ($result_user === true) {
      $errorMsg = $result_user;
    } else {
      $errorMsg = $result_user;
    }
    if ($result_admin === true) {
      $errorMsg = $result_admin;
    } else {
      $errorMsg = $result_admin;
    }
  } else {
    $errorMsg = "Error: " . $stmt->error;
  }

  $stmt->close();
  $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Us</title>
  <link rel="stylesheet" href="/SEMESTER 4 PROJECT/Style/navbar3css.css">
  <link rel="stylesheet" href="/SEMESTER 4 PROJECT/Style/contactus_css.css">
  <link rel="stylesheet" href="/SEMESTER 4 PROJECT/Style/footer.css">
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
    <div class="contact-container">
      <div class="form-and-map">
        <div class="form-container">
          <form action="" method="POST">
            <h2>Get in Touch</h2>
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
              <label for="message">Message</label>
              <textarea id="message" name="message" required></textarea>
            </div>
            <button type="submit">Send Message</button>
            <?php if (!empty($errorMsg)) { ?>
              <div class="error-message"><?php echo $errorMsg; ?></div>
            <?php } ?>
          </form>
        </div>
        <div class="map">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3888.5558789579427!2d77.60361387533187!3d12.93624141565199!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bae15b277a93807%3A0x88518f37b39dabd0!2sChrist%20University!5e0!3m2!1sen!2sin!4v1708265527588!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
      </div>
    </div>
    <div class="faq-and-photos">
      <div class="faq-container">
        <h2>Frequently Asked Questions</h2>
        <div class="faq">
          <div class="question">How do I place an order?</div>
          <div class="answer">
            <p>To place an order, simply add the desired items to your cart and proceed to checkout. Follow the prompts to enter your shipping information and complete your purchase.</p>
          </div>
        </div>

        <div class="faq">
          <div class="question">How long will it take for my order to arrive?</div>
          <div class="answer">
            <p>Delivery times depend on your location and the shipping method chosen. Generally, orders are processed within 1-2 business days, and standard shipping takes 5-10 days.</p>
          </div>
        </div>
        <div class="faq">
          <div class="question">What are your shipping charges?</div>
          <div class="answer">
            <p>Shipping charges may vary depending on the weight, size, and delivery location of the order. You can view the shipping charges during checkout before placing your order.</p>
          </div>
        </div>
        <div class="faq">
          <div class="question">What is the warranty or guarantee for this product?</div>
          <div class="answer">
            <p>Our products come with a 1 year warranty. Please refer to the product warranty section on the product page for more details.</p>
          </div>
        </div>
        <div class="faq">
          <div class="question">What payment methods do you accept?</div>
          <div class="answer">
            <p>We accept payments via debit/credit cards, UPI, cash on delivery (COD) and exclusively Crypto Payments for eligible orders.</p>
          </div>
        </div>
      </div>
      <div class="business-related">
  <h2>For Business Related Queries</h2>
  <p>If you have any business-related inquiries or partnership opportunities, please feel free to reach out to us:</p>
  <br>
  <div class="contact-info">
    <div>
      <p>Email:</p>
      <a href="mailto:homehive63@gmail.com">homehive63@gmail.com</a>
    </div>
    <div>
      <p>Phone:</p>
      <p>+91 6000 924957</p>
    </div>
  </div>
  <br><br>
  <p>Our office hours are Monday to Friday, 9:00 AM to 6:00 PM (IST).</p>
</div>
    </div>
  </div>
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
<script src="/SEMESTER 4 PROJECT/javascript/contactus_js.js"></script>
<script>
  document.addEventListener("DOMContentLoaded", function() {
    var errorMessage = document.querySelector('.error-message');

    setTimeout(function() {
      if (errorMessage) {
        errorMessage.style.display = 'none';
      }
    }, 2000);
  });
</script>

</html>