<?php
include('includes/header.php'); 
include('includes/navbar.php'); 

?>


<!--- POP UP ACTION -->



<div class="modal fade" id="receiveDocu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Accept Document</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="../../function/user/acceptDocu.php" method="POST">

        <div class="modal-body">


                <input type="id"  style="display:none;"  name="code" id="code"  class="form-control" >


          <div class="form-group">
                  <label>From :</label>
                  <input type="name" name="sender" disabled="disabled"  id="sender" class="form-control" >
              </div>
            <div class="form-group">
                <label> Document Type </label>
                <input type="text" name="Doctype" disabled="disabled" class="form-control" id="Doctype" >
            </div>
            
            <div class="form-group">
                   <label for="name">
                              Details:</label>
                          <textarea class="form-control" type="textarea" disabled="disabled"
                          id="detail" name="detail" 
                          maxlength="6000" rows="2"></textarea>
                      </div>
            <div class="form-group">
                   <label for="name">
                              Purpose:</label>
                          <textarea class="form-control" type="textarea" disabled="disabled"
                          id="purposes" name="purposes" 
                          maxlength="6000" rows="2"></textarea>
                      </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">CLOSE</button>
            <button type="accept" name="acceptDocu" class="btn btn-success">ACCEPT</button>

        </div>
      </form>

    </div>
  </div>
</div>



