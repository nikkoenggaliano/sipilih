<?php 

header('Content-Type: application/json');
include 'config/config.php';

if(!isset($_SESSION['username'])){

	echo json_encode(['code' => 302, 'msg' => 'Perlu masuk terlebih dahulu!']);
	exit;
}




if(isset($_POST['kid'])){

	$id = (int) _Filters($_POST['kid']);
	$uid = $_SESSION['dptid']; //dpt id

	if(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `kandidat` WHERE `id` = {$id}")) == 1){

		if(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `pemilih` WHERE `uid` = {$uid}")) == 0){

			$date = date('h:i:s d-m-Y');
			$query = "INSERT INTO `pemilih` (`id`,`uid`,`kid`,`date`) VALUES (NULL, '{$uid}', '{$id}', '{$date}')";

			if(mysqli_query($conn, $query)){

				echo json_encode(['code' => 200, 'msg' => 'Pemilihan berhasil!']);
				exit;

			}else{
				echo json_encode(['code' => 500, 'msg' => 'Ada sebuah kesalahan, silahkan coba lagi!']);
				exit;
			}


		}else{
			echo json_encode(['code' => 302, 'msg' => 'Anda sudah melakukan pemilihan!']);
			exit;
		}

	}else{

		echo json_encode(['code' => 404, 'msg' => 'Kandidat tidak ditemukan!']);
		exit;

	}
}