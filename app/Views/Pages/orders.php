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
                    <option value="" <?= empty($statusFilter) ? 'selected' : '' ?>>All Status</option>
                    <option value="Pending" <?= ($statusFilter ?? '') == 'Pending' ? 'selected' : '' ?>>Pending</option>
                    <option value="Completed" <?= ($statusFilter ?? '') == 'Completed' ? 'selected' : '' ?>>Completed</option>
                    <option value="Cancelled" <?= ($statusFilter ?? '') == 'Cancelled' ? 'selected' : '' ?>>Cancelled</option>
                </select>

                <button type="submit" class="btn btn-primary">Filter</button>
            </form>


            <!-- Orders Table -->
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th class="text-truncate" style="max-width: 150px;">Order ID</th>
                        <th class="text-truncate" style="max-width: 150px;">Date</th>
                        <th class="text-truncate" style="max-width: 150px;">Customer</th>
                        <th class="text-truncate" style="max-width: 150px;">Supplier</th>
                        <th class="text-truncate" style="max-width: 150px;">Items</th>
                        <th class="text-truncate" style="max-width: 150px;">Status</th>
                        <th class="text-truncate" style="max-width: 150px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($orders)): ?>
                        <?php foreach ($orders as $order): ?>
                            <tr>
                                <td class="text-truncate" style="max-width: 150px;"><?= htmlspecialchars($order['id']) ?></td>
                                <td class="text-truncate" style="max-width: 150px;"><?= htmlspecialchars($order['date']) ?></td>
                                <td class="text-truncate" style="max-width: 150px;"><?= htmlspecialchars($order['customer_name']) ?></td>
                                <td class="text-truncate" style="max-width: 150px;"><?= htmlspecialchars($order['supplier_name']) ?></td>
                                <td class="text-truncate" style="max-width: 150px;"><?= htmlspecialchars($order['items']) ?></td>
                                <td>
                                    <span class="badge 
                                        <?= $order['status'] == 'Completed' ? 'bg-success' : 
                                        ($order['status'] == 'Pending' ? 'bg-warning' : 
                                        ($order['status'] == 'Cancelled' ? 'bg-danger' : 'bg-secondary')) ?>">
                                        <?= htmlspecialchars($order['status']) ?>
                                    </span>
                                </td>
                                <td w-25 d-flex flex-column gap-2>
                                    <button class="btn btn-sm btn-secondary" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#editStatusModal" 
                                        data-id="<?= htmlspecialchars($order['id']) ?>" 
                                        data-status="<?= htmlspecialchars($order['status']) ?>">
                                        Edit
                                    </button>

                                    <form action="<?= base_url('orders/delete') ?>" method="post">
                                        <input type="hidden" name="order_id" value="<?= $order['id'] ?>">
                                        <button type="submit" class="btn btn-sm btn-danger">Archive</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="7" class="text-center">No orders found.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>

            <!-- Pagination -->
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                            <a class="page-link" href="?search=<?= urlencode($search) ?>&status=<?= urlencode($statusFilter) ?>&page=<?= $i ?>">
                                <?= $i ?>
                            </a>
                        </li>
                    <?php endfor; ?>
                </ul>
            </nav>

    <!-- New Order Modal -->
<div class="modal fade" id="newOrderModal" tabindex="-1" aria-labelledby="newOrderModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newOrderModalLabel">Create New Order</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="newOrderForm" action="<?= base_url('orders/create') ?>" method="post">
                    <!-- Customer Dropdown -->
                    <div class="mb-3">
                        <label for="customerName" class="form-label">Customer Name</label>
                        <select class="form-select" id="customerName" name="customer_id" required>
                            <option value="" selected disabled>Select Customer</option>
                            <?php foreach ($customers as $customer): ?>
                                <option value="<?= htmlspecialchars($customer['customer_id']) ?>">
                                    <?= htmlspecialchars($customer['customer_name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Supplier Dropdown -->
                    <div class="mb-3">
                        <label for="supplierName" class="form-label">Supplier Name</label>
                        <select class="form-select" id="supplierName" name="supplier_id" required>
                            <option value="" selected disabled>Select Supplier</option>
                            <?php foreach ($suppliers as $supplier): ?>
                                <option value="<?= htmlspecialchars($supplier['supplier_id']) ?>">
                                    <?= htmlspecialchars($supplier['supplier_name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Items Textarea -->
                    <div class="mb-3">
                        <label for="orderItems" class="form-label">Items</label>
                        <textarea class="form-control" id="orderItems" name="items" rows="3" required></textarea>
                    </div>

                    <!-- Status Dropdown -->
                    <div class="mb-3">
                        <label for="orderStatus" class="form-label">Status</label>
                        <select class="form-select" id="orderStatus" name="status" required>
                            <option value="Pending">Pending</option>
                            <option value="Completed">Completed</option>
                            <option value="Cancelled">Cancelled</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Create Order</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Status Modal -->
<div class="modal fade" id="editStatusModal" tabindex="-1" aria-labelledby="editStatusModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editStatusModalLabel">Edit Order Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editStatusForm" action="<?= base_url('orders/update_status') ?>" method="post">
                    <?= csrf_field() ?> <!-- CSRF Protection -->
                    <input type="hidden" id="orderId" name="order_id">

                    <!-- Status Dropdown -->
                    <div class="mb-3">
                        <label for="orderStatusEdit" class="form-label">Status</label>
                        <select class="form-select" id="orderStatusEdit" name="status" required>
                            <option value="Pending">Pending</option>
                            <option value="Completed">Completed</option>
                            <option value="Cancelled">Cancelled</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Archive Orders Modal -->
<div class="modal fade" id="archiveModal" tabindex="-1" aria-labelledby="archiveModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="archiveModalLabel">Archived Orders</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Supplier</th>
                            <th>Items</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="archivedOrdersTable">
                        <!-- Orders will be dynamically loaded here -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


    <script>
        // Edit Order Modal
            document.addEventListener('DOMContentLoaded', function () {
        const editStatusModal = document.getElementById('editStatusModal');

        editStatusModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const orderId = button.getAttribute('data-id');
            const status = button.getAttribute('data-status');

            document.getElementById('orderId').value = orderId;
            document.getElementById('orderStatusEdit').value = status;
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
