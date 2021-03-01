<?php 
include '../config/config.php';


if(isset($_GET['tipe'], $_GET['id'])){

	$id = (int) _Filters($_GET['id']);
	$tipe = $_GET['tipe'];

	if($tipe == 'dpt'){

		$query = "DELETE FROM `dpt` WHERE `id` = {$id}";
		mysqli_query($conn, $query);
		header("location: daftar_dpt.php");
		exit;

	}elseif ($tipe == 'kandidat') {
		
		$query = "DELETE FROM `kandidat` WHERE `id` = {$id}";
		mysqli_query($conn, $query);
		header("location: daftar_kandidat.php");
		exit;
	}elseif($tipe == 'akun'){
		$query = "DELETE FROM `user` WHERE `id` = {$id}";
		mysqli_query($conn, $query);
		header("location: daftar_akun.php");
		exit;
	}else{
		exit;
	}

}