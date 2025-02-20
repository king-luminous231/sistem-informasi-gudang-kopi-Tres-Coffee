<?php
	include("koneksi.php");
	
	$id		=$_POST['xid'];
	$nama	=$_POST['xnama'];
	$jumlah	=$_POST['xjumlah'];
	
	$sql	= "INSERT INTO beans(id,nama_bean,jumlah_bean) values ('$id','$nama',$jumlah)";
	$result	= mysqli_query($db, $sql);	
	if ($result) {
		header("Location: barang.php");
	}else{
		die('Invalid query: ');
	}		
?>

