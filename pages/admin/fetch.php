<?php 
// Include the database config file 
        include('../../function/db.php');

    $output='';
    $collegeId = $_POST['collegeId'];
    $connect = mysqli_connect("localhost", "root", "", "dbDocumentTrack");
    $output .= '<option value="">Select Department</option>';
  $query = "SELECT * FROM department WHERE college_id = {$collegeId}";
  $result = $connect->query($query);

  while ($row = $result->fetch_assoc())
  {
    $output .= '<option value="'.$row["department_id"].'">'.$row["department_name"].'</option>';

  } 
  echo $output;

?>
