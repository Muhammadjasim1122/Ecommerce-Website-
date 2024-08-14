$(document).ready(function() {
    $('form').on('submit', function(event) {
        event.preventDefault(); // Prevent the form from submitting the traditional way

        var formData = new FormData(this); // Create a FormData object from the form

        $.ajax({
            url: '/E_Commercenew/E_Commerce/routes.php?action=add_product', // Your API endpoint
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                var data = JSON.parse(response);
                
                if (data.status === 'success') {
                    // Update the cart counter
                    $('#cart-counter').text(data.cartCount);
                    toastr.success('Product added to cart!');
                } else {
                    toastr.error(data.message);
                }
            },
            error: function() {
                toastr.error('An error occurred. Please try again.');
            }
        });
    });
});
