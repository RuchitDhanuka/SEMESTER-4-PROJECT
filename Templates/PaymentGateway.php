<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '/xampp/htdocs/PHPMailer/Exception.php';
require '/xampp/htdocs/PHPMailer/PHPMailer.php';
require '/xampp/htdocs/PHPMailer/SMTP.php';

function send_email($email, $subject, $message)
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
        $mail->Subject = $subject;
        $mail->Body = $message;
        $mail->send();
        return 'Request Sent';
    } catch (Exception $e) {
        return 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
    }
}

$servername = "localhost";
$username = "root";
$password = "ruchit19";
$database = "homehive";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if (!isset($_SESSION['userid'])) {
    header("Location: /SEMESTER 4 PROJECT/Templates/home_before_login.php");
    exit();
}

if (!isset($_SESSION['cart_id'])) {
    header("Location: /SEMESTER 4 PROJECT/Templates/Cart.php");
    exit();
}

$username = $_SESSION['username'];
$cartId = $_SESSION['cart_id'];

$cartTotalQuery = "SELECT cart_total FROM cart WHERE cart_id = '$cartId'";
$cartTotalResult = $conn->query($cartTotalQuery);

if ($cartTotalResult->num_rows > 0) {
    $cartTotalRow = $cartTotalResult->fetch_assoc();
    $cartTotal = $cartTotalRow['cart_total'];
} else {
    $cartTotal = 0;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['payment-method'])) {
        $paymentMode = $_POST['payment-method'];
    } else {
        echo "Payment mode not selected.";
        exit();
    }

    $updateCartStatusQuery = "UPDATE cart SET status = 'inactive' WHERE cart_id = '$cartId'";
    $paymentId = mt_rand(100000, 999999);

    $userId = $_SESSION['userid'];
    $orderStatus = "orderedplaced";
    
    if ($paymentMode === 'wallet') {
        $checkBalanceQuery = "SELECT balance FROM userwallet WHERE user_id = '$userId'";
        $balanceResult = $conn->query($checkBalanceQuery);
    
        if ($balanceResult->num_rows > 0) {
            $balanceRow = $balanceResult->fetch_assoc();
            $walletBalance = $balanceRow['balance'];
    
            if ($walletBalance >= $cartTotal) {
                $newBalance = $walletBalance - $cartTotal;
                $updateBalanceQuery = "UPDATE userwallet SET balance = '$newBalance' WHERE user_id = '$userId'";
                if ($conn->query($updateBalanceQuery) !== TRUE) {
                    echo "Error updating wallet balance: " . $conn->error;
                    exit();
                }
    
                $insertOrderQuery = "INSERT INTO orders (cart_id, order_status, user_id, placed_at) VALUES ('$cartId', '$orderStatus', '$userId', NOW())";
                if ($conn->query($insertOrderQuery) !== TRUE) {
                    echo "Error inserting order into orders table: " . $conn->error;
                    exit();
                }
                if ($conn->query($updateCartStatusQuery) !== TRUE) {
                    echo "Error updating cart status: " . $conn->error;
                    exit();
                }
            } else {
                echo "<script>document.getElementById('insufficientBalanceModal').style.display = 'block';</script>";
                exit();
            }
            

        } else {
            echo "Error fetching wallet balance.";
            exit();
        }
    } else {
        $insertOrderQuery = "INSERT INTO orders (cart_id, order_status, user_id, placed_at) VALUES ('$cartId', '$orderStatus', '$userId', NOW())";
        if ($conn->query($insertOrderQuery) !== TRUE) {
            echo "Error inserting order into orders table: " . $conn->error;
            exit();
        }
        if ($conn->query($updateCartStatusQuery) !== TRUE) {
            echo "Error updating cart status: " . $conn->error;
            exit();
        }
    }
    

    $insertPaymentQuery = "INSERT INTO payment (payment_id, order_id, payment_mode, amount, payment_time) VALUES ('$paymentId', LAST_INSERT_ID(), '$paymentMode', '$cartTotal', NOW())";
    if ($conn->query($insertPaymentQuery) !== TRUE) {
        echo "Error inserting into payment table: " . $conn->error;
        exit();
    }
    $cart_code=otp_generator();
    $insertNewCartQuery = "INSERT INTO cart (user_id,created_at, status,cart_code) VALUES ('$userId', NOW(),'active','$cart_code')";
    if ($conn->query($insertNewCartQuery) !== TRUE) {
        echo "Error creating new cart: " . $conn->error;
        exit();
    }

    $newCartId = $conn->insert_id;

    $_SESSION['cart_id'] = $newCartId;

    $userEmailQuery = "SELECT user_email FROM userlogin WHERE user_id = '$userId'";
    $userEmailResult = $conn->query($userEmailQuery);
    if ($userEmailResult->num_rows > 0) {
        $userEmailRow = $userEmailResult->fetch_assoc();
        $userEmail = $userEmailRow['user_email'];
        $bill = "Bill for your recent order:<br>";
        $cartItemsQuery = "SELECT product_name, product_price, quantity FROM cartitems JOIN product ON cartitems.item_id = product.product_id WHERE cart_id = '$cartId'";
        $cartItemsResult = $conn->query($cartItemsQuery);
        if ($cartItemsResult->num_rows > 0) {
            while ($row = $cartItemsResult->fetch_assoc()) {
                $productName = $row['product_name'];
                $productPrice = $row['product_price'];
                $quantity = $row['quantity'];
                $subtotal = $productPrice * $quantity;
                $bill .= "Product: $productName, Price: $productPrice, Quantity: $quantity, Subtotal: $subtotal<br>";
            }
        }
        $bill .= "\nTotal: $cartTotal";

        $subject = "Order Confirmation";
        $message = "Thank you for your order.<br>Here is your bill:<br>$bill";
        send_email($userEmail, $subject, $message);
    }
    $cartItemsQuery = "SELECT item_id, quantity FROM cartitems WHERE cart_id = '$cartId'";
    $cartItemsResult = $conn->query($cartItemsQuery);
    
    if ($cartItemsResult->num_rows > 0) {
        while ($cartItem = $cartItemsResult->fetch_assoc()) {
            $itemId = $cartItem['item_id'];
            $quantity = $cartItem['quantity'];
    
            $productQuantityQuery = "SELECT product_quantity FROM productinventory WHERE product_id = '$itemId'";
            $productQuantityResult = $conn->query($productQuantityQuery);
    
            if ($productQuantityResult->num_rows > 0) {
                $productQuantityRow = $productQuantityResult->fetch_assoc();
                $currentQuantity = $productQuantityRow['product_quantity'];
                $newQuantity = $currentQuantity - $quantity;
    
                $updateQuantityQuery = "UPDATE productinventory SET product_quantity = '$newQuantity' WHERE product_id = '$itemId'";
                if ($conn->query($updateQuantityQuery) !== TRUE) {
                    echo "Error updating product quantity: " . $conn->error;
                    exit();
                }
            } else {
                echo "Product quantity not found.";
                exit();
            }
        }
    } else {
        echo "No items found in the cart.";
        exit();
    }
    header("Location: /SEMESTER 4 PROJECT/Templates/orderplaced.php");
    exit();
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
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Payment Gateway</title>
    <link rel="stylesheet" href="/SEMESTER 4 PROJECT/Style/paymentcss.css">
    <link rel="stylesheet" href="/SEMESTER 4 PROJECT/Style/navbar3css.css">
    <link rel="stylesheet" href="/SEMESTER 4 PROJECT/Style/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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
                    <a href="/SEMESTER 4 PROJECT/Templates/Profile.php"><img src="/SEMESTER 4 PROJECT/Assets/Icons/profile.png" alt="Profile Icon"> Hello,<?php echo ucfirst($username); ?></a>
                    <a href="/SEMESTER 4 PROJECT/Templates/Cart.php"><img src="/SEMESTER 4 PROJECT/Assets/Icons/cart.png" alt="Cart Icon"> Cart</a>
                    <a href="/SEMESTER 4 PROJECT/Templates/home_before_login.php"><img src="/SEMESTER 4 PROJECT/Assets/Icons/logout.png" alt="Logout Icon"> Logout</a>
                </div>
            </div>
        </nav>
    </header>
    <div class="background-gradient"></div>
    <div class="payment-container">
        <div class="content">
            <div class="logo">
                <img src="/SEMESTER 4 PROJECT/Assets/Icons/logo_small.png" alt="Your Logo">
            </div>
            <div class="cart-details">
                <h2>Cart Total</h2>
                <p>Total: $<?php echo $cartTotal; ?></p>
            </div>
            <form action="" method="post">
                <div class="payment-options">
                    <h2>Select Payment Method</h2>
                    <div class="option">
                        <label for="cash-on-delivery">
                            <img src="/SEMESTER 4 PROJECT/Assets/Icons/cod.png" alt="Cash on Delivery">
                            <input type="radio" id="cash-on-delivery" name="payment-method" value="cash">
                            Cash on Delivery
                        </label>
                    </div>
                    <div class="option">
                        <label for="upi-payment">
                            <img src="/SEMESTER 4 PROJECT/Assets/Icons/upi.png" alt="Pay through UPI">
                            <input type="radio" id="upi-payment" name="payment-method" value="upi">
                            Pay through UPI
                        </label>
                    </div>
                    <div class="option">
                        <label for="crypto-payment">
                            <img src="/SEMESTER 4 PROJECT/Assets/Icons/crypto.png" alt="Pay with cryptocurrency">
                            <input type="radio" id="crypto-payment" name="payment-method" value="crypto">
                            Pay through Cryptocurrency
                        </label>
                    </div>
                    <div class="option">
                        <label for="card-payment">
                            <img src="/SEMESTER 4 PROJECT/Assets/Icons/bankcard.png" alt="Pay through Debit Card">
                            <input type="radio" id="card-payment" name="payment-method" value="bank">
                            Pay to Bank Account
                        </label>
                    </div>
                    <div class="option">
                        <label for="wallet-payment">
                            <img src="/SEMESTER 4 PROJECT/Assets/Icons/wallet.png" alt="Pay through Wallet">
                            <input type="radio" id="wallet-payment" name="payment-method" value="wallet">
                            Pay through Wallet
                        </label>
                    </div>
                </div>
                <div id="additional-info-dialog" class="additional-info-dialog">
                    <div class="additional-info-content">
                        <span class="close-btn" onclick="closeAdditionalInfoDialog()">&times;</span>
                        <div class="info-container">
                            <h3 id="additional-info-title">Additional Information</h3>
                            <p id="additional-info-text">No additional information available.</p>
                            <input class="imageinput" type="file" id="image-upload" accept="image/*" style="display: block; margin-top: 10px;" required>
                            <button onclick="uploadImage()">Confirm</button>
                            <div id="image-preview"></div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="complete-payment-btn">Complete Payment</button>
            </form>
        </div>
    </div>
    <div id="insufficientBalanceModal" class="modal" style="display: none;">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Insufficient Balance</h2>
            <p>Your wallet balance is not enough to complete the payment. Please choose another payment method.</p>
        </div>
    </div>
    <footer class="footer">
        <div class="footer-section">
            <h3>Contact Us</h3>
            <p>Email: <a href="mailto:HomeHive@gmail.com">HomeHive@gmail.com</a></p>
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
            <p>Terms of Service</p>
            <p>Privacy Policy</p>
        </div>
    </footer>
    <script>
    function closeAdditionalInfoDialog() {
        var dialog = document.getElementById('additional-info-dialog');
        dialog.style.display = 'none';
    }

    function showAdditionalInfo(paymentMethod) {
        var dialog = document.getElementById('additional-info-dialog');
        var title = document.getElementById('additional-info-title');
        var text = document.getElementById('additional-info-text');
        var inputButton = document.querySelector('.imageinput');

        switch (paymentMethod) {
            case 'cash':
                title.innerText = 'Cash on Delivery';
                text.innerText = 'Pay the amount in cash when your order is delivered.';
                dialog.style.display = 'block'; 
                inputButton.disabled=true;
                break;
            case 'upi':
                title.innerText = 'UPI Payment';
                text.innerText = 'Transfer the amount to given UPI ID \n UPI ID: ruchitdhanuka6@okhdfcbank';
                dialog.style.display = 'block'; 
                inputButton.disabled=false;
                break;
            case 'crypto':
                title.innerText = 'Cryptocurrency Payment';
                text.innerText = 'Transfer the amount to the provided cryptocurrency address. \n Crypto Address: 3FkenCiXpSLqD8L79intRNXUgjRoH9sjXa \n Accepted Crypto: BITCOIN/ETHERIUM';
                dialog.style.display = 'block';
                inputButton.disabled=false;
                break;
            case 'bank':
                title.innerText = 'Card Payment';
                text.innerText = 'Account Number: 123456789 \n IFSC Code: 1234567 \n Bank Name:XYZ Bank \n Branch: XYZ Branch';
                dialog.style.display = 'block';
                inputButton.disabled=false;
                break;
            case 'wallet':
                title.innerText = 'Wallet Payment';
                text.innerText = 'Payment will be deducted from your wallet balance.';
                dialog.style.display = 'block'; 
                inputButton.disabled=true;
                break;
            default:
                title.innerText = 'Additional Information';
                text.innerText = 'No additional information available.';
                dialog.style.display = 'none'; 
        }
    }

    document.querySelectorAll('input[name="payment-method"]').forEach(function(radio) {
        radio.addEventListener('change', function() {
            var paymentMethod = this.value;
            showAdditionalInfo(paymentMethod);
        });
    });
</script>


</body>

</html>
