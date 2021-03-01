<?php 

include 'config/config.php';

if(isset($_POST['username'], $_POST['password'])){
	$username = _Filters($_POST['username']);
	$query = "SELECT * FROM `user` WHERE `username` = '{$username}'";
	$exec  = mysqli_query($conn, $query);
	if(mysqli_num_rows($exec) != 1){

		$_SESSION['header'] = 'Hays!!';
		$_SESSION['isi'] = 'Username / Password tidak ditemukan!';
		$_SESSION['type'] = 'error';
		header("location: login.php");
		exit;
	}else{

		$data = mysqli_fetch_array($exec); 


		if(password_verify($_POST['password'], $data['password'])){
			$_SESSION['id']    = $data['id'];
			$_SESSION['dptid'] = $data['dptid'];
			$_SESSION['username'] = $username;
			$_SESSION['role'] = $data['role'];

			if($data['role'] == 'user'){
				header("location: index.php");
				exit;	
			}else{

				header("location: admin/");
				exit;
			}

		}else{

			$_SESSION['header'] = 'Hays!!';
			$_SESSION['isi'] = 'Username / Password tidak ditemukan!';
			$_SESSION['type'] = 'error';
			header("location: login.php");
			exit;

		}

	}

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<title>Masuk ke Sistem</title>
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

<body class="bg-login">
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
		<div class="section-authentication-login d-flex align-items-center justify-content-center">
			<div class="row">
				<div class="col-12 col-lg-10 mx-auto">
					<div class="card radius-15">
						<div class="row no-gutters">
							<div class="col-lg-6">
								<div class="card-body p-md-5">
									<div class="text-center">
										<img src="https://umsida.ac.id/wp-content/uploads/2019/10/LOGO-WEB4.png" width="300" alt="">
										<h3 class="mt-4 font-weight-bold">Selamat Datang</h3>
									</div>
									<div class="login-separater text-center"> <span>Masuk dengan Akun Anda</span>
										<hr/>
									</div>
									<form action="#" method="POST">
									<div class="form-group mt-4">
										<label>Nama Pengguna</label>
										<input type="text" class="form-control" name="username" placeholder="Masukan Nama Pengguna Anda" />
									</div>
									<div class="form-group">
										<label>Kata Sandi</label>
										<input type="password" class="form-control" name="password" placeholder="Masukan Password" />
									</div>
									<div class="form-row">
										<div class="form-group col">
											<div class="custom-control custom-switch">
												<input type="checkbox" class="custom-control-input" id="customSwitch1" checked>
												<label class="custom-control-label" for="customSwitch1">Remember Me</label>
											</div>
										</div>
										<div class="form-group col text-right"> <a href="authentication-forgot-password.html"><i class='bx bxs-key mr-2'></i>Forget Password?</a>
										</div>
									</div>
									<div class="btn-group mt-3 w-100">
										<input type="submit" class="btn btn-primary btn-block" value="Masuk">
									</div>
									</form>
									<hr>
									<div class="text-center">
										<p class="mb-0">Tidak punya akun? <a href="regist.php">Daftar</a>
										</p>
									</div>
								</div>
							</div>
							<div class="col-lg-6">
								<img src="assets/images/login-images/login-frent-img.jpg" class="card-img login-img h-100" alt="...">
							</div>
						</div>
						<!--end row-->
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end wrapper -->
</body>

</html>