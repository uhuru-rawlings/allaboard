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
    <title>All-Aboard | sign-Up</title>
</head>
<body>
    <div class="signups">
        <!-- php -->
        <?php
            include("includes/connection.php");
            if(isset($_POST['signup'])){
                $username = mysqli_real_escape_string($connection, $_POST['username']);
                $images = $_FILES['images'];
                $password = trim($_POST['password']);
                $user = explode("@",$username);
                $user_id = $user[0];
                $passwordhashs = password_hash($password, PASSWORD_DEFAULT);
                $filename = $_FILES['images']["name"];
                $file_tmp = $_FILES['images']["tmp_name"];
                $file_size = $_FILES['images']["size"];
                $file_error = $_FILES['images']["error"];
                $file_type = $_FILES['images']["type"];
                // filenew name
               
                $filearray = explode(".",$filename);
                $newname = uniqid(rand(0,100000)).".".end($filearray);
                if($file_size <= 15000000){
                  if($file_error == 0){
                      $accepted = array("jpg","png","jpeg");
                      if(in_array(strtolower(end($filearray)),$accepted)){
                          $destination = "uploads/".$newname;
                        $movefile = move_uploaded_file($file_tmp,$destination);
                        if($movefile){
                            $sql = "SELECT * FROM registratioin_table WHERE user_names ='".$username."'";
                            $query = mysqli_query($connection, $sql);
                            if($rows = mysqli_num_rows($query) == 0){
                                $sql = "INSERT INTO registratioin_table(user_names,user_ids,user_images,user_password)
                                VALUES('$username','$user_id','$newname','$passwordhashs')";
                                $query = mysqli_query($connection, $sql);
                                if($query){
                                echo("<div class='success'>successfully signed up</div>");
                                }else{
                                    echo("<div class='dangers'>Error sub,miting your request please try again</div>");
                                }
                            }else{
                                echo("<div class='dangers'>user with this email already exists</div>");
                            }
                        }else{
                            echo("<div class='dangers'>Error uploading file, please reload and try again</div>");
                        }
                      }else{
                          echo("<div class='dangers'>File type not allowed, only jpg,png or jpeg allowed</div>");
                      }
                  }else{
                    echo("<div class='dangers'>File has un-idenfied problem please pick another file and try again</div>");
                  }
                }else{
                    echo("<div class='dangers'>File size too learge</div>");
                }
            }
        ?>
        <!-- form -->
        <form action="#" method="post" enctype="multipart/form-data">
        <div class="header">All-Aboard Sign-Up</div>
            <div class="form-group">
                <div class="errors">
                     <span class="labels">username *</span>
                     <span class="error text-danger" id="error1">please fill this field</span>
                </div>
                 <input type="email" name="username" required onfocus="removeError(this.id)" autocomplete="off" id="username" class="form-control" placeholder="Enter email...">
            </div>
            <div class="form-group">
                <div class="errors">
                     <span class="labels">image *</span>
                     <span class="error text-danger" id="error2">please fill this field</span>
                </div>
                 <input type="file" name="images" onfocus="removeError(this.id)" autocomplete="off" id="images" class="form-control">
            </div>
            <div class="form-group">
                <div class="errors">
                     <span class="labels">password *</span>
                     <span class="error text-danger" onfocus="removeError(this.id)" id="error3">please fill this field</span>
                </div>
                 <input type="password" name="password" autocomplete="off" id="password" class="form-control" placeholder="Enter password...">
            </div>
            <div class="form-group">
                <div class="errors">
                     <span class="labels">confirm password *</span>
                     <span class="error text-danger" id="error4">please fill this field</span>
                </div>
                 <input type="password" name="cpassword" onfocus="removeError(this.id)" autocomplete="off" id="cpassword" class="form-control" placeholder="Confirm password...">
            </div>
            <div class="form-group">
                <input type="submit" value="Sign Up" class="btn btn-primary" name="signup" onclick="return validateSignup()">
            </div>
        </form>
    </div>
</body>
</html>