<?php include './config/header.php'; 

if(!isset($_SESSION['username'])){
	die(header("location: login.php"));
}


$uid = $_SESSION['id'];
if(mysqli_num_rows(mysqli_query($conn, "SELECT `id` FROM pemilih WHERE uid = {$uid}")) != 0){
	$_SESSION['header'] = 'Wooops';
	$_SESSION['isi'] = 'Anda telah telah memilih!';
	$_SESSION['type'] = 'warning';
	header("location: hasil.php");
	exit;


}

?>
		<div class="page-wrapper">
			<!--page-content-wrapper-->
			<div class="page-content-wrapper">
				<div class="page-content">
					<!--breadcrumb-->
					<div class="page-breadcrumb d-none d-md-flex align-items-center mb-3">
						<!-- <div class="breadcrumb-title pr-3">Pemilihan</div> -->
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

									$query = "SELECT * FROM `kandidat` WHERE `active` = 1";
									$execute = mysqli_query($conn, $query);
									while($data = mysqli_fetch_array($execute)){

								?>
								<div class="col-12 col-md-12 col-lg-4 mb-5 text-center">
									<div class="price-table">
										<div class="price-header bg-warning lis-rounded-top py-4 border border-bottom-0 lis-brd-light">
											<h5 class="text-uppercase lis-latter-spacing-2">No Urut</h5>
											<h1 class="display-4 lis-font-weight-500" id="nourut-<?php echo $data['id']; ?>"><?php echo $data['no_urut']; ?></h1>
											<p class="mb-0" id="namakandidat-<?php echo $data['id']; ?>"><?php echo $data['nama']; ?></p>

										</div>
										<img src="assets/kandidat/<?php echo $data['foto']; ?>" class="img-fluid" alt="">
										<div class="border border-top-0 lis-brd-light bg-white py-5 lis-rounded-bottom">
										 <button onclick="pilih(<?php echo $data['id']; ?>)" class="btn btn-warning btn-md lis-rounded-circle-50 px-4" data-abc="true"><i class="fa fa-shopping-cart pl-2"></i>Saya Memilih</button>
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
<?php include './config/footer.php'; ?>


<script type="text/javascript">
	
	function pilih(kid){
		const nourut = $("#nourut-"+kid).text();
		const namakandidat = $("#namakandidat-"+kid).text();
		swal({
			title: 'Berhenti!',
			text: "Apa anda yakin memilih: "+namakandidat+`(${nourut})`,
			type: "warning",
			buttons: {
			cancel: "Batal",
			confirm: {
				text: 'Pilih',
				value: true
			},
		  },
		}).then((val) => {
			if(val){

				$.post('pilih.php', {
					kid: kid
				},function(data, status){

					if(data.code == 200){
						swal('Selamat!', data.msg, 'success');
						window.location = 'hasil.php';
					}else if(data.code == 500){
						swal('Oppss', data.msg, 'error');
					}else if(data.code == 302){
						swal('Woops!', data.msg, 'info');
						window.location = 'hasil.php';
					}else if(data.code == 404){
						swal('Wopsss!', data.msg, 'warning');
						window.location = 'hasil.php';
					}else{
						swal('ERRORR', 'Terjadi kesalahan', 'error');
					}

				});

			}else{
				//alert('Silahkan pilih kembali!');
			}
		});


	}

</script>