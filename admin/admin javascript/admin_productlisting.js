document.getElementById('category-select').addEventListener('change', function() {
    var category = this.value;
    if (category === 'all') {
        window.location.href = '/SEMESTER 4 PROJECT/admin/admin template/admin_product.php';
    } else {
        window.location.href = '/SEMESTER 4 PROJECT/admin/admin template/admin_product.php?category=' + category;
    }
});