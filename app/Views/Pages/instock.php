<?php include(APPPATH . 'Views/layout/Header.php'); ?>
<body>
    <!-- Sidebar -->
    <?php include(APPPATH . 'Views/layout/sidebar.php'); ?>
    <!-- Main Content -->
    <div class="main-content">
        <!-- Navbar -->
        <?php include(APPPATH . 'Views/layout/navbar.php'); ?>
        
        <!-- Cards -->
        <div class="container mt-5">
            <div class="d-flex justify-content-between align-items-center">
                <h2>In-Stock Items - Cat's Cafe</h2>
                <a href="<?= base_url('add-stock'); ?>" class="btn btn-success">+ New Stock</a>
            </div>

            <table class="table table-striped mt-3">
                <thead>
                    <tr>
                        <th>Order ID</th>
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
                                <td><?= esc($product['order_id']); ?></td>
                                <td><?= esc($product['product']); ?></td>
                                <td><?= esc($product['category']); ?></td>
                                <td><?= esc($product['sales_channel']); ?></td>
                                <td><?= esc($product['instruction']); ?></td>
                                <td><?= esc($product['items']); ?></td>
                                <td><?= esc($product['status']); ?></td>
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
