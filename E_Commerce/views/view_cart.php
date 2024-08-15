<!-- views/view_cart.php -->

<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8">
        <title>Cart</title>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
        <link href="/E_Commercenew/E_Commerce/public/css/main.css" rel="stylesheet">

        <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <script src="/E_Commercenew/E_Commerce/public/js/cartdelete.js"></script>


</head>
<body>

        <button>        
            <a href="/E_Commercenew/E_Commerce/routes.php?action=view_all" class="button">Back</a>
        </button>
        
        <div class="container">
            <h3>Your Cart</h3>
            <?php if (isset($quotes) && $quotes->rowCount() > 0): ?>
                <div class="row">
                    <?php while ($row = $quotes->fetch(PDO::FETCH_ASSOC)): ?>
                        <div class="col-md-4">
                            <div class="product-card">
                                <img src="../E_Commerce/<?php echo htmlspecialchars($row['image']); ?>" alt="Product Image" class="product-image">
                                <h4><?php echo htmlspecialchars($row['name']); ?></h4>
                                <p>Price: $<?php echo htmlspecialchars($row['price']); ?></p>
                                <p>Quantity: <?php echo htmlspecialchars($row['quantity']); ?></p>
                                <!-- Delete Button -->
                                <form class="delete-form" style="display:inline;">
    <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($row['product_id']); ?>">
    <button type="button" class="btn-delete" data-product-id="<?php echo htmlspecialchars($row['product_id']); ?>">Delete</button>
</form>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
                <div class="checkout-btn">
                    <a href="/E_Commercenew/E_Commerce/routes.php?action=checkout" class="btn btn-success">Checkout</a>
                </div>
            <?php else: ?>
                <p>Your cart is empty.</p>
            <?php endif; ?>
</div>
</body>
</html>
