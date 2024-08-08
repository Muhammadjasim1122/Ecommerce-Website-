<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Admin Dashboard</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <style>
        .container {
            margin-top: 20px;
        }
        .btn-group {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h3>Admin Dashboard</h3>
        
        <?php
        if (isset($_SESSION['message'])):
        ?>
            <div class="alert alert-info"><?php echo $_SESSION['message']; ?></div>
        <?php
            unset($_SESSION['message']);
        endif;
        ?>

        <!-- Product Form -->
        <form method="post" action="/E_Commerce/routes.php?action=add_product" enctype="multipart/form-data">
            <div class="form-group">
                <label for="product_id">Product ID:</label>
                <input type="text" class="form-control" id="product_id" name="product_id" required>
            </div>
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="text" class="form-control" id="price" name="price" required>
            </div>
            <div class="form-group">
                <label for="quantities">Quantities:</label>
                <input type="number" class="form-control" id="quantities" name="quantities" required>
            </div>
            <div class="form-group">
                <label for="image">Image:</label>
                <input type="file" class="form-control" id="image" name="image" accept="image/*">
            </div>
            <button type="submit" class="btn btn-primary">Add Product</button>
        </form>

        <!-- Button Group -->
        <div class="btn-group" role="group">
            <a href="/E_Commerce/routes.php?action=view_all_products" class="btn btn-info">View All Products</a>
            <a href="/E_Commerce/routes.php?action=view_orders" class="btn btn-warning">View Orders</a>
        </div>
    </div>
</body>
</html>
