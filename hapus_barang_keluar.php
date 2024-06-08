<?php 
require_once 'function.php';

checkLogin();
$dataUserLogin = dataUserLogin();

$id_barang_keluar = $_GET['id_barang_keluar'];
if (isset($id_barang_keluar)) {
	if (hapusBarangKeluar($id_barang_keluar) > 0) {
		setAlert("Berhasil", "Barang Keluar berhasil terhapus", "success");
	    header("Location: barang_keluar.php");
	    exit;
    }
} else {
   header("Location: barang_keluar.php");
   exit;
}