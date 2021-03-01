<?php 
include '../config/header.php';
if($_SESSION['role'] != 'admin'){
	header("location: ../logout.php");
	exit;
}
?>
		<div class="page-wrapper">
			<?php 
			if(isset($_SESSION['header'], $_SESSION['isi'], $_SESSION['type'])){
				alerta($_SESSION['header'], $_SESSION['isi'], $_SESSION['type']);
				unset($_SESSION['header']);
				unset($_SESSION['isi']);
				unset($_SESSION['type']);
			}
			?>
			<!--page-content-wrapper-->
			<div class="page-content-wrapper">
				<div class="page-content">
					<!--breadcrumb-->
					<div class="page-breadcrumb d-none d-md-flex align-items-center mb-3">
						<div class="breadcrumb-title pr-3">Admin/Daftar DPT</div>
<!-- 						<div class="pl-3">
							<nav aria-label="breadcrumb">
								<ol class="breadcrumb mb-0 p-0">
									<li class="breadcrumb-item"><a href="javascript:;"><i class='bx bx-home-alt'></i></a>
									</li>
									<li class="breadcrumb-item active" aria-current="page">Pricing Tables</li>
								</ol>
							</nav>
						</div> -->
					</div>
					<!--end breadcrumb-->
					<div class="card">
						<div class="card-body">
							<div class="card-title">
								<h4 class="mb-0">Daftar DPT</h4>
							</div>
							<hr>
							<div class="table-responsive">

								<table id="example" class="table table-striped table-bordered dataTable" style="width: 100%;">
									<thead>
										<tr>
											<th>No</th>
											<th>Username</th>
											<th>NIK</th>
											<th>Nama</th>
											<th>Kelamin</th>
										</tr>
									</thead>
								</table>

							</div>
						</div>
					</div>
				</div>
			</div>
			<!--end page-content-wrapper-->
		</div>
		<?php include '../config/footer.php'; ?>
		<script type="text/javascript">
		$(document).ready(function () {

			var table = $('#example').DataTable({
				lengthChange: false,
				dom: "Bftirp",
				buttons: ['copy', 'excel', 'pdf', 'print', 'colvis'],
				ajax: 'api_akun.php',
				columns: [
					{data: 0},
					{data: 1, render: function(data, tipe , row, col){
						return '<a href="rubah_akun.php?id='+row[0]+'">'+data+'</a>'
					}},
					{data: 2},
					{data: 3},
					{data: 4, render: function(data){
						return data == 'L' ? "Laki-Laki" : "Perempuan";
					}}
				]
			});
			table.buttons().container().appendTo('#example_wrapper .col-md-6:eq(0)');
		});
		</script>
