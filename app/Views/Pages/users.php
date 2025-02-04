<?php include(APPPATH . 'Views/layout/Header.php'); ?>
<head>
    <link href="https://fonts.googleapis.com/css2?family=Karla:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Karla', sans-serif;
        }
        .container {
            margin-top: 3rem;
        }
        h2 {
            font-weight: 700;
            margin-bottom: 2rem;
        }
        .table {
            border-spacing: 0 1rem;
        }
        .table thead th {
            background-color: #a59d84;
            border: none;
            font-weight: 700;
            font-family: 'Karla', sans-serif;
            color: white;
        }
        .table tbody tr {
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .table tbody td {
            border: none;
            padding: 1rem;
            font-family: 'Karla', sans-serif;
        }
        .table tbody tr:hover {
            background-color: #f1f1f1;
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
        <div class="container">
            <h2>Users</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Role</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?= $user['user_id'] ?></td>
                            <td><?= $user['first_name'] ?></td>
                            <td><?= $user['last_name'] ?></td>
                            <td><?= $user['email'] ?></td>
                            <td><?= $user['phone'] ?></td>
                            <td><?= $user['role'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>