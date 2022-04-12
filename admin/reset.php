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
    <title>all-aboard | admin reset password</title>
</head>
<body>
<div class="signup">
        <div class="logo"><i class="fas fa-bus"></i></div>
        <h5>Sign-In</h5>
        <p>Forget password? fill the fields to reset password</p>
        <form action="#" method="post">
            <?php
               include("../includes/connection.php");
               if(isset($_POST['signin'])){
                $username = mysqli_real_escape_string($connection, $_POST['username']);
                $passwords = trim($_POST['passwords']);
                $sql = "SELECT * FROM admins WHERE username='".$username."'";
                $query = mysqli_query($connection, $sql);
                if($rows = mysqli_num_rows($query) > 0 ){
                    $hash = password_hash($passwords, PASSWORD_DEFAULT);
                    $sql = "UPDATE admins SET passwords='".$hash."' WHERE username='".$username."' ";
                    $query = mysqli_query($connection, $sql);
                    if($query){
                        echo("<div class='text-success text-center'>$username password succesfully updated</div>");
                    }else{
                        echo("<div class='text-danger text-center'>Error updating password, try again</div>"); 
                    }
                }else{
                    echo("<div class='text-danger text-center'>$username doesnt exist in our database</div>");
                }
               }
            ?>
             <div class="form-group">
                 <input type="email" name="username" onfocus="removeEror(this.id)" required  autocomplete="off" id="usernames" class="form-control" placeholder="Enter username">
             </div>
             <div class="form-group">
                 <input type="password" name="passwords" onfocus="removeEror(this.id)" autocomplete="off"  id="password" placeholder="Enter password" class="form-control">
             </div>
             <div class="form-group">
                 <input type="password" name="cpasswords" onfocus="removeEror(this.id)" autocomplete="off"  id="cpasswords" placeholder="Enter password" class="form-control">
             </div>
             <div class="autolog">
                 <a href="signup.php">Have account ?</a>
             </div>
             <div class="form-group">
                 <input type="submit" value="Reset Password" id="signin" name="signin" onclick="return validateReset()" class="btn btn-primary">
             </div>
        </form>
    </div>
</body>
</html>