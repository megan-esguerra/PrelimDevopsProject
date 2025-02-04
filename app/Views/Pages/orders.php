<?php include(APPPATH . 'Views/layout/Header.php'); ?>
<body>
    <?php include(APPPATH . 'Views/layout/sidebar.php'); ?>

    <div class="main-content">
        <?php include(APPPATH . 'Views/layout/navbar.php'); ?>

        <div class="container my-5">
            <h1 class="mb-4">Orders</h1>

            <!-- Toolbar -->
            <div class="d-flex justify-content-between mb-3">
                <button class="btn btn-primary" onclick="window.location.href='<?= base_url('orders/newOrder'); ?>'">+ New Order</button>
            </div>

            <!-- Orders Table -->
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Date</th>
                        <th>Customer</th>
                        <th>Supplier</th>
                        <th>Items</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order): ?>
                        <tr>
                            <td><?= htmlspecialchars($order['id']) ?></td>
                            <td><?= htmlspecialchars($order['date']) ?></td>
                            <td><?= htmlspecialchars($order['customer_name']) ?></td>
                            <td><?= htmlspecialchars($order['supplier_name']) ?></td>
                            <td><?= htmlspecialchars($order['items']) ?></td>
                            <td>
                                <span class="badge 
                                    <?php 
                                        if ($order['status'] == 'Completed') {
                                            echo 'bg-success';
                                        } elseif ($order['status'] == 'Pending') {
                                            echo 'bg-warning';
                                        } elseif ($order['status'] == 'Cancelled') {
                                            echo 'bg-danger';
                                        } else {
                                            echo 'bg-secondary';
                                        }
                                    ?>">
                                    <?= htmlspecialchars($order['status']) ?>
                                </span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
