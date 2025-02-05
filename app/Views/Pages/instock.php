<?php include(APPPATH . 'Views/layout/Header.php'); ?>
<body>
    <?php include(APPPATH . 'Views/layout/sidebar.php'); ?>

    <div class="main-content">
        <?php include(APPPATH . 'Views/layout/navbar.php'); ?>

        <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>In-Stock Items - Cat's Cafe</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">In-Stock Items - Cat's Cafe</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>orderID</th>
                    <th>Product</th>
                    <th>Category</th>
                    <th>Sales Channel</th>
                    <th>Instruction</th>
                    <th>Items</th>
                    <th>Status</th>
                </tr>
            </thead>
           
            <tbody>
    <?php if (!empty($products)): ?>
        <?php foreach ($products as $product): ?>
            <tr>
                <td><?= $product['order_id']; ?></td>
                <td><?= $product['product']; ?></td>
                <td><?= $product['category']; ?></td>
                <td><?= $product['sales_channel']; ?></td>
                <td><?= $product['instruction']; ?></td>
                <td><?= $product['items']; ?></td>
                <td><?= $product['status']; ?></td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="7" class="text-center">No items in stock</td>
        </tr>
    <?php endif; ?>
</tbody>

        </table>
    </div>



             <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
