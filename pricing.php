<?php
  include("includes/cookie.php");
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script src="bootstrap/js/bootstrap/bootstrap.min.js"></script>
    <script src="fontawesome/js/fontawesome.min.js"></script>
    <link rel="stylesheet" href="fontawesome/css/all.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/index.js"></script>
    <script src="js/map.js"></script>
    <title>All-Aboard | Transport Cost Analysis</title>
</head>
<body>
    <div class="body">
        <div class="menu">
            <div class="logo"><i class="fas fa-bus"></i> All-Aboard</div>
            <div class="menu_lists">
                <ul>
                    <li> <i class="fas fa-dashboard"></i> <a  href="index.php">Dashboard</a></li>
                    <li> <i class="fas fa-location"></i> <a href="destination.php">Destinations</a></li>
                    <li> <i class="fas fa-history"></i><a href="histories.php">Histories</a></li>
                    <li> <i class="fas fa-taxi"></i><a href="services.php">Services</a></li>
                    <li><i class="fas fa-credit-card"></i> <a class="active" href="pricing.php">Pricing</a></li>
                    <li><i class="far fa-comment-dots"></i> <a href="chart.php">chart</a></li>
                    <li><i class="fas fa-cog"></i><a href="settings.php">setting</a></li>
                </ul>
            </div>
            <div class="login">
            <?php
                   if(isset($_COOKIE['logedin'])){
                       include("includes/connection.php");
                       $sql = "SELECT * FROM registratioin_table WHERE  user_ids='".$_COOKIE['logedin']."'";
                       $query = mysqli_query($connection, $sql);
                       if($rows = mysqli_num_rows($query) > 0){
                            while($result = mysqli_fetch_array($query)){
                                $images = "uploads/".$result['user_images'];
                                $user_ids = $result['user_ids'];
                                echo("<img src='".$images."' width='40px' height='40px'>");
                                echo("<p>$user_ids</p>");
                            }
                       }else{

                       }
                   }
                ?>
            </div>
        </div>
        <div class="content">
            <div class="form search">
                <h3>Search Location-Price</h3>
                <form action="#" method="post">
                    <div class="form-group">
                        <input type="text" name="fromlocation" onfocus="removeErrors(this.id)" id="fromlocation" placeholder="Enter fromLocation" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="text" name="tolocation" onfocus="removeErrors(this.id)" id="tolocation" placeholder="Enter toLocation" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="submit" onclick="return validatePricing()" value="search Price" name="searchprice" class="btn btn-primary">
                    </div>
                </form>
            </div>
            <div class="forms_result">
                <table class="table">
                    <thead>
                        <tr>
                            <th>From</th>
                            <th>To</th>
                            <th>Price</th>
                            <th>Company</th>
                        </tr>
                    </thead>
                    <tbody>
                <?php
                  if(isset($_POST['searchprice'])){
                    include("includes/connection.php");
                    $fromlocation = mysqli_real_escape_string($connection, $_POST['fromlocation']);
                    $tolocation = mysqli_real_escape_string($connection, $_POST['tolocation']);

                    $sql = "SELECT * FROM pricing WHERE from_location='".$fromlocation."' AND to_location='".$tolocation."' OR from_location='".$fromlocation."' ORDER BY price ASC";
                    $query = mysqli_query($connection, $sql);
                    if($rows = mysqli_num_rows($query) > 0){
                        while($result = mysqli_fetch_array($query)){
                            $from = $result['from_location'];
                            $to = $result['to_location'];
                            $price = $result['price'];
                            $companyname = $result['company_name'];
                            echo("<tr>");
                            echo("<td>$from</td>");
                            echo("<td>$to</td>");
                            echo("<td>$price.00/=</td>");
                            echo("<td>$companyname</td>");
                            echo("</tr>");
                        }
                    }else{
                        echo("<div class='text-danger text-center text-light'>No posted price for these location</div>");
                    }
                  }else{
                    include("includes/connection.php");
                    $sql = "SELECT * FROM pricing ORDER BY price ASC";
                    $query = mysqli_query($connection, $sql);
                    if($rows = mysqli_num_rows($query) > 0){
                        while($result = mysqli_fetch_array($query)){
                            $from = $result['from_location'];
                            $to = $result['to_location'];
                            $price = $result['price'];
                            $companyname = $result['company_name'];
                            echo("<tr>");
                            echo("<td>$from</td>");
                            echo("<td>$to</td>");
                            echo("<td>$price.00/=</td>");
                            echo("<td>$companyname</td>");
                            echo("</tr>");
                        }
                    }else{
                        echo("<div class='text-danger text-center'>No posted price</div>");
                    }
                  }
                ?>
                 </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>