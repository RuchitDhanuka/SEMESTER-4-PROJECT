<?php
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
            $current_datetime = date('Y-m-d H:i:s');
            $update_sql = "UPDATE userlogin SET last_login='$current_datetime' WHERE user_username='$username'";
            if ($conn->query($update_sql) === TRUE) {
                header("Location: /SEMESTER 4 PROJECT/Templates/home_after_login.php");
                exit(); 
            } else {
                echo "Error updating last login: " . $conn->error;
            }
        } else {
            echo "Invalid username or password";
        }
    }

    $conn->close();
}
?>
