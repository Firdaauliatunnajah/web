<?php
require_once 'function.php';

checkLogin();
$dataUserLogin = dataUserLogin();

$user = mysqli_query($conn, "SELECT * FROM user ORDER BY email ASC");

if (isset($_POST['btnTambahUser'])) {
    if (tambahUser($_POST) > 0) {
      setAlert("Berhasil", "User berhasil ditambahkan", "success");
      header("Location: user.php");
      exit;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>User - <?= $dataUserLogin['email']; ?></title>
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
                <h1>User - <?= $dataUserLogin['email']; ?></h1>
            </div>
        </div>
        <hr>
        <div class="card mb-4">
            <div class="card-body">
                <p><strong>Email:</strong><br><?= $dataUserLogin['email']; ?></p>
                <p><a href="ubah_password.php" class="btn btn-sm btn-danger">Ubah Password</a></p>
            </div>
        </div>
    </div>
</main>
<?php include_once 'footer.php'; ?>
</div>
</div>
</body>
</html>
