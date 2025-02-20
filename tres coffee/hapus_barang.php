<?php
	include("koneksi.php");
	if( !isset($_GET['id']) ){
		header('Location: barang.php');
	}	
	$id 	= $_GET['id'];
	$sql 	= "DELETE FROM beans WHERE id='$id'";
	$result	= mysqli_query($db, $sql);	
	if ($result) {
		header("Location: barang.php");
	}else{
		die('Invalid query: ');
	}	
?>

