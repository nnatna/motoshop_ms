

const ctx = document.getElementById('incomeChart').getContext('2d');

new Chart(ctx, {
    type: 'line',
    data: {
        labels: <? php echo $js_months; ?>,
    datasets: [{
        label: 'Monthly Income ($)',
        data: <? php echo $js_amounts; ?>,
        borderColor: '#0d6efd',
        backgroundColor: 'rgba(13, 110, 253, 0.1)',
        borderWidth: 3,
        fill: true,
        tension: 0.4,
        pointRadius: 5,
        pointBackgroundColor: '#0d6efd'
        }]
    },
    options: {
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
        legend: { display: false }
    },
    scales: {
        y: {
            beginAtZero: true,
            grid: { borderDash: [5, 5] },
            ticks: { callback: (value) => '$' + value }
        },
        x: { grid: { display: false } }
    }
}
});
