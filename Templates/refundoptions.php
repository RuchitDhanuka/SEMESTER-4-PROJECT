<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "ruchit19";
$database = "homehive";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$productId = $_GET['productId'];
$cartId = $_GET['cartId'];

$refundMode = '';
$upiId = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $refundMode = $_POST['refund-option'];
    $upiId = $_POST['upiId'];

    if (!empty($refundMode)) {
        if ($refundMode === 'bank' && empty($upiId)) {
            echo "Please enter your UPI ID.";
        } else {
            $productQuery = "SELECT product_price FROM product WHERE product_id = '$productId'";
            $productResult = $conn->query($productQuery);

            if ($productResult->num_rows > 0) {
                $productData = $productResult->fetch_assoc();
                $productPrice = $productData['product_price'];

                $userId = $_SESSION['userid'];
                $insertRefundQuery = "INSERT INTO returnproduct (cart_id, user_id, refund_mode, return_date, upi_id, amount) VALUES ('$cartId', '$userId', '$refundMode', NOW(), '$upiId', '$productPrice')";

                if ($conn->query($insertRefundQuery) === TRUE) {
                    $updateProductQuery = "UPDATE cartitems SET status = 'return' WHERE cart_id = '$cartId' AND item_id = '$productId'";
                    if ($conn->query($updateProductQuery) === TRUE) {
                        if ($refundMode === 'wallet') {
                            $walletBalanceQuery = "SELECT balance FROM userwallet WHERE user_id = '$userId'";
                            $walletBalanceResult = $conn->query($walletBalanceQuery);
                            if ($walletBalanceResult->num_rows > 0) {
                                $walletData = $walletBalanceResult->fetch_assoc();
                                $currentBalance = $walletData['balance'];
                                $newBalance = $currentBalance + $productPrice;
                                $updateWalletQuery = "UPDATE userwallet SET balance = '$newBalance' WHERE user_id = '$userId'";
                                if ($conn->query($updateWalletQuery) === TRUE) {
                                    header('Location: /SEMESTER 4 PROJECT/Templates/refundprocessed.php');
                                    exit();
                                } else {
                                    echo "Error updating wallet balance: " . $conn->error;
                                }
                            } else {
                                echo "User wallet not found.";
                            }
                        } else {
                            header('Location: /SEMESTER 4 PROJECT/Templates/refundprocessed.php');
                            exit();
                        }
                    } else {
                        echo "Error updating product status: " . $conn->error;
                    }
                } else {
                    echo "Error inserting refund details: " . $conn->error;
                }
            } else {
                echo "Product not found.";
            }
        }
    } else {
        echo "Please select a refund option.";
    }
}

// Close database connection
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Refund Options</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="/SEMESTER 4 PROJECT/Style/refundoptionscss.css">
</head>

<body>
    <div class="container">
        <h1>Select Refund Option</h1>
        <form method="post" action="">
            <div class="options">
                <div class="option">
                    <input type="radio" id="bank" name="refund-option" value="bank" onchange="showUPIInput()">
                    <label for="bank">Refund to Bank Account</label>
                </div>
                <div class="option">
                    <input type="radio" id="wallet" name="refund-option" value="wallet" onchange="hideUPIInput()">
                    <label for="wallet">Refund to Wallet</label>
                </div>
            </div>
            <div class="upi-input" id="upiInput">
                <input type="text" id="upiId" name="upiId" placeholder="Enter UPI ID">
            </div>
            <button type="submit" class="confirm-button" id="confirmButton" onclick="confirmRefund()" disabled>
                <i class="fas fa-check"></i> Confirm
            </button>
        </form>
    </div>
    <script src="/SEMESTER 4 PROJECT/javascript/refundoptions.js"></script>

</body>

</html>