function addToCart(product_id) {
    $.ajax({
        type: 'POST',
        url: '/E_Commercenew/E_Commerce/routes.php?action=add_to_cart',
        data: { product_id: product_id, quantity: 1 },
        success: function(response) {
            try {
                // var result = JSON.parse(response);
                if (result.status === 'success') {
                    alert(result.message);

                    // Update cart counter
                    if (result.cartCount !== undefined) {
                        $('#cart-counter').text(result.cartCount);
                    }
                } else {
                    alert(result.message || 'Failed to add item to the cart.');
                }
            } catch (e) {
                console.error('Error parsing response:', e);
                alert('An unexpected error occurred.');
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error:', status, error);
            alert('An error occurred while adding the item to the cart.');
        }
    });
}
