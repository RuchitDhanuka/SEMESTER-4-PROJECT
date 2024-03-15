
  function validateSignUpForm() {
    var name = document.getElementById("sign-up-name").value;
    var username = document.getElementById("sign-up-username").value;
    var email = document.getElementById("sign-up-email").value;
    var password = document.getElementById("sign-up-password").value;
    var confirmPassword = document.getElementById("sign-up-confirmpassword").value;
  
    if (!/^[a-zA-Z]+$/.test(name) || !/^[a-zA-Z]+$/.test(username)) {
        alert("Name and Username should contain only alphabets.");
        return false;
    }
  
    if (email.indexOf('@') === -1) {
        alert("Invalid email address.");
        return false;
    }
  
    if (password !== confirmPassword) {
        alert("Password and Confirm Password do not match.");
        return false;
    }
  
  
    return true;
  }