<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="icon" type="image/png" href="<?= base_url('img/tabicon.png'); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
          @import url('https://fonts.googleapis.com/css2?family=Karla:ital,wght@0,200..800;1,200..800&family=Noto+Serif+JP:wght@200..900&display=swap');
body {
    display: flex;
    background: #d4ccb6;
    font-family: Arial, sans-serif;
}
.Ims{
    font-family: 'Karla', sans-serif;
    color: black;
    font-weight: bold;
    font-size: 16px;
   
}
span{
    background: #A59D84;
    width: 5px;
    height: 20px;
    font-size: 20px;
    border-radius: 10px;
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

/* Hide sidebar on small screens */
@media (max-width: 768px) {
    .sidebar {
        transform: translateX(-100%);
        width: 200px;
        position: fixed;
        left: 0;
        top: 0;
        bottom: 0;
    }

    .sidebar.show {
        transform: translateX(0);
    }
    .main-content {
    flex: 1;
    width: 100%;
    padding: 5px;
    transition: margin-left 0.3s ease-in-out;
}
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

.dropdown-item{
    position: relative;
    z-index: 9999;
}
.dropdown-toggle::after {
    display: none; 
}

.user-profile img {
    border-radius: 50%;
}
.chart-container{
    gap: 70px;
}
.Linechart  {
    background: #ECEBDE;
    width: 60%;
    border-radius: 25px;
}
.RadarC {
    background: #ECEBDE;
    width: 30%;
    border-radius: 25px;
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
                <h4>+ <?= number_format($revenue, 2) ?></h4>
            </div>
        </div>
    </div>
    <div class="col-md-3">
    <div class="card">
    <div class="card-body">
        <h6>Products Sold</h6>
        <h4><?= number_format($soldProductsCount) ?> Products</h4> 
    </div>
</div>

    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <h6>Purchase</h6>
                <h4>- <?= number_format($purchases, 2) ?></h4>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <h6>Income</h6>
                <h4><?= ($income >= 0) ? '+ ' . number_format($income, 2) : '- ' . number_format(abs($income), 2) ?></h4>
            </div>
        </div>
    </div>
</div>

            <!-- Charts -->
            <div class="row w-full p-5 chart-container">
                <div class="Linechart col-md-8">
                    <canvas id="lineChart"></canvas>
                </div>
                <div class="RadarC p-1 col-md-4">
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
    <script>
    document.getElementById("sidebarToggle").addEventListener("click", function () {
        document.getElementById("sidebar").classList.toggle("show");
    });
</script>

    <script>
        // Line Chart
    const revenueData = <?= json_encode(array_column($monthlyRevenue, 'revenue')) ?>;
    const salesData = <?= json_encode(array_column($monthlySales, 'sales')) ?>;
    const months = <?= json_encode(array_column($monthlyRevenue, 'month')) ?>;

    const ctx = document.getElementById('lineChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: months,
            datasets: [{
                label: 'Revenue',
                data: revenueData,
                borderColor: 'red',
                fill: false
            },
            {
                label: 'Sales',
                data: salesData,
                borderColor: 'yellow',
                fill: false
            }]
        }
    });
        

// Radar Chart
const radarCtx = document.getElementById('radarChart').getContext('2d');
new Chart(radarCtx, {
    type: 'radar',
    data: {
        labels: ['Product A', 'Product B', 'Product C'],
        datasets: [{
            label: 'Sales',
            data: [65, 59, 80],
            backgroundColor: 'rgba(255, 99, 132, 0.2)'
        }]
    }
});

    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


</body>
</html>
