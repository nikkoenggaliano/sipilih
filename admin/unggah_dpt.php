<?php 
ob_start();
include '../config/header.php';
if($_SESSION['role'] != 'admin'){
	header("location: ../logout.php");
	exit;
}
if(isset($_FILES['dpt'])){

	$ext_allowed = ['xlsx', 'xls', 'csv'];

	$path = pathinfo($_FILES['dpt']['name']);
	$ext = strtolower($path['extension']);

	$fixpath = "../assets/datadpt/";
	if(!in_array($ext, $ext_allowed)){
		$_SESSION['header'] = 'Wooops';
		$_SESSION['isi'] = 'Hanya diperbolehkan xlsx/xls/csv aja ya!';
		$_SESSION['type'] = 'error';
		header("location: unggah_dpt.php");
		exit;
	}


	$new_name = date('H-i-s d-m-Y')."-".generateRandomString(4).".".$ext;

	if(move_uploaded_file($_FILES['dpt']['tmp_name'], $fixpath.$new_name)){
		require '../vendor/autoload.php';
		$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
		$reader->setReadDataOnly(true);
		$spreadsheet = $reader->load($fixpath.$new_name);
		$sheetData = $spreadsheet->getActiveSheet()->toArray();
		unset($sheetData[0]);
		$success_count = 0;
		$fail_count = 0;
		$counted = count($sheetData);
		$fail_erorr = "";
		foreach ($sheetData as $value) {
			$nik = _filters($value[0]);
			$nama = _filters($value[1]);
			$kelamin = _filters($value[2]);
			$tgl_lahir = _filters($value[3]);
			$query = "INSERT INTO `dpt` (`id`, `nik`, `nama`, `kelamin`, `tgl_lahir`) VALUES (NULL, '{$nik}', '{$nama}', '{$kelamin}', '$tgl_lahir');";
			if(mysqli_query($conn, $query)){
				$theid = mysqli_insert_id($conn);
				$username = generateRandomString(2, $nik).generateRandomString(2).generateRandomString(2).generateRandomString(2, $nik);
				$query = "INSERT INTO `user` (`id`, `dptid`, `username`, `password`, `role`) VALUES (NULL, '{$theid}', '{$username}', '', 'user')";
				if(mysqli_query($conn, $query)){
					$success_count++;
				}else{
					$fail_count++;
					$fail_erorr .= "Insert 2 ".mysqli_error($conn)."\n";
				}
			}else{
				$fail_count++;
				$fail_erorr .= "Insert 1 ".mysqli_error($conn)."\n";
			}
			
		}

		$_SESSION['header'] = 'Yea!';
		$_SESSION['isi'] = "Jumlah data diunggah {$counted} jumlah data berhasil dimasukan {$success_count} jumlah data yang gagal {$fail_count} ".$fail_erorr;
		$_SESSION['type'] = 'success';
		header("location: unggah_dpt.php");
		exit;

	}else{

		$_SESSION['header'] = 'Woops!!';
		$_SESSION['isi'] = 'Data DPT Telah gagal diunggah!';
		$_SESSION['type'] = 'info';
		header("location: unggah_dpt.php");
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
						<div class="breadcrumb-title pr-3">Admin/Tambah DPT</div>
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
								<h4 class="mb-0">Unggah</h4>
							</div>
							<hr>
						<form method="POST" enctype="multipart/form-data" action="#">
							<div class="form-group">
								<a href="<?php echo fixdir ?>assets/datadpt/template.xlsx" class="form-data">Download Template</a>
							</div>
							<div class="form-group">
								<label>Unggah Data DPT: </label>
								<input class="form-control" type="file" name="dpt" required>
							</div>
							<div class="form-group">
								<input type="submit" class="btn btn-primary px-5 radius-30" name="submit" value="Unggah Data">
							</div>
						</form>
						</div>
					</div>
				</div>
			</div>
			<!--end page-content-wrapper-->
		</div>
<?php include '../config/footer.php'; ?>