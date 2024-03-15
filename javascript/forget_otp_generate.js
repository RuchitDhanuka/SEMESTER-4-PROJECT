function validateForm() {
    var email = document.getElementById("email").value;
    var emailRegex = /\S+@\S+\.\S+/; // Basic email validation

    if (!emailRegex.test(email)) {
      alert("Invalid email address. Please enter a valid email.");
      return false;
    }

    return true;
  }