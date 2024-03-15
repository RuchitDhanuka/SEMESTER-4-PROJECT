function showGenerateSection() {
    document.getElementById('generate-section').style.display = 'block';
    document.getElementById('enter-section').style.display = 'none';
    
    var generatedOTP = Math.floor(1000 + Math.random() * 9000);
    document.getElementById('generated-otp').innerText = generatedOTP;
  }
  
  function showEnterSection() {
    document.getElementById('enter-section').style.display = 'block';
    document.getElementById('generate-section').style.display = 'none';
  }
  
  function submitEnteredOTP() {
    var enteredOTP = document.getElementById('otp-input').value;
    alert('Entered OTP: ' + enteredOTP);
  }