const container = document.getElementById('container');
const overlayCon = document.getElementById('overlayCon');
const overlayBtn = document.getElementById('overlayBtn');

overlayBtn.addEventListener('click', () => {
    container.classList.toggle('right-panel-active');

    overlayBtn.classList.remove('btnScaled'); 
    window.requestAnimationFrame( ()=>{
        overlayBtn.classList.add('btnScaled');
    })
});

function validateSignInForm() {
  var signin_name = document.getElementById("sign-in-name").value;
  var singin_password = document.getElementById("sign-in-password").value;
  var nameRegex = /^[a-zA-Z]+$/; // Only alphabets
  var passwordMaxLength = 16;

  if (!nameRegex.test(signin_name)) {
    alert("Name should contain only alphabets.");
    return false;
  }

  if (singin_password.length > passwordMaxLength) {
    alert("Password should not exceed " + passwordMaxLength + " characters.");
    return false;
  }

  return true;
}





