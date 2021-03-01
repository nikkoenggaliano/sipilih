<?php 
session_start();
date_default_timezone_set("Asia/Jakarta");
ob_start();
$sql_details = array(
    'user' => 'root',
    'pass' => '',
    'db'   => 'sipilih',
    'host' => 'localhost'
);



$conn = mysqli_connect($sql_details['host'], $sql_details['user'], $sql_details['pass'], $sql_details['db']);

$hostUri = "http://localhost/";

$fixdir = "/sipilih/";define("fixdir", $fixdir);


function _Filters($data){
	global $conn;
	return htmlentities(mysqli_real_escape_string($conn, $data));

}


function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}



function alerta($hdr, $isi, $type){
	echo '<script type="text/javascript">swal("'.$hdr.'", "'.$isi.'", "'.$type.'");</script>';
}



?>