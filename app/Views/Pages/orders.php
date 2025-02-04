<?php include(APPPATH . 'Views/layout/Header.php'); ?>
<body>
    <?php include(APPPATH . 'Views/layout/sidebar.php'); ?>

    <div class="main-content">
        <?php include(APPPATH . 'Views/layout/navbar.php'); ?>

        <div class="container my-5">
            <h1 class="mb-4">Orders</h1>

            <!-- Toolbar -->
            <div class="d-flex justify-content-between mb-3">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newOrderModal">+ New Order</button>
                <!-- Button to Open Archive Modal -->
                <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#archiveModal">View Archived Orders</button>
            </div>

            <!-- Search Bar -->
            <div class="mb-3">
                <input type="text" id="searchInput" class="form-control" placeholder="Search orders...">
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
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="ordersTable">
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
                                    ?>" data-bs-toggle="tooltip" title="Status: <?= htmlspecialchars($order['status']) ?>">
                                    <?= htmlspecialchars($order['status']) ?>
                                </span>
                            </td>
                            <td>
                                <div class="d-flex justify-content-start gap-2">
                                    <!-- Edit Button -->
                                    <button class="btn btn-sm btn-secondary" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#editStatusModal" 
                                            data-id="<?= htmlspecialchars($order['id']) ?>" 
                                            data-status="<?= htmlspecialchars($order['status']) ?>">
                                        Edit
                                    </button>

                                    <!-- Archive Button -->
                                    <button class="btn btn-sm btn-danger" onclick="confirmArchive(<?= $order['id'] ?>)">
                                        Archive
                                    </button>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <!-- Pagination -->
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                            <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                        </li>
                    <?php endfor; ?>
                </ul>
            </nav>


        <!-- Loading Spinner -->
        <div id="loadingSpinner" class="d-none text-center my-3">
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>

    <!-- Modals -->


    <!-- JavaScript Enhancements -->
    <script>
        // Search Functionality
        document.getElementById('searchInput').addEventListener('keyup', function () {
            let filter = this.value.toLowerCase();
            let rows = document.querySelectorAll('#ordersTable tr');

            rows.forEach(row => {
                let text = row.textContent.toLowerCase();
                row.style.display = text.includes(filter) ? '' : 'none';
            });
        });

        // Tooltips Initialization
        document.addEventListener('DOMContentLoaded', function () {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });

        // Confirm Archive
        function confirmArchive(orderId) {
            if (confirm('Are you sure you want to archive this order?')) {
                fetch('<?= base_url('orders/delete') ?>', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: `order_id=${orderId}`
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Order archived successfully!');
                        location.reload();
                    } else {
                        alert('Failed to archive order.');
                    }
                })
                .catch(error => console.error('Error:', error));
            }
        }

        // Loading Spinner Toggle
        function toggleLoading(show) {
            document.getElementById('loadingSpinner').classList.toggle('d-none', !show);
        }
    </script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
