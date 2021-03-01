<?php 
ob_start();
include '../config/header.php';
if($_SESSION['role'] != 'admin'){
	header("location: ../logout.php");
	exit;
}
if(!isset($_GET['id'])){
	$_SESSION['header'] = 'Woops!!';
	$_SESSION['isi'] = 'Data ID DPT tidak ditemukan';
	$_SESSION['type'] = 'info';
	header("location: daftar_dpt.php");
	exit;	
}

$id = (int) _filters($_GET['id']);

$query = "SELECT * FROM `dpt` WHERE `id` = {$id}";
$exec  = mysqli_query($conn, $query);

if(mysqli_num_rows($exec) != 1){

	$_SESSION['header'] = 'Woops!!';
	$_SESSION['isi'] = 'Data ID DPT tidak ada';
	$_SESSION['type'] = 'info';
	header("location: daftar_dpt.php");
	exit;	
}
$data = mysqli_fetch_array($exec);
$tgl  = $data['tgl_lahir'];
$pecah = explode("|", $tgl);
$tgl_lahir = $pecah[2]."-".$pecah[1]."-".$pecah[0];


if(isset($_POST['nik'], $_POST['nama'], $_POST['kelamin'], $_POST['tgl_lahir'])){

	$nik = _filters($_POST['nik']);
	$nama = _filters($_POST['nama']);
	$kelamin = _filters($_POST['kelamin']);

	$tgl = explode("-", $_POST['tgl_lahir']);

	$fix_tgl = $tgl[2]."|".$tgl[1]."|".$tgl[0];

	$tgl_lahir = _filters($fix_tgl);
	$query = "UPDATE `dpt` SET `nik` = '{$nik}', `nama` = '{$nama}', `kelamin` = '{$kelamin}', `tgl_lahir` = '{$fix_tgl}' WHERE `id` = {$id} ";

	if(mysqli_query($conn, $query)){

		$_SESSION['header'] = 'Yea!';
		$_SESSION['isi'] = 'Data DPT berhasil dirubah!';
		$_SESSION['type'] = 'success';
		header("Refresh:0");
		exit;

	}else{

		$_SESSION['header'] = 'Woops!!';
		$_SESSION['isi'] = 'Data DPT telah gagal dirubah!';
		$_SESSION['type'] = 'info';
		header("Refresh:0");
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
						<div class="breadcrumb-title pr-3">Admin/Rubah DPT</div>
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
								<h4 class="mb-0">Rubah DPT Manual</h4>
							</div>
							<hr>
						<form method="POST" enctype="multipart/form-data" action="#">
							<div class="form-group">
								<label>NIK: </label>
								<input class="form-control" type="number" name="nik" placeholder="Masukan NIK DPT" value="<?php echo $data['nik']; ?>" required>
							</div>
							<div class="form-group">
								<label>Nama DPT: </label>
								<input class="form-control" type="text" name="nama" placeholder="Nama DPT" value="<?php echo $data['nama']; ?>" required>
							</div>
							<div class="form-group">
								<label>Jenis Kelamin: </label>
								<select class="form-control" name="kelamin" required>
									<option value="L" <?php echo $data['kelamin'] == 'L' ? 'selected' : '' ?>>Laki-Laki</option>
									<option value="P" <?php echo $data['kelamin'] == 'P' ? 'selected' : '' ?>>Perempuan</option>
								</select>
							</div>
							<div class="form-group">
								<label>Tanggal Lahir</label>
								<input type="date" class="form-control" name="tgl_lahir" value="<?php echo $tgl_lahir; ?>" required>
							</div>
							<div class="form-group">
								<input type="submit" class="btn btn-primary px-5 radius-30" name="submit" value="Rubah Data">
								<a href="_hapus.php?tipe=dpt&id=<?php echo $data['id']; ?>" class="btn btn-warning px-5 radius-30" onclick="return confirm('Apakah yakin menghapus data ini?');">Hapus Data</a>	
							</div>
						</form>
						</div>
					</div>
				</div>
			</div>
			<!--end page-content-wrapper-->
		</div>
<?php include '../config/footer.php'; ?>