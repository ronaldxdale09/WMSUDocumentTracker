<?php
require_once ("../db.php");

if (! (isset($_GET['pageNumber']))) {
    $pageNumber = 1;
} else {
    $pageNumber = $_GET['pageNumber'];
}

$perPageCount = 5;

$sql = "SELECT * FROM tbl_staff  WHERE 1";

if ($result = mysqli_query($con, $sql)) {
    $rowCount = mysqli_num_rows($result);
    mysqli_free_result($result);
}

$pagesCount = ceil($rowCount / $perPageCount);

$lowerLimit = ($pageNumber - 1) * $perPageCount;

$sqlQuery = " SELECT * from tracking_history LEFT JOIN document ON tracking_history.document_id = document.document_id 
LEFT JOIN users ON tracking_history.sender_user_id = users.id WHERE recipient_user_id = '".$_SESSION['id']."' AND receiverAction='ONGOING' OR receiverAction='FORWARDED'  WHERE 1 limit " . ($lowerLimit) . " ,  " . ($perPageCount) . " ";
$results = mysqli_query($con, $sqlQuery);

?>

<table class="table table-hover table-responsive">
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
   
</table>

<div style="height: 30px;"></div>
<table width="50%" align="center">
    <tr>

        <td valign="top" align="left"></td>


        <td valign="top" align="center">
 
	<?php
	for ($i = 1; $i <= $pagesCount; $i ++) {
    if ($i == $pageNumber) {
        ?>
	      <a href="javascript:void(0);" class="current"><?php echo $i ?></a>
<?php
    } else {
        ?>
	      <a href="javascript:void(0);" class="pages"
            onclick="showRecords('<?php echo $perPageCount;  ?>', '<?php echo $i; ?>');"><?php echo $i ?></a>
<?php
    } // endIf
} // endFor

?>
</td>
        <td align="right" valign="top">
	     Page <?php echo $pageNumber; ?> of <?php echo $pagesCount; ?>
	</td>
    </tr>
</table>