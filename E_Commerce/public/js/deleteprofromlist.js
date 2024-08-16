function confirmDelete() {
    if (confirm("Are you sure you want to delete this product?")) {
        document.getElementById('deleteProductForm').submit();
    }
}
