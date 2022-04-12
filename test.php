<?php
                          if(isset($_POST['submitdate'])){
                            include("includes/connection.php");
                            $traveldate = mysqli_real_escape_string($connection, $_POST['traveldate']);
                            $travelid = mysqli_real_escape_string($connection, $_POST['travelid']);
                            $sql = "SELECT * FROM routes WHERE post_id='".$travelid."'";
                            $query = mysqli_query($connection, $sql);
                            if($rows = mysqli_num_rows($query) > 0){
                                while($result = mysqli_fetch_array($query)){
                                    $from = $result['from_location'];
                                    $to = $result['to_location'];
                                    $drive = $result['driver_name'];
                                    $company = $result['company_name'];
                                    $depature = $result['depatute_time'];
                                    $arival = $result['arival_time'];
                                    if($drive){
                                        $sql2 = "SELECT * FROM transport_details WHERE driver_name='".$drive."' AND company_name='".$company."'";
                                        $query2 = mysqli_query($connection, $sql2);
                                        if($rows = mysqli_num_rows($query2) > 0){
                                             while($result_n = mysqli_fetch_array($query2)){
                                                 $travid = $result_n['seats'];
                                                 $modes = $result_n['transport_mode'];
                                                 $seat = rand(1,$travid);
                                                 if(!is_null($seat)){
                                                     $useremails = $_COOKIE['logedin'];
                                                     $travel_id = uniqid(rand(0,10000000000));
                                                     $sql3 = "INSERT INTO bookings(user_email,From_location,To_location,Travel_date,travel_id,seat_number,company_name,transport_mode)
                                                       VALUES('$useremails','$from','$to','$traveldate','$travel_id','$seat','$company','$modes')";
                                                     $query3 = mysqli_query($connection, $sql3);
                                                     if($query3){
                                                        echo("<div class='text-success text-center'>successfully booking, keep intouch with you calender</div>");
                                                     }else{
                                                         echo("<div class='text-danger text-center'>Error completing your booking, seems all seats are reserved</div>");
                                                     }
                                                 }
                                             }
                                        }else{
                                            echo("<div class='text-danger text-center'>Error! seem these travel details has been delete or changed by the company</div>");
                                        }
                                    }
                                }
                            }else{
                                echo("<div class='text-danger text-center'>Error! seem these travel details has been delete or changed by the company</div>");
                            }
                          }
                        ?>