
<?php 
 include('../db.php');
                        if (isset($_POST['done'])) {
                            $code= $_POST['tracking_id'];
                          
                            $created_at = date('m/d/Y h:i:s a', time()); 
                            $action = 'DONE';
 

                                $query = "UPDATE tracking_history SET receiverAction='$action' ,dateTimeReceive='$created_at' WHERE tracking_code='$code'";
                                $results = mysqli_query($con, $query);
                                    //yung md5 for encryption yan, pero dih na ata possible yung feature na reset password pang gagamit tayo md5, pero oknayan atleast encrypted. 
                                    if ($results) {
                                    //echo $sender;
                                        $_SESSION['message'] = "Address updated!"; 
                                        header('location: ../../pages/user/user.pending.php');
                                    } else {
                                        echo "ERROR: Could not be able to execute $query. ".msqli_error($con);
                                    }
                                //exit();
                                }


                            else if  (isset($_POST['forward'])) {
                                $code= $_POST['code1'];
                                $department = $_POST['department'];
    
                                $created_at = date('m/d/Y h:i:s a', time()); 
                                $action = 'FORWARDED';
    
                                    $query = "UPDATE tracking_history SET recipient_user_id='$department'  ,receiverAction='$action' ,dateTimeReceive='$created_at' WHERE tracking_code='$code'";
                                    $results = mysqli_query($con, $query);
                                        //yung md5 for encryption yan, pero dih na ata possible yung feature na reset password pang gagamit tayo md5, pero oknayan atleast encrypted. 
                                        if ($results) {
                                        echo $code;
                                            $_SESSION['message'] = "Address updated!"; 
                                            header('location: ../../pages/user/user.pending.php');
                                        } else {
                                            echo "ERROR: Could not be able to execute $query. ".msqli_error($con);
                                        }

                                

                            }

                            else if (isset($_POST['return'])){
                                $code= $_POST['code3'];
                                $note= $_POST['note'];
                             //   $receiverNote= $_POST['receiverNote1'];
                                $senderID='';
                                $Senderquery = "SELECT * from tracking_history WHERE tracking_code='$code'";
                                $result1 = mysqli_query($con, $Senderquery);
                                $get = mysqli_fetch_array($result1);
                                $senderID = $get['sender_user_id'];



                                $created_at = date('m/d/Y h:i:s a', time()); 
                                $action = 'RETURN';
     
                                    $query = "UPDATE tracking_history SET receiverAction='$action' ,dateTimeReceive='$created_at',recipient_user_id='$senderID', receiverNote='$note' WHERE tracking_code='$code'";
                                    $results = mysqli_query($con, $query);
                                        //yung md5 for encryption yan, pero dih na ata possible yung feature na reset password pang gagamit tayo md5, pero oknayan atleast encrypted. 
                                        if ($results) {
                                        //echo $code;
                                            $_SESSION['message'] = "Address updated!"; 
                                            header('location: ../../pages/user/user.pending.php');
                                        //  echo  $receiverNote;
                                        } else {
                                            echo "ERROR: Could not be able to execute $query. ".msqli_error($con);
                                        }
                                    //exit();

                            }
 ?>