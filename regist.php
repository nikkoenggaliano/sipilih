<?php 
include 'config/config.php';
if(isset($_POST['username'], $_POST['password'], $_POST['nik'])){

	$nik = _filters($_POST['nik']);
	$username = _filters($_POST['username']);
	$password = password_hash(_filters($_POST['password']), PASSWORD_DEFAULT);

	$cek_nik =  json_decode(file_get_contents($hostUri.fixdir."admin/api_dpt.php?dptid=".$nik), TRUE);

	if($cek_nik['status'] == 200){
		$dptid = $cek_nik['id'];
		#$query = "INSERT INTO `user` (`id`, `dptid`, `username`, `password`, `role`) VALUES (NULL, '{$dptid}', '{$username}', '{$password}', 'user')";
		
		$query = "UPDATE `user` SET `password` = '{$password}' WHERE `dptid` = '{$dptid}'";
		$query2 = "SELECT * FROM `user` WHERE `dptid` = ".$dptid;

		// if(mysqli_num_rows( mysqli_query($conn, $query2)) != 0 ){
		// 	$_SESSION['header'] = 'Hays!!';
		// 	$_SESSION['isi'] = 'Pendaftaran Akun Gagal! Kamu sudah terdaftar!';
		// 	$_SESSION['type'] = 'error';
		// 	header("location: regist.php");
		// 	exit;	
		// }


		$data_query2 = mysqli_fetch_array(mysqli_query($conn, $query2));


		if($data_query2['username'] != $username){

			$_SESSION['header'] = 'Ooppss!!';
			$_SESSION['isi'] = 'Username kamu salah!';
			$_SESSION['type'] = 'warning';
			header("location: regist.php");
			exit;	


		}

		if(mysqli_query($conn, $query)){

			$_SESSION['header'] = 'Yes!!';
			$_SESSION['isi'] = 'Pendaftaran Akun berhasil!';
			$_SESSION['type'] = 'success';
			header("location: login.php");
			exit;	

		}else{

			$_SESSION['header'] = 'Hays!!';
			$_SESSION['isi'] = 'Pendaftaran Akun Gagal!';
			$_SESSION['type'] = 'warning';
			header("location: regist.php");
			exit;	

		}

	}else{
		$_SESSION['header'] = 'Hays!!';
		$_SESSION['isi'] = 'Terdapat kesalahan pada kolom NIK';
		$_SESSION['type'] = 'error';
		header("location: regist.php");
		exit;	
	}

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<title>Daftar ke Sistem</title>
	<!--favicon-->
	<link rel="icon" href="assets/images/favicon-32x32.png" type="image/png" />
	<!-- loader-->
	<link href="assets/css/pace.min.css" rel="stylesheet" />
	<script src="assets/js/pace.min.js"></script>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css" />
	<!-- Icons CSS -->
	<link rel="stylesheet" href="assets/css/icons.css" />
	<!-- App CSS -->
	<link rel="stylesheet" href="assets/css/app.css" />
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body class="bg-register">
	<?php 
	if(isset($_SESSION['header'], $_SESSION['isi'], $_SESSION['type'])){
		alerta($_SESSION['header'], $_SESSION['isi'], $_SESSION['type']);
		unset($_SESSION['header']);
		unset($_SESSION['isi']);
		unset($_SESSION['type']);
	}
	?>
	<!-- wrapper -->
	<div class="wrapper">
		<div class="section-authentication-register d-flex align-items-center justify-content-center">
			<div class="row">
				<div class="col-12 col-lg-10 mx-auto">
					<div class="card radius-15">
						<div class="row no-gutters">
							<div class="col-lg-6">
								<div class="card-body p-md-5">
									<div class="text-center">
										<img src="https://umsida.ac.id/wp-content/uploads/2019/10/LOGO-WEB4.png" width="300" alt="">
										<h3 class="mt-4 font-weight-bold">Buat Akun</h3>
									</div>
									<div class="login-separater text-center"> <span>Silahkan Mendaftar di sini</span>
										<hr/>
									</div>
									<form action="#" method="POST" autocomplete="off">
									<div class="form-group mt-4">
										<label>NIK (Nomer Induk Keluarga)</label>
										<input type="text" id="nik" name="nik" class="form-control" placeholder="16 Digit Nomer NIK" onkeyup="getDPT(this)" maxlength="16"/>
									</div>
									<div class="form-group">
										<label>Nama Terdaftar</label>
										<input type="text" id="nama" class="form-control" placeholder="Masukan Nama Pengguna" />
									</div>
									<div class="form-group">
										<label>Nama Pengguna</label>
										<input type="text" id="username" name="username" class="form-control" placeholder="Masukan Nama Pengguna" />
									</div>
									<div class="form-group">
										<label>Kata Sandi</label>
										<div class="input-group" id="show_hide_password">
											<input class="form-control border-right-0" type="password" name="password" id="password1" placeholder="Masukan Kata Sandi">
											<div class="input-group-append">	<a href="javascript:;" class="input-group-text bg-transparent border-left-0"><i class='bx bx-hide'></i></a>
											</div>
										</div>
									</div>
									<div class="btn-group mt-3 w-100">
										<input type="submit" class="btn btn-primary btn-block" value="Masuk">
									</div>
									<hr/>
									<div class="text-center mt-4">
										<p class="mb-0">Already have an account? <a href="login.php">Masuk</a>
										</p>
									</div>
									</form>
								</div>
							</div>
							<div class="col-lg-6">
								<img src="assets/images/login-images/register-frent-img.jpg" class="card-img login-img h-100" alt="...">
							</div>
						</div>
						<!--end row-->
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="assets/js/jquery.min.js"></script>
	<script>
		$(document).ready(function () {
			$("#nama").prop( "disabled", true );
			$("#username").prop( "disabled", true );
			$("#password1").prop( "disabled", true );
		});

		function getDPT(nik){
			let nikv = $("#nik").val();
			if(nikv.length == 16){
				$.get('admin/api_dpt.php', {dptid:nikv}, function(data){
					let result = JSON.parse(data);
					if(result['status'] == 200){
						$("#nama").val(result['nama']);
						$("#username").prop( "disabled", false );
						$("#password1").prop( "disabled", false );
					}else{
						$("#nik").val('');
						swal("Ooppss!", "NIK TIDAK DITEMUKAN!", "error");

					}

				});
			}
		}
	</script>
</body>
</html>