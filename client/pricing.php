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
    <script src="js/pricing.js"></script>
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
               <li><i class="fas fa-credit-card"></i> <a class="active" href="pricing.php">Pricing</a></li>
               <li><i class="fas fa-map-marked-alt"></i> <a  href="routes.php">Routes</a></li>
               <li><i class="fas fa-taxi"></i> <a  href="request.php">Request</a></li>
               <li><i class="fas fa-bus"></i> <a  href="vehilcled.php">Vehicles/Drives</a></li>
               <li><i class="fas fa-cog"></i> <a   href="settings.php">Settings</a></li>
             </ul>
         </div>
      </div>
      <div class="content">
        <div class="title">Pricing</div>
        <div class="forms">
          <div class="texts">Add Price</div>
          <div class="form group">
            <?php
              if(isset($_POST['pricing'])){
                include("../includes/connection.php");
                $froms = mysqli_real_escape_string($connection, $_POST['fromlocation']);
                $tos = mysqli_real_escape_string($connection, $_POST['tolocation']);  
                $price = mysqli_real_escape_string($connection, $_POST['price']);
                $sql = "SELECT * FROM pricing WHERE from_location='".$froms."' AND to_location='".$tos."'";
                $query = mysqli_query($connection, $sql);
                if($rows = mysqli_num_rows($query) < 1){
                  $company = $_COOKIE['company'];
                  $sql = "INSERT INTO pricing(from_location,to_location,price,company_name)
                       VALUES('$froms','$tos','$price','$company')";
                  $query = mysqli_query($connection, $sql);
                  if($query){
                    echo("<div class='text-success text-center'>Pricing Successfully added</div>");
                  }else{
                    echo("<div class='text-danger text-center'>Error adding pricing, please try again</div>");
                  }
                }else{
                  echo("<div class='text-danger text-center'>This pricing details already exists</div>");
                }
              }
            ?>
          </div>
          <form action="#" method="post" onsubmit="return validatePricing()">
            <div class="form-group">
               <input type="text" name="fromlocation" autocomplete="off" onfocus="removeError(this.id)" id="fromlocation" placeholder="Enter location(from)" class="form-control">
            </div>
            <div class="form-group">
               <input type="text" name="tolocation" autocomplete="off" onfocus="removeError(this.id)" id="tolocation" placeholder="Enter location(to)" class="form-control">
            </div>
            <div class="form-group">
              <input type="number" name="price" autocomplete="off" min="10" onfocus="removeError(this.id)" id="price" placeholder="Enter price" class="form-control">
            </div>
            <div class="form-group">
              <input type="submit" value="Add Price" name="pricing"  id="priceing" class="btn btn-primary">
            </div>
          </form>
        </div>
        <!-- show routes and prices -->
        <div class="tables">
        <table class="table">
          <thead>
            <tr>
              <th>Company</th>
              <th>From</th>
              <th>To</th>
              <th>Price</th>
              <th>Updated</th>
            </tr>
          </thead>
        <tbody>
        <?php
            include("../includes/connection.php");
            $sql = "SELECT * FROM pricing WHERE company_name='".$_COOKIE['company']."' ORDER BY id DESC LIMIT 6";
            $query = mysqli_query($connection, $sql);
            $companyname = $_COOKIE['company'];
            if($rows = mysqli_num_rows($query) > 0){
               while($results = mysqli_fetch_array($query)){
                 $fromlocation = $results['from_location'];
                 $tolocation = $results['to_location'];
                 $price = $results['price'];
                 $updated = $results['updated'];
                 $companyname = $results['company_name'];
                 echo("<tr>");
                 echo("<td>$companyname</td>");
                 echo("<td>$fromlocation </td>");
                 echo("<td>$tolocation</td>");
                 echo("<td>Kshs $price /=</td>");
                 echo("<td>$updated</td>");
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