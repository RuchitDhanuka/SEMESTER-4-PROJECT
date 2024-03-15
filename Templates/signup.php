<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost"; 
    $username = "root"; 
    $password = "ruchit19";  
    $database = "homehive"; 
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if (isset($_POST['sign-up-name']) && isset($_POST['sign-up-username']) && isset($_POST['sign-up-email']) && isset($_POST['sign-up-password']) && isset($_POST['sign-up-confirmpassword'])) {
        $name = $_POST['sign-up-name'];
        $username = $_POST['sign-up-username'];
        $email = $_POST['sign-up-email'];
        $password = $_POST['sign-up-password'];
        $confirmpassword = $_POST['sign-up-confirmpassword'];



        $current_datetime = date('Y-m-d H:i:s');

        $sql = "INSERT INTO userlogin (user_name, user_username, user_email, user_password, created_at, last_login) VALUES ('$name', '$username', '$email', '$password', '$current_datetime', '$current_datetime')";

        if ($conn->query($sql) === TRUE) {
            header("Location: /SEMESTER 4 PROJECT/Templates/UserLoginFinal.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    $conn->close();
}
?>
