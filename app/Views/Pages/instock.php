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
                    <th>ID</th>
                    <th>Item Name</th>
                    <th>Category</th>
                    <th>Quantity</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($products)): ?>
                    <?php foreach ($products as $products): ?>
                        <tr>
                            <td><?= $products['product_id']; ?></td>
                            <td><?= $products['product_name']; ?></td>
                            <td><?= $products['category_id']; ?></td>
                            <td><?= $products['stock_quantity']; ?></td>
                            <td><?= number_format($products['price'], 2); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">No items in stock</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>



             <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
