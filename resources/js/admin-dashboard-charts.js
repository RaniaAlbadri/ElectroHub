
import Chart from 'chart.js/auto';

const dataElement = document.getElementById(
    'eh-sales-chart-data'
);

if (dataElement) {
    const salesData = JSON.parse(
        dataElement.textContent
    );

    const money = (value) =>
        '$' + Number(value).toLocaleString(
            'en-US',
            {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            }
        );

    function createSalesChart(
        canvasId,
        dataset,
        type,
        color
    ) {
        const canvas = document.getElementById(
            canvasId
        );

        if (!canvas || !dataset) {
            return;
        }

        new Chart(canvas, {
            type: type,

            data: {
                labels: dataset.labels,

                datasets: [{
                    label: 'Completed Demo Sales',
                    data: dataset.values,

                    borderColor: color,

                    backgroundColor:
                        type === 'line'
                            ? 'rgba(36, 119, 238, 0.12)'
                            : color,

                    borderWidth: type === 'line' ? 3 : 0,

                    borderRadius: type === 'bar' ? 7 : 0,

                    fill: type === 'line',

                    tension: 0.35,

                    pointRadius: type === 'line' ? 3 : 0,

                    pointHoverRadius: 6,

                    pointBackgroundColor: color,

                    maxBarThickness: 45
                }]
            },

            options: {
                responsive: true,
                maintainAspectRatio: false,

                interaction: {
                    mode: 'index',
                    intersect: false
                },

                plugins: {
                    legend: {
                        display: false
                    },

                    tooltip: {
                        backgroundColor: '#101b31',

                        titleColor: '#ffffff',

                        bodyColor: '#dce8f9',

                        padding: 12,

                        displayColors: false,

                        callbacks: {
                            label: (context) => {
                                return 'Sales: ' + money(
                                    context.parsed.y
                                );
                            }
                        }
                    }
                },

                scales: {
                    x: {
                        grid: {
                            display: false
                        },

                        ticks: {
                            color: '#718099',
                            maxRotation: 0,
                            autoSkip: true,
                            maxTicksLimit: 8
                        }
                    },

                    y: {
                        beginAtZero: true,

                        grid: {
                            color: '#edf1f7'
                        },

                        border: {
                            display: false
                        },

                        ticks: {
                            color: '#718099',

                            callback: (value) => {
                                return '$' + new Intl.NumberFormat(
                                    'en-US',
                                    { notation: 'compact' }
                                ).format(value);
                            }
                        }
                    }
                }
            }
        });
    }

    // Daily line chart
    createSalesChart(
        'daily-sales-chart',
        salesData.daily,
        'line',
        '#2477ee'
    );

    // Monthly bar chart
    createSalesChart(
        'monthly-sales-chart',
        salesData.monthly,
        'bar',
        '#3e8af7'
    );

    // Yearly bar chart
    createSalesChart(
        'yearly-sales-chart',
        salesData.yearly,
        'bar',
        '#192746'
    );
}
