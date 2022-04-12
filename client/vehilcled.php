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
               <li><i class="fas fa-map-marked-alt"></i> <a href="routes.php">Routes</a></li>
               <li><i class="fas fa-taxi"></i> <a href="request.php">Request</a></li>
               <li><i class="fas fa-bus"></i> <a class="active" href="vehilcled.php">Vehicles/Drives</a></li>
               <li><i class="fas fa-cog"></i> <a   href="settings.php">Settings</a></li>
             </ul>
         </div>
      </div>
      <div class="content">
        <div class="forms">
          <div class="texts">Transport Details</div>
          <div class="form-group">
            <?php
               if(isset($_POST['submits'])){
                include("../includes/connection.php");
                $numberplate = strtoupper(mysqli_real_escape_string($connection, $_POST['numberplate']));
                $cartype = mysqli_real_escape_string($connection, $_POST['cartype']);
                $drivername = mysqli_real_escape_string($connection, $_POST['drivername']);
                $licence = mysqli_real_escape_string($connection, $_POST['licence']);
                $seats = mysqli_real_escape_string($connection, $_POST['seats']);
                $company = $_COOKIE['company'];
                $sql = "SELECT * FROM transport_details WHERE 	company_name='".$company."' AND driving_licence='".$licence."'";
                $query = mysqli_query($connection, $sql);
                if($rows = mysqli_num_rows($query) < 1){
                   $sql = "INSERT INTO transport_details(ttransport_name,transport_mode,driver_name,driving_licence,company_name,seats)
                       VALUES('$numberplate','$cartype','$drivername','$licence','$company','$seats')";
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
                  <input type="text" name="numberplate" onfocus="removeError(this.id)" id="numberplate" class="form-control" placeholder="Enter name/numberplate">
                </div> 
                <div class="form-group">
                  <select name="cartype" id="cartype" onfocus="removeError(this.id)" class="form-control">
                    <option value="">-- Select --</option>
                    <option value="Train">Train</option>
                    <option value="Bus">Bus</option>
                    <option value="Shuttle">Shuttle</option>
                    <option value="Ship">Ship</option>
                    <option value="private_jet">private_jet</option>
                    <option value="Aero Plane">Aero Plane</option>
                    <option value="Other">Other</option>
                  </select>
                </div>
                <div class="form-group">
                  <input type="text" name="drivername" onfocus="removeError(this.id)" id="drivername" class="form-control" placeholder="Enter drivername">
                </div> 
                <div class="form-group">
                  <input type="text" name="licence" onfocus="removeError(this.id)" id="licence" class="form-control" placeholder="Enter driving licence number">
                </div> 
                <div class="form-group">
                  <input type="number" name="seats" min="3" onfocus="removeError(this.id)" id="searts" class="form-control" placeholder="seats(14)">
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
              <th>Numberplate/name</th>
              <th>Driver</th>
              <th>Lincence</th>
              <th>Type</th>
              <th>Seats</th>
            </tr>
          </thead>
        <tbody>
        <?php
            include("../includes/connection.php");
            $sql = "SELECT * FROM transport_details WHERE company_name='".$_COOKIE['company']."' ORDER BY id DESC LIMIT 6";
            $query = mysqli_query($connection, $sql);
            $companyname = $_COOKIE['company'];
            if($rows = mysqli_num_rows($query) > 0){
               while($results = mysqli_fetch_array($query)){
                 $name = $results['ttransport_name'];
                 $drive = $results['driver_name'];
                 $licence = $results['driving_licence'];
                 $types = $results['transport_mode'];
                 $companyname = $results['company_name'];
                 $seats = $results['seats'];
                 echo("<tr>");
                 echo("<td>$companyname</td>");
                 echo("<td>$name </td>");
                 echo("<td>$drive</td>");
                 echo("<td>$licence</td>");
                 echo("<td>$types</td>");
                 echo("<td>$seats</td>");
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