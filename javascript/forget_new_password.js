function validateForm() {
    var otp = document.getElementById("otp").value;
    var newPassword = document.getElementById("new-password").value;
    var confirmPassword = document.getElementById("confirm-password").value;

    // Check if OTP is numeric
    if (!(/^\d+$/.test(otp))) {
      alert("OTP must be numeric.");
      return false;
    }

    // Check if new password and confirm password match
    if (newPassword !== confirmPassword) {
      alert("New password and confirm password must match.");
      return false;
    }

    return true;
  }