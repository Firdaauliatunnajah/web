<?php 
require_once 'function.php';

checkLogin();
$dataUserLogin = dataUserLogin();

$id_barang = $_GET['id_barang'];
if (isset($id_barang)) {
	if (hapusBarang($id_barang) > 0) {
		setAlert("Berhasil", "Barang berhasil terhapus", "success");
	    header("Location: barang.php");
	    exit;
    }
} else {
   header("Location: barang.php");
   exit;
}