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
        <div class="text">All-Aboard Client Login</div>
        <div class="forms">
            <div class="form-group text-center">
                <?php
                   if(isset($_POST['submits'])){
                       include("../includes/connection.php");
                    $username = trim($_POST['username']);
                    $passwords = trim($_POST['password']);
                    $sql = "SELECT * FROM admin_login WHERE user_email='".$username."'";
                           $query = mysqli_query($connection, $sql);
                           if($rows = mysqli_num_rows($query) > 0 ){
                               while($result = mysqli_fetch_assoc($query)){
                                   $pass = $result['user_password'];
                                   $passv = password_verify($passwords, $pass);
                                   if($passv){
                                       setcookie("logedclient",$_POST['username'],time()+3600);
                                       header("location: index.php");
                                   }else{
                                     echo("<div class='text-danger'>Wrong password, please try again or contact your system admin.</div>");
                                   }
                               }
                           }else{
                               echo("<div class='text-danger'>User with this username dont exist signup first</div>");
                           }
                   }
                ?>
            </div>
            <form action="#" method="post" onsubmit="return validateLogin()">
                <div class="form-group">
                    <input type="email" name="username" id="username" onfocus="removeError(this.id)" class="form-control" placeholder="Enter username">
                </div>
                <div class="form-group">
                    <input type="password" name="password" id="password"  onfocus="removeError(this.id)"class="form-control" placeholder="Enter password">
                </div>
                <div class="form-group" id="flex_input">
                    <input type="submit" value="login" name="submits"  class="btn btn-primary">
                    <a href="signup.php">Go to sign up</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>