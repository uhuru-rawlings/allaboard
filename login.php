<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script src="bootstrap/js/bootstrap/bootstrap.min.js"></script>
    <script src="fontawesome/js/fontawesome.min.js"></script>
    <link rel="stylesheet" href="fontawesome/css/all.css">
    <link rel="stylesheet" href="css/login.css">
    <script src="js/login.js"></script>
    <title>All-Aboard | log-in</title>
</head>
<body>
    <div class="signups">
        <!-- php -->
        <?php
            include("includes/connection.php");
            if(isset($_POST['login'])){
                $username = mysqli_real_escape_string($connection, $_POST['username']);
                $password = trim($_POST['password']);
                $sql = "SELECT * FROM registratioin_table WHERE user_names='".$username."'";
                $query = mysqli_query($connection, $sql);
                if($rows = mysqli_num_rows($query) > 0){
                  while($result = mysqli_fetch_array($query)){
                      $pass = $result['user_password'];
                      $ids = $result['user_ids'];
                      $passverify = password_verify($password, $pass);
                      if($passverify){
                          setcookie("logedin",$ids,time()+3600);
                          header("location: index.php");
                      }else{
                        echo("<div class='error text-danger'>Wrong password, please retry again</div>");
                      }
                  }
                }else{
                    echo("<div class='error text-danger'>No user with this username</div>");
                }
            }
        ?>
        <!-- form -->
        <form action="#" method="post" enctype="multipart/form-data">
        <div class="header">All-Aboard Log-In</div>
            <div class="form-group">
                <div class="errors">
                     <span class="labels">username *</span>
                     <span class="error text-danger" id="error1">please fill this field</span>
                </div>
                 <input type="email" name="username" required onfocus="removeError(this.id)" autocomplete="off" id="username" class="form-control" placeholder="Enter email...">
            </div>
            <div class="form-group">
                <div class="errors">
                     <span class="labels">password *</span>
                     <span class="error text-danger" onfocus="removeError(this.id)" id="error3">please fill this field</span>
                </div>
                 <input type="password" name="password" autocomplete="off" id="password" class="form-control" placeholder="Enter password...">
            </div>
            <div class="form-group">
                <input type="submit" value="Sign Up" class="btn btn-primary" name="login" onclick="return validateSignup()">
            </div>
        </form>
    </div>
</body>
</html>