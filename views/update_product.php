<?php
// Ensure $product is set and contains data
$productId = isset($product['id']) ? htmlspecialchars($product['id']) : '';
$productName = isset($product['name']) ? htmlspecialchars($product['name']) : '';
$productPrice = isset($product['price']) ? htmlspecialchars($product['price']) : '';
$productQuantity = isset($product['quantity']) ? htmlspecialchars($product['quantity']) : '';
$productImage = isset($product['image']) ? htmlspecialchars($product['image']) : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Update Product</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
        <h3>Update Product</h3>
        <form method="post" action="/E_Commerce/routes.php?action=update_product" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $productId; ?>">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $productName; ?>" required>
            </div>
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="text" class="form-control" id="price" name="price" value="<?php echo $productPrice; ?>" required>
            </div>
            <div class="form-group">
                <label for="quantity">Quantity:</label>
                <input type="number" class="form-control" id="quantity" name="quantity" value="<?php echo $productQuantity; ?>" required>
            </div>
            <div class="form-group">
                <label for="image">Image:</label>
                <input type="file" class="form-control" id="image" name="image" accept="image/*">
                <?php if ($productImage): ?>
                    <img src="../E_Commerce/uploads/<?php echo htmlspecialchars($productImage); ?>" alt="Product Image" width="100">
                <?php endif; ?>
            </div>
            <button type="submit" class="btn btn-primary">Update Product</button>
        </form>
    </div>
</body>
</html>
