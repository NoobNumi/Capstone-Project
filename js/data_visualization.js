// DATA VISUALIZATION (BAR GRAPH)

const ctx = document.getElementById('myChart');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Recollection', 'Reception', 'Trainings', 'Seminars', 'Retreat'],
        datasets: [{
            label: 'Total of Reservations for the Month of June, 2023',
            data: [200, 50, 20, 50, 500],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
