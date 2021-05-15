<?php
    require('../function/db.php');
    // When form submitted, check and create user session.
    if (isset($_POST['username'])) {
        $username = stripslashes($_REQUEST['username']);    // removes backslashes
        $username = mysqli_real_escape_string($con, $username);
        $password = stripslashes($_REQUEST['password']);

        $password = mysqli_real_escape_string($con, $password);
        // Check user is exist in the database
        $query    = "SELECT * FROM `users` WHERE username='$username'
                     AND password='$password'";
        $result = mysqli_query($con, $query) or die(mysql_error());
        $rows = mysqli_num_rows($result);
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        if ($rows == 1) {
   

            if ($row['userType'] == 'admin') {
  
                $_SESSION['username'] = $username;
                header("Location: ../pages/admin/admin.main.php");  
                 }elseif ($row['userType'] == 'user'){
        
                        $_SESSION['username'] = $username;
                        $_SESSION['id'] = $row['id'];
                  header("Location: ../pages/user/user.main.php");
                    }


        } else {
            echo "<div class='form'>
                  <h3>Incorrect Username/password.</h3><br/>
                  <p class='link'>Click here to <a href='../index.php'>Login</a> again.</p>
                  </div>";
        }
    }
?>