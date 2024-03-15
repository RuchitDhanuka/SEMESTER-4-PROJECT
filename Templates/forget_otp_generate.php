<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Forgot Password</title>
  <link rel="stylesheet" href="/Style/styleforget1.css">
</head>

<body>
  <div class="container">
    <div class="left-side">
      <img src="/Assets/Icons/Logo (2).png" alt="Image">
    </div>
    <div class="right-side">
      <form id="forgot-password-form" action="forget_new_password.php" onsubmit="return validateForm()">
        <h2>Forgot Password</h2>
        <div class="input-group">
          <input type="email" id="email" name="email" required placeholder="Enter Email">
        </div>
        <a href="/Templates/forget_new_password.php"><button type="button" id="generate-otp">Generate OTP</button></a>
      </form>
    </div>
  </div>
</body>
<script src="/javascript/forget_otp_generate.js"></script>

</html>