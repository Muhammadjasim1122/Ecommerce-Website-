$(document).ready(function() {
    $('.btn-delete').on('click', function() {
        var button = $(this);
        var productId = button.data('product-id');
        
        console.log('Deleting product ID:', productId); // Debugging line
        
        $.ajax({
            url: '/E_Commercenew/E_Commerce/routes.php?action=delete_from_cart',
            type: 'POST',
            data: { product_id: productId },
            success: function(response) {
                console.log('Response:', response); // Debugging line
                
                try {
                    var result = JSON.parse(response);
                    if (result.success) {
                        toastr.success('Product deleted successfully.');
                        button.closest('.product-card').remove();
                    } else {
                        toastr.error(result.message || 'Failed to delete product.');
                    }
                } catch (e) {
                    toastr.error('Invalid response format.');
                    console.error('Error parsing JSON:', e);
                }
            },
            error: function(xhr, status, error) {
                toastr.error('An error occurred while deleting the product.');
                console.error('AJAX Error:', status, error);
            }
        });
    });
});
