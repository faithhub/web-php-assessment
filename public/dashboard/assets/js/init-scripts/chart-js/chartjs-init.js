(function($) {
    "use strict";


    var ctx = document.getElementById("team-chart");
    ctx.height = 150;
    var patientDate = document.getElementById("patient_date").value;
    var patientNumber = document.getElementById("patient_number").value;
    console.log(patientDate);
    console.log(patientNumber);
    var ticks = [0, 10, 20, 30, 40, 50, 60, 70, 80, 90];
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: patientDate,
            type: 'line',
            defaultFontFamily: 'Montserrat',
            datasets: [{
                data: [0, patientNumber],
                label: "Expense",
                backgroundColor: 'rgba(0,103,255,.15)',
                borderColor: 'rgba(0,103,255,0.5)',
                borderWidth: 1,
                pointStyle: 'circle',
                pointRadius: 5,
                pointBorderColor: 'transparent',
                pointBackgroundColor: 'rgba(0,103,255,0.5)',
            }, ]
        },
        options: {
            responsive: true,
            tooltips: {
                mode: 'index',
                titleFontSize: 12,
                titleFontColor: '#000',
                bodyFontColor: '#000',
                backgroundColor: '#fff',
                titleFontFamily: 'Montserrat',
                bodyFontFamily: 'Montserrat',
                cornerRadius: 3,
                intersect: false,
            },
            legend: {
                display: false,
                position: 'top',
                labels: {
                    usePointStyle: true,
                    fontFamily: 'Montserrat',
                },


            },
            scales: {
                xAxes: [{
                    display: true,
                    gridLines: {
                        display: false,
                        drawBorder: false
                    },
                    scaleLabel: {
                        display: true,
                        labelString: 'Date'
                    }
                }],
                yAxes: [{
                    display: true,
                    beginAtZero: true,
                    ticks: {
                        min: 1,
                        beginAtZero: true,

                        // autoSkip: false,
                        // min: ticks[ticks.length - 1],
                        // max: ticks[0]
                    },

                    gridLines: {
                        display: false,
                        drawBorder: false
                    },
                    scaleLabel: {
                        display: true,
                        labelString: 'No. of Patients'
                    }
                }]
            },
            title: {
                display: false,
            }
        }
    });

})(jQuery);