<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Reset Password</title>
  <link rel="stylesheet" href="/Style/styleforget2.css">
</head>
<body>
  <div class="container">
    <div class="left-side">
      <img src="/Assets/Icons/Logo (2).png" alt="Image">
    </div>
    <div class="right-side">
      <form id="reset-password-form" action="/Templates/login.php" onsubmit="return validateForm()">
        <h2>Reset Password</h2>
        <div class="input-group">
          <!-- <label for="otp">Enter OTP</label> -->
          <input type="text" id="otp" name="otp" required placeholder="OTP">
        </div>
        <div class="input-group">
          <!-- <label for="new-password">New Password</label> -->
          <input type="password" id="new-password" name="new-password" required placeholder="New Password">
        </div>
        <div class="input-group">
          <!-- <label for="confirm-password">Confirm New Password</label> -->
          <input type="password" id="confirm-password" name="confirm-password" required placeholder="Confirm New Password">
        </div>
        <button type="submit">Reset Password</button>
      </form>
    </div>
  </div>
</body>
<script src="/javascript/forget_new_password.js"></script>
</html>
