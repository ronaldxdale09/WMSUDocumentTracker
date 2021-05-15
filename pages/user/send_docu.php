<?php
include('includes/header.php'); 
include('includes/navbar.php'); 



 $query= mysqli_query($con,"SELECT * from department_user  LEFT JOIN department ON department_user.department_id = department.department_id LEFT JOIN users ON department_user.user_id = users.id WHERE `username` = '".$_SESSION['username']."'" )or die(mysql_error());
 $arr = mysqli_fetch_array($query);

 
?>

<?php
//index.php
$colleges = '';
$query = "SELECT * FROM colleges ";
$result = mysqli_query($con, $query);
while($row = mysqli_fetch_array($result))
{
 $colleges .= '<option value="'.$row["college_id"].'">'.$row["college_name"].'</option>';
}
?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->

          <div class="row">

            <div class="col-lg-6">

              <!-- Circle Buttons -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-danger">Submit New Document</h6>
                </div>
                <div class="card-body">         
           <!-- FORM -->
           <form action="../../function/user/upload.php" method="post" enctype="multipart/form-data">

           <div class="form-group">
           <input type="text" class="form-control"  style='display:none' id="contact" readonly="readonly" name="id"  value=" <?php echo $arr['id']?>">
             
           </div>         

           <div class="form-group">
                          <label for="by" >
                              FROM:</label>
                          <input type="text" class="form-control"
                          id="from" name="from"  disabled="disabled" value="<?php echo $arr['department_name']?>"  required maxlength="50">
                      </div>


             
                      <div class="form-group">
                          <label for="by">
                              By:</label>
                          <input type="text" class="form-control"
                          id="by" name="by"  disabled="disabled" value="<?php echo $arr['name']?>" required maxlength="50">
                      </div>

                      

           <div class="form-group">
                  <label for="department">SELECT COLLEGE </label>
                    <select name="college" id="college"  class="form-control action">
                    <option disabled="disabled" selected="selected">Select College</option>
                    <?php echo $colleges; ?>
                  </select>
           </div>

           <div class="form-group">
                  <label for="department">TO : </label>
                    <select name="department" id="department"  class="form-control action">
                    <option disabled="disabled" selected="selected">Select Document Type</option>
           
                  </select>
               </div>


                      <div class="form-group">
                      <label for="DocumentType">Document Type</label>
                        <select name="type" id="type"  class="form-control action">
                        <option disabled="disabled" selected="selected">Select Document Type</option>
                        <option value="Memorandum">Memorandum</option>
                        <option value="Request Letter">Request Letter</option>
                        <option value="Recommendation Letter">Recommendation Letter</option>
                      </select>
                      </div>

                      <div class="form-group">
                          <label for="details">
                              Details:</label>
                          <textarea class="form-control" type="textarea" name="details"
                          id="details"  placeholder="Details"
                          maxlength="6000" rows="3"></textarea>
                      </div>

                      <div class="form-group">
                          <label for="name">
                              Purpose:</label>
                          <textarea class="form-control" type="textarea" name="purpose"
                          id="message" placeholder="Action to be taken."
                          maxlength="6000" rows="3"></textarea>
                      </div>


                      <div class="col-sm-12">
                         <label for="document" class="form-label">Upload Document</label>
                          <input type="file" id="document" name="document">
                      </div>

                    <br> <br>




                  
                    <button type="send"  class="btn btn-success btn-icon-split" name="send" class="btn btn-primary"> <span class="icon text-white-50">
                      <i class="fas fa-check"></i>
                    </span>
                    <span class="text">SEND DOCUMENT</span></button>


                  </form>


                  <div id="success_message" style="width:100%; height:100%; display:none; ">
                      <h3>Sent your message successfully!</h3>
                  </div>
                  <div id="error_message"
                  style="width:100%; height:100%; display:none; ">
                      <h3>Error</h3>
                      Sorry there was an error sending your form.

                  </div>
    


        <!-- END FORM -->
            </div>
            </div>
              </div>
            <div class="col-lg-6">

              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-danger">Documents</h6>
                </div>
                <div class="card-body">
                <div class="row">


                <div class="col-lg-12">
                  <p>
                    <a href="#" class="btn btn-sq btn-primary">
                    <i class="far fa-file-alt"></i><br/>
                           Inbox
                    </a>
                    <a href="#" class="btn btn-sq btn-success">
                    <i class="fas fa-file-import"></i></i><br/>
                      Sent Document
                    </a>
                    <a href="#" class="btn btn-sq btn-info">
                    <i class="fas fa-file"></i></i><br/>
                      Incoming
                    </a>
                    
                    <a href="#" class="btn btn-sq btn-success">
                    <i class="fas fa-file"></i><br/>
                      Forwarded 
                    </a>

                    <a href="#" class="btn btn-sq btn-info">
                    <i class="fas fa-file"></i></i><br/>
                      Pending 
                    </a>
                  </p>
                </div>
          </div>


                </div>
              </div>

            </div>

          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
      

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>

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
