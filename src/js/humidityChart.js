const humidityCanvas = document.getElementById('humidityChart');
var timestamps = [];
var humidity_levels = [];

$.ajax({
    method: "GET",
    url: "/php/hchart.php",
    dataType: "html",
    success: function(data) {
        var obj = JSON.parse(data);
        for (var i in obj) {
            timestamps.push(obj[i].timestamp);
            humidity_levels.push(obj[i].humidity_level);
        }
        const chartData = {
            labels: timestamps,
            datasets: [{
                label: 'Feuchtigkeitslevel ihres Bewässerungssystems',
                fill: true,
                data: humidity_levels,
                borderWidth: 2,
                backgroundColor: "#00AFD3",
                borderColor: "#003758"
            }]
        }

        const config = {
            type: 'line',
            data: chartData,
            options: {
                scales: {
                    x: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Zeitstempel'
                        },
                        ticks: {
                            major: {
                                enabled: true
                            },
                            color: (context) => context.tick && context.tick.major && '#FF0000',
                            font: function(context) {
                                if (context.tick && context.tick.major) {
                                    return {
                                        weight: 'bold'
                                    };
                                }
                            }
                        }
                    },
                    y: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Feuchtigkeitslevel'
                        },
                        min: 0,
                        max: 1000
                    }
                }
            }
        }

        // Canvas for humidity chart
        new Chart(humidityCanvas, config);
    },
    error: function() {
        alert('Error occured');
    }
})