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
    <script src="js/settings.js"></script>
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
               <li><i class="fas fa-bus"></i> <a href="vehilcled.php">Vehicles/Drives</a></li>
               <li><i class="fas fa-cog"></i> <a class="active"  href="settings.php">Settings</a></li>
             </ul>
         </div>
      </div>
      <div class="content">
        <div class="company_details">
          <div class="texts">Company Details</div>
          <div class="form-group text-center">
            <?php
               if(isset($_POST['company'])){
                 include("../includes/connection.php");
                 $name = mysqli_real_escape_string($connection, $_POST['company_name']);
                 $transport = mysqli_real_escape_string($connection, $_POST['transport_mode']);
                 $description = mysqli_real_escape_string($connection, $_POST['company_description']);
                 $employee = $_COOKIE['logedclient'];
                 $sql = "SELECT * FROM company_details WHERE company_name='".$name."'";
                 $query = mysqli_query($connection, $sql);
                 if($rows = mysqli_num_rows($query) < 1){
                    $sql = "INSERT INTO company_details(company_name,employee_name,Transport_mode,company_description)
                        VALUES('$name','$employee','$transport','$description')";
                    $query = mysqli_query($connection, $sql);
                    if($query){
                      echo("<div class='text-success text-center'>Details added successfully</div>");
                    }else{
                      echo("<div class='text-danger text-center'>Error sending details, please try again</div>");
                    }
                 }else{
                   echo("<div class='text-danger text-center'>These details already exist</div>");
                 }
               }
            ?>
          </div>
          <form action="#" method="post" onsubmit="return validateCompany()">
            <div class="form-group">
              <input type="text" name="company_name" onfocus="removeError(this.id)" autocomplete="off" id="company_name" class="form-control" placeholder="Enter company name">
            </div>
            <div class="form-group">
              <select name="transport_mode" onfocus="removeError(this.id)" id="transport_mode" class="form-control">
                <option value="">--Select--</option>
                <option value="Road-Transport">Road-Transport</option>
                <option value="Water-Transport">Water-Transport</option>
                <option value="Air-Transport">Air-Transport</option>
                <option value="Water-Transport">Water-Transport</option>
              </select>
            </div>
            <div class="form-group">
              <textarea name="company_description" onfocus="removeError(this.id)" autocomplete="off" id="company_description" style="height:100px;" class="form-control" cols="30" rows="10"></textarea>
            </div>
            <div class="form-group">
              <input type="submit" value="Submit" name="company" class="btn btn-primary">
            </div>
          </form>
        </div>
      </div>
    </div>
</body>
</html>