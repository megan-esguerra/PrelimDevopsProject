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
                <!-- New Stock Button to Open Modal -->
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#stockModal">+ New Stock</button>
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

        <!-- Bootstrap Modal for Adding New Stock -->
        <div class="modal fade" id="stockModal" tabindex="-1" aria-labelledby="stockModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="stockModalLabel">Add New Stock</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="stockForm">
                            <div class="mb-3">
                                <label>Order ID</label>
                                <input type="text" name="order_id" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Product</label>
                                <input type="text" name="product" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Category</label>
                                <input type="text" name="category" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Sales Channel</label>
                                <input type="text" name="sales_channel" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Instruction</label>
                                <textarea name="instruction" class="form-control"></textarea>
                            </div>
                            <div class="mb-3">
                                <label>Items</label>
                                <input type="number" name="items" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Status</label>
                                <select name="status" class="form-control" required>
                                    <option value="Available">Available</option>
                                    <option value="Out of Stock">Out of Stock</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Save Stock</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap JS & jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

        <!-- AJAX Form Submission -->
        <script>
            $(document).ready(function() {
                $("#stockForm").submit(function(e) {
                    e.preventDefault();
                    $.ajax({
                        type: "POST",
                        url: "<?= base_url('StockController/store'); ?>",
                        data: $(this).serialize(),
                        dataType: "json",
                        success: function(response) {
                            if (response.success) {
                                alert("Stock added successfully!");
                                location.reload(); // Reload page to show new stock
                            } else {
                                alert("Failed to add stock.");
                            }
                        },
                        error: function() {
                            alert("Error adding stock.");
                        }
                    });
                });
            });
        </script>
    </body>
</html>
