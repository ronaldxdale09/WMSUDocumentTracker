<?php
include('includes/header.php'); 
include('includes/navbar.php'); 

?>


<!--- POP UP ACTION -->



<!-- Begin Page Content -->
<div class="container-fluid">
     <!-- Topbar Search -->


    </div>

   

  <!-- Content Row -->

  <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">TRACK DOCUMENT</h6>
                </div>
                <div class="card-body">     

                <div class="row justify-content-center">
                        <div class="col-12 col-md-10 col-lg-8">
                            <form class="card card-sm" action="">
                                <div class="card-body row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <i class="fas fa-search h4 text-body"></i>
                                    </div>
                                    <!--end of col-->
                                    <div class="col">
                                        <input class="form-control form-control-lg form-control-borderless"  name='search'  type="text" placeholder="ENTER TRACKING CODE">
                                    </div>
                                    <!--end of col-->
                                    <div class="col-auto">
                                        <button class="btn btn-lg btn-danger"  type="search">Search</button>
                                    </div>
                                    <!--end of col-->
                                </div>
                            </form>
                        </div>
                   
                        <!--end of col-->
                    </div>
                    <br> <br>
<div class="table-responsive">

  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>

  


      <tr>
        <th> Tracking Code </th>
        <th>Document Type </th>
        <th>Receiver:</th>
        <th>Details </th>
        <th>Purpose </th>
        <th>Date Sent</th>
        <th>Date Receive</th>
        <th>STATUS </th>
      </tr>
    </thead>
    <tbody>


    <?php
  
  if(isset($_GET['search'])){ 
    $searchKey = $_GET['search'];
    $results = mysqli_query($con, "SELECT * from trackinglogs LEFT JOIN document ON trackinglogs.document_id = document.document_id
     LEFT JOIN users as recipient ON trackinglogs.recipient_user_id = recipient.id
     WHERE tracking_code LIKE '%$searchKey%'");

        while ($row = mysqli_fetch_array($results)) { ?>
          <tr>
        <td style="color:red"><b><?php echo $row['tracking_code']; ?> </b></td>
        <td><?php echo $row['documentType']; ?></td>
        <td><?php echo $row['name']; ?></td>
        <td><?php echo $row['details']; ?></td>
        <td><?php echo $row['purpose']; ?></td>
        <td><?php echo $row['dateTimeSent']; ?></td>
        <td><?php echo $row['dateTimeReceive']; ?></td>
       <td  style="color:red">  <B><?php echo $row['receiverAction']; ?></b></td> 

            
        <?php 
       }
       } ?>

   
        
   

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
function myFunction() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("dataTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
</script>