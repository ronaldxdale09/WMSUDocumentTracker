

<?php 
 include('db.php');
                        if (isset($_POST['save'])) {
                            $name = $_POST['name'];

                                $query = "INSERT INTO colleges (college_name) 
                                        VALUES ('$name')";
                                $results = mysqli_query($con, $query);
                                    //yung md5 for encryption yan, pero dih na ata possible yung feature na reset password pang gagamit tayo md5, pero oknayan atleast encrypted. 
                                    if ($results) {

                                        header("Location: ../../pages/admin/manage_college.php");
                                        exit();
                                    } else {
                                        echo "ERROR: Could not be able to execute $query. ".msqli_error($con);
                                    }
                                //exit();
                                }
 ?>