<?php
    $connection = mysqli_connect("127.0.0.1","root","","all_aboard");
    if($connection){
      
    }else{
        echo("<div class='error_message'>Error connecting to the database</div>");
    }
?>
