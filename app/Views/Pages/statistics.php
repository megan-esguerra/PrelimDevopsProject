  
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
                <div class="LinechartS col-md-8">
                    <canvas id="lineChart"></canvas>
                </div>
                <div class="RadarCS p-1 col-md-4">
                <canvas id="polarChart"></canvas>
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
                            display: true
                        }
                    },
                    y: {
                        grid: {
                            display: true
                        },
                        ticks: {
                            display: true
                        }
                    }
                }
            }
        });
        

// Polar Area Chart
        document.addEventListener('DOMContentLoaded', function () {
            const polarCtx = document.getElementById('polarChart').getContext('2d');

            const productLabels = <?= $productLabels ?>; // Fetch labels from PHP
            const productPrices = <?= $productPrices ?>; // Fetch prices from PHP

            new Chart(polarCtx, {
                type: 'polarArea',
                data: {
                    labels: productLabels,
                    datasets: [{
                        label: 'Product Prices',
                        data: productPrices,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.5)',
                            'rgba(54, 162, 235, 0.5)',
                            'rgba(255, 206, 86, 0.5)',
                            'rgba(75, 192, 192, 0.5)',
                            'rgba(153, 102, 255, 0.5)',
                            'rgba(255, 159, 64, 0.5)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        r: {
                            pointLabels: {
                                display: true, // Show labels
                                font: {
                                    size: 14
                                }
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            position: 'top'
                        }
                    }
                }
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


</body>
</html>
