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
    <title>User</title>
    <?php include_once 'head.php'; ?>
</head>
<body class="sb-nav-fixed">
<?php include_once 'navbar.php'; ?>
<div id="layoutSidenav">
<?php include_once 'sidebar.php'; ?>
<div id="layoutSidenav_content">
<main>
    <!-- Modal -->
    <div class="modal fade" id="tambahUserModal" tabindex="-1" aria-labelledby="tambahUserModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <form method="post">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="tambahUserModalLabel">Tambah User</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                  <label for="password" class="form-label">Password</label>
                  <input type="password" class="form-control" id="password" name="password" required>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fas fa-fw fa-times"></i> Tutup</button>
                <button type="submit" class="btn btn-primary" name="btnTambahUser"><i class="fas fa-fw fa-save"></i> Simpan</button>
              </div>
            </div>
        </form>
      </div>
    </div>

    <div class="container-fluid px-4">
        <div class="row justify-content-between mt-4">
            <div class="col my-auto">
                <h1>User</h1>
            </div>
            <div class="col text-end my-auto">
                <button type="button" data-bs-toggle="modal" data-bs-target="#tambahUserModal" class="btn btn-primary"><i class="fas fa-fw fa-plus"></i> Tambah User</button>
            </div>
        </div>
        <hr>
        <div class="card mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="dataTable">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Email</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($user as $data_user): ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= $data_user['email']; ?></td>
                                    <td>
                                        <a class="btn btn-sm btn-success" href="ubah_user.php?id_user=<?= $data_user['id_user']; ?>"><i class="fas fa-fw fa-edit"></i> Ubah</a>
                                        <a data-nama="User <?= $data_user['email']; ?>" class="btn-delete btn btn-sm btn-danger" href="hapus_user.php?id_user=<?= $data_user['id_user']; ?>"><i class="fas fa-fw fa-trash"></i> Hapus</a>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
<?php include_once 'footer.php'; ?>
</div>
</div>
</body>
</html>
