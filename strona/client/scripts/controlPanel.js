// Pobranie kontekstu elementu canvas
const ctx = document.getElementById('tempChart').getContext('2d');

// Tworzenie nowego wykresu
const myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['08:00', '10:00', '12:00', '14:00', '16:00', '18:00', '20:00'],
        datasets: [{
            label: 'Temperatura (°C)',
            data: [12, 12, 12, 11, 12, 13, 12],
            borderColor: 'rgb(0,71,255)',
            backgroundColor: 'rgba(0,163,255,0.2)',
            borderWidth: 3,
            tension: 0.4,
            fill: true
        }]
    },
    options: {
        responsive: true,
        plugins: {
            title: {
                display: true,
                text: 'Medical box temp'
            },
            tooltip: {
                mode: 'index',
                intersect: false,
            }
        },
        scales: {
            y: {
                min: 8,
                beginAtZero: false,
                ticks: {
                    callback: function(value) {
                        return value + '°C';
                    }
                }
            }
        }
    }
});

function openLocker(lockerNumber) {
    //Obsluga modali od szafki
    const modalID = document.getElementById('infoModal');
    const modal = bootstrap.Modal.getOrCreateInstance(modalID);
    modal.show();
    modalID.addEventListener('shown.bs.modal', function () {
        setTimeout(function () {
            modal.hide();
        }, 1000);
    })

}