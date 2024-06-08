<?php
require_once 'function.php';

checkLogin();
$dataUserLogin = dataUserLogin();

$id_barang_masuk = $_GET['id_barang_masuk'];

if ($id_barang_masuk == null) {
    header("Location:barang_masuk.php");
    exit;
}

$barang = mysqli_query($conn, "SELECT * FROM barang ORDER BY nama_brand ASC");

$barang_masuk = mysqli_query($conn, "SELECT * FROM barang_masuk INNER JOIN barang ON barang.id_barang = barang_masuk.id_barang WHERE barang_masuk.id_barang_masuk = '$id_barang_masuk'");
$data_barang_masuk = mysqli_fetch_assoc($barang_masuk);

if (isset($_POST['btnUbahBarangMasuk'])) {
    if (ubahBarangMasuk($_POST) > 0) {
      setAlert("Berhasil", "Barang Masuk berhasil diubah", "success");
      header("Location: barang_masuk.php");
      exit;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Ubah Barang Masuk - <?= $data_barang_masuk['nama_brand']; ?></title>
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
                <h1>Ubah Barang Masuk - <?= $data_barang_masuk['nama_brand']; ?></h1>
            </div>
        </div>
        <hr>
        <div class="card mb-4">
            <div class="card-body">
                <form method="post">
                    <input type="hidden" name="id_barang_masuk" value="<?= $data_barang_masuk['id_barang_masuk']; ?>">

                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="ubahBarangModalLabel">Ubah Barang - <?= $data_barang_masuk['nama_brand']; ?></h1>
                            <a href="barang.php" class="btn-close"></a>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                              <label for="id_barang" class="form-label">Nama Brand</label>
                              <select name="id_barang" id="id_barang" class="form-select">
                                <option value="<?= $data_barang_masuk['id_barang']; ?>"><?= $data_barang_masuk['nama_brand']; ?></option>
                                <?php foreach ($barang as $data_barang): ?>
                                  <option value="<?= $data_barang['id_barang']; ?>"><?= $data_barang['nama_brand']; ?></option>
                                <?php endforeach ?>
                              </select>
                            </div>
                            <div class="mb-3">
                                <label for="nama_produk" class="form-label">Nama Produk</label>
                                <textarea class="form-control" id="nama_produk" name="nama_produk" required><?= $data_barang_masuk['nama_produk']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="tanggal_masuk" class="form-label">Tanggal Masuk</label>
                                <input type="datetime-local" class="form-control" id="tanggal_masuk" name="tanggal_masuk" value="<?= date('Y-m-d\TH:i:s', strtotime($data_barang_masuk['tanggal_masuk'])); ?>" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="stok_masuk" class="form-label">Total Stok</label>
                                <input type="number" class="form-control" id="stok_masuk" min="1" name="stok_masuk" value="<?= $data_barang_masuk['stok_masuk']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="expired" class="form-label">Expired</label>
                                <input type="datetime-local" class="form-control" id="expired" name="expired" value="<?= date('Y-m-d\TH:i:s', strtotime($data_barang_masuk['tanggal_masuk'])); ?>" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" name="btnUbahBarangMasuk"><i class="fas fa-fw fa-save"></i> Simpan</button>
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