<!-- Begin Page Content -->
<div class="container-fluid">



  <!-- Content Row -->
  <div class="row">
  <?php $receive = mysqli_query($con, "SELECT COUNT(*) from tracking_history LEFT JOIN document ON tracking_history.document_id = document.document_id 
    LEFT JOIN users ON tracking_history.sender_user_id = users.id WHERE recipient_user_id = '".$_SESSION['id']."' AND receiverAction='ongoing' "); 
      $newcount = mysqli_fetch_array($receive);?>

  <?php $pending = mysqli_query($con, "SELECT COUNT(*) from tracking_history LEFT JOIN document ON tracking_history.document_id = document.document_id 
    LEFT JOIN users ON tracking_history.sender_user_id = users.id WHERE recipient_user_id = '".$_SESSION['id']."' AND receiverAction='pending' "); 
    $pendingcount = mysqli_fetch_array($pending);?> 


<?php $return = mysqli_query($con, "SELECT COUNT(*) from tracking_history LEFT JOIN document ON tracking_history.document_id = document.document_id 
    LEFT JOIN users ON tracking_history.sender_user_id = users.id WHERE recipient_user_id = '".$_SESSION['id']."' AND receiverAction='RETURN' "); 
    $returncount = mysqli_fetch_array($return);?> 



    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Incoming Documents</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">

               <h4><?php   echo "$newcount[0] " ?></h4>

              </div>
            </div>
            <div class="col-auto">
            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
          
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Pending Document</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"> <h4><?php   echo "$pendingcount[0] " ?></h4></div>
            </div>
            <div class="col-auto">
            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
          
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-danger shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Forward Document</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"> <h4><?php   echo "$pendingcount[0] " ?></h4></div>
            </div>
            <div class="col-auto">
            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
          
            </div>
          </div>
        </div>
      </div>
    </div>


    <!-- Earnings (Monthly) Card Example -->
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Returned Document</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"> <h4><?php   echo "$returncount[0] " ?></h4></div>
            </div>
            <div class="col-auto">
            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
          
            </div>
          </div>
        </div>
      </div>
    </div>
   

  <!-- Content Row -->

  <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">INBOX</h6>

   
          <br>
      
<div class="table-responsive">

  <table class='selected-col-2' id="dataTable" width="100%" cellspacing="0" >
    <thead >

    <?php
    
    $limit = isset($_POST["limit-records"]) ? $_POST["limit-records"] : 5;
	  $page = isset($_GET['page']) ? $_GET['page'] : 1;
	  $start = ($page - 1) * $limit;
    
    $results = mysqli_query($con, "SELECT * from tracking_history LEFT JOIN document ON tracking_history.document_id = document.document_id 
    LEFT JOIN users ON tracking_history.sender_user_id = users.id WHERE recipient_user_id = '".$_SESSION['id']."' AND receiverAction='ONGOING' OR receiverAction='FORWARDED'  LIMIT $start, $limit  "); 

    $results1 = mysqli_query($con, "SELECT COUNT(tracking_id) AS id from tracking_history LEFT JOIN document ON tracking_history.document_id = document.document_id 
    LEFT JOIN users ON tracking_history.sender_user_id = users.id WHERE recipient_user_id = '".$_SESSION['id']."' AND receiverAction='ONGOING' OR receiverAction='FORWARDED'   ");
   
    $inboxCount = mysqli_fetch_array($results1);
    $total = $inboxCount['id'];
    $pages = ceil( $total / $limit );
  
    $Previous = $page - 1;
    $Next = $page + 1;
    
    
    ?>


    
      <tr>
        <th> Tracking Code </th>
        <th> Status </th>
        <th>Document Type </th>
        <th>From:</th>
        <th>Details </th>
        <th>Purpose </th>
        <th>Date</th>
        <th>Attachment </th>
        <th>Action </th>
      </tr>
    </thead>
    <tbody > 
    <?php  $i=0; while ($row = mysqli_fetch_array($results)) {  ?>
                        <tr>
             <td style="color:red"><b><?php echo $row['tracking_code']; ?> </b></td>
             <td style="color:GREEN"><b><?php echo $row['receiverAction']; ?> </b></td>
             <td><?php echo $row['documentType']; ?></td>
             <td><?php echo $row['name']; ?></td>
             <td><?php echo $row['details']; ?></td>
             <td><?php echo $row['purpose']; ?></td>
             <td><?php echo $row['created_at']; ?></td>
             <td><a href="../../Document/attachment/<?php echo $row['attachment']; ?>"> <?php echo $row['attachment']; ?>  </a> </td>

              <td>
    

                 <!-- <a href="user.main.php.php?accept=class="edit_btn" data-toggle="modal" data-target="#receiveDocu" >ACCEPT</a> -->

                 <button type="button" class ="btn btn-success editbtn"> ACCCEPT </button>

            </td>
                                  

                         
                        </tr>
                                          
       <?php   $i++; }  if ($i <1) { ?> 

  
      <tr><td colspan="11">There are no Incoming Document.</td></tr>
      
      <?php } ?>
   
        
   

      </tr>
    
    </tbody>
  </table>



  <nav aria-label="Page navigation">
					<ul class="pagination">
				    <li>
				      <a href="user.main.php?page=<?= $Previous; ?>" aria-label="Previous">
				        <span aria-hidden="true">&laquo; Previous</span>
				      </a>
				    </li>
				    <?php for($i = 1; $i<= $pages; $i++) : ?>
				    	<li><a href="user.main.php?page=<?= $i; ?>"><?= $i; ?></a></li>
				    <?php endfor; ?>
				    <li>
				      <a href="user.main.php?page=<?= $Next; ?>" aria-label="Next">
				        <span aria-hidden="true">Next &raquo;</span>
				      </a>
				    </li>
				  </ul>
				</nav>
			</div>
			<div class="text-center" style="margin-top: 20px; " class="col-md-2">
				
				</div>
		</div>








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

//TRANSFER DATA FROM TABLE TO MODAL
        $(document).ready(function () {
            $('.editbtn').on('click', function () {


              $('#receiveDocu').modal('show');
              $tr = $(this).closest('tr');

                  var data =$tr.children("td").map(function(){
                    return $(this).text();
                  }).get();
                  $('#code').val(data[0]);
                  $('#Doctype').val(data[1]);
                  $('#sender').val(data[2]);
                  $('#detail').val(data[3]);
                  $('#purposes').val(data[4]);
                  $('#date').val(data[5]);
                  $('#attachments').val(data[6]);
            
                

            });
           
        });
    </script>

<script> 

//PAGINATION
<script type="text/javascript">
	$(document).ready(function(){
		$("#limit-records").change(function(){
			$('form').submit();
		})
	})
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
