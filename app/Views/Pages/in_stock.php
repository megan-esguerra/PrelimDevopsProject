  
    <?php include(APPPATH . 'Views/layout/Header.php'); ?>
<body>
    <!-- Sidebar -->
    <?php include(APPPATH . 'Views/layout/sidebar.php'); ?>
    <!-- Main Content -->
    <div class="main-content">
        <!-- Navbar -->
        <?php include(APPPATH . 'Views/layout/navbar.php'); ?>
        
        <div class="contanier my-5">
            <h1 class="mb-4">In Stock</h1>

            <div class="d-flex justify-content-between mb-3">
                <button class="btn btn-primary" onclick="window.location.href='<?= base_url('pages/new_stock'); ?>'">+ New Stock</button>
</div>

<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th>order ID</th>
            <th>Product</th>
            <th>Category</th>
            <th>Sales Channel</th>
            <th>Instruction</th>
            <th>Items</th>
            <th>Status</th>
</tr>
</head>
<tbody>
<?php foreach ($orders as $order): ?>
    <tr>
        <td><?= htmlspecialchars($order['id']) ?></td>
        <td><?= htmlspecialchars($order['product']) ?></td>
        <td><?= htmlspecialchars($order['category']) ?></td>
        <td><?= htmlspecialchars($order['sales_channel']) ?></td>
        <td><?= htmlspecialchars($order['instruction']) ?></td>
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
