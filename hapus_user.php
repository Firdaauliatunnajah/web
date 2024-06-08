<?php 
require_once 'function.php';

checkLogin();
$dataUserLogin = dataUserLogin();

$id_user = $_GET['id_user'];
if (isset($id_user)) {
	if (hapusUser($id_user) > 0) {
		setAlert("Berhasil", "User berhasil terhapus", "success");
	    header("Location: user.php");
	    exit;
    }
} else {
   header("Location: user.php");
   exit;
}