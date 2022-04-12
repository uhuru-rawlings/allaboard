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
    <title>All-Aboard | Ofered services</title>
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
                    <li> <i class="fas fa-taxi"></i><a  class="active" href="services.php">Services</a></li>
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
            <div class="services_flex">
                <a href="road.php">
                    <div class="cards flex_items">
                        <div class="icon"><i class="fas fa-road"></i></div>
                        <div class="text">Road Transport</div>
                    </div>
                </a>
               <a href="rail.php">
                    <div class="cards flex_items">
                        <div class="icon"> <i class="fas fa-subway"></i></div>
                        <div class="text">Rail Transport</div>
                    </div>
               </a>
                <a href="water.php">
                    <div class="cards flex_items">
                        <div class="icon"> <i class="fas fa-ship"></i></i></div>
                        <div class="text">Water Transport</div>
                    </div>
                </a>
               <a href="air.php">
                    <div class="cards flex_items">
                        <div class="icon"> <i class="fas fa-plane-departure"></i></div>
                        <div class="text">Air Transport</div>
                    </div>
               </a>
            </div>
            <div class="fullservice">
                <div class="aboutservices">About</div>
                <div class="paragrap">
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. 
                    In, rem? Dicta sit, eaque natus nihil adipisci quia,
                    quam dolores rem perspiciatis consequuntur commodi sunt? Omnis accusamus mollitia nesciunt fugit nemo.
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. 
                    In, rem? Dicta sit, eaque natus nihil adipisci quia,
                    quam dolores rem perspiciatis consequuntur commodi sunt? Omnis accusamus mollitia nesciunt fugit nemo.
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. 
                    In, rem? Dicta sit, eaque natus nihil adipisci quia,
                    quam dolores rem perspiciatis consequuntur commodi sunt? Omnis accusamus mollitia nesciunt fugit nemo.
                </div>
            </div>
        </div>
    </div>
</body>
</html>