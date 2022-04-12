<?php
  if(isset($_COOKIE['logedclient'])){
    include("../includes/connection.php");
    $sql = "SELECT * FROM company_details WHERE employee_name='".$_COOKIE['logedclient']."'";
    $query = mysqli_query($connection, $sql);
    if($rows = mysqli_num_rows($query) > 0){
       while($results = mysqli_fetch_array($query)){
         $companyname = $results['company_name'];
         if($companyname){
           setcookie("company",$companyname, time()+3600);
         }
       }
    }else{
      alert("<script>alert('please add company details in the settings to access all data')</script>");
    }
  }else{
      header("location: login.php");
  }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="fontawesome/js/fontawesome.min.js"></script>
    <link rel="stylesheet" href="fontawesome/css/all.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script src="bootstrap/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/index.css">
    <script src="js/index.js"></script>
    <title>all-Aboard | dashboad</title>
</head>
<body>
  <div class="logo">
      <div class="icons"><i class="fas fa-bus"></i> All-Aboard</div>
      <div class="welcome">
        <?php
          echo("Welcome:".$_COOKIE['logedclient']);
        ?>
      </div>
    </div>
    <div class="body">
      <div class="menu">
         <div class="lists">
             <ul>
               <li><i class="fas fa-dashboard"></i> <a href="index.php">Dashboard</a></li>
               <li><i class="fas fa-credit-card"></i> <a href="pricing.php">Pricing</a></li>
               <li><i class="fas fa-map-marked-alt"></i> <a href="routes.php">Routes</a></li>
               <li><i class="fas fa-taxi"></i> <a class="active" href="request.php">Request</a></li>
               <li><i class="fas fa-bus"></i> <a  href="vehilcled.php">Vehicles/Drives</a></li>
               <li><i class="fas fa-cog"></i> <a   href="settings.php">Settings</a></li>
             </ul>
         </div>
      </div>
      <div class="content">
      <?php
             include("../includes/connection.php");
             $history = $_COOKIE['company'];
             $sql = "SELECT * FROM bookings WHERE company_name='".$history."'";
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