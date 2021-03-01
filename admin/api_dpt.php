<?php 
include '../config/config.php';

if(isset($_GET['dptid'])){

	$nik = _filters($_GET['dptid']);
	$query = "SELECT * FROM `dpt` WHERE `nik` = '{$nik}'";
	$exec  = mysqli_query($conn, $query);
	if(mysqli_num_rows($exec) == 1){

		$result = mysqli_fetch_array($exec);

		$result['status'] = 200;
		echo json_encode($result);

	}else{

		echo json_encode(array('status'=> 404));
	}

	exit;
}


$table = 'dpt';
$primaryKey = 'id';

function _date_format($data){

	$bulan = array(
		'01' => 'Januari',
		'02' => 'Febuari',
		'03' => 'Maret',
		'04' => 'April',
		'05' => 'Mei',
		'06' => 'Juni',
		'07' => 'Juli',
		'08' => 'Agustus',
		'09' => 'September',
		'10' => 'Oktober',
		'11' => 'November',
		'12' => 'Desember'
	);

	$data = explode("|", $data);
	return $data[0]." ".$bulan[$data[1]]." ".$data[2];

}
$columns = array(
	array('db' => 'id', 'dt' => 0),
    array( 'db' => 'nik', 'dt' => 1 ),
    array( 'db' => 'nama', 'dt' => 2,
		'formatter' => function($d, $row){
			return  '<a href=rubah_dpt.php?id='.$row['id'].'>'.$d.'</a>';
		}),
    array( 'db' => 'kelamin', 'dt' => 3, 
    	'formatter' => function($d, $row){
    		return $d == 'L' ? 'Laki-Laki' : 'Perempuan';
    }),
    array( 'db' => 'tgl_lahir', 'dt' => 4, 
			'formatter' => function($d, $row){
				return _date_format($d);
			}),
);

 
require( '../config/spp.class.php' );
header('Content-Type: application/json');
echo json_encode(
    SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
);