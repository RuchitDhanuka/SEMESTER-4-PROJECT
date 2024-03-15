function validateAndProceed() {
    const paymentOptions = document.querySelectorAll('input[name="payment-method"]');
    const selectedOption = [...paymentOptions].some(option => option.checked);

    if (!selectedOption) {
      alert('Please select a payment method before completing the payment.');
    } else {
      // Proceed with payment
      window.location.href = "/Templates/orderplaced.html"; // Redirect to the order placed page
    }
  }

  // Disable the "Complete Payment" button initially
  document.addEventListener('DOMContentLoaded', function () {
    const completePaymentBtn = document.querySelector('.complete-payment-btn');
    completePaymentBtn.disabled = true;

    // Enable the button when at least one option is selected
    const paymentOptions = document.querySelectorAll('input[name="payment-method"]');
    paymentOptions.forEach(option => {
      option.addEventListener('change', function () {
        completePaymentBtn.disabled = ![...paymentOptions].some(option => option.checked);
      });
    });
  });