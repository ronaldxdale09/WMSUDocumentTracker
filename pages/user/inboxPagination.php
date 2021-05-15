<?php

	// Connect database 

	require_once('../../function/db.php');
    include("../../function/auth_session.php");

	$limit = 5;

	if (isset($_POST['page_no'])) {
	    $page_no = $_POST['page_no'];
	}else{
	    $page_no = 1;
	}

	$offset = ($page_no-1) * $limit;

	$query = "SELECT * from tracking_history LEFT JOIN document ON tracking_history.document_id = document.document_id 
    LEFT JOIN users ON tracking_history.sender_user_id = users.id WHERE recipient_user_id = '19' AND receiverAction='ONGOING' OR receiverAction='FORWARDED' LIMIT $offset, $limit";

	$result = mysqli_query($con, $query);

	$output = "";

	if (mysqli_num_rows($result) > 0) {

	$output.="<table class='table'>
		    <thead>
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
	         <tbody>";
	while ($row = mysqli_fetch_assoc($result)) {

	$output.="       <tr>
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
                         ;
	} 
	$output.="</tbody>
		</table>";

	$sql = "SELECT * FROM users";

	$records = mysqli_query($con, $sql);

	$totalRecords = mysqli_num_rows($records);

	$totalPage = ceil($totalRecords/$limit);

	$output.="<ul class='pagination justify-content-center' style='margin:20px 0'>";

	for ($i=1; $i <= $totalPage ; $i++) { 
	   if ($i == $page_no) {
		$active = "active";
	   }else{
		$active = "";
	   }

	    $output.="<li class='page-item $active'><a class='page-link' id='$i' href=''>$i</a></li>";
	}

	$output .= "</ul>";

	echo $output;

	}

?>