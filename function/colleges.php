<?php 
                        $db = mysqli_connect('localhost', 'root', '', 'initialsystem');
                        $username = "";
                        $email = "";
                        $name = "";
                        if (isset($_POST['submit'])) {
                            $name = $_POST['name'];
                            $username = $_POST['username'];
                            $email = $_POST['email'];
                            $password = $_POST['password'];

                            $sql_u = "SELECT * FROM users WHERE username='$username'";
                            $sql_e = "SELECT * FROM users WHERE email='$email'";
            
                            $res_u = mysqli_query($db, $sql_u);
                            $res_e = mysqli_query($db, $sql_e);

                            if (mysqli_num_rows($res_u) > 0) {
                            $name_error = "Username already taken"; 	
                            }else if(mysqli_num_rows($res_e) > 0){
                            $email_error = "Email already taken"; 	
                            }else{
                                $query = "INSERT INTO users (name,username, email, password, user_type) 
                                        VALUES ('$name','$username', '$email', '$password', 'user')";
                                $results = mysqli_query($db, $query);
                                    //yung md5 for encryption yan, pero dih na ata possible yung feature na reset password pang gagamit tayo md5, pero oknayan atleast encrypted. 
                                    if ($results) {
                                        echo "<div class='form'>
                                            <h3>You are registered successfully.</h3><br/>
                                            <p class='link pb-2'>Click here to <a href='login-page.php'>Login</a></p>
                                            </div>";
                                    } else {
                                        echo "<div class='form'>
                                            <h3>Required fields are missing.</h3><br/>
                                            <p class='link'>Click here to <a href='registration-page.php'>registration</a> again.</p>
                                            </div>";
                                    }
                                //exit();
                            }
                        }else{
                    ?>