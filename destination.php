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
    <script src="js/destination.js"></script>
    <script src="js/dates.js"></script>
    <title>All-Aboard | destination</title>
</head>
<body>
    <div class="body">
        <div class="menu">
            <div class="logo"><i class="fas fa-bus"></i> All-Aboard</div>
            <div class="menu_lists">
                <ul>
                    <li> <i class="fas fa-dashboard"></i> <a  href="index.php">Dashboard</a></li>
                    <li> <i class="fas fa-location"></i> <a class="active" href="destination.php">Destinations</a></li>
                    <li> <i class="fas fa-history"></i><a href="histories.php">Histories</a></li>
                    <li> <i class="fas fa-taxi"></i><a href="services.php">Services</a></li>
                    <li><i class="fas fa-credit-card"></i> <a href="pricing.php">Pricing</a></li>
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
                        <input type="submit" onclick="return validatePricing()" value="search Price" name="searchprices" class="btn btn-primary">
                    </div>
                </form>
            </div>
            <div class="forms_result">
                <table class="table">
                    <thead>
                        <tr>
                        <th>Company</th>
                        <th>From</th>
                        <th>To</th>
                        <th>Driver</th>
                        <th>Depature</th>
                        <th>Arival</th>
                        <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                <?php
                  if(isset($_POST['searchprices'])){
                    include("includes/connection.php");
                    $fromlocation = mysqli_real_escape_string($connection, $_POST['fromlocation']);
                    $tolocation = mysqli_real_escape_string($connection, $_POST['tolocation']);

                    $sql = "SELECT * FROM routes WHERE from_location='".$fromlocation."' AND to_location='".$tolocation."' OR from_location='".$fromlocation."'";
                    $query = mysqli_query($connection, $sql);
                    if($rows = mysqli_num_rows($query) > 0){
                        while($results = mysqli_fetch_array($query)){
                          $from = $results['from_location'];
                          $to = $results['to_location'];
                          $driver = $results['driver_name'];
                          $depature = $results['depatute_time'];
                          $arival = $results['arival_time'];
                          $companyname = $results['company_name'];
                          $postid = $results['post_id'];
                            echo("<tr>");
                            echo("<td>$companyname</td>");
                            echo("<td>$from </td>");
                            echo("<td>$to</td>");
                            echo("<td>$driver</td>");
                            echo("<td>$depature</td>");
                            echo("<td>$arival</td>");
                            echo("<td><form action='' method='post'><input type='submit' name='book' id='$postid' value='Book' onclick='return getUersIds(this.id)' class='bg-success text-light btn'></form></td>");
                            echo("</tr>");
                        }
                    }else{
                        echo("<div class='text-danger text-center text-light'>No posted price for these location</div>");
                    }
                  }else{
                    include("includes/connection.php");
                    $sql = "SELECT * FROM routes ";
                    $query = mysqli_query($connection, $sql);
                    if($rows = mysqli_num_rows($query) > 0){
                        while($results = mysqli_fetch_array($query)){
                          $from = $results['from_location'];
                          $to = $results['to_location'];
                          $driver = $results['driver_name'];
                          $depature = $results['depatute_time'];
                          $arival = $results['arival_time'];
                          $companyname = $results['company_name'];
                          $postid = $results['post_id'];
                            echo("<tr>");
                            echo("<td>$companyname</td>");
                            echo("<td>$from </td>");
                            echo("<td>$to</td>");
                            echo("<td>$driver</td>");
                            echo("<td>$depature</td>");
                            echo("<td>$arival</td>");
                            echo("<td><form action='' method='post'><input type='submit' name='book' id='$postid' value='Book' onclick='return getUersIds(this.id)' class='bg-success text-light btn'></form></td>");
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
          <!-- reseult -->
           <!-- form -->
           <div class="absolute_form" id="absolute_form">
            <div class="travel_dates">
                    <div class="close"><div class="spans"><i onclick="closeForms()" class="fas fa-times-circle"></i></div></div>
                    <div class="texts text-light bg-primary text-center">Pick Travel Date</div>
                    <form action="#" method="post">
                    <?php
                          if(isset($_POST['submitdate'])){
                            include("includes/connection.php");
                            $traveldate = mysqli_real_escape_string($connection, $_POST['traveldate']);
                            $travelid = mysqli_real_escape_string($connection, $_POST['travelid']);
                            $sql = "SELECT * FROM routes WHERE post_id='".$travelid."'";
                            $query = mysqli_query($connection, $sql);
                            if($rows = mysqli_num_rows($query) > 0){
                                while($result = mysqli_fetch_array($query)){
                                    $from = $result['from_location'];
                                    $to = $result['to_location'];
                                    $drive = $result['driver_name'];
                                    $company = $result['company_name'];
                                    $depature = $result['depatute_time'];
                                    $arival = $result['arival_time'];
                                    if($drive){
                                        $sql2 = "SELECT * FROM transport_details WHERE driver_name='".$drive."' AND company_name='".$company."'";
                                        $query2 = mysqli_query($connection, $sql2);
                                        if($rows = mysqli_num_rows($query2) > 0){
                                             while($result_n = mysqli_fetch_array($query2)){
                                                 $travid = $result_n['seats'];
                                                 $modes = $result_n['transport_mode'];
                                                 $seat = rand(1,$travid);
                                                 if(!is_null($seat)){
                                                     $useremails = $_COOKIE['logedin'];
                                                     $travel_id = uniqid(rand(0,10000000000));
                                                     $sql3 = "INSERT INTO bookings(user_email,From_location,To_location,Travel_date,travel_id,seat_number,company_name,transport_mode,bus_id)
                                                       VALUES('$useremails','$from','$to','$traveldate','$travel_id','$seat','$company','$modes','$travelid')";
                                                     $query3 = mysqli_query($connection, $sql3);
                                                     if($query3){
                                                        echo("<script>alert('Booking was successfull, keep time')</script>");
                                                     }else{
                                                         echo("<div class='text-danger text-center'>Error completing your booking, seems all seats are reserved</div>");
                                                     }
                                                 }else{
                                                    echo("<script>alert('Booking has not been activated by the travel company')</script>");
                                                 }
                                             }
                                        }else{
                                            echo("<div class='text-danger text-center'>Error! seem these travel details has been delete or changed by the company</div>");
                                        }
                                    }else{
                                        echo("<script>alert('Booking has not been activated by the travel company')</script>");
                                    }
                                }
                            }else{
                                echo("<script>alert('Booking has not been activated by the travel company')</script>");
                            }
                          }
                        ?>
                    <div class="form-group">
                            <input type="date" name="traveldate" id="traveldate" class="form-control">
                    </div>
                    <div class="form-group" id="travelsids">
                            <input type="text" name="travelid" id="travelid" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="submit" value="submit" onclick="return validateDates()" name="submitdate" class="btn btn-primary">
                    </div>
                    </form>
                </div>
           </div>
           <!-- end of form -->

        </div>
    </div>
</body>
</html>