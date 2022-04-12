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
    <script src="js/settings.js"></script>
    <title>All-Aboard | manage your account</title>
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
                    <li><i class="fas fa-credit-card"></i> <a href="pricing.php">Pricing</a></li>
                    <li><i class="far fa-comment-dots"></i> <a href="chart.php">chart</a></li>
                    <li><i class="fas fa-cog"></i><a class="active" href="settings.php">setting</a></li>
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
            <div class="flex_settings">
                <div class="clearhistory menuitems" onclick="showForms(this.id)" id="history"> <i class="fas fa-sign-out-alt"></i> Log-Out</div>
                <div class="resetpassword menuitems" onclick="showForms(this.id)" id="password"> <i class="fas fa-unlock"></i> Reset Password</div>
                <div class="changeusername menuitems" onclick="showForms(this.id)" id="username"> <i class="fas fa-user"></i> Change UserName</div>
                <div class="changephoto menuitems" onclick="showForms(this.id)" id="photos"><i class="fas fa-image"></i> Change Photo</div>
                <div class="canceltravels menuitems" onclick="showForms(this.id)" id="travel"><i class="fas fa-trash"></i> Cancel Travel</div>
            </div>
            <div class="showhistory" id="showhistory">
                <div class="header">Settings/logout</div>
                <div class="button_logout">
                    <button onclick="logout()" class="btn btn-primary">Log Out</button>
                </div>
            </div>
            <div class="resetpassword" id="resetpassword">
                <div class="header">Settings/Password</div>
                <form action="#" method="post">
                    <?php
                      include("includes/connection.php");
                      if(isset($_POST['resetpass'])){
                          $passwords = trim($_POST['passwords']);
                          $passhash = password_hash($passwords, PASSWORD_DEFAULT);
                          $destination = $_COOKIE['logedin'];
                          $sql = "UPDATE registratioin_table SET user_password='".$passhash."' WHERE user_ids='".$destination."'";
                          $query = mysqli_query($connection, $sql);
                          if($query){
                               echo("<div class='success text-success'>username successfully updates,log in again to continue using services</div>");
                          }else{
                              echo("<div class='error text-danger'>Error updating username please reload and try again</div>");
                          }
                      }
                   ?>
                   <div class="error text-danger" id="errores"></div>
                    <div class="form-group">
                        <input type="password" name="passwords" onfocus="removeError(this.id)" id="passwords" placeholder="Enter Password..." class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="password" name="cpasswords" onfocus="removeError(this.id)" id="cpasswords" placeholder="Confirm Password..." class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Reset Password" onclick="return resetpasswords()" name="resetpass" class="btn btn-primary">
                    </div>
                </form>
            </div>
            <div class="changeusername" id="changeusername">
               <div class="header">Settings/Username</div>
               <form action="#" method="post">
                   <?php
                      include("includes/connection.php");
                      if(isset($_POST['changename'])){
                          $username = mysqli_real_escape_string($connection,$_POST['username']);
                          $destination = $_COOKIE['logedin'];
                          $userid = explode("@",$username);
                          $sql = "UPDATE registratioin_table SET user_names='".$username."', user_ids='".$userid[0]."' WHERE user_ids='".$destination."'";
                          $query = mysqli_query($connection, $sql);
                          if($query){
                               echo("<div class='success text-success'>username successfully updates,log in again to continue using services</div>");
                          }else{
                              echo("<div class='error text-danger'>Error updating username please reload and try again</div>");
                          }
                      }
                   ?>
                    <div class="form-group">
                        <input type="email" required name="username" id="username" placeholder="Enter New Username..." class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Reset Password" name="changename" class="btn btn-primary">
                    </div>
                </form>
            </div>
            <div class="changephoto" id="changephoto">
               <div class="header">Settings/Photo</div>
               <?php
                  if(isset($_POST['changephoto'])){
                    include("includes/connection.php");
                    $image = $_FILES['userimage'];
                      $filename =  $_FILES['userimage']['name'];
                      $filetmpname =  $_FILES['userimage']['tmp_name'];
                      $size =  $_FILES['userimage']['size'];
                      $error =  $_FILES['userimage']['error'];

                      if(!$error){
                          if($size  < 15000000){
                              echo("<script>alert('size ok')</script>");
                              $fileext = explode(".",$filename);
                              $actualname = uniqid(rand(0,100000000)).".".strtolower(end($fileext));
                              $accepted = array("jpg","png","jpeg");
                              if(in_array(strtolower(end($fileext)), $accepted )){
                                echo("<script>alert('extension ok')</script>");
                                  $destination = "uploads/".$actualname;
                                  $movefile = move_uploaded_file($filetmpname,$destination);
                                  
                                  if($movefile){
                                    echo("<script>alert('moved ok')</script>");
                                       $sql = "UPDATE registratioin_table SET user_images='".$actualname."' WHERE user_ids='".$_COOKIE['logedin']."'";
                                       $query = mysqli_query($connection, $sql);
                                       if($query){
                                          echo("<div class='success text-success'>User image successfully updated</div>");
                                       }else{
                                        echo("<div class='Error, Error updating  file, reload and try again</div>");
                                       }
                                  }else{
                                    echo("<div class='Error, Error moving file</div>");
                                  }
                              }else{
                                echo("<div class='Error, extension not accepted, only jpg,png or jpeg allowed</div>");
                              }
                          }else{
                            echo("<div class='error text-danger'>file size too large, please pick another file.</div>");
                          }
                      }else{
                          echo("<div class='error text-danger'>Error with the uploaded file please pick another file</div>");
                      }
                  }
               ?>
               <form action="#" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="file" name="userimage" id="userimage" required class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Reset Password" name="changephoto" class="btn btn-primary">
                    </div>
                </form>
            </div>
            <div class="canceltravel" id="canceltravel">
                <div class="forms_data">
                    <div class="texts text-light bg-danger text-center">Cancel Travel</div>
                    <div class="form-group text-center">
                        <?php
                           if(isset($_POST['deletetravels'])){
                               include("includes/connection.php");
                               $deletetravel = mysqli_real_escape_string($connection, $_POST['deletetravel']);
                               $sql = "SELECT * FROM bookings WHERE travel_id='".$deletetravel."'";
                               $query = mysqli_query($connection, $sql);
                               if($rows = mysqli_num_rows($query) > 0){
                                   $sql = "DELETE FROM bookings WHERE travel_id='".$deletetravel."'";
                                   $query = mysqli_query($connection, $sql);
                                   if($query){
                                       echo("<div class='text-success'>Travel successfully cancelled</div>");
                                   }else{
                                       echo("<div class='text-danger'>Error canceling your request please, try again</div>");
                                   }
                               }else{
                                   echo("<div class='text-danger'>No record with this id, please check and try again</div>");
                               }
                           }
                        ?>
                    </div>
                    <form action="#" method="post" id="flex_delete">
                        <div class="form-group">
                            <input type="text" name="deletetravel" onfocus="removeErrors(this.id)" autocomplete="off" id="deletetravel" placeholder="Enter travel id" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Delete" name="deletetravels" onclick="return validateDelete()" class="btn btn-danger text-light">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>