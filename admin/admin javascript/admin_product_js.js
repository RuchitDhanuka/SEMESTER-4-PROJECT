function toggleForm(formId) {
    const addProductForm = document.getElementById('addProduct');
    const deleteProductForm = document.getElementById('deleteProduct');

    if (formId === 'addProduct') {
        addProductForm.classList.remove('hidden');
        deleteProductForm.classList.add('hidden');
    } else if (formId === 'deleteProduct') {
        addProductForm.classList.add('hidden');
        deleteProductForm.classList.remove('hidden');
    }
}

function validateAddForm() {
    const productId = document.getElementById('productId').value;
    const productName = document.getElementById('productName').value;
    const productPrice = document.getElementById('productPrice').value;
    const productFeatures = document.getElementById('productFeatures').value;
    const productDescription = document.getElementById('productDescription').value;

    if (!productId || !productName || !productPrice || !productFeatures || !productDescription) {
        alert('Please fill in all fields before adding a product.');
        return false;
    }


    return true;
}
function validateDeleteForm() {
    const deleteProductId = document.getElementById('deleteProductId').value;

    if (!deleteProductId) {
        alert('Please fill in the Product ID before deleting a product.');
        return false;
    }



    return true; 
}
setTimeout(function() {
    var errorMessage = document.getElementsByClassName('success');
    if (errorMessage) {
      errorMessage.style.display = 'none';
    }
  }, 2000);
