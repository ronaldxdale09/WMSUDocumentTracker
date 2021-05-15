
  
<?php 
 include('db.php');
                        if (isset($_POST['save'])) {
                            $name = $_POST['name'];
                            $username = $_POST['username'];
                            $email = $_POST['email'];
                            $password = $_POST['password'];

                            $query = "INSERT INTO users (name,username, email, password, userType) 
                            VALUES ('$name','$username', '$email', '$password', 'admin') ";
                                $results = mysqli_query($con, $query);
                                    //yung md5 for encryption yan, pero dih na ata possible yung feature na reset password pang gagamit tayo md5, pero oknayan atleast encrypted. 
                                    if ($results) {

                                        header("Location: ../../pages/admin/manage_admin.php");
                                        exit();
                                    } else {
                                        echo "ERROR: Could not be able to execute $query. ".msqli_error($con);
                                    }
                                //exit();
                                }
 ?>