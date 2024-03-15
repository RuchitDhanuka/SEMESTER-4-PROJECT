<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Login Page</title>
  <link rel="stylesheet" href="/Style/stylelogin.css">
</head>

<body>

  <div class="container">
    <div class="left-side">
      <img src="/Assets/Icons/Logo (2).png" alt="Image" >
    </div>
    <div class="right-side">
      <form action="/Templates/home_after_login.php" onsubmit="return validateForm()">
        <h2>User Login</h2>
        <div class="input-group">
          <input type="text" id="username" name="username" required placeholder="Username">
        </div>
        <div class="input-group">
          <input type="password" id="password" name="password" required placeholder="Password">
        </div>
        <button type="submit">Login</button>
        <p class="small-text">
          <a href="/Templates/signup.php">Sign Up</a> | <a href="/Templates/home_before_login.php">Go to Home</a>
        </p>
      </form>
    </div>
  </div>
  <script src="/javascript/login.js"></script>
</body>

</html>