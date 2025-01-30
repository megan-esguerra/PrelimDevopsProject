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
    height: 5px;
    padding: 10px;
    border-radius: 10px;
    color: white;
    font-weight: bold;
}

a{
    text-decoration: none;
    color: white;
    font-size: 16px;
}
.form-control{
    border-radius: 10px;
    background: transparent;
}
.main-content {
    flex: 1;
    padding: 20px 40px 20px 240px;
}
.dropdown-item{
    position: relative;
    z-index: 9999;
}
.dropdown-toggle::after {
    display: none; 
}
.navbar {
    display: flex;
    justify-content: space-between;
    position: sticky;
    align-items: center;
    background: #A59D84;
    padding: 10px;
    border-radius: 10px;
}

.search-bar {
    border: 1px solid #ccc;
    padding: 5px;
    border-radius: 5px;
}

.user-profile img {
    border-radius: 50%;
}
.Linechart  {
    background: #D7D3BF;
    width: 60%;
}
.RadarC {
    background: #D7D3BF;
    width: 30%;
}

.card {
    z-index: -1;
    background: #f2ede0;
    padding: 10px;
    border-radius: 10px;
    text-align: center;
}

.table {
    background: white;
}
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
