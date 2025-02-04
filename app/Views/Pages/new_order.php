<?php include(APPPATH . 'Views/layout/Header.php'); ?>
<body>
    <?php include(APPPATH . 'Views/layout/sidebar.php'); ?>
    <div class="main-content">
        <?php include(APPPATH . 'Views/layout/navbar.php'); ?>

        <div class="container my-5">
            <h1 class="mb-4">Create New Order</h1>

            <form action="<?= base_url('orders/create'); ?>" method="POST">
                <?= csrf_field(); ?>

                <!-- Customer Selection -->
                <div class="mb-3">
                    <label for="customer_id" class="form-label">Customer</label>
                    <select name="customer_id" id="customer_id" class="form-select" required>
                        <option value="" disabled selected>Select a Customer</option>
                        <?php foreach ($customers as $customer): ?>
                            <option value="<?= $customer['id']; ?>"><?= $customer['customer_name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Supplier Selection -->
                <div class="mb-3">
                    <label for="supplier_id" class="form-label">Supplier</label>
                    <select name="supplier_id" id="supplier_id" class="form-select" required>
                        <option value="" disabled selected>Select a Supplier</option>
                        <?php foreach ($suppliers as $supplier): ?>
                            <option value="<?= $supplier['id']; ?>"><?= $supplier['supplier_name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Items Input -->
                <div class="mb-3">
                    <label for="items" class="form-label">Number of Items</label>
                    <input type="number" name="items" id="items" class="form-control" min="1" required>
                </div>

                <!-- Status Selection -->
                <div class="mb-3">
                    <label for="status" class="form-label">Order Status</label>
                    <select name="status" id="status" class="form-select">
                        <option value="Pending">Pending</option>
                        <option value="Completed">Completed</option>
                        <option value="Cancelled">Cancelled</option>
                    </select>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary">Create Order</button>
            </form>
        </div>
    </div>
</body>
</html>
