<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Landing page</title>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
<link href="/E_Commercenew/E_Commerce/public/css/main.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="/E_Commercenew/E_Commerce/public/js/addcart.js"></script>
<script src="/E_Commercenew/E_Commerce/public/js/view_cart.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


</head>
<body>
            <nav class="navbar navbar-default">
            <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">E_COMMERCE STORE</a>
            </div>

            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="/E_Commercenew/E_Commerce/views/user_login.php">Logout</a></li>
                    <li>
                        <a href="/E_Commercenew/E_Commerce/routes.php?action=view_cart">
                            <span class="glyphicon glyphicon-shopping-cart"></span>
                            <span id="cart-counter" class="badge">0</span>
                        </a>
                    </li>
                    <select id="categorySelect" onchange="location = this.value;">
            <option value="" disabled selected>Select a category</option>
                    <?php foreach ($categories as $category): ?>
                    <option value="/E_Commercenew/E_Commerce/routes.php?action=view_category&categoryId=<?php echo urlencode($category['id']); ?>">
                        <?php echo htmlspecialchars($category['name']); ?>
                    </option>
                    <?php endforeach; ?>
            </select>
                </ul>
            </div>
            </div>
            </nav>



    <?php if (isset($products) && $products instanceof PDOStatement && $products->rowCount() > 0): ?>
        <h3>ALL Products Categories</h3>
        <div class="row">
            <?php while ($row = $products->fetch(PDO::FETCH_ASSOC)): ?>
                <div class="col-md-4">
                    <div class="product-card">
                        <img src="/E_Commercenew/E_Commerce/<?php echo htmlspecialchars($row['image']); ?>" alt="Product Image" class="product-image">
                        <h4><?php echo htmlspecialchars($row['name']); ?></h4>
                        <p>Price: $<?php echo htmlspecialchars($row['price']); ?></p>
                        <p>Quantity: <?php echo htmlspecialchars($row['quantity']); ?></p>
                        <button class="btn btn-primary btn-add-to-cart" onclick="addToCart(<?php echo htmlspecialchars($row['id']); ?>)">Add to Cart</button>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <p>No products found.</p>
    <?php endif; ?>
    
</div>
</body>
</html>
