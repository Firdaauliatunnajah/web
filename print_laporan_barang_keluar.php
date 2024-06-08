<?php
require_once 'function.php';

checkLogin();
$dataUserLogin = dataUserLogin();

if(isset($_GET['dari_tanggal']) && isset($_GET['sampai_tanggal'])) {
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
    <title>Cetak Laporan Barang Keluar</title>
    <?php include_once 'head.php'; ?>
</head>
<body>
    <h2>Laporan Barang Keluar</h2>
   <p> Tanggal Keluar : <?= date("d/m/Y", strtotime($dari_tanggal)) ?> - <?= date("d/m/Y", strtotime($sampai_tanggal)) ?></p>

    <table class="table table-bordered" style="border: 1px solid black">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama Barang</th>
                <th>Nama Produk</th>
                <th>Tanggal Keluar</th>
                <th>Stok Keluar</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            <?php while ($data_barang_keluar = mysqli_fetch_assoc($barang_keluar)): ?>
                <tr>
                    <td><?= $i++ ?></td>
                    <td><?= $data_barang_keluar['nama_brand'] ?></td>
                    <td><?= $data_barang_keluar['nama_produk'] ?></td>
                    <td><?= $data_barang_keluar['tanggal_keluar'] ?></td>
                    <td><?= $data_barang_keluar['stok_keluar'] ?></td>
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
