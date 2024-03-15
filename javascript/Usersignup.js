function validateSignUpForm() {
    var name = document.getElementById("sign-up-name").value;
    var username = document.getElementById("sign-up-username").value;
    var email = document.getElementById("sign-up-email").value;

    var nameRegex = /^[a-zA-Z\s]+$/;
    var usernameRegex = /^[a-zA-Z0-9]+$/;
    var emailRegex = /\S+@\S+\.\S+/;

    if (name === "" || username === "" || email === "") {
        alert("Please fill in all fields.");
        return false;
    } else if (!nameRegex.test(name)) {
        alert("Name should contain only alphabets.");
        return false;
    } else if (!usernameRegex.test(username)) {
        alert("Username should be alphanumeric.");
        return false;
    } else if (!emailRegex.test(email)) {
        alert("Invalid email format.");
        return false;
    }

    return true; 
}