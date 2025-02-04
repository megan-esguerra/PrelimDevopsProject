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
                                <button class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#editStatusModal" data-id="<?= $order['id'] ?>" data-status="<?= $order['status'] ?>">Edit</button>

                                <form action="<?= base_url('orders/delete') ?>" method="post" class="d-inline">
                                    <input type="hidden" name="order_id" value="<?= $order['id'] ?>">
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to archive this order?')">Archive</button>
                                </form>
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

    document.addEventListener('DOMContentLoaded', function () {
    const archiveModal = document.getElementById('archiveModal');

    archiveModal.addEventListener('show.bs.modal', function () {
        fetchArchivedOrders();
    });

    function fetchArchivedOrders() {
    fetch("<?= base_url('orders/get_archived') ?>")
        .then(response => {
            if (!response.ok) {
                throw new Error('Failed to fetch data');
            }
            return response.json();
        })
        .then(data => {
            let tableBody = document.getElementById("archivedOrdersTable");
            tableBody.innerHTML = "";

            if (!data || data.length === 0) {
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

    <!-- Bootstrap JS (Ensure Bootstrap is included in your layout/Header.php) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
