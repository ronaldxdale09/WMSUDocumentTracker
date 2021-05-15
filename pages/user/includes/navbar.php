<?php



 $query= mysqli_query($con,"SELECT * from department_user  LEFT JOIN department ON department_user.department_id = department.department_id LEFT JOIN users ON department_user.user_id = users.id WHERE `username` = '".$_SESSION['username']."'" )or die(mysql_error());
 $arr = mysqli_fetch_array($query);

 
?>
   
   <!-- Sidebar -->
   <ul class="navbar-nav bg-danger sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="../user/user.main.php">
  <div class="sidebar-brand-icon rotate-n-15">
   
  </div>
  <div class="sidebar-brand-text mx-3">WMSU DOCUMENT TRACKER</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<?php $receive = mysqli_query($con, "SELECT COUNT(*) from tracking_history LEFT JOIN document ON tracking_history.document_id = document.document_id 
    LEFT JOIN users ON tracking_history.sender_user_id = users.id WHERE recipient_user_id = '".$_SESSION['id']."' AND receiverAction='ONGOING' "); 
      $newcount = mysqli_fetch_array($receive);?>

  <?php $pending = mysqli_query($con, "SELECT COUNT(*) from tracking_history LEFT JOIN document ON tracking_history.document_id = document.document_id 
    LEFT JOIN users ON tracking_history.sender_user_id = users.id WHERE recipient_user_id = '".$_SESSION['id']."' AND receiverAction='PENDING' "); 
    $pendingcount = mysqli_fetch_array($pending);?> 

<?php $return = mysqli_query($con, "SELECT COUNT(*) from tracking_history LEFT JOIN document ON tracking_history.document_id = document.document_id 
    LEFT JOIN users ON tracking_history.sender_user_id = users.id WHERE recipient_user_id = '".$_SESSION['id']."' AND receiverAction='RETURN' "); 
    $returncount = mysqli_fetch_array($return);?> 


<!-- Nav Item - Dashboard -->
<li class="nav-item active">
  <a class="nav-link" href="send_docu.php">
  <i class="fas fa-fw fa-file-alt"></i>
    <span>Send Document</span>  </a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
  DOCUMENT
</div>




<li class="nav-item active">
  <a class="nav-link" href="../user/user.main.php">
  <i class="fas fa-fw fa-file-alt"></i>
    <span>Inbox <span class="badge badge-success badge-counter"><?php echo $newcount[0] ?></span> </span></a>
</li>

<!-- Nav Item - Utilities Collapse Menu -->
<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
  <i class="fas fa-fw fa-file-alt"></i>
    <span>My Documents</span>
  </a>
  <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <a class="collapse-item" href="user.mysent.php">Sent Document</a>
      <a class="collapse-item" href="user.done.php">Done Transaction</a>
    </div>
  </div>
</li>


<li class="nav-item active">
  <a class="nav-link" href="user.pending.php"> 
  <i class="fas fa-fw fa-file-alt"></i>
    <span>Pending Document <span class="badge badge-success badge-counter"><?php echo $pendingcount[0] ?> </span> </span></a>
</li>

<li class="nav-item active">
  <a class="nav-link" href="user.return.php"> 
  <i class="fas fa-fw fa-file-alt"></i>
    <span>Returned Document <span class="badge badge-success badge-counter"><?php echo $returncount[0] ?> </span> </span></a>
</li>


<li class="nav-item active">
  <a class="nav-link" href="user.tracking.php">
    <i class="fas fa-fw fa-chart-area"></i>
    <span>Tracking History</span></a>
</li>







<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
  <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>
<!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

     

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>

         <!--

           
            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-envelope fa-fw"></i>
           
                <span class="badge badge-danger badge-counter">7</span>
              </a>

              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                <h6 class="dropdown-header">
                  Message Center
                </h6>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="https://source.unsplash.com/fn_BT9fwg_E/60x60" alt="">
                    <div class="status-indicator bg-success"></div>
                  </div>
                  <div class="font-weight-bold">
                    <div class="text-truncate">Hi there! I am wondering if you can help me with a problem I've been having.</div>
                    <div class="small text-gray-500">Emily Fowler · 58m</div>
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="https://source.unsplash.com/AU4VPcFN4LE/60x60" alt="">
                    <div class="status-indicator"></div>
                  </div>
                  <div>
                    <div class="text-truncate">I have the photos that you ordered last month, how would you like them sent to you?</div>
                    <div class="small text-gray-500">Jae Chun · 1d</div>
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="https://source.unsplash.com/CS2uCrpNzJY/60x60" alt="">
                    <div class="status-indicator bg-warning"></div>
                  </div>
                  <div>
                    <div class="text-truncate">Last month's report looks great, I am very happy with the progress so far, keep up the good work!</div>
                    <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60" alt="">
                    <div class="status-indicator bg-success"></div>
                  </div>
                  <div>
                    <div class="text-truncate">Am I a good boy? The reason I ask is because someone told me that people say this to all dogs, even if they aren't good...</div>
                    <div class="small text-gray-500">Chicken the Dog · 2w</div>
                  </div>
                </a>
                <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
              </div>
            </li>

            <div class="topbar-divider d-none d-sm-block"></div>
          -->


            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                  
              <b> <?php echo $arr['department_name']?> </b>
                  
                </span>
                <img class="img-profile rounded-circle" src="../../assets/images/logo.png">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
 
                <a class="dropdown-item" href="#">
                  <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                  Activity Log
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->


  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  
  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>

          <form action="../../function/logout.php" method="POST"> 
          
            <button type="submit" name="logout_btn" class="btn btn-primary">Logout</button>

          </form>


        </div>
      </div>
    </div>
  </div>