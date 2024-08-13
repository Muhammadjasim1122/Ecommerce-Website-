<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Category Products</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="/E_Commerce/public/css/main.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="/E_Commerce/public/js/main.js"></script>
        <script src="/E_Commercenew/E_Commerce/public/js/main.js"></script>

</head>
<body>
<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="/E_Commercenew/E_Commerce/views/flow.html">E_COMMERCE STORE</a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="/E_Commercenew/E_Commerce/routes.php?action=">Logout</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="/E_Commercenew/E_Commerce/routes.php?action=view_all">BAck</a></li>
            </ul>
        </div>
    </div>
</nav>
    <!-- Navbar (same as above) -->

    <?php if (isset($categwiseProduct) && !empty($categwiseProduct)): ?>
        
        <!-- <h3>Products in <?php echo htmlspecialchars($categoryName); ?></h3> -->
        <div class="row">

            <?php foreach ($categwiseProduct as $row): ?>
                <div class="col-md-4">
                    <div class="product-card">
                        <img src="/E_Commercenew/E_Commerce/<?php echo htmlspecialchars($row['image']); ?>" alt="Product Image" class="product-image">
                        <h4><?php echo htmlspecialchars($row['name']); ?></h4>
                        <p>Price: $<?php echo htmlspecialchars($row['price']); ?></p>
                        <p>Quantity: <?php echo htmlspecialchars($row['quantity']); ?></p>
                        <button class="btn btn-primary btn-add-to-cart" onclick="addToCart(<?php echo htmlspecialchars($row['id']); ?>)">Add to Cart</button>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p>No products found.</p>
    <?php endif; ?>
    
</body>
</html>
