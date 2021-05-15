
<?php 
 include('../db.php');
                        if (isset($_POST['acceptDocu'])) {
                            $code= $_POST['code'];
                          
                            $created_at = date('m/d/Y h:i:s a', time()); 
                            $action = 'PENDING';

                                $query = "UPDATE tracking_history SET receiverAction='$action' ,dateTimeReceive='$created_at' WHERE tracking_code='$code'";
                                $results = mysqli_query($con, $query);
                                    //yung md5 for encryption yan, pero dih na ata possible yung feature na reset password pang gagamit tayo md5, pero oknayan atleast encrypted. 
                                    if ($results) {
                                    //echo $code;
                                        $_SESSION['message'] = "Address updated!"; 
                                        header('location: ../../pages/user/user.pending.php');
                                    } else {
                                        echo "ERROR: Could not be able to execute $query. ".msqli_error($con);
                                    }
                                //exit();
                                }
 ?>