<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script src="bootstrap/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/login.css">
    <script src="js/login.js"></script>
    <title>All-Aboard | client |login</title>
</head>
<body>
    <div class="card login">
        <div class="text">All-Aboard Client Sign Up</div>
        <div class="forms">
            <form action="#" method="post" onsubmit="return validateSignup()">
                <div class="form-group text-center">
                    <?php
                      if(isset($_POST['signups'])){
                          include("../includes/connection.php");
                          $username = trim($_POST['usernames']);
                          $password = trim($_POST['passwords']);
                          $password_hashs = password_hash($password, PASSWORD_DEFAULT);
                          $sql = "SELECT * FROM admin_login WHERE user_email='".$username."'";
                          $query = mysqli_query($connection, $sql);
                          if($rows = mysqli_num_rows($query) < 1 ){
                              $sql = "INSERT INTO admin_login(user_email,user_password)
                                 VALUES('$username','$password_hashs')";
                               $query = mysqli_query($connection, $sql);
                               if($query){
                                echo("<div class='text-success'>signup successfull, click login</div>");
                               }else{
                                echo("<div class='text-danger'>Error submiting your request, please try again</div>");
                               }
                          }else{
                              echo("<div class='text-danger'>User with this username already exist</div>");
                          }
                      }
                    ?>
                </div>
                <div class="form-group">
                    <input type="email" name="usernames" autocomplete="off" id="usernames" required onfocus="removeError(this.id)" class="form-control" placeholder="Enter username">
                </div>
                <div class="errors text-danger" id="error">passwords dont match</div>
                <div class="form-group">
                    <input type="password" name="passwords" autocomplete="off" id="passwords"  onfocus="removeError(this.id)"class="form-control" placeholder="Enter password">
                </div>
                <div class="form-group">
                    <input type="password" name="cpasswords" autocomplete="off" id="cpasswords"  onfocus="removeError(this.id)"class="form-control" placeholder="Enter password">
                </div>
                <div class="form-group" id="flex_input">
                    <input type="submit" value="Sign Up" name="signups"  class="btn btn-primary">
                    <a href="login.php">go to login</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>