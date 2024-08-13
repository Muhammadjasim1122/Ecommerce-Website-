$(document).ready(function() {
    $('#btn_delete').on('click', function(e) {
        console.log("Test btn delete");
        e.preventDefault();
        
        var button = $(this);
        var productId = button.data('product-id');
        
        $.ajax({
            url: '/E_Commercenew/E_Commerce/routes.php?action=delete_from_cart',
            type: 'POST',
            data: { product_id: productId },
            success: function(response) {
                var result = JSON.parse(response);
                if (result.success) {
                    // Remove the product card from the DOM
                    button.closest('.col-md-4').remove();
                } else {
                    alert(result.message || 'Failed to delete item.');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                alert('Failed to delete item.');
            }
        });
    });
});