  <!-- Bootstrap core JavaScript-->
  <script src="../../assets/jquery/jquery.min.js"></script>
  <script src="../../assets/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../../assets/jquery/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../../assets/js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/chart-area-demo.js"></script>
  <script src="js/demo/chart-pie-demo.js"></script>


<!-- Optional: include a polyfill for ES6 Promises for IE11 -->

<script src="../../assets/js/sweetalert2.all.min.js"></script>



<?php if (isset($_SESSION['message'])): ?>
	<div class="msg">

  <script>

  Swal.fire(
    'Good job!',
    'The Document was sent successfully',
)
  </script>

  
		<?php 
			unset($_SESSION['message']);
		?>
	</div>
	<?php endif ?>

