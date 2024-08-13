<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Order List</title>
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
        <h3>Order List</h3>
        <button>            <a href="/E_Commercenew/E_Commerce/views/flow.html" class="button">Back</a>
        </button>
        <?php
        if (isset($_SESSION['message'])):
        ?>
            <div class="alert alert-info"><?php echo htmlspecialchars($_SESSION['message'] ?? ''); ?></div>
        <?php
            unset($_SESSION['message']);
        endif;
        ?>

        <?php if (isset($orders) && $orders->rowCount() > 0): ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>User ID</th>
                        <th>Date</th>
                        <th>Total</th>
                        <th>City</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $orders->fetch(PDO::FETCH_ASSOC)): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['id'] ?? ''); ?></td>
                            <td><?php echo htmlspecialchars($row['user_id'] ?? ''); ?></td>
                            <td><?php echo htmlspecialchars($row['date'] ?? ''); ?></td>
                            <td><?php echo htmlspecialchars($row['total'] ?? ''); ?></td>
                            <td><?php echo htmlspecialchars($row['city'] ?? ''); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No orders found.</p>
        <?php endif; ?>
    </div>
</body>
</html>
