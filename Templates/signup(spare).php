<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login Page</title>
  <link rel="stylesheet" href="/Style/stylessignup.css">
</head>
<body>
  <div class="container">
    <div class="left-side">
      <img src="/Assets/Icons/Logo (2).png" alt="Image">
    </div>
    <div class="right-side">
      <form  action="/Templates/login.php" onsubmit="return validateForm()">
        <h2>Create New User Account</h2>
        <div class="input-group">
          <input type="text" id="name" name="name" required placeholder="Name">
        </div>
        <div class="input-group">
          <input type="text" id="username" name="username" required placeholder="Username">
        </div>
        <div class="input-group">
          <input type="email" id="email" name="email" required placeholder="Email">
        </div>
        <div class="input-group">
          <input type="text" id="mobile" name="mobile" required placeholder="Phone">
        </div>
        <div class="input-group">
          <input type="password" id="password" name="password" required placeholder="Password">
        </div>
        <div class="input-group">
          <input type="password" id="confirmpassword" name="confirmpassword" required placeholder="Confirm Password">
        </div>
        <button type="submit">SignUp</button>
        <p class="small-text"> 
          <a href="/Templates/login.php">Existing User</a>
        </p>
      </form>
    </div>
  </div>
</body>
<script src="/javascript/signup.js"></script>
</html>
