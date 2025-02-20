<?php
	$server 		= "localhost";
	$user 			= "root";
	$password 		= "";
	$nama_database 	= "gudang_kopi";

	$db = mysqli_connect($server, $user, $password, $gudang_kopi);

	if( !$db ){
		die("Gagal terhubung dengan database: " . mysqli_connect_error());
	}
?>

