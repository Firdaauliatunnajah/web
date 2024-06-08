<?php
require_once 'function.php';

checkLogin();
$dataUserLogin = dataUserLogin();

if (isset($_POST['btnUbahUserPassword'])) {
    if (ubahUserPassword($_POST) > 0) {
      setAlert("Berhasil", "Password berhasil diubah", "success");
      header("Location: pengaturan.php");
      exit;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Ubah Password - <?= $dataUserLogin['email']; ?></title>
    <?php include_once 'head.php'; ?>
</head>
<body class="sb-nav-fixed">
<?php include_once 'navbar.php'; ?>
<div id="layoutSidenav">
<?php include_once 'sidebar.php'; ?>
<div id="layoutSidenav_content">
<main>
    <div class="container-fluid px-4">
        <div class="row justify-content-between mt-4">
            <div class="col my-auto">
                <h1>Ubah Password - <?= $dataUserLogin['email']; ?></h1>
            </div>
        </div>
        <hr>
        <div class="card mb-4">
            <div class="card-body">
                <form method="post">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="ubahUserModalLabel">Ubah Password - <?= $dataUserLogin['email']; ?></h1>
                            <a href="user.php" class="btn-close"></a>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="password_lama" class="form-label">Password Lama</label>
                                <input type="password" class="form-control" id="password_lama" name="password_lama" required>
                            </div>
                            <div class="mb-3">
                                <label for="password_baru" class="form-label">Password Baru</label>
                                <input type="password" class="form-control" id="password_baru" name="password_baru" required>
                            </div>
                            <div class="mb-3">
                                <label for="verifikasi_password_baru" class="form-label">Verifikasi Password Baru</label>
                                <input type="password" class="form-control" id="verifikasi_password_baru" name="verifikasi_password_baru" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" name="btnUbahUserPassword"><i class="fas fa-fw fa-save"></i> Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
<?php include_once 'footer.php'; ?>
</div>
</div>
</body>
</html>
