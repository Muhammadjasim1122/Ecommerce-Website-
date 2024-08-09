<!-- product_list.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Product List</title>
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

        <?php if (isset($products) && $products instanceof PDOStatement && $products->rowCount() > 0): ?>
            <h3>Product List</h3>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $products->fetch(PDO::FETCH_ASSOC)): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['id']); ?></td>
                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                            <td><?php echo htmlspecialchars($row['price']); ?></td>
                            <td><?php echo htmlspecialchars($row['quantity']); ?></td>
                            <td><img src="../E_Commerce/<?php echo htmlspecialchars($row['image']); ?>" alt="Product Image" width="100"></td>
                            <td>
                                <!-- Update Button -->
                                <button class="btn btn-warning btn-sm" onclick="showUpdateForm(<?php echo htmlspecialchars($row['id']); ?>, '<?php echo htmlspecialchars($row['name']); ?>', <?php echo htmlspecialchars($row['price']); ?>, <?php echo htmlspecialchars($row['quantity']); ?>, '<?php echo htmlspecialchars($row['image']); ?>')">Update</button>
                                
                                <!-- Delete Button -->
                                <form action="/E_Commerce/routes.php?action=delete_product" method="post" style="display:inline;">
                                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            
            <!-- Update Form Modal -->
            <div id="updateFormModal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Update Product</h4>
                        </div>
                        <div class="modal-body">
                            <form id="updateProductForm" action="/E_Commerce/routes.php?action=update_product" method="post" enctype="multipart/form-data">
                                <input type="hidden" id="update_id" name="id">
                                <div class="form-group">
                                    <label for="update_name">Name:</label>
                                    <input type="text" class="form-control" id="update_name" name="name" required>
                                </div>
                                <div class="form-group">
                                    <label for="update_price">Price:</label>
                                    <input type="number" class="form-control" id="update_price" name="price" required>
                                </div>
                                <div class="form-group">
                                    <label for="update_quantity">Quantity:</label>
                                    <input type="number" class="form-control" id="update_quantity" name="quantity" required>
                                </div>
                                <div class="form-group">
                                    <label for="update_image">Image:</label>
                                    <input type="file" class="form-control" id="update_image" name="image">
                                </div>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
        <?php endif; ?> 
    </div>

    <script>
        function showUpdateForm(id, name, price, quantity, image) {
            document.getElementById('update_id').value = id;
            document.getElementById('update_name').value = name;
            document.getElementById('update_price').value = price;
            document.getElementById('update_quantity').value = quantity;
            document.getElementById('update_image').value = ""; // Clear the file input
            $('#updateFormModal').modal('show');
        }
    </script>
</body>
</html>
