<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="fontawesome/js/fontawesome.min.js"></script>
    <link rel="stylesheet" href="fontawesome/css/all.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/index.js"></script>
    <title>all-aboard | admin login</title>
</head>
<body>
    <div class="signup">
        <div class="logo"><i class="fas fa-bus"></i></div>
        <h5>Sign-In</h5>
        <p>Welcome to all aboard, please signin to access other services</p>
        <form action="#" method="post">
            <?php
               include("../includes/connection.php");
               if(isset($_POST['signin'])){
                $username = mysqli_real_escape_string($connection, $_POST['username']);
                $passwords = trim($_POST['passwords']);
                $sql = "SELECT * FROM admins WHERE username='".$username."'";
                $query = mysqli_query($connection, $sql);
                if($rows = mysqli_num_rows($query) > 0 ){
                   while($resuls = mysqli_fetch_array($query)){
                       $pass = $resuls['passwords'];
                       if(password_verify($passwords, $pass)){
                           setcookie("admin",$username, time()+3600);
                           header("location: index.php");
                       }else{
                        echo("<div class='text-danger text-center'>wrong password please try again</div>");
                       }
                   }
                }else{
                    echo("<div class='text-danger text-center'>$username doesnt exist in our database</div>");
                }
               }
            ?>
             <div class="form-group">
                 <input type="email" name="username" onfocus="removeEror(this.id)" required  autocomplete="off" id="username" class="form-control" placeholder="Enter username">
             </div>
             <div class="form-group">
                 <input type="password" name="passwords" onfocus="removeEror(this.id)" autocomplete="off"  id="passwords" placeholder="Enter password" class="form-control">
             </div>
             <div class="autolog">
                 <div class="checkbox"><input type="checkbox" name="autofill"  id="autofill"> Keep me Loged in</div>
                 <a href="reset.php">Forget password ?</a>
             </div>
             <div class="form-group">
                 <input type="submit" value="Sign-In" id="signin" name="signin" onclick="return validateLogin()" class="btn btn-primary">
             </div>
        </form>
    </div>
</body>
</html>