<?php 
include 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<title>SiPilih RT</title>
	<!--favicon-->
	<link rel="icon" href="assets/images/favicon-32x32.png" type="image/png" />
	<!--plugins-->
	<link href="<?php echo fixdir; ?>assets/plugins/simplebar/css/simplebar.css" rel="stylesheet"/>
	<link href="<?php echo fixdir; ?>assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
	<link href="<?php echo fixdir; ?>assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
	<!-- loader-->
	<link href="<?php echo fixdir; ?>assets/css/pace.min.css" rel="stylesheet" />
	<script src="<?php echo fixdir; ?>assets/js/pace.min.js"></script>
	<!-- Bootstrap CSS -->
	<link href="<?php echo fixdir; ?>assets/plugins/datatable/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo fixdir; ?>assets/plugins/datatable/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="<?php echo fixdir; ?>assets/css/bootstrap.min.css" />
	<!-- Icons CSS -->
	<link rel="stylesheet" href="<?php echo fixdir; ?>assets/css/icons.css" />
	<!-- App CSS -->
	<link rel="stylesheet" href="<?php echo fixdir; ?>assets/css/app.css" />
	<link rel="stylesheet" href="<?php echo fixdir; ?>assets/css/dark-sidebar.css" />
	<link rel="stylesheet" href="<?php echo fixdir; ?>assets/css/dark-theme.css" />
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body>
	<!-- wrapper -->
	<div class="wrapper">
		<!--sidebar-wrapper-->
		<div class="sidebar-wrapper" data-simplebar="true">
			<div class="sidebar-header">
				<div class="">
					<img src="https://upload.wikimedia.org/wikipedia/commons/b/b6/Logo_graph_umsida_FC.jpg" class="logo-icon-2" alt="" />
				</div>
				<div>
					<h4 class="logo-text">SiPilih</h4>
				</div>
				<a href="javascript:;" class="toggle-btn ml-auto"> <i class="bx bx-menu"></i>
				</a>
			</div>
			<!--navigation-->
			<ul class="metismenu" id="menu">
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon icon-color-1"><i class="bx bx-home-alt"></i>
						</div>
						<div class="menu-title">Dashboard</div>
					</a>
					<ul>
						<?php if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'){ ?>
						<li> <a href="index.php"><i class="bx bx-right-arrow-alt"></i>Admin Home</a></li>
						<?php }else{ ?>
						<li> <a href="index.php"><i class="bx bx-right-arrow-alt"></i>Beranda</a></li>
						<li> <a href="hasil.php"><i class="bx bx-line-chart"></i>Hasil</a></li>
						<?php }?>
						<!-- <li> <a href="index2.html"><i class="bx bx-right-arrow-alt"></i>Sales</a>
						</li> -->
					</ul>
				</li>
				<?php if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'){ ?>
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon icon-color-6"><i class="bx bx-task"></i>
						</div>
						<div class="menu-title">Kandidat Menu</div>
					</a>
					<ul>
						<li> <a href="tambah_kandidat.php"><i class="bx bx-right-arrow-alt"></i>Tambah Kandidat</a>
						</li>
						<li> <a href="daftar_kandidat.php"><i class="bx bx-right-arrow-alt"></i>Daftar Kandidat</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon icon-color-5"><i class="bx bx-group"></i>
						</div>
						<div class="menu-title">DPT Menu</div>
					</a>
					<ul>
						<li> <a href="unggah_dpt.php"><i class="bx bx-right-arrow-alt"></i>Unggah DPT</a>
						</li>						
						<li> <a href="tambah_dpt.php"><i class="bx bx-right-arrow-alt"></i>Tambah DPT</a>
						</li>
						<li> <a href="daftar_dpt.php"><i class="bx bx-right-arrow-alt"></i>Daftar DPT</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon icon-color-3"><i class="bx bx-user-circle"></i>
						</div>
						<div class="menu-title">Akun Menu</div>
					</a>
					<ul>
						<li> <a href="daftar_akun.php"><i class="bx bx-right-arrow-alt"></i>Akun Terdaftar</a>
					</ul>
				</li>
				<li>
					<a href="hasil.php" aria-expanded="true">
						<div class="parent-icon icon-color-7"><i class="bx bx-file"></i>
						</div>
						<div class="menu-title">Hasil Pemilihan</div>
					</a>
				</li>
			<?php } ?>
			</ul>
			<!--end navigation-->
		</div>
		<!--end sidebar-wrapper-->
		<!--header-->
		<header class="top-header">
			<nav class="navbar navbar-expand">
				<div class="left-topbar d-flex align-items-center">
					<a href="javascript:;" class="toggle-btn">	<i class="bx bx-menu"></i>
					</a>
				</div>
				<div class="flex-grow-1 search-bar">
					<div class="input-group">
<!-- 						<div class="input-group-prepend search-arrow-back">
							<button class="btn btn-search-back" type="button"><i class="bx bx-arrow-back"></i>
							</button>
						</div> -->
						<input type="text" class="form-control" placeholder="" />
<!-- 						<div class="input-group-append">
							<button class="btn btn-search" type="button"><i class="lni lni-search-alt"></i>
							</button>
						</div> -->
					</div>
				</div>
				<div class="right-topbar ml-auto">
					<ul class="navbar-nav">
						<li class="nav-item search-btn-mobile">
							<a class="nav-link position-relative" href="javascript:;">	<i class="bx bx-search vertical-align-middle"></i>
							</a>
						</li>
						<li class="nav-item dropdown dropdown-user-profile">
							<a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="javascript:;" data-toggle="dropdown">
								<div class="media user-box align-items-center">
									<div class="media-body user-info">
										<p class="user-name mb-0"><?php echo $_SESSION['username']; ?></p>
										<p class="designattion mb-0"><?php echo $_SESSION['role'] == 'user' ? 'Selamat Datang' : 'Halo Admin!'; ?></p>
									</div>
									<img src="https://upload.wikimedia.org/wikipedia/commons/b/b6/Logo_graph_umsida_FC.jpg" class="user-img" alt="user avatar">
								</div>
							</a>
							<div class="dropdown-menu dropdown-menu-right">	<a class="dropdown-item" href="javascript:;"><i
										class="bx bx-user"></i><span>Profile</span></a>
								<a class="dropdown-item" href="javascript:;"><i
										class="bx bx-cog"></i><span>Settings</span></a>
								<div class="dropdown-divider mb-0"></div>	<a class="dropdown-item" href="<?php echo $_SESSION['role'] == 'admin' ? '../logout.php' : 'logout.php'; ?>"><i
										class="bx bx-power-off"></i><span>Logout</span></a>
							</div>
						</li>
					</ul>
				</div>
			</nav>
		</header>
