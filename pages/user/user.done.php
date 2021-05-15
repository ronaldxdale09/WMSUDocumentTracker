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





<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">DONE TRANSACTION</h1>
  </div>

  <!-- Content Row -->
  <div class="row">

  <!-- Content Row -->

  <div class="card shadow mb-4">
                <div class="card-header py-3">
       
                </div>
                <div class="card-body">     

<div class="table-responsive">

  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>

    <?php $results = mysqli_query($con, "SELECT * from tracking_history LEFT JOIN document ON tracking_history.document_id = document.document_id 
    LEFT JOIN users ON tracking_history.sender_user_id = users.id WHERE recipient_user_id = '".$_SESSION['id']."' AND receiverAction='DONE' "); ?>
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

