<?php
require_once 'function.php';
checkLogin();
$dataUserLogin = dataUserLogin();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Dashboard</title>
    <?php include_once 'head.php'; ?>
</head>
<body class="sb-nav-fixed">
<?php include_once 'navbar.php'; ?>
<div id="layoutSidenav">
<?php include_once 'sidebar.php'; ?>
<div id="layoutSidenav_content">
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Dashboard</h1>
        <hr>
        <div class="row">
            <div class="col-lg-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-bar me-1"></i>
                        Data Barang Masuk
                    </div>
                    <div class="card-body"><style body-color:  #f5a3cc ></style><canvas id="barangMasukChart" width="100%" height="50"></canvas></div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-bar me-1"></i>
                        Data Barang Keluar
                    </div>
                    <div class="card-body"><canvas id="barangKeluarChart" width="100%" height="50"></canvas></div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php include_once 'footer.php'; ?>
</div>
</div>
<script>
// barang masuk
<?php 
    $result = mysqli_query($conn, "SELECT * FROM barang_masuk INNER JOIN barang ON barang.id_barang = barang_masuk.id_barang ORDER BY tanggal_masuk DESC");
    $labels = [];
    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        // Menggunakan tanggal masuk sebagai label
        $labels[] = date("Y-m-d", strtotime($row['tanggal_masuk']));
        // Menggunakan stok masuk sebagai data
        $data[] = $row['stok_masuk'];
    }
?>

Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';

var ctx = document.getElementById("barangMasukChart");
var myLineChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?php echo json_encode($labels); ?>,
        datasets: [{
            label: "Stok Masuk",
            backgroundColor: "rgba(2,117,216,1)",
            borderColor: "rgba(2,117,216,1)",
            data: <?php echo json_encode($data); ?>,
        }],
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    min: 0,
                    // Tentukan batas maksimum yang sesuai dengan total stok maksimum dari data Anda
                    max: <?php echo max($data) + 50; ?>,
                    maxTicksLimit: 5
                },
                gridLines: {
                    display: true
                }
            }],
        },
        legend: {
            display: false
        }
    }
});

// barang keluar
<?php 
    $result = mysqli_query($conn, "SELECT * FROM barang_keluar INNER JOIN barang ON barang.id_barang = barang_keluar.id_barang ORDER BY tanggal_keluar DESC");
    $labels = [];
    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        // Menggunakan tanggal keluar sebagai label
        $labels[] = date("Y-m-d", strtotime($row['tanggal_keluar']));
        // Menggunakan stok keluar sebagai data
        $data[] = $row['stok_keluar'];
    }
?>

Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';

var ctx = document.getElementById("barangKeluarChart");
var myLineChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?php echo json_encode($labels); ?>,
        datasets: [{
            label: "Stok Keluar",
            backgroundColor: "rgba(2,117,216,1)",
            borderColor: "rgba(2,117,216,1)",
            data: <?php echo json_encode($data); ?>,
        }],
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    min: 0,
                    // Tentukan batas maksimum yang sesuai dengan total stok maksimum dari data Anda
                    max: <?php echo max($data) + 50; ?>,
                    maxTicksLimit: 5
                },
                gridLines: {
                    display: true
                }
            }],
        },
        legend: {
            display: false
        }
    }
});

</script>

</body>
</html>
