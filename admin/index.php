
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
                    <li><i class="fa fa-dashboard"></i>  <a href="index.php" class="active">Dashboard</a></li>
                    <li><i class="fas fa-building"></i>  <a href="companies.php">Companies</a></li>
                    <li><i class="fas fa-traffic-light"></i>  <a href="transport.php">transport</a></li>
                    <li><i class="fas fa-walking"></i>  <a href="clients.php">Clients</a></li>
                    <li><i class="fas fa-sliders-h"></i>  <a href="settings.php">settings</a></li>
                </ul>
            </div>
        </div>
        <div class="content">
            <div class="top-menu">
                <div class="card" title="admins">
                  <div class="flex_card">    
                    <div class="icons"><i class="fas fa-user-lock"></i></div>
                    <div class="number"><div class="nums">
                        <?php
                          include("../includes/connection.php");
                          $sql = "SELECT * FROM admins";
                          $query = mysqli_query($connection, $sql);
                          echo(mysqli_num_rows($query))
                        ?>
                    </div></div>
                  </div>
                </div>
                <div class="card" title="companies">
                  <div class="flex_card">    
                    <div class="icons"><i class="fas fa-building"></i> </div>
                    <div class="number"><div class="nums">
                        <?php
                          include("../includes/connection.php");
                          $sql = "SELECT * FROM company_details";
                          $query = mysqli_query($connection, $sql);
                          echo(mysqli_num_rows($query))
                        ?>
                    </div></div>
                  </div>
                </div>
                <div class="card" title="clients">
                  <div class="flex_card">    
                    <div class="icons"><i class="fas fa-walking"></i> </div>
                    <div class="number"><div class="nums">
                        <?php
                          include("../includes/connection.php");
                          $sql = "SELECT * FROM registratioin_table";
                          $query = mysqli_query($connection, $sql);
                          echo(mysqli_num_rows($query))
                        ?>
                    </div></div>
                  </div>
                </div>
            </div>
            <div class="flex_lower">
                <div class="companies">
                        <?php
                          include("../includes/connection.php");
                          $sql = "SELECT * FROM company_details";
                          $query = mysqli_query($connection, $sql);
                          echo(mysqli_num_rows($query))
                        ?>
                </div>
                <div class="clients">
                        <?php
                          include("../includes/connection.php");
                          $sql = "SELECT * FROM registratioin_table";
                          $query = mysqli_query($connection, $sql);
                          echo(mysqli_num_rows($query))
                        ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>