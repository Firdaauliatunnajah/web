<?php
require_once 'function.php';

checkLogin();
$dataUserLogin = dataUserLogin();

$id_barang_keluar = $_GET['id_barang_keluar'];

if ($id_barang_keluar == null) {
    header("Location:barang_keluar.php");
    exit;
}

$barang = mysqli_query($conn, "SELECT * FROM barang ORDER BY nama_brand ASC");

$barang_keluar = mysqli_query($conn, "SELECT * FROM barang_keluar INNER JOIN barang ON barang.id_barang = barang_keluar.id_barang WHERE barang_keluar.id_barang_keluar = '$id_barang_keluar'");
$data_barang_keluar = mysqli_fetch_assoc($barang_keluar);

if (isset($_POST['btnUbahBarangKeluar'])) {
    if (ubahBarangKeluar($_POST) > 0) {
      setAlert("Berhasil", "Barang Keluar berhasil diubah", "success");
      header("Location: barang_keluar.php");
      exit;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Ubah Barang Keluar - <?= $data_barang_keluar['nama_brand']; ?></title>
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
                <h1>Ubah Barang Keluar - <?= $data_barang_keluar['nama_brand']; ?></h1>
            </div>
        </div>
        <hr>
        <div class="card mb-4">
            <div class="card-body">
                <form method="post">
                    <input type="hidden" name="id_barang_keluar" value="<?= $data_barang_keluar['id_barang_keluar']; ?>">

                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="ubahBarangModalLabel">Ubah Barang - <?= $data_barang_keluar['nama_brand']; ?></h1>
4                            <a href="barang.php" class="btn-close"></a>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                              <label for="id_barang" class="form-label">Nama Brand</label>
                              <select name="id_barang" id="id_barang" class="form-select">
                                <option value="<?= $data_barang_keluar['id_barang']; ?>"><?= $data_barang_keluar['nama_brand']; ?></option>
                                <?php foreach ($barang as $data_barang): ?>
                                  <option value="<?= $data_barang['id_barang']; ?>"><?= $data_barang['nama_brand']; ?></option>
                                <?php endforeach ?>
                              </select>
                            </div>
                            <div class="mb-3">
                                <label for="nama_produk" class="form-label">Nama Produk</label>
                                <textarea class="form-control" id="nama_produk" name="nama_produk" required><?= $data_barang_keluar['nama_produk']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="tanggal_keluar" class="form-label">Tanggal Keluar</label>
                                <input type="datetime-local" class="form-control" id="tanggal_keluar" name="tanggal_keluar" value="<?= date('Y-m-d\TH:i:s', strtotime($data_barang_keluar['tanggal_keluar'])); ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="stok_keluar" class="form-label">Total Stok</label>
                                <input type="number" class="form-control" id="stok_keluar" min="1" name="stok_keluar" value="<?= $data_barang_keluar['stok_keluar']; ?>" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" name="btnUbahBarangKeluar"><i class="fas fa-fw fa-save"></i> Simpan</button>
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
