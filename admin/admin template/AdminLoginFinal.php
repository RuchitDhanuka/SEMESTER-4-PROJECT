<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '/xampp/htdocs/PHPMailer/Exception.php';
require '/xampp/htdocs/PHPMailer/PHPMailer.php';
require '/xampp/htdocs/PHPMailer/SMTP.php';

$errorMsg = ""; 

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

        $sql = "SELECT * FROM adminlogin WHERE admin_username='$username' AND admin_password='$password'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $current_datetime = date('Y-m-d H:i:s');
            $update_sql = "UPDATE adminlogin SET last_login='$current_datetime' WHERE admin_username='$username'";
            if ($conn->query($update_sql) === TRUE) {
                header("Location: /SEMESTER 4 PROJECT/admin/admin template/Dashboard.php");
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

        // Check if the email ends with "@homehive.in"
        if (substr($email, -11) !== "@homehive.in") {
            $errorMsg = "Invalid email address. Please use your business email id";
        } else {
            $check_query = "SELECT * FROM adminlogin WHERE admin_username='$username' OR admin_email='$email'";
            $check_result = $conn->query($check_query);
            if ($check_result->num_rows > 0) {
                $errorMsg = "Admin already exists. Please choose a different username or email.";
            } else {
                $password = password_generator();

                $mail_result = send_email($name, $email, $password);

                if ($mail_result === true) {

                    $current_datetime = date('Y-m-d H:i:s');
                    $sql = "INSERT INTO adminlogin (admin_name, admin_username, admin_email, admin_password, created_at, last_login) VALUES ('$name', '$username', '$email', '$password', '$current_datetime', '$current_datetime')";

                    if ($conn->query($sql) === TRUE) {
                        header("Location: /SEMESTER 4 PROJECT/admin/admin template/Dashboard.php");
                        exit();
                    } else {
                        $errorMsg = "Error: " . $sql . "<br>" . $conn->error;
                    }
                } else {
                    $errorMsg = $mail_result;
                }
            }
        }
    }
    $conn->close();
}

function password_generator($length = 7) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
    $password = '';
    $maxIndex = strlen($characters) - 1;
    
    for ($i = 0; $i < $length; $i++) {
        $password .= $characters[rand(0, $maxIndex)];
    }
    
    return $password;
}

function send_email($name,$email, $password)
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
        $mail->Subject = 'Account Password';
        $mail->Body = <<<EOT
        Hello $name !.
        Password for your HomeHive account is: $password.
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
    <link rel="stylesheet" href="/SEMESTER 4 PROJECT/admin/admin style/AdminLoginFinal_css.css">
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
                <a href="/SEMESTER 4 PROJECT/Templates/UserloginFinal.php"><p class="home-link">Go to User</p></a>

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
                    <h1 class="dark-text">Hello, Admin!</h1>
                    <p>Enter your personal details and start journey with us</p>
                    <button>Sign Up</button>
                </div>
            </div>
            <button id="overlayBtn"></button>
        </div>
    </div>
    <script src="/SEMESTER 4 PROJECT/admin/admin javascript/AdminLogin.js"></script>
    <script src="/SEMESTER 4 PROJECT/admin/admin javascript/AdminSignup.js"></script>
</body>

</html>
