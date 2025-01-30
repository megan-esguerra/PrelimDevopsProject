// Line Chart
const ctx = document.getElementById('lineChart').getContext('2d');
new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May'],
        datasets: [{
            label: 'Dataset 1',
            data: [10, 20, 40, 60, 30],
            borderColor: 'red',
            fill: false
        },
        {
            label: 'Dataset 2',
            data: [5, 15, 35, 55, 25],
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
