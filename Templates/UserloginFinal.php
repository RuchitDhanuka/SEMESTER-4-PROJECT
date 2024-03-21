<?php
session_start();

require '/xampp/htdocs/PHPMailer/Exception.php';
require '/xampp/htdocs/PHPMailer/PHPMailer.php';
require '/xampp/htdocs/PHPMailer/SMTP.php';

$errorMsg = "";
$current_datetime = date('Y-m-d H:i:s');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "ruchit19";
    $database = "homehive";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if (isset($_POST['sign-in-name']) && isset($_POST['sign-in-password'])) {
        $username = $_POST['sign-in-name'];
        $password = $_POST['sign-in-password'];

        $sql = "SELECT * FROM userlogin WHERE user_username='$username' AND user_password='$password'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $_SESSION['userid'] = $row['user_id'];
            $_SESSION['username'] = $row['user_username'];
            $_SESSION['email'] = $row['user_email'];
            $_SESSION['password'] = $row['user_password'];
            $cart_code=otp_generator();
            $checkCartSql = "SELECT * FROM cart WHERE user_id='" . $row['user_id'] . "' AND status='active'";
            $cartResult = $conn->query($checkCartSql);
            if ($cartResult->num_rows == 0) {
                $createCartSql = "INSERT INTO cart (user_id, created_at, status,cart_code) VALUES ('" . $_SESSION['userid'] . "', NOW(), 'active','$cart_code')";
                if ($conn->query($createCartSql) === TRUE) {
                    $cartId = $conn->insert_id;
                    $_SESSION['cart_id'] = $cartId;
                } else {
                    $errorMsg = "Error creating cart: " . $conn->error;
                }
            } else {
                $cartRow = $cartResult->fetch_assoc();
                $_SESSION['cart_id'] = $cartRow['cart_id'];
            }

            $update_sql = "UPDATE userlogin SET last_login=NOW() WHERE user_username='$username'";
            if ($conn->query($update_sql) === TRUE) {
                header("Location: /SEMESTER 4 PROJECT/Templates/home_after_login.php");
                exit();
            } else {
                $errorMsg = "Error updating last login: " . $conn->error;
            }
        } else {
            $errorMsg = "Invalid username or password";
        }
    } elseif (isset($_POST['sign-up-name']) && isset($_POST['sign-up-username']) && isset($_POST['sign-up-email'])) {
        $name = $_POST['sign-up-name'];
        $username = $_POST['sign-up-username'];
        $email = $_POST['sign-up-email'];

        $check_query = "SELECT * FROM userlogin WHERE user_username='$username' OR user_email='$email'";
        $check_result = $conn->query($check_query);
        if ($check_result->num_rows > 0) {
            $errorMsg = "User already exists. Please choose a different username or email.";
        } else {
            $password = password_generator();

            $mail_result = send_email($name, $email, $password);

            if ($mail_result === true) {
                $errorMsg="Check your mail for your password";
                $current_datetime = date('Y-m-d H:i:s');
                $sql = "INSERT INTO userlogin (user_name, user_username, user_email, user_password, created_at, last_login) VALUES ('$name', '$username', '$email', '$password', NOW(),NOW())";

                if ($conn->query($sql) === TRUE) {
                    $userId = $conn->insert_id; // Store user ID in session
                    $_SESSION['userid'] = $userId;
                    $_SESSION['username'] = $username;
                    $_SESSION['email'] = $email;
                    $_SESSION['password'] = $password;

                    $createWalletSql = "INSERT INTO userwallet (user_id, balance) VALUES ('$userId', '0')";
                    if ($conn->query($createWalletSql) === TRUE) {
                        header("Location: /SEMESTER 4 PROJECT/Templates/UserLoginFinal.php");
                        exit();
                    } else {
                        $errorMsg = "Error creating user wallet: " . $conn->error;
                    }
                } else {
                    $errorMsg = "Error: " . $sql . "<br>" . $conn->error;
                }
            } else {
                $errorMsg = $mail_result;
            }
        }
    }
    $conn->close();
}
function password_generator($length = 7)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
    $password = '';
    $maxIndex = strlen($characters) - 1;

    for ($i = 0; $i < $length; $i++) {
        $password .= $characters[rand(0, $maxIndex)];
    }

    return $password;
}
function otp_generator($length = 4)
{
    $characters = '0123456789';
    $otp = '';
    $maxIndex = strlen($characters) - 1;

    for ($i = 0; $i < $length; $i++) {
        $otp .= $characters[rand(0, $maxIndex)];
    }

    return $otp;
}

function send_email($name, $email, $password)
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
        Password for your HomeHive account is: $password<br>
        You can change your password through the profile section once you log in to your account.
        EOT;
        $mail->send();
        return true;
    } catch (Exception $e) {
        return 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LogIn</title>
    <link rel="stylesheet" href="/SEMESTER 4 PROJECT/Style/UserloginFinal_css.css">
</head>
<body>
    <video autoplay loop muted>
        <source src="/SEMESTER 4 PROJECT/Documentation/UI DESIGN/UserModule/LoginFinal.mp4" type="video/mp4">
    </video>

    <div class="container" id="container">
        <div class="form-container sign-up-container">
            <form id="sign-up-form" onsubmit="return validateSignUpForm()" action="" method="POST">
                <h1>Create Account</h1>
                <div class="infield">
                    <input type="text" id="sign-up-name" name="sign-up-name" placeholder="Name" />
                    <label></label>
                </div>
                <div class="infield">
                    <input type="text" id="sign-up-username" name="sign-up-username" placeholder="Username" />
                    <label></label>
                </div>
                <div class="infield">
                    <input type="email" id="sign-up-email" name="sign-up-email" placeholder="Email" name="email" />
                    <label></label>
                </div>

                <button>Sign Up</button>
            </form>
        </div>
        <div class="form-container sign-in-container">
            <img src="/SEMESTER 4 PROJECT/Assets/Icons/LogoNoBackground.png" alt="Sign In Logo" class="logo">
            <form action="" id="sign-in-form" method="POST" onsubmit="return validateSignInForm()">
                <h1>Sign in</h1>
                <div class="infield">
                    <input type="text" id="sign-in-name" name="sign-in-name" placeholder="Name" />
                    <label></label>
                </div>
                <div class="infield">
                    <input type="password" id="sign-in-password" name="sign-in-password" placeholder="Password" />
                    <label></label>
                </div>
                <button>Sign In</button>
                <a href="/SEMESTER 4 PROJECT/Templates/home_before_login.php">
                    <p class="home-link">Go to Home</p>
                </a>

                <?php if (!empty($errorMsg)) { ?>
                    <div class="error-message"><?php echo $errorMsg; ?></div>
                <?php } ?>
            </form>
        </div>
        <div class="overlay-container" id="overlayCon">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1 class="dark-text">Welcome Back!</h1>
                    <p>To keep connected with us please login with your personal info</p>
                    <button>Sign In</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1 class="dark-text">Hello, User!</h1>
                    <p>Enter your personal details and start journey with us</p>
                    <button>Sign Up</button>
                </div>
            </div>
            <button id="overlayBtn"></button>
        </div>
    </div>
    <script src="/SEMESTER 4 PROJECT/javascript/Userlogin.js"></script>
    <script src="/SEMESTER 4 PROJECT/javascript/Usersignup.js"></script>
</body>

</html>