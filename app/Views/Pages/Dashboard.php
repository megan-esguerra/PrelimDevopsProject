  
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
    <!-- Stock Alert Table -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h5>Stock Alert</h5>
                <div class="table-responsive">
                    <table class="table" style="background: transparent !important">
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Stock Quantity</th>
                                <th>Reorder Level</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($stockAlerts as $product) : ?>
                                <tr>
                                    <td><?= esc($product['product_name']) ?></td>
                                    <td><?= esc($product['stock_quantity']) ?></td>
                                    <td><?= esc($product['reorder_level']) ?></td>
                                    <td>
                                        <?php if ($product['stock_quantity'] == 0) : ?>
                                            <span class="text-danger">Out of Stock</span>
                                        <?php elseif ($product['stock_quantity'] <= $product['reorder_level']) : ?>
                                            <span class="text-warning">Low</span>
                                        <?php else : ?>
                                            <span class="text-success">OK</span>
                                        <?php endif; ?>
                                        
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Top Selling Products Table -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h5>Top Selling Products</h5>
                <div class="table-responsive">
                    <table class="table" style="background: transparent !important">
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Total Sold</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($topSellingProducts as $product) : ?>
                                <tr>
                                    <td><?= esc($product['product_name']) ?></td>
                                    <td><?= esc($product['total_sold']) ?></td>
                                </tr>
                            <?php endforeach; ?>
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
        gradientSales.addColorStop(0, 'rgba(212, 163, 115, 0.76)'); // #D7D3BF (semi-transparent)
        gradientSales.addColorStop(1, 'rgba(212, 163, 115, 0.4)'); // Fully transparent

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
                        borderColor: '#D4A373', // Updated color
                        backgroundColor: gradientSales,
                        fill: true,
                        tension: 0.4,
                        pointRadius: 3,
                        pointBackgroundColor: '#D4A373',
                        pointHoverRadius: 5
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true
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
        
//doughnut chart
document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('radialBarChart').getContext('2d');

        const productLabels = <?= $productLabels ?>; // Fetch labels from PHP
        const productPrices = <?= $productPrices ?>; // Fetch prices from PHP

        new Chart(ctx, {
            type: 'doughnut',
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
                    'rgba(165, 157, 132, 0.86)', // Full opacity Light #A59D84
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
            cutout: '50%', // Keeps the donut effect
            plugins: {
                legend: {
                    position: 'top', // Keeps legend at the top
                    align: 'center', // Centers the legend items
                    labels: {
                        boxWidth: 15, // Adjusts the box size
                        padding: 10,  // Adds space between labels
                        usePointStyle: true, // Uses circles instead of squares
                    }
                }
            }
        }

        });
    });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


</body>
</html>
