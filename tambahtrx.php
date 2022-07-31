<?php

include_once("config.php");
session_start();
if (!isset($_SESSION["adminloggedin"]) && !isset($_SESSION["superadminloggedin"])) {
    echo "<script>
        alert('Silahkan log in terlebih dahulu!');
        window.location.href = 'index.php';
    </script>";
}
$total_price = 0;


// $row = mysqli_fetch_assoc($data_summing);

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/stylesheet/style.css">
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>Merthanaya</title>
</head>

<body>
    <!-- navigation bar area -->
    <nav class="navbar navbar-expand-lg navbar-light bg-warning bg-gradient">
        <div class="container-fluid">
            <div class="left-nav">
                <a class="navbar-brand" href="#"><img src="src/img/logo.png" height="50" width="150" alt="Logo Merthanaya"></a>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="adminpage.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="tambahuser.php">Tambah Pelanggan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#">List Transaksi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="logoutproses.php">Keluar</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- content start here -->
    <div class="container">
        <div id="data-pelanggan">
            <hr>
            <h2>Data Transaksi</h2>
            <div class="table-responsive">
                <table class="table mt-2">
                    <form method="get" action="tambahtrx.php">
                        <div class="row mb-2">
                            <div class="col">
                                <span>Dari tgl :</span>
                                <input class="form-control" type="date" name="start" id="tglmulai">
                            </div>
                            <div class="col">
                                <span>Sampai tgl :</span>
                                <input class="form-control" type="date" name="end" id="tglselesai">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-8">
                                <input class="form-control" style="width: 100%;" type="search" name="cari" placeholder="Masukan No ID/Username Pelanggan" aria-label="Search">
                            </div>
                            <div class="col-4">
                                <button class="btn btn-outline-success" style="width: 100%;" name="filter" type="submit">Cari</button>
                            </div>
                        </div>
                    </form>
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">No ID</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Belanja</th>
                            <th scope="col">Tanggal/Jam</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $batas = 10;
                        $halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
                        $halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;

                        $previous = $halaman - 1;
                        $next = $halaman + 1;

                        $data = $conn->query("SELECT * FROM usertrx");
                        $jumlah_data = mysqli_num_rows($data);
                        $total_halaman = ceil($jumlah_data / $batas);

                        if (isset($_GET['filter'])) {
                            $cari = $_GET['cari'];
                            $startdt = $_GET['start'];
                            $enddt = $_GET['end'];
                            if ($cari != null) {
                                if (is_numeric($cari) == 1) {
                                    if (($startdt != null) && ($enddt != null)) {
                                        $sql_cari = "SELECT * FROM `usertrx` INNER JOIN `user` on user.id = usertrx.userid WHERE ((`userid` = '$cari') and (`trxdate` between '$startdt' and ADDDATE('$enddt', INTERVAL 1 DAY)) limit $halaman_awal, $batas";
                                        $data_user = $conn->query($sql_cari);

                                        $sql_cari2 = "SELECT * FROM `usertrx` INNER JOIN `user` on user.id = usertrx.userid WHERE ((`userid` = '$cari') and (`trxdate` between '$startdt' and ADDDATE('$enddt', INTERVAL 1 DAY))";
                                        $data_user2 = $conn->query($sql_cari2);
                                        foreach ($data_user2 as $total) {
                                            $total_price += $total['trx'];
                                        }
                                        $total_data = mysqli_num_rows($data_user2);
                                    } else {
                                        $sql_cari = "SELECT * FROM `usertrx` INNER JOIN `user` on user.id = usertrx.userid WHERE (`userid` = '$cari')";
                                        $data_user = $conn->query($sql_cari);

                                        $sql_cari2 = "SELECT * FROM `usertrx` INNER JOIN `user` on user.id = usertrx.userid WHERE (`userid` = '$cari')";
                                        $data_user2 = $conn->query($sql_cari2);
                                        foreach ($data_user2 as $total) {
                                            $total_price += $total['trx'];
                                        }
                                        $total_data = mysqli_num_rows($data_user2);
                                    }
                                } else {
                                    if (($startdt != null) && ($enddt != null)) {
                                        $sql_cari = "SELECT * FROM `usertrx` INNER JOIN `user` on user.id = usertrx.userid WHERE ((`userid` = '$cari') or (`username` like '%$cari%')) and (`trxdate` between '$startdt' and ADDDATE('$enddt', INTERVAL 1 DAY)) limit $halaman_awal, $batas";
                                        $data_user = $conn->query($sql_cari);

                                        $sql_cari2 = "SELECT * FROM `usertrx` INNER JOIN `user` on user.id = usertrx.userid WHERE ((`userid` = '$cari') or (`username` like '%$cari%')) and (`trxdate` between '$startdt' and ADDDATE('$enddt', INTERVAL 1 DAY))";
                                        $data_user2 = $conn->query($sql_cari2);
                                        foreach ($data_user2 as $total) {
                                            $total_price += $total['trx'];
                                        }
                                        $total_data = mysqli_num_rows($data_user2);
                                    } else {
                                        $sql_cari = "SELECT * FROM `usertrx` INNER JOIN `user` on user.id = usertrx.userid WHERE ((`userid` = '$cari') or (`username` like '%$cari%'))";
                                        $data_user = $conn->query($sql_cari);

                                        $sql_cari2 = "SELECT * FROM `usertrx` INNER JOIN `user` on user.id = usertrx.userid WHERE ((`userid` = '$cari') or (`username` like '%$cari%'))";
                                        $data_user2 = $conn->query($sql_cari2);
                                        foreach ($data_user2 as $total) {
                                            $total_price += $total['trx'];
                                        }
                                        $total_data = mysqli_num_rows($data_user2);
                                    }
                                }
                            } else {
                                if (($startdt != null) && ($enddt != null)) {
                                    $sql_cari = "SELECT * FROM `usertrx` INNER JOIN `user` on user.id = usertrx.userid where (`trxdate` between '$startdt' and ADDDATE('$enddt', INTERVAL 1 DAY))";
                                    $data_user = $conn->query($sql_cari);

                                    $sql_cari2 = "SELECT * FROM `usertrx` INNER JOIN `user` on user.id = usertrx.userid WHERE (`trxdate` between '$startdt' and ADDDATE('$enddt', INTERVAL 1 DAY))";
                                    $data_user2 = $conn->query($sql_cari2);
                                    foreach ($data_user2 as $total) {
                                        $total_price += $total['trx'];
                                    }
                                    $total_data = mysqli_num_rows($data_user);
                                } else {
                                    $sql = "SELECT * FROM user INNER JOIN usertrx ON user.id = usertrx.userid limit $halaman_awal, $batas";
                                    $data_user = $conn->query($sql);

                                    $sql2 = "SELECT * FROM usertrx";
                                    $jumlahdata = $conn->query($sql2);
                                    foreach ($jumlahdata as $total) {
                                        $total_price += $total['trx'];
                                    }
                                    $total_data = mysqli_num_rows($jumlahdata);
                                }
                            }
                        } else {
                            $sql = "SELECT * FROM user INNER JOIN usertrx ON user.id = usertrx.userid limit $halaman_awal, $batas";
                            $data_user = $conn->query($sql);

                            $sql2 = "SELECT * FROM usertrx";
                            $jumlahdata = $conn->query($sql2);
                            foreach ($jumlahdata as $total) {
                                $total_price += $total['trx'];
                            }
                            $total_data = mysqli_num_rows($jumlahdata);
                        }
                        $nomor = $halaman_awal + 1;

                        while ($data = mysqli_fetch_array($data_user)) {
                        ?>
                            <tr>
                                <th scope="row"><?= $data['userid'] ?></th>
                                <td><?= $data['username'] ?></td>
                                <td><?= $data['trx'] ?></td>
                                <td><?= $data['trxdate'] ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div><br>
            <div class="pagination">
                <nav aria-label="Page navigation example">
                    <ul class="pagination flex-wrap justify-content-center">
                        <li class="page-item">
                            <a class="page-link" <?php if ($halaman > 1) {
                                                        echo "href='?halaman=$previous'";
                                                    } ?>>Previous</a>
                        </li>
                        <?php
                        for ($x = 1; $x <= $total_halaman; $x++) {
                        ?>
                            <li class="page-item"><a class="page-link" href="?halaman=<?= $x ?>"><?php echo $x; ?></a></li>
                        <?php } ?>
                        <li class="page-item"><a class="page-link" <?php if ($halaman < $total_halaman) {
                                                                        echo "href='?halaman=$next'";
                                                                    } ?>>Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="export-file mt-2">
                <form method="post" action="export.php">
                    <div class="row d-flex justify-content-center align-items-center">
                        <div class="col-md-12">
                            <label for=""><strong>Export Data Transaksi :</strong></label>
                            <select name="export-data" id="export-data" class="form-control" hidden>
                                <option value="xlsx">XLSX</option>
                            </select>
                            <button type="submit" name="submit" class="btn btn-success rounded shadow w-25"><strong>Export</strong></button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="data-harga mt-5">
                <h4>Jumlah Transaksi : <?= $total_data ?> Kali</h4>
                <h4>Total Transaksi : Rp <?= number_format($total_price, 2, ',', '.') ?></h4>
            </div>

        </div>
    </div>
    <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>