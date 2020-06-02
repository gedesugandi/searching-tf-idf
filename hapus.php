<?php
include 'koneksi.php';
$idDock = $_GET['idDock'];

$hapus = mysqli_query($konek, "DELETE FROM tbberita WHERE Id = $idDock");
if($hapus){
	header('location:submit-artikel.php');
}else{
	echo 'error';
}




?>