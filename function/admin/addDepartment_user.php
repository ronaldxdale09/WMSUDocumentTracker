

<?php 
 include('db.php');
                        if (isset($_POST['save'])) {
                            $name = $_POST['name'];
                            $username = $_POST['username'];
                            $email = $_POST['email'];
                            $password = $_POST['password'];
                            $department_id = $_POST['department'];
                            $college_id = $_POST['colleges'];
                            $id='';

                            $query = "INSERT INTO users (name,username, email, password, userType) 
                            VALUES ('$name','$username', '$email', '$password', 'user');";
                                $results = mysqli_query($con, $query);
                                $row = mysqli_fetch_array($con,$results);
                                $last_id = mysqli_insert_id($con);
                              

                                    //yung md5 for encryption yan, pero dih na ata possible yung feature na reset password pang gagamit tayo md5, pero oknayan atleast encrypted. 
                                    if ($results) {  
                                        $query2 = mysqli_query($con,"INSERT INTO department_user (user_id,department_id)
                                        VALUES ('$last_id','$department_id') ");
   
                                            header("Location: ../../pages/admin/manage_department_user.php");
                                            exit();
                                       
                                    } else {
                                        echo "ERROR: Could not be able to execute $query. ".msqli_error($con);
                                    }
                                //exit();
                                }
 ?>