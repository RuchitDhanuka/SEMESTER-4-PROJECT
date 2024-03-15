function editUsername() {
    var usernameField = document.getElementById('username');
    usernameField.disabled = !usernameField.disabled;
}

function changePassword() {
    var passwordForm = document.getElementById('passwordForm');
    passwordForm.style.display = 'block';
}

function validatePassword() {
    var newPassword = document.getElementById('newPassword').value;
    var confirmPassword = document.getElementById('confirmPassword').value;
    var passwordMessage = document.getElementById('passwordMessage');
    var passwordForm = document.getElementById('passwordForm');
    var passwordSuccessMessage = document.getElementById('passwordSuccessMessage');

    if (newPassword !== confirmPassword) {
        passwordMessage.innerHTML = 'Passwords do not match!';
        passwordMessage.className = 'password-message error';
        return false;
    } else {
        passwordMessage.className = 'password-message';
        passwordForm.style.display = 'none';
        passwordSuccessMessage.innerHTML = 'Password successfully changed!';
        passwordSuccessMessage.style.display = 'block';

        setTimeout(function () {
            passwordSuccessMessage.style.display = 'none';
        }, 2000);

        return false;
    }
}