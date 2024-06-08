<?php
require_once 'function.php';

checkLogin();
$dataUserLogin = dataUserLogin();

$id_user = $_GET['id_user'];

if ($id_user == null) {
    header("Location:user.php");
    exit;
}

$user = mysqli_query($conn, "SELECT * FROM user WHERE id_user = '$id_user'");
$data_user = mysqli_fetch_assoc($user);

if (isset($_POST['btnUbahUser'])) {
    if (ubahUser($_POST) > 0) {
      setAlert("Berhasil", "User berhasil diubah", "success");
      header("Location: user.php");
      exit;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Ubah User - <?= $data_user['email']; ?></title>
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
                <h1>Ubah User - <?= $data_user['email']; ?></h1>
            </div>
        </div>
        <hr>
        <div class="card mb-4">
            <div class="card-body">
                <form method="post">
                    <input type="hidden" name="id_user" value="<?= $data_user['id_user']; ?>">

                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="ubahUserModalLabel">Ubah User - <?= $data_user['email']; ?></h1>
                            <a href="user.php" class="btn-close"></a>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?= $data_user['email']; ?>" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" name="btnUbahUser"><i class="fas fa-fw fa-save"></i> Simpan</button>
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
