<?php
include('includes/header.php'); 
include('includes/navbar.php'); 

?>
<?php
//index.php
$connect = mysqli_connect("localhost", "root", "", "dbDocumentTrack");
$colleges = '';
$query = "SELECT * FROM colleges ";
$result = mysqli_query($connect, $query);
while($row = mysqli_fetch_array($result))
{
 $colleges .= '<option value="'.$row["college_id"].'">'.$row["college_name"].'</option>';
}
?>


<div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Department User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="../../function/admin/addDepartment_user.php" method="POST">

        <div class="modal-body">

        <div class="form-group">
                <label> Name </label>
                <input type="text" name="name" class="form-control" placeholder="Enter Name">
            </div>
  
            <div class="form-group">
                <label> Username </label>
                <input type="text" name="username" class="form-control" placeholder="Enter Username">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" placeholder="Enter Email">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" placeholder="Enter Password">
            </div>


           <!-- COLLEGE INFO -->
            <div class="form-group">
            <label for="department">College</label>
              <select name="colleges" id="college"  class="form-control action">
              <option value="">Select College</option>
              <?php echo $colleges; ?>
            </select>
            </div>
            <!-- DEPARTMENT INFO -->   
              <!-- State dropdown -->
                <label for="department">Department</label>
                  <select class="form-control" id="department" name="department">
                  <option value="">Select department</option>
              
              </select>
            
        
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="save" name="save" class="btn btn-primary">Save</button>
        </div>
      </form>

    </div>
  </div>
</div>


<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile">
              Add Department User
            </button>
    </h6>
  </div>

  <div class="card-body">

    <div class="table-responsive">

      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
        <?php $results = mysqli_query($con, "SELECT * from department_user LEFT JOIN department ON department_user.department_id = department.department_id LEFT JOIN users ON department_user.user_id = users.id"); ?>
          <tr>
            <th> Department Name </th>
            <th> User </th>
            <th> Username </th>
            <th> Password </th>
            <th> Email </th>
            <th> Edit </th>
            <th> Delete </th>
          </tr>
        </thead>
        <tbody>

        <?php while ($row = mysqli_fetch_array($results)) { ?>
                        <tr>
             <td><?php echo $row['department_name']; ?></td>
             <td><?php echo $row['name']; ?></td>
             <td><?php echo $row['username']; ?></td>
             <td><?php echo $row['password']; ?></td>
             <td><?php echo $row['email']; ?></td>
              <td>
              <form action="" method="post">
                    <input type="hidden" name="edit_id" value="">
                    <button  type="submit" name="edit_btn" class="btn btn-success"> EDIT</button>
                </form>
            </td>
                                  
            <td>
                <form action="" method="post">
                  <input type="hidden" name="delete_id" value="">
                  <button type="submit" name="delete_btn" class="btn btn-danger"> DELETE</button>
                </form>
                         
                        </tr>
                                          
                        <?php } ?>
        
        </tbody>
      </table>

    </div>
  </div>
</div>

</div>




<!-- /.container-fluid -->

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>



<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js">
</script>

<script type="text/javascript">
   $(document).ready(function(){
   // Country dependent ajax
   $("#college").on("change",function(){
   var collegeId = $(this).val();
  
    $.ajax({
    	url :"fetch.php",
	type:"POST",
	cache:false,
	data:{collegeId:collegeId},
  cache: false,
success: function(department)
{
$("#department").html(department);
} 
});
 
});
});
</script>
