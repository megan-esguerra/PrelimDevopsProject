<?php include(APPPATH . 'Views/layout/Header.php'); ?>
<body>
    <?php include(APPPATH . 'Views/layout/sidebar.php'); ?>

    <div class="main-content">
        <?php include(APPPATH . 'Views/layout/navbar.php'); ?>

        <div class="container my-5">
            <h1 class="mb-4">Orders</h1>

            <!-- Notifications -->
            <?php if (session()->has('success')): ?>
                <div class="alert alert-success">
                    <?= session('success') ?>
                </div>
            <?php elseif (session()->has('error')): ?>
                <div class="alert alert-danger">
                    <?= session('error') ?>
                </div>
            <?php endif; ?>

            <!-- Toolbar -->
            <div class="d-flex justify-content-between mb-3">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newOrderModal">+ New Order</button>
                <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#archiveModal">View Archived Orders</button>
            </div>

            <!-- Search and Filters -->
            <form class="d-flex mb-3" action="<?= base_url('orders') ?>" method="get">
                <input type="text" class="form-control me-2" name="search" placeholder="Search orders..." value="<?= htmlspecialchars($search ?? '') ?>">
                <select class="form-select me-2" name="status">
                    <option value="" selected>All Statuses</option>
                    <option value="Pending" <?= ($statusFilter ?? '') == 'Pending' ? 'selected' : '' ?>>Pending</option>
                    <option value="Completed" <?= ($statusFilter ?? '') == 'Completed' ? 'selected' : '' ?>>Completed</option>
                    <option value="Cancelled" <?= ($statusFilter ?? '') == 'Cancelled' ? 'selected' : '' ?>>Cancelled</option>
                </select>
                <button type="submit" class="btn btn-primary">Filter</button>
            </form>

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
                            <td>
                                <div class="d-flex justify-content-start gap-2">
                                    <button class="btn btn-sm btn-secondary" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#editStatusModal" 
                                            data-id="<?= htmlspecialchars($order['id']) ?>" 
                                            data-status="<?= htmlspecialchars($order['status']) ?>">
                                        Edit
                                    </button>

                                    <form id="deleteOrderForm" action="<?= base_url('orders/delete') ?>" method="post" class="m-0">
                                        <input type="hidden" name="order_id" value="<?= $order['id'] ?>">
                                        <button type="submit" class="btn btn-sm btn-danger">Archive</button>
                                    </form>
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
        </div>
    </div>

    <!-- Modals (New Order, Edit Status, Archived Orders) -->
    <?php include(APPPATH . 'Views/modals/orders.php'); ?>

    <script>
        // Edit Order Modal
        document.addEventListener('DOMContentLoaded', function () {
            const editStatusModal = document.getElementById('editStatusModal');
            editStatusModal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;
                const orderId = button.getAttribute('data-id');
                const status = button.getAttribute('data-status');

                const orderIdInput = editStatusModal.querySelector('#orderId');
                const statusSelect = editStatusModal.querySelector('#orderStatusEdit');

                orderIdInput.value = orderId;
                statusSelect.value = status;
            });
        });

        // Archive Orders Modal
        document.addEventListener('DOMContentLoaded', function () {
            const archiveModal = document.getElementById('archiveModal');
            archiveModal.addEventListener('show.bs.modal', function () {
                fetchArchivedOrders();
            });

            function fetchArchivedOrders() {
                fetch("<?= base_url('orders/get_archived') ?>")
                    .then(response => response.json())
                    .then(data => {
                        let tableBody = document.getElementById("archivedOrdersTable");
                        tableBody.innerHTML = "";

                        if (data.length === 0) {
                            tableBody.innerHTML = "<tr><td colspan='6' class='text-center'>No archived orders found.</td></tr>";
                        } else {
                            data.forEach(order => {
                                let row = `
                                    <tr>
                                        <td>${order.id}</td>
                                        <td>${order.customer_name}</td>
                                        <td>${order.supplier_name}</td>
                                        <td>${order.items}</td>
                                        <td>${order.status}</td>
                                        <td>
                                            <form action="<?= base_url('orders/restore') ?>" method="post">
                                                <input type="hidden" name="order_id" value="${order.id}">
                                                <button type="submit" class="btn btn-sm btn-success">Restore</button>
                                            </form>
                                        </td>
                                    </tr>
                                `;
                                tableBody.innerHTML += row;
                            });
                        }
                    })
                    .catch(error => console.error('Error fetching archived orders:', error));
            }
        });
    </script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
