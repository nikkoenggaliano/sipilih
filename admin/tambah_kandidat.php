<?php 
ob_start();
include '../config/header.php';
if($_SESSION['role'] != 'admin'){
	header("location: ../logout.php");
	exit;
}
	if(isset($_POST['submit'], $_POST['no'], $_POST['nama'], $_FILES['foto'])){

		$no 	= (int) _Filters($_POST['no']);
		$nama 	= _Filters($_POST['nama']);
		$visi 	= isset($_POST['visi']) ? _Filters($_POST['visi']) : "";
		$misi 	= isset($_POST['misi']) ? _Filters($_POST['misi']) : "";


		$fixpath = "../assets/kandidat/";
		$path = pathinfo($_FILES['foto']['name']);
		$ext = strtolower($path['extension']);

		$ext_allowed = array('jpg', 'jpeg', 'png');


		if(!in_array($ext, $ext_allowed)){
			$_SESSION['header'] = 'Wooops';
			$_SESSION['isi'] = 'Hanya diperbolehkan jpg/png aja ya!';
			$_SESSION['type'] = 'error';
			header("location: tambah_kandidat.php");
			exit;
		}

		if($_FILES['foto']['size'] > 6000000){
			$_SESSION['header'] = 'Wooops';
			$_SESSION['isi'] = 'Ukurang gambar hanya boleh kurang dari 6Mb';
			$_SESSION['type'] = 'error';
			header("location: tambah_kandidat.php");
			exit;
		}


		$new_name = generateRandomString(rand(4,7)).".".$ext;

		if(move_uploaded_file($_FILES['foto']['tmp_name'], $fixpath.$new_name)){
			$query = "INSERT INTO `kandidat` (`id`, `no_urut`, `nama`, `foto`, `visi`, `misi`, `active`) VALUES (NULL, '{$no}', '{$nama}', '{$new_name}', '{$visi}', '{$misi}', '1');";

			$exec = mysqli_query($conn, $query);
			$_SESSION['header'] = 'Good Job!';
			$_SESSION['isi'] = 'Kandidat Berhasil ditambahkan!';
			$_SESSION['type'] = 'success';
			ob_clean();
			ob_flush();
			header("location: tambah_kandidat.php");
			exit;
		}else{
			$_SESSION['header'] = 'Nooooooooooo!';
			$_SESSION['isi'] = 'Ada yang error, hubungi Developer!';
			$_SESSION['type'] = 'info';
			header("location: tambah_kandidat.php");
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
								<h4 class="mb-0">Text Inputs</h4>
							</div>
							<hr>
						<form method="POST" enctype="multipart/form-data" action="#">
							<div class="form-group">
								<label>Nomor Kandidat: </label>
								<input class="form-control" type="number" name="no" placeholder="Masukan Nomor Kandidat" required>
							</div>
							<div class="form-group">
								<label>Nama Kandidat: </label>
								<input class="form-control" type="text" name="nama" placeholder="Nama Kandidat" required>
							</div>
							<div class="form-group">
								<label>Unggah Foto Kandidat: </label>
								<input class="form-control" type="file" name="foto" required>
							</div>
							<div class="form-group">
								<label>Visi: </label>
								<textarea class="form-control" name="visi" placeholder="Masukan Visi dapat dikosongi" id=""></textarea>
							</div>							
							<div class="form-group">
								<label>Misi: </label>
								<textarea class="form-control" name="misi" placeholder="Masukan Misi dapat dikosongi" id=""></textarea>
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