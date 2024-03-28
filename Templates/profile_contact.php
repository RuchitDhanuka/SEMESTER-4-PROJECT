<?php
session_start();
require '/xampp/htdocs/PHPMailer/Exception.php';
require '/xampp/htdocs/PHPMailer/PHPMailer.php';
require '/xampp/htdocs/PHPMailer/SMTP.php';
if (!isset($_SESSION['username'])) {
  header("Location: /SEMESTER 4 PROJECT/Templates/home_before_login.php");
  exit();
}

$servername = "localhost";
$username = "root";
$password = "ruchit19";
$database = "homehive";
$conn = new mysqli($servername, $username, $password, $database);
function send_email($name, $email)
{
    $mail = new PHPMailer\PHPMailer\PHPMailer(true);
    try {
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'homehive63@gmail.com';
        $mail->Password   = 'ruod pfkd sgcd oqpp';
        $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;
        $mail->setFrom('homehive63@gmail.com', 'HomeHive');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'Account Password';
        $mail->Body = <<<EOT
        Hello $name !.<br>
        Password for your HomeHive account has been changed successfully: <br>
        EOT;
        $mail->send();
        return true;
    } catch (Exception $e) {
        return 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
    }
}
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$username=$_SESSION['username'];

$currentUsername = $_SESSION['username'];
$currentUserEmail = $_SESSION['email'];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update-username'])) {
  $newUsername = $_POST['new-username'];
  $userid = $_SESSION['userid'];

  $sql = "UPDATE userlogin SET user_username='$newUsername' WHERE user_id=$userid";

  if ($conn->query($sql) === TRUE) {
    $_SESSION['username'] = $newUsername;
    $currentUsername = $newUsername;
  } else {
    echo "Error updating username: " . $conn->error;
  }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update-password'])) {
  $newPassword = $_POST['new-password'];
  $userid = $_SESSION['userid'];

  $sql = "UPDATE userlogin SET user_password='$newPassword' WHERE user_id=$userid";

  if ($conn->query($sql) === TRUE) {
    send_email($_SESSION['username'],$_SESSION['email']);
    $_SESSION['password'] = $newPassword;
  } else {
    echo "Error updating password: " . $conn->error;
  }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Profile</title>
  <link rel="stylesheet" href="/SEMESTER 4 PROJECT/Style/navbar3css.css">
  <link rel="stylesheet" href="/SEMESTER 4 PROJECT/Style/footer.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="/SEMESTER 4 PROJECT/Style/Profile_contact_css.css">
  <style>
    .name {
      cursor: pointer;
    }

    .name input {
      display: none;
      border: 1px solid #ccc;
      border-radius: 5px;
      padding: 10px;
      font-size: 16px;
      width: 100%;
      box-sizing: border-box;
      margin-bottom: 10px;
    }

    .name.editable input {
      display: inline-block;
    }

    .name.editable button {
      display: inline-block;
      background-color: #4CAF50;
      color: white;
      border: none;
      border-radius: 5px;
      padding: 15px 25px;
      font-size: 18px;
      margin-left: 10px;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .name.editable button:hover {
      background-color: #45a049;
    }

    .password-form,
    .username-form {
      display: none;
      margin-top: 20px;
      width: 100%;
    }

    .change-password-btn,
    .change-username-btn {
      cursor: pointer;
      background-color: #3498db;
      border: none;
      color: white;
      padding: 15px 25px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 18px;
      border-radius: 5px;
      transition: background-color 0.3s;
      margin-top: 20px;
    }

    .change-password-btn:hover,
    .change-username-btn:hover {
      background-color: #2980b9;
    }

    .password-form input[type="password"],
    .password-form button[type="submit"],
    .username-form input[type="text"],
    .username-form button[type="submit"] {
      display: block;
      margin: 10px 0;
      border: 1px solid #ccc;
      border-radius: 5px;
      padding: 10px;
      font-size: 16px;
      width: 100%;
      box-sizing: border-box;
    }

    .password-form button[type="submit"],
    .username-form button[type="submit"] {
      background-color: #4CAF50;
      color: white;
      cursor: pointer;
      transition: background-color 0.3s;
      padding: 15px 25px;
      font-size: 18px;
      border-radius: 5px;
      border: none;
    }

    .password-form button[type="submit"]:hover,
    .username-form button[type="submit"]:hover {
      background-color: #45a049;
    }
  </style>

</head>
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
    <div class="profileimage">
      <img src="/SEMESTER 4 PROJECT/Assets/HomePageImages/HomeIcon.jpg" alt="Profile Picture" class="profile-picture">
      <h2 class="name editable" onclick="editUsername()"><?php echo ucfirst($currentUsername); ?></h2>
      <div class="email">
        <span class="label">Email: </span>
        <span class="email-address"><?php echo $currentUserEmail; ?></span>
      </div>
      <form id="usernameForm" class="username-form" method="POST" style="display: none;">
        <input type="text" name="new-username" placeholder="New Username" value="">
        <button type="submit" name="update-username">Update Username</button>
      </form>
      <button class="change-username-btn" onclick="toggleUsernameForm()">Change Username</button>
      <div id="passwordForm" class="password-form" style="display: none;">
        <form method="POST">
          <input type="password" name="new-password" placeholder="New Password">
          <button type="submit" name="update-password">Update Password</button>
        </form>
      </div>
      <button class="change-password-btn" onclick="togglePasswordForm()">Change Password</button>
    </div>
  </div>

  <script src="/SEMESTER 4 PROJECT/javascript/profilecontact_js.js"></script>
  <script>
    function editUsername() {
      document.querySelector('.name').classList.toggle('editable');
      document.querySelector('#usernameForm').style.display = 'block';
      document.querySelector('#passwordForm').style.display = 'none';
    }

    function toggleUsernameForm() {
      document.querySelector('#usernameForm').style.display = 'block';
      document.querySelector('#passwordForm').style.display = 'none';
    }

    function togglePasswordForm() {
      document.querySelector('#passwordForm').style.display = 'block';
      document.querySelector('#usernameForm').style.display = 'none';
    }
  </script>
  </script>
</body>

</html>