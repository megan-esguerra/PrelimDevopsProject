<?php include(APPPATH . 'Views/layout/Header.php'); ?>
<body>
    <!-- Sidebar -->
    <?php include(APPPATH . 'Views/layout/sidebar.php'); ?>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Navbar -->
        <?php include(APPPATH . 'Views/layout/navbar.php'); ?>

        <div class="container my-5">
            <h1 class="mb-4">Orders</h1>

            <!-- Toolbar -->
            <div class="d-flex justify-content-between mb-3">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newOrderModal">+ New Order</button>

                <!-- <div>
                    <button class="btn btn-outline-success" onclick="window.location.href='/orders/export';">Export to Excel</button>
                    <button class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#importModal">Import Orders</button>
                </div> -->
            </div>

            <!-- Modal -->
            <!-- <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="<?= base_url('orders/import') ?>" method="POST" enctype="multipart/form-data">
                            <div class="modal-header">
                                <h5 class="modal-title" id="importModalLabel">Import Orders</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <input type="file" name="orders_file" class="form-control" accept=".xlsx, .xls" required />
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Import</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div> -->

            <!-- Filter Form -->
            <form action="<?= base_url('orders/filter') ?>" method="GET" class="d-flex gap-3 mb-4">
                <input type="text" name="order_id" class="form-control w-25" placeholder="Order ID">
                <input type="date" name="date" class="form-control w-25">
                <select name="sales_channel" class="form-select w-25">
                    <option value="" selected>Sales Channel</option>
                    <option value="Online">Online</option>
                    <option value="In-store">In-store</option>
                </select>
                <select name="status" class="form-select w-25">
                    <option value="" selected>Status</option>
                    <option value="Pending">Pending</option>
                    <option value="Completed">Completed</option>
                    <option value="Cancelled">Cancelled</option>
                </select>
                <button type="submit" class="btn btn-primary">Filter</button>
            </form>

            <!-- Orders Table -->
            <table class="table table-striped table-hover">
    <thead>
        <tr>
            <th scope="col"><input type="checkbox"></th>
            <th scope="col">Order ID</th>
            <th scope="col">Date</th>
            <th scope="col">Customer</th>
            <th scope="col">Supplier</th>
            <th scope="col">Items</th>
            <th scope="col">Status</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($orders)): ?>
            <?php foreach ($orders as $order): ?>
                <tr>
                    <td><input type="checkbox"></td>
                    <td><?= isset($order['id']) ? htmlspecialchars($order['id']) : 'N/A' ?></td>
                    <td><?= isset($order['date']) ? htmlspecialchars($order['date']) : 'N/A' ?></td>
                    <td><?= isset($order['customer_name']) ? htmlspecialchars($order['customer_name']) : 'Unknown' ?></td>
                    <td><?= isset($order['supplier_name']) ? htmlspecialchars($order['supplier_name']) : 'Unknown' ?></td>
                    <td><?= isset($order['items']) ? htmlspecialchars($order['items']) : 'No Items' ?></td>
                    <td>
                        <?php 
                            $status = isset($order['status']) ? $order['status'] : 'Unknown';
                            $badgeClass = match($status) {
                                'Completed' => 'bg-success',
                                'Pending' => 'bg-warning',
                                'Cancelled' => 'bg-danger',
                                default => 'bg-secondary'
                            };
                        ?>
                        <span class="badge <?= $badgeClass ?>">
                            <?= htmlspecialchars($status) ?>
                        </span>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="7" class="text-center">No orders found.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

        </div>
    </div>

    <!-- New Order Modal -->
<div class="modal fade" id="newOrderModal" tabindex="-1" aria-labelledby="newOrderModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?= base_url('orders/create') ?>" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="newOrderModalLabel">Create New Order</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="date" class="form-label">Date</label>
                        <input type="date" name="date" class="form-control" value="<?= date('Y-m-d') ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="customer_id" class="form-label">Customer</label>
                        <select name="customer_id" class="form-select" required>
                            <option value="">Select Customer</option>
                            <?php foreach ($customers as $customer): ?>
                                <option value="<?= $customer['id'] ?>"><?= $customer['customer_name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="supplier_id" class="form-label">Supplier</label>
                        <select name="supplier_id" class="form-select" required>
                            <option value="">Select Supplier</option>
                            <?php foreach ($suppliers as $supplier): ?>
                                <option value="<?= $supplier['id'] ?>"><?= $supplier['supplier_name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="items" class="form-label">Items</label>
                        <textarea name="items" class="form-control" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" class="form-select">
                            <option value="Pending">Pending</option>
                            <option value="Completed">Completed</option>
                            <option value="Cancelled">Cancelled</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Order</button>
                </div>
            </form>
        </div>
    </div>
</div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
