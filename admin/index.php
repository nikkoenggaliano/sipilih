<?php 
include '../config/header.php';
if($_SESSION['role'] != 'admin'){
	header("location: ../logout.php");
	exit;
}

$jumlah_user = mysqli_num_rows(mysqli_query($conn, "SELECT `id` FROM `user` WHERE `role` != 'admin'"));
$jumlah_dpt = mysqli_num_rows(mysqli_query($conn, "SELECT `id` FROM `dpt`"));
$jumlah_dpt_laki = mysqli_num_rows(mysqli_query($conn, "SELECT `id` FROM `dpt` WHERE `kelamin` = 'L'"));
$jumlah_sudah_melakukan_vote = mysqli_num_rows(mysqli_query($conn, "SELECT `id` FROM `pemilih`"));
$jumlah_dpt_perempuan = $jumlah_dpt - $jumlah_dpt_laki;
$selisih = $jumlah_dpt - $jumlah_user;

$lastest_vote = mysqli_fetch_all(mysqli_query($conn, "SELECT p.id, p.uid, p.date, u.username, d.nama FROM pemilih p LEFT JOIN user u ON p.uid = u.dptid LEFT JOIN dpt d ON p.uid = d.id ORDER BY `p`.`id` DESC LIMIT 10"));

?>
		<div class="page-wrapper">
			<!--page-content-wrapper-->
			<div class="page-content-wrapper">
				<div class="page-content">
					<!--breadcrumb-->
					<div class="page-breadcrumb d-none d-md-flex align-items-center mb-3">
						<div class="breadcrumb-title pr-3">Admin/Statistik Admin</div>
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
						<div class="col-12 col-lg-12 col-xl-6">
							<div class="card-deck flex-column flex-lg-row">
								<div class="card radius-15 bg-info">
									<div class="card-body text-center">
										<div class="widgets-icons mx-auto rounded-circle bg-white"><i class="bx bx-time"></i>
										</div>
										<h4 class="mb-0 font-weight-bold mt-3 text-white"><?php echo $jumlah_user; ?></h4>
										<p class="mb-0 text-white">Jumlah Akun Terdaftar</p>
									</div>
								</div>
								<div class="card radius-15 bg-wall">
									<div class="card-body text-center">
										<div class="widgets-icons mx-auto bg-white rounded-circle"><i class="bx bx-bookmark-alt"></i>
										</div>
										<h4 class="mb-0 font-weight-bold mt-3 text-white"><?php echo $jumlah_dpt; ?></h4>
										<p class="mb-0 text-white">Jumlah DPT</p>
									</div>
								</div>
								<div class="card radius-15 bg-rose">
									<div class="card-body text-center">
										<div class="widgets-icons mx-auto bg-white rounded-circle"><i class="bx bx-line-chart"></i>
										</div>
										<h4 class="mb-0 font-weight-bold mt-3 text-white"><?php echo $selisih; ?></h4>
										<p class="mb-0 text-white">Selisih DPT dan Terdaftar</p>
									</div>
								</div>
							</div>
							<div class="card-deck flex-column flex-lg-row">
								<div class="card radius-15 bg-danger">
									<div class="card-body text-center">
										<div class="widgets-icons mx-auto rounded-circle bg-white"><i class="bx bx-line-chart"></i>
										</div>
										<h4 class="mb-0 font-weight-bold mt-3 text-white"><?php echo $jumlah_dpt_laki; ?></h4>
										<p class="mb-0 text-white">DPT Laki - Laki</p>
									</div>
								</div>
								<div class="card radius-15 bg-primary">
									<div class="card-body text-center">
										<div class="widgets-icons mx-auto bg-white rounded-circle"><i class="bx bx-group"></i>
										</div>
										<h4 class="mb-0 font-weight-bold mt-3 text-white"><?php echo $jumlah_dpt_perempuan; ?></h4>
										<p class="mb-0 text-white">DPT Perempuan</p>
									</div>
								</div>
								<div class="card radius-15 bg-success">
									<div class="card-body text-center">
										<div class="widgets-icons mx-auto bg-white rounded-circle"><i class="bx bx-cloud-download"></i>
										</div>
										<h4 class="mb-0 font-weight-bold mt-3 text-white"><?php echo $jumlah_sudah_melakukan_vote; ?></h4>
										<p class="mb-0 text-white">DPT yang telah voting</p>
									</div>
								</div>
							</div>
						</div>
						<div class="col-12 col-lg-12 col-xl-6">
							<div class="card radius-15">
								<div class="card-body">
									<div class="d-lg-flex align-items-center mb-4">
										<div>
											<h5 class="mb-0">Pemilih Terakhir</h5>
										</div>
										<div class="ml-auto">
											<h3 class="mb-0"><span class="font-14">Total Pemilih:</span> <?php echo $jumlah_sudah_melakukan_vote; ?></h3>
										</div>
									</div>
									<hr>
									<div class="dashboard-social-list ps ps--active-y">
										<ul class="list-group list-group-flush">
											<?php 
												foreach ($lastest_vote as $last) {
													
											?>
											<li class="list-group-item d-flex align-items-center">
												<div class="media align-items-center">
													<div class="media-body ml-2">
														<h5 class="mb-0"><?php echo $last[4]; ?></h5>
														<h6>(<?php echo $last[3]; ?>)</h6>
													</div>
												</div>
												<div class="ml-auto"><?php echo $last[2]; ?></div>
											</li>
											<?php } ?>
										</ul>
									<div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; height: 230px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 136px;"></div></div></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--end page-content-wrapper-->
		</div>
<?php include '../config/footer.php'; ?>
<script>
		new PerfectScrollbar('.dashboard-social-list');
		new PerfectScrollbar('.dashboard-top-countries');
</script>