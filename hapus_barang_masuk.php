<?php 
require_once 'function.php';

checkLogin();
$dataUserLogin = dataUserLogin();

$id_barang_masuk = $_GET['id_barang_masuk'];
if (isset($id_barang_masuk)) {
	if (hapusBarangMasuk($id_barang_masuk) > 0) {
		setAlert("Berhasil", "Barang Masuk berhasil terhapus", "success");
	    header("Location: barang_masuk.php");
	    exit;
    }
} else {
   header("Location: barang_masuk.php");
   exit;
}