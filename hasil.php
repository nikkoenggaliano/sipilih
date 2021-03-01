<?php include './config/header.php'; 

	function persen($jumlah, $total){
		return ($jumlah/$total)*100;
	}

	$result = array();
	$highcharts = "";
	$pie = "";
	$query_kandidat = "SELECT id,no_urut,nama FROM `kandidat`;";
	$exec	= mysqli_query($conn, $query_kandidat);
	$total_suara = mysqli_num_rows(mysqli_query($conn, "SELECT `id` FROM pemilih;"));
	while($data = mysqli_fetch_array($exec)){
		$id = $data['id'];
		$query_hasil = "SELECT * FROM pemilih WHERE kid = {$id}";
		$total_pasangan = mysqli_num_rows(mysqli_query($conn, $query_hasil));
		$result[$id] = array('hasil' => $total_pasangan, 'nama' => $data['nama'], 'persen' => persen($total_pasangan, $total_suara));

	}
	foreach($result as $res){
		$name = $res['nama'];
		$y    = $res['hasil'];
		$x 	  = $res['persen'];
		$highcharts .= '{name: "'.$name.'", y: '.$y.'},';

	}

	foreach($result as $res){
		$name = $res['nama'];
		$y    = $res['hasil'];
		$x 	  = $res['persen'];
		$pie .= '{name: "'.$name.'", y: '.$x.'},';

	}

if(!isset($_SESSION['username'])){
	die(header("location: login.php"));
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
			<?php 
				if(isset($_SESSION['header'], $_SESSION['isi'], $_SESSION['type'])){
					alerta($_SESSION['header'], $_SESSION['isi'], $_SESSION['type']);
					unset($_SESSION['header']);
					unset($_SESSION['isi']);
					unset($_SESSION['type']);
				}
		 
			?>
					<!--end breadcrumb-->
					<div>
					</div>	
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
<!-- 							<div class="row">

							</div> -->
						<div class="col-12 col-lg-12 col-xl-12">
							<div class="card radius-15">
								<div class="card-body">
									<div id="chart10"></div>
								</div>
							</div>
						</div>
						<div class="col-12 col-lg-12 col-xl-12">
							<div class="card radius-15">
								<div class="card-body">
									<div id="chart2"></div>
								</div>
							</div>
						</div>
						</div>
					</section>
				</div>
			</div>
			<!--end page-content-wrapper-->
		</div>
<?php include './config/footer.php'; ?>

<link href="<?php echo fixdir; ?>assets/plugins/highcharts/css/highcharts.css" rel="stylesheet" />
<script src="<?php echo fixdir; ?>assets/plugins/highcharts/js/highcharts.js"></script>
<script src="<?php echo fixdir; ?>assets/plugins/highcharts/js/highcharts-more.js"></script>
<script src="<?php echo fixdir; ?>assets/plugins/highcharts/js/variable-pie.js"></script>
<script src="<?php echo fixdir; ?>assets/plugins/highcharts/js/solid-gauge.js"></script>
<script src="<?php echo fixdir; ?>assets/plugins/highcharts/js/highcharts-3d.js"></script>
<script src="<?php echo fixdir; ?>assets/plugins/highcharts/js/cylinder.js"></script>
<script src="<?php echo fixdir; ?>assets/plugins/highcharts/js/funnel3d.js"></script>
<script src="<?php echo fixdir; ?>assets/plugins/highcharts/js/exporting.js"></script>
<script src="<?php echo fixdir; ?>assets/plugins/highcharts/js/export-data.js"></script>
<script src="<?php echo fixdir; ?>assets/plugins/highcharts/js/accessibility.js"></script>
<script type="text/javascript">
		Highcharts.chart('chart10', {
		chart: {
			type: 'column',
			styledMode: true
		},
		credits: {
			enabled: false
		},
		title: {
			text: 'Hasil pemilihan'
		},
		subtitle: {
			text: '<?php echo date("h:i:s d:m:Y"); ?>'
		},
		accessibility: {
			announceNewData: {
				enabled: true
			}
		},
		xAxis: {
			type: 'category'
		},
		yAxis: {
			title: {
				text: 'Total Suara'
			}
		},
		legend: {
			enabled: false
		},
		plotOptions: {
			series: {
				borderWidth: 0,
				dataLabels: {
					enabled: true
				}
			}
		},
		tooltip: {
			headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
			pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b> total suara<br/>'
		},
		series: [{
			name: "Kandidat",
			colorByPoint: true,
			data: [
				<?php echo $highcharts; ?>
			]
		}]
	});

	Highcharts.chart('chart2', {
		chart: {
			plotBackgroundColor: null,
			plotBorderWidth: null,
			plotShadow: false,
			type: 'pie',
			styledMode: true
		},
		credits: {
			enabled: false
		},
		title: {
			text: 'Persentase hasil pemilihan'
		},
		tooltip: {
			pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
		},
		accessibility: {
			point: {
				valueSuffix: '%'
			}
		},
		plotOptions: {
			pie: {
				allowPointSelect: true,
				cursor: 'pointer',
				dataLabels: {
					enabled: false
				},
				showInLegend: true
			}
		},
		series: [{
			name: 'Kandidat',
			colorByPoint: true,
			data: [
				<?php echo $pie; ?>
			]
		}]
	});

</script>