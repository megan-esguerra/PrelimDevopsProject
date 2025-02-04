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
                <!-- New Order Button -->
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newOrderModal">+ New Order</button>
                <!-- <div>
                    <button class="btn btn-outline-success" onclick="window.location.href='/orders/export';">Export to Excel</button>
                    <button class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#importModal">Import Orders</button>
                </div> -->
            </div>

            <!-- Modal -->
            <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
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
            </div>

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
                        <th scope="col">Order ID</th>
                        <th scope="col">Date</th>
                        <th scope="col">Supplier</th>
                        <th scope="col">Items</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order): ?>
                        <tr>
                            <td><?= htmlspecialchars($order['id']) ?></td>
                            <td><?= htmlspecialchars($order['date']) ?></td>
                            <td><?= htmlspecialchars($order['supplier_name']) ?></td>
                            <td><?= htmlspecialchars($order['items']) ?></td>
                            <td>
                                <span class="badge 
                                    <?= ($order['status'] == 'Completed') ? 'bg-success' : (($order['status'] == 'Pending') ? 'bg-warning' : 'bg-danger') ?>">
                                    <?= htmlspecialchars($order['status']) ?>
                                </span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
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
                    <h5 class="modal-title" id="newOrderModalLabel">New Order</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Date</label>
                        <input type="date" name="date" class="form-control" value="<?= date('Y-m-d') ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Supplier</label>
                        <select name="supplier_id" class="form-select" required>
                            <option value="" disabled selected>Select Supplier</option>
                            <?php foreach ($suppliers as $supplier): ?>
                                <option value="<?= $supplier['id'] ?>"><?= htmlspecialchars($supplier['supplier_name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Items</label>
                        <input type="number" name="items" class="form-control" min="1" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select" required>
                            <option value="Pending" selected>Pending</option>
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
