<?php 
include '../config/config.php';
if($_SESSION['role'] != 'admin'){
	header("location: ../logout.php");
	exit;
}

$query = "SELECT `u`.`id`, `u`.`username`, `d`.`nik`, `d`.`nama`, `d`.`kelamin`, `u`.`role` FROM `user` `u` LEFT JOIN `dpt` `d` ON `u`.`dptid` = `d`.`id` WHERE `d`.`nik` IS NOT NULL";

$exec = mysqli_query($conn, $query);
$totalRows = mysqli_num_rows($exec);
$data = mysqli_fetch_all($exec);

$ret = array(
	'draw' => 0,
	'recordsTotal' => $totalRows,
	'recordsFiltered' => $totalRows,
	'data' => $data
); 

echo json_encode($ret);