<?php 
// Include the database config file 
        include('../../function/db.php');

    $output='';
    $collegeId = $_POST['collegeId'];
    $connect = mysqli_connect("localhost", "root", "", "dbDocumentTrack");
    $output .= '<option disabled="disabled" selected="selected">Select College</option>';
  $query = "SELECT * FROM department_user LEFT JOIN department ON department_user.department_id = department.department_id
   LEFT JOIN colleges ON department.college_id = colleges.college_id WHERE colleges.college_id = {$collegeId}";
  $result = $connect->query($query);

  while ($row = $result->fetch_assoc())
  {
    $output .= '<option value="'.$row["user_id"].'">'.$row["department_name"].'</option>';

  } 
  echo $output;

?>
