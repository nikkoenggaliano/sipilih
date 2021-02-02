<?php include 'header.php'; ?>
		<div class="page-wrapper">
			<!--page-content-wrapper-->
			<div class="page-content-wrapper">
				<div class="page-content">
					<!--breadcrumb-->
					<div class="page-breadcrumb d-none d-md-flex align-items-center mb-3">
						<div class="breadcrumb-title pr-3">Pemilihan</div>
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
					<section class="pb-5">
						<div class="">
							<div class="row justify-content-center">
								<div class="col-12 col-md-10 text-center">
									<div class="heading pb-4">
										<h2>Berikut ini Kandidat</h2>
										<h5 class="font-weight-normal lis-light">Calon Ketua RT 01 RW 01 Kludan Sidoarjo</h5>
									</div>
								</div>
							</div>
							<div class="row">
								<?php 

									$query = "SELECT * FROM `kandidat` WHERE `active`";
									$execute = mysqli_query($conn, $query);
									while($data = mysqli_fetch_array($execute)){

								?>
								<div class="col-12 col-md-12 col-lg-4 mb-5 text-center">
									<div class="price-table">
										<div class="price-header bg-warning lis-rounded-top py-4 border border-bottom-0 lis-brd-light">
											<h5 class="text-uppercase lis-latter-spacing-2">No Urut</h5>
											<h1 class="display-4 lis-font-weight-500"><?php echo $data['no_urut']; ?></h1>
											<p class="mb-0"><?php echo $data['nama']; ?></p>

										</div>
										<img src="<?php echo $data['foto']; ?>" class="img-fluid" alt="">
										<div class="border border-top-0 lis-brd-light bg-white py-5 lis-rounded-bottom">
										 <a href="javascript:;" class="btn btn-warning btn-md lis-rounded-circle-50 px-4" data-abc="true"><i class="fa fa-shopping-cart pl-2"></i>Saya Memilih</a>
										</div>
									</div>
								</div>
							<?php } ?>
							</div>
						</div>
					</section>
				</div>
			</div>
			<!--end page-content-wrapper-->
		</div>
<?php include 'footer.php'; ?>