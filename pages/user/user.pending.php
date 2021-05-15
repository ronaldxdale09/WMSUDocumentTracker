<?php
include('includes/header.php'); 
include('includes/navbar.php'); 

?>


<!--- POP UP ACTION -->

<?php 

	if (isset($_GET['accept'])) {
		$id = $_GET['accept'];
		$update = true;
		$record = mysqli_query($con, "SELECT * FROM tracking_id WHERE id=$id");

		if (count($record) == 1 ) {
			$n = mysqli_fetch_array($record);
			$tracking_code = $n['tracking_code'];
      $details = $n['details'];
		}
	}
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





<!-- DONE ACTION -->
<div class="modal fade" id="doneDoc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">DONE</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="../../function/user/receiverAction.php" method="POST">

        <div class="modal-body">


        <div class="form-group">
                <label>Tracking Code :</label>
                <input type="id"    name="tracking_id" id="tracking_id"  class="form-control" >
            </div>
        <div class="form-group">
                <label>From :</label>
                <input type="name" name="sender" disabled="disabled"  id="sender" class="form-control" >
            </div>
            
            <div class="form-group">
                <label> Document Type </label>
                <input type="text" name="username" disabled="disabled" class="form-control" id="documentType" >
            </div>
            
            <div class="form-group">
                   <label for="name">
                              Details:</label>
                          <textarea class="form-control" type="textarea" disabled="disabled"
                          id="details" placeholder="Action to be taken."
                          maxlength="6000" rows="2"></textarea>
                      </div>
            <div class="form-group">
                   <label for="name">
                              Purpose:</label>
                          <textarea class="form-control" type="textarea" disabled="disabled"
                          id="purpose" placeholder="Action to be taken."
                          maxlength="6000" rows="2"></textarea>
                      </div>
        </div>
        <div class="modal-footer">
    
        <button type="accept" name="done" id="done" class="btn btn-success">DONE</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">CLOSE</button>

        </div>
      </form>
  
    </div>
  </div>
</div>


<!-- FORWARD ACTION -->
<div class="modal fade" id="forwardDoc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Forward Document</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="../../function/user/receiverAction.php" method="POST">

        <div class="modal-body">

        <div class="form-group">
                <label>Tracking Code :</label>
                <input type="id"    name="code1" id="code1"  class="form-control" >
            </div>

        <div class="form-group">
                <label>From :</label>
                <input type="name" name="sender_1" disabled="disabled"  id="sender_1" class="form-control" >
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

            
        </div>
        <div class="modal-footer">
        <button type="save" name="forward"  class="btn btn-success">FORWARD</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">CLOSE</button>


        </div>
      </form>

    </div>
  </div>
</div>

<!-- RETURN DOC ACTION -->

<div class="modal fade" id="returnDoc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Return Document</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="../../function/user/receiverAction.php" method="POST">

        <div class="modal-body">

        <div class="form-group">
                <label>Tracking Code :</label>
                <input type="id"    name="code3" id="code3"  class="form-control" >
            </div>


            
            <div class="form-group">
                   <label for="name">
                              Note:</label>
                          <textarea class="form-control" type="textarea" 
                          id="note" name="note" placeholder="Return information"
                          maxlength="6000" rows="4"></textarea>
                      </div>


        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">CLOSE</button>
            <button type="save" name="return" class="btn btn-success">RETURN</button>

        </div>
      </form>

    </div>
  </div>
</div>


<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">PENDING DOCUMENT</h1>
  </div>

  <!-- Content Row -->
  <div class="row">

  <!-- Content Row -->

  <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">INBOX</h6>
                </div>
                <div class="card-body">     

