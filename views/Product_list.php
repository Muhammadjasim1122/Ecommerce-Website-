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
                        <th>Actions</th> <!-- Added column for actions -->
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
                                <form action="/E_Commerce/routes.php?action=update_product" method="post" style="display:inline;">
                                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">
                                    <button type="submit" class="btn btn-warning btn-sm">Update</button>
                                </form>

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
        <?php else: ?>
        <?php endif; ?> 
    </div>
</body>
</html>
