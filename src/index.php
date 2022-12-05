<!doctype html>
<html lang="en">

<head>
    <title>Irrigation Web-App</title>
    <meta charset="utf-8">
    <meta name="author" content="Janik Ahlers">
    <meta property="og:title" content="Irrigation Web-App">
    <meta property="og:type" content="website">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <meta property="og:url" content="http://localhost/"> -->

    <meta name="description" content="A web-app, that generates and show a graph of humidity history. \
    The data is received from an arduino irrigation system">
    <meta property="og:description" content="A web-app, that generates and show a graph of humidity history. \
    The data is received from an arduino irrigation system">

    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/navbar.css">
    <script src='node_modules/jquery/dist/jquery.js'></script>
    <script src="node_modules/chart.js/dist/chart.umd.js"></script>
</head>

<body>
    <div id="mainGrid">
        <div id="menu">
            <div class="menu-icon-wrapper">
                <div class="menu-icon" onclick="toggleCssMenu(this)">
                    <div class="three-line">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>
            </div>
            <div id="cssmenu">
                <ul>
                    <li><a href="#">Portfolio</a></li>
                    <li><a href="#">Creative</a></li>
                    <li><a href="#">Studio</a></li>
                    <li><a href="#">Press</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>
        </div>
        <div id="mainBox">
            <canvas id="humidityChart"></canvas>
        </div>
    </div>

    <script src="js/navbar.js"></script>
    <script src="js/humidityChart.js"></script>
</body>

</html>