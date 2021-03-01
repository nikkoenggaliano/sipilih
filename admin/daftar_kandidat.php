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
						<div class="breadcrumb-title pr-3">Admin/Rubah Kandidat</div>
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
					<div class="row">
						<?php 

						$query = "SELECT * FROM `kandidat`;";
						$execute = mysqli_query($conn, $query);
						while($data = mysqli_fetch_array($execute)){

						?>
						<div class="col-12 col-lg-4 col-xl-4">
							<div class="card">
								<img src="<?php echo fixdir; ?>assets/kandidat/<?php echo $data['foto'] ?>" class="card-img-top" alt="...">
								<div class="card-body">
									<h5 class="card-title"><?php echo $data['nama']; ?> [<?php echo $data['no_urut']; ?>]</h5>
									<p class="card-text"></p> <a href="rubah_kandidat.php?id=<?php echo $data['id']; ?>" class="btn btn-primary">Rubah Data Kandidat</a>
									<p class="card-text"></p> <a href="_hapus.php?tipe=kandidat&id=<?php echo $data['id']; ?>" class="btn btn-warning" onclick="return confirm('Apakah yakin ingin menghapus?');">Hapus Data Kandidat</a>
								</div>
							</div>
						</div>

					<?php } ?>
					</div>
				</div>
			</div>
			<!--end page-content-wrapper-->
		</div>
<?php include '../config/footer.php'; ?>