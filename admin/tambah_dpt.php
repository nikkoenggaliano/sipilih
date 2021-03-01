<?php 
ob_start();
include '../config/header.php';
if($_SESSION['role'] != 'admin'){
	header("location: ../logout.php");
	exit;
}
if(isset($_POST['nik'], $_POST['nama'], $_POST['kelamin'], $_POST['tgl_lahir'])){

	$nik = _filters($_POST['nik']);
	$nama = _filters($_POST['nama']);
	$kelamin = _filters($_POST['kelamin']);

	$tgl = explode("-", $_POST['tgl_lahir']);

	$fix_tgl = $tgl[2]."|".$tgl[1]."|".$tgl[0];

	$tgl_lahir = _filters($fix_tgl);
	$query = "INSERT INTO `dpt` (`id`, `nik`, `nama`, `kelamin`, `tgl_lahir`) VALUES (NULL, '{$nik}', '{$nama}', '{$kelamin}', '$tgl_lahir');";

	if(mysqli_query($conn, $query)){

		$_SESSION['header'] = 'Yea!';
		$_SESSION['isi'] = 'Data DPT dimasukan!';
		$_SESSION['type'] = 'success';
		header("location: tambah_dpt.php");
		exit;

	}else{

		$_SESSION['header'] = 'Woops!!';
		$_SESSION['isi'] = 'Data DPT telah gagal dimasukan!';
		$_SESSION['type'] = 'info';
		header("location: tambah_dpt.php");
		exit;
	}

}

ob_end_flush();
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
						<div class="breadcrumb-title pr-3">Admin/Tambah Kandidat</div>
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
					<div class="card radius-15">
						<div class="card-body">
							<div class="card-title">
								<h4 class="mb-0">Tambah DPT Manual</h4>
							</div>
							<hr>
						<form method="POST" enctype="multipart/form-data" action="#">
							<div class="form-group">
								<label>NIK: </label>
								<input class="form-control" type="number" name="nik" placeholder="Masukan NIK DPT" required>
							</div>
							<div class="form-group">
								<label>Nama DPT: </label>
								<input class="form-control" type="text" name="nama" placeholder="Nama DPT" required>
							</div>
							<div class="form-group">
								<label>Jenis Kelamin: </label>
								<select class="form-control" name="kelamin" required>
									<option value="L">Laki-Laki</option>
									<option value="P">Perempuan</option>
								</select>
							</div>
							<div class="form-group">
								<label>Tanggal Lahir</label>
								<input type="date" class="form-control" name="tgl_lahir" required>
							</div>
							<div class="form-group">
								<input type="submit" class="btn btn-primary px-5 radius-30" name="submit" value="Tambah Data">
							</div>
						</form>
						</div>
					</div>
				</div>
			</div>
			<!--end page-content-wrapper-->
		</div>
<?php include '../config/footer.php'; ?>