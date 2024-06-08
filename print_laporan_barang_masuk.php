<?php
require_once 'function.php';

checkLogin();
$dataUserLogin = dataUserLogin();

if(isset($_GET['dari_tanggal']) && isset($_GET['sampai_tanggal'])) {
  $dari_tanggal = $_GET['dari_tanggal'];
  $dari_tanggal_filter = $dari_tanggal . ' 00:00:00';
  $sampai_tanggal = $_GET['sampai_tanggal'];
  $sampai_tanggal_filter = $sampai_tanggal . ' 23:59:59';
  $barang_masuk = mysqli_query($conn, "SELECT * FROM barang_masuk
  INNER JOIN barang ON barang.id_barang = barang_masuk.id_barang 
  WHERE tanggal_masuk BETWEEN '$dari_tanggal_filter' AND '$sampai_tanggal_filter'
  ORDER BY tanggal_masuk ASC");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Cetak Laporan Barang Masuk</title>
    <?php include_once 'head.php'; ?>
</head>
<p> PENERIMA : </p>
<body>
    <h2>Laporan Barang Masuk</h2>
    <p>Tanggal Terima : <?= date("d/m/Y", strtotime($dari_tanggal)) ?> - <?= date("d/m/Y", strtotime($sampai_tanggal)) ?></p>

    <table class="table table-bordered" style="border: 1px solid black">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama Barang</th>
                <th>Nama Produk</th>
                <th>Tanggal Masuk</th>
                <th>Stok Masuk</th>
                <th>Expired</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            <?php while ($data_barang_masuk = mysqli_fetch_assoc($barang_masuk)): ?>
                <tr>
                    <td><?= $i++ ?></td>
                    <td><?= $data_barang_masuk['nama_brand'] ?></td>
                    <td><?= $data_barang_masuk['nama_produk'] ?></td>
                    <td><?= $data_barang_masuk['tanggal_masuk'] ?></td>
                    <td><?= $data_barang_masuk['stok_masuk'] ?></td>
                    <td><?= $data_barang_masuk['expired'] ?></td>
                </tr>
            <?php endwhile ?>
        </tbody>
    </table>

    <script>
        // Automatically trigger print dialog when page loads
        window.onload = function() {
            window.print();
        }
    </script>
</body>
        <div class="sb-print_lapor_barang_keluar-footer">
            <div class="big">Staff Karyawan: <?= $dataUserLogin['email']; ?></div>
        </div>
</html>
