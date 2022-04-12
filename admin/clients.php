<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="fontawesome/js/fontawesome.min.js"></script>
    <link rel="stylesheet" href="fontawesome/css/all.css">
    <link rel="stylesheet" href="css/index.css">
    <script src="js/main.js"></script>
    <title>all-aboard | admin home-page</title>
</head>
<body>
    <div class="menus navbar">
    <div class="logo"><i class="fas fa-bus"></i>All-Aboard</div>
    <div class="users">welcome: <?php echo($_COOKIE['admin'])?></div>
    </div>
    <div class="body">
        <div class="menu">
            <div class="dashboard">
                <ul>
                    <li><i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a></li>
                    <li><i class="fas fa-building"></i>  <a href="companies.php">Companies</a></li>
                    <li><i class="fas fa-traffic-light"></i>  <a href="transport.php">transport</a></li>
                    <li><i class="fas fa-walking"></i>  <a href="clients.php" class="active">Clients</a></li>
                    <li><i class="fas fa-sliders-h"></i>  <a href="settings.php">settings</a></li>
                </ul>
            </div>
        </div>
        <div class="content"></div>
    </div>
</body>
</html>