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
    <script src="js/vehicles.js"></script>
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
               <li><i class="fas fa-map-marked-alt"></i> <a class="active" href="routes.php">Routes</a></li>
               <li><i class="fas fa-taxi"></i> <a  href="request.php">Request</a></li>
               <li><i class="fas fa-bus"></i> <a  href="vehilcled.php">Vehicles/Drives</a></li>
               <li><i class="fas fa-cog"></i> <a   href="settings.php">Settings</a></li>
             </ul>
         </div>
      </div>
      <div class="content">
      <div class="forms">
          <div class="texts">Travel Routes</div>
          <div class="form-group">
            <?php
               if(isset($_POST['submits'])){
                include("../includes/connection.php");
                $fromlocation = strtoupper(mysqli_real_escape_string($connection, $_POST['fromlocation']));
                $tolocation = mysqli_real_escape_string($connection, $_POST['tolocation']);
                $drivername = mysqli_real_escape_string($connection, $_POST['drivername']);
                $depature = mysqli_real_escape_string($connection, $_POST['depaturetime']);
                $arival = mysqli_real_escape_string($connection, $_POST['arivaltime']);
                $company = $_COOKIE['company'];
                $sql = "SELECT * FROM routes WHERE driver_name='".$drivername."' AND depatute_time='".$depature."'";
                $query = mysqli_query($connection, $sql);
                if($rows = mysqli_num_rows($query) < 1){
                    $randid = uniqid(rand(0,10000000));
                   $sql = "INSERT INTO routes(from_location,to_location,driver_name,depatute_time,arival_time,company_name,post_id)
                       VALUES('$fromlocation','$tolocation','$drivername','$depature','$arival','$company','$randid')";
                   $query = mysqli_query($connection, $sql);
                   if($query){
                    echo("<div class='text-success text-center'>Data added successfully</div>");
                   }else{
                    echo("<div class='text-danger text-center'>Error submitting details, reload and try again</div>");
                   }
                }else{
                  echo("<div class='text-danger text-center'>These details already exist</div>");
                }
               }
            ?>
          </div>
            <form action="#" method="post" onsubmit="return validateVehicles()">
                <div class="form-group">
                  <input type="text" name="fromlocation" onfocus="removeError(this.id)" id="numberplate" class="form-control" placeholder="From Location">
                </div> 
                <div class="form-group">
                <input type="text" name="tolocation" onfocus="removeError(this.id)" id="cartype" class="form-control" placeholder="Destination">
                </div>
                <div class="form-group">
                  <input type="text" name="drivername" onfocus="removeError(this.id)" id="drivername" class="form-control" placeholder="Drivername">
                </div> 
                <div class="form-group">
                  <input type="time" style="width: 150px;" name="depaturetime" onfocus="removeError(this.id)" id="licence" class="form-control" placeholder="Depature time">
                </div> 
                <div class="form-group">
                  <input type="time" style="width: 150px;" name="arivaltime" onfocus="removeError(this.id)" id="arivaltime" class="form-control" placeholder="Arival Time">
                </div>  
                <div class="form-group">
                  <input type="submit" value="Submit" class="btn btn-primary" id="submit" name="submits">
                </div>          
            </form>
        </div>
        <div class="tables">
        <table class="table">
          <thead>
            <tr>
              <th>Company</th>
              <th>From</th>
              <th>To</th>
              <th>Driver</th>
              <th>Depature</th>
              <th>Arival</th>
            </tr>
          </thead>
        <tbody>
        <?php
            include("../includes/connection.php");
            $sql = "SELECT * FROM routes WHERE company_name='".$_COOKIE['company']."' ORDER BY id DESC LIMIT 6";
            $query = mysqli_query($connection, $sql);
            $companyname = $_COOKIE['company'];
            if($rows = mysqli_num_rows($query) > 0){
               while($results = mysqli_fetch_array($query)){
                 $from = $results['from_location'];
                 $to = $results['to_location'];
                 $driver = $results['driver_name'];
                 $depature = $results['depatute_time'];
                 $arival = $results['arival_time'];
                 $companyname = $results['company_name'];
                 echo("<tr>");
                 echo("<td>$companyname</td>");
                 echo("<td>$from </td>");
                 echo("<td>$to</td>");
                 echo("<td>$driver</td>");
                 echo("<td>$depature</td>");
                 echo("<td>$arival</td>");
                //  echo("<td><form><input type='submit' name='edit' value='Edit' class='bg-success text-light btn'></form></td>");
                 echo("</tr>");
                 
               }
            }else{
              alert("<script>alert('No data posted for $companyname')</script>");
            }
        ?>
        </tbody>
        </table>
        </div>
      </div>
    </div>
</body>
</html>