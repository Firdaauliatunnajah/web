<?php
require_once 'function.php';

checkLogin();
$dataUserLogin = dataUserLogin();

$barang = mysqli_query($conn, "SELECT * FROM barang ORDER BY nama_brand ASC");
$barang_masuk = mysqli_query($conn, "SELECT * FROM barang_masuk INNER JOIN barang ON barang.id_barang = barang_masuk.id_barang ORDER BY tanggal_masuk DESC");

if (isset($_POST['btnTambahBarangMasuk'])) {
    if (tambahBarangMasuk($_POST) > 0) {
      setAlert("Berhasil", "Barang Masuk berhasil ditambahkan", "success");
      header("Location: barang_masuk.php");
      exit;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Barang Masuk</title>
    <?php include_once 'head.php'; ?>
</head>
<body class="sb-nav-fixed">
<?php include_once 'navbar.php'; ?>
<div id="layoutSidenav">
<?php include_once 'sidebar.php'; ?>
<div id="layoutSidenav_content">
<main>
    <!-- Modal -->
    <div class="modal fade" id="tambahBarangModal" tabindex="-1" aria-labelledby="tambahBarangModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <form method="post">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="tambahBarangModalLabel">Tambah Barang Masuk</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="mb-3">
                  <label for="id_barang" class="form-label">Nama Brand</label>
                  <select name="id_barang" id="id_barang" class="form-select">
                      <?php foreach ($barang as $data_barang): ?>
                          <option value="<?= $data_barang['id_barang']; ?>"><?= $data_barang['nama_brand']; ?></option>
                      <?php endforeach ?>
                  </select>
                </div>
                <div class="mb-3">
                  <label for="id_barang" class="form-label">Nama Produk</label>
                  <select name="id_barang" id="id_barang" class="form-select">
                      <?php foreach ($barang as $data_barang): ?>
                          <option value="<?= $data_barang['id_barang']; ?>"><?= $data_barang['nama_produk']; ?></option>
                      <?php endforeach ?>
                  </select>
                </div>
                <div class="mb-3">
                  <label for="tanggal_masuk" class="form-label">Tanggal Masuk</label>
                  <input type="datetime-local" value="<?= date('Y-m-d\TH:i:s'); ?>" class="form-control" id="tanggal_masuk" name="tanggal_masuk" required>
                </div>
                
                <div class="mb-3">
                  <label for="stok_masuk" class="form-label">Stok Masuk</label>
                  <input type="number" min="1" class="form-control" id="stok_masuk" name="stok_masuk" required>
                </div>
                <div class="mb-3">
                  <label for="expired" class="form-label">Expired</label>
                  <input type="date" value="<?= date('Y-m-d'); ?>" class="form-control" id="expired" name="expired" required>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fas fa-fw fa-times"></i> Tutup</button>
                <button type="submit" class="btn btn-primary" name="btnTambahBarangMasuk"><i class="fas fa-fw fa-save"></i> Simpan</button>
              </div>
            </div>
        </form>
      </div>
    </div>

    <div class="container-fluid px-4">
        <div class="row justify-content-between mt-4">
            <div class="col my-auto">
                <h1>Barang Masuk</h1>
            </div>
            <div class="col text-end my-auto">
                <button type="button" data-bs-toggle="modal" data-bs-target="#tambahBarangModal" class="btn btn-primary"><i class="fas fa-fw fa-plus"></i> Tambah Barang Masuk</button>
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
                                <th>Nama Brand</th>
                                <th>Nama Produk</th>
                                <th>Tanggal Masuk</th>
                                <th>Stok Masuk</th>
                                <th>Expired</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($barang_masuk as $data_barang_masuk): ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= $data_barang_masuk['nama_brand']; ?></td>
                                    <td><?= $data_barang_masuk['nama_produk']; ?></td>
                                    <td><?= $data_barang_masuk['tanggal_masuk']; ?></td>
                                    <td><?= $data_barang_masuk['stok_masuk']; ?></td>
                                    <td><?= $data_barang_masuk['expired']; ?></td>
                                    <td>
                                        <a class="btn btn-sm btn-success" href="ubah_barang_masuk.php?id_barang_masuk=<?= $data_barang_masuk['id_barang_masuk']; ?>"><i class="fas fa-fw fa-edit"></i> Ubah</a>

                                        <a data-nama="Barang <?= $data_barang_masuk['nama_brand']; ?>" class="btn-delete btn btn-sm btn-danger" href="hapus_barang_masuk.php?id_barang_masuk=<?= $data_barang_masuk['id_barang_masuk']; ?>"><i class="fas fa-fw fa-trash"></i> Hapus</a>
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
