  
    <?php include(APPPATH . 'Views/layout/Header.php'); ?>
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
            <div class="row w-full p-3 chart-container">
                <div class="Linechart col-md-8">
                    <canvas id="lineChart"></canvas>
                </div>
                <div class="RadarC p-1 col-md-4">
                <canvas id="radialBarChart"></canvas>
                </div>
            </div>

            <!-- Tables -->
            <div class="row mt-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h5>Stock Alert</h5>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
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
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h5>Top Selling Products</h5>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
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

// Create a gradient for revenue
const gradientRevenue = ctx.createLinearGradient(0, 0, 0, 400);
gradientRevenue.addColorStop(0, 'rgba(165, 157, 132, 0.87)'); 
gradientRevenue.addColorStop(1, 'rgba(165, 157, 132, 0.42)'); // Fully transparent

// Create a gradient for sales
const gradientSales = ctx.createLinearGradient(0, 0, 0, 400);
gradientSales.addColorStop(0, 'rgba(215, 211, 191, 0.77)'); // #D7D3BF (semi-transparent)
gradientSales.addColorStop(1, 'rgba(215, 211, 191, 0.48)'); // Fully transparent

new Chart(ctx, {
    type: 'line',
    data: {
        labels: months,
        datasets: [
            {
                label: 'Revenue',
                data: revenueData,
                borderColor: '#A59D84', // Updated color
                backgroundColor: gradientRevenue,
                fill: true,
                tension: 0.4,
                pointRadius: 3,
                pointBackgroundColor: '#A59D84',
                pointHoverRadius: 5
            },
            {
                label: 'Sales',
                data: salesData,
                borderColor: '#D7D3BF', // Updated color
                backgroundColor: gradientSales,
                fill: true,
                tension: 0.4,
                pointRadius: 3,
                pointBackgroundColor: '#D7D3BF',
                pointHoverRadius: 5
            }
        ]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                display: false
            }
        },
        scales: {
            x: {
                grid: {
                    display: false
                }
            },
            y: {
                grid: {
                    display: false
                },
                ticks: {
                    display: false
                }
            }
        }
    }
});
        

const productChart = new Chart(polarCtx, {
    type: 'polarArea',
    data: {
        labels: productLabels,
        datasets: [
            {
                label: 'Product Prices Layer 1',
                data: productPrices.map(value => value * 0.5), // First layer (50%)
                backgroundColor: [
                    'rgba(165, 157, 132, 0.3)', // Light #A59D84 (30% opacity)
                    'rgba(133, 123, 98, 0.3)',  // Darker #857B62
                    'rgba(165, 157, 132, 0.3)',
                    'rgba(133, 123, 98, 0.3)',
                    'rgba(165, 157, 132, 0.3)',
                    'rgba(133, 123, 98, 0.3)'
                ],
                borderWidth: 1
            },
            {
                label: 'Product Prices Layer 2',
                data: productPrices.map(value => value * 0.8), // Second layer (80%)
                backgroundColor: [
                    'rgba(165, 157, 132, 0.6)', // Light #A59D84 (60% opacity)
                    'rgba(133, 123, 98, 0.6)',  // Darker #857B62
                    'rgba(165, 157, 132, 0.6)',
                    'rgba(133, 123, 98, 0.6)',
                    'rgba(165, 157, 132, 0.6)',
                    'rgba(133, 123, 98, 0.6)'
                ],
                borderWidth: 1
            },
            {
                label: 'Product Prices Layer 3',
                data: productPrices, // Outermost layer (Full value)
                backgroundColor: [
                    'rgba(165, 157, 132, 1)', // Full opacity Light #A59D84
                    'rgba(133, 123, 98, 1)',  // Full opacity Darker #857B62
                    'rgba(165, 157, 132, 1)',
                    'rgba(133, 123, 98, 1)',
                    'rgba(165, 157, 132, 1)',
                    'rgba(133, 123, 98, 1)'
                ],
                borderWidth: 1
            }
        ]
    },
    options: {
        responsive: true,
        cutout: '50%', // Adjust for donut-like effect
        plugins: {
            legend: {
                position: 'top',
                labels: {
                    boxWidth: 15,
                    padding: 10,
                    usePointStyle: true
                }
            }
        }
    }
});

    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


</body>
</html>
