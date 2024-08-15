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
<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="/E_Commercenew/E_Commerce/views/flow.html">E_COMMERCE STORE</a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="/E_Commercenew/E_Commerce/routes.php?action=login">Logout</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="/E_Commercenew/E_Commerce/views/flow.html">BAck</a></li>
            </ul>
        </div>
    </div>
</nav>
<div class="container">

    <?php
    if (isset($_SESSION['message'])):
    ?>
        <div class="alert alert-info"><?php echo $_SESSION['message']; ?></div>
    <?php
        unset($_SESSION['message']);
    endif;
    ?>
    <form method="post" action="/E_Commercenew/E_Commerce/routes.php?action=add_product" enctype="multipart/form-data">
       
        <form action="/E_Commercenew/E_Commerce/routes.php?action=add_product" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" class="form-control" id="name" name="name" required>
    </div>
    <div class="form-group">
        <label for="category_ids">Categories:</label>
        <select class="form-control" id="category_ids" name="category_ids[]" multiple required>
            <?php foreach ($categories as $category): ?>
                <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
            <?php endforeach; ?>
        </select>
        <small class="form-text text-muted">Hold down the Ctrl (or Command) key to select multiple options.</small>
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
</div>
</body>
</html>
