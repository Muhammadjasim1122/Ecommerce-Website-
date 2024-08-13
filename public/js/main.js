function addToCart(product_id) {
    $.ajax({
        type: 'POST',
        url: '/E_Commercenew/E_Commerce/routes.php?action=add_to_cart',
        data: { product_id: product_id, quantity: 1 },
        success: function(response) {
            if (response && response.message) {
                alert(response.message);
                // Update cart counter here if needed
            } else {
                console.error('Unexpected response format:', response);
                alert('An unexpected error occurred.');
            }
        },
        error: function(xhr, status, error) {
            console.log("An error occurred while adding the item to the cart");
            // console.log(" Status  response ");
            // console.log(response);
            // console.log(" Statu");
            // console.log(status);
            // console.error('AJAX Error:', status, error);
            // alert('An error occurred while adding the item to the cart.');
        }
    });
}