<div class="table-responsive">

  <table class='selected-col-2' id="dataTable" width="100%" cellspacing="0">
    <thead>

    <?php $results = mysqli_query($con, "SELECT * from tracking_history LEFT JOIN document ON tracking_history.document_id = document.document_id 
    LEFT JOIN users ON tracking_history.sender_user_id = users.id WHERE recipient_user_id = '".$_SESSION['id']."' AND receiverAction='PENDING' "); ?>
      <tr>
        <th> Tracking ID </th>
        <th>Status</th>
        <th>Document Type </th>
        <th>From:</th>
        <th>Details </th>
        <th>Purpose </th>
        <th>Date</th>
        <th>Attachment </th>


      </tr>
    </thead>
    <tbody>
    <?php $i=0; while ($row = mysqli_fetch_array($results)) { ?>
                        <tr>
             <td style="color:red"><b><?php echo $row['tracking_code']; ?> </b></td>
             <td style="color:green"><b><?php echo $row['receiverAction']; ?> </b></td>
             <td><?php echo $row['documentType']; ?></td>
             <td><?php echo $row['name']; ?></td>
             <td><?php echo $row['details']; ?></td>
             <td><?php echo $row['purpose']; ?></td>
             <td><?php echo $row['created_at']; ?></td>
             <td><a href="../../Document/attachment/<?php echo $row['attachment']; ?>"> <?php echo $row['attachment']; ?>  </a> </td>

              <td>
                 <button type="button" class ="btn btn-info donebtn"> DONE </button>
                 </td>
                 <td> <button type="button" class ="btn btn-danger forwardbtn"> FORWARD </button>    </td>
          
                 <td> <button type="button" class ="btn btn-success returnbtn"> RETURN </button>
            </td>
                                  

                         
                        </tr>
                                          
                        <?php   $i++; }  if ($i <1) { ?> 

  
              <tr><td colspan="11">There are no Pending Document.</td></tr>

                <?php } ?>  
        
   

      </tr>
    
    </tbody>
  </table>

</div>
</div>
</div>
</div>

  



  <?php
include('includes/scripts.php');
include('includes/footer.php');
?>



<!---END  POP UP ACTION -->

<script>
        $(document).ready(function () {
            $('.donebtn').on('click', function () {


              $('#doneDoc').modal('show');
              $tr = $(this).closest('tr');

                  var data =$tr.children("td").map(function(){
                    return $(this).text();
                  }).get();
                  $('#tracking_id').val(data[0]);
                  $('#documentType').val(data[2]);
                  $('#sender').val(data[3]);
                  $('#details').val(data[4]);
                  $('#purpose').val(data[5]);
                  $('#date').val(data[6]);
                  $('#attachment').val(data[6]);
            
                

            });
           
        });
    </script>


    <script>
        $(document).ready(function () {
            $('.forwardbtn').on('click', function () {


              $('#forwardDoc').modal('show');
              $tr = $(this).closest('tr');

                  var data =$tr.children("td").map(function(){
                    return $(this).text();
                  }).get();
                  $('#code1').val(data[0]);
                  $('#sender_1').val(data[3]);
                  $('#attachment').val(data[7]);
            
                

            });
           
        });
    </script>

<script>
        $(document).ready(function () {
            $('.returnbtn').on('click', function () {


              $('#returnDoc').modal('show');
              $tr = $(this).closest('tr');

                  var data =$tr.children("td").map(function(){
                    return $(this).text();
                  }).get();
                  $('#code3').val(data[0]);
                  $('#documentType2').val(data[2]);
                  $('#sender2').val(data[3]);
                  $('#details2').val(data[4]);
                  $('#purpose2').val(data[5]);
                  $('#date2').val(data[6]);
                  $('#attachment').val(data[7]);
            
                

            });
           
        });
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



<style>

* {
  font-family: Arial;
}

table {
  border-collapse: collapse;
  border: none;
}

td,
th {
  padding: 20px;
}

tr:not(:first-child) {
  border-top: 1px solid #dedede;
}

tbody.transparency-demo td {
  border-right: 5px solid transparent;
  border-left: 5px solid transparent;
}

tbody.transparency-demo tr:first-child td {
  border-top: 5px solid transparent;
}

a {

  padding: 20px;
  border-radius: 4px;
  cursor: pointer;

}
</style>
