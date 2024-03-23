<script>
    const trans_received_type = document.getElementById('trans_received_type');
    new Chart(trans_received_type, {
    type: 'horizontalBar',
    data: {
        labels: ["Regular Transactions", "Special Transactions"],
        datasets: [{
        maxBarThickness: 30,
        // label: 'Number of Transactions Received Today',
        data: [<?php echo $chart->transReceivedREG().', '.$chart->transReceivedSP(); ?> ],
        backgroundColor: [
            'rgba(41, 41, 110, 0.6)',
            'rgba(245, 40, 145, 0.6)',
        ],
        borderColor: [
            'rgba(41, 41, 110, 1)', 
            'rgba(245, 40, 145, 1)',
        ],
        borderWidth:0.75,
        }]
    },
    options: {
        legend: {
            display: false
        },

        scales: {
            xAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
    });
    </script>

<script>
    const schoolbar = document.getElementById('trans_received_type2');
    new Chart(schoolbar, {
    type: 'horizontalBar',
    data: {
        labels: ["Transactions Received", "Transactions Done"],
        datasets: [{
        maxBarThickness: 30,
        // label: 'Number of Transactions Received Today',
        data: [<?php echo $chart->transReceivedTotal().', '.$chart->transDoneTotal(); ?> ],
        backgroundColor: [
            'rgba(247, 0, 0, 0.6)',
            'rgba(0, 163, 10, 0.6)'
        ],
        borderColor: [
            'rgba(247, 0, 0, 0.6)',
            'rgba(0, 163, 10, 0.6)'
        ],
        borderWidth:0.75,
        }]
    },
    options: {
        legend: {
            display: false
        },

        scales: {
            xAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
    });
    </script>


<script>
    const tally = document.getElementById('tally');
    new Chart(tally, {
    type: 'horizontalBar',
    data: {
        labels: <?php echo '
                     [" '.implode(' ", " ',$chart->encoderNamesREG()).' ",
                      " '.implode(' ", " ',$chart->encoderNamesSP()).' "] ' ?>,
        datasets: [{
        //maxBarThickness: 40,
        label: 'Number of Completed Requests Done',
        data: <?php echo '
                    [" '.implode(' ", " ',$chart->countDailyTaskDoneREG()).' ",
                     " '.implode(' ", " ',$chart->countDailyTaskDoneSP()).' "] ' ?>,
        backgroundColor: [
            'rgba(41, 41, 110, 0.6)',
            'rgba(41, 41, 110, 0.6)',
            'rgba(41, 41, 110, 0.6)',
            'rgba(41, 41, 110, 0.6)',
            'rgba(41, 41, 110, 0.6)',
            'rgba(41, 41, 110, 0.6)',
            'rgba(41, 41, 110, 0.6)',
            'rgba(41, 41, 110, 0.6)',
            'rgba(41, 41, 110, 0.6)',
            'rgba(41, 41, 110, 0.6)',
            'rgba(41, 41, 110, 0.6)',
            'rgba(41, 41, 110, 0.6)',
            'rgba(41, 41, 110, 0.6)',
            'rgba(41, 41, 110, 0.6)',
            'rgba(41, 41, 110, 0.6)'
        ],
        borderColor: [
            'rgba(41, 41, 110, 1)',
            'rgba(41, 41, 110, 1)',
            'rgba(41, 41, 110, 1)',
            'rgba(41, 41, 110, 1)',
            'rgba(41, 41, 110, 1)',
            'rgba(41, 41, 110, 1)',
            'rgba(41, 41, 110, 1)',
            'rgba(41, 41, 110, 1)',
            'rgba(41, 41, 110, 1)',
            'rgba(41, 41, 110, 1)',
            'rgba(41, 41, 110, 1)',
            'rgba(41, 41, 110, 1)',
            'rgba(41, 41, 110, 1)',
            'rgba(41, 41, 110, 1)',
            'rgba(41, 41, 110, 1)'
        ],
        borderWidth:0.75,
        }]
    },
    options: {
        legend: {
            display: false
        },
        scales: {
            xAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
    });
</script>

<script>
    const history = document.getElementById('history');
    new Chart(history, {
    type: 'line',
    data: {
        labels: <?php echo '
                     [" '.implode(' ", " ',$chart->getLastSevenDays()).' ",
                      " '.date("Y-m-d").' "] ' ?>,
        datasets: [
            {
                label: 'Regular Transactions',
                data: <?php echo '
                    [" '.implode(' ", " ',$chart->getCountAppSevenDaysREG()).' ",
                     " '.$chart->getCountAppTodayREG().' "] ' ?>,
                backgroundColor: 'rgba(0, 0, 0, 0.0)',
                borderColor: 'rgba(41, 41, 110, 1)',
                borderWidth:1.25,
            },
            {
                label: 'Special Transactions',
                data: <?php echo '
                    [" '.implode(' ", " ',$chart->getCountAppSevenDaysSP()).' ",
                     " '.$chart->getCountAppTodaySP().' "] ' ?>,
                backgroundColor: 'rgba(0, 0, 0, 0.0)',
                borderColor: 'rgba(245, 40, 145, 1)',
                borderWidth:1.25,
            }
        ]
    },
    options: {
        scales: {
            xAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
    });
</script>

    
    <!-- <script>
    const schoolbar = document.getElementById('chart_schools');
    new Chart(schoolbar, {
    type: 'horizontalBar',
    data: {
        labels: <?php //echo'["' . implode('", "', $viewchart->viewTransferredSchoolNames()) . '"]' ?>,
        datasets: [{
        //maxBarThickness: 40,
        label: 'Number of Students Transferred to Other Universities',
        data: <?php //echo '[' . implode(', ', $viewchart->viewTransferredSchoolTotal()) . ']' ?>,
        backgroundColor: [
            'rgb(41, 41, 110)',
            'rgb(41, 41, 110)',
            'rgb(41, 41, 110)',
            'rgb(41, 41, 110)',
            'rgb(41, 41, 110)',
            'rgb(41, 41, 110)',
            'rgb(41, 41, 110)',
            'rgb(41, 41, 110)',
            'rgb(41, 41, 110)',
            'rgb(41, 41, 110)',
            'rgb(41, 41, 110)',
            'rgb(41, 41, 110)',
            'rgb(41, 41, 110)',
            'rgb(41, 41, 110)',
            'rgb(41, 41, 110)',
            'rgb(41, 41, 110)',
            'rgb(41, 41, 110)',
            'rgb(41, 41, 110)',
            'rgb(41, 41, 110)',
            'rgb(41, 41, 110)'
        ],
        }]
    },
    options: {
        scales: {
            xAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
    });
    </script> -->