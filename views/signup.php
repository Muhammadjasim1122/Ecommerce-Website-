<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Update Product</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <style>
        .container {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h3>Update Product</h3>

        <?php if (isset($product)): ?>
            <form method="post" action="/E_Commerce/routes.php?action=update_product" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($product['id']); ?>">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($product['name']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="price">Price:</label>
                    <input type="text" class="form-control" id="price" name="price" value="<?php echo htmlspecialchars($product['price']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="quantities">Quantities:</label>
                    <input type="number" class="form-control" id="quantities" name="quantities" value="<?php echo htmlspecialchars($product['quantity']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="image">Image:</label>
                    <input type="file" class="form-control" id="image" name="image" accept="image/*">
                    <img src="../E_Commerce/<?php echo htmlspecialchars($product['image']); ?>" alt="Product Image" width="100">
                </div>
                <button type="submit" class="btn btn-primary">Update Product</button>
            </form>
        <?php else: ?>
            <p>Product not found.</p>
        <?php endif; ?>
    </div>
</body>
</html>
