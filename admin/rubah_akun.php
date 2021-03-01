<?php
ob_start();
include '../config/header.php';
if ($_SESSION['role'] != 'admin') {
	header("location: ../logout.php");
	exit;
}
if (!isset($_GET['id'])) {
	$_SESSION['header'] = 'Woops!!';
	$_SESSION['isi'] = 'Akun tidak ditemukan';
	$_SESSION['type'] = 'info';
	header("location: daftar_akun.php");
	exit;
}

$id = (int) _filters($_GET['id']);

$query = "SELECT `user`.*, `dpt`.`nama` as `nama_dpt` FROM `user`,`dpt` WHERE `user`.`id` = {$id} AND `dpt`.`id` = `user`.`dptid`";
$exec  = mysqli_query($conn, $query);

if (mysqli_num_rows($exec) != 1) {

	$_SESSION['header'] = 'Woops!!';
	$_SESSION['isi'] = 'Akun tidak ada';
	$_SESSION['type'] = 'info';
	header("location: daftar_akun.php");
	exit;
}
$data = mysqli_fetch_array($exec);


if (isset($_POST['username'], $_POST['password'])) {

	$username = _filters($_POST['username']);
	$password = password_hash($_POST['password'], PASSWORD_DEFAULT); 

	$query = "UPDATE `user` SET `username` = '{$username}', `password` = '{$password}' WHERE `id` = {$id} ";

	if (mysqli_query($conn, $query)) {

		$_SESSION['header'] = 'Yea!';
		$_SESSION['isi'] = 'Data akun berhasil dirubah!';
		$_SESSION['type'] = 'success';
		header("Refresh:0");
		exit;
	} else {

		$_SESSION['header'] = 'Woops!!';
		$_SESSION['isi'] = 'Data akun telah gagal dirubah!';
		$_SESSION['type'] = 'info';
		header("Refresh:0");
		exit;
	}
}

ob_end_flush();
?>
<div class="page-wrapper">
	<?php
	if (isset($_SESSION['header'], $_SESSION['isi'], $_SESSION['type'])) {
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
							<label>Nama NIK: </label>
							<input class="form-control" type="text" placeholder="Masukan NIK DPT" value="<?php echo $data['nama_dpt']; ?>" disabled>
						</div>
						<div class="form-group">
							<label>Username: </label>
							<input class="form-control" type="text" name="username" placeholder="Nama DPT" value="<?php echo $data['username']; ?>" required>
						</div>
						<div class="form-group">
							<label>Password Baru: </label>
							<input class="form-control" type="text" name="password" placeholder="Password" required>
						</div>
						<div class="form-group">
							<input type="submit" class="btn btn-primary px-5 radius-30" name="submit" value="Rubah Data">
							<a href="_hapus.php?tipe=akun&id=<?php echo $data['id']; ?>" class="btn btn-warning px-5 radius-30" onclick="return confirm('Apakah yakin menghapus data ini?');">Hapus Data</a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!--end page-content-wrapper-->
</div>
<?php include '../config/footer.php'; ?>