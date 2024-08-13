$(document).ready(function() {
    // Handle click on the basket icon
    $('#view-cart').click(function(event) {
        event.preventDefault(); // Prevent the default action

        // Make an AJAX request to fetch the cart data
        $.ajax({
            type: 'GET',
            url: '/E_Commercenew/E_Commerce/routes.php?action=view_cart',
            dataType: 'json',
            success: function(response) {
                if (response && response.cartItems) {
                    // Update cart counter
                    $('#cart-counter').text(response.cartItems.length);

                    // Display cart items
                    var cartItemsHtml = '<h3>Cart Items</h3><ul>';
                    response.cartItems.forEach(function(item) {
                        cartItemsHtml += '<li>' +
                            'Product: ' + item.name + ' - ' +
                            'Price: $' + item.price + ' - ' +
                            'Quantity: ' + item.quantity +
                            '</li>';
                    });
                    cartItemsHtml += '</ul>';
                    $('#cart-items-container').html(cartItemsHtml).show();
                } else {
                    console.error('Unexpected response format:', response);
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', status, error);
            }
        });
    });
});
