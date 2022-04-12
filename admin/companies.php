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
                    <li><i class="fas fa-building"></i>  <a href="companies.php" class="active">Companies</a></li>
                    <li><i class="fas fa-traffic-light"></i>  <a href="transport.php">transport</a></li>
                    <li><i class="fas fa-walking"></i>  <a href="clients.php">Clients</a></li>
                    <li><i class="fas fa-sliders-h"></i>  <a href="settings.php">settings</a></li>
                </ul>
            </div>
        </div>
        <div class="content">
            <h5>Manage Companies</h5>

            <div class="tables">
            <?php
               include("../includes/connection.php");
               $sql = "SELECT * FROM company_details";
               $query = mysqli_query($connection, $sql);
               if($rows = mysqli_num_rows($query) > 0){
                   echo("<table class='table table-responsive table-bordered table-dark'>");
                   echo("<thead>");
                   echo("<tr>");
                   echo("<th scope='col'>#</th>");
                   echo("<th scope='col'>company</th>");
                   echo("<th scope='col'>Transport</th>");
                   echo("<th scope='col'>Added date</th>");
                //    echo("<th scope='col'>Action</th>");
                   echo("</tr>");
                   echo("</thead>");
                   echo("<tbody>");
                   while($results = mysqli_fetch_array($query)){
                       $id = $results['id'];
                       $company = $results['company_name'];
                       $mode =  $results['Transport_mode'];
                       $dates = $results['added_date'];
                        echo("<tr>");
                        echo("<td>$id</td>");
                        echo("<td>$company</td>");
                        echo("<td>$mode</td>");
                        echo("<td>$dates</td>");
                        // echo("<td></td>");
                        echo("</tr>");
                        echo("</tbody>");
                   }
               }else{
                    echo("<table class='table table-responsive table-dark'>");
                    echo("<thead>");
                    echo("<tr>");
                    echo("<th>#</th>");
                    echo("<th>company</th>");
                    echo("<th>Transport</th>");
                    echo("<th>Added date</th>");
                    echo("<th>Action</th>");
                    echo("</tr>");
                    echo("</thead>");
                    echo("<tbody>");
                    echo("<tr>");
                    echo("<td colspan='5' class='text-center'>No Data posted</td>");
                    echo("</tr>");
                    echo("</tbody>");
               }
            ?>
            </div>
        </div>
    </div>
</body>
</html>