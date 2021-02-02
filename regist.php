<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<title>Syndash - Bootstrap4 Admin Template</title>
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
</head>

<body class="bg-register">
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
									<div class="form-group mt-4">
										<label>NIK (Nomer Induk Keluarga)</label>
										<input type="text" class="form-control" placeholder="16 Digit Nomer NIK" />
									</div>
									<div class="form-row">
										<div class="form-group col-md-6">
											<label>First Name</label>
											<input type="text" class="form-control" placeholder="Jhon" />
										</div>
										<div class="form-group col-md-6">
											<label>Last Name</label>
											<input type="text" class="form-control" placeholder="Deo" />
										</div>
									</div>
									<div class="form-group">
										<label>Password</label>
										<div class="input-group" id="show_hide_password">
											<input class="form-control border-right-0" type="password" value="12345678">
											<div class="input-group-append">	<a href="javascript:;" class="input-group-text bg-transparent border-left-0"><i class='bx bx-hide'></i></a>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label>Country</label>
										<select class="form-control">
											<option>India</option>
											<option>United Kingdom</option>
											<option>America</option>
											<option>Dubai</option>
										</select>
									</div>
									<div class="form-group">
										<div class="custom-control custom-checkbox">
											<input type="checkbox" class="custom-control-input" id="customCheck1">
											<label class="custom-control-label" for="customCheck1">I read and agree to Terms & Conditions</label>
										</div>
									</div>
									<div class="btn-group mt-3 w-100">
										<button type="button" class="btn btn-primary btn-block">Register</button>
										<button type="button" class="btn btn-primary"><i class="lni lni-arrow-right"></i>
										</button>
									</div>
									<hr/>
									<div class="text-center mt-4">
										<p class="mb-0">Already have an account? <a href="authentication-login.html">Login</a>
										</p>
									</div>
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
	<!-- end wrapper -->
	<!-- JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="assets/js/jquery.min.js"></script>
	<!--Password show & hide js -->
	<script>
		$(document).ready(function () {
			$("#show_hide_password a").on('click', function (event) {
				event.preventDefault();
				if ($('#show_hide_password input').attr("type") == "text") {
					$('#show_hide_password input').attr('type', 'password');
					$('#show_hide_password i').addClass("bx-hide");
					$('#show_hide_password i').removeClass("bx-show");
				} else if ($('#show_hide_password input').attr("type") == "password") {
					$('#show_hide_password input').attr('type', 'text');
					$('#show_hide_password i').removeClass("bx-hide");
					$('#show_hide_password i').addClass("bx-show");
				}
			});
		});
	</script>
</body>


<!-- Mirrored from codervent.com/syndash/demo/vertical/authentication-register.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 31 Jan 2021 10:24:09 GMT -->
</html>