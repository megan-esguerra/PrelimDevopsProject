<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Orders</title>
    <style>
        body {
            display: flex;
            background: #d4ccb6;
            font-family: Arial, sans-serif;
        }

        .sidebar {
            width: 200px;
            height: 100vh;
            position: fixed;
            background: #D7D3BF;
            padding: 20px;
            color: white;
            border-right: 1px solid rgb(162, 160, 150);
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
        }

        .sidebar ul li {
            padding: 10px;
            cursor: pointer;
        }

        .sidebar ul li a.active {
            background-color: #A59D84;
            padding: 10px;
            border-radius: 10px;
            color: white;
            font-weight: bold;
        }

        a {
            text-decoration: none;
            color: white;
            font-size: 16px;
        }

        .form-control {
            border-radius: 10px;
            background: transparent;
        }

        .main-content {
            flex: 1;
            padding: 20px 40px 20px 240px;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #A59D84;
            padding: 10px;
            border-radius: 10px;
        }

        .card {
            background: #f2ede0;
            padding: 10px;
            border-radius: 10px;
            text-align: center;
        }

        .table {
            background: white;
        }

        .badge {
            text-transform: capitalize;
        }

        .modal-content {
            background: #f9f9f9;
        }

        .modal-title {
            font-weight: bold;
        }

        .btn-primary {
            background-color: #A59D84;
            border-color: #A59D84;
        }

        .btn-primary:hover {
            background-color: #8e846c;
            border-color: #8e846c;
        }
    </style>
</head>
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
                <button class="btn btn-primary" onclick="window.location.href='<?= base_url('orders/newOrder'); ?>'">+ New Order</button>
                <div>
                    <button class="btn btn-outline-success" onclick="window.location.href='/orders/export';">Export to Excel</button>
                    <button class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#importModal">Import Orders</button>
                </div>
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
                        <th scope="col"><input type="checkbox"></th>
                        <th scope="col">Order ID</th>
                        <th scope="col">Date</th>
                        <th scope="col">Customer</th>
                        <th scope="col">Sales Channel</th>
                        <th scope="col">Destination</th>
                        <th scope="col">Items</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order): ?>
                        <tr>
                            <td><input type="checkbox"></td>
                            <td><?= htmlspecialchars($order['id']) ?></td>
                            <td><?= htmlspecialchars($order['date']) ?></td>
                            <td><?= htmlspecialchars($order['customer']) ?></td>
                            <td><?= htmlspecialchars($order['sales_channel']) ?></td>
                            <td><?= htmlspecialchars($order['destination']) ?></td>
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
                                        <!-- commit -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
