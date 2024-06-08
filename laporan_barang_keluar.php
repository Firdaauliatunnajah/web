<?php
require_once 'function.php';

checkLogin();
$dataUserLogin = dataUserLogin();

$barang = mysqli_query($conn, "SELECT * FROM barang ORDER BY nama_brand ASC");
$barang_keluar = mysqli_query($conn, "SELECT * FROM barang_keluar INNER JOIN barang ON barang.id_barang = barang_keluar.id_barang ORDER BY tanggal_keluar DESC");

if (isset($_GET['btnFilter'])) {
  $dari_tanggal = $_GET['dari_tanggal'];
  $dari_tanggal_filter = $dari_tanggal . ' 00:00:00';
  $sampai_tanggal = $_GET['sampai_tanggal'];
  $sampai_tanggal_filter = $sampai_tanggal . ' 23:59:59';
  $barang_keluar = mysqli_query($conn, "SELECT * FROM barang_keluar
  INNER JOIN barang ON barang.id_barang = barang_keluar.id_barang 
  WHERE tanggal_keluar BETWEEN '$dari_tanggal_filter' AND '$sampai_tanggal_filter'
  ORDER BY tanggal_keluar ASC");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Laporan Barang Keluar</title>
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
                <h1>Laporan Barang Keluar</h1>
            </div>
        </div>
        <div class="row">
          <div class="col-lg">
            <form method="get" class="row">
              <div class="mb-3 col-lg-4">
                <label for="dari_tanggal" class="form-label">Dari Tanggal</label>
                <input type="date" class="form-control" name="dari_tanggal" id="dari_tanggal" value="<?= isset($_GET['btnFilter']) ? $dari_tanggal : date('Y-m-01'); ?>" require>
              </div>
              <div class="mb-3 col-lg-4">
                <label for="sampai_tanggal" class="form-label">Sampai Tanggal</label>
                <input type="date" class="form-control" name="sampai_tanggal" id="sampai_tanggal" value="<?= isset($_GET['btnFilter']) ? $sampai_tanggal : date('Y-m-d'); ?>" require>
              </div>
              <div class="row">
                <div class="col">
                  <button type="submit" name="btnFilter" class="btn btn-primary">Filter</button>
                  <?php if(isset($_GET['btnFilter'])): ?>
                    <a target="_blank" href="print_laporan_barang_keluar.php?dari_tanggal=<?= $dari_tanggal_filter; ?>&sampai_tanggal=<?= $sampai_tanggal_filter; ?>" name="btnPrint" class="btn btn-success">Print</a>
                    <a href="laporan_barang_keluar.php" name="btnPrint" class="btn btn-danger">Reset</a>
                  <?php endif; ?>
                </div>
              </div>
            </form>
          </div>
        </div>
        <?php if(isset($_GET['btnFilter'])): ?>
        <hr>
        <h4>Laporan Barang Keluar: <?= date("d/m/Y", strtotime($dari_tanggal)); ?> - <?= date("d/m/Y", strtotime($sampai_tanggal)); ?></h4>
        <div class="card mb-4">
            <div class="card-body">
                  <table class="table table-bordered">
                      <thead>
                          <tr>
                              <th>No.</th>
                              <th>Nama Brand</th>
                              <th>Nama Produk</th>
                              <th>Tanggal Keluar</th>
                              <th>Stok Keluar</th>
                          </tr>
                      </thead>
                      <tbody>
                          <?php $i = 1; ?>
                          <?php foreach ($barang_keluar as $data_barang_keluar): ?>
                              <tr>
                                  <td><?= $i++; ?></td>
                                  <td><?= $data_barang_keluar['nama_brand']; ?></td>
                                  <td><?= $data_barang_keluar['nama_produk']; ?></td>
                                  <td><?= $data_barang_keluar['tanggal_keluar']; ?></td>
                                  <td><?= $data_barang_keluar['stok_keluar']; ?></td>
                              </tr>
                          <?php endforeach ?>
                      </tbody>
                  </table>
            </div>
        </div>
        <?php endif; ?>
    </div>
</main>
<?php include_once 'footer.php'; ?>
</div>
</div>
</body>
</html>
