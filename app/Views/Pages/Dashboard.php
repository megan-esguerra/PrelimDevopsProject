<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="icon" type="image/png" href="<?= base_url('img/tabicon.png'); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('css/style.css'); ?>">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

    <!-- Sidebar -->
  
    <?php include(APPPATH . 'Views/layout/sidebar.php'); ?>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Navbar -->
        <?php include(APPPATH . 'Views/layout/navbar.php'); ?>

        <!-- Cards -->
        <div class="container mt-3">
            <div class="row">
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h6>Revenue</h6>
                            <h4>+ 30,000</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h6>Sales Return</h6>
                            <h4>+ 30,000</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h6>Purchase</h6>
                            <h4>+ 30,000</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h6>Income</h6>
                            <h4>+ 30,000</h4>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts -->
            <div class="row mt-4">
                <div class="col-md-8">
                    <canvas id="lineChart"></canvas>
                </div>
                <div class="col-md-4">
                    <canvas id="radarChart"></canvas>
                </div>
            </div>

            <!-- Tables -->
            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5>Stock Alert</h5>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Date</th>
                                        <th>Quantity</th>
                                        <th>Alert Amt.</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>123</td>
                                        <td>2024-01-01</td>
                                        <td>10</td>
                                        <td>5</td>
                                        <td>Low</td>
                                    </tr>
                                    <tr>
                                        <td>456</td>
                                        <td>2024-01-02</td>
                                        <td>20</td>
                                        <td>8</td>
                                        <td>Medium</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5>Top Selling Products</h5>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Quantity</th>
                                        <th>Alert Amt.</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>789</td>
                                        <td>50</td>
                                        <td>20</td>
                                    </tr>
                                    <tr>
                                        <td>101</td>
                                        <td>30</td>
                                        <td>15</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div> <!-- Container -->
    </div>

    <script src="<?= base_url('js/script.js'); ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


</body>
</html>
