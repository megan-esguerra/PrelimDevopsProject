<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Orders</title>
    <style>
        .active {
            font-weight: bold;
            color: #007bff; /* Bootstrap primary color or any color of your choice */
            text-decoration: underline;
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
            <button class="btn btn-primary">+ New Orders</button>
            <div>
                <button class="btn btn-outline-success">Export to Excel</button>
                <button class="btn btn-outline-secondary">Import Orders</button>
            </div>
        </div>

        <!-- Filters -->
        <div class="mb-3 d-flex gap-3">
            <input type="text" class="form-control w-25" placeholder="Search order ID">
            <input type="date" class="form-control w-25">
            <select class="form-select w-25">
                <option selected>Sales</option>
                <option value="1">Online</option>
                <option value="2">In-store</option>
            </select>
            <select class="form-select w-25">
                <option selected>Status</option>
                <option value="1">Pending</option>
                <option value="2">Completed</option>
            </select>
        </div>

        <!-- Table -->
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
                        <td><?= $order['id'] ?></td>
                        <td><?= $order['date'] ?></td>
                        <td><?= $order['customer'] ?></td>
                        <td><?= $order['sales_channel'] ?></td>
                        <td><?= $order['destination'] ?></td>
                        <td><?= $order['items'] ?></td>
                        <td>
                            <span class="badge <?= $order['status'] == 'Completed' ? 'bg-success' : 'bg-warning' ?>">
                                <?= $order['status'] ?>
                            </span>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
