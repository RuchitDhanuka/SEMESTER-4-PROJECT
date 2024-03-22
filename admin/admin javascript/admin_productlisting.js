document.getElementById('category-select').addEventListener('change', function() {
    var category = this.value;
    if (category === 'all') {
        window.location.href = '/SEMESTER 4 PROJECT/admin/admin template/admin_product.php';
    } else {
        window.location.href = '/SEMESTER 4 PROJECT/admin/admin template/admin_product.php?category=' + category;
    }
});
function searchProducts() {
    var input = document.getElementById('searchInput').value.toUpperCase();
    var rows = document.querySelectorAll('.product-table tbody tr');

    rows.forEach(row => {
        var productName = row.cells[0].textContent.toUpperCase();
        if (productName.includes(input)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
}