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
    <title>All-Aboard | Travel-Histories</title>
</head>
<body>
    <div class="body">
        <div class="menu">
            <div class="logo"><i class="fas fa-bus"></i> All-Aboard</div>
            <div class="menu_lists">
                <ul>
                    <li> <i class="fas fa-dashboard"></i> <a  href="index.php">Dashboard</a></li>
                    <li> <i class="fas fa-location"></i> <a href="destination.php">Destinations</a></li>
                    <li> <i class="fas fa-history"></i><a class="active" href="histories.php">Histories</a></li>
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
           <?php
             include("includes/connection.php");
             $history = $_COOKIE['logedin'];
             $sql = "SELECT * FROM bookings WHERE user_email='".$history."'";
             $query = mysqli_query($connection, $sql);
             if($rows = mysqli_num_rows($query) > 0){
               while($results = mysqli_fetch_assoc($query)){
                   $from = $results['From_location'];
                   $dest = $results['To_location'];
                   $tdate = $results['Travel_date'];
                   $tid = $results['travel_id'];
                   $snumber = $results['seat_number'];
                   $bdate = $results['booking_date'];
                   $cname = $results['company_name'];
                   $tmode = $results['transport_mode'];
                   echo("<div class='card travelhist'>");
                   echo("<div class='top'>");
                   echo("<span> Location :</span> " .strtolower($from));
                   echo("<span> Destination :</span> " .$dest);
                   echo("<br/>");
                   echo("<span> Travel Date :</span> " .$tdate);
                   echo("<span> Travel Id :</span> " .$tid);
                   echo("</div>");
                   echo("<div class='toogle text-primary'><span id='detailed'>show more..</span> <div class='allclicks'><span><i id='$tid' class='fas fa-angle-up' title='show less' onclick='showless(this.id)'></i></span><span><i id='$tid' class='fas fa-angle-down' title='show more' onclick='showmore(this.id)'></i></span></div></div>");
                   echo("<div class='hiden $tid'>");
                   echo("<br/>");
                   echo("<span> SeatNumber :</span>" .$snumber);
                   echo("<br/>");
                   echo("<span> Booking date :</span> " .$bdate);
                   echo("<br/>");
                   echo("<span> Means :</span> " .$tmode);
                   echo("<br/>");
                   echo("<span> Company :</span> " .$cname);
                   echo("</div>");
                   echo("</div>");
               }
             }else{
                 echo("<div class='text-center text-danger'>You have no travel details, go <a href='destination.php'>Destinations</a> to book a travel</div>");
             }
           ?>
        </div>
    </div>
</body>
</html>