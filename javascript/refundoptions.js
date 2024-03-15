function showUPIInput() {
    var upiInput = document.getElementById("upiInput");
    var confirmButton = document.getElementById("confirmButton");
    var bankOption = document.getElementById("bank");
    if (bankOption.checked) {
        upiInput.style.display = "block";
        var upiId = document.getElementById("upiId").value;
        if (upiId) {
            confirmButton.disabled = true;
        } else {
            confirmButton.disabled = false;
        }
    }
}

function hideUPIInput() {
    var upiInput = document.getElementById("upiInput");
    var confirmButton = document.getElementById("confirmButton");
    var walletOption = document.getElementById("wallet");
    if (walletOption.checked) {
        upiInput.style.display = "none";
        confirmButton.disabled = false;
    }
}

function confirmRefund() {
    var selectedOption = document.querySelector('input[name="refund-option"]:checked');
    if (selectedOption) {
        if (selectedOption.value === "bank") {
            var upiId = document.querySelector('#upiInput input[type="text"]').value;
            if (!upiId) {
                alert("Please enter your UPI ID.");
                return;
            }
            alert("Refund will be processed to your bank account using UPI ID: " + upiId);
        } else if (selectedOption.value === "wallet") {
            alert("Refund will be processed to your wallet.");
        }
        window.location.href = "/SEMESTER 4 PROJECT/Templates/refundprocessed.php";
    } else {
        alert("Please select a refund option.");
    }
}
function confirmRefund() {
    var selectedOption = document.querySelector('input[name="refund-option"]:checked');
    var upiId = document.getElementById("upiId").value;

    if (selectedOption) {
        if (selectedOption.value === "bank") {
            if (upiId) {
                document.getElementById("confirmButton").disabled = false;
            } else {
                alert("Please enter your UPI ID.");
            }
        } else {
            document.getElementById("confirmButton").disabled = false;
        }
    } else {
        alert("Please select a refund option.");
    }
}