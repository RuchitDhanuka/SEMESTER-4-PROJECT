function validateAndSubmit() {
    var addressline1 = document.getElementById('addressline1').value;
    var addressline2 = document.getElementById('addressline2').value;
    var city = document.getElementById('city').value;
    var state = document.getElementById('state').value;
    var zip = document.getElementById('zip').value;
    var country = document.getElementById('country').value;

    if (addressline1 && addressline2 && city && state && zip && country) {
        alert('Form submitted successfully!');
        window.location.href = "/Templates/Cart.html";
    } else {
        alert('Please fill in all the fields');
    }
}