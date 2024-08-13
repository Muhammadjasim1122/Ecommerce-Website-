<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Checkout</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="/E_Commerce/public/css/main.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h3>Checkout</h3>
        <form method="POST" action="routes.php?action=checkout">
            <!-- Include your cart items display here -->

            <div class="form-group">
                <label for="city">City:</label>
                <input type="text" id="city" name="city" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-success">Complete Purchase</button>
        </form>
    </div>
</body>
</html>

